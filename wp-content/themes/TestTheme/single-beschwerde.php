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

  	<?php 
  	likeFunction();
  	?>
  		<?php the_field('main_body_content'); ?>
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