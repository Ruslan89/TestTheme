<?php 
get_header();
seitenBanner(array(
	'title'		=> 'Magazin',
	'subtitle'	=> 'Rund um Gesundheit'
));
?>

<div class="container container--narrow page-section"> 	
<?php
	while(have_posts()){
		the_post();		

	get_template_part('template-parts/content-post', 'excerpt');
	}

	echo paginate_links();
?>

	</div>
</div>

<?php
get_footer();
?>