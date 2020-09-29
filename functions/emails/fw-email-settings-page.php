<?php
function myplugin_register_settings() {
add_option( 'fw_email_subject_customer_new_account', 'Tu cuenta esta lista');
add_option( 'fw_email_content_customer_new_account', 'Bienvenido a {{blogname}}

Gracias por crear una cuenta en nuestra web. 
Tu nombre de usuario es {{user_name}}
Podés acceder a tu cuenta para ver pedidos, cambiar tu contraseña y más en: {{myaccount}}

Tu contraseña se generó automáticamente: <strong>{{user_pass}}</strong>
Pero podés cambiarla cuando quieras.

¡Te esperamos! ;-)');

add_option( 'fw_email_subject_customer_processing_order', 'Gracias por tu pedido');
add_option( 'fw_email_content_customer_processing_order', 'Hola {{customer_name}},

Solo para que estés informado — hemos recibido tu pedido {{order_number}}, y ahora se está procesando


{{order_details}}

{{order_meta}}

{{customer_details}}

Gracias por tu compra.');


if(fw_theme_mod('fw_trans_comprobantes') && fw_theme_mod('fw_trans_comprobantes_id')){

add_option( 'fw_email_subject_customer_await_verif_order', 'Recibimos tu comprobante');
add_option( 'fw_email_content_customer_await_verif_order', 'Hola {{customer_name}},

Solo para que estés informado — hemos recibido tu comprobante para la orden {{order_number}}

Estaremos verificandolo y te notificaremos cuando este aprobado.

Gracias por tu compra.');

}
add_option( 'fw_email_subject_customer_completed_order', 'Pedido completado');
add_option( 'fw_email_content_customer_completed_order', 'Hola {{customer_name}},

Hemos terminado de procesar tu pedido.

{{order_details}}

{{order_meta}}

{{customer_details}}

Gracias por tu compra.');



add_option( 'fw_email_subject_customer_on_hold_order', 'Pedido a la espera');
add_option( 'fw_email_content_customer_on_hold_order', 'Hola {{customer_name}},

Gracias por tu pedido. Está en espera hasta que confirmemos que se ha recibido el pago. Mientras tanto, aquí tienes un recordatorio de lo que has pedido:

{{order_details}}

{{order_meta}}

{{customer_details}}

Esperamos poder cumplir pronto tu pedido.');



add_option( 'fw_email_subject_customer_reset_password', 'Cambio de contraseña');
add_option( 'fw_email_content_customer_reset_password', 'Hola {{user_name}},

Alguien solicitó cambiar la contraseña de tu cuenta: {{user_name}}

Para cambiar tu contraseña: {{reset_link}}


<small>*Si no fuiste tu, ignorar este correo.</small>');



add_option( 'fw_email_subject_admin_new_order', 'Nuevo Pedido {{order_number}}');
add_option( 'fw_email_content_admin_new_order', '
Recibiste un nuevo pedido de: {{customer_name}}

{{order_details}}

{{order_meta}}

{{customer_details}}
');



add_option( 'fw_email_subject_admin_new_order', 'Nuevo Pedido {{order_number}}');
add_option( 'fw_email_content_admin_new_order', '
Recibimos tu solicitud

Estaremos evaluandola a fin de determinar
');



//WHOLESALE
add_option( 'fw_email_content_confirmation_wholesale_form', '¡Gracias por contactar con nosotros! 

Nos pondremos en contacto contigo muy pronto.
');


add_option( 'fw_email_subject_gf_pending', 'Nueva Solicitud');
add_option( 'fw_email_content_gf_pending', 'Recibimos tu solicitud. 

Estaremos evaluando tu solicitud y te avisaremos cuando te demos de alta.
');

add_option( 'fw_email_subject_gf_activated', 'Solicitud Aceptada');
add_option( 'fw_email_content_gf_activated', 'Tu cuenta ya esta lista

Para activarla entra al siguiente link: {{activation_url}}');


add_option( 'fw_email_content_thankyou', '
<h2>Gracias por tu compra</h2>

<p>El pedido fue registrado con número {{order_number}}</p>

<span>Te enviamos un mail a <b>{{customer_email}}</b> con el detalle y las instrucciones de como seguir.</span>
');


add_option( 'fw_email_content_product_summary', '');


register_setting( 'fw_email_options_group', 'fw_email_subject_customer_new_account', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_customer_processing_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_customer_completed_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_customer_on_hold_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_customer_reset_password', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_admin_new_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_gf_pending', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_subject_gf_activated', 'myplugin_callback' );

register_setting( 'fw_email_options_group', 'fw_email_content_customer_new_account', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_customer_processing_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_customer_completed_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_customer_on_hold_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_customer_reset_password', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_admin_new_order', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_gf_pending', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_gf_activated', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_thankyou', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_confirmation_wholesale_form', 'myplugin_callback' );
register_setting( 'fw_email_options_group', 'fw_email_content_product_summary', 'myplugin_callback' );

}

add_action( 'admin_init', 'myplugin_register_settings' );

function myplugin_register_options_page() {
add_options_page('Email Templates', 'Email Templates', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');



function myplugin_options_page(){
  $customer_emails_vars.='
  <a href="https://altoweb.freshdesk.com/a/solutions/articles/36000237973">'.__('Docs','fastway').'</a><br>
  <b>'.__('Variables','fastway').':</b>
  <br><small>{{blogname}} {{customer_email}} {{customer_name}} {{order_number}} {{order_details}} {{order_meta}} {{customer_details}} {{shipping_method_title}} {{shipping_method_type}} {{shipping_method_id}} {{payment_method_id}} {{role}} {{payment_method_title}} </small>
  <br><b>'.__('Payment Methods','fastway').'('.__('values','fastway').')</b>
  <br><small>';
  foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway ) {
      if( $gateway->enabled == 'yes' ) {
          $customer_emails_vars.=$gateway->title.' ('.$gateway->id.') , ';
      }
  }
  $customer_emails_vars.='</small><br><b>'.__('Roles','fastway').' ('.__('values','fastway').'):</b>
  <br><small>';
  $roles=array();
  foreach ( get_editable_roles() as $role => $value ) {
    if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest' || $role == '' )$role='minorista';
    if(!in_array($role,$roles))array_push($roles,$role.',');
  }
  $customer_emails_vars.=implode(' ',$roles).'</small>';
?>
<div>

<style>
.valinfo{
  background:white !important;
  padding:5px;
}
/* Style the tab */
.tab {
margin-top:20px;
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 0px;
  border: 0px solid #ccc;
  border-top: none;
}
</style>
<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<?php screen_icon(); ?>
<form method="post" class="wrap" action="options.php">
<?php settings_fields( 'fw_email_options_group' ); ?>
<div class="tab">
  <button type="button" class="tablinks active" onclick="openCity(event, 'account_emails')">Account Emails</button>
  <button type="button" class="tablinks" onclick="openCity(event, 'customer_emails')">Order Emails</button>
  <?php
if(is_plugin_active('gravityformsuserregistration/userregistration.php')){
?>
  <button type="button" class="tablinks" onclick="openCity(event, 'wholesale')">Wholesale</button>
<?php } ?>
  <button type="button" class="tablinks" onclick="openCity(event, 'admin_emails')">Admin Emails</button>
  <button type="button" class="tablinks" onclick="openCity(event, 'other')">Other</button>
</div>

<div class="valinfo"><?=$customer_emails_vars;?></div>
<!-- Tab content -->
<div id="account_emails" class="tabcontent" style="display:block;">
<div class="tipomail">
<h3 class="titulo"><?=__( 'New Account', 'woocommerce' )?></h3>
<small><?=__( 'Customer "new account" emails are sent to the customer when a customer signs up via checkout or account pages.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_new_account" name="fw_email_subject_customer_new_account" value="<?php echo get_option('fw_email_subject_customer_new_account'); ?>" />
<small>Variables: {{blogname}} {{user_name}} {{user_pass}} {{myaccount}}</small><br>
<?php
$content = get_option('fw_email_content_customer_new_account');
wp_editor( $content, 'fw_email_content_customer_new_account', $settings = array('textarea_rows'=> '10') );
?>
</div>

<div class="tipomail">
<h3 class="titulo"><?=__( 'Reset password', 'woocommerce' )?></h3>
<small><?=__( 'Customer "reset password" emails are sent when customers reset their passwords.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_reset_password" name="fw_email_subject_customer_reset_password" value="<?php echo get_option('fw_email_subject_customer_reset_password'); ?>" /><br>
<small>Variables: {{blogname}} {{user_name}} {{user_pass}} {{myaccount}} {{reset_link}}</small><br>
<?php
$content = get_option('fw_email_content_customer_reset_password');
wp_editor( $content, 'fw_email_content_customer_reset_password', $settings = array('textarea_rows'=> '10') );
?>
</div>

<div class="tipomail">
<h3 class="titulo">Activation</h3>
<small>Sent after the user is approved internally and a link for generating a password is sent to him</small>
<input type="text" class="w100" id="fw_email_subject_gf_activated" name="fw_email_subject_gf_activated" value="<?php echo get_option('fw_email_subject_gf_activated'); ?>" /><br>
<small>Variables:{user:user_login} {activation_url}</small>
<?php
$content = get_option('fw_email_content_gf_activated');
wp_editor( $content, 'fw_email_content_gf_activated', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>
<div id="customer_emails" class="tabcontent">
<div class="tipomail">
<h3 class="titulo"><?=__( 'Processing order', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing order details after payment.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_processing_order" name="fw_email_subject_customer_processing_order" value="<?php echo get_option('fw_email_subject_customer_processing_order'); ?>" /><br>

<?php
$content = get_option('fw_email_content_customer_processing_order');
wp_editor( $content, 'fw_email_content_customer_processing_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Completed order', 'woocommerce' )?></h3>
<small><?=__( 'Order complete emails are sent to customers when their orders are marked completed and usually indicate that their orders have been shipped.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_completed_order" name="fw_email_subject_customer_completed_order" value="<?php echo get_option('fw_email_subject_customer_completed_order'); ?>" /><br>

<?php
$content = get_option('fw_email_content_customer_completed_order');
wp_editor( $content, 'fw_email_content_customer_completed_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Order on-hold', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing order details after an order is placed on_hold.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_on_hold_order" name="fw_email_subject_customer_on_hold_order" value="<?php echo get_option('fw_email_subject_customer_on_hold_order'); ?>" /><br>

<?php
$content = get_option('fw_email_content_customer_on_hold_order');
wp_editor( $content, 'fw_email_content_customer_on_hold_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<?php

if(fw_theme_mod('fw_trans_comprobantes') && fw_theme_mod('fw_trans_comprobantes_id')){
?>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Falta verificación', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing information about uploading the file.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_await_verif_order" name="fw_email_subject_customer_await_verif_order" value="<?php echo get_option('fw_email_subject_customer_await_verif_order'); ?>" /><br>

<?php
$content = get_option('fw_email_content_customer_await_verif_order');
wp_editor( $content, 'fw_email_content_customer_await_verif_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<?php } ?>

</div>

<div id="wholesale" class="tabcontent">
<div class="tipomail">
<h3 class="titulo">Form Confirmation Page</h3>
<small>The message that is presented after completing the form</small>
<?php
$content = get_option('fw_email_content_confirmation_wholesale_form');
wp_editor( $content, 'fw_email_content_confirmation_wholesale_form', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo">User Pending</h3>
<small>Sent after the user completes the wholesale form</small>
<input type="text" class="w100" id="fw_email_subject_gf_pending" name="fw_email_subject_gf_pending" value="<?php echo get_option('fw_email_subject_gf_pending'); ?>" /><br>
<?php
$content = get_option('fw_email_content_gf_pending');
wp_editor( $content, 'fw_email_content_gf_pending', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>
<div id="admin_emails" class="tabcontent">
<?=$customer_emails_vars;?>
<!--NEW ORDER ADMIN -->
<div class="tipomail">
<h3 class="titulo"><?=__( 'New order', 'woocommerce' )?></h3>
<small><?=__( 'New order emails are sent to chosen recipient(s) when a new order is received.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_admin_new_order" name="fw_email_subject_admin_new_order" value="<?php echo get_option('fw_email_subject_admin_new_order'); ?>" /><br>

<?php
$content = get_option('fw_email_content_admin_new_order');
wp_editor( $content, 'fw_email_content_admin_new_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>
<div id="other" class="tabcontent">
<!--THANK YOU PAGE-->
<div class="tipomail">
<h3 class="titulo">Thank you page</h3>
<small>Texto que aparece luego de la pagina de compra</small>

<?php
$content = get_option('fw_email_content_thankyou');
wp_editor( $content, 'fw_email_content_thankyou', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo">Product info</h3>
<small>Texto informativo aparece en cada producto, debajo del boton de compra</small>
<small></small>
<?php
$content = get_option('fw_email_content_product_summary');
wp_editor( $content, 'fw_email_content_product_summary', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>



<?php submit_button(); ?>
</form>
</div>
<style>
.tipomail{

margin-bottom:20px;
}
input.w100{
width:100%;
}
h3.titulo{
margin-top:20px;
margin-bottom:0px;
}
</style>
<?php
} 

?>
