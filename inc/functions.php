<?php
add_action( 'fastway_footer_init', 'fastway_footer_block', 10 );

function fastway_footer_block(){
    global $redux_demo;
    if( isset( $redux_demo["footer-stblock"] ) && strlen( $redux_demo["footer-stblock"] ) > 0 && class_exists("Nexthemes_StaticBlock") ) Nexthemes_StaticBlock::getSticBlockContent( $redux_demo["footer-stblock"] );
}



if( !function_exists('fastway_getLogo') ) {
    function fastway_getLogo( $type="" ){
        global $redux_demo;
        switch( $type ) {
            case 'sticky':
                break;
            default:
                $title = !empty($redux_demo['logo-text'])? esc_attr($redux_demo['logo-text']): get_bloginfo('name');
                $logo_arg = array(
                    'title' => esc_attr($title),
                    'alt'   => esc_attr($title)
                );

                if( isset( $redux_demo['general-logo'] ) && strlen(trim($redux_demo['general-logo']['url'])) > 0 ){
                    $logo_arg['src'] = esc_url( $redux_demo['general-logo']['url'] );
                    $logo_arg['width'] = absint($redux_demo['general-logo']['width']);
                    $logo_arg['height'] = absint($redux_demo['general-logo']['height']);
                } else {
                    $logo_arg['src'] = esc_url( THEME_IMG_URI . "logo.png" );
                    $logo_arg['width'] = 530;
                    $logo_arg['height'] = 104;
                }

                echo '<div class="logo">';
                echo '<a href="'.esc_attr(home_url()).'">';
                fastway_getImage($logo_arg);
                echo '</a>';
                echo '</div>';
        }
    }
}

if(!function_exists('fastway_getImage')) {
    function fastway_getImage($atts){
        $atts = wp_parse_args($atts, array(
            'alt'   => esc_attr__('image alt', 'fastway'),
            'width' => '',
            'height' => '',
            'src'  => '',
            'class' => 'fastway-image'
        ));

        $src = esc_url($atts['src']);

        if(strlen(trim($src)) > 0) {
            $_img = '<img';
            foreach($atts as $k => $v) {
                if(empty($v)) continue;
                $_img .= " {$k}=\"{$v}\"";
            }
            $_img .= '>';
            echo wp_kses($_img, array(
                'img' => array('alt' => array(), 'width' => array(), 'height' => array(), 'src' => array(), 'class' => array())
            ));
        }
    }
}




add_action( 'fastway_header_init', 'fastway_header_body', 20 );
add_action( 'fastway_header_init_mobile', 'fastway_header_tablet', 20 );



if( !function_exists('fastway_header_body') ){
    function fastway_header_body( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'header-templates/header-'.$style.'.php') ) $style = 1;
        get_template_part('header-templates/header', $style);
    }
}

if( !function_exists('fastway_header_tablet') ) {
    function fastway_header_tablet( $style = 1 ){
        global $THEME_DIR;
        if( file_exists($THEME_DIR . 'header-templates/header-tablet-'.$style.'.php') )
            get_template_part('header-templates/header-tablet', $style);
    }
}

add_action( 'fastway_product_loop_init', 'fastway_product_loop', 20 );
if( !function_exists('fastway_product_loop') ){
    function fastway_product_loop( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'woocommerce/loop-templates/product-loop-'.$style.'.php') ) $style = 1;
        get_template_part('woocommerce/loop-templates/product-loop', $style);
    }
}
add_action( 'fastway_product_loop_init_mobile', 'fastway_product_loop_mobile', 20 );
if( !function_exists('fastway_product_loop_mobile') ){
    function fastway_product_loop_mobile( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'woocommerce/loop-templates/product-loop-mobile-'.$style.'.php') ) $style = 1;
        get_template_part('woocommerce/loop-templates/product-loop-mobile', $style);
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
function fastway_get_stblock( $cats = array('all') ){
    $res_args = array();

    $meta_query = array();
    
    $args = array(
        'post_type'         => 'fw_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
        //'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->post_name;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
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