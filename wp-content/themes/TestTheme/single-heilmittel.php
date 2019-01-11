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

<!--    <ul class="collapsible" data-collapsible="accordion">
      <li>
        <div class="collapsible-header">Header1</div>
        <div class="collapsible-body">Text1</div>
      </li>
      <li>
        <div class="collapsible-header">Header1</div>
        <div class="collapsible-body">Text1</div>
      </li>
    </ul>
-->
  	<div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('heilmittelPortrait'); ?>
        </div>

        <div class="two-thirds">
          <?php

          likeFunction();
          ?>

          <?php the_field('main_body_content'); ?>
        </div>
        
      </div>  
  	</div>
    
    <?php 

//Verwandte Heilmittel:
    $passendesHeilmittel = get_field('passendes_heilmittel');

    if ($passendesHeilmittel) {
      echo '<br>', '<br>';
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Verwandtes Heilmittel</h2>';
      echo '<ul class="link-list min-list">';
    foreach($passendesHeilmittel as $heilmittel) { ?>
      <li><a href="<?php echo get_the_permalink($heilmittel); ?>"><?php echo get_the_title($heilmittel) ?></a></li>
    <?php }
      echo '</ul>';
    }

  //Verwandte Beschwerden
        $passendeBeschwerde = new WP_Query (array(
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

       if ($passendeBeschwerde->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Verwandte Beschwerden zu ' . get_the_title() . '</h2>';

        while($passendeBeschwerde->have_posts()) {
          $passendeBeschwerde->the_post(); 
          get_template_part('template-parts/content-heilmittel', 'excerpt');

           } wp_reset_postdata();
       }

//Verwandte Magazinbeiträge
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