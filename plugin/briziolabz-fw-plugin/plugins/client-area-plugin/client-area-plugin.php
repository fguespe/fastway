<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Client Area Plugin
Plugin URI: https://www.briziolabz.com
Description: Plugin for delivering an easier and professional UI for your clients.
Version: 1.7
Author: Fabrizio Guespe
Author URI: https://www.briziolabz.com
*/

include( plugin_dir_path( __FILE__ ) . 'assets/css/admincss.php');

add_filter( 'login_headerurl', 'wca_wp_logo_url' );
function wca_wp_logo_url($url){
    return "#";
}



add_action('wp_dashboard_setup', 'wca_custom_metaboxes');

function wca_getmetheoptions($vars){
    $options = get_option('plugin_clientarea_settings');
    //echo json_encode($options);
    //echo "ja";
    $options2 = array();
    $allKeys = array_keys($options);    
    foreach ($options as $key => $value) {
        $variables=explode("_", $key);
        $num=$variables[1];
        $esvar=(strcmp($variables[0],$vars)==0);
        //echo $variables[0]." ".$esvar;
        if(is_numeric($num) && $esvar)array_push($options2, $num);
    }
    return array_unique($options2);
}


function wca_custom_metaboxes() {
    global $wp_meta_boxes;
    
    foreach (wca_getmetheoptions("custommetabox") as $i) {
        $texto=get_option('plugin_clientarea_settings')['custommetabox_'.$i.'_text'];
        add_meta_box(
            'custom_help_widget'.$i, 
            get_option('plugin_clientarea_settings')['custommetabox_'.$i.'_label'],
                function ($arg) use ($texto) {
                    echo html_entity_decode($texto);
                },
            'dashboard','side','high');
    }
}




add_action('activate_client-area-plugin/client-area-plugin.php', array('wca','wca_init'));
add_action('admin_menu', array('wca','wca_setup'));

function wca_menu_items($wp_admin_bar){
    $args = array(
            'id' => 'custom-node-dashboard',
            'title' => '<img src="'.get_option('plugin_clientarea_settings')['admin_favi'].'"/>',
            'href' => 'index.php',
            'meta' => array(
                'class' => 'faviconizq'
            )
    );
    $wp_admin_bar->add_node($args);

    $options = get_option('plugin_clientarea_settings');
    
    foreach (wca_getmetheoptions("var") as $i) {
        if($options['var_'.$i.'_check']=="off")continue;
        $args = array(
            'id' => 'custom-node-'.$i,
            'title' => $options['var_'.$i.'_label'],
            'href' => $options['var_'.$i.'_link'],
            'meta' => array(
                'class' => 'estiloiconomenu titulo-'.$i
            )
        );
        $wp_admin_bar->add_node($args);

    }
   
   $args = array(
            'id' => 'custom-node-logout',
            'title' => 'Logout',
            'href' =>  wp_logout_url( home_url()),
            'meta' => array(
                'class' => 'estiloiconomenu ab-top-secondary titulo-Logout'
            )
    );
    $wp_admin_bar->add_node($args);

    



}

//class shrinky {
class wca {
    function wca_init() {

        // set defaults
        $new_options = array(
            'var_1_check' => 'on',
            'var_1_label' => 'Orders',
            'var_1_icon' => '\f09d',
            'var_1_link' => 'edit.php?post_type=shop_order',

            'var_3_check' => 'on',
            'var_3_label' => 'Reports',
            'var_3_icon' => '\f080',
            'var_3_link' => 'admin.php?page=wc-reports',

            'var_4_check' => 'on',
            'var_4_label' => 'Coupons',
            'var_4_icon' => '\f0a1',
            'var_4_link' => 'edit.php?post_type=shop_coupon',

            'var_5_check' => 'off',
            'var_5_label' => 'Blog',
            'var_5_icon' => '\f09e',
            'var_5_link' => 'edit.php',

            'var_6_check' => 'on',
            'var_6_label' => 'Products',
            'var_6_icon' => '\f07a',
            'var_6_link' => 'edit.php?post_type=product',

            'var_7_check' => 'on',
            'var_7_label' => 'Categories',
            'var_7_icon' => '\f02c',
            'var_7_link' => 'edit-tags.php?taxonomy=product_cat&post_type=product',

            'var_8_check' => 'off',
            'var_8_label' => 'Attributes',
            'var_8_icon' => '\f150',
            'var_8_link' => 'edit.php?post_type=product&page=product_attributes',

            'var_9_check' => 'on',
            'var_9_label' => 'Menus',
            'var_9_icon' => '\f0c9',
            'var_9_link' => 'nav-menus.php',

            'var_10_check' => 'on',
            'var_10_label' => 'Users',
            'var_10_icon' => '\f007',
            'var_10_link' => 'users.php',

            'var_11_check' => 'off',
            'var_11_label' => 'Media',
            'var_11_icon' => '\f007',
            'var_11_link' => 'upload.php',

            'is_home_redirect' => 'off',
            'home_redirect' => '',

            'client_logo' => '/wp-content/plugins/client-area-plugin/assets/img/logo.svg',
            'main_color' => '#009FD9',
            'text_color' => 'white',
            'icon_color' => 'white',
            'admin_logo' => '/wp-content/plugins/client-area-plugin/assets/img/logo.svg',
            'admin_favi' => '/wp-content/plugins/client-area-plugin/assets/img/favi.png',
            
            'custom_admin_css' => '',
            'custommetabox_1_label' => 'Soporte',
            'custommetabox_1_text' => '¿Need help? Find more info in our documentation on send us an email to:<br><a href="mailto:support@briziolabz.com" target="_blank">support@briziolabz.com</a>.Also visit out website <a href="https://www.briziolabz.com" target="_self"></a>',
        );
        
        add_option( 'plugin_clientarea_settings', $new_options );
    }
    function getbase(){
        return $new_options;
    }
    function wca_setup() {
        if( function_exists('add_options_page') ) {
            add_options_page(__('Client Area'),__('Client Area'),5,basename(__FILE__),array('wca','wca_ui'));
        }
    }

    function wca_ui() {
        include_once('wca-ui.php');
    }

    

    function get_checko($nombre) {
        $options = get_option('plugin_clientarea_settings');

        return ( $options[$nombre] === 'off' );
    }
    function get_texto($nombre) {
        $options = get_option('plugin_clientarea_settings');

        return $options[$nombre];
    }

}
function wca_redirect_after_login( $redirect_to, $request, $user ){
    // is there a user ?
     if ( ! is_wp_error( $user ) ) {
        // do redirects on successful login
        if ( !$user->has_cap( 'administrator' ) && $user->has_cap( 'shop_manager' ) ) {
            return admin_url( get_option('home_redirect') );
        } else {
            return admin_url();
        }
    } else {
        // display errors, basically
        return $redirect_to;
    } 
}
if(get_option('is_home_redirect')){
    add_filter( 'login_redirect', 'wca_redirect_after_login', 10, 3 );   
}



/*
*
*
*
CLIENT AREA
*
*
*
*/
// Remove dashboard widgets
function wca_remove_dashboard_metaboxes() {
    if (current_user_can('shop_manager') && !current_user_can('administrator')){
        //Dashboard
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
        remove_meta_box( 'email_log_dashboard_widget', 'dashboard', 'normal' );
        
        //remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal' );
        remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
        remove_meta_box( 'custom_help_widget', 'dashboard', 'normal' );
        remove_meta_box( 'sendgrid_statistics_widget', 'dashboard', 'normal' );
        remove_meta_box( 'redux_dashboard_widget', 'dashboard', 'normal' );
        remove_meta_box( 'wp_welcome_panel', 'dashboard', 'normal' );
         
        //Menus
        remove_meta_box( 'add-nth_gallery_cat', 'nav-menus', 'side' );
        
    }
}
add_action( 'admin_init', 'wca_remove_dashboard_metaboxes' ); 


function wca_custom_remove_optionspages() {      
    if (current_user_can('shop_manager') && !current_user_can('administrator')){
        remove_meta_box('nav-menu-theme-locations', 'nav-menus', 'side'); 
        remove_meta_box('add-post', 'nav-menus', 'side'); 
        remove_meta_box('add-category', 'nav-menus', 'side'); 
        remove_meta_box('add-product-category', 'nav-menus', 'side'); 
        remove_meta_box('add-nth_gallery_cat', 'nav-menus', 'side'); 
        remove_meta_box('add-post-type-product', 'nav-menus', 'side'); 
        remove_meta_box('add-post-type-nth_stblock', 'nav-menus', 'side'); 
        remove_meta_box('add-post-type-portfolio', 'nav-menus', 'side'); 
        remove_meta_box('add-post-type-nth_gallery', 'nav-menus', 'side'); 
        remove_meta_box('add-post_tag', 'nav-menus', 'side'); 
        remove_meta_box('add-post_format', 'nav-menus', 'side'); 
        remove_meta_box('add-product_tag', 'nav-menus', 'side'); 
        remove_meta_box('add-portfolio_cat', 'nav-menus', 'side'); 
        remove_meta_box('add-portfolio_tag', 'nav-menus', 'side'); 
        remove_meta_box('add-nth_gallery_cat', 'nav-menus', 'side');
        remove_meta_box('woocommerce_endpoints_nav_link', 'nav-menus', 'side'); 
        remove_meta_box('add-post-type-post', 'nav-menus', 'side'); 
    }
}
add_action('admin_head-nav-menus.php', 'wca_custom_remove_optionspages');


function wca_custom_js() {
    if (current_user_can('shop_manager'))wp_enqueue_script( 'adminscripts', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), NULL, true );
}
add_action( 'admin_enqueue_scripts', 'wca_custom_js' );



/*PARA QUE EL SHOP MANAGER EDITE EL MENU*/
function wca_allow_users_to_shopmanager() {
    $role = get_role( 'shop_manager' );
    $role->add_cap( 'edit_theme_options' ); 
    $role->add_cap( 'manage_options' ); 
    $role->add_cap( 'add_users' ); 
    $role->add_cap( 'create_users' ); 
    $role->add_cap( 'edit_users' ); 
    $role->add_cap( 'gravityforms_create_form' ); 
    $role->add_cap( 'gravityforms_edit_forms' ); 
    $role->add_cap( 'gravityforms_view_entries' ); 
    $role->add_cap( 'gravityforms_user_registration' ); 




}

if ( class_exists( 'WooCommerce' ))add_action( 'admin_init', 'wca_allow_users_to_shopmanager');







/*
*
*
*
******FIN CLIENT AREA
*
*
*
*/

function wca_custom_loginui() {
echo '<style type="text/css">
h1 a {background-image: url('.get_option('plugin_clientarea_settings')['client_logo'].') !important; }
/*LOGIN*/
#login h1 a{
    width:100%;
    background-size: auto auto;
    background-size: contain; 
}
p.register{
    display:none;
}
button,a,input,textarea,.vc_row,ul,li,div{
    border-radius:0px !important;
}
.login{
    background:white !important;
}
#loginform{
    border: 1px solid '.get_option('plugin_clientarea_settings')["main_color"].';
}
#wp-submit{
    color: white;
    border:0px !important;
    border-radius:0px;
    background: '.get_option('plugin_clientarea_settings')["main_color"].' !important;
    text-shadow:none;
    -webkit-box-shadow:none;
}</style>';
}
add_action('login_head', 'wca_custom_loginui');


function wca_remove_footer_admin(){
    echo '<div width="100%" style="margin:0 auto;text-align:center;" ><a href="https://www.briziolabz.com"><img width="200" align="center"  style="margin:0 auto;text-align:center;" src="'.home_url().'/wp-content/plugins/briziolabz-plugin/assets/img/logo.svg"></a></div>';
 
}
 
function wca_change_back_to_url() {
    ?>
    <script type="text/javascript">
        var backToBlog = document.getElementById( 'backtoblog' ).getElementsByTagName( 'a' )[0];
        backToBlog.innerHTML='<div width="100%" style="margin:0 auto;text-align:center;"><a href="https://www.briziolabz.com"><img width="200" align="center" style="margin:0 auto;text-align:center;" src="<?php echo home_url().'/wp-content/plugins/briziolabz-plugin/assets/img/logo.svg';?>"></a></div>';
    </script>
    <?php
}

add_action( 'init', 'init_adminbar', 999 );
function init_adminbar(){
    add_action( 'login_footer', 'wca_change_back_to_url' );
    add_filter('admin_footer_text', 'wca_remove_footer_admin');

    if (current_user_can('shop_manager') && !current_user_can('administrator')){
        add_action('admin_bar_menu', 'wca_menu_items', 50);
        // change url for login screen
    }

}

function wca_FontAwesome() {
   wp_enqueue_style('my-admin-style', plugins_url('/font-awesome/css/font-awesome.min.css', __FILE__));
}

add_action('admin_head', 'wca_FontAwesome');
add_action('wp_head', 'wca_FontAwesome');



function hide_admin_bar(){
  if (current_user_can('administrator')) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar' );






//Mobile?
add_action( 'admin_menu', 'wca_remove_menu_pages' );
function wca_remove_menu_pages() { 
    if (current_user_can('shop_manager') && !current_user_can('administrator')){
        if(get_option('admin_option_escritorio') ){
        
            add_menu_page( 'escritorio', 'Escritorio', 'read', 'fguespe1', 'wca_menu_escritorio_link');   
        }
        if(get_option('admin_option_pedidos') ){
            
            add_menu_page( 'pedidos', 'Pedidos', 'read', 'fguespe2', 'wca_menu_pedidos_link');   

        }
        if(get_option('admin_option_productos') ){
        
            add_menu_page( 'productos', 'Productos', 'read', 'productos', 'wca_menu_productos_link');
        }


        if(get_option('admin_option_usuarios') ){
        add_menu_page( 'usuarios', 'Usuarios', 'read', 'usuarios', 'wca_menu_usuarios_link');
           
        }
        add_menu_page( 'salir', 'Salir', 'read', 'salir', 'wca_menu_salir_link');
    }
}
function wca_admin_css_ui() {
    if (current_user_can('shop_manager') && !current_user_can('administrator'))add_action('admin_head', 'wca_custom_admincss');
}
add_action('admin_enqueue_scripts', 'wca_admin_css_ui');


function wca_menu_salir_link_ca(){
  wp_redirect( wp_logout_url( home_url())); 
  exit;
}
function wca_menu_producto_link_ca(){
  wp_redirect( 'edit.php?post_type=product'); 
  exit;
}

function wca_menu_pedidos_link_ca(){
  wp_redirect( "edit.php?post_type=shop_order"); 
  exit;
}
function wca_menu_usuarios_link_ca(){
  wp_redirect( "users.php"); 
  exit;
}
function wca_menu_escritorio_link_ca(){
  wp_redirect( "index.php"); 
  exit;
}






