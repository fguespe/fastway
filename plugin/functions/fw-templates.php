<?php
add_action( 'fastway_header_init', 'fastway_header_body', 20 );
if( !function_exists('fastway_header_body') ){
    function fastway_header_body( $style = 1 ){
        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/header-templates/header-'.$style.'.php') ) $style = 1;
            get_template_part('plugin/templates/header-templates/header', $style);
    }
}

add_action( 'fastway_header_init_mobile', 'fastway_header_tablet', 20 );
if( !function_exists('fastway_header_tablet') ) {
    function fastway_header_tablet( $style = 1 ){
        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/header-mobile-templates/header-tablet-'.$style.'.php') ) $style = 1;
        get_template_part('plugin/templates/header-mobile-templates/header-tablet', $style);
    }
}

add_action( 'fastway_product_loop_init', 'fastway_product_loop', 20 );
if( !function_exists('fastway_product_loop') ){
    function fastway_product_loop( $style = 1 ){
        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/product-loop-templates/product-loop-'.$style.'.php') ) $style = 1;
        get_template_part('plugin/templates/product-loop-templates/product-loop', $style);
    }
}
add_action( 'fastway_product_loop_init_mobile', 'fastway_product_loop_mobile', 20 );
if( !function_exists('fastway_product_loop_mobile') ){
    function fastway_product_loop_mobile( $style = 1 ){

        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/product-loop-mobile-templates/product-loop-mobile-'.$style.'.php') ) $style = 1;
        get_template_part('plugin/templates/product-loop-mobile-templates/product-loop-mobile', $style);
    }
}

add_action( 'fastway_product_single_init', 'fastway_product_single', 20 );
if( !function_exists('fastway_product_single') ){
    function fastway_product_single( $style = 1 ){
        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/single-product-templates/content-single-product-'.$style.'.php') ) $style = 1;
        get_template_part('plugin/templates/single-product-templates/content-single-product', $style);
    }
}
add_action( 'fastway_product_single_init_mobile', 'fastway_product_single_mobile', 20 );
if( !function_exists('fastway_product_single_mobile') ){
    function fastway_product_single_mobile( $style = 1 ){
        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . 'woocommerce/templates-single/content-single-product-mobile-'.$style.'.php') ) $style = 1;
        get_template_part('plugin/templates/templates-single/content-single-product-mobile', $style);
    }
}

$theme_headers = array();
for( $i=1; $i<=20; $i++ ) {
    for( $j=1; $j<=20; $j++ ) {
        if( file_exists( $TEMPLATE_DIR . "header-templates-images/theme-option-header{$i}-{$j}.png" ) ) {
            $theme_headers[$i."-".$j] = array(
                'alt' => $i."-".$j,
                'img' => $TEMPLATE_URI . "header-templates-images/theme-option-header{$i}-{$j}.png"
            );
        }
    }   
}
$theme_headers_mobile = array();
for( $i=1; $i<=20; $i++ ) {
    if( file_exists( $TEMPLATE_DIR . "header-mobile-templates-images/theme-option-header-mobile{$i}.png" ) ) {
        $theme_headers_mobile[$i] = array(
            'alt' => $i,
            'img' => $TEMPLATE_URI . "header-mobile-templates-images/theme-option-header-mobile{$i}.png"
        );
    }
}
$loop_templates = array();
for( $i=1; $i<=4; $i++ ) {
    if( file_exists( $TEMPLATE_DIR . "product-loop-templates-images/product-loop-{$i}.jpg" ) ) {
        $loop_templates[$i] = array(
            'alt' => $i,
            'img' => $TEMPLATE_URI . "product-loop-templates-images/product-loop-{$i}.jpg"
        );
    }
}
$loop_templates_mobile = array();
for( $i=1; $i<=3; $i++ ) {
    if( file_exists( $TEMPLATE_DIR . "product-loop-mobile-templates-images/product-loop-mobile-{$i}.jpg" ) ) {
        $loop_templates_mobile[$i] = array(
            'alt' => $i,
            'img' => $TEMPLATE_URI . "product-loop-mobile-templates-images/product-loop-mobile-{$i}.jpg"
        );
    }
}
$single_templates = array();
for( $i=1; $i<=3; $i++ ) {
    if( file_exists( $TEMPLATE_DIR . "product-loop-templates-images/woo_product_single{$i}.jpg" ) ) {
        $single_templates[$i] = array(
            'alt' => $i,
            'img' => $TEMPLATE_URI . "woo_product_single{$i}.jpg"
        );
    }
}
$single_templates_mobile = array();
for( $i=1; $i<=3; $i++ ) {
    if( file_exists( $TEMPLATE_DIR . "images/woo_product_single{$i}.jpg" ) ) {
        $single_templates_mobile[$i] = array(
            'alt' => $i,
            'img' => $TEMPLATE_URI . "woo_product_single{$i}.jpg"
        );
    }
}