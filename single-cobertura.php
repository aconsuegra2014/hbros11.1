<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <div>
	<?php $categoryTags =  array(); ?>
	<?php $postCategories = get_the_category(); ?>
	<?php foreach($postCategories as $pCat) : ?>
	    <?php if( $pCat->slug != 'secundaria' && $pCat->slug != 'principal') : ?>
		<?php $categoryTags[] = $pCat; ?>       
	    <?php endif; ?>
	<?php endforeach; ?>
	<?php  $postTags = get_the_tags(); ?>
	<?php  if( is_array($postTags) ) : ?>
	    <?php $categoryTags = array_merge($categoryTags, $postTags ); ?>
	<?php endif; ?>
	<ol class="tags">
	    <?php $counter = 0; ?>
	    <?php foreach($categoryTags as $tag) : ?>
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
	<h2>
	    <?php the_title(); ?>
	</h2>
	<p class="author">
	    <?php	$authors = wp_get_post_terms($post->ID, 'autores', array("fields" => "all", 'orderby' => 'name')); ?>
	    <?php foreach ($authors as $author) : ?>
		<a href="<?php echo esc_attr(get_term_link($author->name, autores))?>">								
		    <?php echo $author->name ?>
		</a>
	    <?php endforeach; ?>
	    
	</p>				
	<p class="redaction">			
	    <?php $redactions = wp_get_post_terms($post->ID, 'redaccion', array("fields" => "names", 'orderby' => 'name')); ?>
	    <?php foreach ($redactions as $redaction) : ?>
		<a href="<?php echo esc_attr(get_term_link($redaction, redaccion));?>">								
		    <?php echo $redaction;?>
		</a>
	    <?php endforeach; ?>
	</p>
	<p class="date">
	    <?php echo get_the_date(); ?>
	</p>
    

  

    </div>
<?php endwhile; ?>
<div class="row singlePost">
    
	<?php the_content(); ?>

	<?php $postFromCoverage = new WP_Query(
      array(
	  'meta_query' => array(
	    array('key' => '_wpcf_belongs_cobertura_id', 'value' => $post->ID)
	  )
      )

  ); ?>	
  
    <ol id="coverage-posts">
	<?php while ($postFromCoverage->have_posts()) : $postFromCoverage->the_post(); ?>
	<li>
    	<div class="categoryImagePostsContainer">
	      <?php the_post_thumbnail('cmkx-small'); ?>
        </div>
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
	</li>
	 <?php endwhile; ?>
	 <?php wp_reset_query(); ?>
	</ol>	 
	
	<?php if ( comments_open() || get_comments_number() ) : ?>
	    <?php comments_template();  ?>
	<?php endif;  ?>
	
	    
    
</div>


<?php get_footer(); 
