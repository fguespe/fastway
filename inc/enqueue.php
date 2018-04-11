<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme = wp_get_theme();
		wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $the_theme->get( 'Version' ) );
		wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/css/theme.css', array(), $the_theme->get( 'Version' ) );
		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap.min.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/fastway.js', array(), $the_theme->get( 'Version' ), true );
		//wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/jquery.autocomplete.min.js', array(), $the_theme->get( 'Version' ), true );

		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} 
add_action( 'wp_enqueue_scripts', 'understrap_scripts' );