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
if(get_locale()=='es_ES'){
?>

<p>Bienvenido a <?php echo esc_html( $blogname )?><br><br>
Gracias por crear una cuenta en nuestra web. Tu nombre de usuario es <strong><?php echo esc_html( $user_login ) ?></strong><br>
Podés acceder a tu cuenta para ver pedidos, cambiar tu contraseña y más en: <br>
<?php echo make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ); ?><br><br>
<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>
Tu contraseña se generó automáticamente: <strong><?php echo esc_html( $user_pass ); ?><br></strong>
<?php endif; ?>
Pero podés cambiarla cuando quieras.<br><br>

¡Te esperamos! ;-)</p>

<?php

}else{ ?>

<p>Welcome to <?php echo esc_html( $blogname )?><br><br>
Thank you for signing up. Your user name is <strong><?php echo esc_html( $user_login ) ?></strong><br>
Podés acceder a tu cuenta para ver pedidos, cambiar tu contraseña y más en: <br>
<?php echo make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ); ?><br><br>
<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>
Tu contraseña se generó automáticamente: <strong><?php echo esc_html( $user_pass ); ?><br></strong>
<?php endif; ?>
Pero podés cambiarla cuando quieras.<br><br>

¡Te esperamos! ;-)</p>


<?php } ?>
<?php
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
