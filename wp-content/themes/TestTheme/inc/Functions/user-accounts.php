<?php

//User-Accounts: Login direkt zur Homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
	$ourCurrentUser = wp_get_current_user();

	if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') { 
		wp_redirect(site_url('/'));
		exit;
	}
}

//Schwarze WP-Leiste beim Login entfernen
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
	$ourCurrentUser = wp_get_current_user();

	if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') { 
		show_admin_bar(false);
	}
}

//Custom Login
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
	return esc_url(site_url('/')); //Logo Verlinkung zur eigenen Seite
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() { //Eigenes Login-Desing benutzen
	wp_enqueue_style('gesundheit_haupt_styles', get_stylesheet_uri(), NULL, microtime());
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
	return get_bloginfo('name');
}