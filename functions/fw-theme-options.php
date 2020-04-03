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

Kirki::add_panel( 'panel_fastwayinit', array(

    'title'       => __( 'Fastway Init', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_panel( 'panel_fastway', array(

    'title'       => __( 'Fastway Settings', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_panel( 'panel_fastwaylayout', array(

    'title'       => __( 'Fastway Layouts', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_section( 'section_general', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_email', array(
    'title'          => __( 'Email', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_popup', array(
    'title'          => __( 'Popup', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_scripts', array(
    'title'          => __( 'Scripts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_seo', array(
    'title'          => __( 'SEO', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_layouts', array(
    'title'          => __( 'Layouts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwayinit',

) );
Kirki::add_section( 'section_colors', array(
    'title'          => __( 'Color Scheme', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwayinit',

) );

Kirki::add_section( 'section_typos', array(
    'title'          => __( 'Typography', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwayinit',

) );
Kirki::add_section( 'section_data', array(
    'title'          => __( 'Company Data', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwayinit',

) );

Kirki::add_section( 'section_header', array(
    'title'          => __( 'Header', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );
Kirki::add_section( 'section_mobile', array(
    'title'          => __( 'Mobile', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_footer', array(
    'title'          => __( 'Footer', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

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

Kirki::add_section( 'section_actions', array(
    'title'          => __( 'Actions', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );


Kirki::add_panel( 'panel_fastwayblog', array(
    'title'       => __( 'Fastway Blog', 'fastway' ),
) );

if(is_plugin_active('woocommerce/woocommerce.php')){
	Kirki::add_panel( 'panel_fastwaywoo', array(
		'title'       => __( 'Fastway Woocommerce', 'fastway' ),
	) );
}
Kirki::add_section( 'section_blog_general', array(
    'title'          => __( 'General', 'fastway' ),
    'panel'          => 'panel_fastwayblog',

) );
Kirki::add_section( 'section_blog_page', array(
    'title'          => __( 'Post Page', 'fastway' ),
    'panel'          => 'panel_fastwayblog',

) );
Kirki::add_section( 'section_woo', array(
    'title'          => __( 'General', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );
Kirki::add_section( 'section_woo_shop', array(
    'title'          => __( 'Shop Page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_search', array(
    'title'          => __( 'Search Page', 'fastway' ),
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
Kirki::add_section( 'section_woo_loop_brand', array(
    'title'          => __( 'Brand Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_single', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_payments', array(
    'title'          => __( 'Payment Methods', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_shippings', array(
    'title'          => __( 'Shipping Methods', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_discount', array(
    'title'          => __( 'Discounts', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_roles', array(
    'title'          => __( 'Roles', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );
Kirki::add_section( 'section_woo_checkout', array(
    'title'          => __( 'Checkout ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
 
//Layouts

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header-width',
	'label'       => __( 'Header Width', 'fastway' ),
	'section'     => 'section_layouts',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
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
		'container-small'   => 'Small',
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
		'container-small'   => 'Small',
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
		'container-small'   => 'Small',
	),
) );

/*BLOG*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_title_switch',
	'label'       => __( 'Blog title', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_sidebar_ratio',
	'label'       => __( 'Sidebar Width', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 3,
	'choices'     => array(
		'min'  => '2',
		'max'  => '4',
		'step' => '1',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_per_page',
	'label'       => esc_attr__( 'News Per Page', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 12,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_columns',
	'label'       => esc_attr__( 'Columns', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 3,
	'choices'     => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '1',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_read_more',
	'label'       => esc_attr__( 'Read more label', 'fastway' ),
	'section'     => 'section_blog_general',
	'description' => 'Si se deja vacio, no aparece',
	'default'     => 'Leer más',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_blog',
	'label'       => __( 'CSS Blog Page ', 'fastway' ),
	'section'     => 'section_blog_general',
	'description' => 'Classes: .blog_page',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*BLOG PAGE*/



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_date_switch',
	'label'       => __( 'Date data', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_author_switch',
	'label'       => __( 'Author data', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_featured_switch',
	'label'       => __( 'Featured Image', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_comment_switch',
	'label'       => __( 'Comments', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_blog_page',
	'label'       => __( 'CSS Blog Page ', 'fastway' ),
	'section'     => 'section_blog_page',
	'description' => 'Classes: .post_page',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
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
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_general_message',
	'label'       => __( 'General message', 'fastway' ),
	'description'=>'Display a messsage on the top bar for important notificacions',
	'section'     => 'section_general',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_seo',
	'label'       => __( 'FW Meta Tags', 'fastway' ),
	'section'     => 'section_seo',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_seo_social',
	'label'       => __( 'FW Social Tags', 'fastway' ),
	'section'     => 'section_seo',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-desc',
	'label'       => __( 'Meta Description', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_seo',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-keywords',
	'label'       => __( 'Keywords', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_seo',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'social_media_image',
	'label'       => __( 'Social Media Image', 'fastway' ),
	'description' => 'Size: 1200x630 <= 1MB',
	'section'     => 'section_seo',
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
	'type'        => 'image',
	'settings'    => 'fw_mobile_logo',
	'label'       => __( 'Mobile Logo', 'fastway' ),
	'description' => __( 'Replaces general logo on mobile.', 'fastway' ),
	'section'     => 'section_mobile'
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
/*EMAIL*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_woosettings',
	'label'       => __( 'Init Woocommerce', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Activar, refrescar y recien ahi toma los cambios. Inicializa woocomerce con nuestros default settings.',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_init_mayorista',
	'label'       => __( 'Init Mayorista', 'fastway' ),
	'section'     => 'section_actions',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_resetmails',
	'label'       => __( 'Reset Mails', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Activar, refrescar y recien ahi toma los cambios. Lo que hace es refrescar todo lo que concierne a emails.',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_clientimages',
	'label'       => __( 'Client Area Images', 'fastway' ),
	'description' => 'Reinicia imagenes del client area con nuestro branding.',
	'section'     => 'section_actions',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );









Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_desde_nombre',
	'label'    	=> __( 'Nombre cliente para mails', 'fastway' ),
	'description' 	=>	'Nombre con el cual les va a llegar a los clientes',
	'section'   => 'section_email',
	'default' => 'Altoweb'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_desde_mails',
	'label'    	=> __( 'Email para recibir notificaciones', 'fastway' ),
	'description' 	=>	' *A que mails se van a enviar todas las notificaciones, separar mails con "," comas.',
	'section'   => 'section_email',
	'default' => ''
) );



Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_general_from_name',
	'label'    	=> __( 'Desde donde', 'fastway' ),
	'default' => 'Web',
	'description' 	=>	'Nombre de donde salen las notificaciones. No modificar!',
	'section'   => 'section_email',
) );



Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_general_from_email',
	'label'    	=> __( 'Desde que mail', 'fastway' ),
	'default' => 'avisos@altoweb.co',
	'description' 	=>	'Email de donde salen las notificaciones. No modificar!',
	'section'   => 'section_email',
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
	'default'     => 1,
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
					[fw_logo][fw_menu][fw_user_account][fw_search_form id="1"][fw_data type="phone" isli="true" stext="Atencion Telefonica"][fw_shopping_cart]
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
	'description' => 'Clases: .fw_header.top,  .fw_header.bottom,  .fw_header.middle,<br> Ids: #header (todo el hader), #fw_menu (agarra el main menu) ,<br>Elementos: .fw_search_form, .fw_logo',
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
	'default'     => '#132E59',
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
	'default'     => '#54AF67',
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
	'label'       => __( 'Icons', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#132E59',
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
	'default'     => '#ffffff',
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

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-copyright',
	'label'       => __( 'Copyright ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--copyright);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--copyright',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_body_dark_mode',
	'label'       => __( 'Dark Mode Body', 'fastway' ),
	'description'       =>'Black website',
	'section'     => 'section_colors',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
/*MOBILE*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_mobile_dark_mode',
	'label'       => __( 'Menu Dark Mode', 'fastway' ),
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
	'settings'    => 'fw_quickmenu_links',
	'label'       => __( 'Quicklinks', 'fastway' ),
	'section'     => 'section_mobile',
	'default' => 'fb,youtube,whatsapp,ig,email,phone,address'
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
	'default'     => '[fw_m_header]<div class="col-3 row align-items-center justify-content-around px-0">
	[fw_m_menu][fw_m_search_form id="3"]
</div>
<div class="col-6 row align-items-center justify-content-center">
	[fw_logo]
</div>
<div class="col-3 row align-items-center justify-content-center">
	[fw_shopping_cart]
</div>[/fw_m_header]',
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
	'default'     => '',
	//'default'     => urlforimages()."/assets/img/favi.png",
) );
/*WOOCOMMERCE*/





Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_shop_state',
	'label'       => __( 'Shop State', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'normal',
	'choices'     => array(
		'normal' => __( 'Normal', 'fastway' ),
		'hidepurchases' => __( 'Compras Off', 'fastway' ),
		'hideprices' => __( 'Precios Off', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_terms_required',
	'label'       => __( 'Terminos y condiciones', 'fastway' ),
	'description'	=> 'Aparece el checkbox en el signup. recordar configurar la pagina en los ajustes de woo.',
	'section'     => 'section_woo',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_cross_sells',
	'label'       => __( 'Cross Sells', 'fastway' ),
	'description'	=> 'Aaprecen sugierencias de compras en el carrito',
	'section'     => 'section_woo',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );
if(is_plugin_active('woocommerce-mercadoenvios/woocommerce-mercadoenvios.php')){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_default_shipping_me',
		'label'    => __( 'Default Shipping Mercadoenvios', 'fastway' ),
		'section'     => 'section_woo',
		'default'     => 0,
		'choices' => array(
			'on'  => __( 'Enable', 'fastway' ),
			'off' => __( 'Disable', 'fastway' )
		)
	));
}
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
	'settings'    => 'fw_min_purchase_roles',
	'label'    => __( 'Mins Roles', 'fastway' ),
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
	'description' => 'Only affecs main currecy. Leave empty for default.',
	'section'     => 'section_woo',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuotas_todopago',
	'label'    => __( 'Cuotas Todopago', 'fastway' ),
	'description' => '',
	'section'     => 'section_woo',
	'default' => 6
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_currency_conversion',
	'label'    => __( 'Currency Conversion', 'fastway' ),
	'description' => 'Al habilitar este campo, al cliente le va a aparecer un widget con un campo para poner la conversion en a la moneda local. Usar punto para decimales, no la coma',
	'section'     => 'section_woo',
) );/*
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
) );*/
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

//set_theme_mod('fw_new_checkout',true);

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_new_checkout',
	'label'    => __( 'New Checkout', 'fastway' ),
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
		'on'  => __( 'Enable', 'fastway' ),
		'off' => __( 'Disable', 'fastway' )
	)
));
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_sell_to_business',
	'label'       => __( 'Vender a empresas', 'fastway' ),
	'description'	=> 'Pide cuit y nombre de empresa en los campos del checkout',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_opt_color_checkout',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_woo_checkout',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--checkout);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--checkout',
		),
	),
) );

/*tp*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_checkout_todopago_label',
	'label'       => __( 'TodoPago Label', 'fastway' ),
	'description'	=>	'Nombre del rol, separados con ",".',
	'section'     => 'section_woo_checkout',
	'default'     => 'Tarjeta de crédito y débito',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_checkout_todopago_desc',
	'label'       => __( 'TodoPago Descripción', 'fastway' ),
	'description'=>'Display a messsage on the my account page',
	'section'     => 'section_woo_checkout',
	'default' => 'Procesado por todopago'
) );

/*tp*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_checkout_eposnet_label',
	'label'       => __( 'ePosnet Label', 'fastway' ),
	'description'	=>	'Nombre del rol, separados con ",".',
	'section'     => 'section_woo_checkout',
	'default'     => 'Tarjeta de crédito y débito',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_checkout_eposnet_desc',
	'label'       => __( 'ePosnet Descripción', 'fastway' ),
	'description'=>'Display a messsage on the my account page',
	'section'     => 'section_woo_checkout',
	'default' => 'Paga en 3 CUOATAS SIN INTERÉS. Procesado por e-Posnet'
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_welcome_msg',
	'label'       => __( 'Welcome message', 'fastway' ),
	'description'=>'Display a messsage on the my account page',
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'checkout-msg',
	'label'       => __( 'Checkout message', 'fastway' ),
	'description'=>'Display a messsage/notice before checkout',
	'section'     => 'section_woo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'order_email_msg',
	'label'       => __( 'Order email message', 'fastway' ),
	'description'=>'Display a messsage/notice before checkout',
	'section'     => 'section_woo',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_only_free_shipping',
	'label'       => __( 'Show only Free Shipping', 'fastway' ),
	'section'     => 'section_woo',
	'description' => 'Hides other options if free shipping is available',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
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
	'type'        => 'text',
	'settings'    => 'ca_extra_roles',
	'label'       => __( 'Extra roles', 'fastway' ),
	'description'	=>	'Nombre del rol, separados con ",".',
	'section'     => 'section_woo_roles',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_extra_tax',
	'label'       => __( 'Extra Taxonomias', 'fastway' ),
	'description'	=>	'Nombres de taxonomias (genero,otros)',
	'section'     => 'section_woo',
	'default'     => '',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'ca_roles_mayorista',
	'label'       => esc_attr__( 'Lista de precios', 'fastway' ),
	'description' => 'Al estar activos aca, y teniendo el field ya creado con custom fields, se le da permiso al shop manager para que los asigne, y tambien se habilitan los precios para cada rol',
	'section'     => 'section_woo_roles',
    'choices'     => fw_getme_roles(),
	'default'     => ''
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'ca_roles_css',
	'label'       => esc_attr__( 'CSS Roles', 'fastway' ),
	'description' => 'Los roles activos se le agregara una clase del rol al body, depende en cual esten iniciado sesion.',
	'section'     => 'section_woo_roles',
    'choices'     => fw_getme_roles(),
	'default'     => ''
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-roles',
	'label'       => __( 'CSS For Roles ', 'fastway' ),
	'section'     => 'section_woo_roles',
	'description' => 'Classes: .role',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
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
	'description' => 'Classes: .woocommerce-shop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_calculator_shipping',
	'label'       => __( 'Show Shipping Calculator', 'fastway' ),
	'section'     => 'section_woo_single',
	'description' => 'Refrescar despues de activar',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
*/
/*PAYMENTS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_1_on',
	'label'    => __( 'Box 1', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_1_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-credit-card',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_1_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Tarjeta de Crédito',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_1_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<h3>Pagá Online con MercadoPago</h3>
	<a target="_blank" data-toggle="modal" data-target="#modal_modalmp" class="btn fw_icon_link fancybox">Ver promociones</a>
	<div class="modal modal_modalmp fade" id="modal_modalmp" tabindex="-1" role="dialog" aria-labelledby="modal_modalmpTitle" aria-hidden="true">
	   <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <div class="modal-body">
				<iframe height="1000" width="100%" frameborder="0" title="Promociones bancarias" scrolling="no" src="https://www.mercadolibre.com.ar/gz/home/payments/methods?modal=true"></iframe>
			 </div>
		  </div>
	   </div>
	</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_2_on',
	'label'    => __( 'Box 2', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_2_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-hand-holding-usd',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_2_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Efectivo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_2_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<div class="specs">Podés pagar al contado en nuestras sucursales.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_3_on',
	'label'    => __( 'Box 3', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_3_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-money-check-alt',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_3_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Depósito / Transferencia',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_3_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<div class="specs">Puede demorar hasta 72hs hábiles en acreditarse.</div>
	<a target="_blank" data-toggle="modal" data-target="#modal_bancos" class="btn fw_icon_link fancybox">Ver datos</a>
	<div class="modal modal_bancos fade" id="modal_bancos" aria-hidden="true">
	   <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <div class="modal-body">
				[altoweb_bancos]
			 </div>
		  </div>
	   </div>
	</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_4_on',
	'label'    => __( 'Box 4', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_4_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-barcode-read',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_4_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Cupón de Pago',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_4_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<img stclass="aligncenter" width="60%" src="/wp-content/themes/fastway/assets/img/cupones.png">
	<div class="specs">Imprmí el cupón o copiá el código, vas a RapiPago, Pago Fácil, Provincia Net o Bapro Pago y listo!</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_5_on',
	'label'    => __( 'Box 5', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_5_icon',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_5_title',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_5_desc',
	'section'     => 'section_woo_payments',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_6_on',
	'label'    => __( 'Box 6', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_6_icon',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_6_title',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_6_desc',
	'section'     => 'section_woo_payments',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_1_on',
	'label'    => __( 'Box 1', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_1_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-motorcycle',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_1_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'En el día, en moto',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_1_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>CABA / GBA consultar costos</h3>
	<div class="specs">Para recibirlo en el día solicitarlo antes de las 13hs, 50% de recargo día de lluvia.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_2_on',
	'label'    => __( 'Box 2', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_2_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-bus',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_2_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Envío a terminal',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_2_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>Despachamos sin cargo</h3><div class="specs">Recibilo de 2 a 5 dias.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_3_on',
	'label'    => __( 'Box 3', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_3_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-shipping-fast',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_3_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Envíos a todo el país',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_3_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>Consulta el costo con tu código postal en el producto a comprar.</h3><div class="specs">Despachamos dentro de las 24hs de realizada la compra. Recibilo de 2 a 5 dias.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_4_on',
	'label'    => __( 'Box 4', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_4_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-truck-container',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_4_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Flete',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_4_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<div class="specs">Fletes a todo el país.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_5_on',
	'label'    => __( 'Box 5', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_5_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-store',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_5_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Retiro en el local',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_5_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<div class="specs">Retiralo en nuestro local [fw_data type="address" only_text="true"]</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_6_on',
	'label'    => __( 'Box 6', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_6_icon',
	'section'     => 'section_woo_shippings',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_6_title',
	'section'     => 'section_woo_shippings',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_6_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );


if(is_plugin_active('woocommerce-mercadoenvios/woocommerce-mercadoenvios.php')){

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_only_mercadoenvios',
	'label'       => __( 'Calculate Only Mercadoenvios', 'fastway' ),
	'section'     => 'section_woo_single',
	'description' => 'Refrescar despues de activar',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
}
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_tab_additional',
	'label'       => __( 'Pestaña espeficiaciones (medidas)', 'fastway' ),
	'section'     => 'section_woo_single',
	'description' => 'Refrescar despues de activar',
	'default'     => 'off',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'related_columns',
	'label'       => esc_attr__( 'Related Columns', 'fastway' ),
	'section'     => 'section_woo_single',
	'default'     => 6,
	'choices'     => array(
		'min'  => '3',
		'max'  => '12',
		'step' => '1',
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
	[altoweb_financiacion]
	[/fw_single_summary]
	[fw_single_tabs]
	[/fw_single_container]
	[fw_single_related]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => __( 'CSS Single Product', 'fastway' ), 
	'description' => 'Everything goes inside .fw_single_product',
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
	'description' => 'Everything goes inside #footer',
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
	'default'     => '<div id="fw_footercopy" style="border-top:1px solid #d3d3d3;" class="container-fluid d-flex justify-content-between align-items-center"><div class="izquierda" style="font-size:15px !important;">Desarrollado por  <a href="https://www.altoweb.co" target="_blank" rel="noopener"><img class="logofirma"  height="30" src="/wp-content/themes/fastway/assets/img/logo-footer.png"/></a></div><div class="copyright d-none d-md-block" style="font-size:15px !important;">Copyright ©  [fw_data  type="name" only_text="true" size="15"] | Todos los derechos reservados.</div></div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

/*TYPOGRAPHY*/
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fa_pro',
	'label'       => __( 'FontAwesome Pro', 'fastway' ),
	'description' => '*you have to purchase a pro licence and then add your domains.',
	'section'     => 'section_typos',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Enable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_icons_style',
	'label'       => 'Font Awesome Pro Styles',
	'section'     => 'section_typos',
	'default'     => 'fad',
	'choices'     => array(
		'fa'   =>  'Regular',
		'fas'  => 'Solid',
		'fad'  => 'Duotone',
		'fal'  => 'Light',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-header',
	'label'       => __( 'Main Navigation', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.navbar-nav li > a',
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
	'settings'    => 'opt-typography-h1',
	'label'       => __( 'H1', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '40px',
		'line-height'    => '44px',
		'color'     => '#000',
	),
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
		'color'     => '#000',
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
		'color'     => '#000',
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
		'color'     => '#000',
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
		'color'     => '#000',
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
		array(
			'element' => 'body li',
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
/*
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

*/

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
	'description'     => '[fw_loop_container][fw_loop_image][fw_short_desc][fw_loop_title][fw_if][fw_loop_price][fw_loop_cart][/fw_loop_container][fw_loop_btn type="ajax/link"]',
	'default'     => '[fw_loop_container][fw_loop_image][fw_loop_title][fw_loop_price][/fw_loop_container][fw_loop_btn]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-loop',
	'label'       => __( 'CSS Product Loop', 'fastway' ),
	'section'     => 'section_woo_loop',
	'description' => 'Classes: .fw_product_loop',
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
	'description' => 'Classes: .fw_cat_loop',
	'default'     => '
	.fw_cat_loop .title {
		text-align: center;
		font-size: 22px!important;
		text-transform: uppercase;
		background-color: #F5F5F5;
		border-top: 3px solid var(--main);
		padding: 10px;
	}',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_brand_code',
	'label'       => __( ' Brand Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_brand',
	'description'     => '[fw_brand_container][fw_brand_image][fw_brand_title][fw_brand_desc][/fw_brand_container]',
	'default'     => '[fw_brand_container][fw_brand_image][fw_brand_title][/fw_brand_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_brand',
	'label'       => __( 'CSS Brand Loop', 'fastway' ),
	'section'     => 'section_woo_loop_brand',
	'description' => 'Classes: .fw_brand_loop',
	'default'     => '
	.fw_brand_loop .title {
		text-align: center;
		font-size: 22px!important;
		text-transform: uppercase;
		background-color: #F5F5F5;
		border-top: 3px solid var(--main);
		padding: 10px;
	}',
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
	Se puede especificar los valores poniendo el valor del link entre parentesis para el whatsapp<br>campo:1154999795 (541154999795) <br>resultado: <a href="+5491154999795">1154999795</a> 
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
    'description'     => __( '[fw_data type="name"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companywhatsapp',
	'label'    => __( 'Company Whatsapp', 'fastway' ),
    'description'     => __( '[fw_data type="whatsapp"] empezar con 549, sin el + [fw_data type="whatsapp"] Ej: 11 54 999 795 (5491154999795)', 'fastway' ),
                
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyphone',
	'label'    => __( 'Company Phone', 'fastway' ),
    'description'     => __( '[fw_data type="phone"]<br>*El tel: se pone solo ', 'fastway' ),            
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyaddress',
	'label'    => __( 'Company Address', 'fastway' ),
    'description'     => __( '[fw_data type="address"] ', 'fastway' ),
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
    'description'     => __( '[fw_data type="email"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyfb',
	'label'    => __( 'Company Facebook', 'fastway' ),
    'description'     => __( '[fw_data type="fb"]', 'fastway' ),
	'section'     => 'section_data',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyig',
	'label'    => __( 'Company Instagram', 'fastway' ),
    'description'     => __( '[fw_data type="ig"]', 'fastway' ),            
	'section'     => 'section_data',
) );
//Ohojo el. nombre
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companylinkedin',
	'label'    => __( 'Company Linkedin', 'fastway' ),
    'description'     => __( '[fw_data type="linkedin"]', 'fastway' ),            
	'section'     => 'section_data',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyyoutube',
	'label'    => __( 'Company Youtube', 'fastway' ),
   	'description'     => __( '[fw_data type="youtube"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companytwitter',
	'label'    => __( 'Company Twitter Url', 'fastway' ),
   	'description'     => __( '[fw_data type="twitter"]', 'fastway' ),
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
	'type'        => 'number',
	'settings'    => 'fw_max_media_upload',
	'label'    => __( 'Max Media Size Upload (500KB)', 'fastway' ),       
	'section'     => 'section_general',
	'default'	=>	500,
	'description'=>'Tamaño maximo de KB permitido para que los clientes suban a media,asi los obligamos a subidas livianas.'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'maintainance_code',
	'label'       => __( 'Under Maintainance/Construction Html', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<div>[fw_logo]<h1>Sitio en mantenimiento.</h1><div><p>Perdone las molestias, volveremos pronto!</p></div></div><br><br><div class="" style="font-size:10px !important;">Este sitio es mantenido por:<br><br>  <a href="https://www.altoweb.co" target="_blank" rel="noopener"><img class="logofirma"  height="30" src="/wp-content/themes/fastway/assets/img/logo.png"/></a></div>',
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
	'default'     => urlforimages()."/assets/img/logo.png"
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
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_popup_type',
	'label'       => __( 'Popup', 'fastway' ),
	'section'     => 'section_popup',
	'default'     => 'off',
	'description' => '<a href="/?testmodal=yes" target="_blank">Test Modal</a>  para probarlo manualmente, sino se muestra una sola vez por dia.',
	'choices'     => array(
		'off' => __( 'Disable', 'fastway' ),
		'image' => __( 'Image', 'fastway' ),
		'html' => __( 'Html', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_popup_html',
	'label'       => __( 'HTML', 'fastway' ),
	'section'     => 'section_popup',
	'default'	=>'<h1>
	Suscribite a nuestro newsletter!
</h1>
<p class="subtitle">
	Enterate de ofertas exclusivas, nuevos lanzamientos y mucho más
</p>
',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_popup_img',
	'label'       => __( 'Popup Img', 'fastway' ),
	'section'     => 'section_popup',

) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'popup-link',
	'label'    => __( 'Link', 'fastway' ),       
	'section'     => 'section_popup',
	'description' => 'Dejar vacio si no hay link'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_popup_form_mode',
	'label'       => __( 'Form', 'fastway' ),
	'section'     => 'section_popup',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_pupup_form_id',
	'label'    => __( 'Form ID', 'fastway' ),       
	'section'     => 'section_popup',
	'description' => 'Formulario para el modal'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'popup-size',
	'label'       => __( 'Size', 'fastway' ),
	'section'     => 'section_popup',
	'choices'     => array(
		'modal-md'   => 'Medium',
		'modal-lg'	 => 'Large',
		'modal-sm'   => 'Small',
	),
	'default'     => 'modal-md',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'whats-button',
	'label'       => __( 'Whatsapp Widget', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 'simple',
	'choices'     => array(
		'none'   	=> 	'None',
		'simple'   	=> 	'Simple',
		'random'   	=> 	'Random',
		'multi' 	=> 	'Multiple',
	),
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
		<div class="woo" style="margin-top:40px;">
[fw_recent_products title="Lo más buscado esta semana" prodsperrow="6"]</div>
</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


/*SCRIPTS*/
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fathom-id',
	'label'    => __( 'Fathom ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'analytics-id',
	'label'    => __( 'Analyitics ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fbpixel_id',
	'label'    => __( 'Facebook Pixel ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagmanager_id',
	'label'    => __( 'Google Tag Manager (Global)', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagcheckout_id',
	'label'    => __( ' Tag Manager Conversion ID (Checkout)', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'opt-ace-editor-js',
	'label'       => __( 'JS Code', 'fastway' ),
	'description'       => __( 'Paste your JS code here.', 'fastway' ),
	'section'     => 'section_scripts',
	'default'  => 'jQuery(document).ready(function(){
		
	});',
	'choices'     => array(
		'language' => 'js',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_header_scripts',
	'label'    => __( 'Insert Scripts Header', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' => 'With the script tags',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_footer_scripts',
	'label'    => __( 'Insert Scripts Footer', 'fastway' ),       
	'section'     => 'section_scripts',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'thankyou_insert',
	'label'    => __( 'Thank You Page Code', 'fastway' ),       
	'section'     => 'section_woo',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_product_discount',
	'label'       => __( '1-Product Discount', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => 'Se aplica a los productos',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_cant',
	'label'    => __( '%', 'fastway' ),
	'description' => 'Porcentage de descuento a toda la tienda, se aplica a nivel producto',
	'section'     => 'section_woo_discount',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories',
	'label'       => __( 'Categories', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ","'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories_ext',
	'label'       => __( 'Categories Exclude', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ","'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories_ids_exc',
	'label'       => __( 'Exclude Products', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'El id se obtiene editando el producto, desde la URL, donde dice post=XXXX. IDs separados con ","'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount',
	'label'       => __( '2-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_ajax_search',
	'label'       => __( 'Ajax Search', 'fastway' ),
	'section'     => 'section_woo_search',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_search_by_sku',
	'label'       => __( 'Search by sku', 'fastway' ),
	'section'     => 'section_woo_search',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_search_categorized_only',
	'label'       => __( 'Exclude uncategorized', 'fastway' ),
	'section'     => 'section_woo_search',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
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
	'label'    => 'Producto existente',
	'section'     => 'section_labels',
	'default'	=>'En Stock',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'out-of-stock-text',
	'label'    => __( 'Out of Stock Label', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'Agotado', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-link-text',
	'label'    => __( 'Ver detalle (Loop)', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'Ver detalle', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-text',
	'label'    => __( 'Add to cart (Loop)', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>__( 'Agregar al carrito', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'proceed-to-checkout-text',
	'label'    => __( 'Boton al checkout', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>'Comprar',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_place_order_text',
	'label'    => __( 'Finalizar Compra', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>'Finalizar',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuit_label',
	'label'       => 'DNI/CUIT',
	'section'     => 'section_labels',
	'default'     => 'DNI/CUIT',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_user_text',
	'label'    => __( 'Login Text', 'fastway' ),
	'description' => '"username" para que tome el username si inicio',
	'section'     => 'section_labels',
	'default'	=>__( 'Ingresar', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_related_text',
	'label'    => __( 'Titulo Relacionados', 'fastway' ),
	'description' => 'Esto va en la pagina de single products',
	'section'     => 'section_labels',
	'default'	=>__( 'Quienes vieron este producto también compraron', 'fastway' ),
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
	'settings'    => 'fw_whats_btn',
	'label'    => __( 'Whats Label', 'fastway' ),  
	'description' => '[br] para new line',     
	'section'     => 'section_labels',
	'default' 		=>	'Estamos[br]On-Line!',
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

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_call_now',
	'label'    => __( 'Llamar ahora', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Llamar ahora',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_chat_whats',
	'label'    => __( 'Button Menu Whatsapp', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Consultar',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_consultar_price',
	'label'    => __( 'Consultar', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Consultar',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_cuotas',
	'label'    => __( 'Calcular envio', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Calculador de cuotas',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_costo_envio',
	'label'    => __( 'Calcular envio', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Calcular costo de envio a domicilio',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_debajo_checkout_message',
	'label'    => __( 'Mensage debajo del boton comprar (checkout)', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'',
) );


if ( ! function_exists( 'fw_theme_mod' ) ) {
    function fw_theme_mod( $field_id, $default_value = '' ) {
      if ( $field_id ) {
        if ( !$default_value ) {
          if ( class_exists( 'Kirki' ) && isset( Kirki::$fields[ $field_id ] ) && isset( Kirki::$fields[ $field_id ]['default'] ) ) {
            $default_value = Kirki::$fields[ $field_id ]['default'];
          }
		}
        $value = get_theme_mod( $field_id, $default_value );
        return $value;
      }
      return false;
	}
	if(!fw_theme_mod('fw_forceupdate_1')){
		//Force update 
    update_option('woocommerce_allowed_countries','all');
    update_option('woocommerce_ship_to_countries','all');
    update_option('woocommerce_default_customer_address','geolocation');
		
	set_theme_mod('fw_forceupdate_1',true);
	}
}

add_shortcode('fwcf', 'fwcf');
function fwcf($atts = [], $content = null){
	/*trae a modo shortcode cualquier variable de fw*/
	$atts = shortcode_atts(array('field' => '' ), $atts );
	$custom=fw_theme_mod($atts['field']);
	return $custom;
}

function my_customizer_styles() { ?>
	<style>
	.customize-control-kirki-multicheck ul {
		display:flex;
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


