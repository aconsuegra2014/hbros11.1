<?php get_header(); ?>

<?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>

<?php $coverages = new WP_Query(
    array(
	'meta_query' => array(
	    array('key' => '_wpcf_belongs_cobertura_id', 'value' => $post->ID)
	),
	'posts_per_page' => 12,
	'paged' => $paged
    )

); ?>

<?php $temp_query = $wp_query; ?>
<?php $wp_query = null;  ?>
<?php $wp_query = $coverages; ?>

<div class="row">
    <div class="col-md-12">
	<?php if ( $coverages->have_posts() ) : ?>
	    <h2><?php single_cat_title( '', true ); ?></h2>
	    <?php if ( category_description() ) : // Show an optional category description ?>
		<div><?php echo category_description(); ?></div>
	    <?php endif; ?>
	    <?php $colCounter = 0; ?>
	    <?php while ( $coverages->have_posts() ) : $coverages->the_post(); ?>
		<?php if( $colCounter  == 0) : ?>
		    <?php echo '<div class="row">'; ?>
		<?php endif; ?>
		<div class="col-md-3">
 		    <?php  $postTags = get_the_tags(); ?>
		    <?php if(!is_array($postTags)) : ?>
			<?php $postTags = ['']; ?>
		    <?php endif; ?>
		    <ol class="categoryTags">
			<?php $counter = 0; ?>
			<?php foreach($postTags as $tag) : ?>
			    <li>
				<a href="<?php echo get_tag_link($tag); ?>">
				    <?php if($counter != 0)
					echo ' | ';
				    echo $tag->name; 
				    $counter++;
				    ?>
				</a>
			    </li>
			<?php endforeach;?>
		    </ol>
		    <p class="date category-date">
			<?php echo get_the_date('d/m/Y'); ?>
		    </p>
		    <div class="categoryImagePostsContainer">
			<?php the_post_thumbnail(); ?>
		    </div>
		    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

		</div>
		<?php if( $colCounter == 3  ) : ?>
		    <?php echo '</div>'; ?>
		    <?php $colCounter = 0; ?>
		<?php  else: ?>
		    <?php $colCounter++; ?>
		<?php endif; ?>
	    <?php endwhile; ?>
	    <?php if($colCounter >= 1) : ?>
		<?php echo '</div>'; ?>
	    <?php endif; ?>
	<?php endif; ?>
    </div>
</div>
<?php wp_reset_postdata(); ?>
<div class="row">
    <div class="col-md-12">
	<?php the_posts_pagination( array( 'mid_size' => 2, 'next_text' => 'Siguiente', 'prev_text' => 'Anterior', 'screen_reader_text' => 'a', 'type' => 'list' ) ); ?>
    </div>
</div>

<?php $wp_query = $temp_query  ?>

<?php $wp_query = null;  ?>
<?php $wp_query = temp_query; ?>

<?php get_footer(); ?>
