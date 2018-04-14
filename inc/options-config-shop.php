<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) || !Theshopier::checkPlugin('nexthemes-plugin/nexthemes-plugin.php') ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theshopier_datas";

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    add_action( 'redux/loaded', 'theshopier_remove_demo' );

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    if(Theshopier::checkPlugin('nexthemes-plugin/nexthemes-plugin.php')) {
        $_parent_page_slug = 'nexthemes';
    } else {
        $_parent_page_slug = 'themes.php';
    }

$_color_xml_file = THEME_FRAMEWORK_INCS . "redux-framework/xml/color_options.xml";
$_font_xml_file = THEME_FRAMEWORK_INCS . "redux-framework/xml/font_options.xml";

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'theshopier' ),
        'page_title'           => esc_html__( 'Theshopier Options', 'theshopier' ),
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
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => $_parent_page_slug,
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => THEME_BACKEND_URI . 'images/nth-theme-ops-icon.png',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'nexthemes-options',
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
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

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

	$args['intro_text'] = '<a target="_blank" title="Documentation" href="http://demo.nexthemes.com/wordpress/theshopier/documentation">' . esc_html__( 'Documentation!', 'theshopier' ) . '</a>';

    /* Add content after the form.*/
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
            'title'   => esc_html__( 'Documentation', 'theshopier' ),
            'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'theshopier' ), array('p'=>array()))
        ),
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = wp_kses(__( '<p>This is the sidebar content, HTML is allowed.</p>', 'theshopier' ), array('p'=>array()));
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

$static_block_args = theshopier_get_stblock();
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'General', 'theshopier' ),
    'id'    => 'general',
    'icon'  => 'el el-dashboard',
    'fields'     => array(
        array(
            'id'       => 'nth-logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Logo URL', 'theshopier' ),
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc'     => '',
            'subtitle' => '',
            'default'  => array( 'url' => THEME_IMG_URI . 'logo.png' ),
            'hint'      => array(
                'title'     => esc_html__( 'Logo URL','theshopier'),
                'content'   => 'This logo will showing at main header.',
            )
        ),

        array(
            'id'       => 'logo-text',
            'type'     => 'text',
            'title'    => esc_html__( 'Logo text', 'theshopier' ),
            'desc'     => esc_html__( 'Field Description', 'theshopier' ),
            'default'  => 'Default logo',
        ),

        array(
            'id'       => '404page-stblock',
            'type'     => 'select',
            'title'    => esc_html__( 'Static block for PAGE-404', 'theshopier'),
            'options'  => $static_block_args,
        ),

        array(
            'id'       => 'pace-loader',
            'type'     => 'switch',
            'title'    => esc_html__( 'Pace loader', 'theshopier' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'nth-pace-logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Pace loading logo', 'theshopier' ),
            'default'  => array( 'url' => THEME_IMG_URI . 'logo_pace.png' ),
            'hint'      => array(
                'title'     => esc_html__( 'Pace loading logo URL', 'theshopier'),
                'content'   => esc_html__( 'This logo will showing on loading page','theshopier'),
            ),
            'required' => array( 'pace-loader', '=', '1' ),
        ),

        array(
            'id'       => 'layout-main',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Main Layout', 'theshopier' ),
            'subtitle' => esc_html__( 'Main layout: wide or boxed', 'theshopier' ),
            'desc'     => '',
            'options'  => array(
                'wide' => array(
                    'alt' => 'wide',
                    'img' => THEME_IMG_URI . 'layout-full.png'
                ),
                'boxed' => array(
                    'alt' => 'boxed',
                    'img' => THEME_IMG_URI . 'layout-boxed.png'
                )
            ),
            'default'  => 'wide'
        ),

        array(
            'id'       => 'smooth-scroll',
            'type'     => 'switch',
            'title'    => esc_html__( 'Smooth Scroll', 'theshopier' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'sidebar-widget-style',
            'type'     => 'select',
            'title'    => __( 'Sidebar widget style', 'theshopier' ),
            'options'  => array(
                'default'       => esc_attr__('Default', 'theshopier'),
                'outline_style' => esc_attr__('Outline style', 'theshopier'),
            ),
            'default'   => 'default'
        ),

        array(
            'id'       => 'newsletter-popup',
            'type'     => 'switch',
            'title'    => esc_html__( 'Newsletter popup', 'theshopier' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'newsletter-popup-content',
            'type'     => 'select',
            'title'    => esc_html__( 'Newsletter popup content', 'theshopier' ),
            'options'  => $static_block_args,
            'required' => array( 'newsletter-popup', '=', '1' ),
        ),

        array(
            'id'       => 'google-map-api',
            'type'     => 'text',
            'title'    => esc_html__( 'Google maps API', 'theshopier' ),
            'desc'     => sprintf( esc_html__( 'Get Google map API, visit: %sGoogle docs%s', 'theshopier' ), '<a target="_blank" href="//developers.google.com/maps/documentation/javascript/get-api-key">', '</a>' )
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Image size', 'theshopier' ),
    'id'         => 'general-image-size',
    'desc'       => '',
    'icon'		=> 'el el-picture',
    'fields'     => array(

        array(
            'id'       => 'blog-thumbnail-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Blog thumbnail size', 'theshopier' ),
            'indent'   => true,
        ),

        array(
            'id'            => 'blog-thumbnail-size-width',
            'type'          => 'slider',
            'title'         => esc_html__( 'Width', 'theshopier' ),
            'subtitle' 		=> esc_html__( 'Min: 150, max: 1170, step: 1, default: 870', 'theshopier' ),
            'desc'          => '',
            'default'       => 870,
            'min'           => 150,
            'step'          => 1,
            'max'           => 1170,
            'display_value' => 'text'
        ),
        array(
            'id'            => 'blog-thumbnail-size-height',
            'type'          => 'slider',
            'title'         => esc_html__( 'Height', 'theshopier' ),
            'subtitle'      => esc_html__( 'Min: 150, max: 1000, step: 1, default: 696', 'theshopier' ),
            'desc'          => '',
            'default'       => 696,
            'min'           => 150,
            'step'          => 1,
            'max'           => 1000,
            'display_value' => 'text'
        ),

        array(
            'id'     => 'blog-thumbnail-section-end',
            'type'   => 'section',
            'indent' => false,
        ),


        array(
            'id'       => 'blog-thumbnail-list-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Blog list thumbnail size', 'theshopier' ),
            'indent'   => true,
        ),

        array(
            'id'            => 'blog-thumbnail-list-size-width',
            'type'          => 'slider',
            'title'         => esc_html__( 'Width', 'theshopier' ),
            'subtitle' 		=> esc_html__( 'Min: 100, max: 520, step: 1, default: 300', 'theshopier' ),
            'desc'          => '',
            'default'       => 300,
            'min'           => 100,
            'step'          => 1,
            'max'           => 520,
            'display_value' => 'text'
        ),
        array(
            'id'            => 'blog-thumbnail-list-size-height',
            'type'          => 'slider',
            'title'         => esc_html__( 'Height', 'theshopier' ),
            'subtitle'      => esc_html__( 'Min: 100, max: 520, step: 1, default: 250', 'theshopier' ),
            'desc'          => '',
            'default'       => 250,
            'min'           => 100,
            'step'          => 1,
            'max'           => 520,
            'display_value' => 'text'
        ),

        array(
            'id'     => 'blog-thumbnail-list-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        /**********************************************************************/

        array(
            'id'       => 'blog-thumbnail-widget-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Blog Widget Thumbnail Size', 'theshopier' ),
            'indent'   => true,
        ),

        array(
            'id'            => 'blog-thumbnail-widget-size-width',
            'type'          => 'slider',
            'title'         => esc_html__( 'Width', 'theshopier' ),
            'subtitle' 		=> esc_html__( 'Min: 50, max: 250, step: 1, default: 100', 'theshopier' ),
            'desc'          => '',
            'default'       => 100,
            'min'           => 50,
            'step'          => 1,
            'max'           => 250,
            'display_value' => 'text'
        ),
        array(
            'id'            => 'blog-thumbnail-widget-size-height',
            'type'          => 'slider',
            'title'         => esc_html__( 'Height', 'theshopier' ),
            'subtitle'      => esc_html__( 'Min: 30, max: 150, step: 1, default: 67', 'theshopier' ),
            'desc'          => '',
            'default'       => 67,
            'min'           => 30,
            'step'          => 1,
            'max'           => 150,
            'display_value' => 'text'
        ),

        array(
            'id'     => 'blog-thumbnail-list-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        /***********************************************************************************/


        array(
            'id'       		=> 'blog-single-section-start',
            'type'     		=> 'section',
            'title'    		=> esc_html__( 'Blog Single image size', 'theshopier' ),
            'indent'   		=> true, // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id'            => 'blog-single-size-width',
            'type'          => 'slider',
            'title'         => esc_html__( 'Width', 'theshopier' ),
            'subtitle'      => esc_html__( 'Min: 300, max: 1170, step: 1, default: 1170', 'theshopier' ),
            'desc'          => '',
            'default'       => 1170,
            'min'           => 300,
            'step'          => 1,
            'max'           => 1170,
            'display_value' => 'text'
        ),
        array(
            'id'            => 'blog-single-size-height',
            'type'          => 'slider',
            'title'         => esc_html__( 'Height', 'theshopier' ),
            'subtitle'      => esc_html__( 'Min: 300, max: 1170, step: 1, default: 1000', 'theshopier' ),
            'desc'          => '',
            'default'       => 1000,
            'min'           => 300,
            'step'          => 1,
            'max'           => 1170,
            'display_value' => 'text'
        ),

        array(
            'id'     		=> 'blog-single-section-end',
            'type'   		=> 'section',
            'indent' 		=> false, // Indent all options below until the next 'section' option is set.
        ),

        array(
            'id'       		=> 'shop-subcategories-image-size-section-start',
            'type'     		=> 'section',
            'title'    		=> esc_html__( 'Shop Subcategories', 'theshopier' ),
            'subtitle' 		=> '',
            'indent'   		=> true, // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id'            => 'shop-subcat-size-width',
            'type'          => 'slider',
            'title'         => esc_html__( 'Width', 'theshopier' ),
            'subtitle'      => esc_html__( "Min: 100, max: 1170, step: 5, default: 100", 'theshopier' ),
            'desc'          => '',
            'default'       => 100,
            'min'           => 50,
            'step'          => 5,
            'max'           => 1170,
            'display_value' => 'text'
        ),
        array(
            'id'            => 'shop-subcat-size-height',
            'type'          => 'slider',
            'title'         => esc_html__( 'Height', 'theshopier' ),
            'subtitle'      => esc_html__( "Min: 100, max: 700, step: 5, default: 100", 'theshopier' ),
            'desc'          => '',
            'default'       => 100,
            'min'           => 50,
            'step'          => 5,
            'max'           => 700,
            'display_value' => 'text'
        ),

        array(
            'id'     		=> 'shop-subcategories-image-size-section-end',
            'type'   		=> 'section',
            'indent' 		=> false,
        ),


    )
) );

    // -> START Editors

$theme_headers = array();
for( $i=1; $i<=15; $i++ ) {
    if( file_exists( THEME_DIR . "images/theme-option-header{$i}.jpg" ) ) {
        $theme_headers[$i] = array(
            'alt' => $i,
            'img' => THEME_IMG_URI . "theme-option-header{$i}.jpg"
        );
    }
}

Redux::setSection( $opt_name, array(
    'title' 		=> esc_html__( 'Header', 'theshopier' ),
    'id'    		=> 'header',
    'icon'  		=> 'el el-credit-card',
    'fields'		=> array(
        array(
            'id'       => 'header-style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Header style', 'theshopier' ),
            'options'  => $theme_headers,
            'default'  => '1',
        ),
        array(
            'id'       => 'header-shipping-text',
            'type'     => 'editor',
            'title'    => esc_html__( 'Header Shipping Text', 'theshopier' ),
            'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your panel!', 'theshopier' ),
            'default'  => stripslashes(htmlspecialchars_decode("<strong class=\"text-color2\">FREE SHIPPING</strong> ON ORDER OFF $100, USE CODE: <strong class=\"text-color1\">SHOPIER</strong> <a href=\"#\">Details &rarr;</a>")),
        ),
        array(
            'id'       => 'breadcrum-style',
            'type'     => 'select',
            'title'    => esc_html__( 'Breadcrum Style', 'theshopier' ),
            'options'  => array(
                'default'       => esc_html__('Default', 'theshopier'),
                'transparent'   => esc_html__('Transparent', 'theshopier')
            ),
            'default'   => 'default'
        ),
        array(
            'id'       => 'sticky-menu',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sticky menu', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' 		=> esc_html__( 'Footer', 'theshopier' ),
    'id'    		=> 'footer',
    'icon'  		=> 'el el-website',
    'fields'		=> array(

        array(
            'id'       => 'footer-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Footer width', 'theshopier' ),
            'options'  => array(
                'container'                 => 'Container',
                'container container-1790'  => 'Big Container'
            ),
            'default'  => 'container'
        ),
        array(
            'id'       => 'footer-stblock',
            'type'     => 'select',
            'title'    => __('Static block', 'theshopier'),
            'options'  => $static_block_args,
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
            'type'     => 'editor',
            'required' => array( 'footer-copyright-switch', '=', '1' ),
            'title'    => esc_html__( 'Footer copyright text', 'theshopier' ),
            'default'  => '',
        ),
        array(
            'id'     => 'footer-copyright-end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Header Toolbar', 'theshopier' ),
    'id'         => 'header-toolbar',
    'desc'       => '',
    'icon'		=> 'el el-braille',
    'fields'     => array(
        array(
            'id'       => 'main-right-toolbar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Header toolbar', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'show-social-icons',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show social network', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
            'required' => array(
                array( 'main-right-toolbar', '=', 1 )
            )
        ),
        array(
            'id'       => 'social-network',
            'type'     => 'multi_social',
            'title'    => esc_html__( 'Social network', 'theshopier' ),
            'show_empty'	=> true,
            'add_text'	=> esc_html__("Add Item", 'theshopier' ),
            'subtitle' => '',
            'default'	=> array(
                array(
                    'icon'	=> 'fa fa-facebook-square',
                    'link'	=> '#',
                    'color' => '#6475c2'
                ),
                array(
                    'icon'	=> 'fa fa-twitter-square',
                    'link'	=> '#',
                    'color' => '#81cde9'
                ),
                array(
                    'icon'	=> 'fa fa-pinterest-square',
                    'link'	=> '#',
                    'color' => '#ea1b1b'
                ),
                array(
                    'icon'	=> 'fa fa-google-plus-square',
                    'link'	=> '#',
                    'color' => '#b71212'
                ),
                array(
                    'icon'	=> 'fa fa-rss-square',
                    'link'	=> '#',
                    'color' => '#ff9600'
                ),
            ),
            'required' => array(
                array( 'main-right-toolbar', '=', 1 ),
                array( 'show-social-icons', '=', 1 )
            )
        ),

        array(
            'id'        => 'toolbar-feedback-url',
            'type'      => 'select',
            'title'     => esc_html__( 'Toolbar Feelback', 'theshopier' ),
            'desc'      => esc_html__( 'Enter your feedback link', 'theshopier' ),
            'data'      => 'pages',
            'default'   => '',
            'required' => array(
                array( 'main-right-toolbar', '=', 1 )
            )
        ),

        array(
            'id'       => 'show-qrcode-icon',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Qr-code', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
            'required' => array(
                array( 'main-right-toolbar', '=', 1 )
            )
        ),
        array(
            'id'		=> 'qrcode-url',
            'type' 		=> 'text',
            'title' 	=> esc_html__( 'QR-Code URL', 'theshopier' ),
            'desc' 		=> esc_html__( 'Leave empty to put the current page url.', 'theshopier' ),
            'required' => array(
                array( 'main-right-toolbar', '=', 1 ),
                array( 'show-qrcode-icon', '=', 1 )
            )
        ),
    )
) );


function theshopier_get_stblock( $cats = array('all') ){
    $res_args = array();

    $meta_query = array();
    $meta_query[] = array(
        'key'	=> 'theshopier_nth_stblock_options',
        'value'	=> $cats,
        'compare' => "IN"
    );
    $args = array(
        'post_type'         => 'nth_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'	        => 'title',
        'order'		        => 'ASC',
        'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->post_name;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}

	/// -> START Typography

$fontObj = theshopier_readXmlFile( $_font_xml_file );
$font_options = array(
    array(
        'id'       => 'nth_import_font',
        'type'     => 'import_font',
        'title'    => esc_html__( 'Font import', 'theshopier' )
    ),

);

if( $fontObj ){

    foreach( $fontObj as $font ){
        if( isset($font->id) && isset($font->title) ) {
            $option = array(
                'id'       	=> esc_attr($font->id),
                'type'     	=> 'typography',
                'title'		=> ucwords($font->title),
                'font-weight'   => false,
                'font-size'     => false,
                'subsets'       => false,
                'line-height'   => false,
                'text-align'    => false,
                'color'         => false,
                'font-style'    => false,
            );
            if( isset($font->units) ) $option['units'] = esc_attr($font->units);
            if( isset($font->subtitle) ) $option['subtitle'] = esc_attr($font->subtitle);
            if( isset($font->google) && absint($font->google) == 0 ) $option['google'] = false;
            if( isset($font->output) && strlen($font->output) > 0 ) {
                $option['output'] = explode( ',', $font->output);
            }
            if( isset($font->def) && is_object($font->def) ) {
                $option['default'] = array();
                if( isset($font->def->color) && strlen($font->def->color) > 0 ) {
                    $option['default']['color'] = strtoupper($font->def->color);
                    unset($option['color']);
                }

                if( isset($font->def->size) && strlen($font->def->size) > 0 ) {
                    $option['default']['font-size'] = strtolower($font->def->size);
                    unset($option['font-size']);
                }

                if( isset($font->def->family) && strlen($font->def->family) > 0 ) {
                    $option['default']['font-family'] = esc_attr($font->def->family);
                    unset($option['font-family']);
                }

                if( isset($font->def->weight) && strlen($font->def->weight) > 0 ) {
                    $option['default']['font-weight'] = esc_attr($font->def->weight);
                    unset($option['font-weight']);
                    unset($option['font-style']);
                }

                if( isset($font->def->align) && strlen($font->def->align) > 0 ) {
                    $option['default']['text-align'] = esc_attr($font->def->align);
                    unset($option['text-align']);
                }

                if( isset($font->def->line_height) && strlen($font->def->line_height) > 0 ) {
                    $option['default']['line-height'] = esc_attr($font->def->line_height);
                    unset($option['line-height']);
                }

                if( isset($font->def->text_transform) && strlen($font->def->text_transform) > 0 ) {
                    $option['default']['text-transform'] = esc_attr($font->def->text_transform);
                    $option['text-transform'] = true;
                }



                //align
            }

            array_push( $font_options, $option );
        }
    }

} else {
    $option = array(
            'id'    => 'nth-font-not-found',
            'type'  => 'info',
            'style' => 'warning',
            'title' => esc_html__( 'Theme fonts.', 'theshopier' ),
            'desc'  => esc_html__( "<strong>font xml</strong> not found, please import it.", 'theshopier' )
    );
    array_push( $font_options, $option );
}

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Typography', 'theshopier' ),
    'id'     => 'typography',
    'desc'   => '',
    'icon'   => 'el el-fontsize',
    'fields' => $font_options,
) );

$colorObj = theshopier_readXmlFile( $_color_xml_file );

$color_options = array(
    array(
        'id'       => 'nth_import_color',
        'type'     => 'import_font',
        'title'    => esc_html__( 'Color importer', 'theshopier' ),
        'filename'  => 'color_options'
    )
);
if( isset( $colorObj ) ) {
    foreach( $colorObj as $color ){
        if( isset($color->id) && isset($color->type) ) {

            $option = array(
                'id'       	=> esc_attr($color->id),
                'type'		=> esc_attr($color->type)
            );
            if( isset($color->title) ) $option['title'] = ucwords($color->title);

            if( isset($color->subtitle) ) $option['subtitle'] = esc_attr($color->subtitle);
            if( isset($color->desc) ) $option['desc'] = esc_attr($color->desc);
            if( isset($color->output) ) {
                $ap_k = 'output';
                if( strlen(trim($color->output)) == 0 ) {
                    $option[$ap_k] = array();
                    if( isset($color->output->color) )
                        $option[$ap_k]['color'] = trim($color->output->color);
                    if( isset($color->output->bgcolor) )
                        $option[$ap_k]['background-color'] = trim($color->output->bgcolor);
                    if( isset($color->output->bdcolor) )
                        $option[$ap_k]['border-color'] = trim($color->output->bdcolor);
                } else {
                    $option[$ap_k] = array_map('trim', explode( ',', $color->output ) );
                }
            }

            if( isset($color->mode) ) $option['mode'] = esc_attr($color->mode);

            if( isset($color->def) ) {
                switch( $option["type"] ) {
                    case "color_rgba":
                        $option['default'] = array();
                        if( isset( $color->def->color ) && strlen($color->def->color) > 0 )
                            $option['default']['color'] = esc_attr($color->def->color);
                        if( isset( $color->def->alpha ) && strlen($color->def->alpha) > 0 )
                            $option['default']['alpha'] = esc_attr($color->def->alpha);
                        break;
                    case "link_color":
                        $option['default'] = array("regular" => "#333333");
                        if( isset( $color->def->regular ) && strlen($color->def->regular) > 0 )
                            $option['default']['regular'] = esc_attr($color->def->regular);
                        if( isset( $color->def->hover ) && strlen($color->def->hover) > 0 )
                            $option['default']['hover'] = esc_attr($color->def->hover);
                        if( isset( $color->def->active ) && strlen($color->def->active) > 0 )
                            $option['default']['active'] = esc_attr($color->def->active);
                        break;
                    case "background":
                        $option['default'] = array();
                        if( isset( $color->def->bgColor ) && strlen($color->def->bgColor) > 0 )
                            $option['default']['background-color'] = esc_attr($color->def->bgColor);
                        break;
                    default:
                        $option['default'] = esc_attr( $color->def );
                }

            }
            if( isset($color->indent) ) {
                $option['indent'] = strcmp($color->indent, 'true') == 0? true: false;
            }

            array_push( $color_options, $option );
        }
    }

}

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Color scheme', 'theshopier' ),
    'id'     => 'color_scheme',
    'desc'   => '',
    'icon'   => 'el el-magic',
    'fields' => $color_options,
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Woocommerce', 'theshopier' ),
    'id'    => 'woocommerce',
    'desc'  => '',
    'icon'  => 'el el-shopping-cart'
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Shop page', 'theshopier' ),
    'id'         => 'woo-shop-page',
    'subsection' => true,
    'icon'  => 'el el-folder-close',
    'fields'     => array(
        array(
            'id'       => 'shop-layout',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Shop Layout', 'theshopier' ),
            'subtitle' => esc_html__( 'Main layout: none slidebar, left slidebar or right slidebar.', 'theshopier' ),
            'desc'     => '',
            'options'  => array(
                '0-0' => array(
                    'alt' => 'full_width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                '1-0' => array(
                    'alt' => 'left_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                '0-1' => array(
                    'alt' => 'right_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                '1-1' => array(
                    'alt' => 'all_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => '1-0'
        ),
        array(
            'id'       => 'shop-left-sidebar',
            'type'     => 'select',
            'title'    => __('Select Left Sidebar', 'theshopier'),
            'data'     => 'sidebars',
            'default'  => 'shop-widget-area-left',
            'required' => array( 'shop-layout', '=', array( '1-0', '1-1' ) )
        ),
        array(
            'id'       => 'shop-right-sidebar',
            'type'     => 'select',
            'title'    => __('Select Right Sidebar', 'theshopier'),
            'data'     => 'sidebars',
            'default'  => 'shop-widget-area-right',
            'required' => array( 'shop-layout', '=', array( '0-1', '1-1' ) )
        ),
        array(
            'id'      => 'shop_per_page',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Product Per Page', 'theshopier' ),
            'desc'    => esc_html__( 'Min: 4, max: 100, step:1, default: 12', 'theshopier' ),
            'default' => '12',
            'min'     => '4',
            'step'    => '1',
            'max'     => '100',
        ),
        array(
            'id'      => 'shop_columns',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Shop Product Columns', 'theshopier' ),
            'desc'    => esc_html__( 'Min: 2, max: 12, step:1, default value: 3', 'theshopier' ),
            'default' => '3',
            'min'     => '2',
            'step'    => '1',
            'max'     => '12',
        ),

        array(
            'id'   => 'shop-layout-opt-divide',
            'type' => 'divide'
        ),

        array(
            'id'       => 'shop-product-style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Catalog item style', 'theshopier' ),
            'full_width'    => true,
            'options'  => array(
                '1' => array( 'title' => 'Default', 'alt' => 'Default', 'img' => THEME_IMG_URI . "woo_product1.jpg" ),
                '2' => array( 'title' => 'Outline button', 'alt' => 'Outline button', 'img' => THEME_IMG_URI . "woo_product2.jpg" ),
                '3' => array( 'title' => 'Square style', 'alt' => 'Style 3', 'img' => THEME_IMG_URI . "woo_product3.jpg" ),
                '4' => array( 'title' => 'Border style 1', 'alt' => 'Style 4', 'img' => THEME_IMG_URI . "woo_product4.jpg" ),
                '5' => array( 'title' => 'Border style 2', 'alt' => 'Style 5', 'img' => THEME_IMG_URI . "woo_product5.jpg" ),
                '6' => array( 'title' => 'Border - No padding style', 'alt' => 'Style 5', 'img' => THEME_IMG_URI . "woo_product6.jpg" ),
            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'shop-dropdrag-cart',
            'type'     => 'switch',
            'title'    => esc_html__( 'Drop-Drag shopping cart', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enable',
            'off'      => 'Disable',
        ),

        array(
            'id'       => 'shop-quickshop',
            'type'     => 'switch',
            'title'    => esc_html__( 'Quickshop button', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enable',
            'off'      => 'Disable',
        ),

        array(
            'id'       => 'nth-cat-infomation',
            'type'     => 'editor',
            'title'    => esc_html__( 'Shop Infomation', 'theshopier' ),
            'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your panel!', 'theshopier' ),
            'default'  => '',
        ),

        array(
            'id'		=> 'nth-product-deal-format',
            'type' 		=> 'text',
            'title' 	=> esc_html__( 'Product Deal format', 'theshopier' ),
            'desc' 		=> sprintf( esc_html__( 'For full documentation on this format, visit: %sjQuery.countdown%s', 'theshopier' ), '<a target="_blank" href="http://hilios.github.io/jQuery.countdown/documentation.html#formatter">', '</a>' ),
            'default'	=> 'Deal ends in <strong>%D days %H:%M:%S</strong>',
        ),

        array(
            'id'		=> 'nth-my-account-track-order',
            'type' 		=> 'select',
            'title' 	=> esc_html__( 'Track order page', 'theshopier' ),
            'desc' 		=> '',
            'data'	    => 'page',
        ),

    ),
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Product page', 'theshopier' ),
    'id'         => 'woo-product-page',
    'desc'       => '',
    'icon'		=> 'el el-file',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'product-page-layout',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Product Page Layout', 'theshopier' ),
            'subtitle' => esc_html__( 'Main layout: none slidebar, left slidebar or right slidebar.', 'theshopier' ),
            'desc'     => '',
            'options'  => array(
                '0-0' => array(
                    'alt' => 'full_width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                '1-0' => array(
                    'alt' => 'left_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                '0-1' => array(
                    'alt' => 'right_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                '1-1' => array(
                    'alt' => 'all_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => '0-1'
        ),
        array(
            'id'       => 'product-page-left-sidebar',
            'type'     => 'select',
            'title'    => __('Select Left Sidebar', 'theshopier'),
            'data'     => 'sidebars',
            'default'  => '',
            'required' => array( 'product-page-layout', '=', array( '1-0', '1-1' ) )
        ),
        array(
            'id'       => 'product-page-right-sidebar',
            'type'     => 'select',
            'title'    => __('Select Right Sidebar', 'theshopier'),
            'data'     => 'sidebars',
            'default'  => '',
            'required' => array( 'product-page-layout', '=', array( '0-1', '1-1' ) )
        ),

        array(
            'id'       => 'product-page-footer-block',
            'type'     => 'select',
            'title'    => __('Footer block', 'theshopier'),
            'options'  => $static_block_args,
        ),

        array(
            'id'       => 'nth_custom_tab_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Custom tab title', 'theshopier' ),
            'subtitle' => esc_html__( 'It will show at product tabs', 'theshopier' ),
            'default'  => 'Custom tab',
        ),

        array(
            'id'       => 'nth_custom_tab_content',
            'type'     => 'editor',
            'title'    => esc_html__( 'Custom tab Content', 'theshopier' ),
            'default'  => stripslashes(htmlspecialchars_decode("Custom tab content.")),
        ),
        array(
            'id'       => 'product-page-variable-style',
            'type'     => 'image_select',
            'title'    => __('Variablion style', 'theshopier'),
            'options'  => array(
                'section_button'    => array(
                    'alt' => esc_attr__('Section button', 'theshopier'),
                    'img' => THEME_IMG_URI . 'theme-option-variable-style1.jpg',
                ),
                'select_input'      => array(
                    'alt' => esc_attr__('Select input', 'theshopier'),
                    'img' => THEME_IMG_URI . 'theme-option-variable-style2.jpg',
                ),
            ),
            'default'   => 'section_button',
        ),
    ),
) );

if( class_exists('WeDevs_Dokan') ) {

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Dokan', 'theshopier' ),
        'id'         => 'woo-dokan',
        'subsection' => true,
        'icon'  => 'el el-folder-close',
        'fields'     => array(
            array(
                'id'            => 'store-list-columns',
                'type'          => 'spinner',
                'title'         => esc_html__( 'Columns', 'theshopier' ),
                'desc' 		    => esc_html__( 'Min: 2, max: 6, step: 1, default: 4', 'theshopier' ),
                'default'       => 4,
                'min'           => 2,
                'step'          => 1,
                'max'           => 6,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'store-list-thumbnail',
                'type'          => 'dimensions',
                'units'         => false,
                'title'         => __('Store list thumbnail', 'theshopier'),
                'default'       => array(
                    'width'   => '300',
                    'height'  => '175'
                ),
            ),
        ),
    ) );

}

// -> blog page
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Blog', 'theshopier' ),
    'id'    => 'blog-page',
    'desc'  => '',
    'icon'  => 'el el-blogger',
    'fields'     => array(
        array(
            'id'       => 'blog-layout',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Blog Layout', 'theshopier' ),
            'subtitle' => esc_html__( 'Blog layout: none slidebar, left slidebar or right slidebar.', 'theshopier' ),
            'desc'     => '',
            'options'  => array(
                '0-0' => array(
                    'alt' => 'full_width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                '1-0' => array(
                    'alt' => 'left_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                '0-1' => array(
                    'alt' => 'right_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                '1-1' => array(
                    'alt' => 'all_sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => '0-1'
        ),
        array(
            'id'       => 'blog-left-sidebar',
            'type'     => 'select',
            'title'    => __('Select Left Sidebar', 'theshopier'),
            'data'     => 'sidebars',
            'default'  => 'blog-page-widget-area-right',
            'required' => array( 'blog-layout', '=', array( '1-0', '1-1' ) )
        ),
        array(
            'id'       => 'blog-right-sidebar',
            'type'     => 'select',
            'title'    => __('Select Right Sidebar', 'theshopier'),
            'data'     => 'sidebars',
            'default'  => 'blog-page-widget-area-right',
            'required' => array( 'blog-layout', '=', array( '0-1', '1-1' ) )
        ),

        array(
            'id'      => 'blog-excerpt-length',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Excerpt length', 'theshopier' ),
            'desc'    => esc_html__( "Min: 25, max: 255, step: 1, default: 55", 'theshopier' ),
            'default' => '55',
            'min'     => '25',
            'step'    => '1',
            'max'     => '255',
        ),
        array(
            'id'       => 'blog-readmore-button',
            'type'     => 'switch',
            'title'    => esc_html__( 'Read More button', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),
    ),
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Galleries', 'theshopier' ),
    'id'    => 'theme-gallery',
    'desc'  => '',
    'icon'  => 'el el-picture',
    'fields'     => array(
        array(
            'id'       => 'gallery-fullscreen',
            'type'     => 'switch',
            'title'    => esc_html__( 'Fullscreen', 'theshopier' ),
            'desc'  => esc_html__( 'Enabled/Disabled fullscreen buttom', 'theshopier' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'        => 'gallery-loop',
            'type'      => 'switch',
            'title'     => esc_html__( 'Loop', 'theshopier' ),
            'desc'      => esc_html__( 'Makes slider to go from last slide to first', 'theshopier' ),
            'default'   => 0,
            'on'        => 'Enabled',
            'off'       => 'Disabled',
        ),
        array(
            'id'            => 'gallery-height',
            'type'          => 'slider',
            'title'         => esc_html__( 'Gallery height', 'theshopier' ),
            'desc' 		    => esc_html__( 'Min: 350px, max: 1170px, step: 10px, default: 670px', 'theshopier' ),
            'default'       => 670,
            'min'           => 350,
            'step'          => 10,
            'max'           => 1170,
            'display_value' => 'text'
        ),
        array(
            'id'   => 'gallery-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'gallery-autoplay',
            'type'      => 'switch',
            'title'     => esc_html__( 'Auto Play', 'theshopier' ),
            'default'   => 1,
            'on'        => 'Enabled',
            'off'       => 'Disabled',
        ),
        array(
            'id'        => 'gallery-pauseonhover',
            'type'      => 'switch',
            'title'     => esc_html__( 'Pause On Hover', 'theshopier' ),
            'desc'      => esc_html__( 'Pause autoplay on hover.', 'theshopier' ),
            'default'   => 1,
            'on'        => 'Enabled',
            'off'       => 'Disabled',
            'required'  => array( 'gallery-autoplay', '=', '1' )
        ),
        array(
            'id'            => 'gallery-autoplay-delay',
            'type'          => 'slider',
            'title'         => esc_html__( 'Delay', 'theshopier' ),
            'desc' 		    => esc_html__( 'Min: 3000ms, max: 18000ms, step: 500ms, default: 5000ms', 'theshopier' ),
            'default'       => 5000,
            'min'           => 3000,
            'step'          => 500,
            'max'           => 18000,
            'display_value' => 'text',
            'required'  => array( 'gallery-autoplay', '=', '1' )
        ),
        array(
            'id'   => 'gallery-divide-2',
            'type' => 'divide'
        ),
        array(
            'id'        => 'gallery-thumnail-vertical',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable thumbnail vertical', 'theshopier' ),
            'default'   => 0,
            'on'        => 'Enabled',
            'off'       => 'Disabled',
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Theme Editor', 'theshopier' ),
    'id'    => 'editor-page',
    'desc'  => '',
    'icon'  => 'el el-file-edit',
    'fields'     => array(
        array(
            'id'        => 'css_editor',
            'type'      => 'ace_editor',
            'title'     => esc_html__( 'CSS Code', 'theshopier' ),
            'mode'      => 'css',
            'theme'     => 'chrome',
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-1',
            'type' => 'divide'
        ),
        array(
            'id'        => 'color_xml_editor',
            'type'      => 'ace_editor',
            'title'     => esc_html__( 'Color options xml', 'theshopier' ),
            'mode'      => 'xml',
            'default'   => theshopier_readXmlFile( $_color_xml_file, false ),
            'theme'     => 'chrome',
            'subtitle'  => '',
            'compiler'  => true,
            'full_width'    => true
        ),
        array(
            'id'   => 'editor-page-divide-2',
            'type' => 'divide'
        ),
        array(
            'id'        => 'font_xml_editor',
            'type'      => 'ace_editor',
            'title'     => esc_html__( 'Font options xml', 'theshopier' ),
            'mode'      => 'xml',
            'default'   => theshopier_readXmlFile( $_font_xml_file, false ),
            'theme'     => 'chrome',
            'compiler'  => true,
            'full_width'    => true
        )
    ),
) );



    /*
     * <--- END SECTIONS
     */


// Remove the demo link and the notice of integrated demo from the redux-framework plugin
function theshopier_remove_demo() {

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


function theshopier_readXmlFile( $path = '', $obj = true ){
    if( strlen( $path ) == 0 || !file_exists($path) ) return false;
    if($obj) {
        $data = array();
        $fontObj = simplexml_load_file( $path );
        foreach( $fontObj->children() as $font ){
            array_push( $data, $font );
        }
    } else {
        global $wp_filesystem;
        $data = $wp_filesystem->get_contents($path);
    }

    return $data;
}


add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
        global $wp_filesystem;

        if( empty( $wp_filesystem ) ) {
            require_once( ABSPATH .'/wp-admin/includes/file.php' );
            WP_Filesystem();
        }

        if( $wp_filesystem ) {

            if( isset($options['color_xml_editor']) && strlen(trim($options['color_xml_editor'])) > 0 ) {
                $color_xml = THEME_FRAMEWORK_INCS . "redux-framework/xml/color_options.xml";
                $wp_filesystem->put_contents(
                    $color_xml,
                    $options['color_xml_editor'],
                    FS_CHMOD_FILE
                );
            }

            if( isset($options['font_xml_editor']) && strlen(trim($options['font_xml_editor'])) > 0 ) {
                $font_xml = THEME_FRAMEWORK_INCS . "redux-framework/xml/font_options.xml";
                $wp_filesystem->put_contents(
                    $font_xml,
                    $options['font_xml_editor'],
                    FS_CHMOD_FILE
                );
            }
        }

    }
}
