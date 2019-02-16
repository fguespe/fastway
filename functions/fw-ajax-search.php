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
    add_shortcode('fw_search_form', 'fw_search_form');
    function fw_search_form($atts){
        if(!is_numeric($atts)){
          $atts = shortcode_atts(array('id' => 1 ), $atts );
          $id=$atts['id'];
        }else $id=$atts;
      
        $rand_id = wp_rand();
        $check_woo = is_plugin_active('woocommerce/woocommerce.php');
        $_placeholder=fw_theme_mod('fw_label_search');
        $class="input-group fw_search_form fw-searchform desktop";
        if($id==3)$class="search-form-mobile";
        

        $devolver= 
        '<form id="form_'.esc_attr($rand_id).'" class="'.$class.'" method="get" action="'.esc_url( home_url( '/' ) ).'">
        <input type="search" class="search-field form-control u-from__input u-search-push-top__input" placeholder="'.esc_attr($_placeholder).'" value="'.get_search_query().'" name="s" id="s_'.esc_attr($rand_id).'">';
        if($check_woo){
          $devolver.='<input type="hidden" name="post_type" value="product" />';
        }
        $devolver.='<div class="input-group-append">';
        if ( defined( 'ICL_LANGUAGE_CODE' ) ){
          $devolver.='<input type="hidden" name="lang" value="'.(ICL_LANGUAGE_CODE).'" />';
        }else if ( $id==0 || $id==2){
          $devolver.='<button type="button" class="">Buscar</button>';
        }else if ( $id==1){
          $devolver.='<button type="button" class=""><i class="'.fw_theme_mod('fw_icons_style').' fa-search"></i></button>';
        }
        $devolver.='</div></form>';
        return $devolver;
    }
}

?>