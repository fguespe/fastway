<?php

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); 

$html =get_option('fw_email_content_customer_reset_password');

$emailValues = array(
    'blogname' => $blogname,
    'user_name' => esc_html( $user_login ),
    'user_pass' => esc_html( $user_pass) ,
    'reset_link' => "<a class=\"link\" href=\"".esc_url( add_query_arg( array( 'key' => $reset_key, 'id' => $user_id ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) )."\">".esc_html_e( 'Click here to reset your password', 'woocommerce' )."</a>"
);

foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
echo wp_kses_post( wpautop( wptexturize($html)));


?>
