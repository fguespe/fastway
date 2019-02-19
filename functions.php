<?php

function fw_theme_mod( $name ) {
    //global $my_theme_defaults;
    if($name=="fw_icons_style"){
        if(get_theme_mod( $name) === "solid" || get_theme_mod( $name) === "fas")return "fas";
        if(get_theme_mod( $name) === "light" || get_theme_mod( $name) === "fal")return "fal";
        else return 'fa';
    }
    if(empty(get_theme_mod( $name) && $name=="fw_label_search"))set_theme_mod('fw_label_search','¿Que estas buscando?');
    if(empty(get_theme_mod( $name) && $name=="fw_quickmenu_links"))set_theme_mod('fw_quickmenu_links','fb,youtube,whatsapp,ig,email,phone,address');
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


//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );

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
$CHILDTHEME_DIR= get_stylesheet_directory() . '/';
$THEME_URI = get_template_directory_uri() . '/';
$TEMPLATE_DIR=$THEME_DIR."templates/";
$CHILDTEMPLATE_DIR=$CHILDTHEME_DIR."templates/";
$TEMPLATE_URI=$THEME_URI."templates/";
$THEME_IMG_URI= $THEME_URI . 'images/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';



require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/widgets.php';
//require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/functions/fw-extra-functions.php';
require get_template_directory() . '/functions/fw-shortcodes.php';
//require get_template_directory() . '/demos/fw-democontent.php';
//require get_template_directory() . '/demos/one-click-demo-import/one-click-demo-import.php';
require get_template_directory() . '/functions/fw-user-account.php';
require get_template_directory() . '/functions/fw-blog-options.php';
require get_template_directory() . '/functions/shortcodes/fw-class-woo-shortcodes.php' ;
require get_template_directory() . '/functions/shortcodes/fw-class-shortcodes.php' ;
require get_template_directory() . '/functions/fw-shopping-cart.php' ;
require get_template_directory() . '/functions/fw-ajax-search.php';
require get_template_directory() . '/functions/fw-widgets.php';

if(is_plugin_active('js_composer/js_composer.php')){
    require get_template_directory() . '/functions/vc_customs/vc_fastway.php';
}
if(is_plugin_active('woocommerce/woocommerce.php')){
    require get_template_directory() . '/functions/fw-extra-woo-functions.php';
    require get_template_directory() . '/functions/fw-extra-woo-functions-arg.php';
    require get_template_directory() . '/inc/woocommerce.php';
    if(is_plugin_active('js_composer/js_composer.php')){
        require get_template_directory() . '/functions/vc_customs/vc_woo_carousels.php';
    }
    require get_template_directory() . '/functions/fw-custom-related.php';

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
    'mobile_bottom' => __( 'Bottom Mobile Menu', 'fastway' ),
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
    add_filter('woocommerce_shop_manager_editable_roles', function($roles) {
        $roles[]='shop_manager';
        return array_unique($roles);
      });   
}
add_action( 'init', 'fw_login_dev_logo', 999 );
function fw_login_dev_logo(){

    add_action( 'login_footer', 'fw_login_footer' );
}
function fw_login_footer() {

    ?>
    <script type="text/javascript">
        var backToBlog = document.getElementById( 'backtoblog' ).getElementsByTagName( 'a' )[0];
        backToBlog.innerHTML='<div width="100%" style="margin:0 auto;text-align:center;"><a href="https://www.altoweb.co"><img width="200" align="center" style="margin:0 auto;text-align:center;" src="<?php echo fw_theme_mod('ca-dev-logo');?>"></a></div>';
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




/**
 * Utility function: Get the product attribute ID from the name.
 *
 * @since 3.0.0
 * @param string $name | The name (slug).
 */
function get_attribute_id_from_name( $name ){
    global $wpdb;
    $attribute_id = $wpdb->get_var("SELECT attribute_id
    FROM {$wpdb->prefix}woocommerce_attribute_taxonomies
    WHERE attribute_name LIKE '$name'");
    return $attribute_id;
}

/**
 * Utility function: Save a new product attribute from his name (slug).
 *
 * @since 3.0.0
 * @param string $name  | The product attribute name (slug).
 * @param string $label | The product attribute label (name).
 */
function save_product_attribute_from_name( $name, $label='', $set=true ){
    if( ! function_exists ('get_attribute_id_from_name') ) return;

    global $wpdb;

    $label = $label == '' ? ucfirst($name) : $label;
    $attribute_id = get_attribute_id_from_name( $name );

    if( empty($attribute_id) ){
        $attribute_id = NULL;
    } else {
        $set = false;
    }
    $args = array(
        'attribute_id'      => $attribute_id,
        'attribute_name'    => $name,
        'attribute_label'   => $label,
        'attribute_type'    => 'select',
        'attribute_orderby' => 'menu_order',
        'attribute_public'  => 0,
    );

    if( empty($attribute_id) )
        $wpdb->insert(  "{$wpdb->prefix}woocommerce_attribute_taxonomies", $args );

    if( $set ){
        $attributes = wc_get_attribute_taxonomies();
        $args['attribute_id'] = get_attribute_id_from_name( $name );
        $attributes[] = (object) $args;
        set_transient( 'wc_attribute_taxonomies', $attributes );
    } else {
        return;
    }
}


function create_attributtes_from_categories( $product_id = 51 ){
    $product_id = $product_id == 0 ? get_the_ID() : $product_id;
    $taxonomy = 'product_cat';
    $product_categories = wp_get_post_terms( $product_id, $taxonomy );
    $product_categories_data = $product_cats = $product_attributes = array();

    // 1. Get and process product categories from a product
    if( count($product_categories) > 0 ){
        // 1st Loop get parent/child categories pairs
        foreach ( $product_categories as $product_category ) {
            $term_name   = $product_category->name; // Category name
            // keep product categories that have parent category
            if( $product_category->parent > 0 ){
                $parent_name = get_term_by( 'id', $product_category->parent, $taxonomy)->name; // Parent category name
                // Set them in the array
                $product_categories_data[$parent_name] = $term_name;
            }
        }
        // 2nd Loop: The get missing categories (the last child category or a unique category) and assign an temporary value to it
        foreach ( $product_categories as $product_category ) {
            if( ! in_array($product_category->name, array_keys($product_categories_data) ) ){
                // Assign an temporary value for the category name in the array of values
                $product_categories_data[$product_category->name] = 'Temp';
            }
        }
    }

    // 2. create and process product attributes and values from the product categories
    if( count($product_categories_data) > 0 ){
        // Get product attributes post meta data
        $existing_data_attributes = (array) get_post_meta( $product_id, '_product_attributes', true );
        // Get the position
        if( count($existing_data_attributes) > 0 )
            $position = count($existing_data_attributes);

        // Loop through our categories array
        foreach ( $product_categories_data as $key_label => $value_name ) {
            $taxonomy = wc_attribute_taxonomy_name($key_label);
            $attr_name = wc_sanitize_taxonomy_name($key_label); // attribute slug name

            // NEW Attributes: Register and save them (if it doesn't exits)
            if( ! taxonomy_exists( $taxonomy ) )
                save_product_attribute_from_name( $attr_name, $key_label );

            // Check if the Term name exist and if not we create it.
            if( ! term_exists( $value_name, $taxonomy ) ){
                wp_insert_term( $value_name, $taxonomy, array('slug' => sanitize_title($value_name) ) );

                // Set attribute value for the product
                wp_set_post_terms( $product_id, $value_name, $taxonomy, true );
            }

            if( ! in_array( $taxonomy, array_keys($existing_data_attributes) ) ){
                $position++;
                // Setting formatted post meta data if it doesn't exist in the array
                $product_attributes[$taxonomy] = array (
                    'name'         => $taxonomy,
                    'value'        => '',
                    'position'     => $position,
                    'is_visible'   => 1,
                    'is_variation' => 1,
                    'is_taxonomy'  => 1
                );
            }
        }
        // Save merged data updating the product meta data
        update_post_meta( $product_id, '_product_attributes', array_merge( $existing_data_attributes, $product_attributes ) );
    }
}

?>