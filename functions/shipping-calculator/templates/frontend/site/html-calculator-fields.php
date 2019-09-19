<div id="shipping-calc">

	<p><?= get_option("wscip_title","Consulte o prazo estimado e valor da entrega."); ?></p>

	<input type="tel" id="wscp-postcode" autocomplete="off"  name="wscp-postcode" class="input-text text" />

	<input type="button" id="wscp-button" class="button wscp-button" value="Calcular" >


	<input type="hidden" name="wscp-nonce" id="wscp-nonce" value="<?= wp_create_nonce( "wscp-nonce" ); ?>">

	<div id="wscp-response"></div>

</div>