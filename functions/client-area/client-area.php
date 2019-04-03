<?php

Kirki::add_panel( 'panel_clientarea', array(

    'title'       => __( 'Fastway Client Area', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );
Kirki::add_section( 'section_clientarea', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_clientarea',

) );

/*CLIENT AREA*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'ca-client-logo',
	'label'       => __( 'Login Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => urlforimages()."/assets/img/logo.png",
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'ca-switch',
	'label'       => __( 'Enable', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'ca_roles',
	'label'       => esc_attr__( 'Allowed Roles', 'fastway' ),
	'description'=> 'REFRESH TO EDIT MENU IN CUSTOMIZER!',
	'section'     => 'section_clientarea',
	'choices'     => fw_getme_roles(),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'ca_users',
	'label'       => __( 'Allowed Users', 'fastway' ),
	'description'	=>	'Usernames with ,',
	'section'     => 'section_clientarea',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'ca-main-color',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => '#0C2E5C',
	'choices'     => array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'ca-text-color',
	'label'       => __( 'Text Color', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'ca-icon-color',
	'label'       => __( 'Icon Color', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'ca-dev-logo',
	'label'       => __( 'Developer Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => urlforimages()."/assets/img/brizio.png",
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'ca-dev-favi',
	'label'       => __( 'Top Left Icon', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => urlforimages()."/assets/img/favib.png",
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'ca-home-redirect',
	'label'       => __( 'Default Home', 'fastway' ),
	'description'	=>	'Redirect to other homepage in mobile. Ej. /permalink',
	'section'     => 'section_clientarea',
	'default'     => '',
) );
*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'ca-customcss',
	'label'       => __( 'Client Area Custom CSS', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => '',
	'priority'	=> 20,
	'choices'     => array(
		'language' => 'css',
	),
) );

//Aca empieza el plugin
if(!fw_theme_mod('ca-switch'))return;





include( plugin_dir_path( __FILE__ ) . 'metabox.php');

function activarCA(){
    $roles=fw_theme_mod('ca_roles');
    if(!empty($roles)){
        if(in_array(fw_get_current_user_role() , $roles) && !current_user_can('administrator')){
            return true;
        }    
    }
    $users=explode(",", fw_theme_mod('ca_users'));
    if(in_array(wp_get_current_user()->user_login,$users)){
        return true;
    }
    return false;
}
function fw_get_current_user_role() {
  if( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $role = ( array ) $user->roles;
    return $role[0];
  } else {
    return false;
  }
 }
 function get_is_role_or_name_before(){
    $users=explode(",", fw_theme_mod('ca_users'));
    if(in_array(wp_get_current_user()->user_login,$users)){
        return wp_get_current_user()->user_login;

    }
    return fw_get_current_user_role();
 }



function fw_getmeroles_and_names(){
    $usuarios=explode(",", fw_theme_mod('ca_users'));
    $devolver=fw_getme_roles();
    foreach ($usuarios as $key) {
        $devolver=array_merge($devolver,array($key=>$key));
    }
    return $devolver;
}
add_action('init','fw_create_menus');

function fw_create_menus(){

    $roles=fw_theme_mod('ca_roles');
    if(empty($roles))return;
    $menues=array();
    foreach (fw_getmeroles_and_names() as $rol => $name) {
        if(empty($rol))continue;
        if(!in_array($rol, $roles) && $rol!=$name)continue;
        $menues=array_merge($menues,array('clientarea-'.$rol => __( 'Client Area Menu ('.$name.')', 'fastway' )));
    }
    if(!empty($menues))register_nav_menus( $menues );
}


add_filter( 'login_headerurl', 'fw_wp_logo_url' );
function fw_wp_logo_url($url){
    return "#";
}

//dashboard widgets
function fw_dashboard_widgets() {
    $sidebar_id = 'dash-sidebar';
    $sidebars_widgets = wp_get_sidebars_widgets();
    $widget_ids = $sidebars_widgets[$sidebar_id]; 
   if(empty($widget_ids))return;
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
add_action( 'admin_menu', 'fw_remove_menu_pages' );
function fw_remove_menu_pages() { 
    if (activarCA() ){
        add_menu_page( 'escritorios', "<i class=' fa fa-dashboard'></i> ".'Escritorio', 'read', get_admin_url().'');   
        
        $locations = get_nav_menu_locations();
        $menu = get_term( $locations["clientarea-".get_is_role_or_name_before()], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        if(empty($menu_items))return;
        foreach( $menu_items as $i ) {
            /*Fix FA 4*/
            $fwi=$i->classes[0];
            if($fwi==="bar-chart"){$fwi="chart-bar";}
            add_menu_page("fw-".$i->title, "<i class='fas fa-".$fwi."'></i> ".$i->title,'read',get_admin_url().$i->url);
        }

        
        add_menu_page( 'salir', "<i class=' fa fa-sign-out'></i> ".'Salir', 'read', 'salir', 'fw_menu_salir_link');
    }
}
/*
function fw_menu_salir_link_ca(){
  wp_redirect( wp_logout_url( home_url())); 
  exit;
}*/


//Top bar

function fw_menu_items($wp_admin_bar){
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
    $menu = get_term( $locations["clientarea-".get_is_role_or_name_before()], 'nav_menu' );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    if(!empty($menu_items)){
        foreach( $menu_items as $i ) {
            $fwi=$i->classes[0];
            if($fwi==="bar-chart"){$fwi="chart-bar";}
            $args = array(
                'id' => 'custom-node-'.$i->ID,
                'title' => "<i class='fas fa-".$fwi."'></i> ".$i->title,
                'href' => $i->url,
                'meta' => array(
                    'class' => 'estiloiconomenu titulo-'.$i->slug
                )
            );
            $wp_admin_bar->add_node($args);
        }
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
function fw_remove_dashboard_metaboxes() {
    if (activarCA() ){
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
add_action( 'admin_init', 'fw_remove_dashboard_metaboxes' ); 


function fw_custom_remove_optionspages() {      
    if (activarCA() ){
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
add_action('admin_head-nav-menus.php', 'fw_custom_remove_optionspages');


/**
 * Add all Gravity Forms capabilities to Editor role.
 * Runs during plugin activation.
 * 
 * @access public
 * @return void
 */
function activate_pluginname() {
  
  $role = get_role( 'editor' );
  $role->add_cap( 'gform_full_access' );
}
// Register our activation hook
register_activation_hook( __FILE__, 'activate_pluginname' );

/**
 * Remove Gravity Forms capabilities from Editor role.
 * Runs during plugin deactivation.
 * 
 * @access public
 * @return void
 */
function deactivate_pluginname() {
 
 $role = get_role( 'editor' );
 $role->remove_cap( 'gform_full_access' );
}
// Register our de-activation hook
register_deactivation_hook( __FILE__, 'deactivate_pluginname' );

/*

function fw_redirect_after_login( $redirect_to, $request, $user ){
    // is there a user ?
    
     if ( ! is_wp_error( $user ) ) {
        // do redirects on successful login
        if ( !$user->has_cap( 'administrator' ) && $user->has_cap( 'calendario' ) ) {
            return admin_url('admin.php?page=bookly-calendar' );
        } else {
            return admin_url();
        }
    } else {
        // display errors, basically
        return $redirect_to;
    } 
}
add_filter( 'login_redirect', 'fw_redirect_after_login', 10, 3 );   
*/



/*
*
*
*
******FIN CLIENT AREA
*
*
*
*/


function fw_remove_footer_admin(){
    //return '<div class="footerfw" ><a href="https://www.altoweb.co"><img width="200" align="center"  style="margin:0 auto;text-align:center;" src="'.fw_theme_mod('ca-dev-logo').'"></a></div>';
    return '<a href="https://www.altoweb.co"><img width="200" align="center"  style="margin:0 auto;text-align:center;" src="'.fw_theme_mod('ca-dev-logo').'"></a>';
        
}


add_action( 'init', 'fw_init_adminbar', 999 );
function fw_init_adminbar(){
//    add_action( 'login_footer', 'fw_change_back_to_url' );
    add_filter('admin_footer_text', 'fw_remove_footer_admin');

    if (activarCA() ){
        add_action('admin_bar_menu', 'fw_menu_items', 50);
    }

}


if (activarCA()  ) {
    add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );
}
function wpdocs_enqueue_custom_admin_style() {
    wp_enqueue_style( 'awesome-style', 'https://pro.fontawesome.com/releases/v5.5.0/css/all.css');
    wp_enqueue_style('ca-style', get_template_directory_uri() . '/functions/client-area/ca.css');
    wp_enqueue_script('cajs-style', get_template_directory_uri() . '/functions/client-area/ca.js');
    
}



function fw_hide_admin_bar(){
  if (current_user_can('administrator')) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'fw_hide_admin_bar' );


function fw_custom_admincss() {
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

function fw_admin_css_ui() {
    if (activarCA() )
        add_action('admin_head', 'fw_custom_admincss');
}
add_action('admin_enqueue_scripts', 'fw_admin_css_ui');


