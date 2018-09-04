<?php
/*
Plugin Name: BrizioLabz for Fastway
Plugin URI: https://www.briziolabz.com
Description: Plugin de funcionalidades de briziolabz.com
Version: 1.9
Author: Fabrizio Guespe
Author URI: https://www.briziolabz.com
*/

include( plugin_dir_path( __FILE__ ) . 'plugins/client-area-plugin/client-area-plugin.php');
include( plugin_dir_path( __FILE__ ) . 'plugins/woocommerce-taxomizer/woocommerce-taxomizer.php');
include( plugin_dir_path( __FILE__ ) . 'plugins/rename-wp-login.php');
include( plugin_dir_path( __FILE__ ) . 'functions/importer/enable-media-replace.php');
//agregar fastwat VERFW
//include( plugin_dir_path( __FILE__ ) . 'functions/woo-empty-cart-button.php');
//include( plugin_dir_path( __FILE__ ) . 'functions/woocommerce_custom_related_products.php');
//include( plugin_dir_path( __FILE__ ) . 'functions/tab_descargas.php');
//include( plugin_dir_path( __FILE__ ) . 'functions/tab_video.php');

include( plugin_dir_path( __FILE__ ) . 'functions/sendy/sendy.php');
include( plugin_dir_path( __FILE__ ) . 'functions/admin_options.php');
include( plugin_dir_path( __FILE__ ) . 'functions/sistema_mayorista.php');
include( plugin_dir_path( __FILE__ ) . 'functions/moneda_options.php');


//my_plugin_activation(true);




if(get_option('taxomizerwpai'))add_action('pmxi_after_xml_import', 'after_xml_import_init_cate', 10, 1);
function after_xml_import_init_cate($import_id){
    $varss="product_cat,".get_option('taxomizer_customtax');
    $args     = array( 'post_type' => 'product' , 'posts_per_page'=>-1, 'numberposts'=>-1);
    $products = get_posts( $args ); 
      
    foreach (explode(",",$varss) as $nombre ) {
      $nombre=strtolower($nombre);
      $tipo=$nombre;
      if(empty($nombre))break;
      foreach ($products as $prod) {
          wootax_procesar_producto(get_post($prod->ID),wootax_categorizacon_array(get_option('taxomizer_'.$nombre.'_vars')),$nombre); 
      }
    }  
}






  
// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_dni'] = array(
        'label'     => __('DNI/CUIT', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );

     return $fields;
}
if(get_option('briziolabz_defaultoptions')){
    update_option('woocommerce_price_num_decimals','0');
    update_option('woocommerce_currency','ARS');
    update_option('woocommerce_default_country','AR:C');
    update_option('woocommerce_cart_redirect_after_add','yes');
    update_option('woocommerce_enable_ajax_add_to_cart','no');
    update_option('shop_single_image_size','a:3:{s:5:"width";s:3:"500";s:6:"height";s:3:"500";s:4:"crop";i:1;}');
    update_option('woocommerce_enable_myaccount_registration','yes');
    update_option('woocommerce_enable_signup_and_login_from_checkout','yes');
    update_option('woocommerce_enable_checkout_login_reminder','yes');
    update_option('woocommerce_registration_generate_username','yes');
    update_option('woocommerce_enable_shipping_calc','no');
    update_option('woocommerce_registration_generate_password','yes');
    update_option('briziolabz_defaultoptions','0');
}


function my_custom_action() { 
    echo '<a href="tel:'.get_option('nubicommerce_menu_tel').'" class="clicktocall" style="display: none;"><i class="fa fa-phone"></i>LLAMAR</a>';
};     
if(!empty(get_option('nubicommerce_menu_tel'))){
add_action( 'woocommerce_single_product_summary', 'my_custom_action', 29 );    
}


/**
 * Display field value on the order edit page
 */
 
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('DNI/CUIT').':</strong> ' . get_post_meta( $order->get_id(), '_billing_dni', true ) . '</p>';
}

/*----------------------------------------------------------------------------*/
// redirects for login / logout
/*----------------------------------------------------------------------------*/
add_filter('woocommerce_login_redirect', 'login_redirect');

function login_redirect($redirect_to) {

    return home_url();

}

add_action('wp_logout','logout_redirect');

function logout_redirect(){

    wp_redirect( home_url() );
    
    exit;

}

add_filter( 'woocommerce_email_footer_text', 'footermail', 10, 1 ); 
function footermail(){
    return "Creado por <a href='https://www.briziolabz.com' target='_self'>Briziolabz</a>";
}

if ( class_exists( 'WooCommerce' ))add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
           jQuery("[name='update_cart']").removeAttr('disabled');
           jQuery("[name='update_cart']").trigger("click"); 
        });
    </script>
    <?php
    endif;
}

function bbg_wpmu_welcome_user_notification($user_id, $password, $meta = '') {
    global $current_site;
    $admin_email = "avisos@briziolabz.com";
    $from_name = get_option( 'nubicommerce_desde_nombre' ) == '' ? $sitename : esc_html( get_option( 'blogname' ) );
        
    $welcome_email = get_site_option( 'welcome_user_email' );

    $user = new WP_User($user_id);

    $welcome_email = apply_filters( 'update_welcome_user_email', $welcome_email, $user_id, $password, $meta);

    // Get the current blog name
    $message = sprintf( "Hola, \n\nSe ha creado tu contraseña. Estos son tus datos: \n\nUsuario: %s\n\nContraseña: %s\n\n " ,
                $user->user_login, $password);

   

    $message_headers = "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
  
    $subject = "Datos de acceso";
    wp_mail($user->user_email, $subject, $message, $message_headers);

    return false; // make sure wpmu_welcome_user_notification() doesn't keep running
}
add_filter( 'wpmu_welcome_user_notification', 'bbg_wpmu_welcome_user_notification', 10, 3 );

add_filter( 'wpmu_signup_user_notification', 'kc_wpmu_signup_user_notification', 10, 4 );
    function kc_wpmu_signup_user_notification($user, $user_email, $key, $meta = '') {
        $sitename = get_bloginfo( 'name' );
        $blog_id = get_current_blog_id();
        // Send email with activation link.
        $admin_email = "avisos@briziolabz.com";
        $from_name = get_option( 'nubicommerce_desde_nombre' ) == '' ? $sitename : esc_html( get_option( 'blogname' ) );
        $message_headers = "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
        $message = sprintf(
            apply_filters( 'wpmu_signup_user_notification_email',
                __( "Hi %s,\n\nThank you for registering with %s.\n\nTo activate your account, please click the following link:\n\n%s\n\nYou will then receive an email with your login details." ),
                $user, $user_email, $key, $meta
            ),
            site_url( "wp-activate.php?key=$key" )


        );
        // TODO: Don't hard code activation link.
        $subject = "Activar cuenta";
        wp_mail($user_email, $subject, $message, $message_headers);

        return false;
    }
    

// Activate WordPress Maintenance Mode

if(get_option('nubicommerce_mantenimiento'))add_action('get_header', 'wp_maintenance_mode');

function wp_maintenance_mode(){
    if(!current_user_can('administrator') ){
        wp_die('<div id="mantenimiento" style="width:100% !important;
text-align:center;"><img align="middle" src="'.home_url().'/wp-content/plugins/briziolabz-plugin/assets/img/mantenimiento.png" style="width:100%;
height:auto !important;"></div>');
    }
}


/*MENSAJE CHECKOUT*/
if(!empty(get_option('checkout_message')))add_action( 'woocommerce_before_checkout_form', 'skyverge_before_paying_notice' );
function skyverge_before_paying_notice() {
    wc_print_notice( __(get_option('checkout_message'), 'woocommerce' ), 'error' );
}



function whero_limit_image_size($file) {
    // Calculate the image size in KB
    $image_size = $file['size']/1024;

    // File size limit in KB
    $limit = 550;

    // Check if it's an image
    $is_image = strpos($file['type'], 'image');

    if ( ( $image_size > $limit ) && ($is_image !== false) )
            $file['error'] = 'La imagen es muy pesada, supera los '. $limit .'KB. Subí una imagen mas liviana o de un tamaño entre 500x500 y 1000x1000. Esto es para asegurar que la web cargue rapido.';

    return $file;

}
if(get_option("nubicommerce_modulo_500kb"))add_filter('wp_handle_upload_prefilter', 'whero_limit_image_size');




add_action('admin_menu', 'my_menu_pagess');
function my_menu_pagess(){
    add_menu_page('BrizioLabz', 'BrizioLabz', 'manage_options', 'my-menu', 'myplugin_options_page' );
    add_submenu_page('my-menu', 'Opciones', 'Ajustes', 'manage_options', 'mail', 'mails_page');
    add_submenu_page('my-menu', 'Opciones', 'Moneda', 'manage_options', 'moneda','page_moneda');
    add_submenu_page('my-menu', 'Opciones', 'Exito', 'manage_options', 'exitofile', 'exitofile_page');


}

function formatear($string){
    return strtolower(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string));
}


if(get_option('orden_minima')){
    if(get_option('orden_minima')>0 && get_option('orden_minima_segunda')>0){
                
        add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
        add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );        
    }
}




// VERFW

function wc_minimum_order_amount() {
    // Set this variable to specify a minimum order value
    $customer      = wp_get_current_user();
    $customer_id   = $customer->ID; // customer ID
    $customer_email = $customer->email; // customer email

    // Get all orders for this customer_id
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $customer_id,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() ),
    ) );
    $minimum = get_option('orden_minima');  
    if(count($customer_orders)>0){
        $minimum = get_option('orden_minima_segunda');   
    }

    if ( WC()->cart->cart_contents_total < $minimum ) {

        if( is_cart() ) {

            wc_print_notice( 
                sprintf( 'El minimo de compra es: %s +IVA, tu orden recién es de %s.' , 
                    wc_price( $minimum ), 
                    wc_price( WC()->cart->cart_contents_total )
                ), 'error' 
            );

        } else {

            wc_add_notice( 
                sprintf( 'El minimo de compra es: %s +IVA, tu orden recién es de %s.' , 
                    wc_price( $minimum ), 
                    wc_price( WC()->cart->cart_contents_total )
                ), 'error' 
            );

        }
    }

}





// remove metas
function remove_dashboard_meta() {
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
add_action( 'admin_init', 'remove_dashboard_meta' ); 

//Client area? VERFW
function custom_remove() {      
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
add_action('admin_head-nav-menus.php', 'custom_remove');



function popup_css() {
    wp_register_style( 'prefix-popup-style', plugins_url('assets/css/popup.css', __FILE__) );
    wp_enqueue_style( 'prefix-popup-style' );

}
add_action( 'wp_enqueue_scripts', 'popup_css' );


function my_scripts_method() {

    wp_enqueue_script('popup-script',plugins_url('assets/js/popup.js', __FILE__),array( 'jquery' ));
    
    $script_params = array(
        'src' => get_option('nubicommerce_popup_img'),
        'link' => get_option('nubicommerce_popup_link')
    );

    wp_localize_script( 'popup-script', 'popup', $script_params );



}

if(get_option('nubicommerce_popup'))add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

//config mails
if(!empty(get_option("nubicommerce_desde_nombre"))  && !empty(get_option("nubicommerce_destinos_mail")) ){

         update_option("woocommerce_product_enquiry_send_to",get_option("nubicommerce_destinos_mail"));
         update_option("woocommerce_stock_email_recipient",get_option("nubicommerce_destinos_mail"));
         
         update_option("sendgrid_from_email","avisos@briziolabz.com");
         update_option("woocommerce_email_from_address","avisos@briziolabz.com");
         
         update_option("woocommerce_email_from_name",get_option("nubicommerce_desde_nombre"));
         update_option("sendgrid_from_name",get_option("nubicommerce_desde_nombre"));

         //Mail woocommerce
        update_option("woocommerce_email_header_image",get_option('plugin_clientarea_settings')['client_logo']);
        update_option("woocommerce_email_footer_text","Powered by Briziolabz");
        update_option("woocommerce_email_base_color",get_option('css_main_color'));



         function orden_nueva( $recipients, $order ) {
             $recipients = ", ".get_option("nubicommerce_destinos_mail");
             return $recipients;
         }

         function email_orden_cancelada( $recipients, $order ) {
             $recipients = ", ".get_option("nubicommerce_destinos_mail");
             return $recipients;
         }

         function email_orden_fallida( $recipients, $order ) {
             $recipients = ", ".get_option("nubicommerce_destinos_mail");
             return $recipients;
         }
         add_filter('woocommerce_email_recipient_new_order', 'orden_nueva', 1, 2);
         add_filter('woocommerce_email_recipient_failed_order', 'email_orden_cancelada', 1, 2);
         add_filter('woocommerce_email_recipient_cancelled_order', 'email_orden_fallida', 1, 2);

}
// Function to add subscribe text to posts and pages
function pngcheckout_short() {
    $active1="";
    $active2="";
    $active3="";
    $devuelvo="";
    if(is_cart()){
        $active1="active";
    }else if( is_checkout() && !is_order_received_page() ) {

        $active2="active";
        $devuelvo .='<div class="logocheckout"><img src="'.get_option('plugin_clientarea_settings')['client_logo'].'"/></div>';
    
    }else if( is_checkout() && is_order_received_page() ) {
        
        $active3="active";   
        
    }
    $devuelvo.='<ul class="pasoscheckout">
              <li class="'.$active1.'"><a>MI COMPRA</a></li>
              <li class="'.$active2.'"><a>PAGO Y ENVÍO</a></li>
              <li class="'.$active3.'"><a>TERMINAR</a></li>
            </ul>';
    return $devuelvo;

}
add_shortcode('pngcheckout', 'pngcheckout_short');


add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
    global $product;
    if (  $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) 
        $tabs['additional_information']['title'] = __( 'Especificaciones' );  

    return $tabs;

}


//marcas
add_action('woocommerce_product_meta_end', '', 20);

add_filter('gettext', 'translate_reply');
add_filter('ngettext', 'translate_reply');

function translate_reply($translated) {
    $translated = str_ireplace('You may be interested in&hellip;', 'Te pueden interesar', $translated);
    return $translated;
}

function my_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Return To Shop' :
            $translated_text = "Volver a la tienda";
            break;
        case 'WooCommerce Dashboard':
            $translated_text = "Volver a la tienda";
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );



add_action( 'woocommerce_email_after_order_table', 'add_payment_method_to_admin_new_order', 15, 2 );
 
function add_payment_method_to_admin_new_order( $order, $is_admin_email ) {
  if ( $is_admin_email ) {
    echo '<p><strong>Medio de Pago:</strong> ' . $order->payment_method_title . '</p>';
  }
}



function is_shop_manager() {
    $user = wp_get_current_user();
    if ( isset( $user['roles'][0] ) && $user['roles'][0] == 'shop_manager' ) {
        return true;    // when user is shop manager
    } else {
        return false;   // when user is not shop manager
    }
}




register_activation_hook( __FILE__, 'my_plugin_activation' );
// VERFW client area
function my_plugin_activation($force=false) {
    $importacionsi="";
    $linkimpo="";

    if(!empty(get_option('admin_option_importacion_idfile'))){
        $importacionsi="on";
        $linkimpo='upload.php?page=enable-media-replace%2Fenable-media-replace.php&action=media_replace&attachment_id='.get_option('admin_option_importacion_idfile');
    }
    $new_options = array(
        'var_1_check' => 'on',
        'var_1_label' => 'Pedidos',
        'var_1_icon' => '\f09d',
        'var_1_link' => 'edit.php?post_type=shop_order',

        'var_2_check' => 'on',
        'var_2_label' => 'Sliders',
        'var_2_icon' => '\f1de',
        'var_2_link' => 'admin.php?page=metaslider',

        'var_3_check' => 'on',
        'var_3_label' => 'Reportes',
        'var_3_icon' => '\f080',
        'var_3_link' => 'admin.php?page=wc-reports',

        'var_4_check' => 'on',
        'var_4_label' => 'Cupones',
        'var_4_icon' => '\f0a1',
        'var_4_link' => 'edit.php?post_type=shop_coupon',

        'var_5_check' => 'off',
        'var_5_label' => 'Blog',
        'var_5_icon' => '\f09e',
        'var_5_link' => 'edit.php',

        'var_6_check' => 'on',
        'var_6_label' => 'Productos',
        'var_6_icon' => '\f07a',
        'var_6_link' => 'edit.php?post_type=product',

        'var_7_check' => 'on',
        'var_7_label' => 'Categorias',
        'var_7_icon' => '\f02c',
        'var_7_link' => 'edit-tags.php?taxonomy=product_cat&post_type=product',

        'var_8_check' => 'off',
        'var_8_label' => 'Attributos',
        'var_8_icon' => '\f150',
        'var_8_link' => 'edit.php?post_type=product&page=product_attributes',

        'var_9_check' => 'on',
        'var_9_label' => 'Menus',
        'var_9_icon' => '\f0c9',
        'var_9_link' => 'nav-menus.php',

        'var_10_check' => 'on',
        'var_10_label' => 'Usuarios',
        'var_10_icon' => '\f007',
        'var_10_link' => 'users.php',

        'var_11_check' => $importacionsi,
        'var_11_label' => 'Importación',
        'var_11_icon' => '\f093',
        'var_11_link' => $linkimpo,

        'var_12_check' => 'on',
        'var_12_label' => 'Ajustes',
        'var_12_icon' => '\f085',
        'var_12_link' => 'admin.php?page=mail',

        'var_13_check' => 'off',
        'var_13_label' => 'Media',
        'var_13_icon' => '\f007',
        'var_13_link' => 'upload.php',

        'is_home_redirect' => '',
        'home_redirect' => '',

        'client_logo' => get_option('admin_option_custom_logo_login'),
        'main_color' => '#009FD9',
        'text_color' => 'white',
        'icon_color' => 'white',
        'admin_logo' => '/wp-content/plugins/briziolabz-plugin/plugins/client-area-plugin/assets/img/logo.svg',
        'admin_favi' => '/wp-content/plugins/briziolabz-plugin/plugins/client-area-plugin/assets/img/favi.png',
        
        'custom_admin_css' => '', 
        'custommetabox_1_label' => '',
        'custommetabox_1_text' => '',
    );
    
    if(empty(get_option( 'plugin_clientarea_settings')))add_option( 'plugin_clientarea_settings', $new_options );   
    if($force)update_option( 'plugin_clientarea_settings', $new_options );   
}




if(get_option('redirect_checkout'))add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');

function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}

/*FIX*/
add_filter('widget_text','do_shortcode');



function wc_ninja_remove_password_strength() {
    if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
        wp_dequeue_script( 'wc-password-strength-meter' );
    }
}
add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );


add_filter( 'get_terms_args', 'checklist_args', 10, 2 );
function checklist_args( $args, $taxonomies ){
    $menu_taxonomies = array('product_cat', 'page', 'category','post');
    if(in_array($taxonomies[0], $menu_taxonomies)){
        $args['number'] = 1000;
    }
    return $args;
}








/*GENERICOS*/
add_filter('gettext', 'bancos_arg', 10, 3);
function bancos_arg($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        switch ($text) {
            case 'IBAN':
                $translation = 'CUIT';
                break;

            case 'BIC / Swift':
                $translation = 'CBU';
                break;

            case 'BIC':
                $translation = 'CBU';
                break;
        }
    }

    return $translation;
}


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    add_meta_box('custom_help_widget1', 'Soporte', 'custom_dashboard_help','dashboard','side','high');
    if(get_option("ml_id"))add_meta_box('custom_help_widget2', 'Mercadolibre', 'custom_ml_help','dashboard','side','high');
       //wp_add_dashboard_widget('custom_help_widget', 'Soporte', 'custom_dashboard_help');
}

function custom_dashboard_help() {
    echo '<p>Necesitas ayuda? Encontrá información en nuestro portal de ayuda. <a href="http://ayuda.nubicommerce.com" target="_blank">Ir al portal</a><br><br>O enviá un mail a <a href="mailto:soporte@briziolabz.com" target="_blank">soporte@briziolabz.com</a> para crear un ticket y que podamos responder tu consulta.</p><br><a href="mailto:soporte@briziolabz.com" target="_blank">Crear ticket</a><br><br>' ;
}
function custom_ml_help() {
    echo '<p>Las publicaciones se actualizan automaticamente 1 vez por dia. Si no deseas esperar a qeu se actualize autlmaticamente podes acelerar el proceso:<br> 1) Actualizar publicaciones en el servidor con el siguiente link: <a href="https://mlsync.briziolabz.com/user.php?user='.get_option("ml_id").'" target="_blank">LINK</a><br><br>2) Una vez que termino de procesarse la obtención de datos, ahora podes indicarle a la web que se actualize en el siguiente proceso: <a href="/wp-admin/admin.php?page=pmxi-admin-manage&id='.get_option("wpallimport_id").'&action=update" target="_blank">LINK</a>' ;
}




//Aplicar precio global
add_action( 'woocommerce_product_data_panels', 'gowp_global_variation_price' );
function gowp_global_variation_price() {
    global $woocommerce;
    ?>
        <script type="text/javascript">
            function addVariationLinks() {
                a = jQuery( '<br><a href="#">Aplicar a todas las variaciones</a>' );
                b = jQuery( 'input[name^="variable_regular_price"]' );
                a.click( function( c ) {
                    d = jQuery( this ).parent( 'label' ).next( 'input[name^="variable_regular_price"]' ).val();
                    e = confirm( "Desea aplicar $" + d + " a todas las variaciones?" );
                    if ( e ) b.val( d ).trigger( 'change' );
                    c.preventDefault();
                } );
                b.prev( 'label' ).append( " " ).append( a );
            }
            function addVariationLinksale() {
                z = jQuery( '<br><a href="#">Aplicar a todas las ofertas</a>' );
                y = jQuery( 'input[name^="variable_sale_price["]' );
                z.click( function( x ) {
                    w = jQuery( this ).parent( 'label' ).next( 'input[name^="variable_sale_price["]' ).val();
                    v = confirm( "Desea aplicar $" + w + " a todas las ofertas?" );
                    if ( v ) y.val( w ).trigger( 'change' );
                    x.preventDefault();
                } );
                y.prev( 'label' ).append( " " ).append( z );
            }
            <?php if ( version_compare( $woocommerce->version, '2.4', '>=' ) ) : ?>
                jQuery( document ).ready( function() {
                    jQuery( document ).ajaxComplete( function( event, request, settings ) {
                        if ( settings.data.lastIndexOf( "action=woocommerce_load_variations", 0 ) === 0 ) {
                            addVariationLinks();addVariationLinksale();
                        }
                    } );
                } );
            <?php else: ?>
                addVariationLinks();addVariationLinksale();
            <?php endif; ?>
        </script>
    <?php
}

//VERFW

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
 
function child_manage_woocommerce_styles() {
     //remove generator meta tag
     remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
     
     //first check that woo exists to prevent fatal errors
     if ( function_exists( 'is_woocommerce' ) ) {
         //dequeue scripts and styles
         if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
             wp_dequeue_style( 'woocommerce_frontend_styles' );
             wp_dequeue_style( 'woocommerce_fancybox_styles' );
             wp_dequeue_style( 'woocommerce_chosen_styles' );
             wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
             wp_dequeue_script( 'wc_price_slider' );
             wp_dequeue_script( 'wc-single-product' );
             wp_dequeue_script( 'wc-add-to-cart' );
             //wp_dequeue_script( 'wc-cart-fragments' );
             wp_dequeue_script( 'wc-checkout' );
             wp_dequeue_script( 'wc-add-to-cart-variation' );
             wp_dequeue_script( 'wc-single-product' );
             wp_dequeue_script( 'wc-cart' );
             wp_dequeue_script( 'wc-chosen' );
             //wp_dequeue_script( 'woocommerce' );
             wp_dequeue_script( 'prettyPhoto' );
             wp_dequeue_script( 'prettyPhoto-init' );
             wp_dequeue_script( 'jquery-blockui' );
             wp_dequeue_script( 'jquery-placeholder' );
             wp_dequeue_script( 'fancybox' );
             wp_dequeue_script( 'jqueryui' );
         }
         
     }
 
}





