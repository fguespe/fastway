<?php



load_theme_textdomain( 'fastway', get_template_directory() . '/languages' );
require get_template_directory() . '/inc/builder.php';
if ( ! function_exists( 'fw_theme_mod' ) ) {
  function fw_theme_mod( $field_id, $default_value = '' ) {
    if ( $field_id ) {
      if ( !$default_value ) {
        if ( class_exists( 'Kirki' ) && isset( Kirki::$fields[ $field_id ] ) && isset( Kirki::$fields[ $field_id ]['default'] ) ) {
          $default_value = Kirki::$fields[ $field_id ]['default'];
        }
      }
      $value = get_theme_mod( $field_id, $default_value );
      return $value;
    }
    return false;
  }
  if(!fw_theme_mod('fw_forceupdate_1')){
    //Force update 
    update_option('woocommerce_allowed_countries','all');
    update_option('woocommerce_ship_to_countries','all');
    update_option('woocommerce_default_customer_address','geolocation');
    
    set_theme_mod('fw_forceupdate_1',true);
  }
}

require get_template_directory() . '/functions/emails/fw-emails.php';
require get_template_directory() . '/functions/emails/fw-email-settings-page.php';
require get_template_directory() . '/functions/fw-roles.php';

add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_empty_array',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_empty_array', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

function remove_extra_image_sizes() {
  foreach ( get_intermediate_image_sizes() as $size ) {
      if ( !in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
          remove_image_size( $size );
      }
  }
}

//add_action('init', 'remove_extra_image_sizes');

if( !function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if(!is_plugin_active('kirki/kirki.php')){
  echo "KIRKI MISSING";
  return;
}
if(is_plugin_active('kirki/kirki.php'))require get_template_directory() . '/functions/fw-theme-options.php';



add_action('wp_ajax_nopriv_register_visit', 'fw_register_visit');
add_action('wp_ajax_register_visit', 'fw_register_visit');
function fw_register_visit(){
  $domain=$_SERVER['HTTP_HOST'];
  $fecha=date('m/d/Y h:i:s a', time());
  try{
    global $wpdb;
    $table = 'wp_altoweb_visits';
    $data = array('site'=>get_current_blog_id(),'fecha' => $fecha, 'dominio' => $domain,'type'=>'visit');
    $format = array('%s','%s');
    $wpdb->insert($table,$data,$format);
    $my_id = $wpdb->insert_id;
    
  }catch (Exception $e) {
    error_log('Excepción capturada: ',  $e->getMessage(), "\n"); 
  }
}

add_action('wp_ajax_nopriv_register_wp', 'fw_register_wp');
add_action('wp_ajax_register_wp', 'fw_register_wp');
function fw_register_wp(){
  $domain=$_SERVER['HTTP_HOST'];
  $fecha=date('m/d/Y h:i:s a', time());
  try{
    global $wpdb;
    $table = 'wp_altoweb_visits';
    $data = array('site'=>get_current_blog_id(),'fecha' => $fecha, 'dominio' => $domain,'type'=>'wp');
    $format = array('%s','%s');
    $wpdb->insert($table,$data,$format);
    $my_id = $wpdb->insert_id;
    
  }catch (Exception $e) {
    error_log('Excepción capturada: ',  $e->getMessage(), "\n"); 
  }
}
function fw_vc_get_posts($type) {
    $args = array(
    'taxonomy'   => $type/*,
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids*/
    );
    $product_categories = get_terms($args);
    
    $result = array();
    foreach ( $product_categories as $post ) {
        
        $cat=array($post->name => $post->slug);
        $result=array_merge($result,$cat);
        
    }
    return $result;
}
if(get_locale()=='es_ES'){
  update_option('timezone_string','America/Argentina/Buenos_Aires');
  update_option('date_format','d/m/Y');
  update_option('time_format','H:i');
}

function isLocalhost(){
  return $_SERVER['HTTP_HOST']==='fastway';
}

function fw($string){
  fw_log($string);
}
function fwa($string){
  fw_log($string);
}

function esMultitienda(){
  //Devuelve true si es una multitienda y e rol es otro que minorista
  if(fw_theme_mod('fw_is_multitienda') && !(check_user_role('administrator') || check_user_role('customer') || check_user_role('shop_manager') || check_user_role('subscriber') || check_user_role('guest') )) return true;
  return false;
}

function fw_log($string){
    if(isLocalhost())error_log("fwlog_ : ".$string);
}

if(fw_theme_mod('fw_blog_per_page')!=get_option('posts_per_page'))update_option('posts_per_page',fw_theme_mod('fw_blog_per_page'));

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

        $res_args[$slug] = $slug;//get_the_title($block->ID);
    }
    return $res_args;
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


/** add this to your function.php child theme to remove ugly short code on excerpt */
/** add by Paolo Rudelli aka Paul Corneille 09-06-2014 */
if(!function_exists('remove_vc_from_excerpt'))  {
  function remove_vc_from_excerpt( $excerpt ) {
      $patterns = "/\[[\/]?vc_[^\]]*\]/";
      $replacements = "";
      return preg_replace($patterns, $replacements, $excerpt);
  }
}
/** * Original elision function mod by Paolo Rudelli */
if(!function_exists('qode_excerpt')) {
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined in qode_set_blog_word_count function */
function qode_excerpt() {
global $qode_options_elision, $word_count, $post;
$word_count = isset($word_count) && $word_count != "" ? $word_count : $qode_options_elision['number_of_chars'];
$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
$clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
/** add by PR */
$clean_excerpt = strip_shortcodes(remove_vc_from_excerpt($clean_excerpt));
/** end PR mod */
$excerpt_word_array = explode (' ',$clean_excerpt);
$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
$excerpt = implode (' ', $excerpt_word_array).'...'; echo ''.$excerpt.'';

}
}

if(!is_plugin_active( 'wordpress-seo/wp-seo.php' ) )add_filter ('get_the_excerpt','wpse240352_filter_excerpt');
function wpse240352_filter_excerpt ($post_excerpt) { 
  if(empty($post_excerpt))$post_excerpt=qode_excerpt();
  $post_excerpt = '<p class="desc">' . $post_excerpt . '</p>';
  return $post_excerpt;
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
$THEME_IMG_URI= $THEME_URI . 'assets/img/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';



require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/functions/fw-extra-functions.php';
require get_template_directory() . '/functions/fw-shortcodes.php';
require get_template_directory() . '/functions/fw-icon-shortcodes.php';
require get_template_directory() . '/functions/fw-user-account.php';
require get_template_directory() . '/functions/fw-blog-options.php';
require get_template_directory() . '/functions/shortcodes/fw-class-woo-shortcodes.php' ;
require get_template_directory() . '/functions/shortcodes/fw-class-shortcodes.php' ;
require get_template_directory() . '/functions/fw-ajax-search.php';
require get_template_directory() . '/functions/fw-faq.php';
require get_template_directory() . '/functions/fw-review.php';
require get_template_directory() . '/functions/altoweb-plugin/altoweb-plugin.php';

if(is_plugin_active('js_composer/js_composer.php')){
    require get_template_directory() . '/functions/vc_customs/vc_blog.php';
    require get_template_directory() . '/functions/vc_customs/vc_fastway.php';
}

if(is_plugin_active('woocommerce/woocommerce.php')){
    require get_template_directory() . '/functions/fw-mayoristas.php';
    require get_template_directory() . '/functions/fw-extra-woo-functions.php';
    require get_template_directory() . '/functions/woo-free-shipping-per-product/free-shippging-pre-product.php';
    if(isLocalhost())require get_template_directory() . '/functions/fw-extra-woo-clients.php';
    require get_template_directory() . '/functions/fw-woo-prices-functions.php';
    require get_template_directory() . '/functions/fw-change-requests.php';
    require get_template_directory() . '/functions/fw-woo-marketing.php';
    require get_template_directory() . '/functions/fw-ajax-woo-functions.php';
    require get_template_directory() . '/functions/shipping-calculator/shipping-calculator.php';
    if(is_plugin_active('js_composer/js_composer.php')){
        require get_template_directory() . '/functions/vc_customs/vc_woo_carousels.php';
    }
    require get_template_directory() . '/functions/fw-custom-related.php';
    if(fw_theme_mod('fw_ml_on') || isLocalhost()){
      require get_template_directory() . '/functions/meli/meli.php';
      require get_template_directory() . '/functions/meli/funciones.php';
      require get_template_directory() . '/functions/meli/fw-ml.php';
    }

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

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'fastway' ),
    'vertical' => __( 'Vertical Menu', 'fastway' ),
    'mobile' => __( 'Mobile Menu', 'fastway' ),
    'mobile_bottom' => __( 'Bottom Mobile Menu', 'fastway' ),
) );


if(is_plugin_active('kirki/kirki.php')){
    require get_template_directory() . '/functions/client-area/fw-dashboard.php';
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
        backToBlog.innerHTML='<div width="100%" style="margin:0 auto;text-align:center;"><a href="https://www.altoweb.ar/es/"><img width="200" align="center" style="margin:0 auto;text-align:center;" src="<?php echo fw_theme_mod('ca-dev-logo');?>"></a></div>';
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




add_action( 'after_setup_theme', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_woocommerce_support' ) ) {

	function understrap_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
}



// Adds initial meta to each attachment
function add_initial_file_size_postmeta($column_name, $post_id) {
    static $query_ran;
    if($query_ran !== null) {
      $all_imgs = new WP_Query(array(
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => -1,
        'fields'         => 'ids'
      ));
      $all_imgs_array = $all_imgs->posts;
      foreach($all_imgs_array as $a) {
        if(!get_post_meta($a, 'filesize', true)) {
          $file = get_attached_file($a);
          update_post_meta($a, 'filesize', filesize($file));
        }
      }
      $query_ran = true;
    }
  }
  //add_action('manage_media_custom_column', __NAMESPACE__.'\\add_initial_file_size_postmeta');
 
// Ensure file size meta gets added to new uploads
function add_filesize_metadata_to_images($meta_id, $post_id, $meta_key, $meta_value) {
    if('_wp_attachment_metadata' == $meta_key) {
      $file = get_attached_file($post_id);
      update_post_meta($post_id, 'filesize', filesize($file));
    }
}
add_action('added_post_meta', 'add_filesize_metadata_to_images', 10, 4);
// Add the column
function add_column_file_size($posts_columns) {
  $posts_columns['filesize'] = __('File Size');
  return $posts_columns;
}
add_filter('manage_media_columns', 'add_column_file_size');
// Populate the column
function add_column_value_file_size($column_name, $post_id) {
  if('filesize' == $column_name) {
    if(!get_post_meta($post_id, 'filesize', true)) {
      $file      = get_attached_file($post_id);
      $file_size = filesize($file);
      update_post_meta($post_id, 'filesize', $file_size);
    } else {
      $file_size = get_post_meta($post_id, 'filesize', true);
    }
    echo size_format($file_size, 2);
  }
  return false;
}
add_action('manage_media_custom_column', 'add_column_value_file_size', 10, 2);
// Make column sortable
function add_column_sortable_file_size($columns) {
  $columns['filesize'] = 'filesize';
  return $columns;
}
add_filter('manage_upload_sortable_columns', 'add_column_sortable_file_size');
// Column sorting logic (query modification)
function sortable_file_size_sorting_logic($query) {
  global $pagenow;
  if(is_admin() && 'upload.php' == $pagenow && $query->is_main_query() && !empty($_REQUEST['orderby']) && 'filesize' == $_REQUEST['orderby']) {
    $query->set('order', 'ASC');
    $query->set('orderby', 'meta_value_num');
    $query->set('meta_key', 'filesize');
    if('desc' == $_REQUEST['order']) {
      $query->set('order', 'DSC');
    }
  }
}
add_action('pre_get_posts', 'sortable_file_size_sorting_logic');







function mc_admin_users_caps( $caps, $cap, $user_id, $args ){
 
  foreach( $caps as $key => $capability ){

      if( $capability != 'do_not_allow' )
          continue;

      switch( $cap ) {
          case 'edit_user':
          case 'edit_users':
              $caps[$key] = 'edit_users';
              break;
          case 'delete_user':
          case 'delete_users':
              $caps[$key] = 'delete_users';
              break;
          case 'create_users':
              $caps[$key] = $cap;
              break;
      }
  }

  return $caps;
}
add_filter( 'map_meta_cap', 'mc_admin_users_caps', 1, 4 );

remove_all_filters( 'enable_edit_any_user_configuration' );
add_filter( 'enable_edit_any_user_configuration', '__return_true');

/**
* Checks that both the editing user and the user being edited are
* members of the blog and prevents the super admin being edited.
*/
function mc_edit_permission_check() {
  global $current_user, $profileuser;

  $screen = get_current_screen();

  wp_get_current_user();

  if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
      if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
          wp_die( __( 'You do not have permission to edit this user.' ) );
      } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
          wp_die( __( 'You do not have permission to edit this user.' ) );
      }
  }

}
add_filter( 'admin_head', 'mc_edit_permission_check', 1, 4 );

function fw_precio_vacio($x) {
  if(empty($x))return 0;
  return $x;
}



function get_metsadata( $order_id, $key ) {
  global $wpdb;
  $table_name = $wpdb->prefix . 'woo_mercadoenvios';
  $data = $wpdb->get_var($wpdb->prepare(
    "SELECT `data` FROM
    $table_name
  WHERE
      `order_id` = %d
    AND
      `key` = '%s'
  LIMIT 1",
    (int) $order_id,
    $key
  ));
  return $data;
}


function get_mp_api_data( $response, $object, $request ) {
 
  if( empty( $response->data ) )
      return $response;
  $oid= $response->data['id'];
  error_log(print_r($response->data,true));
  $response->data['mp_op_id']= get_metsadata($oid,'mp_op_id',true);

  return $response;
} 

add_filter( "woocommerce_rest_prepare_shop_order_object",  "get_mp_api_data", 10, 3 );

?>