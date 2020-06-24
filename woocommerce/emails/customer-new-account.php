<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
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

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); 

add_filter('woocommerce_email_subject_customer_new_account', 'woocommerce_email_subject_customer_new_account', 1, 2);
function woocommerce_email_subject_customer_new_account( $subject, $order ) {
    return get_option('fw_email_subject_customer_new_account');
}
$html =get_option('fw_email_content_customer_new_account');

$emailValues = array(
    'blogname' => $blogname,
    'user_name' => esc_html( $user_login ),
    'user_pass' => esc_html( $user_pass) ,
    'myaccount' => make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) )
);

foreach ($emailValues as $key => $value) {
    $html = str_replace("{{". $key . "}}", $value, $html);
}
echo wp_kses_post( wpautop( wptexturize($html)));


?>

