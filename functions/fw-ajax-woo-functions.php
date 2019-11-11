<?php

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

add_shortcode('fw_cart_ajax', 'fw_cart_ajax');
function fw_cart_ajax() {
    global $product;
    if(fw_check_hide_purchases())return;
    echo '<button onclick="addtocart('. $product->id.')" class="fw_add_to_cart_button ">
    <i class="fad fa-cart-plus "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'. esc_html( $product->add_to_cart_text() ).'</span>
    </button>';
}

add_action('wp_ajax_nopriv_cart_remove_item', 'cart_remove_item');
add_action('wp_ajax_cart_remove_item', 'cart_remove_item');
function cart_remove_item(){
  $key=$_GET['cart_item_key'];
  WC()->cart->get_subtotal( )( $key );
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
  WC()->cart->add_to_cart( $id );
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
      error_log(print_r($cart_item,true));
      $arr = array('nombre' => $nombre, 'price'=> $_product->get_price(), 'quantity' => $cart_item['quantity'], 'url' => $image_url, 'cart_item_key' => $cart_item_key, 'line_subtotal' => $cart_item['line_subtotal']);
      array_push($carta,$arr);
    }

    echo json_encode($carta);
    exit();
}

?>