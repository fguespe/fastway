<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'fastway' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout fw_checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<div class="mostrar" style="display:none;text-align:center;width:100%;">
  <i class="fal fa-sync fa-spin" style="color:var(--main);width:100%;font-size:80px !important;margin-bottom:50px;"></i>
  <span>Estamos procesando su pedido...aguarde unos segundos.</span>
</div>
<style>

form.processing div:not(.mostrar){
display:none;
}

form.processing .mostrar{
display:block !important;

}
</style>
		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
    <div class="col-lg-7 col-sm-12">
      <div class="fw_checkout-main" id="customer_details">
         <div class="woocommerce-billing-fields">
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
         </div>
      </div>
   </div>
  <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
   <div class="col-lg-5  col-sm-12" >
    <div class="inner-wrapper-sticky" style="position: relative; transform: translate3d(0px, 0px, 0px);">
    <div class="fw_summary-box" style="background:white;">

    <h3 id=""><?php echo __('Order details','woocommerce')?></h3>
        <a href="<?=wc_get_cart_url()?>" style="font-size:12px;"><?php echo __('Return to cart','woocommerce')?></a>
        </form>
        <?php if ( 'yes' === get_option( 'woocommerce_enable_coupons' ) ) { ?>
        <div class="fw_promo" >
          <div id="show-promo-form" >
              <?php echo esc_html__( 'Have a coupon?', 'woocommerce' )  ?>
              <a class="fw_arrow showcoupon">
                <i class="fa fa-arrow-down" id="coupon" ></i>
              </a>
          </div>
        </div>
        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
          <p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>
          <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" style="width:70%;display:inline;"/>
            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"  style="width:30%;"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
          </p>
          <div class="clear"></div>
        </form>
        <?php } ?>
      
        <?php woocommerce_order_review() ?>
        <div class="fw_block-overlay"></div>
    </div>
    <h3 id="" class="mt20" style="margin-top:30px;"><?php echo 'Seleccione una forma de pago'//__('Payment method','woocommerce')?></h3>
    
    <?php woocommerce_checkout_payment() ?>
    <p class="description">
        <!-- El mejor precio garantizado -->
    </p>
</form>


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>



