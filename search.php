<?php get_header(); ?>

<div class="row">
    <div class="col-md-12">
	<?php if ( have_posts() ) : ?>
	    <h2><?php single_cat_title( '', true ); ?></h2>
	    <?php if ( category_description() ) : // Show an optional category description ?>
		<div><?php echo category_description(); ?></div>
	    <?php endif; ?>
	    <?php $colCounter = 0; ?>
	    <?php while ( have_posts() ) : the_post(); ?>
		<?php if( $colCounter  == 0) : ?>
		    <?php echo '<div class="row">'; ?>
		<?php endif; ?>
		<div class="col-md-3">
 		    <?php  $postTags = get_the_tags(); ?>
		    <?php if(!is_array($postTags)) : ?>
			<?php $postTags = array(); ?>
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

<div class="row">
    <div class="col-md-12">
	<?php the_posts_pagination( array( 'mid_size' => 2, 'next_text' => 'Siguiente', 'prev_text' => 'Anterior', 'screen_reader_text' => 'a', 'type' => 'list' ) ); ?>
    </div>
</div>
<?php get_footer(); 