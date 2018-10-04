<?php


if(fw_theme_mod("maintainance-mode")){

    add_action('get_header', 'fw_maintenance_mode');
}

function wca_custom_loginui() {
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
add_action('login_head', 'wca_custom_loginui');


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
/*
function fw_custom_css(){

    $css="";
    $css.=":root{";
    $css.="--main:".fw_theme_mod('opt-color-main').";";
    $css.="--top-banner:".fw_theme_mod('opt-color-topheader-banner').";";
    $css.="--icon-header:".fw_theme_mod('opt-color-iconheader').";";
    $css.="--second-color:".fw_theme_mod('opt-color-second').";";
    $css.="--top-header:".fw_theme_mod('opt-color-topheader').";"; 
    $css.="--middle-header:".fw_theme_mod('opt-color-middheader').";";
    $css.="--bottom-header:".fw_theme_mod('opt-color-bottheader').";";
    $css.="--body:".fw_theme_mod('opt-color-bodycolor').";";
    $css.="--footer:".fw_theme_mod('opt-color-footer').";";
    $css.= "}";
    $tipos=array("p","span","a","h4","h3","h2","h1");
    //Fonts comunes
    foreach ($tipos as $key) {
        if($key == "a" || $key == "div" || $key == "p" || $key == "span" )$nombre='opt-typography-body';
        else $nombre='opt-typography-'.$key;
        if(empty(fw_theme_mod($nombre)))continue;
        $font=fw_theme_mod($nombre);
   
        //$css.= "header ".$key.",footer ".$key.",#page-wrapper ".$key.",#woocommerce-wrapper ".$key.",#main-nav ".$key."{";
        $css.= "body ".$key."{";
        $css.= "font-family:".str_replace(",", "','", $font['font-family']).";";
        $css.= "font-size:".$font['font-size'].";";
        $css.= "font-weight:".$font['font-weight'].";";
        $css.= "line-height:".$font['line-height'].";";
        $css.= "color:".$font['color'].";";
        $css.= "text-transform:".$font['text-transform'].";";
        $css.= "text-align:".$font['text-align'].";";
        $css.= "letter-spacing:".$font['letter-spacing'].";";
        $css.= "}";   
    }
    
    
    if(fw_theme_mod('css-onoff')=="on"){
        $css.=  fw_theme_mod('css_editor-general'); 
        $css.=  fw_theme_mod('css_editor-header'); 
        $css.=  fw_theme_mod('css_editor-body'); 
        $css.=  fw_theme_mod('css_editor-footer'); 
        $css.=  fw_theme_mod('css_editor-loop');  
        $css.=  fw_theme_mod('css_editor-sidebarcats'); 
        $css.=  fw_theme_mod('css_editor-single'); 
        $css.=  fw_theme_mod('css_editor-mobile'); 
    }
    if(is_child_theme()){
        $files=glob(get_stylesheet_directory().'/fonts/*.otf');
        $files=array_merge($files,glob(get_stylesheet_directory().'/fonts/*.ttf'));
        $files=array_merge($files,glob(get_stylesheet_directory().'/fonts/*.OTF'));
        if(!empty($files)){
            foreach ($files as $path){ 
                $nombre=basename($path,".otf");
                $nombre=basename($nombre,".ttf");
                $nombre=basename($nombre,".OTF");
                $css.= "@font-face {";
                $css.= "font-family: '".$nombre."'";
                $css.= "src:url('".get_stylesheet_directory_uri().'/fonts/'.basename($path)."')";
                $css.= " }";
                $css.= " }";
                $css.= " }";
            }
        }
    }
    return trim(preg_replace('/\t+/', '', $css));
}
*/

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
            $css.= "line-height: calc(".($resized+2)."px + (".$height." - ".($resized+2).") * ((100vw - 300px) / (1600 - 300))); ";
            $css.= "}";   
        }
       
    }
    if(!empty(fw_theme_mod('sticky-menu'))){
        foreach(fw_theme_mod('sticky-menu') as $key){
           $css.=".fw-sticky-top .".$key."{
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
    echo '<div class="fw_header_top d-none d-lg-flex">
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

function fastway_getWidgetHeaderText(){
    echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('header-headerwidget-text'))));
}
function fw_companyname() {
    
    return fw_theme_mod('short-fw_companyname');
}
function fw_companywhatsapp() {
    
    return fw_theme_mod('short-fw_companywhatsapp');
}
function fw_companyig() {
    
    return fw_theme_mod('short-fw_companyig');
}
function fw_companyyoutube() {
    
    return fw_theme_mod('short-fw_companyyoutube');
}
function fw_companyemail() {
    
    return fw_theme_mod('short-fw_companyemail');
}
function fw_companyphone() {
    
    return fw_theme_mod('short-fw_companyphone');
}
function fw_companyfb() {
    
    return fw_theme_mod('short-fw_companyfb');
}
function fw_companyaddress() {
    
    return fw_theme_mod('short-fw_companyaddress');
}
function fw_companygooglemaps() {
    
    return fw_theme_mod('short-fw_companygooglemaps');
}


function fw_extras_short( $atts ) {
    $wporg_atts = shortcode_atts(
        array(
            'type' => '',
            'text' =>  '',
            'size' =>  '',
            'link' =>  '',
        ), $atts, 'fw_extras_short' );

    $font_size=16;
    
    if($wporg_atts['type']==="phone"){
        $font_icon="fa-phone";
        $value="tel:".fw_companyphone();
        $value=fw_companyphone();
    }else if($wporg_atts['type']==="whatsapp"){
        $font_icon="fa-whatsapp";
        $link="https://api.whatsapp.com/send?phone=".fw_companywhatsapp();
        $value=fw_companywhatsapp();
    }else if($wporg_atts['type']==="email"){
        $font_icon="fa-envelope-o";
        $link="mailto:".fw_companyemail();
        $value=fw_companyemail();
    }else if($wporg_atts['type']==="fb"){
        $font_icon="fa-facebook-square";
        $link=fw_companyfb();
        $value="Ir al Facebook";
    }else if($wporg_atts['type']==="ig"){
        $font_icon="fa-instagram";
        $link=fw_companyig();
        $value="Ir al Instagram";
    }else if($wporg_atts['type']==="youtube"){
        $font_icon="fa-youtube-square";
        $link=fw_companyyoutube();
        $value="Ir a Youtube";
    }else if($wporg_atts['type']==="address"){
        $font_icon="fa-map-marker";
        $link=fw_companygooglemaps();
        $value=fw_companyaddress();
    }
    if($wporg_atts['text']){
       $value=$wporg_atts['text'];
    }
    if($wporg_atts['link']){
       $link=$wporg_atts['link'];
    }
    if($wporg_atts['size']){
        $font_size=$wporg_atts['size'];
    }
    $first='<a class="fw_quicklink" style="font-size:'.$font_size.'px;line-height:'.($font_size+20).'px;" href="'.$link.'"><i class="fa '.$font_icon.'" style="color:'.$wporg_atts['icon_color'].'"></i>';
    if($wporg_atts['only_icon']!=="true")$first.='  <span style="color:'.$wporg_atts['text_color'].';font-size:'.$wporg_atts['size'].'px;">'.$value.'</span>';
    $first.='</a>';
    return $first;
}
 
function wporg_shortcodes_init()
{

    add_shortcode('fw_extras_short', 'fw_extras_short', 10, 2);

}
 
add_action('init', 'wporg_shortcodes_init');


add_shortcode('fw_companyfb', 'fw_companyfb');
add_shortcode('fw_companyig', 'fw_companyig');
add_shortcode('fw_companyyoutube', 'fw_companyyoutube');
add_shortcode('fw_companygooglemaps', 'fw_companygooglemaps');
add_shortcode('fw_companyemail', 'fw_companyemail');
add_shortcode('fw_companyphone', 'fw_companyphone');
add_shortcode('fw_companywhatsapp', 'fw_companywhatsapp');
add_shortcode('fw_companyname', 'fw_companyname');
add_shortcode('fw_companyaddress', 'fw_companyaddress');

function quicklinks(){
    echo "<div class='fw_quicklinks text-center'>";
    if(!empty(fw_companyfb()))echo '<a class="fb" href="'.fw_companyfb().'"><i class="fa fa-facebook-square" style="color:#4267B2;"></i><span> Facebook</span></a>';
    if(!empty(fw_companyyoutube()))echo '<a class="youtube" href="'.fw_companyyoutube().'"><i class="fa fa-youtube-square" style="color:#FF0200;"></i><span>  Youtube</span></a>';
    if(!empty(fw_companywhatsapp()))echo '<a class="whats" href="https://api.whatsapp.com/send?phone='.fw_companywhatsapp().'" style="color:var(--icon-header);"><i class="fa fa-whatsapp" style="color:green;"></i><span>  Whatsapp</span><span class="solochat" style="display:none;"> (Solo para chat)</a>';
    if(!empty(fw_companyig()))echo '<a class="ig" href="'.fw_companyig().'"><i class="fa fa-instagram" style="color:#D1178A;"></i><span>  Instagram</span></a>';
    if(!empty(fw_companyemail()))echo '<a class="mail" href="mailto:'.fw_companyemail().'"><i class="fa fa-envelope-o" style="color:var(--icon-header);"></i><span>  Mandar un mail</span></a>';
    if(!empty(fw_companyphone()))echo '<a class="tel" href="tel:'.fw_companyphone().'"><i class="fa fa-phone" style="color:var(--icon-header);"></i><span>  Llamar</span></a>';
    if(!empty(fw_companyaddress()) && !empty(fw_companygooglemaps()))echo '<a class="map" href="'.fw_companygooglemaps().'"><i class="fa fa-map-marker" style="color:var(--icon-header);"></i><span>  '.fw_companyaddress().'</span></a>';
    
    echo "</div>";
}




if( !function_exists('fastway_getLogo') ) {
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
                                previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'fastway' ) );
                            }
                            if ( get_next_post_link() ) {
                                next_post_link( '<span class="nav-next">%link</span>',     _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'fastway' ) );
                            }
                        ?>
                    </div><!-- .nav-links -->
                </nav><!-- .navigation -->

        <?php
    }
endif;


function init_analytics() {
    
    $analytics = '<script type="text/javascript">

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

if (!is_admin()) {
  //load front-end options here.
  if(!current_user_can( 'manage_options' ) ) {
    add_action('wp_footer', 'init_analytics', 35);
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



