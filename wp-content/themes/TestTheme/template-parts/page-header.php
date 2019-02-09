<div class="container container--narrow page-section">

	<div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('heilmittel'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Alle Heilmittel</a> <span class="metabox__main"><?php echo get_the_category_list(', ') ?></span></p>
  </div>

  	<div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('heilmittelPortrait'); ?>
        </div>

        <div class="two-thirds">
          <?php
          likeFunctionHeilmittel();
          ?>

          <h2 class="headline headline--mainBlue"><?php the_title(); ?><strong> Einleitung</strong></h2>
          <?php the_field('main_body_content'); ?>

        </div>
        
      </div>  
      </div>
      
      