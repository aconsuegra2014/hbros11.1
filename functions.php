<?php
function additional_js()
{
  wp_enqueue_script('jquery');
  wp_print_scripts();


}
add_action('wp_head','additional_js');

/* Add support for post thumbnails */
add_theme_support( 'post-thumbnails' ); 

/* Add custom class to the_excerpt method */
/*
function  wpc_custom_excerpt( $excerpt ) {
 $excerpt  =  str_replace (  '<p' ,  '<p class = "clamp"' ,  $excerpt  ) ; 
 return  $excerpt ; 
} 
add_filter ( 'the_excerpt' ,   'wpc_custom_excerpt' ) ;
*/

/* Adding support for menu */
function register_my_menu() {
  register_nav_menu('top-menu',__( 'Top menu' ));
}
add_action( 'init', 'register_my_menu' );

// Register Custom Navigation Walker
    require_once 'D:\wamp\www\wordpress\wp-content\themes\AconsuegraCmk\wp-bootstrap-navwalker.php';

// Adding class to links in top menu	
function add_specific_link_class( $atts, $item, $args ) {
    // check if the item is in the top menu
    if( $args->theme_location == 'top-menu' ) {
      // add the desired attributes:
      $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_link_class', 10, 3 );	

// Adding class to li items in top menu	
function add_specific_li_class( $classes, $item, $args ) { 
      if( $args->theme_location == 'top-menu' ) {
	    $classes = array('nav-item');
	  }
	  return $classes;
}

add_filter( 'nav_menu_css_class', 'add_specific_li_class', 10, 4 ); 

