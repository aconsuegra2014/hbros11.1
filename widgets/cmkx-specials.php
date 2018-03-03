<?php

class cmkxSpecials extends WP_Widget{
    public function __construct(){
	
	// Constructor del Widget.
	$widget_ops = array('classname' => 'cmkx_specials', 'description' => "Specials works" );
	parent::__construct('cmkx_specials', "cmkx_specials", $widget_ops);
    }
    

    function widget($args,$instance){
	$specials='especiales';
	if(get_locale() === 'en_US'):
		  $specials='specials';
	endif;
	
	
    	echo '<div class="specials">';
	echo '<p class="postCategories">';
	$category_link = get_term_link($specials, 'categoria_menu'  );
	echo '<a href="'. esc_url( $category_link ) .'" title="'. __('Especiales','cmkx') .'">'. __('Especiales','cmkx').'</a>';
	echo '</p>';
	
	$specials_posts = new WP_Query(array('tax_query' => array(
	    array(
		'taxonomy' => 'categoria_menu',
		'field'    => 'slug',
		'terms'    => $specials,
	    ),
	),
					     'posts_per_page' => 1
	));
	if ( $specials_posts->have_posts() ) :
			  $specials_posts->the_post(); 
	the_post_thumbnail('cmkx-medium');
	echo '<h2>';
	echo '<a href="'. get_permalink() .'">';
	echo the_title();
	echo '</a>';
	echo '</h2>';
	endif;
	wp_reset_postdata();
	echo '</div>';
	
    }
    
    function update($new_instance, $old_instance){       
    }
    
    function form($instance){  
    }

}
