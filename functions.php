<?php
// Adding I18n support
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
    load_theme_textdomain( 'cmkx', get_template_directory() . '/languages' );
    add_image_size( 'cmkx-small', 320, 240 );
    add_image_size( 'cmkx-medium', 450, 338 );
}

/* Add support for post thumbnails */
add_theme_support( 'post-thumbnails' );
/* Add support for html5 */
add_theme_support( 'html5',array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption',) );


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

// Add open graph doctype
function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

// Add open grahp meta
function fb_opengraph() {
    global $post;
    
    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
	    $img_src = $img_src[0];
        } else {
            $img_src = bloginfo('template_directory'). '/assets/images/Bayamo-top-web-1.jpg';
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
?>

<meta property="og:title" content="<?php echo the_title(); ?>"/>
<meta property="og:description" content="<?php echo $excerpt; ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
<meta property="og:image" content="<?php echo $img_src; ?>"/>

<?php
} else {
    return;
}
}
add_action('wp_head', 'fb_opengraph', 5);

/* Add custom class to the_excerpt method */
/*
   function  wpc_custom_excerpt( $excerpt ) {
   $excerpt  =  str_replace (  '<p' ,  '<p class = "clamp"' ,  $excerpt  ) ; 
   return  $excerpt ; 
   } 
   add_filter ( 'the_excerpt' ,   'wpc_custom_excerpt' ) ;
 */


//
function jsonldArticle(){
    global $post;
    
    if(is_single()) {
	if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
	    $img_src = $img_src[0];
        } else {
            $img_src = bloginfo('template_directory'). '/assets/images/Bayamo-top-web-1.jpg';
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = the_excerpt();
        }

	$tags = get_the_tags();
	$keywords = '';
	foreach($tags as $tag)
	$keywords = $keywords. $tag->name .' ';

	$journalist = '';
	$authors = wp_get_post_terms($post->ID, 'autores', array("fields" => "all", 'orderby' => 'name'));
	foreach ($authors as $author)
	$journalist = $author->name;
	if($journalist == '')
	    $journalist = 'Radio Bayamo Digital';
	
	$url = get_permalink();

	$logo = get_template_directory_uri() .'/assets/images/cmkx-digital.jpg';
	echo '<script type="application/ld+json">
       { "@context": "http://schema.org", 
	 "@type": "NewsArticle",
	 "headline": "'. $post->post_title .'",
	 "alternativeHeadline": "'. $excerpt .'",
	 "image": "'. $img_src .'",
	 "author": "'. $journalist .'", 
	 "keywords": "'. $keywords .'", 
	 "publisher": {
             "@context": "http://schema.org",
             "@type": "Organization",
             "name": "CMKX Radio Bayamo Digital",
             "legalName" : "CMKX Radio Bayamo",
             "logo": {
               "@type": "imageObject",
               "url": "'. $logo .'"
             },
             "url": "http://www.radiobayamo.icrt.cu/"
         },
	 "url": "'. $url .'",
         "mainEntityOfPage": "'. $url .'" ,
	 "datePublished": "'. get_the_date('Y-m-d') .'",
	 "dateModified": "'.  $post->post_modified  .'"
       }
</script>';
    }
}
add_action('wp_head', 'jsonldArticle');


/* Adding support for menu */
function register_my_menu() {
    register_nav_menus( array('top-menu' =>   'Top menu',
			      'side-menu' => 'Side menu'
    ));
}
add_action( 'init', 'register_my_menu' );


// Top right widget
register_sidebar(
    array(
	'name'          => __( 'top-right-widget', 'cmkx' ),
	'id'            => 'top-right-widget',
	'description'   => '',
	'class'         => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2 id="top-right-widget">',
	'after_title'   => '</h2>')
);


// Right Sport widget
register_sidebar(
    array(
	'name'          => __( 'right-sport-widget', 'cmkx' ),
	'id'            => 'right-sport-widget',
	'description'   => 'Widget placed at right of sport news',
	'class'         => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2 id="right-sport-widget">',
	'after_title'   => '</h2>')
);

// Right Culture widget
register_sidebar(
    array(
	'name'          => __( 'right-culture-widget', 'cmkx' ),
	'id'            => 'right-culture-widget',
	'description'   => 'Widget placed at right of culture news',
	'class'         => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2 id="right-culture-widget">',
	'after_title'   => '</h2>')
);

// Right Science widget
register_sidebar(
    array(
	'name'          => __( 'right-science-widget', 'cmkx' ),
	'id'            => 'right-science-widget',
	'description'   => 'Widget placed at right of scince news',
	'class'         => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2 id="right-science-widget">',
	'after_title'   => '</h2>')
);

// Right Social widget
register_sidebar(
    array(
	'name'          => __( 'right-social-widget', 'cmkx' ),
	'id'            => 'right-sociale-widget',
	'description'   => 'Widget placed at right of social news',
	'class'         => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2 id="right-social-widget">',
	'after_title'   => '</h2>')
);

// Customizing tag cloud
function widget_custom_tag_cloud($args) {
    // Control number of tags to be displayed - 0 no tags
    $args['number'] = 25;
    $args['largest'] = 25;
    $args['smallest'] = 12;
    $args['unit'] = 'px';

    // Outputs our edited widget
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'widget_custom_tag_cloud' );

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
    <input name="submit" type="submit" id="submit" class="btn" value="'. __("Post Comment") . '" />
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


require_once('widgets/cmkx-real-audio.php');
function cmkx_register_real_audio_widget() { 
    register_widget( 'cmkxRealAudio' );
}
add_action( 'widgets_init', 'cmkx_register_real_audio_widget' );

require_once('widgets/cmkx-specials.php');
function cmkx_register_specials_widget() { 
    register_widget( 'cmkxSpecials' );
}
add_action( 'widgets_init', 'cmkx_register_specials_widget' );

require_once('widgets/cmkx-one-post.php');
function cmkx_register_one_post_widget() {
    register_widget( 'cmkxOnePost' );
}
add_action( 'widgets_init', 'cmkx_register_one_post_widget' );
