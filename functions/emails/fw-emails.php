<?php


//generate username for gravity forms
add_filter( 'gform_username', 'fw_auto_username', 10, 4 );
function fw_auto_username( $username, $feed, $form, $entry ) {
    $username=str_replace(' ', '', $username);
	//$username = strtolower( rgar( $entry, '2.3' ) . rgar( $entry, '2.6' ) );
	$username = sanitize_user( current( explode( '@', $username ) ), true );
	
	if ( empty( $username ) ) {
		return $username;
	}
	
	if ( ! function_exists( 'username_exists' ) ) {
		require_once( ABSPATH . WPINC . '/registration.php' );
    }
	if ( username_exists( $username ) ) {
		$i = 2;
		while ( username_exists( $username . $i ) ) {
			$i++;
		}
		$username = $username . $i;
	};
	
	return $username;
}

// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
function wpb_sender_email( $original_email_address ) {
    return getMailQueEnvia();
}
 
// Function to change sender name
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );
function wpb_sender_name( $original_email_from ) {
    return getNombreQueEnvia();
}



add_filter( 'woocommerce_email_recipient_backorder', 'change_stock_email_recipient', 10, 2 ); // For Backorders notification
add_filter( 'woocommerce_email_recipient_low_stock', 'change_stock_email_recipient', 10, 2 ); // For Low stock notification
add_filter( 'woocommerce_email_recipient_no_stock', 'change_stock_email_recipient', 10, 2 ); // For No stock notification
add_filter('woocommerce_email_recipient_new_order', 'orden_nueva', 1, 2);
add_filter('woocommerce_email_recipient_failed_order', 'email_orden_cancelada', 1, 2);
add_filter('woocommerce_email_recipient_cancelled_order', 'email_orden_fallida', 1, 2);

/*
if(isLocalhost()){
    //On plugin activation schedule our daily database backup 
    register_activation_hook( __FILE__, 'wi_create_daily_backup_schedule' );
    function wi_create_daily_backup_schedule(){
    //Use wp_next_scheduled to check if the event is already scheduled
    $timestamp = wp_next_scheduled( 'wi_create_daily_backup' );

    //If $timestamp == false schedule daily backups since it hasn't been done previously
    if( $timestamp == false ){
        //Schedule the event for right now, then to repeat daily using the hook 'wi_create_daily_backup'
        wp_schedule_event( time(), 'daily', 'wi_create_daily_backup' );
    }
    }

    //Hook our function , wi_create_backup(), into the action wi_create_daily_backup
    add_action( 'wi_create_daily_backup', 'wi_create_backup' );
    function wi_create_backup(){
        $prod = wc_get_product(14);
        $prod->set_stock(20);
        error_log('se desconto stock a 20');
    }

    register_activation_hook( __FILE__, 'my_activation' );
    function my_activation() {
        wp_schedule_event( time(), 'hourly', 'my_hourly_event' );
    }
    add_action( 'my_hourly_event', 'do_this_hourly' );
    function do_this_hourly() {
        $prod = wc_get_product(14);
        $prod->set_stock(20);
        error_log('se desconto stock a 20');
    }
}*/

//config mails

function getMailQueEnvia(){
    if(fw_theme_mod("fw_general_from_email"))return fw_theme_mod("fw_general_from_email");
    else if(count(explode(",",fw_theme_mod("fw_mail_desde_mails")))>1){
        return explode(",",fw_theme_mod("fw_mail_desde_mails"))[0];
    }else return fw_theme_mod("fw_mail_desde_mails");
}

function getNombreQueEnvia(){
    if(fw_theme_mod("fw_general_from_name"))return fw_theme_mod("fw_general_from_name");
    else return fw_theme_mod("fw_mail_desde_nombre");
}
//Fixes mails
/*
$fix=get_option('fw_email_content_thankyou');
$fix=str_replace("{{email}}","{{customer_email}}",$fix);
update_option('fw_email_content_thankyou',$fix);
if(get_locale()=='es_ES'){
    
    update_option( 'fw_email_content_confirmation_wholesale_form', '¡Gracias por contactar con nosotros! 

    Nos pondremos en contacto contigo muy pronto.
    ');

    update_option( 'fw_email_content_gf_activated', 'Tu cuenta ya esta lista

    Para activarla entra al siguiente link: <a href="{{activation_url}}">LINK</a>');

}

if(get_locale()=='es_ES'){
    update_option( 'fw_email_content_gf_activated', 'Tu cuenta ya esta lista

    Para activarla entra al siguiente link: <a href="{{activation_url}}">LINK</a>');

}
set_theme_mod('fw_general_from_name','');
set_theme_mod('fw_general_from_email','');
set_theme_mod('fw_action_resetmails',true);*/

if(fw_theme_mod("fw_action_resetmails")){
    
    update_option("woocommerce_new_order_recipient",fw_theme_mod("fw_mail_desde_mails"));
    update_option("woocommerce_cancelled_order_recipient",fw_theme_mod("fw_mail_desde_mails"));
    update_option("woocommerce_failed_order_recipient",fw_theme_mod("fw_mail_desde_mails"));
    
    update_option("woocommerce_product_enquiry_send_to",fw_theme_mod("fw_mail_desde_mails"));
    update_option("woocommerce_stock_email_recipient",fw_theme_mod("fw_mail_desde_mails"));
     
    update_option("sendgrid_from_email",getMailQueEnvia());
    update_option("woocommerce_email_from_address",getMailQueEnvia());
     
    update_option("woocommerce_email_from_name",getNombreQueEnvia());
    update_option("sendgrid_from_name",getNombreQueEnvia());

    
     //Mail woocommerce
    update_option("woocommerce_email_header_image",fw_theme_mod('fw-email-logo')?fw_theme_mod('fw-email-logo'):fw_theme_mod('general-logo') );
    update_option("woocommerce_email_footer_text","Powered by Altoweb");
    update_option("woocommerce_email_base_color",fw_theme_mod('opt-color-main'));


    set_theme_mod('fw_action_resetmails',false);

}


function change_stock_email_recipient( $recipient, $product ) {
    $recipients = ", ".fw_theme_mod("fw_mail_desde_mails");
    return $recipients;
}
function orden_nueva( $recipient, $order ) {
    $recipients = ", ".fw_theme_mod("fw_mail_desde_mails");
    return $recipients;
}

function email_orden_cancelada( $recipient, $order ) {
    $recipients = ", ".fw_theme_mod("fw_mail_desde_mails");
    return $recipients;
}

function email_orden_fallida( $recipient, $order ) {
    $recipients = ", ".fw_theme_mod("fw_mail_desde_mails");
    return $recipients;
}


// The email function hooked that display the text
add_action( 'woocommerce_email_order_details', 'fw_display_applied_coupons', 10, 4 );
function fw_display_applied_coupons( $order, $sent_to_admin, $plain_text, $email ) {
    $coupon_codes=[];
    // Only for admins and when there at least 1 coupon in the order
    if ( ! $sent_to_admin && count($order->get_items('coupon') ) == 0 ) return;

    foreach( $order->get_items('coupon') as $coupon ){
        $coupon_codes[] = $coupon->get_code();
    }
    // For one coupon
    if( count($coupon_codes) == 1 ){
        $coupon_code = reset($coupon_codes);
        echo '<p>'.__( 'Código ').$coupon_code.'<p>';
    } 
    // For multiple coupons
    else if(count($coupon_codes) >1) {
        $coupon_codes = implode( ', ', $coupon_codes);
        echo '<p>'.__( 'Códigos: ').$coupon_codes.'<p>';
    }
}



function fw_parse_subject($tipo,$emailValues){
    $subject=get_option('fw_email_subject_'.$tipo);
    foreach ($emailValues as $key => $value) $subject = str_replace("{{". $key . "}}", $value, $subject);
    return $subject;
}

function fw_parse_mail_accounts($tipo,$emailValues){
  $html=get_option('fw_email_content_'.$tipo);
  $html=conditionals($html,$emailValues);
  foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
  return wp_kses_post( wpautop( wptexturize($html)));

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
    $customer_name=$order->billing_first_name.' '.$order->billing_last_name;

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
        'customer_email' => $order->billing_email,
        'customer_name' => $customer_name,
        'customer_details' => $customer_details
    );
}
add_shortcode('fw_email_content_confirmation_wholesale_form','fw_email_content_confirmation_wholesale_form');
function fw_email_content_confirmation_wholesale_form(){
  return get_option('fw_email_content_confirmation_wholesale_form');
}   
function get_account_variables_for_templates($user=null,$u_login=null,$key=null){
  global $woocommerce;
  if($user){
    $key = get_password_reset_key( $user );
    $activation_url=network_site_url("wp-login.php?action=rp&key=".$key."&login=" . rawurlencode($user_login), 'login') ;
    $user_login=$user->user_login;
    $user_pass=$user->user_pass;
  }else{//activation por wpmu
    $activation_url=site_url( "wp-activate.php?key=$key" );
    if(!$user_login && $u_login)$user_login=$u_login;
  }
  $emailValues = array(
    'blogname' => get_bloginfo('name'),
    'user_name' => esc_html( $user_login),
    'user_pass' => esc_html( $user_pass),
    'myaccount' => make_clickable( esc_url( wc_get_page_permalink('myaccount'))),
    'activation_url'=> $activation_url
  );
  return $emailValues;
}

add_filter('woocommerce_email_subject_customer_reset_password', 'woocommerce_email_subject_customer_reset_password', 1, 2);
function woocommerce_email_subject_customer_reset_password( $subject, $order ) {
    return fw_parse_subject('customer_reset_password',get_account_variables_for_templates());
}

add_filter('woocommerce_email_subject_customer_new_account', 'woocommerce_email_subject_customer_new_account', 1, 2);
function woocommerce_email_subject_customer_new_account( $subject, $order ) {
  return fw_parse_subject('customer_new_account',get_account_variables_for_templates());
}
//ORDERs
add_filter('woocommerce_email_subject_customer_completed_order', 'woocommerce_email_subject_customer_completed_order', 1, 2);
function woocommerce_email_subject_customer_completed_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('customer_completed_order',$order);
}

add_filter('woocommerce_email_subject_customer_on_hold_order', 'woocommerce_email_subject_customer_on_hold_order', 1, 2);
function woocommerce_email_subject_customer_on_hold_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('customer_on_hold_order',$order);
}

add_filter('woocommerce_email_subject_customer_processing_order', 'woocommerce_email_subject_customer_processing_order', 1, 2);
function woocommerce_email_subject_customer_processing_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('customer_processing_order',$vars);
}

add_filter('woocommerce_email_subject_admin_new_order', 'woocommerce_email_subject_admin_new_order', 1, 2);
function woocommerce_email_subject_admin_new_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('admin_new_order',$vars);
}



//Emails
//Este se manda para los aprovaciones del formulario
add_filter( 'wp_new_user_notification_email' , 'edit_user_notification_email', 10, 3 );
function edit_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
    
    $wp_new_user_notification_email['message'] =  fw_parse_mail_accounts('gf_activated',get_account_variables_for_templates($user));
    $wp_new_user_notification_email['subject'] = get_option('fw_email_subject_gf_activated');
    $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
    return $wp_new_user_notification_email;
}

//Este se manda creando un nuevo usuario desde el admin
add_filter( 'wpmu_signup_user_notification', 'edit_user_notification_email2', 10, 4 );
function edit_user_notification_email2($user_login, $user_email, $key, $meta = '') {
        $wp_new_user_notification_email=[];
        $wp_new_user_notification_email['message'] =  fw_parse_mail_accounts('gf_activated',get_account_variables_for_templates(null,$user_login,$key));
        $wp_new_user_notification_email['subject'] = get_option('fw_email_subject_gf_activated');
        $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
        //$wp_new_user_notification_email['headers'] = array('From: "'.getNombreQueEnvia().'" <'.getMailQueEnvia().'>','Content-Type: text/html; charset=UTF-8');
        error_log(print_r($wp_new_user_notification_email,true));
        wp_mail($user_email, $wp_new_user_notification_email['subject'], $wp_new_user_notification_email['message'], $wp_new_user_notification_email['headers']);
        return false;
}
    
//Este se manda creando un nuevo usuario desde el admin y dps de activar la cuenta
add_filter( 'wpmu_welcome_user_notification', 'edit_user_notification_email3', 10, 3 );
function edit_user_notification_email3($user_id, $password, $meta = '') {
        $user = new WP_User($user_id);
        $user->user_pass=$password;
        $wp_new_user_notification_email=[];
        //$message_headers = "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
        $wp_new_user_notification_email['message'] =  fw_parse_mail_accounts('customer_new_account',get_account_variables_for_templates($user));
        $wp_new_user_notification_email['subject'] = get_option('fw_email_subject_customer_new_account');
        $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
        //$wp_new_user_notification_email['headers'] = array('From: "'.getNombreQueEnvia().'" <'.getMailQueEnvia().'>','Content-Type: text/html; charset=UTF-8');
        wp_mail($user->user_email, $wp_new_user_notification_email['subject'], $wp_new_user_notification_email['message'], $wp_new_user_notification_email['headers']);
        return false;
}

add_filter( 'gform_notification', 'change_autoresponder_email', 10, 3 );
function change_autoresponder_email( $notification, $form, $entry ) {

    if ( $notification['name'] == 'User Pending' ) {
        $notification['message'] =  wp_kses_post( wpautop( wptexturize(get_option('fw_email_content_gf_pending'))));
        $notification['subject'] =  get_option('fw_email_subject_gf_pending');
    }else if ( $notification['name'] == 'User Activation' ) {
        $notification['message'] =  wp_kses_post( wpautop( wptexturize(get_option('fw_email_content_gf_activated'))));
        $notification['subject'] =  get_option('fw_email_subject_gf_activated');
    }else if ( ($notification['name'] == 'Admin Notification' || $notification['name'] == 'Notificación del administrador') && $notification['toType']=='email' ) {
      $notification['to'] =fw_theme_mod("fw_mail_desde_mails");
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