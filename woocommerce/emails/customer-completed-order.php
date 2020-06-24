<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email ); 

add_filter('woocommerce_email_subject_customer_completed_order', 'woocommerce_email_subject_customer_completed_order', 1, 2);
function woocommerce_email_subject_customer_completed_order( $subject, $order ) {
    return get_option('fw_email_subject_customer_completed_order');
}
$html =get_option('fw_email_content_customer_completed_order');




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
    'order_meta' => $order_meta,
    'customer_details' => $customer_details
);

$html=conditionals($html,$emailValues);
foreach ($emailValues as $key => $value){
    $html = str_replace("{{". $key . "}}", $value, $html);
}
echo wp_kses_post( wpautop( wptexturize($html)));