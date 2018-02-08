<?php $currentCoverage = new WP_Query( array( 'post_type' => 'cobertura', 'posts_per_page' => 1,
					      'meta_query' => array(
						  array(
						      'key'     => 'wpcf-activate-coverage',
						      'value'   => 1
						  )
					      ),
					      'lang' => pll_current_language()
) ); ?>

<?php $coverageId = 0;  ?>

<?php if($currentCoverage->have_posts()) : ?>
    <?php  $currentCoverage->the_post(); ?>
    <?php $coverageId = $post->ID;  ?>
    <div class="row">
	<span id="specialCoverage">
	    <?php  _e('COBERTURA ESPECIAL','cmkx'); ?>
	</span>
	<?php if ( has_post_thumbnail() ): ?>  
	    <?php the_post_thumbnail(); ?>
	<?php else: ?>
	    <h1 class="elegantshadow" style="font-size: 30px;font-weight: bold;color: #262b62;">
		<a href="<?php echo get_permalink()?>">
		  <?php  echo the_title(); ?>
		</a>
	    </h1>
	<?php endif; ?>
	
    </div>
    
    <?php wp_reset_postdata(); ?>
    
    <?php $coverages = new WP_Query(
	array(
	    'posts_per_page' => 3,
	    'meta_query' => array(
		array('key' => '_wpcf_belongs_cobertura_id', 'value' => $coverageId)
	    )
	    
	)
    ); ?>
	
    <div class="row">
	<?php while ($coverages->have_posts()) : $coverages->the_post(); ?>
	    <div class="col-md-4 coverage">
		<div>
		    <?php the_post_thumbnail(); ?>
		</div>
		<h2>
		    <a href="<?php echo get_permalink()?>">
			<?php the_title(); ?>
    		    </a>
		</h2>
	    </div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
    </div>

    <hr>
<?php endif; ?>

