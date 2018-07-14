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
		global $redux_demo;
		wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
		wp_enqueue_style('awesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');

		wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/theme.css');
		wp_enqueue_style( 'front-styles', get_template_directory_uri() . '/assets/css/headers.css');
		wp_enqueue_style( 'megamenu-styles', get_template_directory_uri() . '/assets/css/hs.megamenu.css');
			
		wp_enqueue_style( 'custombox-styles', get_template_directory_uri() . '/assets/css/custombox.min.css');
		wp_enqueue_style( 'scrollbar-styles', get_template_directory_uri() . '/assets/css/jquery.mCustomScrollbar.css');

		wp_enqueue_style( 'animate-styles', get_template_directory_uri() . '/assets/css/animate.min.css');
			
			
		wp_enqueue_script( 'jquery');



		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/assets/js/fastway.js', array(), $the_theme->get( '
			Version' ), true );
		
		wp_enqueue_script( 'jquery-scripts', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'migrate-scripts', get_template_directory_uri() . '/assets/js/jquery-migrate.min.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), $the_theme->get( 'Version' ), true );

		
		
		//if($redux_demo['header-mobile-style']=="header-tablet-2.php"){
		
		wp_enqueue_script( 'megamenu-scripts', get_template_directory_uri() . '/assets/js/hs.megamenu.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'scrollbar-scripts', get_template_directory_uri() . '/assets/js/jquery.mCustomScrollbar.concat.min.js', array(), $the_theme->get( 'Version' ), true );
		
		wp_enqueue_script( 'validate-scripts', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'minicart-script', get_template_directory_uri() . '/assets/js/mini-cart.js', array(), $the_theme->get( 'Version' ), true );
		
		wp_enqueue_script( 'hscore-scripts', get_template_directory_uri() . '/assets/js/hs.core.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsheader-scripts', get_template_directory_uri() . '/assets/js/hs.header.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsunfold-scripts', get_template_directory_uri() . '/assets/js/hs.unfold.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsfocus-scripts', get_template_directory_uri() . '/assets/js/hs.focus-state.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsmalihu-scripts', get_template_directory_uri() . '/assets/js/hs.malihu-scrollbar.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsvalidation-scripts', get_template_directory_uri() . '/assets/js/hs.validation.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsshowanimation-scripts', get_template_directory_uri() . '/assets/js/hs.show-animation.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'hsgoto-scripts', get_template_directory_uri() . '/assets/js/hs.go-to.js', array(), $the_theme->get( 'Version' ), true );
		
		wp_enqueue_script( 'appear-scripts', get_template_directory_uri() . '/assets/js/appear.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'showwindow-scripts', get_template_directory_uri() . '/assets/js/hs.modal-window.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'custombox-scripts', get_template_directory_uri() . '/assets/js/custombox.min.js', array(), $the_theme->get( 'Version' ), true );





		


		wp_localize_script( 'theme-scripts', 'ajaxurl', admin_url( 'admin-ajax.php' ),1 );	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} 
add_action( 'wp_enqueue_scripts', 'understrap_scripts' );


