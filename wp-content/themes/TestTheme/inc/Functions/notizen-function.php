<?php

// Notizen
// '(Wasser)filter' / Eingabefilter für Texteingabefilter der Seite /Sicherheit vor Hackern
// 10 = bei mehreren Functionen beginnt, die mit der niedrigsten Nummer
// 2 = wie viele Variablen benutzt werden ($data und $postarr)
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr) {
	// Kein HTML etc. Eingabe in Textfelder / Textausgabe sanieren
	if ($data['post_type'] == 'notiz') {
		if (!$data['post_title']) {
            die("Titel und Text müssen ausgefüllt sein.");
        }
		//Maximale Notizanzahl / '> x' bestimmt die maximale Anzahl -> Auch in Notizen.js (deleteNote) anpassen
		if (count_user_posts(get_current_user_id(), 'notiz') > 100 AND !$postarr['ID']) {
			die("Notizen Limit erreicht");
		}
		$data['post_content'] = sanitize_textarea_field($data['post_content']);
		$data['post_title'] = sanitize_textarea_field($data['post_title']);
	}

	// Notizen -> Privat
	if ($data['post_type'] == 'notiz' AND $data['post_status'] != 'trash') {
		$data['post_status'] = "private";
	}
	
	return $data;
}