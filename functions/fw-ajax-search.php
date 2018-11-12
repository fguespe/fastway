<?php

function ajax_search() {
  // Get search term from search field
  $search = sanitize_text_field( $_POST[ 'query' ] );
  
  // Set up query using search string, limit to 8 results
  $query = new WP_Query(
    array(
      'posts_per_page' => 8,
      's' => $search,
      'post_type'           => 'product',
      'post_status'         => 'publish',
      'ignore_sticky_posts' => 1,
      //'orderby'             => $ordering_args['orderby'],
      //'order'               => $ordering_args['order'],
      'posts_per_page'      => 5,
      'suppress_filters'    => false,
    )
  );
  
  $output = '';
  
  // Run search query
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) : $query->the_post();
      write_log(get_the_title());
      /* Output a link to each result
         This is where the post thumbnail, excerpt, or anything else could be added */
      echo '<a class="autocomplete-suggestion" href="' . get_permalink() . '">' . get_the_title() . '</a>';
    
    endwhile;        
    
    // If there is more than one page of results, add link to the full results page
    if ( $query->max_num_pages > 1 ) {
      // We use urlencode() here to handle any spaces or odd characters in the search string
      echo '<a class="see-all-results" href="' . get_site_url() . '?s=' . urlencode( $search ) . '&post_type=product">Ver todos.</a>';
    }
    
  } else {
    
    // There are no results, output a message
    echo '<p class="no-results">'._e("Sin resultados...","fastway").'</p>';
  
  }
  
  // Reset query
  wp_reset_query();
  
  die();
}

/* We need to hook into both wp_ajax and wp_ajax_nopriv_ in order for
   the search to work for both logged in and logged out users. */
add_action( 'wp_ajax_ajax_search', 'ajax_search' );
add_action( 'wp_ajax_nopriv_ajax_search', 'ajax_search' );



if( !function_exists( 'fw_search_form' ) ) {

    function fw_search_form($numero=0){
        $rand_id = wp_rand();
        $check_woo = is_plugin_active('woocommerce/woocommerce.php');
        if($check_woo) {
            $_placeholder = esc_attr__("¿Que estas buscando?", 'fastway' );
        } else {
            $_placeholder = esc_attr__("¿Que estas buscando?", 'fastway' );
        }
        $class="search-form-desktop";
        if($numero==3)$class="search-form-mobile";
        ?>

        <form id="form_<?php echo esc_attr($rand_id)?>" class="<? echo $class?> js-focus-state input-group u-form fw-searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="search-field form-control u-from__input u-search-push-top__input" placeholder="<?php echo esc_attr($_placeholder);?>" value="<?php echo get_search_query() ?>" name="s" id="s_<?php echo esc_attr($rand_id)?>">
            <?php if($check_woo): ?>
                    <input type="hidden" name="post_type" value="product" />
              <?php endif;?>

            <div class="input-group-append">
                <!--
                <?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
                    <input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
                <?php endif ?>
                -->
                <?php if ( $numero==0): ?>
                  <button type="button" class="">Buscar</button>
                <?php endif ?>
                <?php if ( $numero==1): ?>
                  <button type="button" class=""><i class="fa fa-search"></i></button>
                <?php endif ?>
                <?php if ( $numero==3): ?>
                  
                <?php endif ?>
            </div>
          </form>
         

        <?php
    }
}
