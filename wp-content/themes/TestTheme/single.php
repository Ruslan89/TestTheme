<?php
get_header();
seitenBanner();

while(have_posts()) {
	the_post();?>

  <div class="container container--narrow page-section">

	<div class="metabox metabox--position-up metabox--with-home-link">
      	<p><a class="metabox__blog-home-link" href="<?php echo site_url('/magazin') ?>"><i class="fa fa-home" aria-hidden="true"></i> Magazin</a> <span class="metabox__main">Geschrieben von <?php the_author_posts_link() ?> am <?php the_time('d.m.y') ?> in <?php echo get_the_category_list(', ') ?></span></p>
    </div>

  	<div class="generic-content">
  		<p><?php the_content(); ?></p>
  	</div>
  </div>
	
<?php }
get_footer();
?>