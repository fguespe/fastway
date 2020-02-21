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

add_filter( 'woocommerce_checkout_fields' , 'fw_custom_override_checkout_fieldss' );
function fw_custom_override_checkout_fieldss( $fields ) {
    $fields['billing']['billing_dni'] = array(
      'label'     => fw_theme_mod( 'fw_cuit_label'),
      'placeholder'     => fw_theme_mod( 'fw_cuit_label'),
      'required'  => true,
      'class'     => array('form-row-wide'),
      'clear'     => true,
      'priority' => 31
    );

    $fields['billing']['billing_company']['placeholder'] = $fields['billing']['billing_company']['label'] ;
    $fields['billing']['billing_first_name']['placeholder'] = $fields['billing']['billing_first_name']['label'];
    $fields['billing']['billing_last_name']['placeholder'] =$fields['billing']['billing_last_name']['label'];
    $fields['billing']['billing_phone']['placeholder'] = $fields['billing']['billing_phone']['label'];
    $fields['billing']['billing_city']['placeholder'] = $fields['billing']['billing_city']['label'];
    $fields['billing']['billing_postcode']['placeholder'] = $fields['billing']['billing_postcode']['label'];
    
    //unset($fields['billing']['billing_email']);
    //unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_2']);
    if(!fw_theme_mod('fw_sell_to_business')){
      unset($fields['billing']['billing_company']);
      unset($fields['billing']['billing_dni']);

    }

     return $fields;
}




if(!isset($_GET["new"]) || $_GET["new"]!=='yes'){

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
    <div class="fw_summary-box">

    <h3 ><?php echo __('Order details','woocommerce')?><a class="returncart" href="<?=wc_get_cart_url()?>" style="font-size:12px;"><?php echo __('Return to cart','woocommerce')?></a></h3> 
        
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
    <p class="description"><?=fw_theme_mod("fw_label_debajo_checkout_message")?></p>
</form>


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>



<?php }else if(isset($_GET["new"]) && $_GET["new"]==='yes'){ ?>

  <form name="checkout" method="post" class="checkout woocommerce-checkout fw_checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" novalidate="novalidate">
    <div class="mostrar" style="display:none;text-align:center;width:100%;">
        <i class="fal fa-sync fa-spin" style="color:var(--main);width:100%;font-size:80px !important;margin-bottom:50px;" aria-hidden="true"></i>
        <span>Estamos procesando su pedido...aguarde unos segundos.</span>
    </div>
    <style>
        form.processing div:not(.mostrar) {
            display: none;
        }
        
        form.processing .mostrar {
            display: block !important;
        }
    </style>
    <div class="col-lg-8 col-sm-12">
    <div class="box-detail paso-shipping">
          <h1><span class="icon-paso">1</span> ¿Cómo te entregamos la compra?</h1>

      
          <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

          <?php wc_cart_totals_shipping_html(); ?>

          <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

          <div class="capsula box-step" style="display:none;">
						<a class="editar" onclick="editpaso(1)">modificar</a>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="title">¿Cómo te entregamos la compra?</span>
						<span class="subtitle"></span>					
					</div>
      </div>
      <script>
        jQuery('.capsula.shipping').on('click', function() {
            var id = jQuery(this).data('radio')
            jQuery('#'+id).prop('checked', true);
            let label=jQuery(this).data('label')+' '+jQuery(this).data('costo')
            jQuery('.paso-shipping .box-step .subtitle').text(label)
            if(paso==1)jQuery('.btn-checkout.continuar').prop('disabled', false);
        });
      </script>
      <div class="box-detail paso-pagos" style="display:none;">
          <h1><span class="icon-paso">2</span>¿Cómo vas a pagar?</h1>
          <?php woocommerce_checkout_payment() ?>

          <div class="capsula box-step" style="display:none;">
            <a class="editar" onclick="editpaso(2)">modificar</a>
            <span class="icon"><i class="fa fa-check"></i></span>
            <span class="title">¿Cómo vas a pagar?</span>
            <span class="subtitle"></span>					
          </div>
      </div>
      <?php if(!is_user_logged_in()){ ?>
      <div class="box-detail paso-cuenta uno" style="display:none;">
          <h1><span class="icon-paso">3</span>Datos de contacto</h1>
					<input type="email" id="correo" name="billing_email" placeholder="Email">
					<div class="login-btn">
						¿Ya tenés una cuenta?<a class="login" onclick="switchlogin()">Iniciar sesión</a>	
					</div>
				  <div class="clear"></div>	
      </div>
      <div class="box-detail paso-cuenta dos" style="display: none;">
          <h1><span class="icon-paso">3</span>Ingresá a tu cuenta</h1>

					<input type="email" id="correo_login" name="correo_login" placeholder="Email" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
					<input type="password" id="clave_login" name="clave_login" placeholder="Contraseña" required="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">

					<div class="login-btn">
						¿Aún no tenés cuenta?
						<a class="registro" onclick="switchlogin()">Regresar</a>
					</div>

				<div class="clear"></div>	
      </div>
      <?php }?>
      <div class="box-detail paso-cuenta tres" style="display:none;">
          <h1>Facturación  & Envío</h1>
         
          <div class="woocommerce-billing-fields">

            <div class="woocommerce-billing-fields__field-wrapper">
              <?php
              $fields = $checkout->get_checkout_fields( 'billing' );

              foreach ( $fields as $key => $field ) {
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
              }
              ?>
            </div>
          </div>

        
      </div>
    </div>
            
    <div class="col-lg-4  col-sm-12 order-container" >
    
        <div class="order-detail">
            <h1>Resumen de compra</h1>
            
            <?php
            $totals=WC()->cart->get_totals();
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

                $product=wc_get_product($cart_item['product_id']);
                if($cart_item['variation_id'])$product=wc_get_product($cart_item['variation_id']);
            
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $cart_item['product_id'] ), 'featured-thumb' ); 
                  $image_url = $image[0];
                  $nombre = $product->get_name();
                  $cant=$cart_item['quantity'];
                  $precio= $cart_item['line_subtotal'];
                  ?>
                  <div class="table">
                      <div class="image"> <img src="<?=$image_url?>"></div>
                      <div class="product-info">
                              <div class="name"><?=$nombre?></div>
                              <div class="description">
                                  <ul>
                                      <li><strong>Cantidad:</strong><?=$cant?></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="product-price">$<?=$precio?> </div>
                      </div>
          <?php } ?>

            <div class="clear"></div>
        </div>

        <div class="cart-form-actions">

            <a href="<?=wc_get_cart_url()?>">Comprar más productos</a>
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
            <button type="submit" class="btn-checkout finalizar" style="display:none"><?=fw_theme_mod('fw_place_order_text')?></button>

        </div>


      <div class="row place-order"> 
          <noscript>
            <?php
            /* translators: $1 and $2 opening and closing emphasis tags respectively */
            printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
            ?>
            <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
          </noscript>

          <?php //wc_get_template( 'checkout/terms.php' ); ?>

          <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

          <?php //echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( fw_theme_mod('fw_place_order_text') ) . '" data-value="' . esc_attr( fw_theme_mod('fw_place_order_text') ) . '">' . esc_html( fw_theme_mod('fw_place_order_text') ) . '</button>' ); // @codingStandardsIgnoreLine ?>

          <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

          <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div>

      </div>


</form>
<script>
var paso = 1
var shippingLabel=''
var pagosLabel=''

function editpaso(ppaso){
  let type=''
  if(ppaso==1){//shipping
    type='shipping'
    jQuery('.paso-pagos').hide()
    paso=1
  }else if(ppaso==2){
    type='pagos'
    paso=2
  }

  jQuery('.paso-cuenta').hide()
  jQuery('.paso-'+type+' .box-step').hide()
  jQuery('.paso-'+type+' div:not(.box-step)').show()
  jQuery('.paso-'+type+' h1').show()
  jQuery('.btn-checkout.continuar').show()
  jQuery('.btn-checkout.finalizar').hide()
}
function fillNextStep(type){
  jQuery('.paso-'+type+' .box-step').show()
  jQuery('.paso-'+type+' div:not(.box-step)').hide()
  jQuery('.paso-'+type+' h1').hide()
}
function nextpaso(){
  paso++

  if(paso==2){
    jQuery(document.body).trigger("update_checkout");
    jQuery('.paso-pagos').show()

    fillNextStep('shipping')
  }
  if(paso==3){
    jQuery('.paso-cuenta.uno').show()
    jQuery('.paso-cuenta.tres').show()
    jQuery('.btn-checkout.continuar').hide()
    jQuery('.btn-checkout.finalizar').show()

    
    fillNextStep('pagos')
  }
  jQuery('.btn-checkout.continuar').prop('disabled', true);
  if(paso==4){

  }
}
function switchlogin(){
    jQuery('.paso-cuenta.uno').toggle()
    jQuery('.paso-cuenta.dos').toggle()
}

jQuery( document ).on( 'update_checkout', function(){
  alert('haha')
});


</script>
<style>
.order-detail h1 {
    line-height: 22px;
    padding: 0 0 10px 0;
    text-align: left;
    font-size: 16px;
    color: #000;
    border-bottom: 1px solid #ddd;
}
.table {
    display: table;
    width: 100%;
    margin: 10px 0 0 0;
    border-bottom: 1px solid #ddd;
    padding: 0 0 10px 0;
}
.table .image {
    width: 48px;
    height: 60px;
    position: relative;
    overflow: hidden;
    margin: 0 15px 0 0;
}
.table .image img {
    max-height: 100%;
    max-width: 100%;
    width: auto;
    height: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

.table .product-info {
    width: 60%;
    min-height: 1px;
    position: relative;
    display: block;
}
.table .product-info .name {
    line-height: 16px;
    max-height: 32px;
    overflow: hidden;
    font-size: 14px;
    color: #000;
    margin: 0 0 10px 0;
    display: block ;
    width:100%;
}
.table div {
    float: left;
}
.table .product-info .description {
    display: block;
}

.table .product-price {
    font-size: 14px !important;
    color: #000;
    font-weight: 300;
    float: right;
    text-align: right;
}
.order-totals {
    padding: 10px;
}
.order-totals li span:first-child {
    width: 58%;
}
.order-totals li span:last-child {
    width: 40%;
    text-align: right;
}
.order-totals li span {
    display: inline-block;
    font-size: 14px;
}.order-totals .cart-total {
    background: #f6f6f6;
    padding: 15px 10px;
    margin: 5px -10px 0;
    font-size: 1.2em;
    font-weight: 600;
}
.order-totals .cart-total span {
    font-size: 20px !important;
}
.cart-form-actions {
    display: block;
}
.cart-form-actions a {
    display: inline-block;
    float: left;
    line-height: 40px;
    height: 40px;
    font-size: 14px;
    color: #3483fa;
}
.cart-form-actions button {
    display: inline-block;
    float: right;
    padding: 0 25px;
    line-height: 40px;
    height: 40px;
    font-size: 14px;
    font-weight: 700;
    background: #3483fa;
    color: #fff;
    border-radius: 3px;
    text-transform: uppercase;
    cursor: pointer;
border:0px;
}
.box-detail {
    margin-bottom: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 15px;
    position: relative;
    padding-top:0px;
}
.box-detail h1 {
    line-height: 32px;
    text-align: left;
    font-size: 18px;
    color: #333;
    margin: 0 0 15px 0;
}
.box-detail h1 .icon-paso {
    width: 32px;
    height: 32px;
    font-size: 20px;
    border-radius: 100%;
    background: #39b54a;
    color: #fff;
    float: left;
    margin: 0 10px 0 0;
    text-align: center;
}
.box-detail .capsula {
    display: block;
    position: relative;
    border: 1px solid #ccc;
    padding: 10px 10px 10px 30px;
    border-radius: 3px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 14px;
    color: #333;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.box-detail .capsula small {
    font-size: 14px;
    color: #999;
    font-weight: 300;
    display: block;
    padding: 4px 0 0 0;
}
.box-detail  .capsula input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
.box-detail input {
    width: 100%;
    height: 44px;
    border: 1px solid #ccc;
    color: #555;
    font-size: 14px;
    border-radius: 3px;
    padding: 0 10px;
    margin: 0 0 15px 0;
}
.box-detail .checkmark {
    position: absolute;
    top: 11px;
    left: 10px;
    height: 14px;
    width: 14px;
    background-color: #ddd;
    border-radius: 50%;
}
.box-detail .capsula input:checked ~ .checkmark {
    background-color: #2196F3;
}

#woocommerce-wrapper, .woocommerce-cart #page-wrapper, .woocommerce-account #page-wrapper, .woocommerce-checkout #page-wrapper,.box-detail{
    background:#ECECEC !important;
    border:0px !important;
}
.btn-checkout:disabled{
    background:grey !important;
}
.box-detail .capsula,.order-container {
    background:white;
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.15);
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.15);
    padding-bottom: 0;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    overflow: hidden;
}
.box-detail .login-btn {
    width: 100%;
    height: 30px;
    line-height: 30px;
    font-size: 14px;
    color: #999;
    text-align: center;
    margin: 15px 0;
}
.box-detail .login-btn a {
    display: inline-block;
    cursor: pointer;
    height: 30px;
    line-height: 30px;
    color: #3483fa;
}

.woocommerce-billing-fields__field-wrapper p label{
display:none !important;
}
.box-detail input{
  margin:0px;
}
#billing_country_field,#billing_email {
  display: none;
}
.woocommerce-checkout .wc_payment_methods, .woocommerce-account .wc_payment_methods{
    border:0px !important;
}
.paso-cuenta{
  margin-bottom:0px !important;
}
.box-step {
	display: block;
	background: white;
}

.box-step .icon {
	width: 32px !important;
	height: 32px !important;
	border-radius: 100%;
	border: 1px solid #39b54a;
	float: left;
	margin: 0 10px 0 0;
}

.box-step .icon i {
	width: 32px !important;
	height: 32px!important;
	text-align: center;
	line-height: 32px;
	display: block;
	font-size: 18px !important;
	color: #39b54a;
}

.box-step .title {
	display: block;
	font-size: 18px;
	color: #333;
	margin: 0 0 5px 0;
	font-weight: 400;
}

.box-step .subtitle {
	display: block;
	font-size: 14px;
	color: #999;
	font-weight: 300;
	padding: 0 0 0 42px;
}

.box-step .editar {
	float: right;
	color: #3483fa;
	font-size: 14px;
}
.box-step{
  padding:10px !important;
}
</style>

<?php

} ?>


<script>

jQuery( document ).on( 'updated_cart_totals', function(){
  updateEnvioGratisME();
  updateflete();
});
function checkpostalCode(){
  if(jQuery('#billing_postcode').length && !jQuery('#billing_postcode').val()){
    var msg = window.prompt("Complete su código postal para poder calcular su envío", "");
    jQuery('#billing_postcode').val(msg)
  }
}
jQuery(document).on( 'updated_checkout', function(){
  updateEnvioGratisME();
  //Actualizo todo pago
  updateflete();

  jQuery('li.payment_method_todopago label').html('Todo pago <img src="https://todopago.com.ar/sites/todopago.com.ar/files/boton_192x55_ahora3y6.png" alt="" />')
  /*
  setTimeout( function() {
    //checkpostalCode();
  }, 3000 );*/
  
});
function updateflete(){

  let buscar="label:contains('Radio de 10km (Canning)')"
  var element =jQuery(buscar);
  if(element){
    jQuery( "<br><b>Fletes:</b>" ).insertBefore( element.closest('li') );

  }
  buscar="label:contains('Munro')"
  element =jQuery(buscar);
  if(element){
    jQuery( "<br><b>Otros:</b>" ).insertAfter( element.closest('li') );

  }
}


function updateEnvioGratisME(){
    //Cambio el label a mercadoenvios gratis
    let dias=['(2-4 días)','(1-3 días)','(3-5 días)'];
    let tipos=["Envío Gratis",'Normal a domicilio'];
    for(let j in tipos){
      let label=tipos[j];
      for(let i in dias){
        let freecuando=dias[i]
        let buscar="label:contains('"+label+" "+freecuando+"')"
        var element =jQuery(buscar);
        if(element && label==tipos[0]){  
          element.text('Envio Gratis Por Correo A Domicilio '+freecuando+'');
          element.addClass('mercadoenvios-shipping free');
        }else if(element && label==tipos[1]){  
          element.html('Correo a domicilio '+freecuando+' \n*Pagando con mercadopago');
          element.addClass('mercadoenvios-shipping ');
          
        }
      }
    }
}

</script>