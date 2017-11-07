<!DOCTYPE html>
<html>
  <head>
    <title><?php bloginfo('name'); ?></title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- FontAwesome -->
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
	
	<link href="<?php bloginfo('template_directory'); ?>/assets/css/jcarousel.connected-carousels.css" rel="stylesheet" media="screen">
		
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_directory'); ?>/assets/js/html5shiv.js"></script>
      <script src="<?php bloginfo('template_directory'); ?>/assets/js/respond.min.js"></script>
    <![endif]-->

      <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
      <?php wp_head(); ?>
  </head>
  <body>
    <div class="container">
	<div class="row">
	  <div class="col-md-12">
	    <h1 class="elegantshadow">
		  <span>Radio</span>
		  <span>Bayamo</span>
		</h1>
		<h1 class="insetshadow">
		  <span>CMKX</span>
		  <span>99.5 FM / 1150 AM</span>
		</div>
	  </div>
	  

	  <div class="row topNavBar"> 	  
	  <div class="col-md-12">
	  <nav class="navbar navbar-expand-lg navBarLight navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
      <?php
            wp_nav_menu( array(
                'menu'              => 'top-menu',
                'theme_location'    => 'top-menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'navbarSupportedContent',
                'menu_class'        => 'navbar-nav mr-auto',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?>
	  <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Buscar">
	  </form>
     
    </nav>
    </div>
  </div>