<?php


if( !function_exists( 'fw_shoppingCartPopup' ) ) {
    function fw_shoppingCartPopup_short() {
        fw_shoppingCartPopup();
    }


    add_shortcode('fw_shopping_cart', 'fw_shoppingCartPopup_short');

    function fw_shoppingCartPopup(){
        if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
        global $woocommerce;
        ?>
        <li class="list-inline-item position-relative">
              <a id="shoppingCartDropdownInvoker" class="btn btn-xs u-btn--icon u-btn-text-secondary" href="javascript:;" role="button"
                      aria-controls="shoppingCartDropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      data-unfold-event="hover"
                      data-unfold-target="#shoppingCartDropdown"
                      data-unfold-type="css-animation"
                      data-unfold-duration="300"
                      data-unfold-delay="300"
                      data-unfold-hide-on-scroll="true"
                      data-unfold-animation-in="fadeIn"
                      data-unfold-animation-out="fadeOut">
                <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
                <span class="u-badge u-badge-primary u-badge-pos rounded-circle"><?php echo absint($woocommerce->cart->cart_contents_count);?></span>
              </a>

              <div id="shoppingCartDropdown" class="u-unfold u-unfold right-0 p-0 mt-2" aria-labelledby="shoppingCartDropdownInvoker" style="width: 350px;"><!--right:-171px;-->
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

                <!-- Subtotal -->
                <div class="u-shopping-cart-subtotal-bg">
                  <div class="mb-3">
                    <strong>Total</strong>
                    <span class="d-block"><?php echo $woocommerce->cart->get_cart_total();?></span>
                  </div>
                  <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="/checkout">Completar la compra</a>
                </div>
                <!-- End Subtotal -->
              </div>
            </li>
        <?php
    }

}


?>