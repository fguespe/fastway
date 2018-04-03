<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */
if ( !function_exists( 'write_log' ) ){
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
}

$THEME_DIR= get_template_directory() . '/';
$THEME_URI = get_template_directory_uri() . '/';
$THEME_IMG_URI= $THEME_URI . 'images/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';

	

/**
 * Initialize theme default settings
 */
//require get_template_directory() . '/inc/theme-settings.php';

/**
 * Theme setup and custom theme supports.
 */
#require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/functions.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';




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
/**
 * Custom Comments file.
 */
//require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';




/**
 * Load Editor functions.
 */
//require get_template_directory() . '/inc/editor.php';
