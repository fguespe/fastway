<?php


/*
function tmu_custom_fonts( $standard_fonts ){
 
    $my_custom_fonts = array();
    
    $my_custom_fonts['kitten'] = array(
       'label' => 'kitten',
       'variants' => array('regular'),
       'stack' => 'kitten, sans-serif',
    );
    
    $my_custom_fonts['font2'] = array(
       'label' => 'Another Font',
       'variants' => array('regular','italic','700','700italic'),
       'stack' => 'anotherfont, sans-serif',
    );
    
    return array_merge_recursive( $my_custom_fonts, $standard_fonts );
    
}
add_filter( 'kirki/fonts/standard_fonts', 'tmu_custom_fonts', 20 );

   */

function seporate_linkmods_and_icons_from_classes( $classes, &$linkmod_classes, &$icon_classes, $depth=0 ) {
    // Loop through $classes array to find linkmod or icon classes.
    foreach ( $classes as $key => $class ) {
        // If any special classes are found, store the class in it's
        // holder array and and unset the item from $classes.
        if ( preg_match( '/^disabled|^sr-only/i', $class ) ) {
            // Test for .disabled or .sr-only classes.
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class ) && $depth > 0 ) {
            // Test for .dropdown-header or .dropdown-divider and a
            // depth greater than 0 - IE inside a dropdown.
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class ) ) {
            // Font Awesome.
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class ) ) {
            // Glyphicons.
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        }
    }

    return $classes;
}

function fw_modal_block($rand,$id,$iframe=false,$size="modal-lg"){
    if(!$iframe){
        $block=fw_StaticBlock::getSticBlockContent($id,true);
        $block=nl2br($block);
    }
    else $block='<iframe height="868" width="100%" frameBorder="0" title="Promociones bancarias" scrolling="no" src="'.$id.'" scrolling="no"></iframe>';
  return <<<HTML
<!-- Modal -->
<div class="modal fade" id="$rand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog $size" role="document">
    <div class="modal-content">
      <div class="modal-body">
        $block
      </div>
    </div>
  </div>
</div>
HTML;
}
function fw_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $megamenu=fw_theme_mod("mega_menu");
        $cols="";
        if($megamenu)$cols=fw_theme_mod("mega_menu_cols");
        //error_log(fw_theme_mod("mega_menu_cols"));
        $clasem="fwmenu1";
        if($megamenu)$clasem="fw_mega_menu";

        $menu_list  = '<nav id="fw-menu" class="'.$clasem.' navbar navbar-expand-md"><div class="collapse navbar-collapse" id=""><ul class="navbar-nav ">'."\n";
 
        if(empty($menu_items))return;
        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                $parent = $menu_item->ID;
                $menu_array = array();

                $linkmod_classes = array();
                $icon_classes    = array();
                $classes = seporate_linkmods_and_icons_from_classes( $menu_item->classes, $linkmod_classes, $icon_classes );
                $classes=implode(' ',$classes);
                $icon_classes=implode(' ',$icon_classes);
                if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
                

                $nuevoitem="";
                $first=false;
                foreach( $menu_items as $submenu ) {
                   if( $submenu->menu_item_parent == $parent ) {
                        //error_log($submenu->title." ".);
                        //error_log($submenu->title);
                        if($submenu->attr_title==="init_col" && $megamenu){
                            if($first)$menu_array[] ='</div>';
                            $first=true;
                            $menu_array[]='<div class="col-md-'.$cols.'">';
                            //error_log("Abre-----".$submenu->title);
                        }
                        $bool = true;
                        $url=$submenu->url;
                        $title=$submenu->title;

                        $linkmod_classes = array();
                        $icon_classes    = array();
                        $classes = seporate_linkmods_and_icons_from_classes( $submenu->classes, $linkmod_classes, $icon_classes );
                        $classes=implode(' ',$classes);
                        $icon_classes=implode(' ',$icon_classes);
                        if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
                
                        
                        $menu_array[] = '<li class="nav-item menu-item padre"><a class="dropdown-item" href="' . $url . '">'.$icon_classes.' '. $title . '</a></li>' ."\n";
                        //3er nivel
                        if($megamenu){
                            $s_parent = $submenu->ID;
                            foreach( $menu_items as $s_submenu ) {
                                if( $s_submenu->menu_item_parent == $s_parent ) {
                                  $s_url=$s_submenu->url;
                                  $s_title=$s_submenu->title;
                                  $menu_array[] = '<li class="nav-item hijo"><a class="nav-link" href="' . $s_url . '">' . $s_title . '</a></li>' ."\n";
                                  //error_log("Pone:---------".$s_submenu->title);
                              } 
                            }
                           
                        }
                        
                    }
                }


                if( $bool == true && count( $menu_array ) > 0 ) {
                     
                    $menu_list .= '<li class="nav-item menu-item dropdown '.$clases.'">' ."\n";
                    $menu_list .= '<a href="#" class="dropdown-toggle nav-link " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$icon_classes.' '.$menu_item->title . '</a>' ."\n";
             
                    $menu_list .= '<ul class="dropdown-menu">' ."\n";
                    if($megamenu)$menu_list .= '<div class="row">';
                
                    $menu_list .= implode( "\n", $menu_array );
                    if($megamenu)$menu_list .= '</div>';
                
                    $menu_list .= '</ul>' ."\n";
                     
                } else {
                     
                    $menu_list .= '<li class="nav-item menu-item '.$clases.'">' ."\n";
                    $menu_list .= '<a href="'.$menu_item->url.'" class="nav-link" >'.$icon_classes.' '.$menu_item->title . '</a>' ."\n";
                }
                 
            }
            // end <li>
            $menu_list .= '</li>' ."\n";
            
        }
        $menu_list .= '</ul></div></nav>';
        if(fw_theme_mod("mega_menu_overlay"))$menu_list .= '<div class="submenu-overlay"></div>' ."\n";
        
    } 
    echo $menu_list;
}


function fw_vc_get_posts($typ) {
    $args = array(
    'taxonomy'   => $typ,
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids
    );
    $product_categories = get_terms($args);
    
    $result = array();
    foreach ( $product_categories as $post ) {

        $jaja=array($post->name=>$post->slug);
        $result=array_merge($result,$jaja);
        
    }
    return $result;
}

function fw_getmsliders(){
    $res_args = array();

    $meta_query = array();
    
    $args = array(
        'post_type'         => 'ml-slider',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
        //'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $jaja=array(get_the_title($block->ID)=>$block->ID);
        $res_args=array_merge($res_args,$jaja);
    }
    return $res_args;
}


if(fw_theme_mod("maintainance-mode")){

    add_action('get_header', 'fw_maintenance_mode');
}


function fw_custom_loginui() {
echo '<style type="text/css">
h1 a {background-image: url('.fw_theme_mod('ca-client-logo').') !important; }
/*LOGIN*/
#login h1 a{
    width:100%;
    background-size: auto auto;
    background-size: contain; 
}
p.register{
    display:none;
}
button,a,input,textarea,.vc_row,ul,li,div{
    border-radius:0px !important;
}
.login{
    background:white !important;
}
#loginform{
    border: 1px solid '.fw_theme_mod('ca-main-color').';
}
#wp-submit{
    color: white;
    border:0px !important;
    border-radius:0px;
    background: '.fw_theme_mod('ca-main-color').' !important;
    text-shadow:none;
    -webkit-box-shadow:none;
}</style>';
}
add_action('login_head', 'fw_custom_loginui');


function fw_maintenance_mode(){
    
    if(!current_user_can('administrator') ){
        wp_die('<div id="mantenimiento" style="width:100% !important; text-align:center;"><img align="middle" src="'.fw_theme_mod("maintainance-mode-img").'" style="width:100%; height:auto !important;"></div>');
    }
}

add_action('admin_head', 'custom_redux_panel');

function custom_redux_panel() {
  echo '<style>
    #redux-header,#redux-intro-text{
display:none;
}
.redux-group-menu i{
color: #00A2DE;
}
.redux-group-menu{
background:white;
}
.redux-main{
    background:white !important;
}
.redux-main .button-primary,
.admin-color-fresh .redux-field-container .ui-buttonset .ui-state-active,
.redux-main .redux-container-switch .cb-enable.selected{
    background:#00A2DE !important;
    border:0px !important;
    text-shadow:none !important;
    box-shadow:none !important;
}

  </style>';
}





add_action( 'fastway_footer_init', 'fastway_footer_block', 10 );
add_action( 'fastway_singleblock_init', 'fastway_singleblock_block', 10 );

add_action('fastway_header_topbanner','get_fastway_header_topbanner');
function get_fastway_header_topbanner(){
    
    
    if( empty(fw_theme_mod('topheader-img')) && empty( fw_theme_mod('topheader-img') ) && strlen(trim(fw_theme_mod('topheader-img') )) > 0 ){
        echo '<div class="fw_header_top_banner d-none d-md-block"><img src="'.fw_theme_mod('topheader-img').'"></div>';
    }
}




function fw_custom_css(){
    $css="";
    
    if(fw_theme_mod('responsive-typo')){
        $tipos=array("p","span","a","h4","h3","h2","h1");
        foreach ($tipos as $key) {    
            if($key == "a" || $key == "div" || $key == "p" || $key == "span" )$nombre='opt-typography-body';
            else $nombre='opt-typography-'.$key;
            if(empty(fw_theme_mod($nombre)))continue;
            $font=fw_theme_mod($nombre);
            $size=str_replace("px", "", $font['font-size']);
            $height=str_replace("px", "", $font['line-height']);
            $resized=round($size*0.7);
            $css.= "body ".$key."{";
            $css.= "font-size: calc(".$resized."px + (".$size." - ".$resized.") * ((100vw - 300px) / (1600 - 300))); ";
            $css.= "line-height: calc(".($resized+4)."px + (".$height." - ".($resized+4).") * ((100vw - 300px) / (1600 - 300))); ";
            $css.= "}";   
        }
       
    }
    if(!empty(fw_theme_mod('sticky-menu'))){
        foreach(fw_theme_mod('sticky-menu') as $key){
           $css.=".fw_sticky_top .".$key."{
                display:none !important;
           }";
        }
    }
    return $css;
}
add_action( 'add_topbar', 'get_topbar' );
function get_topbar(){
    
    $container = fw_theme_mod('header-width');
    if(!fw_theme_mod('top-header'))return;
    echo '<div class="fw_header_top d-none d-lg-flex py-2">
    <div class="'. esc_attr( $container ).'">
    <div>';
    $sidebar_name = "header-top-widget-area";
    if( is_active_sidebar( $sidebar_name ) ):
        echo '<ul class="widgets-sidebar">';
        dynamic_sidebar( $sidebar_name );
        echo '</ul>';
    else:
        esc_html_e( "Please add some widgets here!","fastway" );
    endif;
    echo '</div> </div>  </div>';
}

if( !function_exists('fastway_getLogo') ) {
    add_shortcode('fw_logo', 'fastway_getLogo');
    function fastway_getLogo( $type="" ){
        
        switch( $type ) {
            case 'sticky':
                break;
            default:
                $title = !empty(fw_theme_mod('logo-text'))? esc_attr(fw_theme_mod('logo-text')): get_bloginfo('name');
                $logo_arg = array(
                    'title' => esc_attr($title),
                    'alt'   => esc_attr($title)
                );

                if( !empty( fw_theme_mod('general-logo') ) && strlen(trim(fw_theme_mod('general-logo'))) > 0 ){
                    $logo_arg['src'] =  fw_theme_mod('general-logo') ;
                    $logo_arg['width'] = fw_theme_mod('logo-width');
                    $logo_arg['height'] = "auto";
                } else {
                    //Cargo logo default
                    $logo_arg['src'] = esc_url( get_template_directory_uri() . "/assets/img/logo.png" );
                    $logo_arg['width'] = fw_theme_mod('logo-width');
                    $logo_arg['height'] = "auto";
                }

                //echo '<a class="logo">';
                echo '<a class="logo "  href="'.esc_attr(home_url()).'">';
                fastway_getImage($logo_arg);
                echo '</a>';
        }
    }
}

if(!function_exists('fastway_getImage')) {
    function fastway_getImage($atts){
        $atts = wp_parse_args($atts, array(
            'alt'   => esc_attr__('image alt', 'fastway'),
            'width' => '',
            'height' => '',
            'src'  => '',
            'class' => 'fastway-image'
        ));

        $src = esc_url($atts['src']);

        if(strlen(trim($src)) > 0) {
            $_img = '<img';
            foreach($atts as $k => $v) {
                if(empty($v)) continue;
                $_img .= " {$k}=\"{$v}\"";
            }
            $_img .= '>';
            echo wp_kses($_img, array(
                'img' => array('alt' => array(), 'width' => array(), 'height' => array(), 'src' => array(), 'class' => array())
            ));
        }
    }
}




add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    
  $cols =  fw_theme_mod('shop_per_page');
  return $cols;
}

/*Static Blocks*/
function fastway_footer_block(){
        
    if( !empty( fw_theme_mod("footer-stblock") ) && strlen( fw_theme_mod("footer-stblock")) > 0 && class_exists("fw_StaticBlock") ) {
        fw_StaticBlock::getSticBlockContent( fw_theme_mod("footer-stblock") );
    }
}

function fastway_singleblock_block(){
    
    if( !empty( fw_theme_mod("product-page-footer-block") ) && strlen( fw_theme_mod("product-page-footer-block") ) > 0 && class_exists("fw_StaticBlock") ) fw_StaticBlock::getSticBlockContent( fw_theme_mod("product-page-footer-block") );
}

add_shortcode('fw_shortcode_stblock', 'fw_shortcode_stblock');
function fw_shortcode_stblock( $atts ) {
    fw_StaticBlock::getSticBlockContent( $atts["slug"] );
}

function fastway_get_stblock( $cats = array('all') ){
    $res_args = array();

    $meta_query = array();
    
    $args = array(
        'post_type'         => 'fw_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
        //'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->post_name;

        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}


function get_blocks( ){
    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'DESC',
        'post_type'        => 'static-block',
        'post_status'      => 'publish',
    );
    
    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->ID;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'understrap_post_nav' ) ) :

    function understrap_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
        ?>
                <nav class="container navigation post-navigation">
                    <h2 class="sr-only"><?php _e( 'Post navigation', 'fastway' ); ?></h2>
                    <div class="row nav-links justify-content-between">
                        <?php

                            if ( get_previous_post_link() ) {
                                previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'fastway' ) );
                            }
                            if ( get_next_post_link() ) {
                                next_post_link( '<span class="nav-next">%link</span>',     _x( '%title&nbsp;<i class="fa-angle-right"></i>', 'Next post link', 'fastway' ) );
                            }
                        ?>
                    </div><!-- .nav-links -->
                </nav><!-- .navigation -->

        <?php
    }
endif;


function init_analytics() {
    
    $analytics = '<!-- Analyitics  Code -->
    <script type="text/javascript">

                  var _gaq = _gaq || [];
                  _gaq.push([\'_setAccount\', \''.fw_theme_mod('analytics-id').'\']);
                  _gaq.push([\'_trackPageview\']);

                  (function() {
                    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
                      ga.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\') + \'stats.g.doubleclick.net/dc.js\';
                    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
                  })();

                </script>';

    echo "\n" . $analytics;
}
function init_fb() {
    
    $analytics = "<!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '".fw_theme_mod('fbpixel_id')."');
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height='1' width='1'
    src='https://www.facebook.com/tr?id=".fw_theme_mod("fbpixel_id")."&ev=PageView
    &noscript=1'/>
    </noscript>
    <!-- End Facebook Pixel Code -->";
    echo "\n" . $analytics;
}
function init_gtagmanager() {
    
    $analytics = "<!-- Global site tag (gtag.js) - Google Ads:  -->
    <script async src='https://www.googletagmanager.com/gtag/js?id=AW-".fw_theme_mod("gtagmanager_id")."'></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'AW-".fw_theme_mod("gtagmanager_id")."');
    </script>";
    echo "\n" . $analytics;
}
if(!empty(fw_theme_mod('gtagcheckout_id')))add_action( 'woocommerce_thankyou', 'init_gtagcheckout' );
 
function init_gtagcheckout() {
    
    $analytics = "<!-- Global site tag (gtag.js) - CHECKOUT -->
    <script>
  gtag('event', 'conversion', {
      'send_to': 'AW-860462306/".fw_theme_mod("gtagcheckout_id")."',
      'transaction_id': ''
  });
</script>";
    echo "\n" . $analytics;
}

if (!is_admin()) {
  //load front-end options here.
  if(!current_user_can( 'manage_options' ) ) {
    if(!empty(fw_theme_mod('analytics-id')))add_action('wp_head', 'init_analytics', 35);
    if(!empty(fw_theme_mod('fbpixel_id')))add_action('wp_head', 'init_fb', 35);
    if(!empty(fw_theme_mod('gtagmanager_id')))add_action('wp_head', 'init_gtagmanager', 35);
    
  }
}

/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}



//add_action( 'vc_before_init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {
    require_once( get_template_directory().'/functions/vc_customs/vc_woo_carousel.php' ); 
    //require_once( get_template_directory().'/functions/vc_customs/vc_sale_products.php' ); 
    //require_once( get_template_directory().'/functions/vc_customs/vc_bestseller_products.php' ); 
    //require_once( get_template_directory().'/functions/vc_customs/vc_toprated_products.php' ); 
    //require_once( get_template_directory().'/functions/vc_customs/vc_recent_products.php' ); 
}



