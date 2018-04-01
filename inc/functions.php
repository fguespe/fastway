<?php






if( !function_exists('theshopier_getLogo') ) {
    function theshopier_getLogo( $type="" ){
        global $theshopier_datas;
        switch( $type ) {
            case 'sticky':
                break;
            default:
                $title = !empty($theshopier_datas['logo-text'])? esc_attr($theshopier_datas['logo-text']): get_bloginfo('name');
                $logo_arg = array(
                    'title' => esc_attr($title),
                    'alt'   => esc_attr($title)
                );

                if( isset( $theshopier_datas['nth-logo'] ) && strlen(trim($theshopier_datas['nth-logo']['url'])) > 0 ){
                    $logo_arg['src'] = esc_url( $theshopier_datas['nth-logo']['url'] );
                    $logo_arg['width'] = absint($theshopier_datas['nth-logo']['width']);
                    $logo_arg['height'] = absint($theshopier_datas['nth-logo']['height']);
                } else {
                    $logo_arg['src'] = esc_url( THEME_IMG_URI . "logo.png" );
                    $logo_arg['width'] = 530;
                    $logo_arg['height'] = 104;
                }

                echo '<div class="logo">';
                echo '<a href="'.esc_attr(home_url()).'">';
                theshopier_getImage($logo_arg);
                echo '</a>';
                echo '</div>';
        }
    }
}




add_action( 'fastway_header_init', 'fastway_header_body', 20 );
add_action( 'fastway_header_init_mobile', 'fastway_header_tablet', 20 );



if( !function_exists('fastway_header_body') ){
    function fastway_header_body( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'inc/headers/header-'.$style.'.php') ) $style = 1;
        get_template_part('inc/headers/header', $style);
    }
}

if( !function_exists('fastway_header_tablet') ) {
    function fastway_header_tablet( $style = 1 ){
        global $THEME_DIR;
        if( file_exists($THEME_DIR . 'inc/headers/header-tablet-'.$style.'.php') )
            get_template_part('inc/headers/header-tablet', $style);
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