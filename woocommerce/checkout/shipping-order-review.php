<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="fw-woocommerce-shipping-totals">
	<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
	<?php wc_cart_totals_shipping_html(); ?>
	<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
</div>

<script>

jQuery('.shipping_volver').on('click', function(e) {
    jQuery('.shipping_volver').hide()
    jQuery('.woocommerce-shipping-methods li.group').show()
    jQuery('.woocommerce-shipping-methods li.local_pickup').hide()
    jQuery('.woocommerce-shipping-methods li:not(.local_pickup)').show()
});

jQuery(document).ready(function(e) {
	let shippingGroups='<?=fw_theme_mod('fw_shipping_groups');?>';
	if(shippingGroups){
		jQuery('.woocommerce-shipping-methods li.local_pickup').hide()
	    if(!jQuery('.capsula.shipping.group').length)jQuery('.woocommerce-shipping-methods').prepend('<li class="capsula shipping group"><input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup2" value="local_pickup:2" class="shipping_method"><label for="shipping_method_0_local_pickup2" class="title">Retirar en nuestras sucursales</label><small class="costo">Ver opciones</small></li>');
	}
});
jQuery(document).on('click', function(e) {
	var target = jQuery( event.target );
	if(!target.is( "li" ))target=target.parent()
	if(!target.is( "li" ))return;
	
	if(target.is( "li" ) && target.hasClass( "shipping" ) && target.hasClass( "group" )){
		jQuery('.woocommerce-shipping-methods li.group').hide()
		jQuery('.woocommerce-shipping-methods li.local_pickup').show()
		jQuery('.shipping_volver').show()
		jQuery('.woocommerce-shipping-methods li:not(.local_pickup)').hide()
		e.preventDefault()
	}else if(target.is( "li" ) && target.hasClass( "shipping" )){
		console.log('entra')
		target.find('input:radio').prop("checked", true);
		seleccionarEnvio(target)
	}else if(target.is( "li" ) && target.hasClass( "payment" )){
		console.log('entra')
		target.find('input:radio').prop("checked", true);
		seleccionarPago(target)
	}
});

function seleccionarPago(capsula){
	

	jQuery('li.capsula.payment').removeClass("active");
	capsula.addClass('active');


	jQuery('.extras_payment').hide();
	jQuery('.active .extras_payment').show();

	let label=capsula.data('label')
	jQuery('.paso-pagos .box-step .subtitle').text(label)

	//console.log(jQuery("input[name='payment_method']").is(':checked'),paso)
	if(paso==4 && jQuery("input[name='payment_method']").is(':checked')){
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}
}

function seleccionarEnvio(capsula){

	envioSeleccionado=capsula.data('costo')
	jQuery('li.capsula.shipping').removeClass("active");capsula.addClass('active');


	jQuery('.extras_shipping').hide();
	jQuery('.active .extras_shipping').show();

	
	let label=capsula.data('label')+' '+(capsula.data('costo')>0?'$'+capsula.data('costo'):'')

	jQuery('.paso-shipping .box-step .subtitle').data('id',capsula.data('value'))
	jQuery('.paso-shipping .box-step .subtitle').text(label)

	if(paso==3 && jQuery("input[name='shipping_method[0]']").is(':checked')){
		jQuery('.btn-checkout.continuar.shipping').prop('disabled', false);
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}
}


</script>
<style>
.group span{
	display:none !important;
} 
.fw_checkout .box-detail .capsula.shipping.group{
	padding-left:20px !important;
}
</style>