<?php
/*
Plugin Name: Altoweb
Plugin URI: https://www.altoweb.co
Description: Plugin de funcionalidades de altoweb.co
Version: 1.9
Author: Fabrizio Guespe
Author URI: https://www.altoweb.co
*/
include( plugin_dir_path( __FILE__ ) . '/woocommerce-taxomizer/woocommerce-taxomizer.php');
include( plugin_dir_path( __FILE__ ) . '/importer/enable-media-replace.php');

include( plugin_dir_path( __FILE__ ) . '/admin_options.php');
// These would go inside your admin_init hook

// Function to change email address
 
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    add_meta_box('custom_help_widget1', 'Soporte', 'custom_dashboard_help','dashboard','side','high');
    if(get_option("ml_id"))add_meta_box('custom_help_widget2', 'Mercadolibre', 'custom_ml_help','dashboard','side','high');
       //wp_add_dashboard_widget('custom_help_widget', 'Soporte', 'custom_dashboard_help');
}

function custom_dashboard_help() {
    echo '<p>Necesitas ayuda? Enviános un mail a <a href="mailto:soporte@altoweb.co" target="_blank">soporte@altoweb.co</a> para crear un ticket y que podamos responder tu consulta.</p><br><a href="mailto:soporte@altoweb.co" target="_blank">Crear ticket</a><br><br>' ;
}
function custom_ml_help() {
    echo '<p>Las publicaciones se actualizan automaticamente 1 vez por dia. Si no deseas esperar a qeu se actualize autlmaticamente podes acelerar el proceso:<br> 1) Actualizar publicaciones en el servidor con el siguiente link: <a href="https://mlsync.briziolabz.com/user.php?user='.get_option("ml_id").'" target="_blank">LINK</a><br><br>2) Una vez que termino de procesarse la obtención de datos, ahora podes indicarle a la web que se actualize en el siguiente proceso: <a href="/wp-admin/admin.php?page=pmxi-admin-manage&id='.get_option("wpallimport_id").'&action=update" target="_blank">LINK</a>' ;
}


function wpb_sender_email( $original_email_address ) {
    return 'avisos@altoweb.co';
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Web';
}

  /*COLUMNA MEDIA*/

  add_filter( 'manage_media_columns', 'sk_media_columns_filesize' );
  function sk_media_columns_filesize( $posts_columns ) {
      $posts_columns['filesize'] = __( 'File Size', 'my-theme-text-domain' );
  
      return $posts_columns;
  }
  add_action( 'manage_media_custom_column', 'sk_media_custom_column_filesize', 10, 2 );
  function sk_media_custom_column_filesize( $column_name, $post_id ) {
      if ( 'filesize' !== $column_name ) {
          return;
      }
  
      $bytes = filesize( get_attached_file( $post_id ) );
  
      echo size_format( $bytes, 2 );
  }
  
  add_action( 'admin_print_styles-upload.php', 'sk_filesize_column_filesize' );
  
  function sk_filesize_column_filesize() {
      echo
      '<style>
          .fixed .column-filesize {
              width: 10%;
          }
      </style>';
  }


  
//Taxomizer
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







if(get_option('altoweb_defaultoptions')){
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
    update_option('woocommerce_ship_to_destination','billing_only');
    update_option('woocommerce_registration_generate_password','yes');
    //Calc envios
    update_option('woocommerce_enable_shipping_calc','yes');
    update_option('woocommerce_shipping_cost_requires_address','no');

    //Para que no se cancelen los envios
    update_option('woocommerce_hold_stock_minutes','');
    
    
    update_option('altoweb_defaultoptions','0');
}


if(get_option('fw_altoweb_defaultoptions')){
    set_theme_mod('ca-main-color', '#0C2E5C');
    set_theme_mod('mobile-icon', $THEME_IMG_URI."favi.png");
    set_theme_mod('ca-dev-logo',$THEME_IMG_URI."logo.png");
    set_theme_mod('ca-dev-favi',$THEME_IMG_URI."favi.png");
    update_option('fw_altoweb_defaultoptions','0');
}


  
// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_dni'] = array(
        'label'     => __('DNI/CUIT', 'woocommerce'),
    'required'  => get_option( 'cuit'),
    'class'     => array('form-row-wide'),
    'clear'     => true
     );

     return $fields;
}

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('DNI/CUIT').':</strong> ' . get_post_meta( $order->get_id(), '_billing_dni', true ) . '</p>';
}


/*OJO

add_filter( 'woocommerce_email_footer_text', 'footermail', 10, 1 ); 
function footermail(){
    return "Creado por <a href='https://www.altoweb.co' target='_self'>Altoweb</a>";
}*/
/*OJO
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

*/


function remove_dashboard_meta2() {
    //Saca las ordenes de la network
    remove_meta_box( 'woocommerce_network_orders', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_meta2' );

//Emails
function bbg_wpmu_welcome_user_notification($user_id, $password, $meta = '') {
    global $current_site;
    $admin_email = "avisos@altoweb.co";
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
        $admin_email = "avisos@altoweb.co";
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
    add_menu_page('Altoweb', 'Altoweb', 'manage_options', 'my-menu', 'myplugin_options_page' );
    //add_submenu_page('my-menu', 'Opciones', 'Moneda', 'manage_options', 'moneda','page_moneda');
    add_submenu_page('my-menu', 'Opciones', 'Exito', 'manage_options', 'exitofile', 'exitofile_page');


}



function formatear($string){
    return strtolower(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string));
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



//config mails
if(!empty(get_option("nubicommerce_desde_nombre"))  && !empty(get_option("nubicommerce_destinos_mail")) ){

         update_option("woocommerce_product_enquiry_send_to",get_option("nubicommerce_destinos_mail"));
         update_option("woocommerce_stock_email_recipient",get_option("nubicommerce_destinos_mail"));
         
         update_option("sendgrid_from_email","avisos@altoweb.co");
         update_option("woocommerce_email_from_address","avisos@altoweb.co");
         
         update_option("woocommerce_email_from_name",get_option("nubicommerce_desde_nombre"));
         update_option("sendgrid_from_name",get_option("nubicommerce_desde_nombre"));

         //Mail woocommerce
        update_option("woocommerce_email_header_image",get_option('plugin_clientarea_settings')['client_logo']);
        update_option("woocommerce_email_footer_text","Powered by Altoweb");
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

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
    global $product;
    if (  $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) 
        $tabs['additional_information']['title'] = __( 'Especificaciones' );  

    return $tabs;

}




/*

function wc_ninja_remove_password_strength() {
    if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
        wp_dequeue_script( 'wc-password-strength-meter' );
    }
}
add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );
*/

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

    


//VERFW





