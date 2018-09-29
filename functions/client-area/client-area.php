<?php

include( plugin_dir_path( __FILE__ ) . 'metabox.php');

add_filter( 'login_headerurl', 'wca_wp_logo_url' );
function wca_wp_logo_url($url){
    return "#";
}



//dashboard widgets
function fw_dashboard_widgets() {
    $sidebar_id = 'dash-sidebar';
    $sidebars_widgets = wp_get_sidebars_widgets();
    $widget_ids = $sidebars_widgets[$sidebar_id]; 
   
    foreach( $widget_ids as $id ) {
        $wdgtvar = 'widget_'._get_widget_id_base( $id );
        $idvar = _get_widget_id_base( $id );
        $instance = get_option( $wdgtvar );
        $idbs = str_replace( $idvar.'-', '', $id );
        $titulo=$instance[$idbs]['title'];
        $content=$instance[$idbs]['text'];
        add_meta_box(
            'custom_help_widget'.$idbs, $titulo,
                function ($arg) use ($content) {
                    echo html_entity_decode($content);
                },
            'dashboard','side','high');
    }
}
add_action( 'init', 'fw_dashboard_widgets' );



//Menu mobile
add_action( 'admin_menu', 'wca_remove_menu_pages' );
function wca_remove_menu_pages() { 
    if (current_user_can('shop_manager') && !current_user_can('administrator')){
        add_menu_page( 'escritorios', "<i class=' fa fa-dashboard'></i> ".'Escritorio', 'read', get_admin_url().'');   
        
        $locations = get_nav_menu_locations();
        $menu = get_term( $locations["clientarea"], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
     
        foreach( $menu_items as $i ) {
     
            add_menu_page("fw-".$i->title, "<i class=' fa fa-".$i->classes[0]."'></i> ".$i->title,'read',get_admin_url().$i->url);
        }

        
        add_menu_page( 'salir', "<i class=' fa fa-sign-out'></i> ".'Salir', 'read', 'salir', 'wca_menu_salir_link');
    }
}

function wca_menu_salir_link_ca(){
  wp_redirect( wp_logout_url( home_url())); 
  exit;
}


//Top bar

function wca_menu_items($wp_admin_bar){
    $args = array(
            'id' => 'custom-node-dashboard',
            'title' => '<img src="'.fw_theme_mod('ca-dev-favi').'"/>',
            'href' => 'index.php',
            'meta' => array(
                'class' => 'faviconizq'
            )
    );
    $wp_admin_bar->add_node($args);

    $locations = get_nav_menu_locations();
    $menu = get_term( $locations["clientarea"], 'nav_menu' );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
 
    foreach( $menu_items as $i ) {
        $args = array(
            'id' => 'custom-node-'.$i->ID,
            'title' => "<i class=' fa fa-".$i->classes[0]."'></i> ".$i->title,
            'href' => $i->url,
            'meta' => array(
                'class' => 'estiloiconomenu titulo-'.$i->slug
            )
        );
        $wp_admin_bar->add_node($args);
    }

    $args = array(
            'id' => 'custom-node-logout',
            'title' => "<i class=' fa fa-sign-out'></i> ".'Logout',
            'href' =>  wp_logout_url( home_url()),
            'meta' => array(
                'class' => 'estiloiconomenu ab-top-secondary titulo-Logout'
            )
    );
    $wp_admin_bar->add_node($args);

    



}

//Declare menus
register_nav_menus( array(
    'clientarea-shop_manager' => __( 'Client Area Menu (Shop Manager)', 'fastway' ),
    'clientarea-editor' => __( 'Client Area Menu (Editor)', 'fastway' ),
) );


function wca_redirect_after_login( $redirect_to, $request, $user ){
    // is there a user ?
     if ( ! is_wp_error( $user ) ) {
        // do redirects on successful login
        if ( !$user->has_cap( 'administrator' ) && $user->has_cap( 'shop_manager' ) ) {
            return admin_url( fw_theme_mod('ca-home-redirect') );
        } else {
            return admin_url();
        }
    } else {
        // display errors, basically
        return $redirect_to;
    } 
}
if(fw_theme_mod('ca-home-redirect')){
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
        remove_meta_box('metaslider', 'nav-menus', 'side'); 

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
    $role->add_cap( 'gravityforms_user_registration'); 
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
h1 a {background-image: url('.fw_theme_mod('ca-client-logo').') !important; }
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
    border: 1px solid '.fw_theme_mod('ca-main-color').';
}
#wp-submit{
    color: white;
    border:0px !important;
    border-radius:0px;
    background: '.fw_theme_mod('ca-main-color').' !important;
    text-shadow:none;
    -webkit-box-shadow:none;
}</style>';
}
add_action('login_head', 'wca_custom_loginui');


function wca_remove_footer_admin(){
    echo '<div width="100%" style="margin:0 auto;text-align:center;" ><a href="https://www.briziolabz.com"><img width="200" align="center"  style="margin:0 auto;text-align:center;" src="'.home_url().'/wp-content/plugins/briziolabz-fw-plugin/assets/img/logo.svg"></a></div>';
 
}
 
function wca_change_back_to_url() {
    ?>
    <script type="text/javascript">
        var backToBlog = document.getElementById( 'backtoblog' ).getElementsByTagName( 'a' )[0];
        backToBlog.innerHTML='<div width="100%" style="margin:0 auto;text-align:center;"><a href="https://www.briziolabz.com"><img width="200" align="center" style="margin:0 auto;text-align:center;" src="<?php echo home_url().'/wp-content/plugins/briziolabz-fw-plugin/assets/img/logo.svg';?>"></a></div>';
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

function ca_enqueue() {
    wp_enqueue_style('awesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('ca-style', get_template_directory_uri() . '/functions/client-area/ca.css');
    wp_enqueue_script('cajs-style', get_template_directory_uri() . '/functions/client-area/ca.js');
}

if (current_user_can('shop_manager')  && !current_user_can('administrator')) {
add_action('admin_head', 'ca_enqueue');
add_action('wp_head', 'ca_enqueue');
}



function hide_admin_bar(){
  if (current_user_can('administrator')) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar' );


function wca_custom_admincss() {
    echo '<style type="text/css">
    :root{
        --ca-main-color: '.fw_theme_mod('ca-main-color').';
        --ca-second-color: #F9FAFA;
        --ca-background-color: #F9FAFA;
        --ca-text-color: '.fw_theme_mod("ca-text-color").' ;
        --ca-icon-color: '.fw_theme_mod("ca-icon-color").' ;
    }</style>';
}



//Mobile?

function wca_admin_css_ui() {
    if (current_user_can('shop_manager') && !current_user_can('administrator'))
        add_action('admin_head', 'wca_custom_admincss');
}
add_action('admin_enqueue_scripts', 'wca_admin_css_ui');


