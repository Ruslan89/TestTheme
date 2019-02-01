<?php

//Dateien aus 'inc-Ordner' werden hinzugefügt
require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/Functions/like-function.php');
require get_theme_file_path('/inc/Functions/page-banner.php');
require get_theme_file_path('/inc/Functions/map-function.php');
require get_theme_file_path('/inc/Functions/user-accounts.php');
require get_theme_file_path('/inc/Functions/notizen-function.php');
require get_theme_file_path('/inc/Functions/frontend-filter-darstellung.php');


//Add new custom Field fuer die Live-Suche 
//Folgendes kann man veraendern: 'post' = Typ, 'authorName' = Postman Variable, 'get_the_author()' = Welcher Inhalt gesucht wird
// !: Textinhaltsquellen bietet sich an (z.B. gesundheits-universum, gesundheit.de,...)
function gu_custom_rest() {
	register_rest_field('post', 'authorName', array(
		'get_callback' => function() {return get_the_author();}
	));

	register_rest_field('notiz', 'userNoteCount', array(
		'get_callback' => function() {return count_user_posts(get_current_user_id(), 'notiz');}
	));
}

add_action('rest_api_init', 'gu_custom_rest');


function gesundheits_features() { 	//Hier bestimmen wir, welche Features in WP angezeigt werden sollen
	register_nav_menu('headerMenuLocation', 'Header Menu Location'); //Menu Option wird in WP angezeigt
	//register_nav_menu('footerLocationOne', 'Footer Location One');   //Footer Menu. In WP angezeigt
	//register_nav_menu('footerLocationTwo', 'Footer Location Two');

	add_theme_support('title-tag'); //Mit dieser Funktion soll die aktuelle Seite im Browserfenster angezeigt werden

	add_theme_support('post-thumbnails'); //Hier soll ein featured image in WP angezeigt werden. Das geschieht jedoch standartweise nur fuer Blogs. Um die Einstellung auch fuer custom seiten zu aktivieren, muss man in mu-plugins->gesundheis-post-types eingestellt werden

	add_image_size('heilmittelLandscape', 400, 260, true); //Hier wird festgelegt, welche Groesse man fuer welche Bilder erstellen lassen moechte. Variable kann fuer jede Bilderkategorie selbst bestimmt werden. 400x260, Schnitt (true/false)
	add_image_size('heilmittelPortrait', 480, 400, true);
	add_image_size('seitenBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'gesundheits_features'); 


//wp_enqueue_...soll Daten von außerhalb laden
function gesundheits_ordner (){
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i'); //Hier soll eine Schriftart von Google geladen werden
	wp_enqueue_style('font-cool', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); //Hier wird nach einer CSS Darstellung gesucht. Aus einem eigenen Ordner soll die Darstellung fuer die Kontaktbilder geladen werden.
	wp_enqueue_style('gesundheit_haupt_styles', get_stylesheet_uri(), NULL, microtime());

	wp_enqueue_script('Irgendein-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true); //Ein Java Skript soll fuer die Darstellung vom Slider geladen werden.//Die Darstellungssektion nennt sich "get_theme_file_uri".//Aus dem js-Ordner, die Datei "scripts-bundle.js".//Java braucht weitere Argumente: "NULL" bedeutet, dass dieses Java Skript zu keinem anderen Skrip gehoert. Die Version dieses files (selbst bestimmt 1.0).//Abschliessend wird gefragt, ob diese Datei direkt vor dem closing body tag geladen werden soll. Wir sagen yes oder true damit die Datei am Ende der Seite geladen wird, was die Performence verbessert

	//HTML Daten werden auf der Seite ausgegeben:
	wp_localize_script('Irgendein-js', 'guData', array( 
		'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
	));
}

add_action('wp_enqueue_scripts','gesundheits_ordner');	//"add_action" sagt, dass etwas passieren soll. Die erste Variable bestimmt, wo WP nach welcher Aktion suchen soll. //'wp_enqueue_skripts' ist ein fester Befehl und bedeutet, dass in Skripten (Java) eine Fuktions geladen werden soll. // 'gesundheits_daten' ist ein selbst erstellter Befehl. Also soll in dem Java Skript nach einer bestimmten Java Anwendung gesucht werden.


// Disable Gutenberg for specific post types
function _thz_filter_disable_block_editor_pt( $use_block_editor, $post_type ){

  if( 'heilmittel' == $post_type || 'notiz' == $post_type){
    $use_block_editor = false;
  }

  return $use_block_editor;
}

add_filter( 'use_block_editor_for_post_type', '_thz_filter_disable_block_editor_pt', 10, 2 );


// Archive Order by...
$post_type = array('beschwerde');

function my_change_sort_order($query){
	if(is_post_type_archive($post_type)):
	 //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
	   //Set the order ASC or DESC
	   $query->set( 'order', 'ASC' );
	   //Set the orderby
	   $query->set( 'orderby', 'title' );
	endif;    
}

add_action( 'pre_get_posts', 'my_change_sort_order');