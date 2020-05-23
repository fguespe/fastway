<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$value=$gateway->id;

?>

<li class="capsula payment wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>" data-radio="<?=$value?>" data-label="<?=$gateway->title?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>"   />
	<span class="checkmark"></span>
	<span class="title"><?=$gateway->title?></span>
	<small><?=$gateway->description?></small>

	<?php if ( $gateway->has_fields() ) : ?>
		<div class="extras extras_payment" >
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
<script>

jQuery('li.capsula.payment').on('click', function(e) {
	//console.log('c11')
	if (e.target !== this) return;
	let capsula=jQuery(this)
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});

jQuery('li.capsula.payment small').on('click', function(e) {
	//console.log('c12')
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});

jQuery('li.capsula.payment span').on('click', function(e) {
	//console.log('c13')
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});

jQuery('li.capsula.payment .mp_pago').on('click', function(e) {
	//console.log('c14')
	if (e.target !== this) return;
	let capsula=jQuery(this).parent().parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});
jQuery('li.capsula.payment img').on('click', function(e) {
	//console.log('c15')
	if (e.target !== this) return;
	let capsula=jQuery(this).parent().parent().parent()
	capsula.find('input:radio').click()
	seleccionarPago(capsula)
});
jQuery('li.capsula.payment input').on('click', function(e) {
	//console.log('c16')
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	seleccionarPago(capsula)
	
});
function seleccionarPago(capsula){
	

	jQuery('li.capsula.payment').removeClass("active");capsula.addClass('active');


	jQuery('.extras_payment').hide();
	jQuery('.active .extras_payment').show();

	let label=capsula.data('label')
	jQuery('.paso-pagos .box-step .subtitle').text(label)

	//console.log(jQuery("input[name='payment_method']").is(':checked'),paso)
	if(paso==4 && jQuery("input[name='payment_method']").is(':checked')){
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}
}

</script>
