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
	the_post(); ?>
	<div class="post-item"> 		<!--//Abstand und Rand zwischen jedem Post-->
		<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="metabox">
			<p><?php echo get_the_category_list(', ') ?></p>
		</div>
		<div>
			<?php the_excerpt(); ?>
			<p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Lesen &raquo;</a></p>
		</div>
	</div>
<?php }

echo paginate_links();

?>
</div>

<?php
get_footer();
?>