<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}


define( '__WSC_PLUGIN_PATH__', plugin_dir_url( __FILE__ ) );


if ( ! class_exists( __CLASS__ ) ) {

	class Woo_Shipping_Calculator {

		public function __construct() {

			add_action('wp', array($this,'init'));
				

			include_once dirname( __FILE__ ) . '/includes/ajax-postcode.class.php';
		}

		public function init() {

			if( is_product() && 'yes' == get_option('wscip_show_calculate','yes') ):			
				
				include_once dirname( __FILE__ ) . '/includes/frontend.class.php';

				include_once dirname( __FILE__ ) . '/includes/shortcode.class.php';				
			
			endif;
		}

		public function Woo_Shipping_dependecy_notice() {

			$class = 'notice notice-error is-dismissible';		

			$message = __( 'Atenção! O plugin WC Correios é necessário para que WooCommerce Correios Shipping Calculator in Product funcione', '' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
		}
	}

	new Woo_Shipping_Calculator;
}
