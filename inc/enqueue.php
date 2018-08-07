<?php

if ( ! function_exists( 'understrap_scripts' ) ) {
	function understrap_scripts() {
		$the_theme = wp_get_theme();
		global $redux_demo;
		wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
		wp_enqueue_style('awesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/theme.css');
		wp_enqueue_style( 'owl-styles', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
			
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/assets/js/fastway.js', array(), $the_theme->get( '
			Version' ), true );
		wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/assets/js/popper.min.js', array(), $the_theme->get( 'Version' ), true );

		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'owl-scripts', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), $the_theme->get( 'Version' ), true );

		wp_localize_script( 'theme-scripts', 'ajaxurl', admin_url( 'admin-ajax.php' ),1 );	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} 
add_action( 'wp_enqueue_scripts', 'understrap_scripts' );


