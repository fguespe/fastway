<?php


add_action( 'fastway_header_init', 'fastway_header_body', 20 );

//add_action( 'theshopier_header_init', 'theshopier_header_tablet', 20 );
if( !function_exists('fastway_header_body') ){
    function fastway_header_body( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'inc/headers/header-'.$style.'.php') ) $style = 1;
        get_template_part('inc/headers/header', $style);
    }
}
add_action( 'fastway_product_loop_init', 'fastway_product_loop', 20 );

//add_action( 'theshopier_header_init', 'theshopier_header_tablet', 20 );
if( !function_exists('fastway_product_loop') ){
    function fastway_product_loop( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'woocommerce/loop-templates/product-loop-'.$style.'.php') ) $style = 1;
        get_template_part('woocommerce/loop-templates/product-loop', $style);
    }
}
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    global $redux_demo;
  $cols =  $redux_demo['shop_per_page'];
  return $cols;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
           global $redux_demo;
        return $redux_demo['shop_columns'];
    }
}

function get_blocks( ){
    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'DESC',
        'post_type'        => 'static-block',
        'post_status'      => 'publish',
    );
    
    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->ID;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}