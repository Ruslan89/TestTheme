<div class="post-item"> 		
		<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="metabox">
			<p>Geschrieben von <?php the_author_posts_link() ?> am <?php the_time('d.m.y') ?> in <?php echo get_the_category_list(', ') ?></p>
		</div>
		<div>
			<?php the_excerpt(); ?>
			<p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Zum Artikel &raquo;</a></p>
		</div>
	</div>