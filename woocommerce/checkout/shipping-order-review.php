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

jQuery('li.capsula.shipping').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this)
	capsula.find('input:radio').click()
	seleccionarEnvio(capsula)
});
jQuery('li.capsula.shipping span').on('click', function(e) {
	if (e.target !== this) return;
	let capsula=jQuery(this).parent()
	capsula.find('input:radio').click()
	seleccionarEnvio(capsula)
});
jQuery('li.capsula.shipping input').on('click', function(e) {
	if (e.target !== this) return;
	seleccionarEnvio(jQuery(this).parent())
});

function seleccionarEnvio(capsula){
//	jQuery('.capsula.shipping .extras').attr('style','display: none');//
//	jQuery('.capsula.shipping.active .extras').attr('style','display: block !important');
	

	envioSeleccionado=capsula.data('costo')
	jQuery('li.capsula.shipping').removeClass("active");capsula.addClass('active');


	//jQuery('li.capsula.shipping.extras').hide();
	jQuery('li.capsula.shipping.active .extras').show();

	
	let label=capsula.data('label')+' '+capsula.data('costo')
	jQuery('.paso-shipping .box-step .subtitle').data('id',capsula.data('value'))
	jQuery('.paso-shipping .box-step .subtitle').text(label)

	console.log(jQuery("input[name='shipping_method[0]']").is(':checked'),paso)
	if(paso==3 && jQuery("input[name='shipping_method[0]']").is(':checked')){
		jQuery('.btn-checkout.continuar.shipping').prop('disabled', false);
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}
}


</script>