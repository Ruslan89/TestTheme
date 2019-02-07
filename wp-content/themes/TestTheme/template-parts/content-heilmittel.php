<div class="row group">
    <div class="one-third">
        <?php the_post_thumbnail('heilmittelPortrait'); ?>
	</div>
		
	<div class="post-item"> 		
		<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="metabox">
			<p><?php echo get_the_category_list(', ') ?></p>
		</div>

		<div>
			<?php if (has_excerpt()) {
				echo get_the_excerpt();
				} else {
				echo wp_trim_words(get_field('main_body_content'), 20); 
				} ?>
				<p><a class="btn btn--blue-margin-top" href="<?php the_permalink(); ?>">Lesen &raquo;</a></p>
		</div>
	</div>