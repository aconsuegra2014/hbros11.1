<?php get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div>
	  <?php $categoryTags =  []; ?>
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
<div class="row singlePost">
  <div class=col-md-9>
	    <?php the_content(); ?>

	<hr>
	 <div>
    <h3>Contenido relacionado</h3>
    <?php $tags = wp_get_post_tags($post->ID); ?>
    <?php if ($tags) : ?>
      <?php $tag_ids = array(); ?>
      <?php foreach($tags as $individual_tag) : ?>
	    <?php $tag_ids[] = $individual_tag->term_id; ?>
	  <?php endforeach; ?>
    <?php  $args=array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page'=>4, 'caller_get_posts'=>1 ); ?>
    <?php  $my_query = new wp_query( $args ); ?>
	  <ol class="relatedPosts">
        <?php while( $my_query->have_posts() ) : ?>
          <?php $my_query->the_post(); ?>
          <li>
            <a rel="external" href="<?php the_permalink()?>">
			  <div class="thumbnailContainerRelated zoomImage">
			    <?php the_post_thumbnail(); ?>
			  </div>
              <?php the_title(); ?>
            </a>
          </li>
        <?php endwhile; ?>
	  </ol>
    <?php endif; ?>
       <?php wp_reset_query(); ?>
    </div>
  </div>
  <div class="col-md-3">
  <?php $author = $authors[0]; ?>
  <?php $authorTermId = $author->term_id; ?>
   <?php $authorPhoto = get_term_meta( $authorTermId, 'wpcf-author-photo', true ); ?>
  <div class="author">
	<a href="<?php echo esc_attr(get_term_link($author->name, autores))?>">								
	  <?php echo $author->name ?>
	</a>
	<img src="<?php echo $authorPhoto; ?>" alt="<?php echo $author->name ?>">
      <p>
	  <?php echo $author->description; ?>
	  </p>
  </div>
  <hr>
  <h3 class="fromCover">En portada</h3>
    <?php $main_posts = new WP_Query( array( 'category_name' => 'principal','posts_per_page' => 1 )  ); ?>
  <?php if ( $main_posts->have_posts() ) : ?>
    <?php $mainPost = $main_posts->the_post(); ?>
    <?php if ( has_post_thumbnail($mainPost) ): ?>  
	  <div class="thumbnailContainerInner">
	    <?php the_post_thumbnail($mainPost); ?>
	  </div>
	<?php else: ?>
      <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
	<?php endif; ?>
    <div class="fromCover">
      <a href="<?php echo get_permalink()?>">
		 <?php the_title($mainPost); ?>
	  </a>
    </div>
	<?php endif ?>
  <?php wp_reset_postdata(); ?>
  <hr>
  <h2 class="recentPosts">Publicaciones recientes</h2>
<ul class="list-group">
<?php
	$args = array( 'numberposts' => '5' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li class="list-group-item"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
	}
	wp_reset_query();
?>
</ul>
  </div>
</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
	