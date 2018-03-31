<?php


add_action( 'theshopier_header_init', 'theshopier_header_body', 20 );

//add_action( 'theshopier_header_init', 'theshopier_header_tablet', 20 );
if( !function_exists('theshopier_header_body') ){
    function theshopier_header_body( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'inc/headers/header-'.$style.'.php') ) $style = 1;
        get_template_part('inc/headers/header', $style);
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