<?php

if( !function_exists( 'fw_shoppingCart' ) ) {
    
    add_shortcode('fw_shopping_cart', 'fw_shoppingCart');

    function fw_shoppingCart(){
        if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
        global $woocommerce,$redux_demo;
        $style=$redux_demo['cart-style'];
        $rand=generateRandomString(10);
        $cant=absint($woocommerce->cart->cart_contents_count);
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
        $variable=absint($woocommerce->cart->cart_contents_count)>0?get_mini_cart(): get_empty_cart();
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
              <div id="$idname2" class="u-unfold u-unfold right-0 p-0 mt-2" aria-labelledby="shoppingCartDropdownInvoker" style="width: 350px;">$variable</div>
        </li>
HTML;
        }else if($style==="modal"){
         $idname2=$rand.'shoppingCartModal';
          $variable=absint($woocommerce->cart->cart_contents_count)>0?get_mini_cart(): get_empty_cart();
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
              $variable
            </div>
HTML;
        }else if($style==="sidebar"){
        $idname2=$rand.'sidebarNavToggler';
        $idname=$rand.'sidebarContent';
        $cant=$woocommerce->cart->cart_contents_count;
        $total=$woocommerce->cart->get_cart_total();
        $contenido=absint($cant>0)?get_full_cart_sidebar($total):get_empty_cart();
  
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
      <aside id="$idname" class="u-sidebar u-unfold--css-animation u-unfold--hidden" aria-labelledby="sidebarNavToggler">
        $contenido
      </aside>
HTML;
        }
    }
    function get_empty_cart(){
  return <<<HTML
  <div class="text-center" aria-labelledby="shoppingCartDropdownInvoker" style="width: '100%';padding: 50px;"><!--right:-171px;-->         
    <span class="u-shopping-cart-icon mb-4">
      <span class="fa fa-shopping-basket u-shopping-cart-icon__inner"></span>
    </span>
    <span class="d-block">Tu carrito esta vacio</span>
    </div>
HTML;
    }

    function get_mini_cart(){
  global $woocommerce;
  $count=$woocommerce->cart->get_cart_total();
  $checkouturl=wc_get_checkout_url();
  return <<<HTML
   <div class="u-shopping-cart-title-wrapper">
    <strong>Tus productos</strong>
  </div>

  <div class="u-shopping-cart-items-wrapper">
    <!-- Item -->
    <div class="d-flex">
      <div class="widget_shopping_cart_content"></div>
    </div>
    <!-- End Item -->
  </div>

  <!-- Subtotal 
  <div class="u-shopping-cart-subtotal-bg">
    <div class="mb-3">
      <strong>Total</strong>
      <span class="d-block">$count</span>
    </div>
    <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="$checkouturl">Completar la compra</a>
  </div>-->
HTML;
    }

function get_full_cart_sidebar($total){
return <<<HTML
   <div class="u-sidebar__scroller">
      <div class="u-sidebar__container">
        <div class="u-sidebar--cart__footer-offset">
          <!-- Toggle Button -->
          <div class="d-flex py-7" style="padding: 20px !important;">
            <h3 class="h6">Tu carrito</h3>

            <button type="button" class="close ml-auto"
                    aria-controls="sidebarContent"
                    aria-haspopup="true"
                    aria-expanded="false"
                    data-unfold-event="click"
                    data-unfold-hide-on-scroll="false"
                    data-unfold-target="#sidebarContent"
                    data-unfold-type="css-animation"
                    data-unfold-animation-in="fadeInRight"
                    data-unfold-animation-out="fadeOutRight"
                    data-unfold-duration="500">
              <span aria-hidden="true">&times;</span>
              <style type="text/css">
                .close span{
                      float: right !important;
                      font-size: 1.25rem !important;
                      font-weight: 700 !important;i
                      line-height: 1 !important;
                      color: #1e2022 !important;
                      text-shadow: 0 1px 0 #fff !important;
                      
                }
              </style>
            </button>
          </div>
          <!-- End Toggle Button -->

          <div class="js-scrollbar u-sidebar__body">
            <div class="u-sidebar__content">
              <div class="u-sidebar__content--cart">
                <!-- Shopping Cart Item -->
                
                <!-- End Shopping Cart Item -->

                <!-- Shopping Cart Item -->
              <div class="d-flex">
                <div class="widget_shopping_cart_content"></div>
              </div>

                <!-- End Shopping Cart Item -->
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
        <strong>Total</strong>
        <span class="d-block">$total</span>
      </div>
      <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="/checkout">Completar la compra</a>
    </div>
HTML;
}


}
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {
    
    $fragments['.header-cart-count'] = '<span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">' . WC()->cart->get_cart_contents_count() . '</span>';
    
    
    return $fragments;
    
}
add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

    ob_start();
    ?>

    <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>

    <?php $fragments['div.widget_shopping_cart_content'] = ob_get_clean();

    return $fragments;

} );



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