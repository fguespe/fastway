<?php
/**
 * Lost password form
 * Updated for Understrap to maintain Woocommerce 3.0.3 compatability.
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 	3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Perdiste tu contraseńa? Por favor ingresá tu nombre de usuario o email y recibirás un link para reiniciarla.', 'woocommerce' ) ); ?></p>

	<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
		<label for="user_login"><?php _e( 'Usuario o email', 'woocommerce' ); ?></label>
		<input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="text" name="user_login" id="user_login" />
	</p>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<input type="submit" class="btn " value="<?php esc_attr_e( 'Resetear Contraseña', 'woocommerce' ); ?>" />
	</p>

	<?php wp_nonce_field( 'lost_password' ); ?>

</form>
