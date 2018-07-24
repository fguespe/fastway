<?php

if( !function_exists( 'fw_shoppingCart' ) ) {
    
    add_shortcode('fw_shopping_cart', 'fw_shoppingCart');

    function fw_shoppingCart($style=""){
        if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
        global $woocommerce,$redux_demo;
        if(empty($style))$style=$redux_demo['cart-style'];
        $rand=generateRandomString(5);
        $cant=$woocommerce->cart->cart_contents_count;
        $total=$woocommerce->cart->get_cart_total();
        if($style==="link"){
          $carurl=wc_get_cart_url();

          return <<<HTML
<li class="list-inline-item position-relative">
  <a id="" class="btn btn-xs u-btn--icon u-btn-text-secondary" href="$carurl" role="button">
    <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
    <span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">$cant</span>
  </a>
</li>
HTML;
        }else if($style==="popup"){
        $idname=$rand."shoppingCartDropdownInvoker";
        $idname2=$rand.'shoppingCartDropdown';
        return <<<HTML
<li class="list-inline-item position-relative">
   <a id="$idname" class="btn btn-xs u-btn--icon u-btn-text-secondary" href="javascript:;" role="button"
      aria-controls="$idname2"
      aria-haspopup="true"
      aria-expanded="false"
      data-unfold-event="hover"
      data-unfold-target="#$idname2"
      data-unfold-type="css-animation"
      data-unfold-duration="00"
      data-unfold-delay="00"
      data-unfold-hide-on-scroll="true"
      data-unfold-animation-in="fadeIn"
      data-unfold-animation-out="fadeOut">
   <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
   <span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">$cant</span>
   </a>
   <div id="$idname2" class="u-unfold u-unfold right-0 p-0 mt-2" aria-labelledby="shoppingCartDropdownInvoker" style="width: 350px;">
      <div class="u-shopping-cart-title-wrapper">
         <strong>Your Shopping Cart</strong>
      </div>
      <div class="widget_shopping_cart_content"></div>
      <div class="u-shopping-cart-subtotal-bg">
         <div class="mb-3">
            <strong>Order Total</strong>
            <span class="d-block total-mini-cart">$total</span>
         </div>
         <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="../shop/shop-checkout.html">Review Bag and Checkout</a>
         <p class="mb-0"><a class="u-shopping-cart-subtotal-link" href="javascript:;">Continue Shopping</a></p>
      </div>
   </div>
</li>
HTML;
        }else if($style==="modal"){
          $idname2=$rand.'shoppingCartModal';
        
          return <<<HTML
<li class="list-inline-item position-relative">
   <a class="btn btn-xs u-btn--icon u-btn-text-secondary" href="#$idname2" role="button"
      data-modal-target="#$idname2"
      data-overlay-color="#111722">
   <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
   <span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">$cant</span>
   </a>
</li>
<div id="$idname2" class="js-shopping-cart-window u-modal-window u-modal-window--shopping-cart">
   <div class="u-shopping-cart-title-wrapper">
      <strong>Your Shopping Cart</strong>
   </div>
   <div class="widget_shopping_cart_content"></div>
   <div class="u-shopping-cart-subtotal-bg">
      <div class="mb-3">
         <strong>Order Total</strong>
         <span class="d-block total-mini-cart">$total</span>
      </div>
      <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="../shop/shop-checkout.html">Review Bag and Checkout</a>
      <p class="mb-0"><a class="u-shopping-cart-subtotal-link" href="javascript:;" role="button" onclick="Custombox.modal.close();">Continue Shopping</a></p>
   </div>
</div>
HTML;
        }else if($style==="sidebar"){
        $idname2=$rand.'sidebarNavToggler';
        $idname=$rand.'sidebarContent';
  
       return <<<HTML
<li class="list-inline-item position-relative">
   <a id="$idname2" class="btn btn-xs u-btn--icon u-btn-text-secondary ml-1" href="javascript:;" role="button"
      aria-controls=""
      aria-haspopup="true"
      aria-expanded="false"
      data-unfold-event="click"
      data-unfold-hide-on-scroll="false"
      data-unfold-target="#$idname"
      data-unfold-type="css-animation"
      data-unfold-animation-in="fadeInRight"
      data-unfold-animation-out="fadeOutRight"
      data-unfold-duration="500">
   <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
   <span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">$cant</span>
   </a>
</li>
<!-- Account Sidebar Navigation -->
<aside id="$idname" class="u-sidebar u-unfold--css-animation u-unfold--hidden" aria-labelledby="$idname2">
   <div class="u-sidebar__scroller">
      <div class="u-sidebar__container">
         <div class="u-sidebar--cart__footer-offset">
            <!-- Toggle Button -->
            <div class="d-flex align-items-center pt-4 px-7">
               <h3 class="h6 mb-0">Your Shopping Cart</h3>
               <button type="button" class="close ml-auto"
                  aria-controls="$idname"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-unfold-event="click"
                  data-unfold-hide-on-scroll="false"
                  data-unfold-target="#$idname"
                  data-unfold-type="css-animation"
                  data-unfold-animation-in="fadeInRight"
                  data-unfold-animation-out="fadeOutRight"
                  data-unfold-duration="500">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <!-- End Toggle Button -->
            <div class="js-scrollbar u-sidebar__body">
               <div class="u-sidebar__content">
                  <div class="u-sidebar__content--cart">
                     <div class="widget_shopping_cart_content"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Content -->
   <!-- Footer -->
   <div class="u-sidebar__footer u-shopping-cart-subtotal-bg u-sidebar__footer--cart">
      <div class="mb-3">
         <strong>Order Total</strong>
         <span class="d-block total-mini-cart">$total</span>
      </div>
      <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="../shop/shop-checkout.html">Review Bag and Checkout</a>
      <p class="mb-0">
         <a class="u-shopping-cart-subtotal-link" href="javascript:;" role="button"
            aria-controls="$idname"
            aria-haspopup="true"
            aria-expanded="false"
            data-unfold-event="click"
            data-unfold-hide-on-scroll="false"
            data-unfold-target="#$idname"
            data-unfold-type="css-animation"
            data-unfold-animation-in="fadeInRight"
            data-unfold-animation-out="fadeOutRight"
            data-unfold-duration="500">
         Start Shopping
         </a>
      </p>
   </div>
   <!-- End Footer -->
</aside>
HTML;
        }
    }


  


}
//actualiza counter
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {
    
    $fragments['.header-cart-count'] = '<span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">' . WC()->cart->get_cart_contents_count() . '</span>';
    
    $fragments['.total-mini-cart'] = '<span class="d-block total-mini-cart">' . WC()->cart->get_cart_total() . '</span>';
    
    
     ob_start();
    ?>

    <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>

    <?php $fragments['div.widget_shopping_cart_content'] = ob_get_clean();

    return $fragments;
    
}




// Remove product in the cart using ajax
function warp_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );
?>