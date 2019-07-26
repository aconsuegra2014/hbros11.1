<?php
get_header(); 
$locale = 'es_LA';

if(get_locale() === 'en_US')
    $locale = 'en_US';
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
     js.src = 'https://connect.facebook.net/<?php echo $locale; ?>/sdk.js#xfbml=1&version=v2.12&appId=339397659913070&autoLogAppEvents=1';
     fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));</script>
<?php $main = 'principal'; ?>
<?php  if(get_locale() === 'en_US'): ?>
    <?php $main = 'main'; ?>
<?php endif; ?>
<?php
$positions = array('principal', 'main', 'secundaria', 'secondary','deportes', 'sports', 'cultura', 'culture', 'ciencia', 'science-and-technology', 'sociedad', 'society');
$sections = array( 'deportes', 'sports', 'cultura', 'culture', 'ciencia', 'science-and-technology', 'sociedad', 'society');

?>
<?php while ( have_posts() ) : the_post(); ?>
    <div>
	<?php $categoryTags = array(); ?>
	<?php $postCategories = get_the_category(); ?>
	<?php foreach($postCategories as $pCat) : ?>
	    <?php if( !in_array($pCat->slug,$positions) ) : ?>
		<?php $categoryTags[] = $pCat; ?>       
	    <?php endif; ?>
	    <?php if(in_array($pCat->slug, $sections)) : ?>
		<?php array_unshift($categoryTags,$pCat); ?>
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
	<?php edit_post_link(); ?>
	<h2>
	    <?php the_title(); ?>
	</h2>
	<p class="author">
	    <?php $authors = wp_get_post_terms($post->ID, 'autores', array("fields" => "all", 'orderby' => 'name')); ?>
	    <?php if( !empty($authors) and !is_wp_error($authors) ) : ?>
		<i class="fa fa-pencil"></i>
	   
	      <?php foreach ($authors as $author) : ?>
        	<a href="<?php echo esc_attr(get_term_link($author, 'autores'))?>">								
		      <?php echo $author->name ?>
		  </a>
	      <?php endforeach; ?>
            <?php endif; ?>
	</p>
	<p class="photographer">
	    <?php $photographers = wp_get_post_terms($post->ID, 'fotografo', array("fields" => "all", 'orderby' => 'name')); ?>
	    <?php if( !empty($photographers) and !is_wp_error($photographers) ) : ?>
		<i class="fa fa-camera"></i>
	  
	    <?php foreach ($photographers as $photographer) : ?>
		<a href="<?php echo esc_attr(get_term_link($photographer, 'fotografo'))?>">								
		    <?php echo $photographer->name ?>
		</a>
	    <?php endforeach; ?>
  <?php endif; ?>
	</p>				
	<p class="redaction">			
	    <?php $redactions = wp_get_post_terms($post->ID, 'redaccion', array("fields" => "all", 'orderby' => 'name')); ?>
	    <?php if( !empty($redactions) and !is_wp_error($redactions) ) : ?>
	    <?php foreach ($redactions as $redaction) : ?>
		<a href="<?php echo esc_attr(get_term_link($redaction, 'redaccion')); ?>">								
		    <?php echo $redaction->name; ?>
		</a>
	    <?php endforeach; ?>
  <?php endif; ?>
	</p>
	<p class="date">
	    <?php echo get_the_date(); ?>
	</p>	

    </div>
<?php endwhile; ?>
<div class="row single-post">
    <div class=col-md-9>
	<?php the_content(); ?>
	<div class="fb-like" data-href="<?php the_permalink()?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>

	<?php if ( comments_open() || get_comments_number() ) : ?>
	    <?php comments_template();  ?>
	<?php endif;  ?>
	<hr>
	<div>
	    <h3><?php _e('Contenido relacionado','cmkx'); ?></h3>
	    <?php $tags = wp_get_post_tags($post->ID); ?>
	    <?php if ($tags) : ?>
		<?php $tag_ids = array(); ?>
		<?php foreach($tags as $individual_tag) : ?>
		    <?php $tag_ids[] = $individual_tag->term_id; ?>
		<?php endforeach; ?>
		<?php  $args=array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page'=>4, 'ignore_sticky_posts'=> 1 ); ?>
		<?php  $my_query = new wp_query( $args ); ?>
		<ol class="relatedPosts">
		    <?php while( $my_query->have_posts() ) : ?>
			<?php $my_query->the_post(); ?>
			<li>
			    <a rel="external" href="<?php the_permalink()?>">
				<div class="thumbnailContainerRelated zoomImage">
				    <?php the_post_thumbnail('cmkx-small'); ?>
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
	<h3 class="fromCover"><?php _e('En portada','cmkx'); ?></h3>
	<?php $main_posts = new WP_Query( array( 'category_name' => $main,'posts_per_page' => 1 )  ); ?>
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
	<h2 class="recentPosts"><?php _e('Publicaciones recientes','cmkx'); ?></h2>
	<ol class="list-group">
	    <?php
	    $args = array( 'numberposts' => '5' );
	    $recent_posts = wp_get_recent_posts( $args );
	    foreach( $recent_posts as $recent ){
		echo '<li class="list-group-item"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
	    }
	    wp_reset_query();
	    ?>
	</ol>
	<hr>
	<h2 class="mostRead"><?php _e('Más leidas','cmkx');  ?></h2>
	<ol class="list-group">
        <?php $popular = new WP_Query(array('posts_per_page'=>7, 'meta_key'=>'post_visit_count',
                                            'date_query' => array(array('after' => '-30 days',
                    	                                                'column' => 'post_date' )),
                                            'orderby'=>'meta_value_num', 'order'=>'DESC')); ?>
	    <?php while ($popular->have_posts()) : $popular->the_post(); ?>
		<li class="list-group-item">
		    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>
	    <?php endwhile; ?>
	    <?php wp_reset_postdata(); ?>
	</ol>
    </div>
</div>


<?php get_footer();
