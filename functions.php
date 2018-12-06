<?php

function fw_theme_mod( $name ) {
    //global $my_theme_defaults;
    if($name=="icons_style" && empty(get_theme_mod( $name)))return "fa";
    if($name=="icons_style" &&  get_theme_mod( $name) === "light")return "fal";
    if($name=="icons_style" &&  get_theme_mod( $name) === "solid")return "fas";
    if($name=="icons_style" &&  get_theme_mod( $name) === "regular")return "fa";
    return get_theme_mod( $name);
}
function fw_getme_roles(){
    if ( ! function_exists( 'get_editable_roles' ) ) {
        require_once ABSPATH . 'wp-admin/includes/user.php';
    }
    $editable_roles = get_editable_roles();
    $roles=array();
    foreach ($editable_roles as $role => $details) {
        $rol = esc_attr($role);
        if($rol=='administrator')continue;
        $name = translate_user_role($details['name']);
        $roles=array_merge($roles,array($rol => $name));
       
    }
    return $roles;
}

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

add_filter( 'map_meta_cap', 'multisite_custom_css_map_meta_cap', 20, 2 );
function multisite_custom_css_map_meta_cap( $caps, $cap ) {
	if ( 'edit_css' === $cap && is_multisite() ) {
		$caps = array( 'edit_theme_options' );
	}
	return $caps;
}


function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

add_action('wp_enqueue_scripts', function() {
    if (function_exists('gravity_form_enqueue_scripts')) {
        // newsletter subscription form
        gravity_form_enqueue_scripts(5);
    }
});
/*
if ( !function_exists( 'fw_checkPlugin' ) ):
function fw_checkPlugin( $path = '' ){
        if( strlen( $path ) == 0 ) return false;
        $_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
        if ( in_array( trim( $path ), $_actived ) ) return true;
        else return false;
}
endif;
*/

$THEME_DIR= get_template_directory() . '/';
$THEME_URI = get_template_directory_uri() . '/';
$TEMPLATE_DIR=$THEME_DIR."templates/";
$TEMPLATE_URI=$THEME_URI."templates/";
$THEME_IMG_URI= $THEME_URI . 'images/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';



require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/functions/fw-extra-functions.php';
require get_template_directory() . '/functions/fw-shortcodes.php';
require get_template_directory() . '/functions/ihaf.php';
require get_template_directory() . '/templates/fw-templates.php';
require get_template_directory() . '/demos/fw-democontent.php';
//require get_template_directory() . '/demos/one-click-demo-import/one-click-demo-import.php';
require get_template_directory() . '/functions/fw-navwalker.php';
require get_template_directory() . '/functions/fw-user-account.php';
require get_template_directory() . '/functions/fw-blog-options.php';
require get_template_directory() . '/functions/shortcodes/class-woo-shortcodes.php' ;
require get_template_directory() . '/functions/shortcodes/class-shortcodes.php' ;
require get_template_directory() . '/functions/fw-shopping-cart.php' ;
require get_template_directory() . '/functions/fw-ajax-search.php';

if(is_plugin_active('js_composer/js_composer.php')){
    require get_template_directory() . '/functions/vc_customs/vc_fastway.php';
}
if(is_plugin_active('woocommerce/woocommerce.php')){
    require get_template_directory() . '/functions/extra-woo-functions.php';
    require get_template_directory() . '/functions/extra-woo-functions-arg.php';
    require get_template_directory() . '/inc/woocommerce.php';
    if(is_plugin_active('js_composer/js_composer.php')){
        require get_template_directory() . '/functions/vc_customs/vc_woo_carousels.php';
    }
    require get_template_directory() . '/functions/woocommerce-category-banner/woocommerce-category-banner.php';
    require get_template_directory() . '/functions/hide-default-woocomerce-category.php';
    require get_template_directory() . '/functions/product-enquiry-form/product-enquiry-form.php';
    require get_template_directory() . '/functions/woo-empty-cart-button.php';
    require get_template_directory() . '/functions/woocommerce_custom_related_products.php';
    require get_template_directory() . '/functions/tab_descargas.php';
    require get_template_directory() . '/functions/tab_video.php';
}




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


load_theme_textdomain( 'fastway', get_template_directory() . '/languages' );
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'fastway' ),
    'vertical' => __( 'Vertical Menu', 'fastway' ),
    'mobile' => __( 'Mobile Menu', 'fastway' ),
) );

/*
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/ReduxCore/framework.php' );
}
global $redux_demo;
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/functions/fw-theme-options.php' ) ) {
    require_once( dirname( __FILE__ ) . '/functions/fw-theme-options.php' );
}
//require get_template_directory() . '/inc/kirki/kirki.php';
*/

if(is_plugin_active('kirki/kirki.php')){
    require get_template_directory() . '/functions/fw-theme-options.php';
}

if(fw_theme_mod('ca-switch')){
    require get_template_directory() . '/functions/client-area/client-area.php';   
}
add_action( 'init', 'fw_login_dev_logo', 999 );
function fw_login_dev_logo(){

    add_action( 'login_footer', 'fw_login_footer' );
}
function fw_login_footer() {

    ?>
    <script type="text/javascript">
        var backToBlog = document.getElementById( 'backtoblog' ).getElementsByTagName( 'a' )[0];
        backToBlog.innerHTML='<div width="100%" style="margin:0 auto;text-align:center;"><a href="https://www.briziolabz.com"><img width="200" align="center" style="margin:0 auto;text-align:center;" src="<?php echo fw_theme_mod('ca-dev-logo');?>"></a></div>';
    </script>
    <?php
}


function template_sredirect() {
        $url=fw_theme_mod("mobile-redirect");
        if(empty($url))return;
        if(!wp_is_mobile())return;
        if(!is_front_page())return;
        wp_redirect( $url);

    }
add_action( 'template_redirect', 'template_sredirect' );






?>