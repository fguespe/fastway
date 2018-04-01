<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */
$THEME_DIR= get_template_directory() . '/';
$THEME_URI = get_template_directory_uri() . '/';
$THEME_IMG_URI= $THEME_URI . 'images/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';



/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Theme setup and custom theme supports.
 */
//require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/functions.php';

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Static Block.
 */
require get_template_directory() . '/inc/static-block/static-block.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';


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
