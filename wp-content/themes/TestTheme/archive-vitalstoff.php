<?php 
get_header();
seitenBanner(array(
  'title'     => 'Vitalstoffe',
  'subtitle'  => 'Die Kraft der Natur',
));
?>

<div class="container container--narrow page-section"> 	
<?php
	while(have_posts()){
		the_post();		

	get_template_part('template-parts/content-heilmittel', 'excerpt');
	}

	echo paginate_links();
?>

	</div>
</div>

<?php
get_footer();
?>