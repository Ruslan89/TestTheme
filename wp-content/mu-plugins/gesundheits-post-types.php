<?php  
//In neu angelegten Ordner werden die Plugins und WP Aenderungen abgespeichert, damit diese Funktionen nicht verloren gehen, wenn wir mal das Template oder Plugins aendern
//WICHTIG: Nach erstellen einer neuen Seitenkategorie, wird diese in WP angezeigt und man kann neue Beitraege erstellen, aber die Seiten werden als Blog angezeigt. Dazu in WP unter Settings-Permalinks gehen und saven. Danach wird die neue Rubrik als Blogtemplate (single.php) geladen. 


function gesundheits_post_types () { 

//Heilmittel	
	register_post_type('heilmittel', array(
		'capability_type' 	=> 'heilmittel',
		'map_meta_cap'		=> true,
		'show_in_rest' 		=> true,
		'supports' 			=> array('title', 'excerpt', 'page-attributes', 'thumbnail'),
		'taxonomies' 		=> array('category', 'post_tag'),
		'rewrite' 			=> array('slug' => 'heilmittel'),
		'has_archive' 		=> true, 
		'public' 			=> true,
		'labels' 			=> array(
			'name' 			=> 'Heilmittel',
			'add_new_item' 	=> 'Neues Heilmittel hinzufügen', 
			'edit_item' 	=> 'Heilmittel bearteiten',
			'all_items' 	=> 'Alle Heilmittel',
			'singular_name' => 'Heilmittel',
		),
		'menu_icon' => 'dashicons-heart' //Icons hier: https://developer.wordpress.org/resource/dashicons/#media-interactive
	));
//Vitalstoffe	
	register_post_type('vitalstoff', array(
		'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail'),
		'taxonomies' => array('category', 'post_tag'),
		'rewrite' => array('slug' => 'vitalstoffe'),
		'has_archive' => true, 
		'public' => true,
		'labels' => array(
			'name' => 'Vitalstoffe',
			'add_new_item' => 'Neuen Vitalstoff hinzufügen', 
			'edit_item' => 'Vitalstoff bearteiten',
			'all_items' => 'Alle Vitalstoffe',
			'singular_name' => 'Vitalstoff',
		),
		'menu_icon' => 'dashicons-star-empty' 
	));

//Beschwerden	
	register_post_type('beschwerde', array(
		'capability_type' 	=> 'beschwerde',
		'map_meta_cap'		=> true,
		'supports' => array('title', 'excerpt', 'page-attributes', 'post-formats', 'thumbnail'),
		'taxonomies' => array('category', 'post_tag'),
		'rewrite' => array('slug' => 'beschwerden'),
		'has_archive' => true, 
		'public' => true,
		'labels' => array(
			'name' => 'Beschwerden',
			'add_new_item' => 'Neue Beschwerde hinzufügen', 
			'edit_item' => 'Beschwerde bearteiten',
			'all_items' => 'Alle Beschwerden',
			'singular_name' => 'Beschwerde',
		),
		'menu_icon' => 'dashicons-dismiss' 
	));

//Notizen
	register_post_type('notiz', array(
		'capability_type'=> 'notiz',
		'map_meta_cap'	=> true,
		'show_in_rest' 	=> true,
		'supports' 		=> array('title', 'editor'),
		'public'		=> false,
		'show_ui'		=> true,
		'labels' 		=> array(
			'name'			=> 'Notizen',
			'add_new_item'	=> 'Neue Notiz hinzufügen',
			'edit_item'		=> 'Notiz bearteiten',
			'all_items'		=> 'Alle Notizen',
			'singular_name'	=> 'Notiz'
		),
		'menu_icon'	=> 'dashicons-welcome-write-blog'
	));	

//Likes
	register_post_type('like', array(
		'supports' 	=> array('title'),
		'public'	=> false,
		'show_ui'	=> true,
		'labels' 	=> array(
			'name'			=> 'Likes',
			'add_new_item'	=> 'Add New Like',
			'edit_item'		=> 'Edit Like',
			'all_items'		=> 'All Likes',
			'singular_name'	=> 'Like'
		),
		'menu_icon'	=> 'dashicons-heart'
	));
}


add_action('init', 'gesundheits_post_types'); 