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
    return getMailQueEnvia();
}



add_filter( 'woocommerce_email_recipient_backorder', 'change_stock_email_recipient', 10, 2 ); // For Backorders notification
add_filter( 'woocommerce_email_recipient_low_stock', 'change_stock_email_recipient', 10, 2 ); // For Low stock notification
add_filter( 'woocommerce_email_recipient_no_stock', 'change_stock_email_recipient', 10, 2 ); // For No stock notification
add_filter('woocommerce_email_recipient_new_order', 'orden_nueva', 1, 2);
add_filter('woocommerce_email_recipient_failed_order', 'email_orden_cancelada', 1, 2);
add_filter('woocommerce_email_recipient_cancelled_order', 'email_orden_fallida', 1, 2);

//Emails
add_filter( 'wp_new_user_notification_email' , 'edit_user_notification_email', 10, 3 );

function edit_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

    $message = sprintf(__( "Welcome to %s! Here's how to log in:" ), $blogname ) . "\r\n";
    $message .= wp_login_url() . "\r\n";
    $message .= sprintf(__( 'Usernames: %s' ), $user->user_login ) . "\r\n";
    $message .= sprintf(__( 'Password: %s' ), $user->user_pass ) . "\r\n\r\n";
    $message .= sprintf(__( 'If you have any problems, please contact me at %s.'), get_option( 'admin_email' ) ) . "\r\n";
    $message .= __('Adios!');

    $wp_new_user_notification_email['message'] = $message;

    return $wp_new_user_notification_email;

}

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
    if(count(explode(",",fw_theme_mod("fw_mail_desde_mails")))>1){
        return explode(",",fw_theme_mod("fw_mail_desde_mails"))[0];
    }else return fw_theme_mod("fw_mail_desde_mails");
}

$fix=get_option('fw_email_content_thankyou');
$fix=str_replace("{{email}}","{{customer_email}}",$fix);
update_option('fw_email_content_thankyou',$fix);

set_theme_mod('fw_action_resetmails',true);


if(fw_theme_mod("fw_action_resetmails")){
    
    update_option("woocommerce_new_order_recipient",fw_theme_mod("fw_mail_desde_mails"));
    update_option("woocommerce_cancelled_order_recipient",fw_theme_mod("fw_mail_desde_mails"));
    update_option("woocommerce_failed_order_recipient",fw_theme_mod("fw_mail_desde_mails"));
    
    update_option("woocommerce_product_enquiry_send_to",fw_theme_mod("fw_mail_desde_mails"));
    update_option("woocommerce_stock_email_recipient",fw_theme_mod("fw_mail_desde_mails"));
     
    update_option("sendgrid_from_email",getMailQueEnvia());
    update_option("woocommerce_email_from_address",getMailQueEnvia());
     
    update_option("woocommerce_email_from_name",fw_theme_mod("fw_mail_desde_nombre"));
    update_option("sendgrid_from_name",fw_theme_mod("fw_mail_desde_nombre"));

    
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


add_filter( 'gform_notification', 'change_notification_email', 10, 3 );
function change_notification_email( $notification, $form, $entry ) {
    $notification['from'] = 'avisos@altoweb.co';
    $notification['fromName'] = 'ALTOWEB';
    if ( ($notification['name'] == 'Admin Notification' || $notification['name'] == 'Notificación del administrador') && $notification['toType']=='email' ) {
        $notification['to'] =fw_theme_mod("fw_mail_desde_mails");//;
    }
    return $notification;
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
?>