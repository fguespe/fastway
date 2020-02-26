<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
wc_print_notices();


// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'fastway' ) );
	return;
}


if(fw_theme_mod('fw_new_checkout') ){
//update_option('testing_new_checkout',true);

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
  var paso = 1;
</script>
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
    <?php if(!is_user_logged_in()){ ?>

      <div class="box-detail paso-cuenta uno" style="display:block;">
          <h1><span class="icon-paso">1</span>Tu mail</h1>
          <div><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="Ingresá un email valido" value="<?=wp_get_current_user()->user_email?>" autocomplete="email username"></div>
					<div class="login-btn">
						¿Ya tenés una cuenta?<a class="login" onclick="switchlogin()">Iniciar sesión</a>	
					</div>

          <div class="capsula box-step" style="display:none;">
						<a class="editar" onclick="editpaso(1)">modificar</a>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="title">Tu cuenta</span>
						<span class="subtitle" data-id=""></span>					
					</div> 
         <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
				  <div class="clear"></div>	
      </div>
      <div class="box-detail paso-cuenta dos" style="display: none;">
        <h1><span class="icon-paso">1</span>Ingresá a tu cuenta</h1>
        <div id="login" action="login" method="post">
            <input id="username" type="text" name="username" placeholder="Email o username">
            <input id="password" type="password" name="password" placeholder="Contraseña">
            <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Olvidaste tu constraseña?</a>
            <p class="status"></p>
            <input class="submit_button" type="button" value="Login" onclick="fw_login()" name="submit">
            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        </div>

        <div class="login-btn">
          ¿Aún no tenés cuenta?
          <a class="registro" onclick="switchlogin()">Regresar</a>
        </div>

        <div class="capsula box-step" style="display:none;">
          <a class="editar" onclick="editpaso(1)">modificar</a>
          <span class="icon"><i class="fa fa-check"></i></span>
          <span class="title">Tus datos</span>
          <span class="subtitle" data-id=""></span>					
        </div> 
        <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
				<div class="clear"></div>	
      </div>
      <?php }else{ ?>
        <script>
          paso = 2
        </script>
        <input type="email" hidden class="input-text " name="billing_email" id="billing_email" placeholder="Ingresá un email valido" value="<?=wp_get_current_user()->user_email?>" autocomplete="email username">
      <?php } ?>
      <div class="box-detail paso-datos" style="display:<?=is_user_logged_in()?'block':'none';?>;">
          <?php if(!is_user_logged_in()){ ?>
          <h1><span class="icon-paso">2</span>Tus datos</h1>
          <?php }else{ ?>
          <h1><span class="icon-paso">1</span>Tus datos</h1>
          <?php } ?>
          
          <div class="woocommerce-billing-fields">

            <div id="billing_form" class="woocommerce-billing-fields__field-wrapper">
              <?php
              $fields = $checkout->get_checkout_fields( 'billing' );

              foreach ( $fields as $key => $field ) {
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
              }
              ?>
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

      
          <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

          <?php wc_cart_totals_shipping_html(); ?>

          <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

          <div class="capsula box-step" style="display:none;">
						<a class="editar" onclick="editpaso(3)">modificar</a>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="title">¿Cómo te entregamos la compra?</span>
						<span class="subtitle" data-id=""></span>					
					</div>
          <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled>Continuar</button>
          <div class="clear"></div>	
      </div>
      <script>
        jQuery('.capsula.shipping input').on('click', function() {
            let capsula=jQuery(this).parent()
            var id = capsula.data('radio')
            jQuery('#'+id).prop('checked', true);
            let label=capsula.data('label')+' '+capsula.data('costo')
            jQuery('.paso-shipping .box-step .subtitle').data('id',capsula.data('value'))
            jQuery('.paso-shipping .box-step .subtitle').text(label)
            if(paso==3)jQuery('.btn-checkout.continuar').prop('disabled', false);
        });
      </script>
      <div class="box-detail paso-pagos" style="display:none;">
          <h1><span class="icon-paso">3</span>¿Cómo vas a pagar?</h1>
          <?php woocommerce_checkout_payment() ?>

          <div class="capsula box-step" style="display:none;">
            <a class="editar" onclick="editpaso(4)">modificar</a>
            <span class="icon"><i class="fa fa-check"></i></span>
            <span class="title">¿Cómo vas a pagar?</span>
            <span class="subtitle" data-id=""></span>					
          </div>
      </div>
      
    </div>
            
    <div class="col-lg-4  col-sm-12 order-container" >
    </form>
    
        <?php if ( 'yes' === get_option( 'woocommerce_enable_coupons' ) ) { ?>
        <div class="cupones ">
        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
          <p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>
          <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" style="width:70%;display:inline;"/>
            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"  style="width:30%;"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
          </p>
          <div class="clear"></div>
        </form>
        </div>
        <div class="totales">
        <?php } ?>
        <?php woocommerce_order_review() ?>

        <div class="cart-form-actions">

            <a href="<?=wc_get_cart_url()?>">Comprar más productos</a>
            <button type="submit" class="btn-checkout finalizar" disabled style="display:none"><?=fw_theme_mod('fw_place_order_text')?></button>

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
    </div>


</form>
<script>
var shippingLabel=''
var pagosLabel=''

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function fw_login(){
    console.log(jQuery('#login #username').val())
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
            console.log(data)
            if(data && data.loggedin){
              jQuery('#login .status').html('<span style="color:green;" >Login exitoso!</span>') 
              jQuery('#billing_email').val(data.email)
              jQuery('.paso-cuenta.dos .box-step .subtitle').text(data.email)
              nextpaso()
              
            }else{
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
    }
  });
  if(isValid){
    let mailing=jQuery('#billing_address_1').val()
    jQuery('.paso-datos .box-step .subtitle').text(mailing)
  }
  jQuery('.btn-checkout.continuar').prop('disabled', !isValid);
}
function unselect(type){
  jQuery('input:radio[name="'+type+'"]').each(function () { 
    jQuery(this).prop('checked', false);
  });
}
jQuery(document).ready( function(jQuery) {

  //Cupones
  jQuery('.checkout_coupon').show()

  //Resets
  unselect('shipping_method[0]')
  unselect('payment_method')
  verificarFields();

  jQuery('#billing_form input').on('input', function(e){
    verificarFields()
  });
  
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
    jQuery('.paso-cuenta.uno').show()
    resetStep('datos')
    resetStep('shipping')
    resetStep('pagos')
    verificarEmail()
    verificarFields()
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
    resetStep('pagos')
    jQuery('.paso-shipping').show()
    paso=3
  }
}
function resetStep(type){

  jQuery('.paso-'+type).hide()
  jQuery('.paso-'+type+' div:not(.box-step)').show()
  jQuery('.paso-'+type+' .box-step').hide()
  jQuery('.paso-'+type+' h1').show()
  jQuery('.paso-'+type+' button').show()
  //jQuery('.btn-checkout.continuar').show()
  jQuery('.btn-checkout.finalizar').hide()

  unselect(type=='shipping'?'shipping_method[0]':'payment_method')
}

function fillNextStep(type){
  jQuery('.paso-'+type+' .box-step').show()
  jQuery('.paso-'+type+' div:not(.box-step)').hide()
  jQuery('.paso-'+type+' h1').hide()
  jQuery('.paso-'+type+' button').hide()
}
function nextpaso(){
  paso++
  if(paso==2){
    fillNextStep('cuenta')
    jQuery('.paso-datos').show()


  }else if(paso==3){
    fillNextStep('datos')
    jQuery('.paso-shipping').show()


  }else if(paso==4){
    fillNextStep('shipping')
    jQuery('.paso-pagos').show()
    jQuery('.btn-checkout.continuar').hide()
    jQuery('.btn-checkout.finalizar').prop('disabled', true);
    //jQuery('.btn-checkout.finalizar').show()

  }
  jQuery('.btn-checkout.continuar').prop('disabled', true);
 
}
function switchlogin(){
    jQuery('.paso-cuenta.uno').toggle()
    jQuery('.paso-cuenta.dos').toggle()
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
    /*margin-bottom: 20px;*/
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
.order-container .woocommerce-error,
.order-container .woocommerce-message{
  background:none;
  font-size:10px;
  border:1px solid  !important;
  margin:0px !important;
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

.woocommerce-billing-fields__field-wrapper p label{
display:none !important;
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
  display:inline-block !important;
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

</style>
<?php
 }else { 
  
do_action( 'woocommerce_before_checkout_form', $checkout );

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




<?php

} ?>


<script>

jQuery('form.checkout' ).on( 'change', 'input[name^="payment_method"]', function() {
  jQuery(document.body).trigger("update_checkout");
});
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