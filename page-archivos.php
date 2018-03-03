<?php get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array( 'post_type' => 'post', 'lang' =>  pll_current_language(), 'posts_per_page' => 12, 'paged' => $paged );
$archive = new WP_Query( $args );
?>	
<div class="row">
    <div class="col-md-12">
	<?php if ( $archive->have_posts() ) : ?>
	    <h2><?php single_cat_title( '', true ); ?></h2>
	    <?php if ( category_description() ) : // Show an optional category description ?>
		<div><?php echo category_description(); ?></div>
	    <?php endif; ?>
	    <?php $colCounter = 0; ?>
	    <?php while (  $archive->have_posts() ) : $archive->the_post(); ?>
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
			<?php the_post_thumbnail('cmkx-small'); ?>
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
	<nav class="post-navigation pagination" role="navigation">
	    <div class="nav-links">
		<ul class="page-numbers">
		    
		    <li>
			<?php next_posts_link( _x('Publicaciones anteriores','cmkx'), $archive->max_num_pages ); ?>
		    </li>
		    <li>
			<?php previous_posts_link( _x('Publicaciones más recientes','cmkx') ); ?>
		    </li>
	    </ul>
	    </div>
	</nav>
    </div>
</div>



<?php 
  wp_reset_postdata(); 
  get_footer(); 