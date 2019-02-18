<?php

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

function urlforimages(){
	$stri=str_replace(site_url(), "", get_template_directory_uri() );
	return $stri;

}

$static_block_args = fastway_get_stblock();

Kirki::add_config( 'theme_config_id', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );


Kirki::add_panel( 'panel_fastway', array(

    'title'       => __( 'Fastway', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );


Kirki::add_section( 'section_general', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_layouts', array(
    'title'          => __( 'Layouts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_colors', array(
    'title'          => __( 'Color Scheme', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_typos', array(
    'title'          => __( 'Typography', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_data', array(
    'title'          => __( 'Company Data', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_header', array(
    'title'          => __( 'Header', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_mobile', array(
    'title'          => __( 'Mobile', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_footer', array(
    'title'          => __( 'Footer', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_blog', array(
    'title'          => __( 'Blog', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_labels', array(
    'title'          => __( 'Labels', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',
  
) );
/*CSSs
if(!empty(fw_theme_mod("css_editor-general")) || !empty(fw_theme_mod("css_editor-general"))){
Kirki::add_panel( 'panel_css', array(

    'title'       => __( 'Live CSS (depreceated)', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );	
}

Kirki::add_section( 'section_css_general', array(
    'title'          => __( 'CSS General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );

Kirki::add_section( 'section_css_header', array(
    'title'          => __( 'CSS Header', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_body', array(
    'title'          => __( 'CSS Body', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_footer', array(
    'title'          => __( 'CSS Footer', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_loop', array(
    'title'          => __( 'CSS Product Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_single', array(
    'title'          => __( 'CSS Single Product ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_mobile', array(
    'title'          => __( 'CSS Mobile', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );
Kirki::add_section( 'section_css_sidebarcats', array(
    'title'          => __( 'CSS Sidebar Category ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_css',

) );*/


Kirki::add_panel( 'panel_fastwaywoo', array(

    'title'       => __( 'Fastway Woocommerce', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_section( 'section_woo', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );
Kirki::add_section( 'section_woo_shop', array(
    'title'          => __( 'Shop Page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_loop', array(
    'title'          => __( 'Product Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_loop_cat', array(
    'title'          => __( 'Category Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_single', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

 
//Blofg

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header-width',
	'label'       => __( 'Header Width', 'fastway' ),
	'section'     => 'section_layouts',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
	),
	'default'     => 'container',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-blog',
	'label'       => __( 'Blog Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-main',
	'label'       => __( 'Main layout: wide or boxed', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	
	'choices'     => array(
		'container-fluid'   => 'Wide',
		'container-mid'   => 'Medium',
		'container'   => 'Boxed',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-main',
	'label'       => __( 'Sidebars Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-shop',
	'label'       => __( 'Shop Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop-layout',
	'label'       => __( 'Shop Pages Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'left',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );
/*SINGLE*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product-page-layout',
	'label'       => __( 'Product Page Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer-width',
	'label'       => __( 'Footer Width', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
	),
) );



//General
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'general-logo',
	'label'       => __( 'Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_general',
	'default'     => urlforimages()."/assets/img/logo.png",
	'transport'=>'postMessage',
	'partial_refresh' => array(
	    'kirki_hero_title' => array(
	        'selector'        => '.logo',
	        'render_callback' => 'fw_logo',
	    ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-desc',
	'label'       => __( 'Meta Description', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_general',
	'default'     => '',
) );

/*HEAADER*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'sticky-menu',
	'label'       => __( 'Deactivate Sticky', 'fastway' ),
	'section'     => 'section_header',
	'default'     => array('fw_header.middle', 'fw_header.bottom'),
	'choices'     => array(
		'fw_header.top' => __( 'Top', 'fastway' ),
		'fw_header.middle' => __( 'Middle', 'fastway' ),
		'fw_header.bottom' => __( 'Bottom', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-padding',
	'label'       => __( 'Header Padding', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 1,
	'choices'     => array(
		'0.25'  => 1,
		'0.5'  => 2,
		'1' => 3,
		'1.5' => 4,
		'3' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop',
			'property'	=> 'padding-top',
			'units'=>'rem'
		),
		array(
			'element' => '.fw_header.middle.desktop',
			'property'	=> 'padding-bottom',
			'units'=>'rem'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header_icons_size',
	'label'       => __( 'Header Icons Size', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 24,
	'choices'     => array(
		'min'  => 10,
		'max'  => 40,
		'step' => 1,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.desktop .fw-header-icon i',
			'property'	=> 'font-size',
			'units'=>'px'
		),
	
		array(
			'element' => '.desktop .fw-header-icon .header-cart-count-badge',
			'property'	=> 'font-size',
			'value_pattern'   => 'calc($px - 6px)',
			
		),
		
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'logo-width',
	'label'       => __( 'Logo Width', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 180,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop .logo img',
			'property'	=> 'width',
			'units'=>'px'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'logo-width-mobile',
	'label'       => __( 'Mobile Logo Width', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 110,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.mobile  .logo img',
			'property'	=> 'width',
			'units'=>'px'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header__mobile_icons_size',
	'label'       => __( 'Mobile Header Icons Size', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 24,
	'choices'     => array(
		'min'  => 10,
		'max'  => 40,
		'step' => 1,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.mobile i',
			'property'	=> 'font-size',
			'units'=>'px'
		),
	
		array(
			'element' => '.fw_header.mobile .header-cart-count-badge',
			'property'	=> 'font-size',
			'value_pattern'   => 'calc($px - 6px)',
			
		),
		
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_quickmenu_links',
	'label'    	=> __( 'Mobile Menu Order', 'fastway' ),
	'default' 	=>	'fb,youtube,whatsapp,ig,email,phone,address',
	'section'   => 'section_mobile',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header_padding_mobile',
	'label'       => __( 'Header Padding Mobile', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices'     => array(
		'0'  => 0,
		'0.25'  => 1,
		'0.5'  => 2,
		'1' => 3,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.mobile',
			'property'	=> 'padding-top',
			'units'=>'rem'
		),
		array(
			'element' => '.fw_header.middle.mobile',
			'property'	=> 'padding-bottom',
			'units'=>'rem'
		),
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-header',
	'label'       => __( 'Main Menu', 'fastway' ),
	'section'     => 'section_header',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
		'letter-spacing' => '0',
		'color'     => 'black',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.navbar-nav li a',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'top-header',
	'label'       => __( 'Top Header', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	),
	
) );*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'mega_menu',
	'label'       => __( 'Mega Menu', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'mega_menu_cols',
	'label'       => __( 'Mega Menu Layout', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 3,
	'choices'     => array(
		6 => __( '2 cols', 'fastway' ),
		4 => __( '3 cols', 'fastway' ),
		3 => __( '4 cols', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'mega_menu_overlay',
	'label'       => __( 'Overlay', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header_code',
	'label'       => __( 'Header Code', 'fastway' ),
	'description' => '
					[fw_header id="bottom,top,middle"]
					[fw_logo][fw_menu][fw_user_account][fw_search_form id="1"][fw_extras_short type="phone" isli="true" stext="Atencion Telefonica"][fw_shopping_cart]
					[/fw_header]',
	'section'     => 'section_header',
	'default'     => '[fw_header][fw_logo][fw_menu][/fw_header]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header',
	'label'       => __( 'CSS Header', 'fastway' ),
	'section'     => 'section_header',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


/*COLOR SCHEME*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-main',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#00A2DE',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--main);',
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
	'label'       => __( 'Secondary Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#EFBA03',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--second);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--second-color',
		),
		array(
			'element'  => ':root',
			'property' => '--second',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-iconheader',
	'label'       => __( 'Icons in Header', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#00A2DE',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--icon-header); Its a color for all icons in header. Can be owewritten in css.',
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
	'settings'    => 'opt-color-topheader',
	'label'       => __( 'Top Header ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--top-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--top-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-middheader',
	'label'       => __( 'Middle Header ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--middle-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--middle-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'color-sticky-header',
	'label'       => __( 'Header Sticky Color ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'description'=>' var(--sticky-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--sticky-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bottheader',
	'label'       => __( 'Bottom Header ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--bottom-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--bottom-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bodycolor',
	'label'       => __( 'Body Background', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--body);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--body',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-shopcolor',
	'label'       => __( 'Shop Background ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--shop);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--shop',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-footer',
	'label'       => __( 'Footer ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--footer);',
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
	'settings'    => 'responsive-typo',
	'label'       => __( 'Responsive Typo ', 'fastway' ),
	'description'       =>'Automatically adjusts font size to screen',
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-quicklinks',
	'label'       => __( 'Quicklinks', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'mobile-redirect',
	'label'       => __( 'Redirect Mobile', 'fastway' ),
	'description'	=>	'Redirect to other homepage in mobile. Ej. /permalink',
	'section'     => 'section_mobile',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header_mobile_code',
	'label'       => __( 'Header Mobile Code', 'fastway' ),
	'description' => '[fw_m_header id="bottom,top,middle"]
					[fw_logo][fw_m_menu][fw_user_account][fw_m_search_form][fw_shopping_cart]
					[/fw_m_header]',
	'section'     => 'section_mobile',
	'default'     => '[fw_m_header] [fw_logo][fw_m_menu][/fw_m_header]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'mobile-icon',
	'label'       => __( 'Mobile App Icon', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_general',
	'default'     => urlforimages()."/assets/img/favi.png",
) );
/*WOOCOMMERCE*/







Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_min_purchase',
	'label'    => __( 'Min Purchase', 'fastway' ),
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_min_purchase2',
	'label'    => __( 'Min Re-Purchase', 'fastway' ),
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_price_suffix',
	'label'    => __( 'Price Suffix', 'fastway' ),
	'description' =>'Goes next to the right of the price.',
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_currency_symbol',
	'label'    => __( 'Currency Symbol', 'fastway' ),
	'descriptiom' => 'Only affecs main currecy. Leave empty for default.',
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_user_template',
	'label'       => __( 'User Template', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'icon',
	'choices'     => array(
		'icon'   => __( 'Only Icon', 'fastway' ),
		'iconwt' => __( 'Icon With Text ', 'fastway' ),
		'iconwu' => __( 'Icon With Username ', 'fastway' ),
	),
) );
/*

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'bread-enabled',
	'label'       => __( 'Breadcrumb', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_prices_visibility',
	'label'       => __( 'Prices', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices'     => array(
		'show' => __( 'Show', 'fastway' ),
		'logged' => __( 'Logged In', 'fastway' ),
		'hide' => __( 'Hide', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_purchases_visibility',
	'label'       => __( 'Purchases', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices'     => array(
		'show'   => __( 'Show', 'fastway' ),
		'logged' => __( 'Logged In', 'fastway' ),
		'hide' => __( 'Hide', 'fastway' ),
	),
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'cart-steps',
	'label'       => __( 'Cart/Checkout Steps ', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'checkout-minimal',
	'label'       => __( 'Checkout Minimal ', 'fastway' ),
	'description'	=> 'Hides header and footer',
	'section'     => 'section_woo',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Enable', 'fastway' ),
	    1 => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'checkout-msg',
	'label'       => __( 'Check out message', 'fastway' ),
	'description'=>'Display a messsage/notice before checkout',
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'sold-alone',
	'label'       => __( 'Sold Individually', 'fastway' ),
	'section'     => 'section_woo',
	'description' => 'redirects to checkout directly *redirect to cart has to be activated in woocommerce product options',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'sidebar-ratio',
	'label'       => __( 'Sidebar Width', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 2,
	'choices'     => array(
		'min'  => '2',
		'max'  => '4',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_per_page',
	'label'       => esc_attr__( 'Products Per Page', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 40,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_columns',
	'label'       => esc_attr__( 'Shop Columns', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 4,
	'choices'     => array(
		'min'  => '2',
		'max'  => '12',
		'step' => '1',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_shop',
	'label'       => __( 'CSS Shop Page ', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_single_code',
	'label'    => __( 'Single Product Code', 'fastway' ),     
	'section'     => 'section_woo_single',
	'default'     => '[fw_single_container]
	[fw_single_gallery] 
	[fw_single_summary]
	[fw_single_title]
	[fw_single_price]
	[fw_single_cart]
	[fw_summary_container]
	[fw_extras_short type="fa-shield-alt" isli="true" text="Compra Segura" stext="Garantía de Fabrica" el_class="fw-medios"]
	[fw_extras_short type="fa-credit-card" isli="true" text="Ver cuotas y medios de pago" stext="(Ver promociones vigentes)" modal="modalMediosPago" el_class="fw-medios"]
	[altoweb_financiacion]
	[/fw_single_summary]
	[fw_single_tabs]
	[fw_single_related]
	[/fw_single_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => __( 'CSS Single Product', 'fastway' ), 
	'description' => '.fw_price', 
	'section'     => 'section_woo_single',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
//}
/*FOOTER*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'footer-stblock',
	'label'       => __( 'Static Block', 'fastway' ),
	'section'     => 'section_footer',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer',
	'label'       => __( 'CSS Footer', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'footer-copyright-switch',
	'label'       => __( 'Show Footer Copyright', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'footer-copyright-text',
	'label'       => __( 'Footer Copyright HTML', 'fastway' ),
	'description'       => __( 'Not all headers have Header Widget', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => '<div id="fw_footercopy" style="border-top:1px solid #d3d3d3;" class="container-fluid d-flex justify-content-between align-items-center"><div class="izquierda" style="font-size:15px !important;">Desarrollado por  <a href="https://www.briziolabz.com" target="_blank" rel="noopener"><img class="logofirma"  height="30" src="/wp-content/plugins/briziolabz-fw-plugin/assets/img/logo.png"/></a></div><div class="copyright d-none d-md-block" style="font-size:15px !important;">Copyright ©  [fw_data  type="name" only_text="true" size="15"] | Todos los derechos reservados.</div></div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

/*TYPOGRAPHY*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fa_pro',
	'label'       => __( 'FontAwesome Pro', 'fastway' ),
	'description' => '*you have to purchase a pro licence and then add your domains.',
	'section'     => 'section_typos',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_icons_style',
	'label'       => 'Font Awesome Pro Styles',
	'section'     => 'section_typos',
	'default'     => 'fa',
	
	'choices'     => array(
		'fa'   =>  'Regular',
		'fas'  => 'Solid',
		'fal'  => 'Light',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h1',
	'label'       => __( 'H1', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '40px',
		'line-height'    => '44px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'     => 'black',
	),
	'transport'   => 'auto',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h1',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h2',
	'label'       => __( 'H2', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '32px',
		'line-height'    => '36px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'     => 'black',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h2',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h3',
	'label'       => __( 'H3', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '25px',
		'line-height'    => '30px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'     => 'black',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h3',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h4',
	'label'       => __( 'H4', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '24px',
		'line-height'    => '28px',
		'letter-spacing' => '0',
		'color'     => 'black',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h4',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-body',
	'label'       => __( 'Body', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
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
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );



/*Section CSS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-general',
	'label'       => __( 'CSS General', 'fastway' ),
	'section'     => 'section_css_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-body',
	'label'       => __( 'CSS Body', 'fastway' ),
	'section'     => 'section_css_body',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => __( 'CSS Single Product', 'fastway' ),
	'section'     => 'section_woo_single',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-mobile',
	'label'       => __( 'CSS Mobile', 'fastway' ),
	'description'	=> 'Put everything inside @media',
	'section'     => 'section_mobile',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*LOOP*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_code',
	'label'       => __( ' Product Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop',
	'description'     => '[fw_loop_container][fw_loop_image][fw_loop_title][fw_loop_price][fw_loop_cart][/fw_loop_container]',
	'default'     => '[fw_loop_container][fw_loop_image][fw_loop_title][fw_loop_price][/fw_loop_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-loop',
	'label'       => __( 'CSS Product Loop', 'fastway' ),
	'section'     => 'section_woo_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_cat_code',
	'label'       => __( ' Category Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_cat',
	'description'     => '[fw_cat_container][fw_cat_image][fw_cat_title][fw_cat_desc][/fw_cat_container]',
	'default'     => '[fw_cat_container][fw_cat_image][fw_cat_title][/fw_cat_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_cat',
	'label'       => __( 'CSS Category Loop', 'fastway' ),
	'section'     => 'section_woo_loop_cat',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*Company DATA*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'my_setting',
	'label'       => __( 'INFO', 'textdomain' ),
	'section'     => 'section_data',
	'default'     => '<div style="padding: 10px;background-color: #fff; color:black; border: 1px solid #1E73BE;">
	<h4>1- SOLO VALOR</h4>
	Se pone directo el valor y el shortcode va a mostrar algo asi <br>campo:1154999795<br>resultado:<a href="1154999795">1154999795</a> 
	<h4>2- LABEL Y LINK DIFERENCIADOS</h4>
	Se puede especificar los valores poniendo el valor del link entre parentesis para el whatsapp<br>campo:1154999795 (+541154999795) <br>resultado: <a href="+5491154999795">1154999795</a> 
	<h4>3- MULTIPLES VALORES</h4>
	Por ejemplo para poner 2 direcciones se puede separar con el simbolo "|" <br>
	ej. Dire 1 (link gmaps) | Dire 2 (link gmaps)<br>
	*En el shortcode despues poner address1 o adress2 o adressX en el type' . '</div>',
	'priority'    => 10,
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyname',
	'label'    => __( 'Company Name', 'fastway' ),
    'description'     => __( '[fw_extras_short type="name"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companywhatsapp',
	'label'    => __( 'Company Whatsapp', 'fastway' ),
    'description'     => __( '[fw_extras_short type="whatsapp"] empezar con 549, sin el + [fw_extras_short type="whatsapp"]', 'fastway' ),
                
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyphone',
	'label'    => __( 'Company Phone', 'fastway' ),
    'description'     => __( '[fw_extras_short type="phone"] ', 'fastway' ),            
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyaddress',
	'label'    => __( 'Company Address', 'fastway' ),
    'description'     => __( '[fw_extras_short type="address"] ', 'fastway' ),
	'section'     => 'section_data',
) );

/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companygooglemaps',
	'label'    => __( 'Google Maps Url', 'fastway' ),
    'description'     => __( '[fw_companygooglemaps] ', 'fastway' ),
	'section'     => 'section_data',
) );
*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyemail',
	'label'    => __( 'Company Email', 'fastway' ),
    'description'     => __( '[fw_companyemail] [fw_extras_short type="email"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyfb',
	'label'    => __( 'Company Facebook Url', 'fastway' ),
    'description'     => __( '[fw_companyfb] [fw_extras_short type="fb"]', 'fastway' ),
	'section'     => 'section_data',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyig',
	'label'    => __( 'Company Instagram Url', 'fastway' ),
    'description'     => __( '[fw_companyig] [fw_extras_short type="ig"]', 'fastway' ),            
	'section'     => 'section_data',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyyoutube',
	'label'    => __( 'Company Youtube Url', 'fastway' ),
   	'description'     => __( '[fw_companyyoutube] [fw_extras_short type="youtube"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companytwitter',
	'label'    => __( 'Company Twitter Url', 'fastway' ),
   	'description'     => __( '[fw_companytwitter] [fw_extras_short type="twitter"]', 'fastway' ),
	'section'     => 'section_data',
) );
/*Extras*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'maintainance-mode',
	'label'       => __( 'Maintainance Mode', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'construction_code',
	'label'       => __( 'Under Maintainance/Construction Html', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<!doctype html>
	<title>Site Maintenance</title>
	<style>
	  body { text-align: center; padding: 150px; }
	  h1 { font-size: 50px; }
	  body { font: 20px Helvetica, sans-serif; color: #333; }
	  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
	  a { color: #dc8100; text-decoration: none; }
	  a:hover { color: #333; text-decoration: none; }
	</style>
	
	<article>
		<h1>We&rsquo;ll be back soon!</h1>
		<div>
			<p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment.will be back online shortly!</p>
			<p>&mdash; [fw_data type="name"]</p>
		</div>
		</article>',
	'choices'     => array(
		'language' => 'html',
	),
) );
//General
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'dark-logo',
	'label'       => __( 'Dark Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_general',
	'default'     => urlforimages()."/assets/img/logo.png",
	'transport'=>'postMessage',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'darklogo_sticky',
	'label'       => __( 'Dark Logo on Sticky', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'popup-mode',
	'label'       => __( 'Popup', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'whats-widget',
	'label'       => __( 'Whatsapp Widget', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'maintainance-mode-img',
	'label'       => __( 'Maintainance Mode Img', 'fastway' ),
	'section'     => 'section_general',
	'default'		=> urlforimages()."/assets/img/mantenimiento.png"

) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'popup-img',
	'label'       => __( 'Popup Img', 'fastway' ),
	'section'     => 'section_general',

) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => '404_code',
	'label'       => __( '404 Html', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<div class="container">
	<div class="content-detalle row" style="margin:0 auto;margin-top:40px;">
		<div class="col-3">
            <i class="fal fa-debug" style="color:var(--main);font-size:200px;"></i>
		</div>
		<div class="col-9">
			<h1 class="txt-24 t2 tit-pagina" style="font-weight: 400;">No encontramos productos que coincidan con tu búsqueda</h1>
			<br>
			<b>Vamos a afinar tu puntería</b>
			<ul class="t1 txt-16">
				<li>Revisa la ortografía de la palabra</li>
				<li>Usa pocas palabras y más genéricas</li>
				<li>Ayudate con el menú y buscá por categorías</li>
			</ul>
		</div>
	</div>
		<div style="margin-top:40px;">
[fw_recent_products title="Lo más buscado esta semana" prodsperrow="6"]</div>
</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'opt-ace-editor-js',
	'label'       => __( 'JS Code', 'fastway' ),
	'description'       => __( 'Paste your JS code here.', 'fastway' ),
	'section'     => 'section_general',
	'default'  => 'jQuery(document).ready(function(){
		
	});',
	'choices'     => array(
		'language' => 'js',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'analytics-id',
	'label'    => __( 'Analyitics ID', 'fastway' ),       
	'section'     => 'section_general',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fbpixel_id',
	'label'    => __( 'Facebook Pixel ID', 'fastway' ),       
	'section'     => 'section_general',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagmanager_id',
	'label'    => __( 'Google Tag Manager (Global)', 'fastway' ),       
	'section'     => 'section_general',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagcheckout_id',
	'label'    => __( ' Tag Manager Conversion ID (Checkout)', 'fastway' ),       
	'section'     => 'section_general',
	'description' =>'refresh cache!'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header-insert',
	'label'    => __( 'Insert Scripts Header', 'fastway' ),       
	'section'     => 'section_general',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'footer-insert',
	'label'    => __( 'Insert Scripts Footer', 'fastway' ),       
	'section'     => 'section_general',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-logged_in',
	'label'       => __( 'CSS Logged In', 'fastway' ),
	'section'     => 'section_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-admin',
	'label'       => __( 'CSS Admin', 'fastway' ),
	'section'     => 'section_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );




/*LABELS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'in-stock-text',
	'label'    => __( 'In Stock Label', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'In Stock', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'out-of-stock-text',
	'label'    => __( 'Out of Stock Label', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'Sold', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-text',
	'label'    => __( 'Add to cart Label', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'Buy', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_user_text',
	'label'    => __( 'Login Text', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'Ingresar', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_share_message',
	'label'    => __( 'Share Message', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'¡Hola! Quisiera hacer una consulta por un producto que me intereso en su web',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_search',
	'label'    => __( 'Search Placeholder', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'¿Que estas buscando?',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_sale',
	'label'    => __( 'Sale Message', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'¡Oferta!',
) );





function my_customizer_styles() { ?>
	<style>
	.customize-control-kirki-multicheck ul {
	  display: flex;
	  flex-wrap: wrap;
	}

	.customize-control-kirki-multicheck ul li {
	  	width: 100%;
	}
        #customize-control-sticky-menu ul li{
width:33.3%;
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


