
<?php get_header(); ?>
<?php  $language = 'es_ES'; ?>
<?php $culture = 'cultura'; ?>
<?php $society = 'sociedad'; ?>
<?php $sports = 'deportes'; ?>
<?php $science = 'ciencia'; ?>
<?php $scienceCatName='Ciencia y Tecnología' ?>
<?php $specials='especiales'; ?>
<?php $main = 'principal'; ?>
<?php $secondary ='secundaria'; ?>
<?php  if(get_locale() === 'en_en'): ?>
    <?php $language = 'en_EN'; ?>
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
    <?php $main_posts = new WP_Query( array( 'category_name' => $main ,'posts_per_page' => 3 )  ); ?>
    <div class="col no-gutters">
	<?php if ( $main_posts->have_posts() ) : ?>
            <?php $mainPost = $main_posts->the_post(); ?>
	    <div class="col-md-12 firstMainPost">
         	<?php if ( has_post_thumbnail() ): ?>  
		    <div class="thumbnailContainer">
			<?php the_post_thumbnail(); ?>
		    </div>
	        <?php else: ?>
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		<?php endif; ?>
		
	    </div>
    </div>
    <div class="col-md-custom">
	<div class="mainPostCaption">
	    <h2 class="bold">
		<a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
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
		<?php $secondMainPost = $main_posts->the_post(); ?>
	        <?php if ( has_post_thumbnail($secondMainPost) ): ?>  
		    <div class="secondMainPostThumbnailContainer">
			<?php the_post_thumbnail($secondMainPost); ?>
		    </div>
	        <?php else: ?>
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		<?php endif; ?>
		
		<div class="secondMainPostCaption">
		    <h2 class="bold">
			<a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
			    <?php the_title($secondMainPost); ?>
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
		<?php $thirdMainPost = $main_posts->the_post(); ?>
	        <?php if ( has_post_thumbnail($thirdMainPost) ): ?> 
                    <div class="thirdMainPostThumbnailContainer">			  
			<?php the_post_thumbnail($thirdMainPost); ?>
		    </div>
	        <?php else: ?>
                    <img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		<?php endif; ?>
		<div class="thirdMainPostCaption">
		    <h2 class="bold">
			<a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
			    <?php the_title($thirdMainPost); ?>
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
    
    <div class="col-md-custom">
	<div id="widget-middle-right-bar">
	    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Top-right-widget')) : else : ?>
		<p>Widget Top right bar
	    <?php endif; ?>
	</div>
    </div>
    
</div>
<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	<hr>
	<div class="row" id="radioCubana">
	    <a href="http://www.radiocubana.cu/">
		<img src="<?php bloginfo('template_directory'); ?>/assets/images/portal de la radio cubana.jpg" alt="Portal de la radio cubana">
	    </a>
	</div>
	
	<hr>
	<div class="row">
	    <?php $secondaryPosts = new WP_Query( array( 'category_name' => $secondary,'posts_per_page' => 4 )  ); ?>
	    <div class="col firstSecondaryPost">
		
		<?php if ( $secondaryPosts->have_posts() ) : ?>
		    <?php $secondaryPosts->the_post(); ?>
		    <div class="firstSecondaryPostContainer">
			<?php the_post_thumbnail(); ?>
		    </div>
		    <h3 class="bold">
			<a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
		            <?php the_title(); ?>
			</a>
		    </h3>
	    </div>
	    
	    <div class="col-md-custom">
		<ol class="list-group secondaryPosts">
		    <?php while($secondaryPosts->have_posts() ) : ?>
			<?php $secondaryPosts->the_post(); ?>
			<li  class="list-group-item">
			    <div class="secondaryPostsContainer">
				<?php the_post_thumbnail(); ?>
			    </div>
			    <h3 class="bold">
				<a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
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
	    <?php   $category_id = get_cat_ID( $sports ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Deportes','cmkx'); ?>"><?php _e('Deportes','cmkx'); ?></a>
	</p>
	
	<div class="row">
	    <?php $sportPosts = new WP_Query( array( 'category_name' => $sports,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $sportPosts->have_posts() ) : ?>
		<?php while ( $sportPosts->have_posts() ) : $sportPosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3 class="bold">
			    <a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
				<?php the_title(); ?>
    			    </a>
			</h3>
		    </div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>

	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID($culture ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Cultura','cmkx'); ?>"><?php _e('Cultura','cmkx'); ?></a>
	</p>
	<div class="row">
	    <?php $culturePosts = new WP_Query( array( 'category_name' => $culture ,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $culturePosts->have_posts() ) : ?>
		<?php while ( $culturePosts->have_posts() ) : $culturePosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3 class="bold">
			    <a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
				<?php the_title(); ?>
    			    </a>
			</h3>
		    </div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>
	
	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID($scienceCatName); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Ciencia y Tecnología','cmkx'); ?>"><?php _e('Ciencia y Tecnología','cmkx'); ?></a>
	</p>
	<div class="row">
	    <?php $scincePosts = new WP_Query( array( 'category_name' => $science,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $scincePosts->have_posts() ) : ?>
		<?php while ( $scincePosts->have_posts() ) : $scincePosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3 class="bold">
			    <a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
				<?php the_title(); ?>
    			    </a>
			</h3>
		    </div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>

	<hr>
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID( $society ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Sociedad','cmkx'); ?>"><?php _e('Sociedad','cmkx'); ?></a>
	</p>
	
	<div class="row">
	    <?php $societyPosts = new WP_Query( array( 'category_name' => $society ,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $societyPosts->have_posts() ) : ?>
		<?php while ( $societyPosts->have_posts() ) : $societyPosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3 class="bold">
			    <a href="<?php echo add_query_arg( 'l', $language ,get_permalink()); ?>">
				<?php the_title(); ?>
    			    </a>
			</h3>
		    </div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	    <?php endif; ?>
	</div>
	<hr>
	<div class="row">
	    <?php dynamic_sidebar( 'bottom-middle-widget' ); ?>
	</div>
	<hr>

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
	<p class="postCategories">
	    <?php   $category_id = get_cat_ID('foto-reportaje'); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Foto reportaje','cmkx'); ?>"><?php _e('Foto reportaje','cmkx'); ?></a>
	</p>
	<div class="row" id="photo-report">

	    <div class="col-md-7">
		<?php $photoReport = new WP_Query( array( 'post_type' => 'foto-reportaje','posts_per_page' => 1 )  ); ?>
		<div id="photo-report-container">
		    <div id="slider">
			<?php if($photoReport->have_posts()) : ?>
			    <?php $p = $photoReport->the_post(); ?>
			    
			    <?php  $gallery =  get_post_gallery($post, false); ?> 
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
		<?php  echo the_excerpt(); ?>
		<?php wp_reset_postdata(); ?>
            </div>
	    
	</div>
	<hr>
	
	<?php get_footer(); ?>
