<?php
get_header();

while(have_posts()) {
	the_post();
	seitenBanner(array(

	));
?>

  <div class="container container--narrow page-section">
  	<?php
  		$ParentPageID = wp_get_post_parent_id(get_the_ID());
  		if ($ParentPageID) { //Parentpage ID. 0=Parentpage: if=0=false 
  		?>
  		<div class="metabox metabox--position-up metabox--with-home-link">
      	<p><a class="metabox__blog-home-link" href="<?php echo get_permalink ($ParentPageID) ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo get_the_title($ParentPageID); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
  		<?php }
  	?>

 	<?php //Seitenmenu nur fuer Seiten, die eine Parentpage haben, oder eine Parentpage sind
 	$ParentTest = get_pages(array(			//Bedingung stimmt, wenn Seite Children hat
 		'child_of' => get_the_ID()
 	));

 	if ($ParentPageID or $ParentTest) {?> 
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_the_permalink($ParentPageID); ?>"><?php echo get_the_title($ParentPageID); ?></a></h2>
      <ul class="min-list">
        <?php
        if ($ParentPageID) {
        	$findChildrenOf = $ParentPageID;

        } else {
        	$findChildrenOf = get_the_ID();
        }
        wp_list_pages(array(				//Der Zugriff auf die Liste aller Seiten
        	'title_li' => NULL,				//Der Name der Liste soll ausgeblendet werden
        	'child_of' => $findChildrenOf,	//Alle Child Seiten der Hauptseite 
        ));
        ?>
      </ul>
    </div>
	<?php }?>

    <div class="generic-content">			<!--//Der Content soll ausgegeben werden -->
      <form class="search-form" method="get" action="<?php echo esc_url(site_url('/')) ?>">
        <label class="headline headline--medium" for="s">Neue Suche starten:</label>
        <div class="search-form-row">
        <input placeholder="Wo nach suchst du?" class="s" id="s" type="search" name="s">
        <input class="search-submit" type="submit" value="Suchen">
      </form>
    </div>

  </div>
	
<?php }
get_footer();
?>v