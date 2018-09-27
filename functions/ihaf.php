<?php
		
add_action( 'wp_head','ihaf_frontendHeader'  );
add_action( 'wp_footer','ihaf_frontendFooter'  );
function ihaf_frontendHeader() {ihaf_output( 'header-insert');}
function ihaf_frontendFooter() {ihaf_output( 'footer-insert');}


/**
* Outputs the given setting, if conditions are met
*
* @param string $setting Setting Name
* @return output
*/
function ihaf_output( $setting ) {


	// Ignore admin, feed, robots or trackbacks
	if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
		return;
	}
	// Get meta
	$meta = wp_unslash(fw_theme_mod($setting));
	if ( empty( $meta ) ) {
		return;
	}
	if ( trim( $meta ) == '' ) {
		return;
	}
	// Output
	echo wp_unslash( $meta );
}
?>