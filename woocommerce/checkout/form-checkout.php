<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

wc_print_notices();

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
  echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'fastway' ) );
  return;
}

?>
<style>

</style>
<form name="checkout" method="post" class="checkout woocommerce-checkout vcv-checkout processing vcv-processing" action="https://wpbakery.com/checkout/" enctype="multipart/form-data" id="payment-form" novalidate="novalidate" style="position: relative;" _lpchecked="1">
   <div class="vcv-woocommerce-notice-group">
      <ul class="vcv-woocommerce-error">
      </ul>
   </div>
   <div class="vcv-checkout-wrapper">
      <div class="vcv-checkout-main" id="customer_details">
         <div class="woocommerce-billing-fields">
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
         </div>
         
      </div>

      <h3 id="">Medios de pago</h3>
      <div id="payment" class="woocommerce-checkout-payment">
        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
      </div>
   </div>
   <div class="vcv-side-summary" style="">
   <div class="inner-wrapper-sticky" style="position: relative; transform: translate3d(0px, 0px, 0px);">
   <div class="vcv-summary-box">
      <h3 id="">Detalle</h3>
      <a href="/cart" style="font-size:12px;">Volver al carrito</a>
      <div class="vcv-promo" style="display:none!important;">
         <button id="show-promo-form">
            Got promo code?
            <span class="vcv-arrow">
              <i class="fa fa-arrow-down" id="coupon" onclick="abrir()"></i>
            </span>
         </button>
         <script>
           function abrir(){
            jQuery('.vcv-promo-content').toggle();
           }
        </script>
         <div class="vcv-promo-content" style="display:none;">

          <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'fastway' ); ?>" id="coupon_code" value="" />
          </p>

          <p class="form-row form-row-last">
            <input type="submit" class="btn " name="apply_coupon" value="<?php _e( 'Aplicar Código', 'fastway' ); ?>" />
          </p>

            <div class="clear"></div>
            </form>
         </div>
      </div>
      <div id="order_review" class="woocommerce-checkout-review-order">
         <table class="shop_table woocommerce-checkout-review-order-table">

               <tr class="cart-subtotal">
                  <th>Subtotal</th>
                  <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>45.00</span></td>
               </tr>
               <tr class="order-total">
                  <th>Total</th>
                  <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>45.00</span></strong> </td>
               </tr>
               <tr class="recurring-footer-text">
                  <th colspan="2"><i>One year of premium class support and free updates.</i></th>
               </tr>
         </table>
      </div>
      <div class="vcv-block-overlay"></div>
   </div>
   <p class="description">
      El mejor precio garantizado 
   </p>
</form>



