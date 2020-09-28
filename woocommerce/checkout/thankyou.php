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

foreach ( $order->get_items() as $item_id => $item ) {
	//error
}
?>

<script>

console.log('eventAction:purchase' );
if(window.fbq)fbq('track', 'Purchase', {value: 0.00, currency: 'USD'});
if(window.gtag)gtag('send', {hitType: 'event',eventCategory: 'Ecommerce',eventAction: 'purchase', eventLabel: 'Compra'});
if(window.ga)ga('send', {hitType: 'event',eventCategory: 'Ecommerce',eventAction: 'purchase', eventLabel: 'Compra'});
if(window.dataLayer){
	let datala={
		'event': 'Purchase',
		'ecommerce': {
			'currencyCode': 'ARS',
			'add': {                              
				'products': [{                       
					'name': product.name,
					'id': product.sku,
					'price': product.price,
					'category': product.category,
					'quantity': product.qty
				}]
			}
		}
	}
	console.log(datala)
	dataLayer.push(datala);
}

</script>


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
				<?php echo fw_parse_mail('thankyou',$order);?>
				
				<?php 
				do_action( 'woocommerce_thankyou',$order->get_id());
				do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
				 ?><!--por si hay algo intersante para haer en el futuro....-->

				<a class="seguir" href="<?=fw_theme_mod('fw_seguircomprando_url')?>"><?=fw_theme_mod('fw_label_checkout_thank_4')?></a>
			</section>
			
		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null );?></p>

	<?php endif; ?>

</div>
