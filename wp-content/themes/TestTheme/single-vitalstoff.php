<?php
get_header();
seitenBanner();

while(have_posts()) {
  the_post();
  ?>

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
          <?php the_content(); ?>
        </div>
        
      </div>  
    </div>
    
    <?php //Fiter für Postausgabe (Vitalstoffe):

        $verwandteHeilmittel = new WP_Query (array(
          'posts_per_page'  => 3,
          'post_type'       => 'vitalstoff', 
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

       if ($verwandteHeilmittel->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Verwandte Heilmittel zu ' . get_the_title() . '</h2>';

        while($verwandteHeilmittel->have_posts()) {
          $verwandteHeilmittel->the_post(); 
          get_template_part('template-parts/content-heilmittel', 'excerpt');    

        } wp_reset_postdata();

       }
  //Postausgabe Filter (Beschwerden)
        $homepageBeschwerden = new WP_Query (array(
          'posts_per_page'  => 3,
          'post_type'       => 'beschwerde', 
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

       if ($homepageBeschwerden->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Verwandte Beschwerden zu ' . get_the_title() . '</h2>';

        while($homepageBeschwerden->have_posts()) {
          $homepageBeschwerden->the_post(); 
          get_template_part('template-parts/content-heilmittel', 'excerpt');

           } wp_reset_postdata();
       }

//Postausgabe Filter (Magazin)
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
        echo '<h2 class="headline headline--medium">Verwandte Magazinbeiträge zu ' . get_the_title() . '</h2>';

        while($verwandterMagazinbeitrag->have_posts()) {
          $verwandterMagazinbeitrag->the_post(); 
          get_template_part('template-parts/content-heilmittel', 'excerpt');

         } wp_reset_postdata();
       }
    ?>
  </div>
  
<?php }
get_footer();
?>