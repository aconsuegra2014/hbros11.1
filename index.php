<?php get_header(); ?>
<?php $culture = 'cultura'; ?>
<?php $society = 'sociedad'; ?>
<?php $sports = 'deportes'; ?>
<?php $science = 'ciencia'; ?>
<?php $scienceCatName='Ciencia y Tecnología' ?>
<?php $specials='especiales'; ?>
<?php $main = 'principal'; ?>
<?php $secondary ='secundaria'; ?>
<?php  if(get_locale() === 'en_US'): ?>
    <?php $culture = 'culture'; ?>
    <?php $society = 'society'; ?>
    <?php $sports = 'sports'; ?>
    <?php $science = 'science-and-technology'; ?>
    <?php $scienceCatName='Science and Technology'; ?>
    <?php $specials='specials'; ?>
    <?php $secondary ='secondary'; ?>
    <?php $main = 'main'; ?>
<?php endif; ?>

<div class='row'>
    <? $postsShown = array(); ?>
    <?php $main_posts = new WP_Query( array( 'category_name' => $main ,'posts_per_page' => 3, 'no_found_rows' => true )  ); ?>
    <div class="col no-gutters">
	<?php if ( $main_posts->have_posts() ) : ?>
            <?php $mainPost = $main_posts->the_post(); ?>
	    <?php $postsShown[] = $post->ID ?>
	    <div class="col-md-12 firstMainPost">
         	<?php if ( has_post_thumbnail() ): ?>  
		    <div class="thumbnailContainer">
			<?php the_post_thumbnail('full'); ?>
		    </div>
	        <?php else: ?>
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		<?php endif; ?>
		
	    </div>
    </div>
    <div class="col-md-custom">
	<div class="mainPostCaption">
	    <h2 class="bold">
		<a href="<?php echo get_permalink(); ?>">
		    <?php the_title(); ?>
		</a>
	    </h2>
   	    <?php  echo the_excerpt(); ?>
	    <p class="date">
		<?php echo get_the_date( 'd/m/Y'); ?>
	    </p>
	</div>
    </div>
    
</div>

<div class="row">
    <div class="col">
	<div class="row">
	    <div class="col-md-6 secondMainPost">
		<?php $main_posts->the_post(); ?>
		<?php $postsShown[] = $post->ID ?>
	        <?php if ( has_post_thumbnail() ): ?>  
		    <div class="secondMainPostThumbnailContainer">
			<?php the_post_thumbnail('cmkx-medium'); ?>
		    </div>
	        <?php else: ?>
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		<?php endif; ?>
		
		<div class="secondMainPostCaption">
		    <h2>
			<a href="<?php echo get_permalink(); ?>">
			    <?php the_title(); ?>
			</a>
		    </h2>
		    <div class="clamp" data-lines="3" >
			<?php  echo the_excerpt(); ?>
		    </div>
		    <p class="date">
		        <?php echo get_the_date( 'd/m/Y'); ?>
		    </p>				
	        </div>
		
	    </div>
	    
	    <div class="col-md-6 thirdMainPost">
		<?php $main_posts->the_post(); ?>
		<?php $postsShown[] = $post->ID ?>
	        <?php if ( has_post_thumbnail() ): ?> 
                    <div class="thirdMainPostThumbnailContainer">			  
			<?php the_post_thumbnail('cmkx-medium'); ?>
		    </div>
	        <?php else: ?>
                    <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		<?php endif; ?>
		<div class="thirdMainPostCaption">
		    <h2>
			<a href="<?php echo get_permalink(); ?>">
			    <?php the_title(); ?>
			</a>
		    </h2>
		    <div class="clamp" data-lines="3">
			<?php  echo the_excerpt(); ?>
		    </div>
		    <p class="date">
		        <?php echo get_the_date( 'd/m/Y'); ?>
		    </p>				
	        </div>
	    </div>
	</div>
    </div>
    <?php wp_reset_postdata(); ?>
    
    <div class="col-md-custom">
	<div id="widget-middle-right-bar">
	    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Top-right-widget')) : else : ?>
		<p>Widget Top right bar
	    <?php endif; ?>
	    <!-- 
		 <a href="#">
		 <img src="<?php bloginfo('template_directory'); ?>/assets/images/cartelera.svg" alt="Cartelera">
		 </a>
	    -->
	</div>
    </div>
    
</div>

	<?php endif; ?>
	<hr>
	<div class="row" id="radioCubana">
	    <a href="http://www.radiocubana.cu/">
		<img src="<?php bloginfo('template_directory'); ?>/assets/images/portal de la radio cubana.jpg" alt="Portal de la radio cubana">
	    </a>
	</div>
	
	<hr>
	<div class="row">
	    <?php $secondaryPosts = new WP_Query( array( 'category_name' => $secondary,'posts_per_page' => 4, 'no_found_rows' => true )  ); ?>
	    <div class="col firstSecondaryPost">
		<?php if ( $secondaryPosts->have_posts() ) : ?>
		    <?php $secondaryPosts->the_post(); ?>
		    <?php $postsShown[] = $post->ID ?>
		    <div class="first-secondary-post-container">
			<?php the_post_thumbnail('full'); ?>
		    </div>
		    <h3 class="bold">
			<a href="<?php echo get_permalink(); ?>">
		            <?php the_title(); ?>
			</a>
		    </h3>
	    </div>
	    
	    <div class="col-md-custom">
		<ol class="list-group secondary-posts">
		    <?php while($secondaryPosts->have_posts() ) : ?>
			<?php $secondaryPosts->the_post(); ?>
			<li  class="list-group-item">
			    <div class="secondaryPostsContainer">
				<?php the_post_thumbnail('cmkx-small'); ?>
			    </div>
			    <h3>
				<a href="<?php echo get_permalink(); ?>">
				    <?php the_title(); ?>
				</a>
			    </h3>
			</li>
		    <?php endwhile; ?>
		</ol>
	    </div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
	<hr>
	<p class="postCategories">
	    <?php $category_link = get_term_link($specials, 'categoria_menu'  );  ?>
	    <a href="<?php echo esc_url( $category_link );  ?>" title="<?php _e('Especiales','cmkx'); ?>"><?php  _e('Especiales','cmkx'); ?></a>
	</p>
	<div class="row index-category-posts">
	    <div class="col-md-6">
		<?php 
		$specials_posts = new WP_Query(array('tax_query' => array(
		    array(
			'taxonomy' => 'categoria_menu',
			'field'    => 'slug',
			'terms'    => $specials,
		    ),
		),
						     'posts_per_page' => 1
						   , 'no_found_rows' => true
		));
		if ( $specials_posts->have_posts() ) :
				  $specials_posts->the_post();
		?>
		    <?php $postsShown[] = $post->ID ?>
		    <div id='index-special-thumbnail-container'>
			<?php the_post_thumbnail('cmkx-medium');  ?>
		    </div>

		<?php endif; ?>
	    </div>
	    <div class="col-md-6">
		<h3>
		    <a href="<?php echo get_permalink(); ?> ">
			<?php echo the_title();  ?>
		    </a>
		</h3>
		<?php the_excerpt(); ?>
		<?php wp_reset_postdata();  ?>
	    </div>
	</div>
	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID( $sports ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Deportes','cmkx'); ?>"><?php _e('Deportes','cmkx'); ?></a>
	</p>
	
	<div class="row index-category-posts">
	    <?php $sportPosts = new WP_Query( array( 'category_name' => $sports,'posts_per_page' => 1, 'post__not_in' => $postsShown, 'no_found_rows' => true )  ); ?>
	    <?php if ( $sportPosts->have_posts() ) : ?>
		<?php $sportPosts->the_post(); ?>
		<?php $postsShown[] = $post->ID ?>
		<div class="col-md-5 culturePosts">
		    <div class="sectionThumbnailContainer">
			<?php the_post_thumbnail('cmkx-medium'); ?>
		    </div>
		</div>
		<div class="col-md-4">
		    <h3 class="bold">
			<a href="<?php echo get_permalink(); ?>">
			    <?php the_title(); ?>
    			</a>
		    </h3>
		    <?php the_excerpt(); ?>
		</div>
		<div class="col-md-3">
		    <a href="http://www.ivoox.com/escuchar-cmkxdigital_nq_288004_1.html">
			<img src="<?php bloginfo('template_directory'); ?>/assets/images/ivoox.png" alt="Canal en ivoox">
		    </a>
		</div>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>

	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID($culture ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Cultura','cmkx'); ?>"><?php _e('Cultura','cmkx'); ?></a>
	</p>
	<div class="row index-category-posts">
	    <?php $culturePosts = new WP_Query( array( 'category_name' => $culture ,'posts_per_page' => 1, 'post__not_in' => $postsShown, 'no_found_rows' => true )  ); ?>
	    <?php if ( $culturePosts->have_posts() ) : ?>
		<?php $culturePosts->the_post(); ?>
		<?php $postsShown[] = $post->ID ?>
		<div class="col-md-5">
		    <div class="sectionThumbnailContainer">
			<?php the_post_thumbnail('cmkx-medium'); ?>
		    </div>
		</div>
		<div class="col-md-4">
		    <h3 class="bold">
			<a href="<?php echo get_permalink(); ?>">
			    <?php the_title(); ?>
    			</a>
		    </h3>
		    <?php the_excerpt(); ?>
		</div>
		<div class="col-md-3">
		    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('right-culture-widget')) : else : ?>
			<p>Widget placed at right of culture news</p>
		    <?php endif; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>
	
	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID($scienceCatName); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Ciencia y Tecnología','cmkx'); ?>"><?php _e('Ciencia y Tecnología','cmkx'); ?></a>
	</p>
	<div class="row index-category-posts">
	    <?php $scincePosts = new WP_Query( array( 'category_name' => $science,'posts_per_page' => 1, 'post__not_in' => $postsShown, 'no_found_rows' => true )  ); ?>
	    <?php if ( $scincePosts->have_posts() ) : ?>
		<?php $scincePosts->the_post(); ?>
		<?php $postsShown[] = $post->ID ?>
		<div class="col-md-5 culturePosts">
		    <div class="sectionThumbnailContainer">
			<?php the_post_thumbnail('cmkx-medium'); ?>
		    </div>
		</div>
		<div class="col-md-4">
		    <h3 class="bold">
			<a href="<?php echo get_permalink(); ?>">
			    <?php the_title(); ?>
    			</a>
		    </h3>
		    <?php the_excerpt(); ?>
		</div>
		<div class="col-md-3">
		    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('right-science-widget')) : else : ?>
			<p>Widget placed at right of science news</p>
		    <?php endif; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>

	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID( $society ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Sociedad','cmkx'); ?>"><?php _e('Sociedad','cmkx'); ?></a>
	</p>
	
	<div class="row index-category-posts">
	    <?php $societyPosts = new WP_Query( array( 'category_name' => $society ,'posts_per_page' => 1, 'post__not_in' => $postsShown, 'no_found_rows' => true )  ); ?>
	    <?php if ( $societyPosts->have_posts() ) : ?>
		<?php $societyPosts->the_post(); ?>
		<?php $postsShown[] = $post->ID ?>
		<div class="col-md-5">
		    <div class="sectionThumbnailContainer">
			<?php the_post_thumbnail('cmkx-medium'); ?>
		    </div>
		</div>
		<div class="col-md-4">
		    <h3 class="bold">
			<a href="<?php echo get_permalink(); ?>">
			    <?php the_title(); ?>
    			</a>
		    </h3>
		    <?php the_excerpt(); ?>
		</div>
		<div class="col-md-3">
		    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('right-social-widget')) : else : ?>
			<p>Widget placed at right of social news</p>
		    <?php endif; ?>	
		</div>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>
	<?php $moreNews = new WP_Query( array( 'posts_per_page' => 6, 'post__not_in' => $postsShown, 'no_found_rows' => true )  ); ?>
	<?php if($moreNews->have_posts()): ?>
	    <hr>
	    <p id="more-news-header" class="postCategories">
		<?php _e('Más noticias','cmkx'); ?>
	    </p>

	    <div id="more-news-body">
		<?php while ( $moreNews->have_posts() ) : $moreNews->the_post(); ?>
		    <div>
			<h4>
			    <a href="<?php echo get_permalink(); ?>">
				<i class="fa fa-newspaper-o" aria-hidden="true"></i> <?php the_title(); ?>
    			    </a>
			</h4>
		    </div>
		<?php endwhile; ?>
	    </div>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	<hr>
	<?php if(get_locale()!='en_US') : ?>
	    <div id="blogs" class="carousel slide" data-ride="carousel" data-interval="9000">
		<div class="carousel-inner row w-100 mx-auto" role="listbox">
		    <div class="carousel-item col-md-4 active">
			<a href="https://cmkxradiobayamo.wordpress.com/">
			    <img class="rounded-circle litle-shadow img-fluid mx-auto d-block" src="<?php bloginfo('template_directory'); ?>/assets/images/cmkx-digital.jpg" />
			</a>
			<script src="http://feeds.feedburner.com/wordpress/cMQQ?format=sigpro" type="text/javascript" ></script>
		    </div>
		    <div class="carousel-item col-md-4">
			<a href="http://solbayamo.blogspot.com/">
			    <img class="rounded-circle litle-shadow img-fluid mx-auto d-block" src="<?php bloginfo('template_directory'); ?>/assets/images/Foto-Yero-blog-100x100.jpg" />
			</a>
			<script src="http://feeds.feedburner.com/blogspot/bWAaF?format=sigpro" type="text/javascript" ></script>
		    </div>
		    <div class="carousel-item col-md-4">
			<a href="https://zonadestrike.wordpress.com/">
			    <img class="rounded-circle litle-shadow img-fluid mx-auto d-block" src="<?php bloginfo('template_directory'); ?>/assets/images/Ibrain-100x100.jpg" />
			</a>
			<script src="http://feeds.feedburner.com/wordpress/gkCD?format=sigpro" type="text/javascript" ></script>
		    </div>
		    <div class="carousel-item col-md-4">
			<a href="https://luistoledosande.wordpress.com/">
			    <img class="rounded-circle litle-shadow img-fluid mx-auto d-block" src="<?php bloginfo('template_directory'); ?>/assets/images/luis-toledo.jpg" />
			</a>
			<script src="http://feeds.feedburner.com/wordpress/UZdf?format=sigpro" type="text/javascript" ></script>
		    </div>
		    <div class="carousel-item col-md-4">
			<a href="http://fidel-elcedro.blogspot.com/">
			    <img class="rounded-circle litle-shadow img-fluid mx-auto d-block" src="<?php bloginfo('template_directory'); ?>/assets/images/david.jpg" />
			</a>
			<script src="http://feeds.feedburner.com/blogspot/PsWNLS?format=sigpro" type="text/javascript" ></script>
		    </div>
		    <div class="carousel-item col-md-4">
			<a href="https://www.espinof.com/">
			    <img class="rounded-circle litle-shadow img-fluid mx-auto d-block" src="<?php bloginfo('template_directory'); ?>/assets/images/icono-cine-100x100.jpg" />
			    <script src="http://feeds.feedburner.com/weblogssl/NINY?format=sigpro" type="text/javascript" ></script>
			</a>
		    </div>
		</div>
		<a class="carousel-control-prev" href="#blogs" role="button" data-slide="prev">
		    <i class="fa fa-chevron-left fa-lg text-muted"></i>
		    <span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next text-faded" href="#blogs" role="button" data-slide="next">
		    <i class="fa fa-chevron-right fa-lg text-muted"></i>
		    <span class="sr-only">Next</span>
		</a>
	    </div>

	    <hr>
	<?php endif; ?>
	<?php $photoReport = new WP_Query( array( 'post_type' => 'foto-reportaje','posts_per_page' => 1, 'lang' => pll_current_language(), 'no_found_rows' => true )  ); ?>
	<?php if($photoReport->have_posts()) : ?>
	    <p class="postCategories">
		<a href="<?php echo get_post_type_archive_link( 'foto-reportaje' ); ?>" title="<?php _e('Fotorreportaje','cmkx'); ?>"><?php _e('Fotorreportaje','cmkx'); ?></a>
	    </p>
	    <div class="row" id="photo-report">
		<div class="col-md-7">
		    <div id="photo-report-container">
			<div id="slider">
			    <?php $photoReport->the_post(); ?>
			    <?php  $gallery =  get_post_gallery($post, false); ?>
			    <?php if ( !empty($gallery) ) : ?>
				<?php $imageIds = explode( ',', $gallery['ids'] ); ?>	 
				<?php $imageCounter = 0; ?>
				<?php foreach($gallery['src'] as $imageUrl) : ?>
				    <?php $alt = get_post_meta( $imageIds[$imageCounter], '_wp_attachment_image_alt', true ); ?>
				    <img src="<?php echo $imageUrl ?>" title="<?php echo $alt ?>" > 
				    <?php $imageCounter++; ?>
				<?php endforeach; ?>
			    <?php endif; ?>
   			</div>
		    </div>
		</div>
		<div class="col-md-5">
		    <h3 class="bold">
			<a href="<?php echo get_permalink(); ?>">
			    <?php echo the_title(); ?>
			</a>
		    </h3>
		    <?php  echo the_excerpt(); ?>
		    <?php wp_reset_postdata(); ?>
		</div>
	    </div>
	    <hr>
	<?php endif; 
	
	get_footer();
