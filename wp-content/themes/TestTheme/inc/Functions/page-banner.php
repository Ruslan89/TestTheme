<?php

//Dynamische Seiten Banner Hintergrundbilder
//Mit der selbst gewaehlten Variable '$args' kann man auf alle Inhalte der Funktion zugreifen. 
//Wenn es eine spezielle Ueberschrift, Untertitel, Bild etc. gibt, sollen diese auf den entsprechenden Seiten festgelegt werden ('seitenBanner'). Ansonsten soll der standart Inhalt geladen werden

// Ein dynamisches Hintergrundbild und Untertiteltext: 
//Felder mit ACF kreieren. Bildergroesse in function.php einstellen. Auf Bildgroesse Variable (SeitenBanner) zugreifen
// Auf die Funktion 'seitenBanner()' kann nun auf jeder Seite zugegriffen werden
function seitenBanner($args = NULL) { // NULL damit die Variable optional ist und nicht unbedingt ueberall gesucht wird

	if(!$args['title']) {
		$args['title'] = get_the_title();
	}
	if(!$args['subtitle']) {
		$args['subtitle'] = get_field('seiten_banner_untertitel');
	}
	if(!$args['photo']) {
		if(get_field('seiten_banner_hintergrundbild')) {
			$args['photo'] = get_field('seiten_banner_hintergrundbild')['sizes']['seitenBanner'];
		}
			else {
				$args['photo'] = get_theme_file_uri('/images/ocean.jpg');
			}
	}
?>	<!--'echo $args' an passender Stelle eintragen-->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle'] ?></p>
      </div>
    </div>  
  </div>
<?php }