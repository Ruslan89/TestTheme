<?php

if (!is_user_logged_in()) {
  wp_redirect(esc_url(site_url('/')));
  exit;
}

get_header();

while(have_posts()) {
	the_post();
	seitenBanner(array(
		//'subtitle' => 'Hi das ist der statische Untertitel',
	));
?>

  <div class="container container--narrow page-section">

    <div class="create-note">
      <h2 class="headline headline--medium">Neue Notiz</h2>
      <input class="new-note-title" placeholder="Titel">
      <textarea class="new-note-body" placeholder="Deine Notiz..."></textarea>
      <span class="submit-note">Notiz erstellen</span>
      <p>Bitte Fenster aktualisieren, um die neue Notiz zu sehen. Wir arben noch an dem Problem.</p>
      <span class="note-limit-message">Notizen Limit erreicht: Lösche eine alte Notiz, um eine neue erstellen zu können.</span>
    </div>

  	<ul class="min-list link-list id="notizen">
      <?php
        $userNotes = new WP_Query(array(
          'post_type' => 'notiz',
          'posts_per_page' => -1,
          'author'  => get_current_user_id()

        ));

        while($userNotes->have_posts()) {
          $userNotes->the_post(); ?>

          <li data-id="<?php the_ID(); ?>">
            <input readonly class="note-title-field" value="<?php echo str_replace('Private: ', '', esc_attr(get_the_title())); ?>">
            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Bearbeiten</span>
            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Löschen</span>
            <textarea readonly class="note-body-field"><?php echo esc_textarea(get_the_content()); ?></textarea>
            <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Speichern</span>
          </li>

        <?php }

      ?>
    </ul>
  </div>
	
<?php }
get_footer();
?>