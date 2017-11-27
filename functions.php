<?php
// CHANGE LOCAL LANGUAGE
// must be called before load_theme_textdomain()
add_filter( 'locale', 'my_theme_localized' );
function my_theme_localized( $locale )
{
    if ( isset( $_GET['l'] ) )
    {
	return sanitize_key( $_GET['l'] );
    }

    return $locale;
}

// Adding I18n support
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
    load_theme_textdomain( 'cmkx', get_template_directory() . '/languages' );
}

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
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.3.2.1.min.js', array(), null, true);
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), null, true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), null, true);
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
//require_once 'D:\wamp\www\wordpress\wp-content\themes\AconsuegraCmk\class-wp-bootstrap-navwalker.php';
// Register Custom Navigation Walker
require_once('class-wp-bootstrap-navwalker.php');

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

// Adding boostrap style to comment's form
function bootstrap4_comment_form_fields() {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="form-group"><label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                  '<input class="form-control" id="author" name="author" required="required" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="300"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                  '<input class="form-control" required="required" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>');

    $defaults = array($fields);
    return $fields;
}
add_filter( 'comment_form_default_fields', 'bootstrap4_comment_form_fields',10 , 0 );

function boostrap4_comment_form_field_comment(){
    return '<p><label for="comment">' . _x( 'Comment', 'noun' ) . ' *</label><textarea class="form-control" required="required"id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
}
add_filter( 'comment_form_field_comment', 'boostrap4_comment_form_field_comment', 10 ,0 );

function boostrap4_comment_form_submit_button(){
    return '<div class="form-group">
    <input name="submit" type="submit" id="submit" class="btn" value="Post Comment" />
    </div>';
}
add_filter( 'comment_form_submit_button', 'boostrap4_comment_form_submit_button', 10 ,0 );


/*
   // Create Custom Post Type for Work
   add_action( 'init', 'create_coverage_post_type' );
   function create_coverage_post_type() {
   register_post_type( 'coverage',
   array(
   'labels' => array(
   'name' => __( 'Coverage' ),
   'singular_name' => __( 'Coverage' )
   ),
   'supports' => array('title', 'editor','thumbnail','page-attributes'),
   'hierarchical' => true,
   'public' => true,
   'has_archive' => true,
   'rewrite' => array('slug' => 'coverage'),
   'taxonomies' => array('category', 'post_tag')
   )
   );
   }
 */
