<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wc_print_notices();

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


    if($fields['billing']['billing_first_name'])$fields['billing']['billing_first_name']['placeholder'] = $fields['billing']['billing_first_name']['label'];
    if($fields['billing']['billing_last_name'])$fields['billing']['billing_last_name']['placeholder'] =$fields['billing']['billing_last_name']['label'];
    if($fields['billing']['billing_company'])$fields['billing']['billing_company']['placeholder'] = $fields['billing']['billing_company']['label'] ;
    if($fields['billing']['billing_phone'])$fields['billing']['billing_phone']['placeholder'] = $fields['billing']['billing_phone']['label'];
    if($fields['billing']['billing_city'])$fields['billing']['billing_city']['placeholder'] = $fields['billing']['billing_city']['label'];
    if($fields['billing']['billing_postcode'])$fields['billing']['billing_postcode']['placeholder'] = $fields['billing']['billing_postcode']['label'];
 
    unset($fields['billing']['billing_email']);
    //unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_2']);
    if(!fw_theme_mod('fw_sell_to_business')){
      unset($fields['billing']['billing_company']);
      unset($fields['billing']['billing_dni']);

    }
    return $fields;
}



?>
<script>
  var logged=false;
  var paso = 1;
</script>
<?php if(is_user_logged_in()){ ?>
<script>
  paso=2
  logged=true
</script>
<?php } ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout fw_checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" novalidate="novalidate">
    
    <div class="col-lg-8 col-sm-12">

      <div class="box-detail mostrar paso-loading" style="display:none;text-align:center;width:100%;"> 
            <div class="capsula ">
              <i class="fal fa-circle-notch fa-spin" style="color:var(--main);width:100%;font-size:80px !important;margin-bottom:50px;" aria-hidden="true"></i>
              <span>Estamos procesando su pedido...aguarde unos segundos.</span>
            </div>
      </div>
        
      <div class="box-detail paso-cuenta" >
        <div class="uno" style="display: <?=is_user_logged_in()?'none':'block'?>">
            <h1><span class="icon-paso">1</span>Tu cuenta</h1>
            <div class="cajamail"><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="Ingresá un email valido" value="<?=wp_get_current_user()->user_email?>" autocomplete="email username"></div>
            <div class="login-btn">
              ¿Ya tenés una cuenta?<a class="login" onclick="switchlogin()">Iniciar sesión</a>	
            </div>
              
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
            <div class="clear"></div>	

        </div>
        <div class="dos" style="display:none">
            <h1><span class="icon-paso">1</span>Ingresá a tu cuenta</h1>
            <div id="login" action="login" method="post">
                <input id="username" type="text" name="username" placeholder="Email o username">
                <input id="password" type="password" name="password" placeholder="Contraseña">
                <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Olvidaste tu constraseña?</a>
                <p class="status"></p>
                <input class="submit_button" type="button" value="Login" onclick="fw_login()" name="submit">
                <div class="submit_button loading" style="display:none;"><i class='fas fa-circle-notch fa-spin'></i></div>
                <?php wp_nonce_field( 'update-order-review', 'security'); ?>
                
            </div>

            <div class="login-btn">¿Aún no tenés cuenta? <a class="registro" onclick="switchlogin()">Regresar</a></div>
            
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
            <div class="clear"></div>	
        </div>
        <div class="capsula box-step" style="display: <?=!is_user_logged_in()?'none':'block'?>">
            <a class="editar" style="display:<?=is_user_logged_in()?'none':'block'?>" onclick="editpaso(1)">modificar</a>
            <a class="editar cerrar" style="display:<?=!is_user_logged_in()?'none':'block'?>"  onclick="fw_logout()">Cerrar sesión</a>
            <span class="icon"><i class="fa fa-check"></i></span>
            <span class="title">Tu cuenta</span>
            <span class="subtitle" data-id=""><?=is_user_logged_in()?wp_get_current_user()->user_email:''?></span>	
        </div> 
      </div>

      <div class="box-detail paso-datos" style="display:<?=is_user_logged_in()?'block':'none';?>;">
          <h1><span class="icon-paso">2</span>Tus datos</h1>
          <div class="woocommerce-billing-fields">

            <div id="billing_form" class="woocommerce-billing-fields__field-wrapper">
              <?php
              $fields = $checkout->get_checkout_fields( 'billing' );

              foreach ( $fields as $key => $field ) {
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
              }

              if(fw_theme_mod('fw_terms_required')){
              ?>
              <span class="woocommerce-input-wrapper terms">
                <input type="checkbox" class="terms" style="width:auto;height:auto!important;" required name="terms" > Acepto los <a style="color:#4D96EC" target="_blank" href="<?=esc_url( get_permalink( wc_terms_and_conditions_page_id() ) )?>">Términos y condiciones</a>
              </span>
              <?php } ?>
            </div>
          </div>
          
          <div class="capsula box-step" style="display:none;">
						<a class="editar" onclick="editpaso(2)">modificar</a>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="title">Tus datos</span>
						<span class="subtitle" data-id=""></span>					
          </div> 
          <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
          <div class="clear"></div>	
        
      </div>
      <div class="box-detail paso-shipping" style="display:none;">
            <h1><span class="icon-paso">2</span> ¿Cómo te entregamos la compra?</h1>
            <?php wc_get_template(	'checkout/shipping-order-review.php'); ?>

            <div class="capsula box-step" style="display:none;">
              <a class="editar" onclick="editpaso(3)">modificar</a>
              <span class="icon"><i class="fa fa-check"></i></span>
              <span class="title">¿Cómo te entregamos la compra?</span>
              <span class="subtitle" data-id=""></span>					
            </div>
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar shipping" disabled>Continuar</button>
            <div class="clear"></div>	
        </div>
        
       
        <div class="box-detail paso-pagos" style="display:none;">
            <h1><span class="icon-paso">3</span>¿Cómo vas a pagar?</h1>
            <?php woocommerce_checkout_payment() ?>

            <div class="capsula box-step" style="display:none;">
              <a class="editar" onclick="editpaso(4)">modificar</a>
              <span class="icon"><i class="fa fa-check"></i></span>
              <span class="title">¿Cómo vas a pagar?</span>
              <span class="subtitle" data-id=""></span>					
            </div>

            <button type="button" onclick="nextpaso()" class="btn-checkout continuar pagos" disabled>Continuar</button>
        </div>
        
      </div>
            
    <div class="col-lg-4  col-sm-12 order-container" >
      </form>
    
        <?php if ( 'yes' === get_option( 'woocommerce_enable_coupons' ) ) { ?>
        <div class="cupones ">
        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
          <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" style="width:70%;display:inline;"/>
            <button type="submit" class="button" name="apply_coupon"   style="width:30%;">Aplicar</button>
          </p>
          <div class="clear"></div>
        </form>
        </div>
        <div class="totales">
        <div id="overlay"></div>
        <?php } ?>
        <?php woocommerce_order_review() ?>

        <div class="cart-form-actions">

            <a href="<?=wc_get_cart_url()?>">Comprar más productos</a>
            <button type="submit" class="btn-checkout finalizar" disabled style="display:none">
              <?=fw_theme_mod('fw_place_order_text')?>
            </button>
        </div>

        <div class="cart-form-desc">
           <p><?=fw_theme_mod('checkout-msg')?></p>
        </div>


        <div class="row place-order"> 
            <noscript>
              <?php
              printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
              ?>
              <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
            </noscript>
            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div>

        </div>
    </div>


</form>
<script>
var shippingLabel=''
var pagosLabel=''

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function fw_logout(){
    confirm("Se perderán los datos del carrito. Desea continuar?");
    jQuery.ajax({
          type: 'POST',
          dataType: 'json',
          url:ajaxurl,
          data: { 
              action: 'fw_ajax_logout'
          },
          success: function(data){
            window.location.reload()
            //editpaso(1)
          }
      });
}
function fw_login(){
    jQuery('.submit_button').hide()
    jQuery('.submit_button.loading').show()
    jQuery.ajax({
          type: 'POST',
          dataType: 'json',
          url:ajaxurl,
          data: { 
              action: 'fw_ajax_login', //calls wp_ajax_nopriv_ajaxlogin
              username: jQuery('#login #username').val(), 
              password: jQuery('#login #password').val(), 
              security: jQuery('#login #security').val() 
          },
          success: function(data){
            if(data && data.loggedin){
              jQuery('#login .status').html('<span style="color:green;" >Login exitoso!</span>') 
              window.location.reload()
              /*jQuery('#billing_email').val(data.email)
              jQuery('.paso-cuenta .box-step .subtitle').text(data.email)
              jQuery('.paso-cuenta .box-step .editar').hide()
              jQuery('.paso-cuenta .box-step .cerrar').show()
              nextpaso()*/
              
            }else{
              jQuery('.submit_button').show()
              jQuery('#login .status').html('<span style="color:red;" >Login incorrecto</span>') 
            }
          }
      });
}
function verificarEmail(){
  let isValid= isEmail(jQuery('#billing_email').val())
  jQuery('.btn-checkout.continuar').prop('disabled', !isValid);
}
function verificarFields(){
  var isValid=true
  jQuery('#billing_form input').each(function(index,data) {
    var element = jQuery(this);
    if (element.val() == "") {
        isValid = false;
        element.addClass('enrojo')
    }else{

      element.removeClass('enrojo')
    }
  });
  jQuery('#billing_form input[type="checkbox"]').each(function(index,data) {
    var element = jQuery(this);
    if (element.prop("checked") == false){
        isValid = false;
        //element.parent().addClass('enrojo')
    }else{
      //element.parent().removeClass('enrojo')
    }
  });
  if(isValid){
    let mailing=jQuery('#billing_address_1').val()
    if(!mailing)mailing=jQuery('#billing_first_name').val()
    jQuery('.paso-datos .box-step .subtitle').text(mailing)
  }
  if(jQuery('#billing_address_1'))
  console.log('disabled', !isValid)
  jQuery('.btn-checkout.continuar').prop('disabled', !isValid);
}
function unselect(type){
  console.log(type)
  jQuery('input:radio[name="'+type+'"]').each(function () { 
    jQuery(this).prop('checked', false);
    jQuery(this).parent().removeClass('active')
  });
  jQuery('.btn-checkout.continuar').prop('disabled', true);
}
jQuery(document).ready( function(jQuery) {

  //Cupones
  jQuery('.checkout_coupon').show()

  //Resets
  unselect('shipping_method[0]')
  unselect('payment_method')
  verificarEmail();
  verificarFields();

  jQuery('#billing_form input').on('input', function(e){
    verificarFields()
  })
  
  //Cuando el mail cambia
  jQuery('#billing_email').on('input', function(e){
    let val=jQuery('#billing_email').val()
    if(isEmail(val) && paso==1){
      jQuery('.btn-checkout.continuar').prop('disabled', false);
      jQuery('.paso-cuenta .box-step .subtitle').text(val)
    }else{
      jQuery('.btn-checkout.continuar').prop('disabled', true);
    }
  })

  // Login
  jQuery('a#show_login').on('click', function(e){
      jQuery('body').prepend('<div class="login_overlay"></div>');
      jQuery('#login').fadeIn(500);
      jQuery('div.login_overlay, #login a.close').on('click', function(){
        jQuery('div.login_overlay').remove();
        jQuery('#login').hide();
      });
  });

  
})


function editpaso(ppaso){
  let type=''
  if(ppaso==1){//
    resetStep('cuenta')
    jQuery('.paso-cuenta').show()
    resetStep('datos')
    resetStep('shipping')
    resetStep('pagos')

    verificarEmail()
    //verificarFields()
    paso=1
  }else if(ppaso==2){//shipping
    resetStep('datos')
    jQuery('.paso-datos').show()
    resetStep('shipping')
    resetStep('pagos')
    verificarFields()
    paso=2
  }else if(ppaso==3){
    resetStep('shipping')
    jQuery('.paso-shipping').show()
    resetStep('pagos')
    paso=3
  }else if(ppaso==4){
    resetStep('pagos')
    jQuery('.paso-pagos').show()
    paso=4
  }
}
function resetStep(type){

  jQuery('.paso-'+type).hide()
  jQuery('.paso-'+type+' div:not(.box-step)').show()
  
  jQuery('.paso-'+type+' .dos').hide()//Nunca se da porq e otro cierra sesion

  jQuery('.paso-'+type+' .box-step').hide()
  jQuery('.paso-'+type+' .box-step').removeClass('efecto')
  jQuery('.paso-'+type+' h1').show()
  jQuery('.paso-'+type+' button').show()
  //jQuery('.btn-checkout.continuar').show()
  jQuery('.btn-checkout.finalizar').hide()
  if(type=='shipping'){
    unselect('shipping_method[0]')
    unselect('payment_method')
  }else if(type=='pagos'){
    unselect('payment_method')
  }
    unselect('shipping_method[0]')
    unselect('payment_method')
}

function fillNextStep(type){
  console.log('.paso-'+type+' .box-step')
  jQuery('.paso-'+type+' .box-step').show()
  jQuery('.paso-'+type+' .box-step').addClass('efecto')
  jQuery('.paso-'+type+' div:not(.box-step)').hide()
  jQuery('.paso-'+type+' h1').hide()
  jQuery('.paso-'+type+' button').hide()
}
function nextpaso(){
  paso++
  if(paso==2){
    fillNextStep('cuenta')
    jQuery('.paso-datos').show()
    verificarFields();

  }else if(paso==3){
    fillNextStep('datos')
    unselect('shipping_method[0]')
    jQuery('.paso-shipping').show()
    jQuery('.btn-checkout.continuar').prop('disabled', true);



  }else if(paso==4){
    fillNextStep('shipping')
    jQuery('.paso-pagos').show()
  jQuery('.btn-checkout.continuar').prop('disabled', true);

  }else if(paso==5){
    fillNextStep('pagos')
    jQuery('.btn-checkout.finalizar').prop('disabled', false);
    jQuery('.btn-checkout.finalizar').show()

  }
 
}
function switchlogin(){
    jQuery('.paso-cuenta .uno').toggle()
    jQuery('.paso-cuenta .dos').toggle()
}

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
.submit_button.loading{
    width: 48%;
    border-radius:3px;
    text-align:center;
    font-size:14px;
    line-height:46px;
    display:block;
    display:none;  
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
}
.order-total {
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
.btn-checkout {
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
    border:0px !important;
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
    background: var(--main);
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
    padding-bottom:12px;
}
.box-detail .capsula small {
    font-size: 14px;
    color: #999;
    font-weight: 300;
    display: block;
    padding: 4px 0 0 0;
}
.box-detail  .capsula > input {
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

#woocommerce-wrapper, .woocommerce-cart #page-wrapper, .woocommerce-account #page-wrapper, .woocommerce-checkout #page-wrapper{
    background:#ECECEC;
    border:0px !important;
}
.btn-checkout:disabled{
    background:grey !important;
}
.order-container .woocommerce-error,
.order-container .woocommerce-message{
  background:none;
  font-size:10px;
  border:1px solid  !important;
  margin:0px !important;
}
.woocommerce-input-wrapper.terms a,
.woocommerce-input-wrapper.terms {
font-size:12px !important;
}
.order-container{
  padding:0px;
}
.order-container .cupones, .order-container .totales {
    background:white;
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.15);
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.15);
    padding:10px;
    padding-bottom: 0;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    overflow: hidden;
}
.order-container .cupones{
  margin-bottom:20px;
}
.box-detail .capsula {
    background:white;
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.15);
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.15);
    padding-bottom: 0;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    overflow: hidden;
}
.order-container .woocommerce-error{
  background:none;
}
.box-detail .login-btn {
    width: 100%;
    height: 30px;
    line-height: 30px;
    font-size: 14px;
    color: #999;
    text-align: center;
}
.box-detail .login-btn a {
    display: inline-block;
    cursor: pointer;
    height: 30px;
    line-height: 30px;
    color: #3483fa;
}

.box-detail input{
  margin:0px;
}

#billing_country_field {
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
	border: 1px solid var(--main);
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
	color: var(--main);
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
table.shop_table{
  border-top:0px !important;
}

.woocommerce-checkout #shipping_method label{
	margin:0px !important;
}
#login input{
  width:48%;
  display:inline-block;
}
html, body {
  height: 92%;
}
#page-wrapper {
  min-height: 100%;
  height: auto !important; /*min-height hack*/
}
footer{
  display:none !important ;
}
form.processing .box-detail{
  display:none !important;
}
form.processing  #overlay {
  display: block !important;
}
form.processing  .paso-loading {
  display: block !important;
}
.processing .finalizar{
  display:block !important;
  background: gray;
  color: gray;
  pointer-events: none;
}
.processing .finalizar:focus{ 
  pointer-events: none !important;
}
[data-radio="billetera"] {
    display:none !important;
}

[data-radio="todopago"] input{
float:left !important;
}
[data-radio="todopago"] img{
float:right;
}
.fw_checkout #shipping_method li .title,
.fw_checkout #payment li .title{
  font-size:16px !important;
  display:inline-block !important;
}
/*ee*/
.fw-woocommerce-shipping-totals{
font-size:0px;
}
.lpp-shipping-package-wrapper{
width:100% !important;
margin:0px !important;
padding:0px !important;
}
.woocommerce-shipping-contents{
  display:none;
}
.box-step .subtitle{
max-width:85% !important;
}
.pickup-location-lookup-area-field{
display:none !important;
}
.enrojo{
  border:1px solid red !important;
}
.payment_method_offline_cc .extras > p,
.payment_method_offline_cc .extras > .test_mode_msg{
	display:none;
}
.payment_method_offline_cc .extras{
  margin-top:10px;
}
.payment_method_offline_cc .extras p{
padding:0px !important;
}
.payment_method_offline_cc .extras .form-row{
  padding:2px;
}
@media (min-width: 799px) {

  .payment_method_offline_cc .extras .form-row:nth-child(1){
width:60%;
display:inline-block;
}
.payment_method_offline_cc .extras .form-row:nth-child(2){
width:20%;
display:inline-block;
}
.payment_method_offline_cc .extras .form-row:nth-child(3){
width:20%;
display:inline-block;
}

  
}
@media (max-width: 799px) {

  .payment_method_todopago img{
    display:none;
  }
}

</style>


<script>
var envioSeleccionado=false
jQuery('form.checkout' ).on( 'change', 'input[name^="payment_method"]', function() {
  jQuery(document.body).trigger("update_checkout");
});

jQuery( document ).on( 'updated_cart_totals', function(){
  updateEnvioGratisME();
});
function checkpostalCode(){
  if(jQuery('#billing_postcode').length && !jQuery('#billing_postcode').val()){
    var msg = window.prompt("Complete su código postal para poder calcular su envío", "");
    jQuery('#billing_postcode').val(msg)
  }
}
jQuery(document).on( 'updated_checkout', function(){
  updateEnvioGratisME();
  setTodopago()
  setEposnet()
	if(envioSeleccionado)jQuery('.shipping-total').attr("style", "display: table-row; !important")

});
function setEposnet(){
  let litp=jQuery(document).find(`[data-radio="todopago"]`)
  let img='<img class="imgtp" width="100" src="/wp-content/themes/fastway/assets/img/ahora3y6tp.png"/>'
  if(!litp.find('img.imgtp').length)jQuery('#payment_method_todopago').after(img)
  let label='<?=fw_theme_mod('fw_checkout_todopago_label')?>'
  let desc='<?=fw_theme_mod('fw_checkout_todopago_desc')?>'
  if(label)litp.find('.title').text(label)
  if(desc)litp.find('small').text(desc)
}
function setTodopago(){
  let litp=jQuery(document).find(`[data-radio="spyr_firstdata_gateway"]`)
  let label='<?=fw_theme_mod('fw_checkout_eposnet_label')?>'
  let desc='<?=fw_theme_mod('fw_checkout_eposnet_desc')?>'
  if(label)litp.find('.title').text(label)
  if(desc)litp.find('small').text(desc)
}
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
    let dias=['(2-4 días)','(1-3 días)','(3-5 días)','(6-8 días)'];
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
          element.html('<span class="title">Correo a domicilio '+freecuando+'</span><small style="display:inline;"> * Pagando con mercadopago</small>');
          element.addClass('mercadoenvios-shipping ');
          
        }
      }
    }
}

</script>