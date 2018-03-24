<?php

$topWebImageNumber = null;
if( isset( $_COOKIE["top-web-image-number"] ) ){
    $topWebImageNumber = $_COOKIE["top-web-image-number"];
    $topWebImageNumber = $topWebImageNumber >= 3 ? 1 : $topWebImageNumber + 1;
}
else
    $topWebImageNumber = 1;

setcookie("top-web-image-number", $topWebImageNumber);
?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="r-VDsjyVuLh9T70QG8SlznY_fOTqlehAc3QSXWfcEAs" />
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	    <script src="<?php bloginfo('template_directory'); ?>/assets/js/html5shiv.js"></script>
	    <script src="<?php bloginfo('template_directory'); ?>/assets/js/respond.min.js"></script>
	<![endif]-->

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
	    <span>99.5 y 107.9 FM</span>
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
	      <a href="https://www.facebook.com/RadioBayamo/">
		<i class="fa fa-facebook-square fa-2x"></i>
	      </a>
	    </li>
	    <li>
	      <a href="https://twitter.com/cmkxdigital">
		<i class="fa fa-twitter-square fa-2x"></i>
	      </a>
	    </li>
	    <li>
	      <a href="https://plus.google.com/u/0/+RadioBayamo">
		<i class="fa fa-google-plus-square fa-2x"></i></a>
	    </li>
	    <li>
	      <a href="https://www.youtube.com/channel/UCaemmbo3ws7AuTz8A3dzY3Q">
		<i class="fa fa-youtube-square fa-2x"></i>
	      </a>
	    </li>
	    <li>
	      <a href="<?php bloginfo('atom_url'); ?>">
		<i class="fa fa-rss-square fa-2x"></i>
	      </a>
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
      
      <img id="top-bayamo" src="<?php bloginfo('template_directory'); ?>/assets/images/Bayamo-top-web-<?php echo $topWebImageNumber; ?>.jpg" alt="Bayamo">
      <hr>
      
      <?php if(is_front_page() && is_home()): 
	  get_template_part("coverage"); 
      endif; 
