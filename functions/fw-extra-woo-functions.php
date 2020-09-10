<?php

// Validate required term and conditions check box
add_action( 'woocommerce_register_post', 'terms_and_conditions_validation', 20, 3 );
function terms_and_conditions_validation( $username, $email, $validation_errors ) {
    if ( ! isset( $_POST['terms'] ) && fw_theme_mod('fw_terms_required') )
        $validation_errors->add( 'terms_error', __( 'Terms are remaining', 'fastway' ) );

    return $validation_errors;
}

/*LOOP FUNCTIONS*/
add_shortcode('fw_loop_title', 'fw_loop_title');
function fw_loop_title(){
    global $product;
    echo '<h2 class="product_title">'.$product->post->post_title.'</h2>';
}
add_shortcode('fw_loop_price', 'fw_loop_price');
function fw_loop_price(){
    global $product;
    echo $product->get_price_html();
}

add_shortcode('fw_single_price', 'fw_single_price');
function fw_single_price(){
    global $product;
    echo $product->get_price_html();
}

add_shortcode('fw_single_cf','fw_get_custom_field');
function fw_get_custom_field($atts){
    global $product;
    $sku=get_post_meta($product->id,$atts['id'],true);
    if(!empty($sku))echo $sku;
}

add_shortcode('fw_customer_product_summary', 'fw_customer_product_summary');
function fw_customer_product_summary(){
    echo wp_kses_post( wpautop( wptexturize(get_option('fw_email_content_product_summary'))));
}

add_shortcode('fw_loop_cat', 'fw_loop_cat');
function fw_loop_cat(){
    global $product;
    echo '<span class="fw_loop_cat">'.fw_getcat($product->id).'</span>';
}
//Sacael limite de 2 variaciones
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_true' );

add_shortcode('fw_sale', 'fw_sale');
function fw_sale($atts = []){
  $atts = shortcode_atts(array('class' => '','type' => 1  ), $atts );
  global $product;
  if(!$product->is_on_sale())return;
  $sale= $product->get_sale_price();
  $price= $product->get_regular_price();
  if($atts['type']==1)$off=fw_theme_mod('fw_label_sale');
  else if($atts['type'==2])$off=$price-$sale;
	echo '<span class="sale_text '.$atts['class'].'">'.$off.'</span>';
}
add_shortcode('fw_cuotas', 'fw_cuotas');
function fw_cuotas($atts = []){
  $atts = shortcode_atts(array('class' => '' ,'cant' => 0 ), $atts );
  global $product;
  if($atts['cant']=='general')$atts['cant']=fw_theme_mod('fw_cuotas_general');
  $cuotas=floatval($atts['cant']);
  $precio=floatval($product->get_sale_price());
  
  if( $product->is_type('variable') ){
    $precio = floatval($product->get_variation_regular_price( 'min', true ));
    $sale_price = floatval($product->get_variation_sale_price( 'min', true ));
    if(!$sale_price || $sale_price==$regular_price)$sale_price=$regular_price*fw_product_discount_multiplier($product);
    $sale_price=round($sale_price*get_currency_conversion());
    if($sale_price>0)$precio= $sale_price;
  }

  
  $precio=round($precio/$cuotas);
  if($precio>0)echo '<span class="cuota_text '.$atts['class'].'"><i class="fad fa-credit-card"></i> '.$cuotas.' cuotas de $'.$precio.'</span>';
}
function fw_getcat( $product_id ){//Esto es para los mails
    $tax = 'product_cat';
    $terms = wp_get_post_terms( $product_id, $tax);
    if( $terms && ! is_wp_error( $terms )) {
        foreach ($terms as $categoria) {
            //if($categoria->parent > 0){
              // if($categoria->parent == 340){
              $nombre= $categoria->name;
              if(!in_array($nombre,array('sin-categorizar','sin-categoria','uncategorized')))return $nombre;
               
           // }
        }
    }

    return $name;
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
    echo '<div class="desc">'.wpautop($product->post->post_excerpt).'</div>';
}


add_shortcode('fw_loop_image', 'fw_loop_image');
function fw_loop_image(){
    global $product;
    echo '<div class="loopimg_container">'.woocommerce_get_product_thumbnail().'</div>';
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





add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 

function woo_custom_order_button_text() {
  return " ".fw_theme_mod('fw_place_order_text');

}
add_action( 'woocommerce_review_order_after_submit', 'bbloomer_privacy_message_below_checkout_button' );
function bbloomer_privacy_message_below_checkout_button() {
   echo '<p><small>'.fw_theme_mod('checkout-bottom-text').'</small></p>';
}

add_filter( 'body_class','fw_single_product_clasess' );
function fw_single_product_clasess( $classes ) {
  if ( is_product() ) {

      global $post;
      $terms = get_the_terms( $post->ID, 'product_cat' );
      foreach ($terms as $term) {
          $product_cat_id = $term->term_id;
          $classes[] = 'product-in-cat-' . $product_cat_id;    
      }
  }
  $classes[]=fw_theme_mod('fw_single_product_layout');
  

  return $classes;
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
    $atts = shortcode_atts(array('type' => '','id'=>'','price'=>0 ), $atts );
    global $product;
    
    if($product->get_shipping_class()==$atts['id'] && $atts['type']=='shipping-class'  ){//envio=gratis
        echo '<div class="envio-gratis-tag grupo-envio-6" ><i class="fal fa-shipping-fast"></i> Gratis</div>';
    }else if($atts['type']=='min_price' && $product->get_price()>=$atts['price']){
      echo '<div class="envio-gratis-tag grupo-envio-6" ><i class="fal fa-shipping-fast"></i> Gratis</div>';
    }
}

add_shortcode('fw_conditional', 'fw_if');
add_shortcode('fw_if', 'fw_if');
function fw_if($atts = [], $content = null){
  $atts = shortcode_atts(array('type' => '','id'=>'','price'=>0 ), $atts );
    global $product;
    if($product->get_shipping_class()==$atts['id'] && $atts['type']=='shipping-class'  ){//envio=gratis
       return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }else if($atts['type']=='min_price' && $product->get_price()>=$atts['price']){
      return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }else if($atts['type']=='role' && check_user_role($atts['id'])){
      return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }else if($atts['type']=='logged' && is_user_logged_in()){
      return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }else if($atts['type']=='unlogged' && !is_user_logged_in()){
      return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }else if($atts['type']=='sku' && $product->get_sku()==$atts['id']){
      return do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    }
}
function fw_loop_review(){
    echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_review_code'))));
}
function fw_loop_blog(){
    echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_blog_code'))));
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




function fw_get_customer_orders(){
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
    
  return count($customer_orders);
}


add_action( 'woocommerce_checkout_process', 'fw_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'fw_minimum_order_amount' );         

// VERFW
function pasa_filtro_rol($rolesstring){

  if($rolesstring){
    $estaenlosroles=false;
    $roles=explode(',',$rolesstring);
    foreach($roles as $rol)if(check_user_role($rol))$estaenlosroles=true;
    if(!$estaenlosroles)return false;

  }
  return true;
}

add_shortcode('min_purchase','get_min_purchase');
function get_min_purchase(){
  return fw_theme_mod('fw_min_purchase'); 
}
add_shortcode('min_repurchase','get_min_repurchase');
function get_min_repurchase(){
  return fw_theme_mod('fw_min_purchase2'); 
}


function has_min_purchase(){
  if(empty(fw_theme_mod('fw_min_purchase')))return false;
  $arr=explode("|", fw_theme_mod('fw_min_purchase'));
  if(empty($arr))return;
  foreach($arr as $cant){
    if(empty($cant))continue;
    preg_match('#\((.*?)\)#', $cant, $match);
    $rol=$match[1];
    if(empty($rol))return true;
    else return pasa_filtro_rol($rol);
  }
}
function fw_minimum_order_amount() {
    if(!has_min_purchase())return;
    

    $minimum = fw_theme_mod('fw_min_purchase');  
    if(fw_get_customer_orders()>0)$minimum = fw_theme_mod('fw_min_purchase2');  

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

/**
 * Filter products by type
 *
 * @access public
 * @return void
 */
function wpa104537_filter_products_by_featured_status() {

  global $typenow, $wp_query;

 if ($typenow=='product') :


     // Featured/ Not Featured
     $output .= "<select name='featured_status' id='dropdown_featured_status'>";
     $output .= '<option value="">'.__( 'Filter Featured', 'fastway' ).'</option>';

     $output .="<option value='featured' ";
     if ( isset( $_GET['featured_status'] ) ) $output .= selected('featured', $_GET['featured_status'], false);
     $output .=">".__( 'Featured', 'fastway' )."</option>";

     $output .="<option value='normal' ";
     if ( isset( $_GET['featured_status'] ) ) $output .= selected('normal', $_GET['featured_status'], false);
     $output .=">".__( 'Not Featured', 'fastway' )."</option>";

     $output .="</select>";

     echo $output;
 endif;
}

add_action('restrict_manage_posts', 'wpa104537_filter_products_by_featured_status');


add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
  global $woocommerce;

    if (isset( $_GET['empty-cart'] ) ) { 
        $woocommerce->cart->empty_cart(); 
    }
}
/**
 * Filter the products in admin based on options
 *
 * @access public
 * @param mixed $query
 * @return void
 */
function wpa104537_featured_products_admin_filter_query( $query ) {
  global $typenow;

  if ( $typenow == 'product' ) {

      // Subtypes
      if ( ! empty( $_GET['featured_status'] ) ) {
          if ( $_GET['featured_status'] == 'featured' ) {
              $query->query_vars['tax_query'][] = array(
                  'taxonomy' => 'product_visibility',
                  'field'    => 'slug',
                  'terms'    => 'featured',
              );
          } elseif ( $_GET['featured_status'] == 'normal' ) {
              $query->query_vars['tax_query'][] = array(
                  'taxonomy' => 'product_visibility',
                  'field'    => 'slug',
                  'terms'    => 'featured',
                  'operator' => 'NOT IN',
              );
          }
      }

  }

}
add_filter( 'parse_query', 'wpa104537_featured_products_admin_filter_query' );






add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


function fw_disable_shipping_calc_on_cart( $show_shipping ) {
  if( is_cart() ) return false;
  return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'fw_disable_shipping_calc_on_cart', 99 );
if(get_option('woocommerce_enable_shipping_calc'))update_option('woocommerce_enable_shipping_calc','no');

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'fw_child_manage_woocommerce_styles', 100 );

function fw_child_manage_woocommerce_styles() {
    //remove generator meta tag
    wp_deregister_script('wc-checkout');
    wp_enqueue_script('wc-checkout', get_template_directory_uri() . '/assets/js/checkout.js', array('jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n'), null, true);

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

function get_categories_for_kirki() {
  $args = array(
  'taxonomy'   => 'product_cat',
  'number'     => $number,
  'orderby'    => $orderby,
  'order'      => $order,
  'hide_empty' => $hide_empty,
  'include'    => $ids
  );
  $product_categories = get_terms($args);

  $result = array();
  foreach ( $product_categories as $post ) {
      $result[$post->slug] = $post->name;
  }
  return $result;
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

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
    if(fw_theme_mod('fw_currency_symbol'))return fw_theme_mod('fw_currency_symbol');
    return $currency_symbol;
}


add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
 return '';
}
function fw_check_hide_purchases(){
    if(fw_theme_mod("fw_shop_state")=='hidepurchases' || fw_theme_mod("fw_shop_state")=='hideprices')return true;
    if((fw_theme_mod("fw_purchases_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_purchases_visibility")==="hide")return true;
  
}
function fw_check_hide_prices(){
    if(fw_theme_mod("fw_shop_state")=='hideprices')return true;
    if((fw_theme_mod("fw_prices_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_prices_visibility")==="hide")return true;
  
}

add_action( 'init', 'fw_otherwoo_options');
function fw_otherwoo_options(){
    
    if(fw_check_hide_prices()){
        add_filter( 'woocommerce_get_price_html',function( $price ) {return '';});
    }
    if(fw_check_hide_purchases()){
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

add_action( 'restrict_manage_posts', 'shop_order_user_role_filter' );
function shop_order_user_role_filter() {

	global $typenow, $wp_query;

	if ( in_array( $typenow, wc_get_order_types( 'order-meta-boxes' ) ) ) :
		$user_role	= '';

		// Get all user roles
		$user_roles = array();
		foreach ( get_editable_roles() as $key => $values ) :
			$user_roles[ $key ] = $values['name'];
		endforeach;

		// Set a selected user role
		if ( ! empty( $_GET['_user_role'] ) ) {
			$user_role	= sanitize_text_field( $_GET['_user_role'] );
		}

		// Display drop down
		?><select name='_user_role'>
			<option value=''><?php _e( 'Select a user role', 'woocommerce' ); ?></option><?php
			foreach ( $user_roles as $key => $value ) :
				?><option <?php selected( $user_role, $key ); ?> value='<?php echo $key; ?>'><?php echo $value; ?></option><?php
			endforeach;
		?></select><?php
	endif;


}


add_filter( 'pre_get_posts', 'shop_order_user_role_posts_where' );
function shop_order_user_role_posts_where( $query ) {

	if ( ! $query->is_main_query() || ! isset( $_GET['_user_role'] ) ) {
		return;
	}

	$ids    = get_users( array( 'role' => sanitize_text_field( $_GET['_user_role'] ), 'fields' => 'ID' ) );
	$ids    = array_map( 'absint', $ids );

	$query->set( 'meta_query', array(
		array(
			'key' => '_customer_user',
			'compare' => 'IN',
			'value' => $ids,
		)
	) );

	if ( empty( $ids ) ) {
		$query->set( 'posts_per_page', 0 );
	}

}
//Stock labels
add_filter( 'woocommerce_get_availability', 'fw_custom_get_availability', 1, 2); 
function fw_custom_get_availability( $availability, $_product ) {
    if(get_option('woocommerce_manage_stock')==='no')return "";
    if ( $_product->is_type( 'variable' ) ) return "";
    $instock=true;
    $status=$_product->get_stock_status();
    if(is_numeric($_product->get_stock_quantity()))$instock=$_product->get_stock_quantity()>0;
    
    //$_product->is_in_stock());//This returns true for 'instock' and 'onbackorder' stock statuses.
    if ( $instock && $status=='instock')$availability['availability'] = fw_theme_mod("in-stock-text");
    else if( !$instock && $_product->backorders_allowed())$availability['availability'] =  fw_theme_mod("fw_backorder_text");
    else if ( !$instock || $status=='outofstock' )$availability['availability'] =  fw_theme_mod("out-of-stock-text");
    return $availability; 
}

add_action('woocommerce_cart_coupon', 'themeprefix_back_to_store');
function themeprefix_back_to_store() { 
echo '<a class="btn" style="border-radius:0px;" onclick="window.location.search += \'&empty-cart=si\''.'">'.fw_theme_mod('fw_label_vaciar_carrito').'</a>';
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
            return fw_theme_mod('add-to-cart-text');
        break;
        case 'grouped':
            return fw_theme_mod('add-to-cart-text');
        break;
        case 'simple':
            return fw_theme_mod('add-to-cart-text');
        break;
        case 'variable':
            return  fw_theme_mod('add-to-cart-text');
        break;
        default:
            return fw_theme_mod('add-to-cart-text');
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
        'title'     => __( 'Downloads', 'fastway' ),
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
add_filter( 'woocommerce_product_tabs', 'fw_video_tab' );
function fw_video_tab( $tabs ) {
  global $product;
  $json = get_post_meta($product->id, '_fw_products_videos', true );
  if (strpos($json, 'youtube') || strpos($json, '.mp4') ){
        $tabs['_tab_video'] = array(
          'title'   => __( 'Videos', 'fastway' ),
          'priority'  => 100,
          'callback'  => 'fwvideo_tab'
        );
  }
  
  return $tabs; 
}

add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
function woocommerce_product_custom_fields(){
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_fw_products_videos',
            'placeholder' => 'Uno por linea',
            'label' => __('Videos', 'fastway')
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_text_input(
      array(
          'id' => '_fw_guia_talles',
          'placeholder' => 'Url para iframe',
          'label' => __('Size guide', 'fastway')
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

    $woocommerce_custom_procut_textarea = $_POST['_fw_guia_talles'];
    if (!empty($woocommerce_custom_procut_textarea))
        update_post_meta($post_id, '_fw_guia_talles', esc_html($woocommerce_custom_procut_textarea));

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


/* auto update */
 
add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' ); 
 
function bbloomer_cart_refresh_update_qty() { 
   if (is_cart()) { 
      ?> 
      <script type="text/javascript"> 
         jQuery('div.woocommerce').on('click', 'input.qty', function(){ 
            jQuery("[name='update_cart']").trigger("click"); 
         }); 
      </script> 
      <?php 
   } 
}





add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
    global $product;
    if (  $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) 
        $tabs['additional_information']['title'] = __( 'Specs','fastway' );  

    return $tabs;

}

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


if(fw_theme_mod('fw_define_shipping_default')){
  //Default shipping salvo que este activo KIJAM, que ya se los pone.
  add_filter( 'woocommerce_product_get_length', 'xa_product_default_length' );
  add_filter( 'woocommerce_product_variation_get_length', 'xa_product_default_length' );	// For variable product variations

  if( ! function_exists('xa_product_default_length') ) {
    function xa_product_default_length( $length) {

      $default_length = 20;			// Provide default Length
      if( empty($length) ) {
        return $default_length;
      }
      else {
        return $length;
      }
    }
  }

  // To set Default Width
  add_filter( 'woocommerce_product_get_width', 'xa_product_default_width');
  add_filter( 'woocommerce_product_variation_get_width', 'xa_product_default_width' );	// For variable product variations
  if( ! function_exists('xa_product_default_width') ) {
    function xa_product_default_width( $width) {

      $default_width = 20;			// Provide default Width
      if( empty($width) ) {
        return $default_width;
      }
      else {
        return $width;
      }
    }
  }

  // To set Default Height
  add_filter( 'woocommerce_product_get_height', 'xa_product_default_height');
  add_filter( 'woocommerce_product_variation_get_height', 'xa_product_default_height' );	// For variable product variations
  if( ! function_exists('xa_product_default_height')) {
    function xa_product_default_height( $height) {

      $default_height = 20;			// Provide default Height
      if( empty($height) ) {
        return $default_height;
      }
      else {
        return $height;
      }
    }
  }

  // To set Default Weight
  add_filter( 'woocommerce_product_get_weight', 'xa_product_default_weight' );
  add_filter( 'woocommerce_product_variation_get_weight', 'xa_product_default_weight' );	// For variable product variations
  if( ! function_exists('xa_product_default_weight') ) {
    function xa_product_default_weight( $weight) {
      $default_weight = 0.2;			// Provide default Weight
      if( empty($weight) ) {
        return $default_weight;
      }
      else {
        return $weight;
      }
    }
  }
  
}



function fw_hide_shipping_when_free_is_available( $rates) {
  $free = array();
  $entro=false;
  $cart_total = WC()->cart->cart_contents_total;
  $lili_disc=get_lili_discount(WC()->cart);
	foreach ( $rates as $rate_id => $rate ) {
    if ( 'free_shipping' == $rate->method_id){
      $entro=true;
      $min = get_option('woocommerce_free_shipping_'.$rate->instance_id.'_settings')['min_amount'];
      if(($cart_total+$lili_disc) < $min){
        unset($rates[$rate->id]);
        $entro=false;
      }
    }
		if ( 'free_shipping' == $rate->method_id || 'local_pickup' == $rate->method_id || 'mercadoenvios-shipping' === $rate->method_id) {
      $free[ $rate_id ] = $rate;
    }
  }
	return $entro  ? $free : $rates;
}

if(fw_theme_mod("fw_show_only_free_shipping") && !esMultitienda())add_filter( 'woocommerce_package_rates', 'fw_hide_shipping_when_free_is_available' ,1);

if(!fw_theme_mod("fw_show_cross_sells"))remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
if ( ! function_exists( 'woocommerce_cross_sell_display' ) ) {
  
	function woocommerce_cross_sell_display( $limit = 2, $columns = 2, $orderby = 'rand', $order = 'desc' ) {
		if ( is_checkout() ) {
			return;
		}
    $cols=3;
    echo '
<div class="cross" >
<h4 class="titulo">Sugerencias para vos</h3>
        
  <div class="swiper-related over-hidden relative swiper-container-horizontal">
    <div class="swiper-wrapper">';

        $myarray = WC()->cart->get_cross_sells();
        
        $args = array(
          'post_type' => 'product',
          'post__in'      => $myarray,
        );
        // The Query
        $products = new WP_Query( $args );
        $contada=0;
        while ( $products->have_posts() ) : 
            $contada++;
            $products->the_post(); 
            echo '<div class="swiper-slide data-swiper-autoplay="400">';
            wc_get_template_part( 'content', 'product' ); 
            echo '</div>';    
        endwhile; 
        echo'</div>';
    if($contada>$cols){
    echo '
    <div class="swiper-prev swiper-prodrel-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-prodrel-next"><i class="fa fa-angle-right"></i></div>
    ';}
    echo'
  </div>
</div>
<script>
var ProductSwiper = new Swiper(".swiper-related", {
    slidesPerView: '.$cols.',
    spaceBetween: 10,
    touchRatio: 0 ,
    loop: false,
    preventClicks: false,
    preventClicksPropagation: false,
    autoplay: true,
    navigation: {
        nextEl: ".swiper-prodrel-next",
        prevEl: ".swiper-prodrel-prev",
    },
    breakpoints: {
            900:    {slidesPerView: 2,slidesPerGroup:2},
            1000:   {slidesPerView: 3,slidesPerGroup:3},            
            1200:    {slidesPerView: 4,slidesPerGroup:4}
        }
});
</script>';
	}
}

//Esto actualiza los envios en el checkout, NO TOCAR!!!
add_filter('woocommerce_update_order_review_fragments', 'actualizar_fragmento_envios', 10, 1);
function actualizar_fragmento_envios($order_fragments) {
	ob_start();
	actualizar_fragmento_envios_split();
	$actualizar_fragmento_envios_split = ob_get_clean();
	$order_fragments['.fw-woocommerce-shipping-totals'] = $actualizar_fragmento_envios_split;
	return $order_fragments;
}
function actualizar_fragmento_envios_split( $deprecated = false ) {
	wc_get_template( 'checkout/shipping-order-review.php', array( 'checkout' => WC()->checkout() ) );
}

function my_text_strings( $translated_text, $text, $domain ) {
  switch ( $translated_text ) {
    case '¡GRATIS!' :
      $translated_text = fw_theme_mod('fw_shipping_free_label');
      break;
  }
  return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );

add_filter( 'woocommerce_shipping_instance_form_fields_local_pickup', 'add_extra_fields_in_flat_rate', 10, 1);
add_filter( 'woocommerce_shipping_instance_form_fields_flat_rate', 'add_extra_fields_in_flat_rate', 10, 1);
add_filter( 'woocommerce_shipping_instance_form_fields_free_shipping', 'add_extra_fields_in_flat_rate', 10, 1);
function add_extra_fields_in_flat_rate($settings){
    $counter = 0;
    $arr = array();
    foreach ($settings as $key => $value) {
        if($key=='cost' && $counter==0){
            $arr[$key] = $value; 
            $arr['fw_shipping_desc'] = array(
                'title'         => __( 'Description', 'fastway' ), 
                'type'             => 'text', 
                'placeholder'    => '',
                'description'    => ''
            ); 
            $counter++; 
        }else {
            $arr[$key] = $value;
        } 
    }
    return $arr; 
} 





add_filter( 'woocommerce_checkout_fields' , 'fw_custom_override_checkout_fieldss',10 );
function fw_custom_override_checkout_fieldss( $fields ) {
    $fields['billing']['billing_cuit'] = array(
      'label'     => fw_theme_mod( 'fw_cuit_label'),
      'placeholder'     => fw_theme_mod( 'fw_cuit_label'),
      'required'  => true,
      'class'     => array('form-row-wide'),
      'clear'     => true,
      'priority' => 31
    );
    
    if(fw_theme_mod('fw_sell_dni')){
      $fields['billing']['billing_dni'] = array(
        'label'     => fw_theme_mod( 'fw_cuit_label'),
        'placeholder' => fw_theme_mod( 'fw_cuit_label'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'clear'     => true
      );
    }
    $fields['order']['order_comments']['class'][]='w100';
    $fields['order']['order_comments']['placeholder']=fw_theme_mod('fw_order_notes_placeholder');

    if($fields['billing']['billing_first_name'])$fields['billing']['billing_first_name']['placeholder'] = $fields['billing']['billing_first_name']['label'];
    if($fields['billing']['billing_last_name'])$fields['billing']['billing_last_name']['placeholder'] =$fields['billing']['billing_last_name']['label'];
    if($fields['billing']['billing_company'])$fields['billing']['billing_company']['placeholder'] = $fields['billing']['billing_company']['label'] ;
    if($fields['billing']['billing_phone'])$fields['billing']['billing_phone']['placeholder'] = $fields['billing']['billing_phone']['label'];
    if($fields['billing']['billing_city'])$fields['billing']['billing_city']['placeholder'] = $fields['billing']['billing_city']['label'];
    if($fields['billing']['billing_postcode'])$fields['billing']['billing_postcode']['placeholder'] = $fields['billing']['billing_postcode']['label'];
    if($fields['billing']['billing_country'])$fields['billing']['billing_country']['placeholder'] = $fields['billing']['billing_country']['label'];
      
    //Shipping

    if($fields['shipping']['shipping_first_name'])$fields['shipping']['shipping_first_name']['placeholder'] = $fields['shipping']['shipping_first_name']['label'];
    if($fields['shipping']['shipping_last_name'])$fields['shipping']['shipping_last_name']['placeholder'] =$fields['shipping']['shipping_last_name']['label'];
    if($fields['shipping']['shipping_city'])$fields['shipping']['shipping_city']['placeholder'] = $fields['shipping']['shipping_city']['label'];
    if($fields['shipping']['shipping_postcode'])$fields['shipping']['shipping_postcode']['placeholder'] = $fields['shipping']['shipping_postcode']['label'];
    if($fields['billing']['billing_address_2'])$fields['billing']['billing_address_2']['placeholder'] = fw_theme_mod('fw_shipping_address_2_label');

    unset($fields['shipping']['shipping_company']);
    $fields['shipping']['shipping_postcode']['priority']=10;
    $fields['shipping']['shipping_country']['priority']=79;
    $fields['shipping']['shipping_state']['priority']=80;


    if(get_locale()=='es_ES')$fields['billing']['billing_country']['class'][]='hide';

    if(!fw_theme_mod('fw_checkout_field_address_2')){
      unset($fields['billing']['billing_address_2']);
      unset($fields['shipping']['shipping_address_2']);
    }
    
    if(!fw_theme_mod('fw_sell_to_business')){
      unset($fields['billing']['billing_company']);
      unset($fields['billing']['billing_cuit']);
    }

    if(fw_theme_mod('fw_gift_fields')){
      $fields['shipping']['shipping_phone'] = array(
          'placeholder'   => __('Phone number', 'fastway'),
          'clear'     => true,
          'priority' => 100
      );
      unset($fields['shipping']['shipping_last_name']);
      $fields['shipping']['shipping_date'] = array(
          'placeholder'   => __('Shipping Date', 'fastway'),
          'clear'     => true,
          'priority' => 100
      );
      $fields['shipping']['shipping_mensaje'] = array(
          'placeholder'   => fw_theme_mod('fw_order_gift_note_placeholder'),
          'class'     => array('form-row-wide w100'),
          'clear'     => true,
          'priority' => 100
      );
    }
    return $fields;
}
add_filter('woocommerce_default_address_fields', 'fw_wc_override_address_fields',11);
function fw_wc_override_address_fields( $fields ) {
  $fields['address_2']['placeholder'] = fw_theme_mod('fw_shipping_address_2_label');

	return $fields;
}

add_filter( 'default_checkout_country', 'change_default_checkout_country' ,30);
function change_default_checkout_country() {
  $ja=explode(':',get_option('woocommerce_default_country'))[0];
  return $ja;
}

add_action( 'admin_notices', 'sample_admin_notice__error' );
function sample_admin_notice__error() {
  $class = 'error admin';
  $message1 = "ATENCÍON: MULTITIENDA";
  $message2="Esta tienda tiene varios roles asi que cuidado al crear cambios, siempre considerar estos roles. En general lo que piden es para minoristas, pero asegurarse.";
  $message3="Esta tienda tiene activado el plugin Prices by User Role y tiene algunas incompatiblidades como:
  Dynamic Discounts product pricing no funciona,o nuestro descuento general, osea solo se pueden hacer descuentos generales al total del carrito, no por items separados, o poniendo la oferta en la lista con excel o manualmente";
  if(fw_theme_mod('fw_is_multitienda'))printf( '<div class="%1$s"><p>%2$s</p><p>%3$s</p><p>%4$s</p></div>', esc_attr( $class ), esc_html( $message1),esc_html( $message2 ),esc_html( $message3 ) ); 

  
  $class = 'usuarios notice ocultar';
  $message1 = "INFO: CREACIÓN DE USUARIOS";
  $message2="Si esta activo el checkbox de no enviar el correo electronico, entonces creamos la cuenta , y luego vamos a usuarios si queremos editar la contraseña.";
  $message3="Si por el otro lado, tildamos el checkbox, entonces se le manda al mail un correo de activación con un link para que genere su password.";
  printf( '<div class="%1$s"><p>%2$s</p><p>%3$s</p><p>%4$s</p></div>', esc_attr( $class ), esc_html( $message1),esc_html( $message2 ),esc_html( $message3 ) ); 
}



if(fw_theme_mod('fw_id_filesync')==1)set_theme_mod('fw_id_filesync','');

