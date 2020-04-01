<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$value=$gateway->id;
?>

<li class="capsula payment" data-radio="<?=$value?>" data-label="<?=$gateway->title?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>"   />
	<span class="checkmark"></span>
	<span class="title"><?=$gateway->title?></span>
	<small><?=$gateway->description?></small>
</li>

<script>

jQuery('li.capsula.payment').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this)
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});

jQuery('li.capsula.payment small').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});

jQuery('li.capsula.payment span').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});

jQuery('li.capsula.payment .mp_pago').on('click', function(e) {
	if (e.target !== this) return;
	console.log('click1')
	let capsula=jQuery(this).parent().parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});
jQuery('li.capsula.payment img').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this).parent().parent().parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});
jQuery('li.capsula.payment input').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	seleccionarPago(capsula)
	
});
function seleccionarPago(capsula){

	jQuery('li.capsula.payment').removeClass("active");capsula.addClass('active');
	let label=capsula.data('label')
	jQuery('.paso-pagos .box-step .subtitle').text(label)

	console.log(jQuery("input[name='payment_method']").is(':checked'),paso)
	if(paso==4 && jQuery("input[name='payment_method']").is(':checked')){
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}
}

</script>
