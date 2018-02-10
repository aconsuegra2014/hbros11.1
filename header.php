<!DOCTYPE html>
<html>
  <head>
    <title><?php bloginfo('name'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="r-VDsjyVuLh9T70QG8SlznY_fOTqlehAc3QSXWfcEAs" />
    <!-- External fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- FontAwesome -->
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
    
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/jcarousel.connected-carousels.css" rel="stylesheet" media="screen">
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/bloggers-carousel.css" rel="stylesheet" media="screen">
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/feedburner.css" rel="stylesheet" media="screen">
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/slider.css" rel="stylesheet" media="screen">
    
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
      <div id="top-radio-station">
	<div>
	  <h1 class="radio-station">
	    <span>CMKX</span>
	    <span>RADIO</span>
	    <span>BAYAMO</span>
	    <span>99.5 y 107.9 FM / 1150 AM</span>
	  </h1>
	</div>
	<div>
	  <ol class="social-media">
	    <li >
	      <a id="cmkx-audio-control" href="#">
		<img id="real-audio-ico" src="<?php bloginfo('template_directory'); ?>/assets/images/radio.png">
	      </a>
	    </li>
	    <li>
	      <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
	    </li>
	    <li>
	      <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
	    </li>
	    <li>
	      <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
	    </li>
	    <li>
	      <a href="#"><i class="fa fa-youtube-square fa-2x"></i></a>
	    </li>
	    <li>
	      <a href="#"><i class="fa fa-rss-square fa-2x"></i></a>
	    </li>
	  </ol>
	</div>
	
	<div class="topNavBar"> 	  
	  <nav class="navbar navbar-expand-lg navBarLight navbar-light">
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    
	    <?php
	      wp_nav_menu(array(
	      'theme_location' => 'top-menu',
	    'depth' => 2,
	'menu' => 'top-menu',
	'container' => 'div',
	'container_class'   => 'collapse navbar-collapse',
	'container_id'      => 'navbarSupportedContent',
	'menu_class'        => 'navbar-nav mr-auto',
	'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
	'walker'            => new WP_Bootstrap_Navwalker()
	)
	);
	?>
	    <?php get_search_form(); ?>
	  </nav>
	</div>
	
	
      </div>
      
      <img id="top-bayamo" src="<?php bloginfo('template_directory'); ?>/assets/images/Bayamo-top-web-<?php echo rand(1,3); ?>.jpg" alt="Bayamo">
      
      

      <?php get_template_part("coverage"); ?>
