<?php

/*SHOP MANAGER ROLES*/

function fw_share_redes(){
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    echo '<div id="fw_share_redes" class="d-flex justify-content-between">
    <!-- Email -->
    <a href="mailto:?Subject=Mirá este producto&amp;Body=Mirá este producto que encontré '.$actual_link.'">
        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
    </a>
 
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u='.$actual_link.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
    </a>
    
    <!-- Link -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$actual_link.'" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
    </a>
    
    <!-- Facebook -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)%7D)());">
        <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
    </a>
    <!-- Print -->
    <a href="javascript:;" onclick="window.print()">
        <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
    </a>
    
    <!-- Twitter -->
    <a href="https://twitter.com/share?url='.$actual_link.'&amp;text=Mirá este producto que encontré" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
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
function fw_single_related(){
    $myarray = wc_get_related_products($product->id,12);

    $args = array(
        'post_type' => 'product',
        'post__in'      => $myarray
    );
    // The Query
    $products = new WP_Query( $args );

    while ( $products->have_posts() ) : 
        //$contada++;
        $products->the_post(); 
        echo '<div class="swiper-slide">';
        wc_get_template_part( 'content', 'product' ); 
        echo '</div>';    
    endwhile; 
}

function fw_getfastars($average){
    if(!is_numeric($average))return "";
    $html='<a >';
    $vacia=false;
    if($average==0)$vacia=true;
	for($i=1;$i<=5;$i++){
        $clase="";
		//error_log($i." ".$average." ".floor($average));
		if(!$vacia){
			if($i==floor($average) && floor($average)!=$average){
                $clase="-half ";$vacia=true;
                //error_log("entro?");
			}
			else if($i>=$average)$vacia=true;
			else if($i<$average)$clase="";
			//else $vacia=true;
		}else{
            //error_log("entro?");
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
        $devuelvo .='<div class="logocheckout"><img src="'.fw_theme_mod('general-logo').'"/></div>';
    
    }else if( is_checkout() && is_order_received_page() ) {
        
        $active3="active";   
        
    }
    $devuelvo.='<ul class="pasoscheckout">
              <li class="'.$active1.'"><a>MI COMPRA</a></li>
              <li class="'.$active2.'"><a>PAGO Y ENVÍO</a></li>
              <li class="'.$active3.'"><a>TERMINAR</a></li>
            </ul>';

    echo $devuelvo;

}
if(fw_theme_mod("cart-steps")){
add_action('woocommerce_before_cart', 'fw_pngcheckout_short');   
add_action('woocommerce_before_checkout_form', 'fw_pngcheckout_short',0);  
}

if(fw_theme_mod("checkout-minimal")){
add_action( 'wp_head', 'add_chkstl_to_head' );
}

function add_chkstl_to_head() {
echo "<style>.woocommerce-checkout:not(.woocommerce-order-received) header,.woocommerce-checkout:not(.woocommerce-order-received) footer{
    display:none !important;
}</style>";
}
function fw_product_gallery($product){
    $fotos=$product->get_gallery_attachment_ids();
    array_push($fotos,intval(get_post_thumbnail_id( $product->id )));
    $fotos=array_reverse($fotos);
    
    foreach ($fotos as $ids) {
        
        $url=wp_get_attachment_url( $ids);
        echo '<a href='.$url.' data-fancybox="gallery" class="d-flex align-items-center" style="background-color: white; position: absolute; top: 0px; left: 0px; opacity: 1;">
            <img itemprop="image" src="'.$url.'" width=400 height="auto">
            <div class="lupaImg"><i class="fa fa-search-plus"></i></div>
        </a>';
    }
    foreach(fw_get_yt_videos() as $coin){
        $url = $coin[1]; 
        echo '<div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject" style="width: 100%; background-color: rgb(0, 0, 0); position: absolute; top: 0px; left: 0px; display: none; z-index: 1;">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/'.$url.'?rel=0" frameborder="0" allowfullscreen=""></iframe>
        </div>';

    }
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

function envio_labels($product){
    if($product->get_shipping_class()=="envio-gratis"){
        echo '<div class="envio-gratis-tag grupo-envio-6" title="Éste producto tiene envío Gratis"><i class="fal fa-shipping-fast"></i> Gratis</div>';
    }
}

function fw_price_html1( $price, $product ){
    if(fw_theme_mod("prices-enabled"))return '';
    if($product->product_type == 'variable'){
        $available_variations = $product->get_available_variations();                               
        $maximumper = 0;
        for ($i = 0; $i < count($available_variations); ++$i) {
            $variation_id=$available_variations[$i]['variation_id'];
            $variable_product1= new WC_Product_Variation( $variation_id );
            $regular_price = $variable_product1 ->regular_price;
            $sale_price = $variable_product1 ->sale_price;
            $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
            if ($percentage > $maximumper) {
                $maximumper = $percentage;
            }
        }
        $percentage=$maximumper;
    }else{
        $regular_price=$product->regular_price;
        $sale_price=$product->sale_price;
        $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
    }

    //if($product->is_on_sale()){
  
        if($product->is_on_sale()){
        return '<div class="precioproducto">
            <span class="precio">$'.$sale_price.'</span>
            <div class="tachado">
                <span class="precio-anterior t1 tachado"><del>$'.$regular_price.'</del></span>
                <span class="badge badge-success txt-12">'.$percentage.'% OFF</span>
            </div>
            </div>';
        }else{
             return '<div class="precioproducto">
                <span class="precio">$'.$regular_price.'</span>
                </div>';
        }      
}
$my_theme = wp_get_theme();
if($my_theme!="lombok-child")
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


add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
 return '';
}

add_action( 'init', 'fw_otherwoo_options');
function fw_otherwoo_options(){
    

    if(fw_theme_mod("prices-enabled")){
        add_filter( 'woocommerce_get_price_html', function( $price ) {
            return '';
        } );
    }
    if(fw_theme_mod("purchases-enabled")){
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
