<?php 
get_header();
seitenBanner(array(
	'title'		=> get_the_archive_title(),
	'subtitle'	=> get_the_archive_description(),
));
?>

<div class="container container--narrow page-section"> 	<!--//Blog Posts Darstellung und Optikverlinkung  -->
<?php
while(have_posts()){
	the_post(); ?>
	<div class="post-item"> 		<!--//Abstand und Rand zwischen jedem Post-->
		<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="metabox">
			<p>Geschrieben von <?php the_author_posts_link() ?> am <?php the_time('d.m.y'); ?> in <?php echo get_the_category_list(', ') ?></p>
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