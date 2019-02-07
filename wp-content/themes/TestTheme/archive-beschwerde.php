<?php 
get_header();
seitenBanner(array(
	'title'		=> 'Alle Beschwerden',
	'subtitle'	=> 'Woran leidest du?',
));
?>

<div class="container container--narrow page-section"> 	
<?php
	while(have_posts()){
		the_post();		

	get_template_part('template-parts/content-beschwerde', 'excerpt');
	}

	echo paginate_links();
?>

	</div>
</div>

<?php
get_footer();
?>