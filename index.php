
<?php get_header(); ?>
<?php $culture = 'cultura'; ?>
<?php $society = 'sociedad'; ?>
<?php $sports = 'deportes'; ?>
<?php $science = 'ciencia'; ?>
<?php $scienceCatName='Ciencia y Tecnología' ?>
<?php $specials='especiales'; ?>
<?php $main = 'principal'; ?>
<?php $secondary ='secundaria'; ?>
<?php  if(get_locale() === 'en'): ?>
    <?php $culture = 'culture'; ?>
    <?php $society = 'society'; ?>
    <?php $sports = 'sports'; ?>
    <?php $science = 'science-and-technology'; ?>
    <?php $scienceCatName='Science and Technology'; ?>
    <?php $specials='specials'; ?>
    <?php $secondary ='secondary'; ?>
    <?php $main = 'main'; ?>
<?php endif; ?>

<div class='row no-gutters'>
    <?php $main_posts = new WP_Query( array( 'category_name' => $main ,'posts_per_page' => 3 )  ); ?>
    <div class="col">
	<?php if ( $main_posts->have_posts() ) : ?>
            <div class="row">
		<?php $mainPost = $main_posts->the_post(); ?>
	        <div class="col-md-12 firstMainPost">
         	    <?php if ( has_post_thumbnail($mainPost) ): ?>  
			<div class="thumbnailContainer">
			    <?php the_post_thumbnail($mainPost); ?>
			</div>
	            <?php else: ?>
			<img src="<?php bloginfo('template_directory'); ?>/assets/images/fondo.png" alt="...">
		    <?php endif; ?>
		    <div class="mainPostCaption">
			<h2 class="bold">
			    <a href="<?php echo get_permalink()?>">
				<?php the_title($mainPost); ?>
			    </a>
			</h2>
   			<?php  echo the_excerpt(); ?>
			<p class="date">
		            <?php echo get_the_date( 'd/m/Y'); ?>
			</p>
		    </div>
		</div>
	    </div>
    </div>
    <div class="col-md-custom">
	<section>
	    <?php $currentCoverage = new WP_Query( array( 'post_type' => 'cobertura', 'posts_per_page' => 1,
							  'meta_query' => array(
							      array(
								  'key'     => 'wpcf-activate-coverage',
								  'value'   => 1
							      )
							  )
	    ) ); ?>

	    <?php $coverageId = 0;  ?>
	    <?php if($currentCoverage->have_posts()) : ?>
		<?php  $currentCoverage->the_post(); ?>
		<?php $coverageId = $post->ID;  ?>
		<h3>
		    <?php if ( has_post_thumbnail() ): ?>  
			<?php the_post_thumbnail(); ?>
		    <?php else: ?>
			<?php  echo the_title(); ?>
		    <?php endif; ?>
		    
		</h3>
		<?php wp_reset_postdata(); ?>
		
		<?php $coverages = new WP_Query(
		    array( 
			'meta_query' => array(
			    array('key' => '_wpcf_belongs_cobertura_id', 'value' => $coverageId)
			)
			
		    )
		); ?>
		
		<ul class="list-group">
		    <?php while ($coverages->have_posts()) : $coverages->the_post(); ?>
			<li class="list-group-item">
			    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		    <?php endwhile; ?>
		    <?php wp_reset_postdata(); ?>
		</ul>
	    <?php else: ?>
		<div class="specials">
		    <p class="postCategories">
			<?php   $category_link = get_term_link('especiales', 'categoria_menu'  ); ?>
			<a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Especiales','cmkx'); ?>"><?php _e('Especiales','cmkx'); ?></a>
		    </p>
		    
		    <?php $specials_posts = new WP_Query(array('tax_query' => array(
			array(
			    'taxonomy' => 'categoria_menu',
			    'field'    => 'slug',
			    'terms'    => $specials,
		    ),
		    ),
							       'posts_per_page' => 1
		    )); ?>
		    <?php if ( $specials_posts->have_posts() ) : ?>
			<?php $specials_posts->the_post(); ?>
			<?php the_post_thumbnail(); ?>
			<h2>
			    <a href="<?php echo get_permalink()?>">
				<?php the_title(); ?>
			    </a>
			</h2>
		    <?php endif; ?>
		    <?php wp_reset_postdata(); ?>
		</div>
	    <?php endif; ?>
	</section>
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
		    <h2>
			<a href="<?php echo get_permalink()?>">
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
		    <h2>
			<a href="<?php echo get_permalink()?>">
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
    
    <div class="col-md-custom specials">
	<div id="widget-top-right-bar">
	    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Top-right-widget')) : else : ?>
		<p>Widget Top right bar
	    <?php endif; ?>
	</div>
	<p class="postCategories">
            <?php   $category_link = get_term_link('especiales', 'categoria_menu'  ); ?>
            <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Especiales','cmkx'); ?>"><?php _e('Especiales','cmkx'); ?></a>
        </p>
	
	<?php $specials_posts = new WP_Query(array('tax_query' => array(
	    array(
		'taxonomy' => 'categoria_menu',
		'field'    => 'slug',
		'terms'    => $specials,
	    ),
	),
						   'posts_per_page' => 1
        )); ?>
        <?php if ( $specials_posts->have_posts() ) : ?>
	    <?php $specials_posts->the_post(); ?>
	    <?php the_post_thumbnail(); ?>
	    <h2>
		<a href="<?php echo get_permalink()?>">
		    <?php the_title(); ?>
		</a>
	    </h2>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
    </div>
    
</div>
<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	
	<div class="row">
	    <div class="col-md-12">
		<ol class="sponsors">
		    <li>	  
	 		<a href="http://mesaredonda.cubadebate.cu/" target="_blank">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/mesaredonda.png" alt="Mesa redonda">
			</a>
		    </li>
		    <li>
			<a href="http://www.cubadebate.cu/" target="_blank">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/cubadebate.png" alt="Cubadebate">
			</a>
		    </li>
		    <li>
			<a href="http://razonesdecuba.cubadebate.cu/" target="_blank">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/razonesdecuba.png" alt="Razones de Cuba">
			</a>
		    </li>
		    <li>
			<a href="http://teveo.icrt.cu/" target="_blank">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/teveo.png" alt="Te veo">
			</a>
		    </li>
		    <li>
			<a href="http://www.cubaperiodistas.cu/" target="_blank">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/upec.png" alt="UPEC">
			</a>
		    </li>
		</ol>
	    </div>
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
			<a href="<?php echo get_permalink()?>">
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
			    <h3>
				<a href="<?php echo get_permalink()?>">
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
	    <?php   $category_id = get_cat_ID($culture ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Cultura','cmkx'); ?>"><?php _e('Cultura','cmkx'); ?></a>
	</p>
	<ol class="cultureSponsors">
	    <li>
		<a href="http://www.cubarte.cult.cu">
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/cubarte-periodico-logo.jpg" />
		</a>
	    </li>
	    <li>
		<a href="http://www.lapapeleta.cu/">
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/la-papeleta.png" />
		</a>
	    </li>
	    <li>
		<a href="http://tododearte.cult.cu/">
		    <img src="<?php bloginfo('template_directory'); ?>/assets/images/todo-arte.png" />
		</a>
	    </li>	
	</ol>
	<div class="row">
	    <?php $culturePosts = new WP_Query( array( 'category_name' => $culture ,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $culturePosts->have_posts() ) : ?>
		<?php while ( $culturePosts->have_posts() ) : $culturePosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3>
			    <a href="<?php echo get_permalink()?>">
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
	    <div class="col-md-12">
		<ol class="cultureSponsors">
		    <li>
			<a href="https://luistoledosande.wordpress.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/luis-toledo.jpg" />
			</a>
		    </li>
		    <li>
			<a href="http://fidel-elcedro.blogspot.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/david.jpg" />
			</a>
		    </li>
		    <li>
			<a href="https://cmkxradiobayamo.wordpress.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/cmkx-digital.jpg" />
			</a>
		    </li>	
		    <li>
			<a href="http://www.parlamentocubano.cu/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/" />
			</a>
		    </li>
		</ol>
	    </div>
	</div>
	
	<div class="row">
	    <?php $societyPosts = new WP_Query( array( 'category_name' => $society ,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $societyPosts->have_posts() ) : ?>
		<?php while ( $societyPosts->have_posts() ) : $societyPosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3>
			    <a href="<?php echo get_permalink()?>">
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
	    <?php   $category_id = get_cat_ID( $sports ); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Deportes','cmkx'); ?>"><?php _e('Deportes','cmkx'); ?></a>
	</p>
	
	<div class="row">
	    <div class="col-md-12">
		<ol class="cultureSponsors">
		    <li>
			<a href="https://luistoledosande.wordpress.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/luis-toledo.jpg" />
			</a>
		    </li>
		    <li>
			<a href="http://fidel-elcedro.blogspot.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/david.jpg" />
			</a>
		    </li>
		    <li>
			<a href="https://cmkxradiobayamo.wordpress.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/cmkx-digital.jpg" />
			</a>
		    </li>	
		    <li>
			<a href="http://www.parlamentocubano.cu/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/" />
			</a>
		    </li>
		</ol>
	    </div>
	</div>
	
	<div class="row">
	    <?php $sportPosts = new WP_Query( array( 'category_name' => $sports,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $sportPosts->have_posts() ) : ?>
		<?php while ( $sportPosts->have_posts() ) : $sportPosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3>
			    <a href="<?php echo get_permalink()?>">
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
	    <div class="col-md-12">
		<ol class="cultureSponsors">
		    <li>
			<a href="https://luistoledosande.wordpress.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/luis-toledo.jpg" />
			</a>
		    </li>
		    <li>
			<a href="http://fidel-elcedro.blogspot.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/david.jpg" />
			</a>
		    </li>
		    <li>
			<a href="https://cmkxradiobayamo.wordpress.com/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/cmkx-digital.jpg" />
			</a>
		    </li>	
		    <li>
			<a href="http://www.parlamentocubano.cu/">
			    <img src="<?php bloginfo('template_directory'); ?>/assets/images/" />
			</a>
		    </li>
		</ol>
	    </div>
	</div>
	
	<div class="row">
	    <?php $scincePosts = new WP_Query( array( 'category_name' => $science,'posts_per_page' => 3 )  ); ?>
	    <?php if ( $scincePosts->have_posts() ) : ?>
		<?php while ( $scincePosts->have_posts() ) : $scincePosts->the_post() ?>
		    <div class="col-md-4 culturePosts">
			<div class="sectionThumbnailContainer">
			    <?php the_post_thumbnail(); ?>
			</div>
			<h3>
			    <a href="<?php echo get_permalink()?>">
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
	    <?php   $category_id = get_cat_ID('foto-reportaje'); ?>
	    <?php   $category_link = get_category_link( $category_id ); ?>
	    <a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('Foto reportaje','cmkx'); ?>"><?php _e('Foto reportaje','cmkx'); ?></a>
	</p>
	<div class="row">
	    <div class="col-md-7 connected-carousels">
                <div class="stage">
                    <div class="carousel carousel-stage">
			<?php $culturePosts = new WP_Query( array( 'category_name' => 'cultura','posts_per_page' => 4 )  ); ?>
			<?php if ( $culturePosts->have_posts() ) : ?>
                            <ul>
			        <?php while ( $culturePosts->have_posts() ) : $culturePosts->the_post() ?>
				    <li>
					<?php the_post_thumbnail(); ?>
				    </li>
				<?php endwhile; ?>
	                    </ul>
			    <?php wp_reset_postdata(); ?>
			<?php endif; ?>
                    </div>
                    <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
                    <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
                </div>
	    </div>
	    <div class="col-md-5">
		<div class="connected-carousels">
		    <div class="carousel-description">
			<div class="carousel carousel-stage">
			    <?php if ( $culturePosts->have_posts() ) : ?>
				<ul>
			            <?php while ( $culturePosts->have_posts() ) : $culturePosts->the_post() ?>
					<li>
					    <a >
						<?php the_title(); ?>
					    </a>
					</li>
				    <?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			    <?php endif; ?>
			</div>
			

		    </div>
		    <div class="navigation">
			<a href="#" class="prev prev-navigation">&lsaquo;</a>
			<a href="#" class="next next-navigation">&rsaquo;</a>
			<div class="carousel carousel-navigation">
			    <?php if ( $culturePosts->have_posts() ) : ?>
				<ul id="miniCarousel">
			            <?php while ( $culturePosts->have_posts() ) : $culturePosts->the_post() ?>
					<li>
					    <?php the_post_thumbnail(); ?>
					</li>
				    <?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			    <?php endif; ?>
			</div>
                    </div>
		</div>
            </div>
	    
	</div>

	<?php get_footer(); ?>
