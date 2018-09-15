<?php
global $theme_headers;
global $theme_headers_mobile ;
global $loop_templates ;
global $loop_templates_mobile;
global $single_templates;
global $single_templates_mobile;
function kirki_sidebars_select_example() { 
  	do_action('widgets_init');
 	$sidebars = array(); 
 	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) { 
 		$sidebars = $GLOBALS['wp_registered_sidebars']; 
 	} 
 	$sidebars_choices = array(); 
 	foreach ( $sidebars as $sidebar ) { 
 		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name']; 
 		
 	}  
 	    return $sidebars_choices; 
}  

$static_block_args = fastway_get_stblock();

Kirki::add_config( 'theme_config_id', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );


Kirki::add_panel( 'panel_fastway', array(

    'title'       => __( 'Fastway', 'textdomain' ),
    //'description' => __( 'My panel description', 'textdomain' ),
) );

Kirki::add_section( 'section_css', array(
    'title'          => __( 'CSS Live', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );


Kirki::add_section( 'section_general', array(
    'title'          => __( 'General', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_header', array(
    'title'          => __( 'Header', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_mobile', array(
    'title'          => __( 'Mobile', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_typos', array(
    'title'          => __( 'Typography', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_colors', array(
    'title'          => __( 'Color Scheme', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );


Kirki::add_section( 'section_footer', array(
    'title'          => __( 'Footer', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );

/*CSSs*/

Kirki::add_panel( 'panel_css', array(

    'title'       => __( 'Fastway Live CSS Editor', 'textdomain' ),
    //'description' => __( 'My panel description', 'textdomain' ),
) );
Kirki::add_section( 'section_css_general', array(
    'title'          => __( 'CSS General', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );

Kirki::add_section( 'section_css_header', array(
    'title'          => __( 'CSS Header', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_body', array(
    'title'          => __( 'CSS Body', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_footer', array(
    'title'          => __( 'CSS Footer', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_loop', array(
    'title'          => __( 'CSS Product Loop', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_single', array(
    'title'          => __( 'CSS Single Product ', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_sidebarcats', array(
    'title'          => __( 'CSS Sidebar Category ', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_css',

) );

Kirki::add_section( 'section_extras', array(
    'title'          => __( 'Extras', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_woo', array(
    'title'          => __( 'Woocommerce', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_woo_single', array(
    'title'          => __( 'Single Product', 'textdomain' ),
    //'description'    => __( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
  
) );

//General
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'general-logo',
	'label'       => __( 'Logo', 'textdomain' ),
	//'description' => __( 'Description Here.', 'textdomain' ),
	'section'     => 'section_general',
	'default'     => get_template_directory_uri()."/assets/img/logo.png",
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-desc',
	'label'       => __( 'Meta Description', 'textdomain' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_general',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-main',
	'label'       => __( 'Main layout: wide or boxed', 'textdomain' ),
	'section'     => 'section_general',
	'default'     => 'container',
	
	'choices'     => array(
		'container-fluid'   => 'Wide',
		'container'   => 'Boxed',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-main',
	'label'       => __( 'Sidebars Layout', 'textdomain' ),
	'section'     => 'section_general',
	'default'     => 'full',
	'choices'     => array(
		'full' => __( 'Full Width', 'textdomain' ),
		'left' => __( 'Left Sidebar', 'textdomain' ),
		'right' => __( 'Right Sidebar', 'textdomain' ),
		'both' => __( 'Both Sidebars', 'textdomain' ),
	),
) );

/*HEAADER*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'sticky-menu',
	'label'       => __( 'Deactivate Sticky', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => array('fw_header_middle', 'fw_header_bottom'),
	'choices'     => array(
		'fw_header_top' => __( 'Top', 'textdomain' ),
		'fw_header_middle' => __( 'Middle', 'textdomain' ),
		'fw_header_bottom' => __( 'Bottom', 'textdomain' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header-padding',
	'label'       => __( 'Header Padding', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => 1,
	'choices'     => array(
		'min'  => 0,
		'max'  => 4,
		'step' => 1,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'logo-width',
	'label'       => __( 'Logo Width', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => 180,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'top-header',
	'label'       => __( 'Top Header', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header-width',
	'label'       => __( 'Header Width', 'textdomain' ),
	'section'     => 'section_header',
	'choices'     => array(
		'container'   => __( 'Boxed', 'textdomain' ),
		'container-fluid' => __( 'Wide ', 'textdomain' ),
	),
	'default'     => 'container',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'topheader-img',
	'label'       => __( 'Top Header Img', 'textdomain' ),
	//'description' => __( 'Description Here.', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-style',
	'label'       => __( 'Header Block', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '1-1',
	'choices'     => $theme_headers,
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'headerwidget-html',
	'label'       => __( 'Header Widget HTML', 'textdomain' ),
	'description'       => __( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header-headerwidget',
	'label'       => __( 'Header Widget CSS', 'textdomain' ),
	'description'       => __( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*COLOR SCHEME*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-main',
	'label'       => __( 'Main Color', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--main',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-second',
	'label'       => __( 'Secondary Color', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--second-color',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-topheader',
	'label'       => __( 'Top Header ', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--top-header',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-topheader-banner',
	'label'       => __( 'Top Header Banner', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--top-banner',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-iconheader',
	'label'       => __( 'Icons in Header', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--icon-header',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-middheader',
	'label'       => __( 'Middle Header ', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--middle-header',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bottheader',
	'label'       => __( 'Bottom Header ', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--bottom-header',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bodycolor',
	'label'       => __( 'Body ', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--body',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-footer',
	'label'       => __( 'Footer ', 'textdomain' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--footer',
		),
	),
) );

/*MOBILE*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-quicklinks',
	'label'       => __( 'Quicklinks', 'textdomain' ),
	'section'     => 'section_mobile',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-mobile-style',
	'label'       => __( 'Header Mobile Block', 'textdomain' ),
	'description'	=>	'<a target="_blank" href="http://mvp/blocks/">See all blocks</a>',
	'section'     => 'section_mobile',
	'default'     => '1',
	'choices'     => $theme_headers_mobile,
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'mobile-redirect',
	'label'       => __( 'Redirect Mobile', 'textdomain' ),
	'description'	=>	'Redirect to other homepage in mobile. Ej. /permalink',
	'section'     => 'section_mobile',
	'default'     => '',
) );

/*WOOCOMMERCE*/
if(fw_checkPlugin('woocommerce/woocommerce.php')){


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-shop',
	'label'       => __( 'Shop Layout', 'textdomain' ),
	'section'     => 'section_woo',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'textdomain' ),
		'container-fluid' => __( 'Wide ', 'textdomain' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'shop-loop-product-style',
	'label'       => __( 'Catalog Loop Style', 'textdomain' ),
	'description'=>'<a target="_blank" href="http://mvp/blocks/">See all blocks</a>',
	'section'     => 'section_woo',
	'default'     => 'shop-loop-product-style',
	'choices'     => $loop_templates,
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'shop-loop-mobile-product-style',
	'label'       => __( 'Mobile Loop templates', 'textdomain' ),
	'description'=>'<a target="_blank" href="http://mvp/blocks/">See all blocks</a>',
	'section'     => 'section_woo',
	'choices'     => $loop_templates_mobile,
	'default'		=> '0',
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'in-stock-text',
	'label'    => __( 'In Stock Label', 'redux-framework-demo' ),
	'section'     => 'section_woo',
	'default'	=>__( 'In Stock', 'redux-framework-demo' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'out-of-stock-text',
	'label'    => __( 'Out of Stock Label', 'fastway' ),
	'section'     => 'section_woo',
	'default'	=>__( 'Sold', 'redux-framework-demo' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-text',
	'label'    => __( 'Add to cart Label', 'redux-framework-demo' ),
	'section'     => 'section_woo',
	'default'	=>__( 'Buy', 'redux-framework-demo' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'cart-style',
	'label'       => __( 'Cart Style', 'textdomain' ),
	'section'     => 'section_woo',
	'default'     => 'modal',
	'choices'     => array(
		'link'   => __( 'Link', 'textdomain' ),
		'modal' => __( 'Modal ', 'textdomain' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-style',
	'label'       => __( 'Header Block', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '1-1',
	'choices'     => $theme_headers,
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'prices-enabled',
	'label'       => __( 'Prices', 'textdomain' ),
	'section'     => 'section_woo',
	'description' => 'hide prices ',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'purchases-enabled',
	'label'       => __( 'Purchases', 'textdomain' ),
	'section'     => 'section_woo',
	'description' => 'diable add to car button',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'checkout-msg',
	'label'       => __( 'Check out message', 'textdomain' ),
	'description'=>'Display a messsage/notice before checkout',
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'sold-alone',
	'label'       => __( 'Sold Individually', 'textdomain' ),
	'section'     => 'section_woo',
	'description' => 'redirects to checkout directly *redirect to cart has to be activated in woocommerce product options',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop-layout',
	'label'       => __( 'Shop Pages Layout', 'textdomain' ),
	'section'     => 'section_woo',
	'default'     => 'left',
	'choices'     => array(
		'full' => __( 'Full Width', 'textdomain' ),
		'left' => __( 'Left Sidebar', 'textdomain' ),
		'right' => __( 'Right Sidebar', 'textdomain' ),
		'both' => __( 'Both Sidebars', 'textdomain' ),
	),
) );


/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'shop-left-sidebar',
	'label'       => __( 'Select Left Sidebar', 'textdomain' ),
	'section'     => 'section_woo',
	'choices'     => kirki_sidebars_select_example(),
	'default'     => 's-left-sidebar',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'shop-right-sidebar',
	'label'       => __( 'Select Right Sidebar', 'textdomain' ),
	'section'     => 'section_woo',
	'choices'     => kirki_sidebars_select_example(),
	'default'     => 's-right-sidebar',
) );
*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_per_page',
	'label'       => esc_attr__( 'Products Per Page', 'textdomain' ),
	'section'     => 'section_woo',
	'default'     => 12,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_columns',
	'label'       => esc_attr__( 'Products Per Page', 'textdomain' ),
	'section'     => 'section_woo',
	'default'     => 4,
	'choices'     => array(
		'min'  => '2',
		'max'  => '12',
		'step' => '1',
	),
) );



/*SINGLE*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product-page-layout',
	'label'       => __( 'Product Page Layout', 'textdomain' ),
	'section'     => 'section_woo_single',
	'default'     => 'full',
	'choices'     => array(
		'full' => __( 'Full Width', 'textdomain' ),
		'left' => __( 'Left Sidebar', 'textdomain' ),
		'right' => __( 'Right Sidebar', 'textdomain' ),
		'both' => __( 'Both Sidebars', 'textdomain' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'product-page-footer-block',
	'label'       => __( 'Footer Block', 'textdomain' ),
	'section'     => 'section_woo_single',
	'choices'     => $static_block_args,
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'shop-single-product-style',
	'label'       => __( 'Single Product Template', 'textdomain' ),
	'description'=>'<a target="_blank" href="http://mvp/blocks/">See all blocks</a>',
	'section'     => 'section_woo_single',
	'choices'     => $single_templates,
	'default'		=> '1',
) );

}
/*FOOTER*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer-width',
	'label'       => __( 'Footer Width', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'textdomain' ),
		'container-fluid' => __( 'Wide ', 'textdomain' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'footer-stblock',
	'label'       => __( 'Static Block', 'textdomain' ),
	'section'     => 'section_footer',
	'choices'     => $static_block_args,
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'footer-copyright-switch',
	'label'       => __( 'Show Footer Copyright', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'footer-copyright-text',
	'label'       => __( 'Footer Copyright HTML', 'textdomain' ),
	'description'       => __( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => '<div id="footercopy"><div class="izquierda">Desarrollado por <a href="https://www.briziolabz.com" target="_blank" rel="noopener"><img class="logofirma" style="height: 30px !important;"  src="'.get_template_directory_uri().'/assets/img/logo.png"/></a></div><div class="derecha"><div class="copyright">Copyright © COMPANY | Todos los derechos reservados.</div></div></div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer-copywright',
	'label'       => __( 'Footer Copyright CSS', 'textdomain' ),
	'description'       => __( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => '#footercopy{width:100%;float:left!important;padding:5px 15px;border-top:1px solid #d3d3d3;line-height:30px!important;font-size:15px!important}#footercopy .izquierda{display:inline-block;float:left;width:50%}#footercopy .derecha{float:right!important;text-align:right;width:50%!important}@media (max-width:700px){#footercopy .copyright{display:none}#footercopy .izquierda{width:100%;text-align:center!important}}#footercopy .logofirma{height:30px}',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*TYPOGRAPHY*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h1',
	'label'       => __( 'H1', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '40px',
		'line-height'    => '40px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'     => 'black',
	),
	'transport'   => 'auto',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'header h1',
		),
		array(
			'element' => 'footer h1',
		),
		array(
			'element' => '#page-wrapper h1',
		),
		array(
			'element' => '#woocommerce-wrapper h1',
		),
		array(
			'element' => '#main-nav h1',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h2',
	'label'       => __( 'H2', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '32px',
		'line-height'    => '32px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'     => 'black',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'header h2',
		),
		array(
			'element' => 'footer h2',
		),
		array(
			'element' => '#page-wrapper h2',
		),
		array(
			'element' => '#woocommerce-wrapper h2',
		),
		array(
			'element' => '#main-nav h2',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h3',
	'label'       => __( 'H3', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '28px',
		'line-height'    => '28px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'     => 'black',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'header h3',
		),
		array(
			'element' => 'footer h3',
		),
		array(
			'element' => '#page-wrapper h3',
		),
		array(
			'element' => '#woocommerce-wrapper h3',
		),
		array(
			'element' => '#main-nav h3',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h4',
	'label'       => __( 'H4', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '24px',
		'line-height'    => '24px',
		'letter-spacing' => '0',
		'color'     => 'black',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'header h4',
		),
		array(
			'element' => 'footer h4',
		),
		array(
			'element' => '#page-wrapper h4',
		),
		array(
			'element' => '#woocommerce-wrapper h4',
		),
		array(
			'element' => '#main-nav h4',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-body',
	'label'       => __( 'Body', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '14px',
		'letter-spacing' => '0',
		'color'     => 'black',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body a',
		),
		array(
			'element' => 'body p',
		),
		array(
			'element' => 'body div',
		),
		array(
			'element' => 'body span',
		),
		
	),
) );


/*Section CSS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-general',
	'label'       => __( 'CSS General', 'textdomain' ),
	'section'     => 'section_css_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header',
	'label'       => __( 'CSS Header', 'textdomain' ),
	'section'     => 'section_css_header',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-body',
	'label'       => __( 'CSS Body', 'textdomain' ),
	'section'     => 'section_css_body',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer',
	'label'       => __( 'CSS Footer', 'textdomain' ),
	'section'     => 'section_css_footer',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-loop',
	'label'       => __( 'CSS Product Loop', 'textdomain' ),
	'section'     => 'section_css_loop',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-sidebarcats',
	'label'       => __( 'CSS Sidebar Categorys', 'textdomain' ),
	'section'     => 'section_css_sidebarcats',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => __( 'CSS Single Product', 'textdomain' ),
	'section'     => 'section_css_single',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-mobile',
	'label'       => __( 'CSS Mobile', 'textdomain' ),
	'section'     => 'section_css_mobile',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*Extras*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'maintainance-mode',
	'label'       => __( 'Maintainance Mode', 'textdomain' ),
	'section'     => 'section_extras',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'popup-mode',
	'label'       => __( 'Popup', 'textdomain' ),
	'section'     => 'section_extras',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'textdomain' ),
	    'off' => __( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'maintainance-mode-img',
	'label'       => __( 'Maintainance Mode Img', 'textdomain' ),
	'section'     => 'section_extras',
	'default'		=> get_template_directory_uri()."/assets/img/mantenimiento.png"

) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'popup-img',
	'label'       => __( 'Popup Img', 'textdomain' ),
	'section'     => 'section_extras',

) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'img-404',
	'label'       => __( '404 img', 'textdomain' ),
	'section'     => 'section_extras',
	'default'  =>  get_template_directory_uri().'/assets/img/error.png',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyname',
	'label'    => __( 'Company Name', 'redux-framework-demo' ),
    'description'     => __( '[fw_companyname]', 'redux-framework-demo' ),
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companywhatsapp',
	'label'    => __( 'Company Whatsapp', 'redux-framework-demo' ),
    'description'     => __( '[fw_companywhatsapp] empezar con +54', 'redux-framework-demo' ),
                
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyphone',
	'label'    => __( 'Company Phone', 'redux-framework-demo' ),
    'description'     => __( '[fw_companyphone]', 'redux-framework-demo' ),            
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyaddress',
	'label'    => __( 'Company Adress', 'redux-framework-demo' ),
    'description'     => __( '[fw_companyaddress]', 'redux-framework-demo' ),
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companygooglemaps',
	'label'    => __( 'Google Maps Url', 'redux-framework-demo' ),
    'description'     => __( '[fw_companygooglemaps]', 'redux-framework-demo' ),
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyemail',
	'label'    => __( 'Company Email', 'redux-framework-demo' ),
    'description'     => __( '[fw_companyemail]', 'redux-framework-demo' ),
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyfb',
	'label'    => __( 'Company Facebook Url', 'redux-framework-demo' ),
    'description'     => __( '[fw_companyfb]', 'redux-framework-demo' ),
	'section'     => 'section_extras',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyig',
	'label'    => __( 'Company Instagram Url', 'redux-framework-demo' ),
    'description'     => __( '[fw_companyig]', 'redux-framework-demo' ),            
	'section'     => 'section_extras',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyyoutube',
	'label'    => __( 'Company Youtube Url', 'redux-framework-demo' ),
   	'description'     => __( '[fw_companyyoutube]', 'redux-framework-demo' ),
	'section'     => 'section_extras',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'opt-ace-editor-js',
	'label'       => __( 'JS Code', 'textdomain' ),
	'description'       => __( 'Paste your JS code here.', 'textdomain' ),
	'section'     => 'section_extras',
	'default'  => 'jQuery(document).ready(function(){
		
	});',
	'choices'     => array(
		'language' => 'js',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'analytics-id',
	'label'    => __( 'Analyitics ID', 'redux-framework-demo' ),       
	'section'     => 'section_extras',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'header-insert',
	'label'    => __( 'Insert Scripts Header', 'redux-framework-demo' ),       
	'section'     => 'section_extras',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'footer-insert',
	'label'    => __( 'Insert Scripts Footer', 'redux-framework-demo' ),       
	'section'     => 'section_extras',
) );


if(empty(get_theme_mod("header-style"))){
	$jaja=get_option("redux_demo");
    foreach ($jaja as $key => $value) {
    	if($key=='opt-typography-div')$key='opt-typography-body';
    	if(isset($jaja[$key]['url']))$value=$jaja[$key]['url'];
        set_theme_mod($key,$value);
    }
     error_log("set init");
}

/*
foreach (Kirki::$fields as $field ) {
    if(isset($field["default"]) && !isset($redux_demo[$field["settings"]])){
        $redux_demo[$field["settings"]]=$field["default"];
    }
}
*/


function my_customizer_styles() { ?>
	<style>
	.customize-control-kirki-multicheck ul {
	  display: flex;
	}

	.customize-control-kirki-multicheck ul li {
	  width: 100%;
	}

	.customize-control-kirki-multicheck ul li label {
	  background: rgba(0, 0, 0, 0.1);
	  border: 1px rgba(0, 0, 0, 0.1);
	  color: #555d66;
	  margin: 0;
	  text-align: center;
	  padding: 0.5em 1em;
	  display: block;
	}

	.customize-control-kirki-multicheck ul li label.checked {
	  background-color: #00a0d2;
	  color: rgba(255, 255, 255, 0.8);
	}

	.customize-control-kirki-multicheck ul li input {
	  display: none;
	}
	.CodeMirror {
	  border: 1px solid #eee;
	  height: 400px !important;
	}
	.CodeMirror-gutters, .CodeMirror-gutter-wrapper{
display:none !important;
}
.CodeMirror-sizer{
margin:0px !important;
}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'my_customizer_styles', 999 );


