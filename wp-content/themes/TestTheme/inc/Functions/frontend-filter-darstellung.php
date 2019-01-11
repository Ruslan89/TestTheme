<?php

function gesundheits_angepasste_queries($query){ //Diese Funktion steht auch im 'frontpage'/'archive-event. Damit man diese Funktionen fuer Eventsfitler nicht auf jeder Seite neu schreiben muss. Wird hier eine Funktion festgelegt, die fuer alle Eventsdarstellungen gilt. Dabei wird auf eine globale Query zugegriffen, die theoretisch auch das WP Menu veraendert. In einer If-Bedingung legen wir Parameter fest, sodass die Aenderungen nur fuer bestimmte Faelle zutrifft (NICHT als Admin+nur Archiv + Hauptquery). 
	//Programme Filter
	if (!is_admin() AND is_post_type_archive('vitalstoff') AND $query->is_main_query()) {
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	}
	//Eventfilter
	if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
		$heute = date('yyyymmdd');
		$query->set('meta_key', 'event_date');  // Nach welchem meta_value soll gefiltert werden
          $query->set('orderby', 'meta_value_num'); 
          $query->set('order', 'ASC');   
          $query->set('meta_query', array( //Event abgeschlossen = raus aus der Liste
            array(                   
              'key' => 'event_date',
              'compare' => '>=',     
              'value' => '$heute',   
              'type' => 'numeric',   
            )

          ));
	}
}

add_action('pre_get_posts', 'gesundheits_angepasste_queries');