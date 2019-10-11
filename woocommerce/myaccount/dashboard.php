<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// define the woocommerce_account_dashboard callback 
function action_woocommerce_account_dashboard(  ) { 
   echo 'pepe';
}; 
         
// add the action 
add_action( 'woocommerce_account_dashboard', 'action_woocommerce_account_dashboard', 10, 0 ); 
?>

<h1>BIENVENIDO A <?php echo get_bloginfo('name');?></h1>
<p><?php echo fw_theme_mod('fw_welcome_msg')?></p>

<div class="d-flex align-items-center">
<a href="">VER PRODUCTOS</a> <a href="">CERRAR SESIÓN</a> 
</div>

<?php
	do_action( 'woocommerce_account_dashboard' );

	do_action( 'woocommerce_before_my_account' );

	do_action( 'woocommerce_after_my_account' );
