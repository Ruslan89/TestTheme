<?php 
get_header();
seitenBanner(array(
	'title'		=> 'Heilmittel',
	'subtitle'	=> 'Untertitel noch einfügen',
));
?>

<div class="container container--narrow page-section"> 	
<ul class="link-list min-list">	
<?php
while(have_posts()){
	the_post(); ?>		

		<div class="post-item"> 		
		<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="metabox">
			<p><?php echo get_the_category_list(', ') ?></p>
		</div>
		<div>
			<?php the_excerpt(); ?>
			<p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Zum Heilmittel &raquo;</a></p>
		</div>
	</div>

<?php }

echo paginate_links();

?>
</ul>

	</div>
    </div>
</div>

<?php
get_footer();
?>