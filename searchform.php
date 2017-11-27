<form class="form-inline my-2 my-lg-0" action=" <?php echo home_url( '/' ); ?>" method="get">
    <input class="form-control mr-sm-2" type="text" placeholder="<?php _e('Buscar', 'cmkx'); ?>" aria-label="<?php _e('Buscar', 'cmkx'); ?>" name="s" id="search" value="<?php the_search_query(); ?>" />
</form>
