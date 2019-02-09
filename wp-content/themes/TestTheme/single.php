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
  

	<div class="generic-content">
    <div class="row group">
      <?php 
      echo '<br>';
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium-center">Verwandte Themen zum Artikel</h2>'; 
      ?>

      <?php 
      // Heilmittel
          $passendesHeilmittel = get_field('passendes_heilmittel');

          if ($passendesHeilmittel) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium-centered">Heilmittel:</h2>';
            echo '<br>', '<br>', '<br>', '<br>';
          foreach($passendesHeilmittel as $heilmittel) { ?>
            <div class="row group">
              <div class="one-third">
                  <?php echo get_the_post_thumbnail($heilmittel); ?>
            </div>
              
            <div class="post-item"> 		
              <h2 class="headline headline--medium headline--post-title"><a href="<?php echo get_the_permalink($heilmittel); ?>"><?php echo get_the_title($heilmittel); ?></a></h2>

              <div class="metabox">
                <p><?php echo get_the_category_list(', ') ?></p>
              </div>

              <div>
                <?php if (has_excerpt()) {
                  echo get_the_excerpt();
                  } else {
                  echo wp_trim_words(get_field('main_body_content'), 20); 
                  } ?>
                  <p><a class="btn btn--blue-margin-top" href="<?php echo get_the_permalink($heilmittel); ?>">Lesen &raquo;</a></p>
              </div>
            </div>
                </div>
          <?php 
            } 
        } ?>

        <?php 
      // Beschwerde
          $passendeBeschwerde = get_field('passende_beschwerde');

          if ($passendeBeschwerde) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium-centered">Beschwerde(n):</h2>';
            echo '<br>', '<br>', '<br>', '<br>';
          foreach($passendeBeschwerde as $beschwerde) { ?>
            <div class="row group">
              <div class="one-third">
                  <?php echo get_the_post_thumbnail($beschwerde); ?>
            </div>
              
            <div class="post-item"> 		
              <h2 class="headline headline--medium headline--post-title"><a href="<?php echo get_the_permalink($beschwerde); ?>"><?php echo get_the_title($beschwerde); ?></a></h2>

              <div class="metabox">
                <p><?php echo get_the_category_list(', ') ?></p>
              </div>

              <div>
                <?php if (has_excerpt()) {
                  echo get_the_excerpt();
                  } else {
                  echo wp_trim_words(get_field('main_body_content'), 20); 
                  } ?>
                  <p><a class="btn btn--blue-margin-top" href="<?php echo get_the_permalink($beschwerde); ?>">Lesen &raquo;</a></p>
              </div>
            </div>
            </div>
          <?php 
            } 
        } ?>

      <?php 
      // Vitalstoff
          $passenderVitalstoff = get_field('passender_vitalstoff');

          if ($passenderVitalstoff) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium-centered">Vitalstoff(e):</h2>';
            echo '<br>', '<br>', '<br>', '<br>';
          foreach($passenderVitalstoff as $vitalstoff) { ?>
            <div class="row group">
              <div class="one-third">
                  <?php echo get_the_post_thumbnail($vitalstoff); ?>
            </div>
              
            <div class="post-item"> 		
              <h2 class="headline headline--medium headline--post-title"><a href="<?php echo get_the_permalink($vitalstoff); ?>"><?php echo get_the_title($vitalstoff); ?></a></h2>

              <div class="metabox">
                <p><?php echo get_the_category_list(', ') ?></p>
              </div>

              <div>
                <?php if (has_excerpt()) {
                  echo get_the_excerpt();
                  } else {
                  echo wp_trim_words(get_field('main_body_content'), 20); 
                  } ?>
                  <p><a class="btn btn--blue-margin-top" href="<?php echo get_the_permalink($vitalstoff); ?>">Lesen &raquo;</a></p>
              </div>
            </div>
                </div>
          <?php 
            } 
        } ?>

        <?php 
          // Magazin
          $verwandterMagazinbeitrag = new WP_Query (array(
            'posts_per_page'  => 3,
            'post_type'       => 'post', 
            'orderby'         => 'meta_value_num',
            'order'           => 'ASC',
            'meta_query'      =>  array (
                                    array (
                                      'key'     => 'passender_artikel',
                                      'compare' => 'LIKE',
                                      'value'   => '"' . get_the_ID() . '"'
                                    ),
                                  ),
          ));

            if ($verwandterMagazinbeitrag->have_posts()) {
              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium">Magazin</h2>';
              while($verwandterMagazinbeitrag->have_posts()) {
                $verwandterMagazinbeitrag->the_post(); 
                get_template_part('template-parts/content-post', 'excerpt');
 
              } wp_reset_postdata();
            }
          ?>
        </div>
                      
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
	
<?php }
get_footer();
?>