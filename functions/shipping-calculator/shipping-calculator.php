<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}


define( '__WSC_PLUGIN_PATH__', plugin_dir_url( __FILE__ ) );


if ( ! class_exists( __CLASS__ ) ) {

	class Woo_Shipping_Calculator {

		public function __construct() {

			if( isset( $_GET['page'] ) && $_GET['page'] == 'wc-settings' )
				add_action( 'admin_notices', array( __CLASS__,'plugin_donate') );

			add_action('wp', array($this,'init'));
				
			add_action('woocommerce_shipping_init', function(){

				include_once dirname( __FILE__ ) . '/includes/woo-settings.class.php';					
			});

			include_once dirname( __FILE__ ) . '/includes/ajax-postcode.class.php';
		}

		public function init() {

			if( is_product() && 'yes' == get_option('wscip_show_calculate','yes') ):			
				
				include_once dirname( __FILE__ ) . '/includes/frontend.class.php';

				include_once dirname( __FILE__ ) . '/includes/shortcode.class.php';				
			
			endif;
		}

		public function plugin_donate() {

			$class = 'notice notice-info is-dismissible to apply';

			$message = __( 'Está gostando de utilizar a Calculadora de Frete na Página do Produto? Me ajude a continuar criando novas soluções fazendo uma doação. <a href="https://pag.ae/bdv16S9" target="_blank"><img style="vertical-align: middle;margin-left: 15px;" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/184x42-doar-roxo-assina.gif"></a>', '' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message ); 
		}

		public function Woo_Shipping_dependecy_notice() {

			$class = 'notice notice-error is-dismissible';		

			$message = __( 'Atenção! O plugin WC Correios é necessário para que WooCommerce Correios Shipping Calculator in Product funcione', '' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
		}
	}

	new Woo_Shipping_Calculator;
}
