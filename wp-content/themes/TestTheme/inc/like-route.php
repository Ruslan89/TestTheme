<?php

add_action('rest_api_init', 'guLikeRouts');

function guLikeRouts() {
	register_rest_route('gu/v1', 'like', array(			//Verknuepfung zur eigenen Route
		'methods' 	=> 'POST',
		'callback' 	=> 'createLike'
	));

	register_rest_route('gu/v1', 'like', array(			//Verknuepfung zur eigenen Route
		'methods' 	=> 'DELETE',
		'callback' 	=> 'deleteLike'
	));
}

function createLike($data) {
	if(is_user_logged_in()) {
		$heilmittel = sanitize_text_field($data['heilmittelId']);

		$existQuery = new WP_Query(array(
              'author'    => get_current_user_id(),
              'post_type' => 'like',
              'meta_query'=> array(
                array(
                  'key'     => 'like_id',
                  'compare' => '=',
                  'value'   => $heilmittel
                )
              )
            ));

			if ($existQuery->found_posts == 0 AND get_post_type($heilmittel) == 'heilmittel') {
				return wp_insert_post(array(
				'post_type'	=> 'like',
				'post_status' => 'publish',
				'post_title' => get_post_field('post_title', $heilmittel) . ' User ID# ' . get_current_user_id(),
				'meta_input' => array(
					'like_id' => $heilmittel
				)
			));
			} else {
				die("Invalid heilmittel id");
			}		
		} else {
			die("Um Manipulationen zu vermeiden, können nur registrierte Benutzer eine Bewertung abgeben.");
	}
}

function deleteLike($data) {
	$likeId = sanitize_text_field($data['like']);
	if (get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like') {
		wp_delete_post($likeId, true);				//false= in Papierkorb, true= komplett delete
		return 'Bewertung gelöscht.';
	} else {
		die("Du hast nicht die Rechte das zu löschen.");
	}
} 


