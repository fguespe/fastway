<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*

     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    global $THEME_DIR;
    global $THEME_URI;
    global $THEME_IMG_URI;
    global $THEME_CSS_URI;
    global $THEME_JS_URI;
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General', 'redux-framework-demo' ),
        'id'               => 'general',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'general-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default'  => array( 'url' => get_template_directory_uri() . "/assets/img/logo.svg"),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'       => 'img-404',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( '404 img', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default'  => array( 'url' => get_template_directory_uri() . "/assets/img/error.png" ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
            'id'       => 'container-main',
            'type'     => 'image_select',
            'title'    => 'Main Layout',
            'subtitle' => 'Main layout: wide or boxed',
            'desc'     => '',
            'options'  => array(
                'container-fluid' => array(
                    'alt' => 'wide',
                    'img' => $THEME_IMG_URI . 'layout-full.png'
                ),
                'container' => array(
                    'alt' => 'boxed',
                    'img' => $THEME_IMG_URI . 'layout-boxed.png'
                )
            ),
            'default'  => 'container'
            ),
            array(
            'id'       => 'layout-main',
            'type'     => 'image_select',
            'title'    => 'Sidebars Layout',
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'full' => array(
                    'alt' => 'full_width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left' => array(
                    'alt' => 'left_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'right_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both' => array(
                    'alt' => 'all_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'full',
             

        ),
            
            
        )
    ) );
    $theme_headers = array();
    for( $i=1; $i<=20; $i++ ) {
        for( $j=1; $j<=5; $j++ ) {
            if( file_exists( $THEME_DIR . "images/theme-option-header{$i}-{$j}.png" ) ) {
                $theme_headers[$i."-".$j] = array(
                    'alt' => $i."-".$j,
                    'img' => $THEME_IMG_URI . "theme-option-header{$i}-{$j}.png"
                );
            }
        }   
    }
    $theme_headers_mobile = array();
    for( $i=1; $i<=20; $i++ ) {
        if( file_exists( $THEME_DIR . "images/theme-option-header-mobile{$i}.png" ) ) {
            $theme_headers_mobile[$i] = array(
                'alt' => $i,
                'img' => $THEME_IMG_URI . "theme-option-header-mobile{$i}.png"
            );
        }
    }
    $loop_templates = array();
    for( $i=1; $i<=3; $i++ ) {
        if( file_exists( $THEME_DIR . "images/woo_product{$i}.jpg" ) ) {
            $loop_templates[$i] = array(
                'alt' => $i,
                'img' => $THEME_IMG_URI . "woo_product{$i}.jpg"
            );
        }
    }
    $single_templates = array();
    for( $i=1; $i<=3; $i++ ) {
        if( file_exists( $THEME_DIR . "images/woo_product_single{$i}.jpg" ) ) {
            $single_templates[$i] = array(
                'alt' => $i,
                'img' => $THEME_IMG_URI . "woo_product_single{$i}.jpg"
            );
        }
    }
    $loop_templates_mobile = array();
    for( $i=1; $i<=3; $i++ ) {
        if( file_exists( $THEME_DIR . "images/woo_product_mobile{$i}.jpg" ) ) {
            $loop_templates_mobile[$i] = array(
                'alt' => $i,
                'img' => $THEME_IMG_URI . "woo_product_mobile{$i}.jpg"
            );
        }
    }
    $single_templates_mobile = array();
    for( $i=1; $i<=3; $i++ ) {
        if( file_exists( $THEME_DIR . "images/woo_product_single{$i}.jpg" ) ) {
            $single_templates_mobile[$i] = array(
                'alt' => $i,
                'img' => $THEME_IMG_URI . "woo_product_single{$i}.jpg"
            );
        }
    }

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header', 'redux-framework-demo' ),
        'id'               => 'header',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'sticky-menu',
                'type'     => 'switch',
                'title'    => 'Sticky menu',
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header-padding',
                'type'     => 'text',
                'title'    => __( 'Header Padding', 'redux-framework-demo' ),
                'desc'     => __( 'Header Padding', 'redux-framework-demo' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'logo-width',
                'type'     => 'text',
                'title'    => __( 'Company Name', 'redux-framework-demo' ),
                'desc'     => __( 'Header Padding', 'redux-framework-demo' ),
                'default'  => "250",
            ),
            array(
            'id'       => 'top-header',
            'type'     => 'switch',
            'title'    => 'Top Header',
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
            ),
            array(
            'id'       => 'header-width',
            'type'     => 'button_set',
            'title'    => 'Header width',
            'options'  => array(
                'container' => 'Container',
                'container-fluid'  => 'Big Container'
            ),
            'default'  => 'container'
            ),
            array(
            'id'       => 'header-style',
            'type'     => 'image_select',
            'title'    => 'Header style',
            'options'  => $theme_headers,
            'default'  => '1-1',
            ),
            array(
            'id'       => 'header-headerwidget-start',
            'type'     => 'section',
            'title'    => esc_html__( 'header headerwidget', 'theshopier' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'header-headerwidget-switch',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show header headerwidget', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'header-headerwidget-text',
            'type'     => 'ace_editor',
            'mode'       => 'php',
            'theme'      => 'chrome',
            'required' => array( 'header-headerwidget-switch', '=', '1' ),
            'title'    => esc_html__( 'header headerwidget text', 'theshopier' ),
            'default'  => '',
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-header-headerwidget',
            'type'      => 'ace_editor',
            'required' => array( 'header-headerwidget-switch', '=', '1' ),
            'title'    => esc_html__( 'header headerwidget text', 'theshopier' ),
            'default'  => '',
            'mode'     => 'css',
            'theme'    => 'monokai',
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'     => 'header-headerwidget-end',
            'type'   => 'section',
            'indent' => false,
        ),
            

        )
    ) );


    
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Mobile', 'redux-framework-demo' ),
        'id'               => 'mobile',
        'icon'          => 'el el-phone',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
            'id'       => 'fw-quicklinks',
            'type'     => 'switch',
            'title'    => 'Quicklinks',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
            ),
            array(
            'id'       => 'header-mobile-style',
            'type'     => 'image_select',
            'title'    => 'Mobile Header Style',
            'options'  => $theme_headers_mobile,
            'full_width'    => true,
            'default'  => '1',
            ),
             array(
            'id'       => 'shop-loop-mobile-product-style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Catalog Mobile Item style', 'fastway' ),
            'full_width'    => true,
            'options'  => $loop_templates_mobile,
            'default'  => '1'
            ),
            array(
            'id'       => 'shop-single-mobile-product-style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Single Mobile Style', 'fastway' ),
            'full_width'    => true,
            'options'  => $single_templates,
            'default'  => '1'
            ),
           
        )
    ) );
    
    

    $static_block_args = fastway_get_stblock();
    Redux::setSection( $opt_name, array(
    'title'         => 'Footer',
    'id'            => 'footer',
    'icon'          => 'el el-website',
    'fields'        => array(

        array(
            'id'       => 'footer-width',
            'type'     => 'button_set',
            'title'    => 'Footer width',
            'options'  => array(
                'container' => 'Container',
                'container-fluid'  => 'Big Container'
            ),
            'default'  => 'container'
        ),
        array(
            'id'       => 'footer-stblock',
            'type'     => 'select',
            'title'    => 'Static block',
            'options'  => $static_block_args
        ),
        array(
            'id'       => 'footer-copyright-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Footer copyright', 'theshopier' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'footer-copyright-switch',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Footer copyright', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'footer-copyright-text',
            'type'     => 'ace_editor',
            'mode'       => 'php',
            'theme'      => 'chrome',
                
            'required' => array( 'footer-copyright-switch', '=', '1' ),
            'title'    => esc_html__( 'Footer copyright text', 'theshopier' ),
            'default'  => '<div id="footercopy"><div class="izquierda">Desarrollado por <a href="https://www.briziolabz.com" target="_blank" rel="noopener"><img class="logofirma" style="height: 30px !important;" src="'.get_template_directory_uri() . "/assets/img/logo.svg".'" /></a></div><div class="derecha"><div class="copyright">Copyright © COMPANY | Todos los derechos reservados.</div></div></div>',
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-footer-copywright',
            'type'      => 'ace_editor',
            'mode'     => 'css',
            'theme'    => 'monokai',
                
            'required' => array( 'footer-copyright-switch', '=', '1' ),
            'title'    => esc_html__( 'Footer copyright text', 'theshopier' ),
            'default'  => '#footercopy{width:100%;float:left!important;padding:5px 15px;border-top:1px solid #d3d3d3;line-height:30px!important;font-size:15px!important}#footercopy .izquierda{display:inline-block;float:left;width:50%}#footercopy .derecha{float:right!important;text-align:right;width:50%!important}@media (max-width:700px){#footercopy .copyright{display:none}#footercopy .izquierda{width:100%;text-align:center!important}}#footercopy .logofirma{height:30px}',
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'     => 'footer-copyright-end',
            'type'   => 'section',
            'indent' => false,
        ),
      
    )
    ) );

    // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'redux-framework-demo' ),
        'id'     => 'typography',
        'desc'   => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-h1',
                'type'     => 'typography',
                'title'    => __( 'H1 Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'text-transform'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '40px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),

            array(
                'id'       => 'opt-typography-h2',
                'type'     => 'typography',
                'title'    => __( 'H2 Font', 'redux-framework-demo' ),
                'text-transform'   => true,
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '32px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
            array(
                'id'       => 'opt-typography-h3',
                'type'     => 'typography',
                'title'    => __( 'H3 Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'text-transform'   => true,
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '28px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
            array(
                'id'       => 'opt-typography-h4',
                'type'     => 'typography',
                'title'    => __( 'H4 Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'text-transform'   => true,
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '24px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
            array(
                'id'       => 'opt-typography-div',
                'type'     => 'typography',
                'title'    => __( 'div Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'text-transform'   => true,
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '14px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
            array(
                'id'       => 'opt-typography-p',
                'type'     => 'typography',
                'title'    => __( 'p Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'text-transform'   => true,
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '14px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
            array(
                'id'       => 'opt-typography-span',
                'type'     => 'typography',
                'title'    => __( 'span Font', 'redux-framework-demo' ),
                'text-transform'   => true,
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '14px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
            array(
                'id'       => 'opt-typography-a',
                'type'     => 'typography',
                'title'    => __( 'a Font', 'redux-framework-demo' ),
                'text-transform'   => true,
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'default'  => array(
                    'color'       => 'black',
                    'font-size'   => '14px',
                    'font-family' => 'Arial,Helvetica,sans-serif',
                    'font-weight' => 'Normal',
                    'text-transform'   => 'none',
                ),
            ),
           
            
           


            
        )
    ) );
    Redux::setSection( $opt_name, array(
    'title'  => 'Color scheme',
    'id'     => 'color_scheme',
    'desc'   => '',
    'icon'   => 'el el-magic',
    'fields' => array(

       array(
                'id'       => 'opt-color-main',
                'type'     => 'color',
                'output'   => array( '.site-title' ),
                'title'    => __( 'Main Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a title color for the theme (default: #000).', 'redux-framework-demo' ),
                'default'  => '#000000',
        ),
       array(
                'id'       => 'opt-color-topheader',
                'type'     => 'color',
                'output'   => array( '.site-title' ),
                'title'    => __( 'Top Header', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a title color for the theme (default: #000).', 'redux-framework-demo' ),
                'default'  => '#ffffff',
        ),
       array(
                'id'       => 'opt-color-iconheader',
                'type'     => 'color',
                'output'   => array( '.site-title' ),
                'title'    => __( 'Icon Header', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a title color for the theme (default: #000).', 'redux-framework-demo' ),
                'default'  => '#000000',
        ),
        array(
                'id'       => 'opt-color-middheader',
                'type'     => 'color',
                'title'    => __( 'Middle Header', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a background color for the footer (default: black).', 'redux-framework-demo' ),
                'default'  => '#ffffff',
                'validate' => 'color',
        ),
        array(

                'id'       => 'opt-color-bottheader',
                'type'     => 'color',
                'title'    => __( 'Bottom Header', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a background color for the footer (default: black).', 'redux-framework-demo' ),
                'default'  => '#ffffff',
                'validate' => 'color',
        ),
        array(
                'id'       => 'opt-color-bodycolor',
                'type'     => 'color',
                'title'    => __( 'Body', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a background color for the footer (default: black).', 'redux-framework-demo' ),
                'default'  => '#ffffff',
                'validate' => 'color',
        ),
        array(
                'id'       => 'opt-color-footer',
                'type'     => 'color',
                'title'    => __( 'Footer', 'redux-framework-demo' ),
                'subtitle' => __( 'Pick a background color for the footer (default: black).', 'redux-framework-demo' ),
                'default'  => '#ffffff',
                'validate' => 'color',
        ),
      
    )
    ) );

    Redux::setSection( $opt_name, array(
    'title' => 'CSS Editor',
    'id'    => 'editor-page',
    'desc'  => '',
    'icon'  => 'el el-file-edit',
    'fields'     => array(
        array(
            'id'        => 'css_editor-general',
            'type'      => 'ace_editor',
            'title'     => 'CSS General',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-header',
            'type'      => 'ace_editor',
            'title'     => 'CSS Header',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),

        array(
            'id'        => 'css_editor-body',
            'type'      => 'ace_editor',
            'title'     => 'CSS Body',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-footer',
            'type'      => 'ace_editor',
            'title'     => 'CSS Footer',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-loop',
            'type'      => 'ace_editor',
            'title'     => 'CSS Product Loop',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-single',
            'type'      => 'ace_editor',
            'title'     => 'CSS Product Single',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'css_editor-mobile',
            'type'      => 'ace_editor',
            'title'     => 'CSS Mobile',
            'mode'      => 'css',
            'theme'    => 'monokai',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),


        
    ),
) );
    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Extras', 'redux-framework-demo' ),
        'id'               => 'basic',
        'desc'             => __( 'Algunos tips y opciones generales', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            
            array(
                'id'   => 'opt-info-field1',
                'type' => 'info',
                'style' => 'warning',
                'desc' => __( 'USAR UN SOLO ESPACIO VACIO , NO VARIOS ABAJO DEL OTRO', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field1',
                'type' => 'info',
                'style' => 'warning',
                'desc' => __( 'Setear el icon header color sino los iconos qedan negros', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field121',
                'type' => 'info',
                'style' => 'warning',
                'desc' => __( '[fw_extras_short type="address" text="Ruta panamericana KM 49,5. Complejo concord - Edificio Los almendros 122 1° Piso " size="15" icon_color="#97AABA" text_color="#97AABA"]', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field1',
                'type' => 'info',
                'style' => 'warning',
                'desc' => __( 'ACORDARSE DE LA DESCRIPCION SEO Y FAVICON', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field45',
                'type' => 'info',
                'style' => 'success',
                'desc' => __( 'Hide on desktop class = d-md-none', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field2',
                'type' => 'info',
                'style' => 'success',
                'desc' => __( 'Hide on mobile class = d-none d-md-flex', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field3',
                'type' => 'info',
                'style' => 'success',
                'desc' => __( 'menu horizontal = .menuhor', 'redux-framework-demo' )
            ),
            array(
                'id'   => 'opt-info-field4',
                'type' => 'info',
                'style' => 'success',
                'desc' => __( '.columnamobile (50%) | .trescolumnasmobile (33%) *solo usar en casos especiales', 'redux-framework-demo' )
            ),
             array(
                'id'   => 'opt-info-field454',
                'type' => 'info',
                'style' => 'success',
                'desc' => __( '.two_mobile_columns (50%) | three_mobile_columns (33%) | four_mobile_columns (25%)', 'redux-framework-demo' )
            ),
            
            array(
                'id'       => 'short-fw_companyname',
                'type'     => 'text',
                'title'    => __( 'Company Name', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyname]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companywhatsapp',
                'type'     => 'text',
                'title'    => __( 'Company Whatsapp', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companywhatsapp] empezar con +54', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companyphone',
                'type'     => 'text',
                'title'    => __( 'Company Phone', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyphone]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companyaddress',
                'type'     => 'text',
                'title'    => __( 'Company Adress', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyaddress]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companygooglemaps',
                'type'     => 'text',
                'title'    => __( 'Google Maps Url', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companygooglemaps]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companyemail',
                'type'     => 'text',
                'title'    => __( 'Company Email', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyemail]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companyfb',
                'type'     => 'text',
                'title'    => __( 'Company Facebook Url', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyfb]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companyig',
                'type'     => 'text',
                'title'    => __( 'Company Instagram Url', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyig]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'short-fw_companyyoutube',
                'type'     => 'text',
                'title'    => __( 'Company Youtube Url', 'redux-framework-demo' ),
                'desc'     => __( '[fw_companyyoutube]', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'opt-ace-editor-js',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your JS code here.', 'redux-framework-demo' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_blank">' . 'http://' . 'ace.c9.io/</a>.',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
             array(
                    'id'       => 'seo-desc',
                    'type'     => 'textarea',
                    'title'    => __( 'SEO Description', 'redux-framework-demo' ),
                    'default'  => 'Default Text',
                )
            

           

        )
    ) );
    

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }



Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Woocommerce', 'fastway' ),
    'id'    => 'woocommerce',
    'desc'  => '',
    'icon'  => 'el el-shopping-cart'
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Shop page', 'fastway' ),
    'id'         => 'woo-shop-page',
    'subsection' => true,
    'icon'  => 'el el-folder-close',
    'fields'     => array(
        array(
            'id'       => 'container-shop',
            'type'     => 'image_select',
            'title'    => 'Shop Layout',
            'subtitle' => 'Main layout: wide or boxed',
            'desc'     => '',
            'options'  => array(
                'container-fluid' => array(
                    'alt' => 'wide',
                    'img' => $THEME_IMG_URI . 'layout-full.png'
                ),
                'container' => array(
                    'alt' => 'boxed',
                    'img' => $THEME_IMG_URI . 'layout-boxed.png'
                )
            ),
            'default'  => 'container'
        ),
        array(
            'id'       => 'cart-style',
            'type'     => 'button_set',
            'title'    => 'Cart Style',
            'options'  => array(
                'link' => 'Link',
                'popup' => 'Popup',
                'modal'  => 'Modal',
                'sidebar'  => 'Sidebar',
            ),
            'default'  => 'popup'
            ),
        array(
            'id'       => 'shop-layout',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Shop Pages Layout', 'fastway' ),
            'subtitle' => esc_html__( 'Main layout: none slidebar, left slidebar or right slidebar.', 'fastway' ),
            'desc'     => '',
            'options'  => array(
                'full' => array(
                    'alt' => 'full_width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left' => array(
                    'alt' => 'left_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'right_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both' => array(
                    'alt' => 'all_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'full'
        ),
        array(
            'id'       => 'shop-left-sidebar',
            'type'     => 'select',
            'title'    => 'Select Left Sidebar',
            'data'     => 'sidebars',
            'default'  => 'shop-widget-area-left',
            'required' => array( 'shop-layout', '=', array( '1-0', '1-1' ) )
        ),
        array(
            'id'       => 'shop-right-sidebar',
            'type'     => 'select',
            'title'    => 'Select Right Sidebar',
            'data'     => 'sidebars',
            'default'  => 'shop-widget-area-right',
            'required' => array( 'shop-layout', '=', array( '0-1', '1-1' ) )
        ),
        array(
            'id'      => 'shop_per_page',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Product Per Page', 'fastway' ),
            'desc'    => esc_html__( 'Min: 4, max: 100, step:1, default: 12', 'fastway' ),
            'default' => '12',
            'min'     => '4',
            'step'    => '1',
            'max'     => '100',
        ),
        array(
            'id'      => 'shop_columns',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Shop Product Columns', 'fastway' ),
            'desc'    => esc_html__( 'Min: 2, max: 12, step:1, default value: 3', 'fastway' ),
            'default' => '4',
            'min'     => '2',
            'step'    => '1',
            'max'     => '12',
        ),

        array(
            'id'   => 'shop-layout-opt-divide',
            'type' => 'divide'
        ),

        array(
            'id'       => 'shop-loop-product-style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Catalog item style', 'fastway' ),
            'full_width'    => true,
            'options'  => $loop_templates,
            'default'  => '1'
        ),


    ),
) );


Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Product page', 'fastway' ),
    'id'         => 'woo-product-page',
    'desc'       => '',
    'icon'      => 'el el-file',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'       => 'product-page-layout',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Product Page Layout', 'fastway' ),
            'subtitle' => esc_html__( 'Main layout: none slidebar, left slidebar or right slidebar.', 'fastway' ),
            'desc'     => '',
            'options'  => array(
                'full' => array(
                    'alt' => 'full_width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left' => array(
                    'alt' => 'left_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'right_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both' => array(
                    'alt' => 'all_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'full'
        ),

        array(
            'id'       => 'product-page-left-sidebar',
            'type'     => 'select',
            'title'    => 'Select Left Sidebar',
            'data'     => 'sidebars',
            'default'  => '',
            'required' => array( 'product-page-layout', '=', array( '1-0', '1-1' ) )
        ),
        array(
            'id'       => 'product-page-right-sidebar',
            'type'     => 'select',
            'title'    => 'Select Right Sidebar',
            'data'     => 'sidebars',
            'default'  => '',
            'required' => array( 'product-page-layout', '=', array( '0-1', '1-1' ) )
        ),

        array(
            'id'       => 'product-page-footer-block',
            'type'     => 'select',
            'title'    => 'Footer block',
            'options'  => $static_block_args,
        ),
         array(
            'id'       => 'shop-single-product-style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Catalog item style', 'fastway' ),
            'full_width'    => true,
            'options'  => $single_templates,
            'default'  => '1'
        ),

      
    ),
) );
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }
    
        /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

