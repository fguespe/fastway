<?php

function myplugin_register_settings() {
add_option( 'fw_email_subject_customer_new_account', 'Tu cuenta esta lista');
add_option( 'fw_email_content_customer_new_account', 'Bienvenido a {{blogname}}

Gracias por crear una cuenta en nuestra web. Tu nombre de usuario es {{user_name}}
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



add_option( 'fw_email_subject_gf_pending', 'Nueva Solicitud');
add_option( 'fw_email_content_gf_pending', 'Recibimos tu solicitud. 

Estaremos evaluando tu solicitud y te avisaremos cuando te demos de alta.
');


add_option( 'fw_email_subject_gf_activated', 'Solicitud Aceptada');
add_option( 'fw_email_content_gf_activated', 'You\'re account is almost ready, 

To activate your account, please click the following link:

{activation_url}

After you activate, you will receive *another email* with your login.

Best
');

add_option( 'fw_email_content_confirmation_wholesale_form', '&nbsp;
<p style="text-align: center;">¡Gracias por contactar con nosotros!</p>
<p style="text-align: center;">Nos pondremos en contacto contigo muy pronto.</p>
&nbsp;');


add_option( 'fw_email_content_thankyou', '
<h2>Gracias por tu compra</h2>

<p>El pedido fue registrado con número {{order_number}}</p>

<span>Te enviamos un mail a <b>{{email}}</b> con el detalle y las instrucciones de como seguir.</span>
');


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

}

add_action( 'admin_init', 'myplugin_register_settings' );

function myplugin_register_options_page() {
add_options_page('Email Templates', 'Email Templates', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');



function myplugin_options_page(){
$order_variables='<small>Variables: {{blogname}} {{customer_name}} {{order_number}} {{order_details}} {{order_meta}} {{customer_details}} {{shipping_method_title}} {{shipping_method_type}} {{shipping_method_id}} {{payment_method_id}} {{payment_method_title}} </small>';

?>
<div>

<style>

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
<form method="post" action="options.php">
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

</div>
<div id="customer_emails" class="tabcontent">
<div class="tipomail">
<h3 class="titulo"><?=__( 'Processing order', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing order details after payment.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_processing_order" name="fw_email_subject_customer_processing_order" value="<?php echo get_option('fw_email_subject_customer_processing_order'); ?>" /><br>
<?=$order_variables;?>
<?php
$content = get_option('fw_email_content_customer_processing_order');
wp_editor( $content, 'fw_email_content_customer_processing_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Completed order', 'woocommerce' )?></h3>
<small><?=__( 'Order complete emails are sent to customers when their orders are marked completed and usually indicate that their orders have been shipped.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_completed_order" name="fw_email_subject_customer_completed_order" value="<?php echo get_option('fw_email_subject_customer_completed_order'); ?>" /><br>
<?=$order_variables ?>
<?php
$content = get_option('fw_email_content_customer_completed_order');
wp_editor( $content, 'fw_email_content_customer_completed_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Order on-hold', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing order details after an order is placed on_hold.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_on_hold_order" name="fw_email_subject_customer_on_hold_order" value="<?php echo get_option('fw_email_subject_customer_on_hold_order'); ?>" /><br>
<?=$order_variables?>
<?php
$content = get_option('fw_email_content_customer_on_hold_order');
wp_editor( $content, 'fw_email_content_customer_on_hold_order', $settings = array('textarea_rows'=> '10') );
?>
</div>

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
<div id="admin_emails" class="tabcontent">
<!--NEW ORDER ADMIN -->
<div class="tipomail">
<h3 class="titulo"><?=__( 'New order', 'woocommerce' )?></h3>
<small><?=__( 'New order emails are sent to chosen recipient(s) when a new order is received.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_admin_new_order" name="fw_email_subject_admin_new_order" value="<?php echo get_option('fw_email_subject_admin_new_order'); ?>" /><br>
<?=$order_variables?>
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
<small>Variables: {{email}}</small>
<?php
$content = get_option('fw_email_content_thankyou');
wp_editor( $content, 'fw_email_content_thankyou', $settings = array('textarea_rows'=> '10') );
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


function fw_parse_subject($tipo,$order){
    $subject=get_option('fw_email_subject_'.$tipo);
    $emailValues = fw_get_email_variables($order);
    foreach ($emailValues as $key => $value) $subject = str_replace("{{". $key . "}}", $value, $subject);
    return $subject;
}
function fw_parse_mail($tipo,$order, $sent_to_admin=false, $plain_text=false,$email_heading=false,$email=false){
    do_action( 'woocommerce_email_header', $email_heading, $email ); 
    $emailValues = fw_get_email_variables($order, $sent_to_admin, $plain_text, $email);

    $html=get_option('fw_email_content_'.$tipo);

    $html=conditionals($html,$emailValues);
    foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
    echo wp_kses_post( wpautop( wptexturize($html)));
}
function fw_get_email_variables($order, $sent_to_admin=false, $plain_text=false, $email=false){

    if($sent_to_admin || $plain_text || $email){
        ob_start();
        do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
        $order_details = ob_get_contents();
        ob_end_clean();
    
        ob_start(); 
        do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
        $order_meta = ob_get_contents();
        ob_end_clean();
    
        ob_start();
        do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
        $customer_details = ob_get_contents();
        ob_end_clean();
    }

    $shipping_method = @array_shift($order->get_shipping_methods());
    $shipping_method_type = $shipping_method['method_id'];
    $shipping_method_id = $shipping_method['instance_id'];
    $shipping_method_title = $shipping_method['method_title'];

    $the_user = get_user_by( 'id', $order->get_customer_id() ); // 54 is a user ID
    $roles = ( array ) $the_user->roles;
    $role=$roles[0];
    if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest' )$role='minorista';

    return array(
        'blogname' => get_bloginfo( 'name' ),
        'email' => '<a href="mailto:'.fw_theme_mod('fw_mail_desde_mails').'">'.fw_theme_mod('fw_mail_desde_mails').'</a>',
        'order_number' => '#'.$order->get_order_number(),
        'shipping_tracking_url' => '<a target="_blank" href="'.$order->get_meta('_tracking_url').'">'.$order->get_meta('_tracking_url').'</a>' ,
        'shipping_method_title' => $shipping_method_title,
        'shipping_method_type' => $shipping_method_type,
        'shipping_method_id' => $shipping_method_id,
        'payment_method_id' => $order->payment_method,
        'payment_method_title' => $order->payment_method_title,
        'order_details' => $order_details,
        'role' => $role,
        'real_role' => $roles[0],
        'order_meta' => $order_meta,
        'customer_details' => $customer_details
    );
}
add_shortcode('fw_email_content_confirmation_wholesale_form','fw_email_content_confirmation_wholesale_form');
function fw_email_content_confirmation_wholesale_form(){
  return get_option('fw_email_content_confirmation_wholesale_form');
}   

add_filter('woocommerce_email_subject_customer_reset_password', 'woocommerce_email_subject_customer_reset_password', 1, 2);
function woocommerce_email_subject_customer_reset_password( $subject, $order ) {
    return get_option('fw_email_subject_customer_reset_password');
}
add_filter('woocommerce_email_subject_customer_new_account', 'woocommerce_email_subject_customer_new_account', 1, 2);
function woocommerce_email_subject_customer_new_account( $subject, $order ) {
    return get_option('fw_email_subject_customer_new_account');
}
//ORDERs
add_filter('woocommerce_email_subject_customer_completed_order', 'woocommerce_email_subject_customer_completed_order', 1, 2);
function woocommerce_email_subject_customer_completed_order( $subject, $order ) {
    return fw_parse_subject('customer_completed_order',$order);
}

add_filter('woocommerce_email_subject_customer_on_hold_order', 'woocommerce_email_subject_customer_on_hold_order', 1, 2);
function woocommerce_email_subject_customer_on_hold_order( $subject, $order ) {
    return fw_parse_subject('customer_on_hold_order',$order);
}

add_filter('woocommerce_email_subject_customer_processing_order', 'woocommerce_email_subject_customer_processing_order', 1, 2);
function woocommerce_email_subject_customer_processing_order( $subject, $order ) {
    return fw_parse_subject('customer_processing_order',$order);
}

add_filter('woocommerce_email_subject_admin_new_order', 'woocommerce_email_subject_admin_new_order', 1, 2);
function woocommerce_email_subject_admin_new_order( $subject, $order ) {
    return fw_parse_subject('admin_new_order',$order);
}

add_filter( 'gform_notification', 'change_autoresponder_email', 10, 3 );
function change_autoresponder_email( $notification, $form, $entry ) {
    error_log(print_r($notification,true));

    if ( $notification['name'] == 'User Pending' ) {
        $notification['message'] =  wp_kses_post( wpautop( wptexturize(get_option('fw_email_content_gf_pending'))));
        $notification['subject'] =  get_option('fw_email_subject_gf_pending');
    }else if ( $notification['name'] == 'User Activation' ) {
        $notification['message'] =  wp_kses_post( wpautop( wptexturize(get_option('fw_email_content_gf_activated'))));
        $notification['subject'] =  get_option('fw_email_subject_gf_activated');
    }
 
    return $notification;
}

function conditionals($template,$data) {
$conditionals=array();

if (preg_match_all('#'.'{{'.'if (.+)'.'}}'.'(.+)'.'{{'.'/if'.'}}'.'#sU', $template, $conditionals, PREG_SET_ORDER)) {

if(count($conditionals) > 0) {

foreach($conditionals AS $condition) {

$raw_code = (isset($condition[0])) ? $condition[0] : FALSE;
$cond_str = (isset($condition[1])) ? $condition[1] : FALSE;
$insert = (isset($condition[2])) ? $condition[2] : '';

if(!preg_match('/('.'{{'.'|'.'}}'.')/', $cond_str, $problem_cond)) {
// If the the conditional statment is formated right, lets procoess it!
if(!empty($raw_code) OR $cond_str != FALSE OR !empty($insert)) {
// Get the two values
$cond = preg_split("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str);

// Do we have a valid if statment?
if(count($cond) == 2) {
 
// Get condition
preg_match("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str, $cond_m);
array_push($cond, $cond_m[0]);

// Remove quotes - they cause to many problems! 
$cond[0]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[0]))); 
$cond[1]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[1])));

// Test condition
eval("\$result = (\"".$data[$cond[0]]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");

error_log("\$result = (\"".$data[$cond[0]]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");
} else {
error_log('jaja');
// Looks like a if 'variable' conditional, let's make sure the variable is set

/*if (isset($data->$cond_str)) {
// Check the variable isn't empty...
if (!empty($data->$cond_str)) {
// This adds support for using {if var}then this{/if}
$result = TRUE;
} else {
 $result = FALSE;
}
} else {
$result = FALSE;
}*/

//$result = (isset($data->$cond_str)) ? TRUE : FALSE;

}
}

// If the condition is TRUE then show the text block
$insert = preg_split('#'.'{{'.'else'.'}}'.'#sU', $insert);
if($result == TRUE)
{
$template = str_replace($raw_code, $insert[0], $template);
} else {
// Do we have an else statment?
if(is_array($insert))
{
$insert = (isset($insert[1])) ? $insert[1] : '';
$template = str_replace($raw_code, $insert, $template);
} else {
$template = str_replace($raw_code, '', $template);
}
}
} elseif(!$show_errors) {
// Remove any if statments we can't process
$template = str_replace($raw_code, '', $template);
}
 
}

}
}
return $template;
}

?>
