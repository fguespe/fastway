<?php

Kirki::add_section( 'section_data', array(
    'title'          => __( 'Company Data', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_whatsapp', array(
    'title'          => __( 'Whatsapp', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_clientarea', array(
    'title'          => __( 'Client Area', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_clientwidgets', array(
    'title'          => __( 'Dashboard Widgets', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',
) );

if(is_webaltoweb()){
Kirki::add_section( 'section_client_admin', array(
    'title'          => __( 'Change Requests', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',
) );
}
/*MELI*/


/*WOO AREA*/
Kirki::add_section( 'section_wooarea', array(
    'title'          => __( 'Imports', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

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
	'type'        => 'text',
	'settings'    => 'fw_id_wpallexport',
	'label'       => __( 'ID de la exportacion', 'fastway' ),
	'description'	=>	'Luego de subir el file, lo reidije al id de importacion de wpallimport correspondiente.',
	'section'     => 'section_wooarea',
	'default'     => '',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_client_admin_columnaprecio',
	'label'       => __( 'Columna Precio Mayorista', 'fastway' ),
	'section'     => 'section_client_admin',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_trans_comprobantes',
	'label'       => __( 'Comprobantes de transferencia (CR)', 'fastway' ),
	'description'	=> 'Permite subir archivos a las ordenes.',
	'section'     => 'section_client_admin',
	'default'     => 0,
	'choices' => array(
		0  => __( 'Disable', 'fastway' ),
		1 => __( 'Enable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_trans_comprobantes_id',
	'label'       => __( 'ID del form', 'fastway' ),
	'section'     => 'section_client_admin',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_client_admin_columnarol',
	'label'       => __( 'Columna Rol En Pedidos', 'fastway' ),
	'section'     => 'section_client_admin',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_crear_cuenta_a_sendy',
	'label'       => __( 'Signups sendy list', 'fastway' ),
	'section'     => 'section_client_admin',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_forms_a_sendy',
	'label'       => __( 'Forms to sendy', 'fastway' ),
	'section'     => 'section_client_admin',
    'default'     => '',
    'description' => 'form_id,field_number,sendy_list|form_id,field_number,sendy_list|'
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
if(is_webaltoweb()){
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
        'settings'    => 'fw_widget_lili_discount_multi',
        'label'       => __( 'Multi Lili Discount (CR)', 'fastway' ),
        'section'     => 'section_clientwidgets',
        'default'     => 0,
        'choices' => array(
            'on'  => __( 'Enable', 'fastway' ),
            'off' => __( 'Disable', 'fastway' )
        )
    ) );
}

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

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_widget_support_fresh_es',
	'label'       => __( 'Support Widget', 'fastway' ),
    'description' => 'Freshdesk support widget',
	'section'     => 'section_clientwidgets',
	'default'     => 1,
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
	'label'       => __( 'Allowed Roles', 'fastway' ),
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

function admin_default_page() {
	return fw_theme_mod('ca-home-redirect');
}  
if(fw_theme_mod('ca-home-redirect'))add_filter('login_redirect', 'admin_default_page');

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'ca-home-redirect',
	'label'       => __( 'Default Home', 'fastway' ),
	'description'	=>	'Redirect to other homepage in mobile. Ej. /permalink',
	'section'     => 'section_clientarea',
	'default'     => '',
) );

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

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'ca-videos',
	'label'       => __( 'Client Video Tutorials', 'fastway' ),
	'description' => 'Agrega al dashboard videos, uno por linea',
	'section'     => 'section_clientarea',
	'default'     => '',
	'priority'	=> 20,
) );


//Aca empieza el plugin
if(!fw_theme_mod('ca-switch'))return;

/*WHATSAPP*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companywhatsapp',
	'label'    => __( 'Company Whatsapp', 'fastway' ),
    'description'     => __( '[fw_data type="whatsapp"] empezar con 549, sin el + [fw_data type="whatsapp"] Ej: 11 54 999 795 (5491154999795)', 'fastway' ),
	'section'     => 'section_whatsapp',
	'input_attrs' => array(
		'placeholder' => fw_theme_mod("short-fw_companyphone")
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_whats_btn',
	'label'    => __( 'Whats Label', 'fastway' ),  
	'description' => '[br] para new line',     
	'section'     => 'section_whatsapp',
	'default' 		=>	'Estamos[br]On-Line!',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_share_message',
	'label'    => __( 'Share Message', 'fastway' ),       
	'section'     => 'section_whatsapp',
	'default' 		=>	'¡Hola! Quisiera hacer una consulta por un producto que me intereso en su web',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_chat_whats',
	'label'    => __( 'Button Menu Whatsapp', 'fastway' ),       
	'section'     => 'section_whatsapp',
	'default' 		=>	'Consultar',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'whats-button',
	'label'       => __( 'Whatsapp Widget', 'fastway' ),
	'section'     => 'section_whatsapp',
	'default'     => 'simple',
	'choices'     => array(
		'none'   	=> 	'None',
		'simple'   	=> 	'Simple',
		'random'   	=> 	'Random',
		'multi' 	=> 	'Multiple',
	),
) );




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
        add_menu_page( 'escritorios', "<i class=' sfa-dashboard'></i> ".__('Dashboard','fastway'), 'read', get_admin_url().'');   
        
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

        
        add_menu_page( 'salir', "<i class=' fas fa-sign-out'></i> ".__('Salir','fastway'), 'read', 'salir', 'fw_menu_salir_link');
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




if(fw_theme_mod('fw_widget_support_fresh_es'))add_action('admin_footer', 'custom_admin_js');
function custom_admin_js() {
    //if(check_user_role('administrator'))return;
    $nombre=get_bloginfo( 'name' );
	$mail=getMailQueEnvia();
	//freshdesk
	if(fw_theme_mod('fw_is_multitienda') || 1==1){
		echo '
		<script>
	  function initFreshChat() {
		window.fcWidget.init({
		  token: "3d87a863-f4ce-4bda-a5fe-f8df811e663d",
		  host: "https://wchat.freshchat.com",
		  externalId: "'.$nombre.'",   
		});
		// To set user name
		window.fcWidget.user.setFirstName("'.$nombre.'");

		// To set user email
		window.fcWidget.user.setEmail("'.$mail.'");

		// To set user properties
		window.fcWidget.user.setProperties({
		plan: "Estate",                 // meta property 1
		status: "Active"                // meta property 2
		});
	  }
	  function initialize(i,t){var e;i.getElementById(t)?initFreshChat():((e=i.createElement("script")).id=t,e.async=!0,e.src="https://wchat.freshchat.com/js/widget.js",e.onload=initFreshChat,i.head.appendChild(e))}function initiateCall(){initialize(document,"freshchat-js-sdk")}window.addEventListener?window.addEventListener("load",initiateCall,!1):window.attachEvent("load",initiateCall,!1);
	</script>';

	}else{

		echo '<script>
		jQuery.browser = {};
	(function () {
		jQuery.browser.msie = false;
		jQuery.browser.version = 0;
		if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
			jQuery.browser.msie = true;
			jQuery.browser.version = RegExp.$1;
		}
	})();
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

}





function fw_remove_footer_admin(){
    //return '<div class="footerfw" ><a href="https://www.altoweb.ar/es/"><img width="200" align="center"  style="margin:0 auto;text-align:center;" src="'.fw_theme_mod('ca-dev-logo').'"></a></div>';
    return '<a class="footeralto" href="https://www.altoweb.ar/es/"><img width="120"  align="center"  style="margin:0 auto;text-align:center;" src="'.fw_theme_mod('ca-dev-logo').'"></a>';
        
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


if (activarCA())add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );

function wpdocs_enqueue_custom_admin_style() {
    //wp_enqueue_style( 'awesome-style', 'https://pro.fontawesome.com/releases/v5.5.0/css/all.css');
    wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/cf0e255dde.js');
    wp_enqueue_style('ca-style', get_template_directory_uri() . '/functions/client-area/ca.css' );    
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
	echo '<style type="text/css">';
	echo fw_theme_mod('ca-customcss');
	echo '
    .media-modal{
        width:80% !important;
    }
    .ocultar{
        display:none;
    }
    .user-new-php usuarios.notice{
        display: block !important;
    }
    .vc_license-activation-notice{
        display:none !important;
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
add_action('admin_enqueue_scripts', 'fw_admin_css_ui');
function fw_admin_css_ui() {
    if(!is_webaltoweb())add_action('admin_head', 'fw_custom_admincss');
}


function hide_specs(){
	echo '
	<style>
	.woocommerce-product-attributes-item--weight,
	.woocommerce-product-attributes-item--dimensions{
			display:none;
	}
	</style>';
}
if(!fw_theme_mod('fw_tab_hide_specs'))add_action('wp_head', 'hide_specs');



