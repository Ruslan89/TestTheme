<?php 
get_header();
seitenBanner(array(
	'title'		=> get_the_archive_title(),
	'subtitle'	=> get_the_archive_description(),
));
?>
123
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