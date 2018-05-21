<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if( !function_exists( 'fw_shoppingCart' ) ) {
    function fw_shoppingCart_short() {
        fw_shoppingCart();
    }


    add_shortcode('fw_shopping_cart', 'fw_shoppingCart_short');

    function fw_shoppingCart(){
        if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
        global $woocommerce,$redux_demo;
        $style=$redux_demo['cart-style'];
        $rand=generateRandomString(10);
        $cant=absint($woocommerce->cart->cart_contents_count);
        if($style==="popup"){?>
        <li class="list-inline-item position-relative">
              <a id="<?=$rand?>shoppingCartDropdownInvoker" class="btn btn-xs u-btn--icon u-btn-text-secondary" href="javascript:;" role="button"
                      aria-controls="<?=$rand?>shoppingCartDropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      data-unfold-event="hover"
                      data-unfold-target="#<?=$rand?>shoppingCartDropdown"
                      data-unfold-type="css-animation"
                      data-unfold-duration="00"
                      data-unfold-delay="00"
                      data-unfold-hide-on-scroll="true"
                      data-unfold-animation-in="fadeIn"
                      data-unfold-animation-out="fadeOut">
                <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
                <span class="u-badge u-badge-primary u-badge-pos rounded-circle"><?=$cant?></span>
              </a>
              <div id="<?=$rand?>shoppingCartDropdown" class="u-unfold u-unfold right-0 p-0 mt-2" aria-labelledby="shoppingCartDropdownInvoker" style="width: 350px;"><!--right:-171px;-->
                <?php if(absint($woocommerce->cart->cart_contents_count)>0) get_mini_cart();
                else get_empty_cart();?>
                </div>
            </li>
        <?php }else if($style==="modal"){?>
            <li class="list-inline-item position-relative">
              <a class="btn btn-xs u-btn--icon u-btn-text-secondary" href="#<?=$rand?>shoppingCartModal" role="button"
                 data-modal-target="#<?=$rand?>shoppingCartModal"
                 data-overlay-color="#111722">
                <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
                <span class="u-badge u-badge-primary u-badge-pos rounded-circle"><?=$cant?></span>
              </a>
            </li>

      

          <div id="<?=$rand?>shoppingCartModal" class="js-shopping-cart-window u-modal-window u-modal-window--shopping-cart">
            <?php if(absint($woocommerce->cart->cart_contents_count)>0) get_mini_cart();
            else get_empty_cart();?>
          </div>
              
          <?php
          
      }else if($style==="sidebar"){?>
            <!-- Shopping Cart Sidebar Toggle Button -->
            <li class="list-inline-item position-relative">
              <a id="<?=$rand?>sidebarNavToggler" class="btn btn-xs u-btn--icon u-btn-text-secondary ml-1" href="javascript:;" role="button"
                 aria-controls="<?=$rand?>sidebarContent"
                 aria-haspopup="true"
                 aria-expanded="false"
                 data-unfold-event="click"
                 data-unfold-hide-on-scroll="false"
                 data-unfold-target="#<?=$rand?>sidebarContent"
                 data-unfold-type="css-animation"
                 data-unfold-animation-in="fadeInRight"
                 data-unfold-animation-out="fadeOutRight"
                 data-unfold-duration="500">
                <span class="fa fa-shopping-cart u-btn--icon__inner"></span>
                <span class="u-badge u-badge-primary u-badge-pos rounded-circle"><?=$cant?></span>
              </a>
            </li>

            
      <aside id="<?=$rand?>sidebarContent" class="u-sidebar u-unfold--css-animation u-unfold--hidden" aria-labelledby="sidebarNavToggler">
        <?php if(absint($woocommerce->cart->cart_contents_count)>0){?>
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
              <span class="d-block"><?php echo $woocommerce->cart->get_cart_total();?></span>
            </div>
            <a class="btn btn-sm u-btn-primary--air transition-3d-hover" href="/checkout">Completar la compra</a>
          </div>

          <?}else{
          get_empty_cart();

          }?>
      </aside>
      <?php
          
      }
    }
}
function get_empty_cart(){?>
  <div class="text-center" aria-labelledby="shoppingCartDropdownInvoker" style="width: '100%';padding: 50px;"><!--right:-171px;-->         
    <span class="u-shopping-cart-icon mb-4">
      <span class="fa fa-shopping-basket u-shopping-cart-icon__inner"></span>
    </span>
    <span class="d-block">Tu carrito esta vacio</span>
    </div>
  <?}
  function get_mini_cart(){
  if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
  global $woocommerce;
        
  ?>
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
  <?
}

?>