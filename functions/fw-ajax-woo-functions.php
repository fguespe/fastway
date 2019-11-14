<?php

/*
add_shortcode('fw_loop_cart', 'fw_loop_cart');
function fw_loop_cart() {
  
    global $product;
    if(fw_check_hide_purchases())return;

    $cant=isset( $quantity ) ? $quantity : 1;
    $clase=$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '';
    $type=$product->get_type() == 'simple' ? 'ajax_add_to_cart' : '';
    echo '<a href="'.$product->add_to_cart_url().'" data-quantity="'.$cant.'" 
    class="%s product_type_%s single_add_to_cart_button btn btn-block '.$type.'">'. esc_html( $product->add_to_cart_text() ).'</a>';
}
add_shortcode('fw_single_cart', 'fw_single_cartt');
function fw_single_cartt(){
    global $product;
    if(fw_check_hide_purchases())return;
    if(empty($product->get_price()))return;
    woocommerce_template_single_add_to_cart();
    do_action( 'woocommerce_before_add_to_cart_button' );
}
*/

if( !function_exists( 'fw_shopping_cart' ) ) {
  add_shortcode('fw_shopping_cart', 'fw_shopping_cart');

  function fw_shopping_cart($style = "link"){
      $style='link';
      if( !is_plugin_active('woocommerce/woocommerce.php') ) return;
      global $woocommerce;
      if(empty($style))$style=fw_theme_mod('cart-style');
      $rand=generateRandomString(5);
      $cant=$woocommerce->cart->cart_contents_count;
      $total=$woocommerce->cart->get_cart_total();
      $carturl=wc_get_cart_url();
      $checkurl=wc_get_checkout_url();
      $istyle=fw_theme_mod("fw_icons_style");
      if($cant>0)$cant='<span class="cant">('.$cant.')</span>';
      else $cant='';
      if($style==="link" || $style==="modal"){
      return '
      <a class="fw-header-icon minicart"  data-toggle="modal" data-target="#modal_carrito" role="button">
      <i class="'.$istyle.' fa-cart-plus"></i>'.$cant.'
      </a>';
      }
  }
}

function fw_product_is_purchasable($product){
  //echo '0';
  //if(get_option('woocommerce_manage_stock')=='yes'){
  if(!$product->is_in_stock()  && !$product->backorders_allowed())return false;
 // }
 // echo '1';
  if(empty($product->get_price()))return false;
  return true;
}


add_shortcode('fw_loop_ajax', 'fw_loop_ajax');
function fw_loop_ajax() {
  global $product;
  if(fw_check_hide_purchases())return;
  if(!fw_product_is_purchasable($product))return;

  if ( $product->is_type( 'variable' ) ) {
    echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="addtocart('. $product->id.')" class="fw_add_to_cart_button loop">
    <i class="fad fa-cart-plus "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>Ver opciones</span>
    </button>';
  }else{
    echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="addtocart('. $product->id.')" class="fw_add_to_cart_button loop ">
    <i class="fad fa-cart-plus "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'. esc_html( $product->add_to_cart_text() ).'</span>
    </button>';
  }

}

add_shortcode('fw_cart_ajax', 'fw_single_cart');//dejar!
add_shortcode('fw_single_cart', 'fw_single_cart');
function fw_single_cart() {
    global $product;
    if(fw_check_hide_purchases())return;

    echo wc_get_stock_html( $product ); // WPCS: XSS ok.
    do_action( 'woocommerce_before_add_to_cart_button' );
    if(!fw_product_is_purchasable($product))return;

    
	  if ( $product->is_type( 'variable' ) ) {
      $available_variations=$product->get_available_variations();
      $attributes=$product->get_variation_attributes();
      $variations_json = wp_json_encode( $available_variations );
      $variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
      echo '<div class="fw_variations" cellspacing="0" data-product_variations="'.$variations_attr.'">';
      foreach ( $attributes as $name=>$options) {
        echo '<span style="display:block;" class="atrtitle">'.$name.'</span>';
        echo  fw_dropdown_variation_attribute_options( array('attribute' => $name,'product'   => $product) );
      }
      echo '</div>';
    }
	

    echo '<button id="fw_add_to_cart_button_'.$product->id.'"  onclick="addtocart('. $product->id.')" class="fw_add_to_cart_button" data-product_id="'.$product->id.'">
    <i class="fad fa-cart-plus "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'. esc_html( $product->add_to_cart_text() ).'</span>
    </button>';

    do_action( 'woocommerce_after_add_to_cart_button' );
}

add_action('wp_ajax_nopriv_cart_remove_item', 'cart_remove_item');
add_action('wp_ajax_cart_remove_item', 'cart_remove_item');
function cart_remove_item(){
  $key=$_GET['cart_item_key'];
  WC()->cart->remove_cart_item($key );
  exit();
}

add_action('wp_ajax_nopriv_cart_get_subtotal', 'cart_get_subtotal');
add_action('wp_ajax_cart_get_subtotal', 'cart_get_subtotal');
function cart_get_subtotal(){
  $result=array("total"=>WC()->cart->total,"subtotal"=>WC()->cart->subtotal);
  echo json_encode($result);
  exit();
}
add_action('wp_ajax_nopriv_add_to_cart', 'fw_add_to_cart');
add_action('wp_ajax_add_to_cart', 'fw_add_to_cart');
function fw_add_to_cart(){
  global $woocommerce;
  $id= $_GET['id'];
  $var_id= $_GET['var_id'];
  WC()->cart->add_to_cart( $id,1, $var_id);
  exit();
}
add_action('wp_ajax_nopriv_sum_cart_qty', 'sum_cart_qty');
add_action('wp_ajax_sum_cart_qty', 'sum_cart_qty');
function sum_cart_qty(){
  global $woocommerce;
  $key= $_GET['cart_item_key'];
  $total= $_GET['total'];

  WC()->cart->set_quantity( $key, $total );
  exit();
}


add_action('wp_ajax_nopriv_fw_get_js_cart', 'fw_get_js_cart');
add_action('wp_ajax_fw_get_js_cart', 'fw_get_js_cart');
function fw_get_js_cart(){  
    $carta=array();
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      $product_id = $cart_item['product_id'];
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'featured-thumb' ); 
      $image_url = $image[0];
      $nombre = $_product->get_name();
      $cant=$cart_item['quantity'];
      $precio=price_array($_product);
      $precio=end($precio);
      $total_line=$precio*$cant;
      $arr = array('nombre' => $nombre, 'precio'=> $precio, 'quantity' => $cart_item['quantity'], 'url' => $image_url, 'cart_item_key' => $cart_item_key, 'line_subtotal' => $total_line);
      array_push($carta,$arr);
    }
    $totals=WC()->cart->get_totals();

    $totales=array('cart' => $carta, 'totals'=> $totals,'conversion'=>floatval(fw_theme_mod('fw_currency_conversion')));
    echo json_encode($totales);
    exit();
}

function price_array($product){
    
    $price = $product->get_price_html();
    $del = array('<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>', '</span>','<del>','<ins>');
    $price = str_replace($del, '', $price);
    $price = str_replace('</del>', '|', $price);
    $price = str_replace('</ins>', '|', $price);
    $price = str_replace('"', '', $price);
    $price = str_replace(',', '', $price);
    $price_arr = explode('|', $price);
    $price_arr = array_filter($price_arr);
    return $price_arr;
}

function fw_dropdown_variation_attribute_options( $args = array() ) { 
  $args = wp_parse_args( apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ), array( 
      'options' => false,  
      'attribute' => false,  
      'product' => false,  
      'selected' => false,  
      'name' => '',  
      'id' => '',  
      'class' => '',  
      'show_option_none' => __( 'Choose an option', 'woocommerce' ),  
) ); 

  $options = $args['options']; 
  $product = $args['product']; 
  $attribute = $args['attribute']; 
  $name = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute ); 
  $id = $args['id'] ? $args['id'] : sanitize_title( $attribute ); 
  $class = $args['class']; 
  $show_option_none = $args['show_option_none'] ? true : false; 
  $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options. 

  if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) { 
      $attributes = $product->get_variation_attributes(); 
      $options = $attributes[ $attribute ]; 
  } 

  $html = '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 
  $html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>'; 

  if ( ! empty( $options ) ) { 
      if ( $product && taxonomy_exists( $attribute ) ) { 
          // Get terms if this is a taxonomy - ordered. We need the names too. 
          $terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) ); 

          foreach ( $terms as $term ) { 
              if ( in_array( $term->slug, $options ) ) { 
                  $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</option>'; 
              } 
          } 
      } else { 
          foreach ( $options as $option ) { 
              // This handles < 2.4.0 bw compatibility where text attributes were not sanitized. 
              $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false ); 
              $html .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>'; 
          } 
      } 
  } 

  $html .= '</select>'; 
  return $html;
  //echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); 
} 
?>