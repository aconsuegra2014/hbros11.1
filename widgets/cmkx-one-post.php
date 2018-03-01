<?php

class cmkxOnePost extends WP_Widget{
    public function __construct(){
	
	// Constructor del Widget.
	$widget_ops = array('classname' => 'cmkx_one_post', 'description' => "Show a title of a post and its featured image." );
	parent::__construct('cmkx_one_post', "cmkx_one_post", $widget_ops);
    }
    

    function widget($args,$instance){
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	$category = !empty($instance[ 'selectedCategory' ]) ? $instance[ 'selectedCategory' ] : '';
	$title = !empty($instance[ 'title' ]) ? $instance[ 'title' ] : '';
	$category_id = get_cat_ID( $category );
	if($category_id != 0)
	  $category_link = get_category_link( $category_id );
    else
		$category_link = '#';
?>
    <div class="one-post">
	<p class="postCategories">
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo $title; ?>"> <?php echo $title; ?></a>
	</p>
	<?php
	$onePost = new WP_Query(array('category_name' => $category,  'posts_per_page' => 1	));
	if ( $onePost->have_posts() ) :
		   $onePost->the_post(); 
	the_post_thumbnail();
	?>
	    <h2>
		<a href="<?php  echo get_permalink(); ?>">
		    <?php the_title(); ?> 
		</a>
	    </h2>
	<?php
	endif;
	wp_reset_postdata();
	?>
    </div>
    <?php
    
    }
    
    function update($new_instance, $old_instance){  
	$instance = $old_instance;
	$instance[ 'selectedCategory' ] = strip_tags( $new_instance[ 'selectedCategory' ] );
	$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	return $instance;
    }
    
    function form($instance){
	$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
	$selectedCategory = ! empty( $instance['selectedCategory'] ) ? $instance['selectedCategory'] : ''; 
	$categories = get_categories();
    ?>
	<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
	    <label for='<?php echo $this->get_field_id( 'selectedCategory' ); ?>'>Category:</label>
	    <select id="<?php echo $this->get_field_id( 'selectedCategory' ); ?>" name="<?php echo $this->get_field_name( 'selectedCategory' ); ?>"> 
		<?php foreach($categories as $category) : ?>
		    <?php if($selectedCategory == $category->name): ?>
			<option value="<?php echo $category->name; ?>" selected="selected">
			    <?php echo $category->name; ?>
			</option>
		    <?php else: ?>
			<option value="<?php echo $category->name; ?>">
    			    <?php echo $category->name; ?>
			</option>
		    <?php endif; ?>
		<?php endforeach; ?>
	    </select>
	</p>
	
    <?php
    }
    
    }