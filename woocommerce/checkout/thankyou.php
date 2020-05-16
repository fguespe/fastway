<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<section class="container pagoexitoso" style="width:100%;">
				<i class="fad fa-check-circle"></i>
				<h2><?=fw_theme_mod('fw_label_checkout_thank_0')?></h2>
				<p><?=fw_theme_mod('fw_label_checkout_thank_1')?> #<?=$order->get_order_number()?></p>
				<span><?=fw_theme_mod('fw_label_checkout_thank_2')?> <b><?=$order->get_billing_email()?></b> <?=fw_theme_mod('fw_label_checkout_thank_3')?></span>

				<p class="mt20"><?=fw_theme_mod('checkout-msg')?></p>
				<?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?><!--por si hay algo intersante para haer en el futuro....-->

				<a class="seguir" href="/"><?=fw_theme_mod('fw_label_checkout_thank_4')?></a>
			</section>
			
		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null );?></p>

	<?php endif; ?>

</div>

<style>


.woocommerce-order{
	text-align:center !important;
}
.woocommerce-order i{
	font-size:50px;
	color:green;
}

.woocommerce-order .woocommerce-checkout h3{
	text-align:center !important;
	display:block !important;
}
.pagoexitoso a{
	font-size:14px !important;
	display:block !important;
	color: #5BB956 !important;
	margin-top:20px;
	text-decoration:underline;
}
</style>