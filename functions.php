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
$THEME_IMG_URI= $THEME_URI . 'images/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';

require get_template_directory() . '/inc/functions.php';
require get_template_directory() . '/inc/enqueue.php';

        
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/fw-ajax-search.php';

//WIDGETS
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

require get_template_directory() . '/inc/shortcodes/class-woo-shortcodes.php' ;
require get_template_directory() . '/inc/shortcodes/class-shortcodes.php' ;





init_hooks();
function init_hooks(){
    if( is_request( 'frontend' ) ) {
        $shortcode = new Nexthemes_Shortcodes();
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
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/sample-config.php' );
}

add_action( 'vc_before_init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {
     
    //.. Code from other Tutorials ..//
 
    // Require new custom Element
    require_once( get_template_directory().'/inc/vc_customs.php' ); 
     
}

?>