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

//include( plugin_dir_path( __FILE__ ) . '/admin_options.php');
// These would go inside your admin_init hook

 





  /*COLUMNA MEDIA*/

//Taxomizer
if(get_option('taxomizerwpai'))add_action('pmxi_after_xml_import', 'after_xml_import_init_cate', 10, 1);
function after_xml_import_init_cate($import_id){
    $varss="product_cat,".fw_theme_mod('fw_extra_tax');
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



if(fw_theme_mod('fw_action_init_mayorista')){

   update_option('woocommerce_enable_guest_checkout','no');
   update_option('woocommerce_enable_checkout_login_reminder','no');
   update_option('woocommerce_enable_signup_and_login_from_checkout','no');
   update_option('woocommerce_enable_myaccount_registration','no');
   set_theme_mod('fw_prices_visibility','logged');
   set_theme_mod('fw_purchases_visibility','logged');
   set_theme_mod('fw_action_init_mayorista',false);
}

if(fw_theme_mod('fw_action_woosettings')){
   update_option('woocommerce_price_num_decimals','0');
   update_option('woocommerce_currency','ARS');
   update_option('woocommerce_default_country','AR:C');
   update_option('woocommerce_cart_redirect_after_add','no');
   update_option('woocommerce_enable_ajax_add_to_cart','no');
   update_option('shop_single_image_size','a:3:{s:5:"width";s:3:"500";s:6:"height";s:3:"500";s:4:"crop";i:1;}');
   update_option('woocommerce_enable_myaccount_registration','yes');
   update_option('woocommerce_enable_signup_and_login_from_checkout','yes');
   update_option('woocommerce_enable_checkout_login_reminder','yes');
   update_option('woocommerce_registration_generate_username','yes');
   update_option('woocommerce_ship_to_destination','billing_only');
   update_option('woocommerce_registration_generate_password','yes');
   //Calc envios
   update_option('woocommerce_enable_shipping_calc','no');
   update_option('woocommerce_enable_reviews','no');
   update_option('woocommerce_shipping_cost_requires_address','no');
   //Envuios
   update_option('woocommerce_allowed_countries','all');
   update_option('woocommerce_ship_to_countries','all');
   update_option('woocommerce_default_customer_address','geolocation');

   //Para que no se cancelen los envios
   update_option('woocommerce_hold_stock_minutes','');

   $opts=get_option('woocommerce_mercadoenvios-gateway_settings');
   $opts['title']='Mercadopago';
   $opts['description']='<a href="https://www.mercadopago.com.ar/promociones" target="_blank"><img src="/wp-content/themes/fastway/assets/img/mp.png" class="noborrar"></a>';
   $opts['method']='redirect';
   $opts['installment_paymentbutton_calculator']='no';
   $opts['installment_product_calculator']='no';
   $opts['shipping_product_calculator']='no';
   $opts['gateway_mp_redirect']='yes';

   update_option('woocommerce_mercadoenvios-gateway_settings',$opts);

   set_theme_mod('fw_action_woosettings',false);
}

$opts=get_option('woocommerce_mercadoenvios-gateway_settings');
if($opts['method']!='redirect'){
   $opts['title']='Mercadopago';
   $opts['description']='<a href="https://www.mercadopago.com.ar/promociones" target="_blank"><img src="/wp-content/themes/fastway/assets/img/mp.png" class="noborrar"></a>';
   $opts['method']='redirect';
   $opts['installment_paymentbutton_calculator']='no';
   $opts['installment_product_calculator']='no';
   $opts['shipping_product_calculator']='no';
   update_option('woocommerce_mercadoenvios-gateway_settings',$opts);
}


set_theme_mod('fw_action_woosettings',false);
if(fw_theme_mod('fw_action_clientimages')){
    set_theme_mod('ca-main-color', '#0C2E5C');
    set_theme_mod('mobile-icon', $THEME_IMG_URI."favi.png");
    set_theme_mod('ca-dev-logo',$THEME_IMG_URI."logo.png");
    set_theme_mod('ca-dev-favi',$THEME_IMG_URI."favi.png");
    set_theme_mod('fw_action_clientimages',false);
}


  

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_dni'] = array(
      'label'     => fw_theme_mod( 'fw_cuit_label'),
      'required'  => fw_theme_mod( 'fw_cuit_required'),
      'class'     => array('form-row-wide'),
      'clear'     => true
      );

     return $fields;
}

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('DNI/CUIT').':</strong> ' . get_post_meta( $order->get_id(), '_billing_dni', true ) . '</p>';
}


function remove_dashboard_meta2() {
    //Saca las ordenes de la network
    remove_meta_box( 'woocommerce_network_orders', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_meta2' );


add_filter('wp_handle_upload_prefilter', 'whero_limit_image_size');
function whero_limit_image_size($file) {
   //if(is_admin())return $file;
   // Calculate the image size in KB
   $image_size = $file['size']/1024;

   // File size limit in KB
   $limit = fw_theme_mod('fw_max_media_upload');

   // Check if it's an image
   $is_image = strpos($file['type'], 'image');

   if ( ( $image_size > $limit ) && ($is_image !== false) )
      $file['error'] = fw_theme_mod('fw_max_media_upload').'La imagen es muy pesada, supera los '. $limit .'KB. Subí una imagen mas liviana o de un tamaño entre 500x500 y 1000x1000. Esto es para asegurar que la web cargue rapido.';

   return $file;

}


add_action('admin_menu', 'my_menu_pagess');
function my_menu_pagess(){
    add_submenu_page('my-menu', 'Opciones', 'Exito', 'manage_options', 'exitofile', 'exitofile_page');
}

function exitofile_page(){
   ?>
   <div class="paginaopciones">
   <style type="text/css">
   .paginaopciones{
   text-align:center;
   }
   </style>
   <img src="<?php echo get_template_directory_uri().'/assets/img/exitofile.png';?>" width="600">
   </div>
   <?php
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

add_shortcode('altoweb_financiacion','getFinanciacion');
//eesss

function getFinanciacion(){
global $product;
  $precio=floatval($product->price);
  $cuotas6=floor($precio/6);
  $cuotas3=floor($precio/3);
  $cuotas12=floor($precio/12);
  $cuotas18=floor($precio/18);
  $infopopup_cash=do_shortcode('[datos_efectivo_popup]');

  ob_start();
  do_shortcode('[datos_bancarios_popup]');
  $infopopup_banc=ob_get_contents();
  ob_end_flush();
  return <<<HTML
  <a target="_blank" data-toggle="modal" data-target="#modal_tiendanube" class="fw_icon_link fancybox">
   <li class=" fw_icon  fw-medios tiendanube d-flex isli" > 
   <span class="icon">
      <i class="fad fa-credit-card"></i>
      </span> 
      <span class="text"> 
      <big>Pagá en hasta 12 cuotas</big> 
      <img style="display:block;" src="/wp-content/themes/fastway/assets/img/iconitopagos.png" width="97"/>
      <small style="color:#3483fa !important;">Más información</small> 
      </span>
   </li>
</a>
<div class="modal modal_tiendanube fade" id="modal_tiendanube" tabindex="-1" role="dialog" aria-labelledby="modal_tiendanubeTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="mercadopago-tab" data-toggle="tab" href="#mercadopago" role="tab" aria-controls="mercadopago" aria-selected="true">MERCADOPAGO</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="todopago-tab" data-toggle="tab" href="#todopago" role="tab" aria-controls="todopago" aria-selected="false">TODOPAGO</a>
               </li>
               <!--
               <li class="nav-item">
                  <a class="nav-link" id="banco-tab" data-toggle="tab" href="#banco" role="tab" aria-controls="banco" aria-selected="false">TRANSFERENCIA BANCARIA</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="efectivo-tab" data-toggle="tab" href="#efectivo" role="tab" aria-controls="efectivo" aria-selected="false">EFECTIVO</a>
               </li>-->
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="mercadopago" role="tabpanel" aria-labelledby="mercadopago-tab">
                  <div class="full-width pull-left">
                     <div class="box-title">Tarjetas de crédito</div>
                     <div class="box-container">
                        <div class="pull-left full-width border-box">
                           <div class="installments-container">
                              <h4 class="">
                                 6 cuotas <span class="text-uppercase">sin interés</span> de <b>$ {$cuotas6}</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                            <!-- <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-municipal@2x.png" class="card-img card-img-big" alt="Banco Municipal">-->
                            <div class="flags-container">
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-chaco@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-chaco@2x.png" class="card-img card-img-big lazyloaded" alt="Banco de Chaco">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/hsbc-access@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/hsbc-access@2x.png" class="card-img card-img-big lazyloaded" alt="HSBC Access Now">
                  </span>
                              </div>
                              <div class="divider"></div>
                           </div>
                           <div class="installments-container">
                              <h4 class="">
                                 3  cuotas <span class="text-uppercase">sin interés</span> de <b>$ {$cuotas3}</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                              
                              <div class="flags-container">
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia-mp@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia-mp@2x.png" class="card-img card-img-big lazyloaded" alt="Mercado Pago + Banco Patagonia">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cencosud@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cencosud@2x.png" class="card-img card-img-big lazyloaded" alt="Cencosud">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/nativa@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/nativa@2x.png" class="card-img card-img-big lazyloaded" alt="Nativa Mastercard">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santander@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santander@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Santander">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Patagonia">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/HSBC@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/HSBC@2x.png" class="card-img card-img-big lazyloaded" alt="HSBC">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/ICBC@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/ICBC@2x.png" class="card-img card-img-big lazyloaded" alt="ICBC">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-industrial@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-industrial@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Industrial">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Comafi">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-nacion@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-nacion@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Nacion">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/macro@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/macro@2x.png" class="card-img card-img-big lazyloaded" alt="Macro">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/galicia@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/galicia@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Galicia">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-ciudad@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-ciudad@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Ciudad">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-cruz@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-cruz@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Santa Cruz">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/itau@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/itau@2x.png" class="card-img card-img-big lazyloaded" alt="Itau">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-sanjuan@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-sanjuan@2x.png" class="card-img card-img-big lazyloaded" alt="Banco San Juan">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-entre-rios@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-entre-rios@2x.png" class="card-img card-img-big lazyloaded" alt="Nuevo Banco de Entre Rios">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-fe@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-fe@2x.png" class="card-img card-img-big lazyloaded" alt="Nuevo Banco de Santa Fe">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/supervielle@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/supervielle@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Supervielle">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-frances@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-frances@2x.png" class="card-img card-img-big lazyloaded" alt="BBVA Frances">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-tucuman@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-tucuman@2x.png" class="card-img card-img-big lazyloaded" alt="Tucuman">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-provincia@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-provincia@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Provincia">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-la-pampa@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-la-pampa@2x.png" class="card-img card-img-big lazyloaded" alt="Banco de La Pampa">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-walmart@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-walmart@2x.png" class="card-img card-img-big lazyloaded" alt="Tarjeta Walmart">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/carta-automatica@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/carta-automatica@2x.png" class="card-img card-img-big lazyloaded" alt="Carta Automática">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comercio@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comercio@2x.png" class="card-img card-img-big lazyloaded" alt="Banco de Comercio">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/bica@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/bica@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Bica">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/fueguina@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/fueguina@2x.png" class="card-img card-img-big lazyloaded" alt="Fueguina">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-columbia@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-columbia@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Columbia">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-municipal@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-municipal@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Municipal">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-saenz@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-saenz@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Saenz">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/efectivo-si@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/efectivo-si@2x.png" class="card-img card-img-big lazyloaded" alt="Efectivo Si">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-coinag@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-coinag@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Coinag">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/rebanking@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/rebanking@2x.png" class="card-img card-img-big lazyloaded" alt="Rebanking">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-shopping@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-shopping@2x.png" class="card-img card-img-big lazyloaded" alt="Tarjeta Shopping">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/provencred@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/provencred@2x.png" class="card-img card-img-big lazyloaded" alt="Provencred">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-hipotecario@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-hipotecario@2x.png" class="card-img card-img-big lazyloaded" alt="Banco Hipotecario">
                  </span>
                                  <span class="installments-card">
                    <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" class="card-img card-img-big lazyloaded" alt="Comafi Chicas">
                  </span>
                              </div>
                              <div class="divider"></div>
                           </div>
                           <div class="installments-container">
                              <h4 class="">
                                 12 cuotas con otras tarjetas
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span>O en 1 pago de: </span><b>$ {$precio}</b>
                              </div>
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/visa@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/mastercard@2x.png" class="card-img card-img-medium">
                            <!--<img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/amex@2x.png" class="card-img card-img-medium">-->
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cabal@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/diners@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/nativa@2x.png" class="card-img card-img-big" alt="Nativa Mastercard">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia-mp@2x.png" class="card-img card-img-big" alt="Mercado Pago + Banco Patagonia">
                           <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-shopping@2x.png" class="card-img card-img-big" alt="Tarjeta Shopping">
                           <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-walmart@2x.png" class="card-img card-img-big" alt="Tarjeta Walmart">
                             
                              <img src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/efectivo-si@2x.png" class="card-img card-img-big" alt="Efectivo Si">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/itau@2x.png" class="card-img card-img-big" alt="Itau">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia@2x.png" class="card-img card-img-big" alt="Banco Patagonia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/HSBC@2x.png" class="card-img card-img-big" alt="HSBC">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/galicia@2x.png" class="card-img card-img-big" alt="Banco Galicia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-hipotecario@2x.png" class="card-img card-img-big" alt="Banco Hipotecario">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/macro@2x.png" class="card-img card-img-big" alt="Macro">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/santander-rio@2x.png" class="card-img card-img-big" alt="Banco Santander Rio S.A.">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/supervielle@2x.png" class="card-img card-img-big" alt="Banco Supervielle">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-frances@2x.png" class="card-img card-img-big" alt="BBVA Frances">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/ICBC@2x.png" class="card-img card-img-big" alt="ICBC">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-industrial@2x.png" class="card-img card-img-big" alt="Banco Industrial">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-nacion@2x.png" class="card-img card-img-big" alt="Banco Nacion">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" class="card-img card-img-big" alt="Banco Comafi">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-entre-rios@2x.png" class="card-img card-img-big" alt="Nuevo Banco de Entre Rios">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-fe@2x.png" class="card-img card-img-big" alt="Nuevo Banco de Santa Fe">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-cruz@2x.png" class="card-img card-img-big" alt="Banco Santa Cruz">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-sanjuan@2x.png" class="card-img card-img-big" alt="Banco San Juan">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-tucuman@2x.png" class="card-img card-img-big" alt="Tucuman">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-provincia@2x.png" class="card-img card-img-big" alt="Banco Provincia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-la-pampa@2x.png" class="card-img card-img-big" alt="Banco de La Pampa">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/bica@2x.png" class="card-img card-img-big" alt="Banco Bica">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-columbia@2x.png" class="card-img card-img-big" alt="Banco Columbia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cencosud@2x.png" class="card-img card-img-big" alt="Cencosud">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/nativa@2x.png" class="card-img card-img-big" alt="Nativa Mastercard">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-walmart@2x.png" class="card-img card-img-big" alt="Tarjeta Walmart">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/carta-automatica@2x.png" class="card-img card-img-big" alt="Carta Automática">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comercio@2x.png" class="card-img card-img-big" alt="Banco de Comercio">
      
                           </div>
                        </div>
                     </div>
                     <div class="box-title debito" >Tarjeta de débito y efectivo</div>
                     <div class="box-container debito" >
                        <h4 class="">Débito</h4>
                        <div class="h6-xs m-bottom-half">
                           <span>Precio: </span><b> $ {$precio}</b>
                        </div>
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/visadebit@2x.png" class="card-img card-img-big">
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/mastercarddebit@2x.png" class="card-img card-img-big">
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cabaldebit@2x.png" class="card-img card-img-big">
                        <div class="divider"></div>
                        <h4 class="">Efectivo</h4>
                        <div class="h6-xs m-bottom-half">
                           <span>Precio: </span><b> $ {$precio}</b>
                        </div>
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/pagofacil@2x.png" class="card-img card-img-big">
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/rapipago@2x.png" class="card-img card-img-big">
                        <div class="divider"></div>
                        <h4 class="">Transferencia o deposito</h4>
                        <div class="h6-xs m-bottom-half">
                           <span>Precio: </span><b> $ {$precio}</b>
                        </div>
                        <span class="installments-card js-installments-flag-tab js-installments-cash-tab" data-type="dd" data-code="">
          <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/link@2x.png" data-src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/link@2x.png" class="card-img card-img-big lazyloaded">
        </span>
                        <div class="divider"></div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="todopago" role="tabpanel" aria-labelledby="todopago-tab">
                  <div class="full-width pull-left">
                     <div class="box-title">Hacé tus compras en 3, 6, 12 o 18 cuotas con tarjeta de crédito, todos los días de la semana.</div>
                     <div class="box-container">
                        <div class="pull-left full-width border-box">
                           <div class="installments-container">
                              <h4 class="">3 cuotas <span class="text-uppercase">sin interés</span> de <b>$ $cuotas3</b></h4>
                             <!-- <h4 class="">6 cuotas <span class="text-uppercase">sin interés</span> de <b>$ $cuotas6</b></h4>
                              <h4 class="">12 cuotas <span class="text-uppercase">sin interés</span> de <b>$ $cuotas12</b></h4>
                              <h4 class="">18 cuotas <span class="text-uppercase">sin interés</span> de <b>$ $cuotas18</b></h4>-->
                              <img src="https://todopago.com.ar/sites/todopago.com.ar/files/boton_192x55_ahora3y6.png" alt="" />
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="tab-pane fade" id="banco" role="tabpanel" aria-labelledby="banco-tab">
                  <div class="box-container">
                     <p class="weight-strong m-bottom-half">Cuando termines la compra vas a ver la información de pago en relación a esta opción.</p>
                     <p>{$infopopup_banc}</p>
                     <h4>
                        <span class="m-right-quarter">Total:</span><b>$ {$precio}</b>
                     </h4>
                  </div>
               </div>
               <div class="tab-pane fade" id="efectivo" role="tabpanel" aria-labelledby="efectivo-tab">
                  <div class="box-container">
                     <p class="weight-strong m-bottom-half">Pagá de contado en nuestro local.</p>
                     <h4>
                        <span class="m-right-quarter">Total:</span><b>$ {$precio}</b>
                     </h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
HTML;
}


