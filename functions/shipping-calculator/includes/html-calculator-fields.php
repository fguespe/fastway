<div class="row" id="shipping-calc">
	<div class="col-md-12">
	<b>Ingrese su codigo postal para calcular costo de envio:</b>
	<i class="fad fa-shipping-fast" style="color:var(--second);"></i>
	<input type="tel" id="wscp-postcode" autocomplete="off"  name="wscp-postcode" class="input-text text" style="width:70px" />
	<input type="button" id="wscp-button" class="button wscp-button" value="Calcular" >
	<input type="hidden" name="wscp-nonce" id="wscp-nonce" value="<?= wp_create_nonce( "wscp-nonce" ); ?>">
	<div id="wscp-response"></div>
	</div>
</div>