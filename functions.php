<?php

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


if(is_plugin_active('kirki/kirki.php')){
    require get_template_directory() . '/functions/fw-theme-options.php';
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
require get_template_directory() . '/functions/fw-icon-shortcodes.php';
//require get_template_directory() . '/demos/fw-democontent.php';
//require get_template_directory() . '/demos/one-click-demo-import/one-click-demo-import.php';
require get_template_directory() . '/functions/fw-user-account.php';
require get_template_directory() . '/functions/fw-blog-options.php';
require get_template_directory() . '/functions/shortcodes/fw-class-woo-shortcodes.php' ;
require get_template_directory() . '/functions/shortcodes/fw-class-shortcodes.php' ;
require get_template_directory() . '/functions/fw-shopping-cart.php' ;
require get_template_directory() . '/functions/fw-ajax-search.php';
//require get_template_directory() . '/functions/fw-widgets.php';
if( !function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if(is_plugin_active('js_composer/js_composer.php')){
    require get_template_directory() . '/functions/vc_customs/vc_fastway.php';
}
if(is_plugin_active('woocommerce/woocommerce.php')){
    require get_template_directory() . '/functions/fw-extra-woo-functions.php';
    require get_template_directory() . '/functions/fw-extra-woo-functions-arg.php';
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




add_action( 'after_setup_theme', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_woocommerce_support' ) ) {

	function understrap_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
}


 /**
  * Example: 
  *     To change all custom product attributes "colour" to "pa_colour" products taxonomy,  we can run:
  * 
  *         http://example.tld/?wpq_mode=run&wpq_from=colour&wpq_to=pa_colour&wpq_ppp=100&wpq_offset=0&wpq_post_type=product&wpq_post_status=any
  * 
  *  WARNING: Remember to backup your database first!!!
  */
  
  add_action( 'template_redirect', function()
  {
      // Activate product attribute modification (only available for admins):
      if( current_user_can( 'manage_options' ) && 'run' === filter_input( INPUT_GET, 'wpq_mode' ) )
      {
          // Setup:
          $meta_key 	= '_product_attributes';
          // User input:
          $from 		= filter_input( INPUT_GET, 'wpq_from', 		FILTER_SANITIZE_STRING 		);
          $to   		= filter_input( INPUT_GET, 'wpq_to', 		FILTER_SANITIZE_STRING 		);
          $post_type  	= filter_input( INPUT_GET, 'wpq_post_type', 	FILTER_SANITIZE_STRING 		);
          $post_status  	= filter_input( INPUT_GET, 'wpq_post_status', 	FILTER_SANITIZE_STRING 		);
          $ppp  		= filter_input( INPUT_GET, 'wpq_ppp', 		FILTER_SANITIZE_NUMBER_INT 	);
          $offset 	= filter_input( INPUT_GET, 'wpq_offset', 	FILTER_SANITIZE_NUMBER_INT 	);
          // Default values:
          if( empty( $ppp ) )
          {
              $ppp = 10;
          }
          if( empty( $offset ) )
          {
              $offset = 0;
          }
          if( empty( $post_type ) )
          {
              $post_type = 'product';
          }
          if( empty( $post_status ) )
          {
              $post_status = 'any';
          }
          
          if( empty( $from ) || empty( $to ) ) 
          {
              wp_die( 'Oh, rembember that the "from" and "to" variable must be set!');
          }
          
          // Fetch products with product attributes:
          $args = array(
              'post_type' 		=> sanitize_key( $post_type ), 
              'fields' 		=> 'ids', 
              'posts_per_page' 	=> (int) $ppp,
              'offset'		=> (int) $offset,
              'meta_key'		=> $meta_key,
              'post_status'		=> sanitize_key( $post_status ),
          );
          $post_ids = get_posts( $args );
          
          foreach( (array) $post_ids as $post_id )
          {		
              $meta = get_post_meta( $post_id, $meta_key, true );
              $product_needs_update = false;
              foreach( (array) $meta as $key => $terms )
              {
                  // Locate our meta attribute:
                  if( $from === $terms['name'] )
                  {
                      $product_needs_update 	= true;
                      $tmp 			= explode( '|', $terms['value'] );			
                      $product_terms		= array();
                      
                      foreach( (array) $tmp as $term )
                      {
                          $product_terms[] = sanitize_key( $term );
                      }
                      
                      // Remove the product meta attribute:
                      unset( $meta[$from] );		
                      
                      // Add it again as product taxonomy attribute:
                      $meta["{$to}"] = array( 
                          'name' 		=> "{$to}",
                          'value' 	=> '',
                          'position' 	=> $terms['position'], 
                          'is_visible' 	=> $terms['is_visible'], 
                          'is_variation' 	=> $terms['is_variation'], 
                          'is_taxonomy' 	=> 1, 
                      );	
                      
                  } // end if
              } // end foreach
              if( $product_needs_update )
              {
                  // Assign terms to the post (create them if they don't exists)
                  $term_taxonomy_ids = wp_set_object_terms( $post_id, $product_terms, $to, false );
                  if ( is_wp_error( $term_taxonomy_ids ) )
                  {
                      printf( "There was an error somewhere and the terms couldn't be set for post_id: %d <hr/>", $post_id );
                  } 
                  else
                  {
                      update_post_meta( $post_id, $meta_key, $meta );
                      printf( "Success! The taxonomy post attributes were set for post_id: %d <hr/>", $post_id );
                      
                  } // end if
                  
              } // end if current post needs update
              
          } // end foreach post
          
          die( 'Done!');
      } // end if "run" action
  });
?>