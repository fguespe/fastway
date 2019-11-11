<?php

add_shortcode('fw_loop_cart', 'fw_loop_cart_ajax');
function fw_loop_cart_ajax() {
    global $product;
    if(fw_check_hide_purchases())return;

    $cant=isset( $quantity ) ? $quantity : 1;
    $clase=$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '';
    $type=$product->get_type() == 'simple' ? 'ajax_add_to_cart' : '';

    
    echo '<a href="'.$product->add_to_cart_url().'" data-quantity="'.$cant.'" class="'.$type.' product_type_'.$type.' single_add_to_cart_button btn btn-block '.$type.'">'. esc_html( $product->add_to_cart_text() ).'</a>';
}



add_action('wp_ajax_nopriv_cart_remove_item', 'cart_remove_item');
add_action('wp_ajax_cart_remove_item', 'cart_remove_item');
function cart_remove_item(){
  $key= $_GET['cart_item_key'];
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

add_action('wp_ajax_nopriv_sum_cart_qty', 'sum_cart_qty');
add_action('wp_ajax_sum_cart_qty', 'sum_cart_qty');
function sum_cart_qty(){
  global $woocommerce;
  $key= $_GET['cart_item_key'];
  $sum= $_GET['sum'];
  WC()->cart->set_quantity( $key, $sum );
  exit();
}

add_action('wp_ajax_nopriv_get_cart', 'get_cart');
add_action('wp_ajax_get_cart', 'get_cart');
function get_cart(){
  WC()->cart->get_cart();
  exit();
}

?>