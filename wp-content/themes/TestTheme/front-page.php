<?php
get_header(); 
?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg'); ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Willkommen!</h1>
      <h2 class="headline headline--medium">Lerne dich selbst zu heilen</h2>
      <h3 class="headline headline--small">Drücke "S" für die Suche</h3>
      <a href="#" class="btn btn--large btn--blue">Suche öffnen</a>
    </div>
  </div>

  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Bisher gelistete Beschwerden</h2>
        
        <?php 
        $homepageBeschwerden = new WP_Query (array(
          'posts_per_page'  => 3,
          'post_type'       => 'beschwerde',
          'orderby'        => 'menu_order',
          'order' => 'ASC'
        ));

        while($homepageBeschwerden->have_posts()) {
          $homepageBeschwerden->the_post(); ?>
        
        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php site_url(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            
            <p><?php if (has_excerpt()) {
              echo get_the_excerpt();
            } else {
              echo wp_trim_words(get_field('main_body_content'), 20);
            } ?>
			<p><a class="btn btn--blue-margin-top" href="<?php the_permalink(); ?>">Lesen &raquo;</a></p>
          </div>
        </div>

        <?php } wp_reset_postdata();
        ?>
        
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('beschwerde'); ?>" class="btn btn--blue">Alle Beschwerden</a></p>

      </div>
    </div>

    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">GU Magazin</h2>
        <?php
          $homepagePosts = new WP_Query (array(             
            'posts_per_page' => 2,                          
          ));

          while ($homepagePosts->have_posts()) {            
            $homepagePosts->the_post(); ?>
            
          <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            
            <p><?php if (has_excerpt()) {
              echo get_the_excerpt();
            } else {
              echo wp_trim_words(get_the_content(), 20);
            } ?><a href="<?php the_permalink(); ?>" class="nu gray">Lesen</a></p>
          </div>
        </div>

          <?php } wp_reset_postdata();
        ?>

        <p class="t-center no-margin"><a href="<?php echo site_url('/magazin') ?>" class="btn btn--yellow">Alle Artikel</a></p>
      </div>
    </div>
  </div>   
  
  <div class="hero-slider">
  <?php 
  $homepageBeschwerden = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'heilmittel',
    'order' => 'ASC',
  ));

  while($homepageBeschwerden->have_posts()) {
    $homepageBeschwerden->the_post(); ?>

  
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center"><?php the_title(); ?></h2>
        <p class="t-center"><?php if (has_excerpt()) {
              echo get_the_excerpt();
            } else {
              echo wp_trim_words(get_field('main_body_content'), 20);
            } ?></p>
        <p class="t-center no-margin"><a href="<?php the_permalink(); ?>" class="btn btn--blue">Mehr erfahren</a></p>
      </div>
    </div>
  </div>

  <?php }
  ?>
</div>

	
<?php 
get_footer();
?>