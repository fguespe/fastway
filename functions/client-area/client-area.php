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
Kirki::add_section( 'section_clientwidgets', array(
    'title'          => __( 'Widgets', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_clientarea',
) );

Kirki::add_section( 'section_client_admin', array(
    'title'          => __( 'Admin', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_clientarea',
) );

/*MELI*/


/*WOO AREA*/

Kirki::add_section( 'section_wooarea', array(
    'title'          => __( 'Woocommerce', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_clientarea',

) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_id_filesync',
	'label'       => __( 'ID Excel', 'fastway' ),
	'description'	=>	'Copiar esto en el menu de client area. Es para que el cliente reemplaze el excel de la importacion. upload.php?page=enable-media-replace%2Fenable-media-replace.php&action=media_replace&attachment_id=ACA EL ID',
	'section'     => 'section_wooarea',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_id_wpallimport',
	'label'       => __( 'ID de la importación', 'fastway' ),
	'description'	=>	'Luego de subir el file, lo reidije al id de importacion de wpallimport correspondiente.',
	'section'     => 'section_wooarea',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'woocommerce_thankyou',
	'label'       => __( 'Columna Rol En Pedidos', 'fastway' ),
	'section'     => 'section_client_admin',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

/*CLIENT AREA WIDGETS*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_desc_prods',
	'label'       => __( 'Descuento productos', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_cupones',
	'label'       => __( 'Cupones', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_popup',
	'label'       => __( 'Popup', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_estado',
	'label'       => __( 'Estado del sitio', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_lili_discount',
	'label'       => __( 'Lili Discount (CR)', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_cuotas_tp',
	'label'       => __( 'Cuotas Todopago', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_cuotas_general',
	'label'       => __( 'Cuotas General', 'fastway' ),
	'section'     => 'section_clientwidgets',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_mensaje_barra',
    'label'       => __( 'Mensaje General', 'fastway' ),
    'description' => 'Barra roja que va a arriba [fw_mensaje_barra]',
	'section'     => 'section_clientwidgets',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_mensaje_sec',
	'label'       => __( 'Mensaje Secundario ', 'fastway' ),
    'description' => 'Puede ser usado en distintos lugares.(como elementos) [fw_mensaje_sec]',
	'section'     => 'section_clientwidgets',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
/*CLIENT AREA*/



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'ca-clientarea-logo',
	'label'       => __( 'Login Logo', 'fastway' ),
	'description' => __( 'No hay necesidad de ponerlo ya que toma el logo general, si se pone algo lo sobreescribe.', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => '',
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
	'default'     => 'shop_manager',
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
	'default'     => urlforimages()."/assets/img/logo.svg",
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'ca-dev-favi',
	'label'       => __( 'Top Left Icon', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_clientarea',
	'default'     => urlforimages()."/assets/img/favi.png",
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
    if(fw_theme_mod('ca_roles')=='')return false;
    $roles=fw_theme_mod('ca_roles');
    if(gettype($roles)=='string')$roles=explode(',',$roles);
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


add_action('init','fw_create_menus');
function fw_create_menus(){
    if(fw_theme_mod('ca_roles')=='')return false;
    $roles=fw_theme_mod('ca_roles');if(gettype($roles)=='string')$roles=explode(',',$roles);
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
       /* add_meta_box(
            'custom_help_widget'.$idbs, $titulo,
                function ($arg) use ($content) {
                    echo html_entity_decode($content);
                },
            'dashboard','side','high');*/
    }
}
add_action( 'init', 'fw_dashboard_widgets' );



//Menu mobile
add_action( 'admin_menu', 'fw_remove_menu_pages' );
function fw_remove_menu_pages() { 
    if (activarCA() ){
        add_menu_page( 'escritorios', "<i class=' sfa-dashboard'></i> ".'Escritorio', 'read', get_admin_url().'');   
        
        $locations = get_nav_menu_locations();
        $menu = get_term( $locations["clientarea-".get_is_role_or_name_before()], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        if(empty($menu_items))return;
        foreach( $menu_items as $i ) {
            /*Fix FA 4*/
            $fwi=implode(" ",$i->classes);
            if(!empty($i->classes[1]))
            if($fwi==="bar-chart"){$fwi="chart-bar";}
            if( strpos($fwi, 'fa-' ) === false) $fwi='fas fa-'.$fwi;
            add_menu_page("fw-".$i->title, "<i class='".$fwi."'></i> ".$i->title,'read',get_admin_url().$i->url);
        }

        
        add_menu_page( 'salir', "<i class=' fas fa-sign-out'></i> ".'Salir', 'read', 'salir', 'fw_menu_salir_link');
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
            $fwi=implode(" ",$i->classes);
            if(!empty($i->classes[1]))
            if($fwi==="bar-chart"){$fwi="chart-bar";}
            if( strpos($fwi, 'fa-' ) === false) $fwi='fas fa-'.$fwi;
            if($fwi==="bar-chart"){$fwi="chart-bar";}
            $args = array(
                'id' => 'custom-node-'.$i->ID,
                'title' => "<i class='".$fwi."'></i> ".$i->title,
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
            'title' => "<i class=' fas fa-sign-out'></i> ".'Logout',
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

function custom_admin_js() {
    //if(check_user_role('administrator'))return;
    $nombre=fw_theme_mod('fw_mail_desde_nombre');
    $mail=explode(",",fw_theme_mod('fw_mail_desde_mails'))[0];
    echo '<script>
	window.fwSettings={
	"widget_id":36000000453
	};
	!function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}() 
    </script>
    <script type="text/javascript" src="https://widget.freshworks.com/widgets/36000000453.js" async defer></script>
    <script>
        FreshworksWidget("identify", "ticketForm", {
            name: "'.$nombre.'",
            email: "'.$mail.'",
        });

    </script>';

}
add_action('admin_footer', 'custom_admin_js');


/*
function activate_pluginname() {
  
  $role = get_role( 'editor' );
  $role->add_cap( 'gform_full_access' );
}
// Register our activation hook
register_activation_hook( __FILE__, 'activate_pluginname' );

function deactivate_pluginname() {
 
 $role = get_role( 'editor' );
 $role->remove_cap( 'gform_full_access' );
}
// Register our de-activation hook
register_deactivation_hook( __FILE__, 'deactivate_pluginname' );

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



function fw_remove_footer_admin(){
    //return '<div class="footerfw" ><a href="https://www.altoweb.co"><img width="200" align="center"  style="margin:0 auto;text-align:center;" src="'.fw_theme_mod('ca-dev-logo').'"></a></div>';
    return '<a class="footeralto" href="https://www.altoweb.co"><img width="120"  align="center"  style="margin:0 auto;text-align:center;" src="'.fw_theme_mod('ca-dev-logo').'"></a>';
        
}

function my_footer_shh() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}

add_action( 'admin_menu', 'my_footer_shh' );

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
    //wp_enqueue_style( 'awesome-style', 'https://pro.fontawesome.com/releases/v5.5.0/css/all.css');
    wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/cf0e255dde.js');
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
    .media-modal{
        width:80% !important;
    }
    .ocultar{
        display:none;
    }
    .user-new-php .notice{
        display: block !important;
    }
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
    add_action('admin_head', 'fw_custom_admincss');
}
add_action('admin_enqueue_scripts', 'fw_admin_css_ui');


