<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<style>
		</style>
		<meta charset="<?php bloginfo('charset'); ?>" >
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>> 
	  <header class="site-header">
	    <div class="container">
	      <h1 class="school-logo-text float-left"><a href="<?php echo site_url(); ?>"><strong>Gesundheits</strong> Universum</a></h1>
	      <a href="<?php echo esc_url(site_url('/suche')); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
	      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
	      <div class="site-header__menu group">
	        <nav class="main-navigation">

<!--	        <?php 
	         	wp_nav_menu(array(  							//Dynamisches Menu. Farbmarkierung von 
	         		'theme_location' => 'headerMenuLocation'	//Untermenus ueber CSS Abs5,L18/Fragen
	         	));		
	         ?>  
-->
			<?php 
			if (site_url()) {?>
	          <ul>
	          	<li <?php if (is_page('front-page')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url(); ?>">Startseite</a></li>
	          	<li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/magazin'); ?>">Magazin</a></li>	            
	            <li <?php if (get_post_type() == 'beschwerde') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('beschwerde'); ?>">Beschwerden</a></li>
	            <li <?php if (get_post_type() == 'heilmittel') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('heilmittel'); ?>">Heilmittel</a></li>
	            <!-- <li <?php if (get_post_type() == 'vitalstoff') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('vitalstoff'); ?>">Vitalstoffe</a></li>-->	            
	            <!--//Menu Farbmarkierung: Wenn wir bei "ueber uns" (Seiten Nummer=20/in WP nachschauen) sind, oder auf einer Child Seite, dann wird das Farbschema 'current-menu-item' abgerufen-->
	            <li <?php if (is_page('ueber-uns') or wp_get_post_parent_id(0) == 20) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/ueber-uns'); ?>">Über uns</a></li>
	          </ul>
	     	<?php } ?>
          
	        </nav>
	        <div class="site-header__util">
	          <?php if(is_user_logged_in()) { ?>
	          	<a href="<?php echo esc_url(site_url('/notizen')); ?>" class="btn btn--small btn--orange float-left push-right">Notizen</a>
	          	<a href="<?php echo wp_logout_url(); ?>" class="btn btn--small  btn--dark-orange float-left ">
	          	<!-- btn--with-photo <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>-->
	          	<span class="btn__text">Abmelden</span> 
	          </a>
	          <?php } else { ?>
	          	<a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Anmelden</a>
	          	<a href="<?php echo wp_registration_url(); ?>" class="btn btn--small  btn--dark-orange float-left">Registrieren</a>
	          <?php } ?>
	          
	          
	          <a href="<?php echo esc_url(site_url('/suche')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
	        </div>
	      </div>
	    </div>
	  </header>
