<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email ); 

add_filter('woocommerce_email_subject_customer_processing_order', 'woocommerce_email_subject_customer_processing_order', 1, 2);
function woocommerce_email_subject_customer_processing_order( $subject, $order ) {
    return get_option('fw_email_subject_customer_processing_order');
}
$html=get_option('fw_email_content_customer_processing_order');


//Generico orders
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

$shipping_method = @array_shift($order->get_shipping_methods());
$shipping_method_type = $shipping_method['method_id'];
$shipping_method_id = $shipping_method['instance_id'];
$shipping_method_title = $shipping_method['method_title'];

$the_user = get_user_by( 'id', $order->get_customer_id() ); // 54 is a user ID
$roles = ( array ) $the_user->roles;
$role=$roles[0];
if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest' )$role='minorista';

$emailValues = array(
    'blogname' => $blogname,
    'order_number' => '#'.$order->get_order_number(),
    'customer_name' => $order->billing_first_name ,
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
$html=conditionals($html,$emailValues);

foreach ($emailValues as $key => $value){
    $html = str_replace("{{". $key . "}}", $value, $html);
}
echo wp_kses_post( wpautop( wptexturize($html)));
