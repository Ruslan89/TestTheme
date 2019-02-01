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
        echo '<h2 class="headline headline--medium">Verwandte Themen zum Artikel:</h2>'; 
        ?>
        
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
			
</div>
	
<?php }
get_footer();
?>