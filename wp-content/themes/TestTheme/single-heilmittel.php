<?php
get_header();
seitenBanner();

while(have_posts()) {
  the_post();
  get_template_part('template-parts/page-header');
?>

  <div class="worko-tabs">
  
    <input class="state" type="radio" title="tab-one"   name="tabs-state" id="tab-one" checked />
    <input class="state" type="radio" title="tab-two"   name="tabs-state" id="tab-two" />
    <input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
    <input class="state" type="radio" title="tab-four"  name="tabs-state" id="tab-four" />

    <div class="tabs flex-tabs">
        <label for="tab-one"    id="tab-one-label"    class="tab"><?php the_field('content_part_1_headline'); ?></label>
        <label for="tab-two"    id="tab-two-label"    class="tab"><?php the_field('content_part_2_headline'); ?></label>
        <label for="tab-three"  id="tab-three-label"  class="tab">Häufig gestellte Fragen</label>
        <label for="tab-four"   id="tab-four-label"   class="tab">Videos</label>


        <div id="tab-one-panel" class="panel active"> 
          <hr class="section-break">            
          <p class="headline headline--medium"><?php the_field('content_part_1_text'); ?></p>
        </div>
        <div id="tab-two-panel" class="panel">
          <hr class="section-break">
          <p class="headline headline--medium"><?php the_field('content_part_2_text'); ?></p>
        </div>
        <div id="tab-three-panel" class="panel">
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_3_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_3_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_4_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_4_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_5_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_5_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_6_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_6_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_7_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_7_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_8_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_8_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_9_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_9_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_10_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_10_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_11_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_11_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_12_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_12_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_13_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_13_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_14_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_14_text'); ?></p>
          <hr class="section-break">
          <h3 class="headline headline--medium-tab"><?php the_field('content_part_15_headline'); ?></h3>
          <p class="headline headline--medium-tab"><?php the_field('content_part_15_text'); ?></p>
        </div>
        <div id="tab-four-panel" class="panel">
              <h3 class="headline headline--medium"><?php the_title(); ?> Videos</h3>
              <?php 
              $video = get_field('content_link_1'); 
              if($video) { ?>
                <p class="headline headline--medium"><?php the_field('video_description_1'); ?></p>
                <?php the_field('content_link_1'); ?>
                <p class="headline headline--medium"><?php the_field('video_description_2'); ?></p>
              <?php } ?>
              <h3 class="headline headline--medium"><i>Noch keine Videos vorhanden</i></h3>            
            </div>
    </div>
  </div> 

  <?php get_template_part('template-parts/page-themen'); ?>
        
        <div>
          <?php 
          // Magazin
          $verwandterMagazinbeitrag = new WP_Query (array(
            'posts_per_page'  => 3,
            'post_type'       => 'post', 
            'orderby'         => 'meta_value_num',
            'order'           => 'ASC',
            'meta_query'      =>  array (
                                    array (
                                      'key'     => 'passendes_heilmittel',
                                      'compare' => 'LIKE',
                                      'value'   => '"' . get_the_ID() . '"'
                                    ),
                                  ),
          ));

            if ($verwandterMagazinbeitrag->have_posts()) {
              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium">Magazin:</h2>';
              while($verwandterMagazinbeitrag->have_posts()) {
                $verwandterMagazinbeitrag->the_post(); 
                get_template_part('template-parts/content-post', 'excerpt');
 
              } wp_reset_postdata();
            }
          ?>
        </div>

        <div>
          <?php  
          // Beschwerden
          $passendeBeschwerde = new WP_Query (array(
            'posts_per_page'  => 3,
            'post_type'       => 'beschwerde', 
            'orderby'         => 'menu_order',
            'order'           => 'ASC',
            'meta_query'      =>  array (
                                    array (
                                      'key'     => 'passendes_heilmittel',
                                      'compare' => 'LIKE',
                                      'value'   => '"' . get_the_ID() . '"'
                                    ),
                                  ),
          )); 

          if ($passendeBeschwerde->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Beschwerden:</h2>';     
            while($passendeBeschwerde->have_posts()) {
              $passendeBeschwerde->the_post(); 
              get_template_part('template-parts/content-beschwerde', 'excerpt');

              } wp_reset_postdata();
            }
          ?>
        </div>

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
          <?php 
            } 
          } ?>
          
          <div>
          <?php  
          // Vitalstoff
          $passenderVitalstoff = new WP_Query (array(
            'posts_per_page'  => 3,
            'post_type'       => 'vitalstoff', 
            'orderby'         => 'menu_order',
            'order'           => 'ASC',
            'meta_query'      =>  array (
                                    array (
                                      'key'     => 'passendes_heilmittel',
                                      'compare' => 'LIKE',
                                      'value'   => '"' . get_the_ID() . '"'
                                    ),
                                  ),
          ));

          if ($passenderVitalstoff->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Vitalstoff:</h2>';     
            while($passenderVitalstoff->have_posts()) {
              $passenderVitalstoff->the_post(); 
              get_template_part('template-parts/content-heilmittel', 'excerpt');

              } wp_reset_postdata();
            }
          ?>
        </div>  
        </div> 
          </div>
          </div>
          </div>
          </div>

    
	
<?php }
get_footer();
?>