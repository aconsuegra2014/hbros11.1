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

