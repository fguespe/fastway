<?php
global $theme_headers;
global $theme_headers_mobile ;
global $loop_templates ;
global $loop_templates_mobile;
global $single_templates;
global $single_templates_mobile;

Kirki::add_config( 'theme_config_id', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );


Kirki::add_panel( 'panel_fastway', array(
    'priority'    => 10,
    'title'       => esc_attr__( 'Fastway', 'textdomain' ),
    //'description' => esc_attr__( 'My panel description', 'textdomain' ),
) );
Kirki::add_section( 'section_general', array(
    'title'          => esc_attr__( 'General', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );
Kirki::add_section( 'section_header', array(
    'title'          => esc_attr__( 'Header', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );
Kirki::add_section( 'section_mobile', array(
    'title'          => esc_attr__( 'Mobile', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );

Kirki::add_section( 'section_typos', array(
    'title'          => esc_attr__( 'Typography', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );

Kirki::add_section( 'section_colors', array(
    'title'          => esc_attr__( 'Color Scheme', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );


Kirki::add_section( 'section_footer', array(
    'title'          => esc_attr__( 'Footer', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );

Kirki::add_section( 'section_css', array(
    'title'          => esc_attr__( 'CSS Editor', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );

Kirki::add_section( 'section_extras', array(
    'title'          => esc_attr__( 'Extras', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );

Kirki::add_section( 'section_woo', array(
    'title'          => esc_attr__( 'Woocommerce', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );
Kirki::add_section( 'section_woo_single', array(
    'title'          => esc_attr__( 'Single Product', 'textdomain' ),
    //'description'    => esc_attr__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_fastway',
    'priority'       => 160,
) );

//General
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'general-logo',
	'label'       => esc_attr__( 'Logo', 'textdomain' ),
	//'description' => esc_attr__( 'Description Here.', 'textdomain' ),
	'section'     => 'section_general',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'general-favi',
	'label'       => esc_attr__( 'Favi', 'textdomain' ),
    'description' => 'Also works for mobile icons in case of WPA',
	'section'     => 'section_general',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-desc',
	'label'       => esc_attr__( 'Meta Description', 'textdomain' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_general',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-image',
	'settings'    => 'container-main',
	'label'       => esc_html__( 'Main layout: wide or boxed', 'textdomain' ),
	'section'     => 'section_general',
	'default'     => 'container',
	'priority'    => 10,
	'choices'     => array(
		'container-fluid'   => get_template_directory_uri() . '/assets/img/options/wide.png',
		'container'   => get_template_directory_uri() . '/assets/img/options/boxed.png',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-image',
	'settings'    => 'layout-main',
	'label'       => esc_html__( 'Sidebars Layout', 'textdomain' ),
	'section'     => 'section_general',
	'default'     => 'full',
	'priority'    => 10,
	'choices'     => array(
		'full'   => get_template_directory_uri() . '/assets/img/options/wide.png',
		'left'   => get_template_directory_uri() . '/assets/img/options/left.png',
		'right'   => get_template_directory_uri() . '/assets/img/options/right.png',
		'both'   => get_template_directory_uri() . '/assets/img/options/boxed.png',
	),
) );

/*HEAADER*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'my_setting',
	'label'       => esc_attr__( 'Deactivate Sticky', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => array('fw_header_middle', 'fw_header_bottom'),
	'priority'    => 10,
	'choices'     => array(
		'fw_header_top' => esc_attr__( 'Top', 'textdomain' ),
		'fw_header_middle' => esc_attr__( 'Middle', 'textdomain' ),
		'fw_header_bottom' => esc_attr__( 'Bottom', 'textdomain' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header-padding',
	'label'       => esc_attr__( 'Header Padding', 'textdomain' ),
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
	'label'       => esc_attr__( 'Logo Width', 'textdomain' ),
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
	'label'       => esc_attr__( 'Top Header', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '0',
	'choices' => array(
	    'on'  => esc_attr__( 'Enable', 'textdomain' ),
	    'off' => esc_attr__( 'Disable', 'textdomain' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header-width',
	'label'       => __( 'Header Width', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => 'container',
	'choices'     => array(
		'container'   => esc_attr__( 'Boxed', 'textdomain' ),
		'container-fluid' => esc_attr__( 'Wide ', 'textdomain' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'topheader-img',
	'label'       => esc_attr__( 'Top Header Img', 'textdomain' ),
	//'description' => esc_attr__( 'Description Here.', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'topheader-img',
	'label'       => esc_attr__( 'Top Header Img', 'textdomain' ),
	//'description' => esc_attr__( 'Description Here.', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-style',
	'label'       => __( 'Header Block', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '1-1',
	'multiple'    => 1,
	'choices'     => $theme_headers,
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'headerwidget-html',
	'label'       => esc_attr__( 'Header Widget HTML', 'textdomain' ),
	'description'       => esc_attr__( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header-headerwidget',
	'label'       => esc_attr__( 'Header Widget CSS', 'textdomain' ),
	'description'       => esc_attr__( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_header',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*MOBILE*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-quicklinks',
	'label'       => esc_attr__( 'Quicklinks', 'textdomain' ),
	'section'     => 'section_mobile',
	'default'     => 0,
	'choices' => array(
	    'on'  => esc_attr__( 'Enable', 'textdomain' ),
	    'off' => esc_attr__( 'Disable', 'textdomain' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-mobile-style',
	'label'       => __( 'Header Mobile Block', 'textdomain' ),
	'description'	=>	'<a target="_blank" href="http://mvp/blocks/">See all blocks</a>',
	'section'     => 'section_mobile',
	'default'     => '1-1',
	'multiple'    => 1,
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


/*FOOTER*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer-width',
	'label'       => __( 'Footer Width', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => 'container',
	'choices'     => array(
		'container'   => esc_attr__( 'Boxed', 'textdomain' ),
		'container-fluid' => esc_attr__( 'Wide ', 'textdomain' ),
	),
) );

$static_block_args = fastway_get_stblock();
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'footer-stblock',
	'label'       => __( 'Static Block', 'textdomain' ),
	'section'     => 'section_mobile',
	'choices'     => $static_block_args,
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'footer-copyright-switch',
	'label'       => esc_attr__( 'Show Footer Copyright', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => 1,
	'choices' => array(
	    'on'  => esc_attr__( 'Enable', 'textdomain' ),
	    'off' => esc_attr__( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'footer-copyright-text',
	'label'       => esc_attr__( 'Footer Copyright HTML', 'textdomain' ),
	'description'       => esc_attr__( 'Not all headers have Header Widget', 'textdomain' ),
	'section'     => 'section_footer',
	'default'     => '<div id="footercopy"><div class="izquierda">Desarrollado por <a href="https://www.briziolabz.com" target="_blank" rel="noopener"><img class="logofirma" style="height: 30px !important;"  src="'.get_template_directory_uri().'/assets/img/logo.png"/></a></div><div class="derecha"><div class="copyright">Copyright © COMPANY | Todos los derechos reservados.</div></div></div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer-copywright',
	'label'       => esc_attr__( 'Footer Copyright CSS', 'textdomain' ),
	'description'       => esc_attr__( 'Not all headers have Header Widget', 'textdomain' ),
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
	'label'       => esc_attr__( 'H1', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '40px',
		'line-height'    => '40px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h2',
	'label'       => esc_attr__( 'H2', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '32px',
		'line-height'    => '32px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h3',
	'label'       => esc_attr__( 'H3', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '28px',
		'line-height'    => '28px',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h4',
	'label'       => esc_attr__( 'H4', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '24px',
		'line-height'    => '24px',
		'letter-spacing' => '0',
		'color'          => '#333333',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-body',
	'label'       => esc_attr__( 'Body', 'textdomain' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '14px',
		'letter-spacing' => '0',
		'color'          => '#333333',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
) );


/*Section CSS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-general',
	'label'       => esc_attr__( 'CSS General', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header',
	'label'       => esc_attr__( 'CSS Header', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-body',
	'label'       => esc_attr__( 'CSS Body', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer',
	'label'       => esc_attr__( 'CSS Footer', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-loop',
	'label'       => esc_attr__( 'CSS Product Loop', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-sidebarcats',
	'label'       => esc_attr__( 'CSS Sidebar Categorys', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => esc_attr__( 'CSS Single Product', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-mobile',
	'label'       => esc_attr__( 'CSS Mobile', 'textdomain' ),
	'section'     => 'section_css',
	'default'     => '',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*Extras*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'maintainance-mode',
	'label'       => esc_attr__( 'Maintainance Mode', 'textdomain' ),
	'section'     => 'section_extras',
	'default'     => 0,
	'choices' => array(
	    'on'  => esc_attr__( 'Enable', 'textdomain' ),
	    'off' => esc_attr__( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'popup-mode',
	'label'       => esc_attr__( 'Popup', 'textdomain' ),
	'section'     => 'section_extras',
	'default'     => 0,
	'choices' => array(
	    'on'  => esc_attr__( 'Enable', 'textdomain' ),
	    'off' => esc_attr__( 'Disable', 'textdomain' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'maintainance-mode-img',
	'label'       => esc_attr__( 'Maintainance Mode Img', 'textdomain' ),
	'section'     => 'section_extras',
	'default'		=> get_template_directory_uri()."/assets/img/mantenimiento.png"

) );Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'popup-img',
	'label'       => esc_attr__( 'Popup Img', 'textdomain' ),
	'section'     => 'section_extras',

) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'img-404',
	'label'       => esc_attr__( '404 img', 'textdomain' ),
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
	'label'       => esc_attr__( 'JS Code', 'textdomain' ),
	'description'       => esc_attr__( 'Paste your JS code here.', 'textdomain' ),
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




global $redux_demo;
$redux_demo=get_theme_mods();



/**
 * This function adds some styles to the WordPress Customizer
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
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'my_customizer_styles', 999 );


