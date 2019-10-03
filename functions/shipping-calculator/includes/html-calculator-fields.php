<div class="row" id="shipping-calc">
	<div class="col-md-12">
	<b style="display:block;">Calcular costo de envio a domicilio por correo:</b>
	<i class="fad fa-shipping-fast" style="color:var(--second);"></i>
	<input type="tel" id="wscp-postcode" autocomplete="off"  name="wscp-postcode" class="input-text text" style="width:70px" placeholder="Codigo postal" />
	<input type="button" id="wscp-button" class="btn_mp_calc_shipping" value="Calcular" >
	<input type="hidden" name="wscp-nonce" id="wscp-nonce" value="<?= wp_create_nonce( "wscp-nonce" ); ?>">
	<div id="wscp-response"></div>
	</div>
</div>