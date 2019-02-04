<?php 
get_header();
seitenBanner(array(
  'title'     => 'Vitalstoffe',
  'subtitle'  => 'Die Kraft der Natur',
));
?>

<div class="container container--narrow page-section">  

<div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('heilmittel'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Alle Vitalstoffe</a> </p>
    </div>

<?php
while(have_posts()){
  the_post(); ?>
  <div class="post-item">     <!--//Abstand und Rand zwischen jedem Post-->
    <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    <div class="metabox">
      <p><?php echo get_the_category_list(', ') ?></p>
    </div>
    <div>
			<?php if (has_excerpt()) {
				echo get_the_excerpt();
				} else {
				echo wp_trim_words(get_field('main_body_content'), 20);
				} ?>
				<p><a class="btn btn--blue-margin-top" href="<?php the_permalink(); ?>">Zum Vitalstoff &raquo;</a></p>
			</div>
  </div>
<?php }

echo paginate_links();

?>
</div>

<?php
get_footer();
?>