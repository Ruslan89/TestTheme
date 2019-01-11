<?php

//Map
function gesundheitsMapKey ($api) {
	$api['key'] = 'AIzaSyBl6PmBIa1jlUlGF3wtDbOMPZSyR4XbW_4';
	return $api;
}

add_filter('acf/fields/google_map/api', 'gesundheitsMapKey');