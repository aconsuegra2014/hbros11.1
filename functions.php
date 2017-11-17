<?php

/*
   Remove Unwanted Links and Tags From WordPress Head
 */

// remove the meta generator WP version tag
remove_action( 'wp_head', 'wp_generator' );

// remove rel="EditURI" link. USEFUL TO REMOVE THIS FOR SECURITY.
remove_action( 'wp_head', 'rsd_link' );

// remove the link rel="wlwmanifest"
remove_action( 'wp_head', 'wlwmanifest_link' ); 

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
    register_nav_menus( array('top-menu' =>   'Top menu',
                              'side-menu' => 'Side menu'
    ));
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
function add_specific_li_class_to_top_menu( $classes, $item, $args ) { 
    if( $args->theme_location == 'top-menu' ) {
	$classes = array('nav-item');
    }
    return $classes;
}

add_filter( 'nav_menu_css_class', 'add_specific_li_class_to_top_menu', 10, 3 ); 

// Adding class to li items in side menu	
function add_specific_li_class_to_side_menu( $classes, $item, $args ) { 
    if( $args->theme_location == 'side-menu' ) {
	$classes = array('list-group-item');
    }
    return $classes;
}

add_filter( 'nav_menu_css_class', 'add_specific_li_class_to_side_menu', 10, 3 );

// Remove screen text reader in post navigation (pagination)
function remove_screen_reader_text_post_navigation(){
	$template= '<nav class="post-navigation %1$s" role="navigation">
	<div class="nav-links">%3$s</div>
	</nav>';

    return $template;
}
add_filter( 'navigation_markup_template', 'remove_screen_reader_text_post_navigation', 10, 0 );

// Set post count visit metadata
function set_popular_post($postID) {
    $count_key = 'post_visit_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// Counting popular post
function count_popular_post($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
	global $post;
	$post_id = $post->ID;
    }
    set_popular_post($post_id);
}
// Inserting 'count_popular_post' function in head of single posts.
add_action( 'wp_head', 'count_popular_post');

