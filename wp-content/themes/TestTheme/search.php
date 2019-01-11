<?php 
get_header();
seitenBanner(array(
	'title'		=> 'Suchergebnisse',
	'subtitle'	=> 'Für &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
));
?>

<div class="container container--narrow page-section"> 	
<?php
	if (have_posts()) {
		while(have_posts()){
		the_post(); 
		//Darstellung in 'template-parts' gespeichert
		get_template_part('template-parts/content', get_post_type());
	} 
	echo paginate_links();
	} else {
		echo '<h2 class="headline headline--small-plus">Keine Ergebnisse gefunden.</h2>';
	}
	get_search_form();
?>
</div>

<?php
get_footer();
?>