<?php 
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'Nexthemes_Shortcodes' ) ) :

class Nexthemes_Shortcodes extends Nexthemes_Woo_Shortcodes {

	public function init() {

		$shortcodes = array();
			
		if( fw_checkPlugin( 'woocommerce/woocommerce.php' ) ) {
			$woo_args = parent::shortcodeArgs();
			$shortcodes = array_merge( $shortcodes, $woo_args );
		}
		
		foreach ( $shortcodes as $shortcode => $function ) {
			
			add_shortcode( $shortcode, $function );
		}
		
	}
	
}

endif;