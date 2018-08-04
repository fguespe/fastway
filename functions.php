<?php
if ( !function_exists( 'write_log' ) ):
function write_log ( $log )  {
    if ( true === WP_DEBUG ) {
        $logg="GUESPES: ";
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( $logg.print_r( $log, true ) );
        } else {
            error_log( $logg.$log );
        }
    }
}   
endif;
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if ( !function_exists( 'fw_checkPlugin' ) ):
function fw_checkPlugin( $path = '' ){
        if( strlen( $path ) == 0 ) return false;
        $_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
        if ( in_array( trim( $path ), $_actived ) ) return true;
        else return false;
}
endif;
$THEME_DIR= get_template_directory() . '/';
$THEME_URI = get_template_directory_uri() . '/';
$TEMPLATE_DIR=$THEME_DIR."plugin/templates/";
$TEMPLATE_URI=$THEME_URI."plugin/templates/";
$THEME_IMG_URI= $THEME_URI . 'images/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';

require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/plugin/functions/extra-functions.php';
require get_template_directory() . '/plugin/functions/ihaf.php';
require get_template_directory() . '/plugin/functions/fw-templates.php';
require get_template_directory() . '/plugin/functions/fw-democontent.php';

require get_template_directory() . '/plugin/functions/shortcodes/class-woo-shortcodes.php' ;
require get_template_directory() . '/plugin/functions/shortcodes/class-shortcodes.php' ;
require get_template_directory() . '/plugin/functions/fw-navwalker.php';

//if(fw_checkPlugin('woocommerce/woocommerce.php')){
    require get_template_directory() . '/plugin/functions/fw-user-account.php';
    require get_template_directory() . '/plugin/functions/vc_customs/vc_woo_carousels.php';
    require get_template_directory() . '/plugin/functions/fw-ajax-search.php';
    require get_template_directory() . '/plugin/functions/fw-shopping-cart.php' ;
    require get_template_directory() . '/plugin/functions/woocommerce-category-banner/woocommerce-category-banner.php';
    require get_template_directory() . '/plugin/functions/product-enquiry-form/product-enquiry-form.php';
    require get_template_directory() . '/plugin/functions/woo-empty-cart-button.php';
    require get_template_directory() . '/plugin/functions/woocommerce_custom_related_products.php';
    require get_template_directory() . '/plugin/functions/tab_descargas.php';
    require get_template_directory() . '/plugin/functions/tab_video.php';
    require get_template_directory() . '/plugin/functions/admin_options.php';
//}




init_hooks();
function init_hooks(){
    if( is_request( 'frontend' ) ) {
        $shortcode = new fw_Shortcodes();
        add_action( 'init', array( $shortcode, 'init' ) );
    }    
}


 function is_request( $type ) {
    switch ( $type ) {
        case 'admin' :
            return is_admin();
        case 'ajax' :
            return defined( 'DOING_AJAX' );
        case 'cron' :
            return defined( 'DOING_CRON' );
        case 'frontend' :
            return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
    }
}


load_theme_textdomain( 'understrap', get_template_directory() . '/languages' );
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'understrap' ),
	'vertical' => __( 'Vertical Menu', 'understrap' ),
	'mobile' => __( 'Mobile Menu', 'understrap' ),
) );
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/ReduxCore/framework.php' );
}
global $redux_demo;

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/plugin/functions/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/plugin/functions/sample-config.php' );
}
function template_sredirect() {
        global $redux_demo;
        $url=$redux_demo["mobile-redirect"];
        if(!wp_is_mobile())return;
        if(!is_front_page())return;
        wp_redirect( $url);

    }
add_action( 'template_redirect', 'template_sredirect' );





?>