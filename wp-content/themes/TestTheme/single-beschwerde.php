<?php
get_header();
seitenBanner(array(

));

while(have_posts()) {
	the_post();?>

  <div class="container container--narrow page-section">

	<div class="metabox metabox--position-up metabox--with-home-link">
      	<p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('beschwerde'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Alle Beschwerden</a> <span class="metabox__main"><?php echo get_the_category_list(', ') ?></span></p>
    </div>

  	<div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('heilmittelPortrait'); ?>
        </div>

        <div class="two-thirds">

          <h2 class="headline headline--mainBlue"><?php the_title(); ?><strong> Einleitung</strong></h2>
          <?php the_field('main_body_content'); ?>
        </div>      
      </div>  


      <div class="worko-tabs">
  
        <input class="state" type="radio" title="tab-one"   name="tabs-state" id="tab-one" checked />
        <input class="state" type="radio" title="tab-two"   name="tabs-state" id="tab-two" />
        <input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
        <input class="state" type="radio" title="tab-four"  name="tabs-state" id="tab-four" />

        <div class="tabs flex-tabs">
            <label for="tab-one"    id="tab-one-label"    class="tab"><?php the_field('content_part_1_headline'); ?></label>
            <label for="tab-two"    id="tab-two-label"    class="tab"><?php the_field('content_part_2_headline'); ?></label>
            <label for="tab-three"  id="tab-three-label"  class="tab">Heilmittel</label>
            <label for="tab-four"   id="tab-four-label"   class="tab">Videos</label>


            <div id="tab-one-panel" class="panel active">             
              <p class="headline headline--medium"><?php the_field('content_part_1_text'); ?></p>
            </div>
            <div id="tab-two-panel" class="panel">
              <p class="headline headline--medium"><?php the_field('content_part_2_text'); ?></p>
            </div>
            <div id="tab-three-panel" class="panel">
              <h3 class="headline headline--medium"><?php the_field('content_part_3_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_3_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_4_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_4_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_5_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_5_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_6_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_6_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_7_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_7_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_8_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_8_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_9_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_9_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_10_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_10_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_11_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_11_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_12_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_12_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_13_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_13_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_14_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_14_text'); ?></p>
              <h3 class="headline headline--medium"><?php the_field('content_part_15_headline'); ?></h3>
              <p class="headline headline--medium"><?php the_field('content_part_15_text'); ?></p>
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
</div>
  
  	<?php 
  	$passendesHeilmittel = get_field('passendes_heilmittel');

  	if ($passendesHeilmittel) {
	  	echo '<br>', '<br>';
	  	echo '<hr class="section-break">';
	  	echo '<h2 class="headline headline--medium">Passendes Heilmittel</h2>';
	  	echo '<ul class="link-list min-list">';
  	foreach($passendesHeilmittel as $heilmittel) { ?>
  		<li><a href="<?php echo get_the_permalink($heilmittel); ?>"><?php echo get_the_title($heilmittel) ?></a></li>
  	<?php }
  		echo '</ul>';
  	}

    $passendeBeschwerde = get_field('passende_beschwerde');

    if ($passendeBeschwerde) {
      echo '<br>', '<br>';
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Verwandte Beschwerde(n)</h2>';
      echo '<ul class="link-list min-list">';
    foreach($passendeBeschwerde as $beschwerde) { ?>
      <li><a href="<?php echo get_the_permalink($beschwerde); ?>"><?php echo get_the_title($beschwerde) ?></a></li>
    <?php }
      echo '</ul>';
    }

    $passenderArtikel = get_field('passender_artikel');

    if ($passenderArtikel) {
      echo '<br>', '<br>';
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Magazin Artikel</h2>';
      echo '<ul class="link-list min-list">';
    foreach($passenderArtikel as $artikel) { ?>
      <li><a href="<?php echo get_the_permalink($artikel); ?>"><?php echo get_the_title($artikel) ?></a></li>
    <?php }
      echo '</ul>';
    }
  	
  	?>

  </div>
	
<?php }
get_footer();
?>