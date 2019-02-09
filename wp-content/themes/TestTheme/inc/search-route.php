<?php
//Filtereinstellungen fuer die (detaillierte) Live Suche. Unter Postman nachschauen.
add_action('rest_api_init', 'guRegisterSearch');

function guRegisterSearch() {								//Eigene Suchroute wird erstellt
	register_rest_route('gu/v1', 'search', array(			//Verknuepfung zur eigenen Route
		'methods' 	=> WP_REST_SERVER::READABLE,			//Steht quasi für 'GET'
		'callback' 	=> 'guSearchResults'					//Eigene Suchroute/Suchfeld
	));
}

function guSearchResults($data) {							//Suchroute wird verwendet für...
	$mainQuery = new WP_Query(array(
		'post_type' 	=> array('post', 'page', 'heilmittel', 'beschwerde', 'vitalstoff'), 
		's' 			=> sanitize_text_field($data['term']),	//Suchfeld-Eingabe (saniert)
		'posts_per_page'=> -1,
	));

	$results = array(										//Ausgabe-Kategorien
		'magazin' 		=> array(),							//Leere Arrays, ohne Daten
		'beschwerden'	=> array(),
		'heilmittel' 	=> array(),	
		'vitalstoffe' 	=> array(),
		'sonstiges'		=> array(),
	);


/*--------------------------------*/

	while($mainQuery->have_posts()) {		//Suchroute wird nach Daten/Suchbegriff durchsucht
		$mainQuery->the_post();				//Suche so lange, bis es Treffer gibt

		// Heilmittel
		if(get_post_type() == 'heilmittel') {			//Singular
			array_push($results['heilmittel'], array(  	//Plural		
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'id'		=> get_the_id(),
		));
		}

		// Vitalstoff
		if(get_post_type() == 'vitalstoff') {			//Singular
			$verwandteBeschwerde = get_field('passende_beschwerde'); //Passendes HM zu Beschw.

			/*if($verwandteBeschwerde) {					
				foreach($verwandteBeschwerde as $beschwerde) {
					array_push($results['beschwerden'], array(
						'title' => get_the_title($beschwerde),
						'permalink' => get_the_permalink($beschwerde)
					));
				}	
			}*/
			array_push($results['vitalstoffe'], array(  	//Plural		
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'id'		=> get_the_id(),
		));
		}

		// Beschwerde
		if(get_post_type() == 'beschwerde') {			//Singular
			$verwandtesHeilmittel = get_field('passendes_heilmittel'); //Passendes HM zu Beschw.

			if($verwandtesHeilmittel) {					
				foreach($verwandtesHeilmittel as $heilmittel) {
					array_push($results['heilmittel'], array(
						'title' => get_the_title($heilmittel),
						'permalink' => get_the_permalink($heilmittel)
					));
				}	
			}
			array_push($results['beschwerden'], array(  	//Plural		
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'id'		=> get_the_id(),
		));
		}

		// Seiten
		if(get_post_type() == 'page') {
			array_push($results['sonstiges'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'id'		=> get_the_id(),
		));
		}
	}	

					//Ausgabe der verknuepften Bereiche
/*-----------------------------------------------------------------------*/					

// Heilmittel
	if ($results['heilmittel']) {							//Nur Ausgabe bei Treffern der Kategorie.		

	$heilmittelMetaQuery = array('relation' => 'OR');		//Suche in/für alle Kategorien

	foreach($results['heilmittel'] as $item) {				//Vergleich alle gefundenen IDs zu HM
		array_push($heilmittelMetaQuery, array(				//$HM Array hinzufügen
				'key' 		=> 'passendes_heilmittel',		//Filter für`s hinzugefügte Array
				'compare' 	=> 'LIKE',
				'value'		=> '"' . $item['id'] . '"'		//Alle verwandten IDs zu HM
 			));
	}

	$heilmittelRelationshipQuery = new WP_Query(array(					//Gesamtes Array
		'post_type'  	=> array('heilmittel', 'post'), 	//Grobe Filter
		'meta_query'	=> $heilmittelMetaQuery							//Eigene Filter s.o.
	));	

	while($heilmittelRelationshipQuery->have_posts()) {
		$heilmittelRelationshipQuery->the_post();

		/*if(get_post_type() == 'beschwerde') {				//Passende Beschw. zu HM
			array_push($results['beschwerden'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
		));
		}

		if(get_post_type() == 'vitalstoff') {				//Passender Vitalst. zu HM
			array_push($results['vitalstoffe'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
		));
		}*/

		if(get_post_type() == 'post') {						//Passender Artikel zu HM
			array_push($results['magazin'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'postType'	=> get_post_type(),
			'authorName'=> get_the_author(),
		));
		}	
	} 		

	//Ausgabe der (verknuepften)Kategoriebereiche. Zudem sollen doppelte Einträge rausgefiltert werden:
	$results['magazin'] = array_values(array_unique($results['magazin'], SORT_REGULAR));
	$results['heilmittel'] = array_values(array_unique($results['heilmittel'], SORT_REGULAR));
	$results['beschwerden'] = array_values(array_unique($results['beschwerden'], SORT_REGULAR));
	$results['vitalstoffe'] = array_values(array_unique($results['vitalstoffe'], SORT_REGULAR));

}

// Beschwerde
	if ($results['beschwerden']) {			

	$heilmittelMetaQuery = array('relation' => 'OR');		

	foreach($results['beschwerden'] as $item) {		
		array_push($heilmittelMetaQuery, array(				
				'key' 		=> 'passende_beschwerde',		
				'compare' 	=> 'LIKE',
				'value'		=> '"' . $item['id'] . '"'		
 			));
	}

	$heilmittelRelationshipQuery = new WP_Query(array(					
		'post_type'  	=> array('heilmittel', 'beschwerde', 'post', 'vitalstoff'), 	
		'meta_query'	=> $heilmittelMetaQuery							
	));	

	while($heilmittelRelationshipQuery->have_posts()) {
		$heilmittelRelationshipQuery->the_post();

		if(get_post_type() == 'post') {						//Passender Artikel zu Beschw.
			array_push($results['magazin'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'postType'	=> get_post_type(),
			'authorName'=> get_the_author(),
		));
		}	

		if(get_post_type() == 'vitalstoff') {				//Passende Beschw. zu HM
			array_push($results['vitalstoffe'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
		));
		}
	} 		

	$results['magazin'] = array_values(array_unique($results['magazin'], SORT_REGULAR));
	$results['heilmittel'] = array_values(array_unique($results['heilmittel'], SORT_REGULAR));
	$results['beschwerden'] = array_values(array_unique($results['beschwerden'], SORT_REGULAR));
	$results['vitalstoffe'] = array_values(array_unique($results['vitalstoffe'], SORT_REGULAR));

}
	
// Vitalstoff
if ($results['vitalstoffe']) {			

	$heilmittelMetaQuery = array('relation' => 'OR');		

	foreach($results['vitalstoffe'] as $item) {		
		array_push($heilmittelMetaQuery, array(				
				'key' 		=> 'passender_vitalstoff',		
				'compare' 	=> 'LIKE',
				'value'		=> '"' . $item['id'] . '"'		
 			));
	}

	$heilmittelRelationshipQuery = new WP_Query(array(					
		'post_type'  	=> array('heilmittel', 'beschwerde', 'post', 'vitalstoff'), 	
		'meta_query'	=> $heilmittelMetaQuery							
	));	

	while($heilmittelRelationshipQuery->have_posts()) {
		$heilmittelRelationshipQuery->the_post();

		if(get_post_type() == 'post') {						//Passender Artikel zu Beschw.
			array_push($results['magazin'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
			'postType'	=> get_post_type(),
			'authorName'=> get_the_author(),
		));
		}	

		if(get_post_type() == 'vitalstoff') {				//Passende Beschw. zu HM
			array_push($results['vitalstoffe'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
		));
		}

		/*if(get_post_type() == 'beschwerde') {				//Passende Beschw. zu HM
			array_push($results['beschwerden'], array(  				
			'title' 	=> get_the_title(),
			'permalink' => get_the_permalink(),
		));
		}*/
	} 		

	$results['magazin'] = array_values(array_unique($results['magazin'], SORT_REGULAR));
	$results['heilmittel'] = array_values(array_unique($results['heilmittel'], SORT_REGULAR));
	$results['beschwerden'] = array_values(array_unique($results['beschwerden'], SORT_REGULAR));
	$results['vitalstoffe'] = array_values(array_unique($results['vitalstoffe'], SORT_REGULAR));

}


	return $results;	
}