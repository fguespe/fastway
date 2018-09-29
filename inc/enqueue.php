<?php

if ( ! function_exists( 'fw_scripts' ) ) {
	function fw_scripts() {
		
		wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
		wp_enqueue_style( 'awesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/theme.min.css');
		wp_enqueue_style( 'owl-styles', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
			
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/assets/js/fastway.min.js', array(), true );
		wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/assets/js/popper.min.js', array(),  true );

		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(),  true );
		wp_enqueue_script( 'owl-scripts', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), true );

		wp_localize_script( 'theme-scripts', 'ajaxurl', admin_url( 'admin-ajax.php' ),1 );	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} 
add_action( 'wp_enqueue_scripts', 'fw_scripts' );


function admincustojs(){
	wp_enqueue_script( 'custo-scripts', get_template_directory_uri() . '/assets/js/fw-customizer.js', array(), true );

}
add_action( 'customize_preview_init', 'admincustojs' );