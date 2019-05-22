<?php

/*LOOP FUNCTIONS*/
add_shortcode('fw_loop_title', 'fw_loop_title');
function fw_loop_title(){
    global $product;
    echo '<h2 class="product_title">'.$product->post->post_title.'</h2>';
}
add_shortcode('fw_single_cf','fw_get_custom_field');
function fw_get_custom_field($atts){
    global $product;
    $sku=get_post_meta($product->id,$atts['id'],true);
    if(!empty($sku))echo $sku;
}
add_shortcode('fw_container', 'fw_container');
function fw_container($atts = [], $content = null){
    $class='';
    if(isset($atts['class']))$class=$atts['class'];
    echo '<div class=" '.$class.' ">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</div>';
}
add_shortcode('fw_short_desc', 'fw_short_desc');
function fw_short_desc(){
    global $product;
    echo get_the_excerpt( $product->id );
}


add_shortcode('fw_loop_image', 'fw_loop_image');
function fw_loop_image(){
    global $product;
    echo woocommerce_get_product_thumbnail();
}

add_shortcode('fw_loop_price', 'fw_loop_price');
function fw_loop_price(){
    global $product;
    echo '<span class="price">'.fw_price_html1(null,$product).'</span>';
}
add_shortcode('fw_loop_cart', 'fw_loop_cart');
function fw_loop_cart() {
    if((fw_theme_mod("fw_purchases_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_purchases_visibility")==="hide")return;
    global $product;
    echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s single_add_to_cart_button btn  btn-block %s">
    <i class="fas fa-spinner fa-spin" style="display:none;"></i> %s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->get_id() ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            esc_attr( $product->get_type() ),
            $product->get_type() == 'simple' ? 'ajax_add_to_cart' : '',
            esc_html( $product->add_to_cart_text() )
        );
}
add_shortcode('fw_loop_meta', 'fw_loop_meta');
function fw_loop_meta($atts = [], $content = null){
    $atts = shortcode_atts(array('type' => '' ), $atts );
    echo '<div class="meta">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</div>';
}


add_shortcode('fw_loop_container', 'fw_loop_container');
function fw_loop_container($atts = [], $content = null){
    global $product;
    echo '<a href="'.$product->get_permalink($product->id).'">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</a>';

}

function woo_loop_code(){
    echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_code'))));
}



//Esto es para la pagina de opciones ,OJO, integrar altoweb.

function display_currency_element(){
	?>
    	<input type="text" name="fw_currency_conversion" id="fw_currency_conversion" value="<?php echo get_option('fw_currency_conversion'); ?>" />
      <span> Usar punto para decimales, no la coma.</span>
    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	
  add_settings_field("conversion_usd", "Conversion USD", "display_currency_element", "theme-options", "section");

  register_setting("section", "fw_currency_conversion");
}

add_action("admin_init", "display_theme_panel_fields");
function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Config</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}
function add_theme_menu_item()
{
  add_menu_page("Config", "Config", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");




if(get_option('fw_currency_conversion')  && !is_admin()){
    
  // Utility function to change the prices with a multiplier (number)
  function get_price_multiplier() {
    $price+=floatval(get_option('fw_currency_conversion'));
    return $price; // x2 for testing
  }

  // Simple, grouped and external products
  add_filter('woocommerce_product_get_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_get_regular_price', 'custom_price', 99, 2 );
  // Variations
  add_filter('woocommerce_product_variation_get_regular_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_variation_get_price', 'custom_price', 99, 2 );
  function custom_price( $price, $product ) {
    return intval($price * get_price_multiplier());
  }

  // Variable (price range)
  add_filter('woocommerce_variation_prices_price', 'custom_variable_price', 99, 3 );
  add_filter('woocommerce_variation_prices_regular_price', 'custom_variable_price', 99, 3 );
  function custom_variable_price( $price, $variation, $product ) {
    // Delete product cached price  (if needed)
    // wc_delete_product_transients($variation->get_id());

    return intval($price * get_price_multiplier());
  }

  // Handling price caching (see explanations at the end)
  add_filter( 'woocommerce_get_variation_prices_hash', 'add_price_multiplier_to_variation_prices_hash', 99, 1 );
  function add_price_multiplier_to_variation_prices_hash( $hash ) {
    $hash[] = get_price_multiplier();
    return $hash;
  }
}


if(fw_theme_mod('fw_general_discount')  && !is_admin()){
    
  // Utility function to change the prices with a multiplier (number)
  function get_price_multiplier() {
    $price=floatval(1-(fw_theme_mod('fw_general_discount')/100));
    return $price; // x2 for testing
  }

  // Simple, grouped and external products
 // add_filter('woocommerce_product_get_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_get_sale_price', 'custom_price', 99, 2 );
  // Variations
  add_filter('woocommerce_product_variation_get_sale_price', 'custom_price', 99, 2 );
 // add_filter('woocommerce_product_variation_get_price', 'custom_price', 99, 2 );
  function custom_price( $price, $product ) {
    if($product->regular_price)return floatval($product->regular_price * get_price_multiplier());
  }

  // Variable (price range)
  //add_filter('woocommerce_variation_prices_price', 'custom_variable_price', 99, 3 );
  add_filter('woocommerce_variation_prices_sale_price', 'custom_variable_price', 99, 3 );
  function custom_variable_price( $price, $variation, $product ) {
    // Delete product cached price  (if needed)
    // wc_delete_product_transients($variation->get_id());

    if($product->regular_price)return floatval($product->regular_price * get_price_multiplier());
  }

}




add_action('fw_before_shop_sidebar','fw_default_filters');
function fw_default_filters(){
    global $wp_query;
    $total=$wp_query->found_posts;
    woocommerce_breadcrumb();
    echo '<p class="woocommerce-result-count">'.$total." Resultados".'</p>';
    woocommerce_catalog_ordering();
    return;
}

add_shortcode('fw_loop_labels', 'fw_loop_labels');
function fw_loop_labels($atts = [], $content = null){
    $atts = shortcode_atts(array('type' => '','id'=>'' ), $atts );
    global $product;
    
    if($product->get_shipping_class()==$atts['id'] && $atts['type']=='shipping-class'  ){//envio=gratis
        echo '<div class="envio-gratis-tag grupo-envio-6" title="Éste producto tiene envío Gratis"><i class="fal fa-shipping-fast"></i> Gratis</div>';
    }
}

add_shortcode('fw_conditional', 'fw_conditional');
function fw_conditional($atts = [], $content = null){
    $atts = shortcode_atts(array('type' => '','id'=>'' ), $atts );
    global $product;
    if($product->get_shipping_class()==$atts['id'] && $atts['type']=='shipping-class'  ){//envio=gratis
       return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }
}
function woo_loop_brand(){
    echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_brand_code'))));
}

function woo_loop_cat(){
    echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_cat_code'))));
}

add_shortcode('fw_brand_title', 'fw_cat_title');
add_shortcode('fw_cat_title', 'fw_cat_title');
function fw_cat_title(){
    global $fw_woo_cat;
    return '<h4 class="title" >'.$fw_woo_cat->name.'</h4>';
}

add_shortcode('fw_brand_desc', 'fw_cat_desc');
add_shortcode('fw_cat_desc', 'fw_cat_desc');
function fw_cat_desc(){
    global $fw_woo_cat;
    return '<span class="desc">'.$fw_woo_cat->description.'</span>';
}

add_shortcode('fw_brand_image', 'fw_cat_image');
add_shortcode('fw_cat_image', 'fw_cat_image');
function fw_cat_image(){
    global $fw_woo_cat;
    $thumbnail_id = get_woocommerce_term_meta( $fw_woo_cat->term_id, 'thumbnail_id', true ); 
    $image = wp_get_attachment_url( $thumbnail_id ); 
    return '<div class="thumbnail"><div class="shadow-overlay"></div><img src="'.$image.'" width="100%" height="auto" /></div>';
}


add_shortcode('fw_brand_banner', 'fw_cat_banner');
add_shortcode('fw_cat_banner', 'fw_cat_banner');
function fw_cat_banner(){
    global $fw_woo_cat;
    $thumbnail_id = get_woocommerce_term_meta( $fw_woo_cat->term_id, 'banner_id', true ); 
    $image = wp_get_attachment_url( $thumbnail_id ); 
    return '<div class="banner"><img src="'.$image.'" width="100%" height="auto" /></div>';
}

add_shortcode('fw_cat_container', 'fw_cat_container');
function fw_cat_container($atts = [], $content = null){
    global $fw_woo_cat;
    $link = get_term_link($fw_woo_cat);
    if(!is_string($link))return;
    echo '<li class="fw_cat_loop product-category product">';
    echo '<a href="'.$link.'">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</a></li>';
}

add_shortcode('fw_brand_container', 'fw_brand_container');
function fw_brand_container($atts = [], $content = null){
    global $fw_woo_cat;
    $link = get_term_link($fw_woo_cat);
    if(!is_string($link))return;
    echo '<li class="fw_brand_loop">';
    echo '<a href="'.$link.'">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</a></li>';
}


function woocommerce_get_category_banner(){
  $term_id       =    get_queried_object_id();
  $banner_id = get_woocommerce_term_meta( $term_id, 'banner_id', true ); 
  if(!$banner_id)return;
  $image = wp_get_attachment_url( $banner_id ); 
  echo '<img class="category_banner" src="'.$image.'" style="width:100%;heigth:auto;" />';
}










function fw_share_redes(){
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    echo '<div id="fw_share_redes" class="d-flex justify-content-between">
    <!-- Email -->
    <a href="mailto:?Subject=Mirá este producto&amp;Body=Mirá este producto que encontré '.$actual_link.'">
    <i class="fas fa-envelope"></i>
    </a>
    <a href="whatsapp://send?text=¡Hola! Quisiera hacer una consulta por un producto que me intereso en su web '.$actual_link.'" data-action="share/whatsapp/share">
    <i class="fab fa-whatsapp-square"></i>
    </a>
    <a onclick="copy_to_clipboard(\'fw_copyclip\')">
    <i class="fas fa-copy"></i>
    <input type="text" value="'.$actual_link.'" id="fw_copyclip">
    </a>
    <style>
    #fw_copyclip{
        display: none;
    }
      </style>
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u='.$actual_link.'" target="_blank">
    <i class="fab fa-facebook-square"></i>
    </a>
    
    <!-- Link -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$actual_link.'" target="_blank">
    <i class="fab fa-linkedin"></i>
    </a>
    
    <!-- Pinteres -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)%7D)());">
    <i class="fab fa-pinterest-square"></i>
    </a>
    <!-- Print -->
    <a href="javascript:;" onclick="window.print()">
    <i class="fas fa-print"></i>
    </a>
    
    <!-- Twitter -->
    <a href="https://twitter.com/share?url='.$actual_link.'&amp;text=Mirá este producto que encontré" target="_blank">
    <i class="fab fa-twitter-square"></i>
    </a>
    </div>';
}
add_filter( 'woocommerce_shop_manager_editable_roles', 'addanotherrole' );
function addanotherrole($roles) {
    // add the additional role to the woocommerce allowed roles (customer)
    $roles[] = 'subscriber'; 

    // return roles array
    return $roles; 
}


/*PARA QUE EL SHOP MANAGER EDITE EL MENU*/
function fw_allow_users_to_shopmanager() {
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
add_action( 'admin_init', 'fw_allow_users_to_shopmanager');


if(fw_theme_mod('fw_min_purchase')>0 && fw_theme_mod('fw_min_purchase2')>0 ){
    add_action( 'woocommerce_checkout_process', 'fw_minimum_order_amount' );
    add_action( 'woocommerce_before_cart' , 'fw_minimum_order_amount' );         
}



// VERFW

function fw_minimum_order_amount() {
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
    $minimum = fw_theme_mod('fw_min_purchase');  
    if(count($customer_orders)>0){
        $minimum = fw_theme_mod('fw_min_purchase2');   
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

function fw_getfastars($average){
    if(!is_numeric($average))return "";
    $html='<a >';
    $vacia=false;
    if($average==0)$vacia=true;
	for($i=1;$i<=5;$i++){
        $clase="";
		if(!$vacia){
			if($i==floor($average) && floor($average)!=$average){
                $clase="-half ";$vacia=true;
        	}
			else if($i>=$average)$vacia=true;
			else if($i<$average)$clase="";
		}else{
        	$clase=" star-vacia ";
		}
		$html.= '<i class="fa fa-star'.$clase.' star'.$i.'" aria-hidden="true"></i>';
		if($i==floor($average) && floor($average)!=$average && $vacia){
			$html.= '<i class="fa fa-star-half star-vacia" aria-hidden="true"></i>';
		}
    }
    $html.="</a>";
	return $html;
}


// Function to add subscribe text to posts and pages
function fw_pngcheckout_short() {
    $active1="";
    $active2="";
    $active3="";
    $devuelvo="";
    if(is_cart()){
        $active1="active";
    }else if( is_checkout() && !is_order_received_page() ) {

        $active2="active";
        if(fw_theme_mod("checkout-minimal"))$devuelvo .='<div class="logocheckout"><img src="'.fw_theme_mod('general-logo').'"/></div>';
    
    }else if( is_checkout() && is_order_received_page() ) {
        
        $active3="active";   
        
    }
    if(fw_theme_mod("cart-steps")){
    $devuelvo.='<ul class="pasoscheckout">
              <li class="'.$active1.'"><a>MI COMPRA</a></li>
              <li class="'.$active2.'"><a>PAGO Y ENVÍO</a></li>
              <li class="'.$active3.'"><a>TERMINAR</a></li>
            </ul>';
    }

    echo $devuelvo;

}
if(fw_theme_mod("cart-steps") || fw_theme_mod("checkout-minimal")){
//add_action('woocommerce_before_cart', 'fw_pngcheckout_short');   
//add_action('woocommerce_before_checkout_form', 'fw_pngcheckout_short',0); 
if(fw_theme_mod("checkout-minimal")){
//add_action( 'wp_head', 'add_chkstl_to_head' );
} 
}



function add_chkstl_to_head() {
echo "<style>.woocommerce-checkout:not(.woocommerce-order-received) header,.woocommerce-checkout:not(.woocommerce-order-received) footer{
    display:none !important;
}</style>";
}


//Aplicar precio global
add_action( 'woocommerce_product_data_panels', 'fw_global_variation_price' );
function fw_global_variation_price() {
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


function fw_price_html1($price,$product){
    if((fw_theme_mod("fw_prices_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_prices_visibility")==="hide")return;
    
    $symbol=get_woocommerce_currency_symbol();
    if($product->product_type == 'variable'){
        $available_variations = $product->get_available_variations();                               
        $maximumper = 0;
        for ($i = 0; $i < count($available_variations); ++$i) {
            $variation_id=$available_variations[$i]['variation_id'];
            $variable_product1= new WC_Product_Variation( $variation_id );
            $regular_price = $variable_product1 ->regular_price;
            $sale_price = $variable_product1 ->sale_price;
            if(intval($regular_price) && intval($sale_price)){
                $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
                if ($percentage > $maximumper) $maximumper = $percentage;
            }
            
            
        }
        $percentage=$maximumper;
    }else{
        $regular_price=$product->regular_price;
        $sale_price=$product->sale_price;
        if(intval($regular_price) && intval($sale_price)){
        $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
        }else{
            $percentage=0;
        }
    }
    if($product->is_on_sale()){
    return '<span class="fw_price price1">
        <span class="precio">'.$symbol.$sale_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').'</span></span>
        <span class="tachado">
            <span class="precio-anterior"><del>'.$symbol.$regular_price.'</del></span>
            <span class="badge badge-success">'.$percentage.'% OFF</span>
        </span>
        </span>';
    }else{
        return '<span class="fw_price price1"><span class="precio">'.$symbol.$regular_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').'</span></span></span>';
    }      
}

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'fw_child_manage_woocommerce_styles', 100 );

function fw_child_manage_woocommerce_styles() {
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
            wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script( 'wc-checkout' );
            wp_dequeue_script( 'wc-add-to-cart-variation' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-cart' );
            wp_dequeue_script( 'wc-chosen' );
            wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'jqueryui' );

            wp_enqueue_style( 'woocommerce-layout' );

        }
    }
 
}
// Remove CSS and/or JS for Select2 used by WooCommerce, see https://gist.github.com/Willem-Siebe/c6d798ccba249d5bf080.
//add_action( 'wp_enqueue_scripts', 'wsis_dequeue_stylesandscripts_select2', 100 );

  function wsis_dequeue_stylesandscripts_select2() {
     // if(wp_is_mobile()){
        if ( class_exists( 'woocommerce' ) ) {
          wp_dequeue_style( 'selectWoo' );
          wp_deregister_style( 'selectWoo' );
  
          wp_dequeue_script( 'selectWoo');
          wp_deregister_script('selectWoo');
      //  } 
      }    
     
  }
/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
    if(fw_theme_mod('fw_currency_symbol'))return fw_theme_mod('fw_currency_symbol');
    return $currency_symbol;
}


add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
 return '';
}

add_action( 'init', 'fw_otherwoo_options');
function fw_otherwoo_options(){
    
    if((fw_theme_mod("fw_prices_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_prices_visibility")==="hide"){
        add_filter( 'woocommerce_get_price_html',function( $price ) {return '';});
    }
    if((fw_theme_mod("fw_purchases_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_purchases_visibility")==="hide"){
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30 ); 
    }
    if(fw_theme_mod("sold-alone")){
        add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' ); 
        add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );
    }
    if(!empty(fw_theme_mod("checkout-msg"))){
        add_action( 'woocommerce_before_checkout_form', 'fw_before_paying_notice' );
    }
    if(!empty(fw_theme_mod("order_email_msg"))){
      add_action( 'woocommerce_email_before_order_table', 'fw_add_msg_to_order', 20, 4 );
    }
    

}



function fw_add_msg_to_order( $order, $sent_to_admin, $plain_text, $email ) {
    if ( $email->id == 'customer_processing_order' ) {
        echo '<h2 class="email-upsell-title">'.fw_theme_mod("order_email_msg").'</h2>';
    }
}


function wc_remove_all_quantity_fields( $return, $product ){
    return true;
}

function my_custom_add_to_cart_redirect( $url ) {
    $url = WC()->cart->get_checkout_url();
    return $url;
}

function fw_before_paying_notice() {
    
    wc_print_notice(fw_theme_mod("checkout-msg"), 'error' );
}

//Stock labels
add_filter( 'woocommerce_get_availability', 'fw_custom_get_availability', 1, 2); 

function fw_custom_get_availability( $availability, $_product ) { // Change Out of Stock Text 
    
    if ( $_product->is_in_stock() )$availability['availability'] = fw_theme_mod("in-stock-text");
    if ( !$_product->is_in_stock() )$availability['availability'] =  fw_theme_mod("out-of-stock-text");
    return $availability; 
}





/**
 * Change number of related products output
 */ 

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
    //error_log(fw_theme_mod("related_columns"));
    $args['posts_per_page'] = 4;//fw_theme_mod("related_columns"); // 4 related products
    $args['columns'] = 4;//fw_theme_mod("related_columns"); // arranged in 2 columns
    return $args;
}
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return fw_theme_mod('shop_columns');
    }
}

// Change add to cart text on archives depending on product type
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_booking_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {
    global $product;
    
    $product_type = $product->product_type;
    
    switch ( $product_type ) {
        case 'external':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        case 'grouped':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        case 'simple':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        case 'variable':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        default:
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
    }
    
}


/*DESCARGAS*/
add_filter( 'woocommerce_product_tabs', 'fw_new_product_taba' );
function fw_new_product_taba( $tabs ) {
    global $product;
    if (!class_exists('WC_Product_Documents_Collection'))return $tabs;
    $documents_collection = new WC_Product_Documents_Collection( $product->id );
	if ( $documents_collection->has_sections() ) {
		$tabs['descargas'] = array(
        'title'     => __( 'Descargas', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'fw_pestana_descargas'
        );
	}
    return $tabs;

}
function fw_pestana_descargas() {
    echo '<table id="myTable">
<tr class="header">
<th style="width: 60%;">Producto</th>
<th style="width: 40%;">Descargas</th>
</tr>';
    echo do_shortcode('[woocommerce_product_documents]');
    echo '</table>';

    
}
/*VIDE*/
//add_filter( 'woocommerce_product_tabs', 'fw_video_tab' );
function fw_video_tab( $tabs ) {
  global $product;
  $json = get_post_meta($product->id, '_fw_products_videos', true );
  if (strpos($json, 'youtube') || strpos($json, '.mp4') ){

        $tabs['_tab_video'] = array(
          'title'   => __( 'Videos', 'woocommerce' ),
          'priority'  => 100,
          'callback'  => 'fwvideo_tab'
        );
  }
  return $tabs; 
}

//video
// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
function woocommerce_product_custom_fields(){
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_fw_products_videos',
            'placeholder' => 'Uno por linea',
            'label' => __('Videos', 'woocommerce')
        )
    );
    echo '</div>';

}
// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');
function woocommerce_product_custom_fields_save($post_id){
// Custom Product Textarea Field
    $woocommerce_custom_procut_textarea = $_POST['_fw_products_videos'];
    if (!empty($woocommerce_custom_procut_textarea))
        update_post_meta($post_id, '_fw_products_videos', esc_html($woocommerce_custom_procut_textarea));

}
function fw_get_yt_videos() {

  // The new tab content
  global $product;
  $json = get_post_meta($product->id, '_fw_products_videos', true );
  preg_match_all('~(?#!js YouTubeId Rev:20160125_1800)
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        https?://          # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)?  # Optional subdomain.
        (?:                # Group host alternatives.
          youtu\.be/       # Either youtu.be,
        | youtube          # or youtube.com or
          (?:-nocookie)?   # youtube-nocookie.com
          \.com            # followed by
          \S*?             # Allow anything up to VIDEO_ID,
          [^\w\s-]         # but char before ID is non-ID char.
        )                  # End host alternatives.
        ([\w-]{11})        # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)       # Assert next char is non-ID or EOS.
        (?!                # Assert URL is not pre-linked.
          [?=&+%\w.-]*     # Allow URL (query) remainder.
          (?:              # Group pre-linked alternatives.
            [\'"][^<>]*>   # Either inside a start tag,
          | </a>           # or inside <a> element text contents.
          )                # End recognized pre-linked alts.
        )                  # End negative lookahead assertion.
        [?=&+%\w.-]*       # Consume any URL (query) remainder.
        ~ix', $json, $coincidencias, PREG_SET_ORDER);
  return $coincidencias;
}
function fwvideo_tab() {
  foreach(fw_get_yt_videos() as $video){
    $url = $video[1];
    echo '<div class="fw_container_video"><iframe src="https://www.youtube.com/embed/'.$url.'" frameborder="0" allowfullscreen class="fw_video_frame"></iframe></div>';
  }
}







/*brands*/
// Register Custom Taxonomy
function ess_custom_taxonomy_Item()  {

    $labels = array(
        'name'                       => 'Brands',
        'singular_name'              => 'Brand',
        'menu_name'                  => 'Brands',
        'all_items'                  => 'All Brands',
        'parent_item'                => 'Parent Brand',
        'parent_item_colon'          => 'Parent Brand:',
        'new_item_name'              => 'New Brand Name',
        'add_new_item'               => 'Add New Brand',
        'edit_item'                  => 'Edit Brand',
        'update_item'                => 'Update Brand',
        'separate_items_with_commas' => 'Separate Brand with commas',
        'search_items'               => 'Search Brands',
        'add_or_remove_items'        => 'Add or remove Brands',
        'choose_from_most_used'      => 'Choose from the most used Brands',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'thumbnail'                  => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'brand', 'product', $args );
    
}
    
add_action( 'init', 'ess_custom_taxonomy_item', 0 );



if ( ! class_exists( 'BRAND_THUMB' ) ) {

  class BRAND_THUMB {
  
    public function __construct() {
      //
    }
  
   /*
    * Initialize the class and start calling our hooks and filters
    * @since 1.0.0
   */
   public function init() {
     add_action( 'brand_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
     add_action( 'created_brand', array ( $this, 'save_category_image' ), 10, 2 );
     add_action( 'brand_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
     add_action( 'edited_brand', array ( $this, 'updated_category_image' ), 10, 2 );
     add_action( 'admin_footer', array ( $this, 'add_script' ) );
   }
  
   /*
    * Add a form field in the new category page
    * @since 1.0.0
   */
   public function add_category_image ( $taxonomy ) { ?>
     <div class="form-field term-group">
       <label for="thumbnail_id"><?php _e('Image', 'hero-theme'); ?></label>
       <input type="hidden" id="thumbnail_id" name="thumbnail_id" class="custom_media_url" value="">
       <div id="brand-thumb-wrapper"></div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
      </p>
     </div>
   <?php
   }
  
   /*
    * Save the form field
    * @since 1.0.0
   */
   public function save_category_image ( $term_id, $tt_id ) {
     if( isset( $_POST['thumbnail_id'] ) && '' !== $_POST['thumbnail_id'] ){
       $image = $_POST['thumbnail_id'];
       add_term_meta( $term_id, 'thumbnail_id', $image, true );
     }
   }
  
   /*
    * Edit the form field
    * @since 1.0.0
   */
   public function update_category_image ( $term, $taxonomy ) { ?>
     <tr class="form-field term-group-wrap">
       <th scope="row">
         <label for="thumbnail_id"><?php _e( 'Image', 'hero-theme' ); ?></label>
       </th>
       <td>
         <?php $image_id = get_term_meta ( $term -> term_id, 'thumbnail_id', true ); ?>
         <input type="hidden" id="thumbnail_id" name="thumbnail_id" value="<?php echo $image_id; ?>">
         <div id="brand-thumb-wrapper">
           <?php if ( $image_id ) { ?>
             <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
           <?php } ?>
         </div>
         <p>
           <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
           <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
         </p>
       </td>
     </tr>
   <?php
   }
  
  /*
   * Update the form field value
   * @since 1.0.0
   */
   public function updated_category_image ( $term_id, $tt_id ) {
     if( isset( $_POST['thumbnail_id'] ) && '' !== $_POST['thumbnail_id'] ){
       $image = $_POST['thumbnail_id'];
       update_term_meta ( $term_id, 'thumbnail_id', $image );
     } else {
       update_term_meta ( $term_id, 'thumbnail_id', '' );
     }
   }
  
  /*
   * Add script
   * @since 1.0.0
   */
   public function add_script() { ?>
     <script>
       jQuery(document).ready( function($) {
         function ct_media_upload(button_class) {
           var _custom_media = true,
           _orig_send_attachment = wp.media.editor.send.attachment;
           jQuery('body').on('click', button_class, function(e) {
             var button_id = '#'+jQuery(this).attr('id');
             var send_attachment_bkp = wp.media.editor.send.attachment;
             var button = jQuery(button_id);
             _custom_media = true;
             wp.media.editor.send.attachment = function(props, attachment){
               if ( _custom_media ) {
                 console.log(attachment.url)
                 jQuery('#thumbnail_id').val(attachment.id);
                 jQuery('#brand-thumb-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                 var thumb='#'
                 if(attachment.sizes.thumbnail !== undefined)thumb =attachment.sizes.thumbnail.url;
                 else thumb=attachment.url;//si es menor que 150px
                 jQuery('#brand-thumb-wrapper .custom_media_image').attr('src',thumb).css('display','block');
               } else {
                 return _orig_send_attachment.apply( button_id, [props, attachment] );
               }
              }
           wp.media.editor.open(button);
           return false;
         });
       }
       ct_media_upload('.ct_tax_media_button.button');
       jQuery('body').on('click','.ct_tax_media_remove',function(){
         jQuery('#thumbnail_id').val('');
         jQuery('#brand-thumb-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });
       // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
       jQuery(document).ajaxComplete(function(event, xhr, settings) {
         var queryStringArr = settings.data.split('&');
         if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
           var xml = xhr.responseXML;
           $response = jQuery(xml).find('term_id').text();
           if($response!=""){
             // Clear the thumb image
             jQuery('#brand-thumb-wrapper').html('');
           }
         }
       });
     });
   </script>
   <?php }
  
    }
  
$BRAND_THUMB = new BRAND_THUMB();
$BRAND_THUMB -> init();

}
function load_wp_media_files() {
wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );













if ( ! class_exists( 'CT_TAX_METABANNER' ) ) {

    class CT_TAX_METABANNER {
    
      public function __construct() {
   
      }
    
     public function init() {
       add_action( 'brand_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
       add_action( 'created_brand', array ( $this, 'save_category_image' ), 10, 2 );
       add_action( 'brand_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
       add_action( 'edited_brand', array ( $this, 'updated_category_image' ), 10, 2 );
       add_action( 'admin_footer', array ( $this, 'add_script' ) );
     }
    

     public function add_category_image ( $taxonomy ) { ?>
       <div class="form-field term-group">
         <label for="banner_id"><?php _e('Image', 'hero-theme'); ?></label>
         <input type="hidden" id="banner_id" name="banner_id" class="custom_media_url" value="">
         <div id="brand-banner-wrapper"></div>
         <p>
           <input type="button" class="button button-secondary brand_banner_button" id="brand_banner_button" name="brand_banner_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
           <input type="button" class="button button-secondary brand_banner_remove" id="brand_banner_remove" name="brand_banner_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
        </p>
       </div>
     <?php
     }
    
     /*
      * Save the form field
      * @since 1.0.0
     */
     public function save_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['banner_id'] ) && '' !== $_POST['banner_id'] ){
         $image = $_POST['banner_id'];
         add_term_meta( $term_id, 'banner_id', $image, true );
       }
     }
    
     /*
      * Edit the form field
      * @since 1.0.0
     */
     public function update_category_image ( $term, $taxonomy ) { ?>
       <tr class="form-field term-group-wrap">
         <th scope="row">
           <label for="banner_id"><?php _e( 'Banner', 'hero-theme' ); ?></label>
         </th>
         <td>
           <?php $image_id = get_term_meta ( $term -> term_id, 'banner_id', true ); ?>
           <input type="hidden" id="banner_id" name="banner_id" value="<?php echo $image_id; ?>">
           <div id="brand-banner-wrapper">
             <?php if ( $image_id ) { ?>
               <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
             <?php } ?>
           </div>
           <p>
             <input type="button" class="button button-secondary brand_banner_button" id="brand_banner_button" name="brand_banner_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
             <input type="button" class="button button-secondary brand_banner_remove" id="brand_banner_remove" name="brand_banner_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
           </p>
         </td>
       </tr>
     <?php
     }
    
    /*
     * Update the form field value
     * @since 1.0.0
     */
     public function updated_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['banner_id'] ) && '' !== $_POST['banner_id'] ){
         $image = $_POST['banner_id'];
         update_term_meta ( $term_id, 'banner_id', $image );
       } else {
         update_term_meta ( $term_id, 'banner_id', '' );
       }
     }
    
    /*
     * Add script
     * @since 1.0.0
     */
     public function add_script() { ?>
       <script>
         jQuery(document).ready( function($) {
           function ct_media_upload(button_class) {
             var _custom_media = true,
             _orig_send_attachment = wp.media.editor.send.attachment;
             jQuery('body').on('click', button_class, function(e) {
               var button_id = '#'+jQuery(this).attr('id');
               var send_attachment_bkp = wp.media.editor.send.attachment;
               var button = jQuery(button_id);
               _custom_media = true;
               wp.media.editor.send.attachment = function(props, attachment){
                 if ( _custom_media ) {
                   jQuery('#banner_id').val(attachment.id);
                   jQuery('#brand-banner-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                   jQuery('#brand-banner-wrapper .custom_media_image').attr('src',attachment.sizes.thumbnail.url).css('display','block');
                 } else {
                   return _orig_send_attachment.apply( button_id, [props, attachment] );
                 }
                }
             wp.media.editor.open(button);
             return false;
           });
         }
         ct_media_upload('.brand_banner_button.button');
         jQuery('body').on('click','.brand_banner_remove',function(){
           jQuery('#banner_id').val('');
           jQuery('#brand-banner-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
         });
         // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
         jQuery(document).ajaxComplete(function(event, xhr, settings) {
           var queryStringArr = settings.data.split('&');
           if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
             var xml = xhr.responseXML;
             $response = jQuery(xml).find('term_id').text();
             if($response!=""){
               // Clear the thumb image
               jQuery('#brand-banner-wrapper').html('');
             }
           }
         });
       });
     </script>
     <?php }
    
      }

$CT_TAX_METABANNER = new CT_TAX_METABANNER();
$CT_TAX_METABANNER -> init();

}
function load_wp_media_files2() {
wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files2' );









if ( ! class_exists( 'PRODUCT_CAT_BANNER' ) ) {

    class PRODUCT_CAT_BANNER {
    
      public function __construct() {
   
      }
    
     public function init() {
       add_action( 'product_cat_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
       add_action( 'created_product_cat', array ( $this, 'save_category_image' ), 10, 2 );
       add_action( 'product_cat_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
       add_action( 'edited_product_cat', array ( $this, 'updated_category_image' ), 10, 2 );
       add_action( 'admin_footer', array ( $this, 'add_script' ) );
     }
    

     public function add_category_image ( $taxonomy ) { ?>
       <div class="form-field term-group">
         <label for="banner_id"><?php _e('Image', 'hero-theme'); ?></label>
         <input type="hidden" id="banner_id" name="banner_id" class="custom_media_url" value="">
         <div id="product_cat-banner-wrapper"></div>
         <p>
           <input type="button" class="button button-secondary product_cat_banner_button" id="product_cat_banner_button" name="product_cat_banner_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
           <input type="button" class="button button-secondary product_cat_banner_remove" id="product_cat_banner_remove" name="product_cat_banner_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
        </p>
       </div>
     <?php
     }
    
     /*
      * Save the form field
      * @since 1.0.0
     */
     public function save_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['banner_id'] ) && '' !== $_POST['banner_id'] ){
         $image = $_POST['banner_id'];
         add_term_meta( $term_id, 'banner_id', $image, true );
       }
     }
    
     /*
      * Edit the form field
      * @since 1.0.0
     */
     public function update_category_image ( $term, $taxonomy ) { ?>
       <tr class="form-field term-group-wrap">
         <th scope="row">
           <label for="banner_id"><?php _e( 'Banner', 'hero-theme' ); ?></label>
         </th>
         <td>
           <?php $image_id = get_term_meta ( $term -> term_id, 'banner_id', true ); ?>
           <input type="hidden" id="banner_id" name="banner_id" value="<?php echo $image_id; ?>">
           <div id="product_cat-banner-wrapper">
             <?php if ( $image_id ) { ?>
               <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
             <?php } ?>
           </div>
           <p>
             <input type="button" class="button button-secondary product_cat_banner_button" id="product_cat_banner_button" name="product_cat_banner_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
             <input type="button" class="button button-secondary product_cat_banner_remove" id="product_cat_banner_remove" name="product_cat_banner_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
           </p>
         </td>
       </tr>
     <?php
     }
    
    /*
     * Update the form field value
     * @since 1.0.0
     */
     public function updated_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['banner_id'] ) && '' !== $_POST['banner_id'] ){
         $image = $_POST['banner_id'];
         update_term_meta ( $term_id, 'banner_id', $image );
       } else {
         update_term_meta ( $term_id, 'banner_id', '' );
       }
     }
    
    /*
     * Add script
     * @since 1.0.0
     */
     public function add_script() { ?>
       <script>
         jQuery(document).ready( function($) {
           function ct_media_upload(button_class) {
             var _custom_media = true,
             _orig_send_attachment = wp.media.editor.send.attachment;
             jQuery('body').on('click', button_class, function(e) {
               var button_id = '#'+jQuery(this).attr('id');
               var send_attachment_bkp = wp.media.editor.send.attachment;
               var button = jQuery(button_id);
               _custom_media = true;
               wp.media.editor.send.attachment = function(props, attachment){
                 if ( _custom_media ) {
                   jQuery('#banner_id').val(attachment.id);
                   jQuery('#product_cat-banner-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                   jQuery('#product_cat-banner-wrapper .custom_media_image').attr('src',attachment.sizes.thumbnail.url).css('display','block');
                 } else {
                   return _orig_send_attachment.apply( button_id, [props, attachment] );
                 }
                }
             wp.media.editor.open(button);
             return false;
           });
         }
         ct_media_upload('.product_cat_banner_button.button');
         jQuery('body').on('click','.product_cat_banner_remove',function(){
           jQuery('#banner_id').val('');
           jQuery('#product_cat-banner-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
         });
         // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
         jQuery(document).ajaxComplete(function(event, xhr, settings) {
           var queryStringArr = settings.data.split('&');
           if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
             var xml = xhr.responseXML;
             $response = jQuery(xml).find('term_id').text();
             if($response!=""){
               // Clear the thumb image
               jQuery('#product_cat-banner-wrapper').html('');
             }
           }
         });
       });
     </script>
     <?php }
    
      }

$PRODUCT_CAT_BANNER = new PRODUCT_CAT_BANNER();
$PRODUCT_CAT_BANNER -> init();

}
function load_wp_media_files3() {
wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files3' );