<?php get_header(); ?>

<div class="row">
  <div class="col-md-9">
		<?php if ( have_posts() ) : ?>
		<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>
		<?php if ( category_description() ) : // Show an optional category description ?>
          <div class="archive-meta"><?php echo category_description(); ?></div>
		<?php endif; ?>
	
		<?php while ( have_posts() ) : the_post(); ?>
		<div id="bloquearchivo">
		<div id="cattag" >
    	<span class="categories"><?php _e('', 'ejemplo'); ?> <?php the_category(', '); ?></span>
		<?php the_tags('<span class="tags"> <span class="sep">|</span> ' . __('', 'ejemplo') . ' ', ', ', '</span>'); ?>									
		</div>
		<div id="principal_container_title">
		<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		</div >
	    <?php
        // Get the ID of a given category
        $category_id = get_cat_ID( 'Category Name' );

        // Get the URL of this category
        $category_link = get_category_link( $category_id );
?>

<!-- Print a link to this category -->
<a href="<?php echo esc_url( $category_link ); ?>" title="Category Name">Category Name</a><?php
    // Get the ID of a given category
    $category_id = get_cat_ID( 'Category Name' );

    // Get the URL of this category
    $category_link = get_category_link( $category_id );
?>

<!-- Print a link to this category -->
<a href="<?php echo esc_url( $category_link ); ?>" title="Category Name">Category Name</a>								

					<div id="principal_container_texto">
						<?php the_excerpt() ; ?>										
					</div > 
				</div>	
			<?php endwhile; ?>			
		<?php endif; ?>
  </div>
  <div class="col-md-3">
  </div>
</div>
	
<?php get_footer(); ?>