<?php
add_shortcode("fw_shortcode_metaslider","fw_shortcode_metaslider");
function fw_shortcode_metaslider( $atts ) {
    $fwatts = shortcode_atts(
    array(
        'sl_desktop' => '',
        'sl_mobile' => '',
    ), $atts, 'fw_shortcode_metaslider' );
    $desk=$fwatts["sl_desktop"];
    $mob=$fwatts["sl_mobile"];
    if(empty($mob))$mob=$desk;
    echo '<div class="d-none d-md-block">'.do_shortcode('[metaslider id="'.$desk.'"]').'</div>';
    echo '<div class="d-md-none">'.do_shortcode('[metaslider id="'.$mob.'"]').'</div>';

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
}function fw_company_data($value) {
    
    return fw_theme_mod('short-fw_company'.$value);
}
function fw_icon( $atts ) {
    $fwatts = shortcode_atts(
        array(
            'type' => '',
            'text' =>  '',
            'size' =>  '',
            'link' =>  '',
            'isli' =>  '',
            'icon_color' =>  '',
            'icon' =>  '',
            'text_color' => '',
            'stext' =>  '',
        ), $atts, 'fw_extras_short' );

}
function get_icon_fw(){
    $icon=fw_theme_mod("icons_style");
    if($icon=="regular")$icon="fa";
    else if($icon=="solid")$icon="fas";
    else if($icon=="light")$icon="fal";
    if(empty($icon))$icon="fa";
    
    return $icon;
}
function fw_extras_short( $atts ) {
    $fwatts = shortcode_atts(
        array(
            'type' => '',
            'text' =>  '',
            'size' =>  '',
            'link' =>  '',
            'isli' =>  '',
            'icon_color' =>  '',
            'icon' =>  '',
            'text_color' => '',
            'stext' =>  '',
        ), $atts, 'fw_extras_short' );

    $font_size=16;
    $type=$fwatts['type'];
    $icon=$type;
    $value="";
    if($type==="phone"){
        $icon=get_icon_fw()." fa-phone";
        $value="tel:".fw_companyphone();
        $value=fw_companyphone();
    }else if($type==="whatsapp"){
        $icon="fab fa-whatsapp";
        $link="https://api.whatsapp.com/send?phone=".fw_companywhatsapp();
        $value=fw_companywhatsapp();
    }else if($type==="email"){
        $icon=get_icon_fw()." fa-envelope-o";
        $link="mailto:".fw_companyemail();
        $value=fw_companyemail();
    }else if($type==="fb"){
        $icon="fab fa-facebook";
        $link=fw_companyfb();
        $value="Ir al Facebook";
    }else if($type==="ig"){
        $icon="fab fa-instagram";
        $link=fw_companyig();
        $value="Ir al Instagram";
    }else if($type==="youtube"){
        $icon=get_icon_fw()." fa-youtube-square";
        $link=fw_companyyoutube();
        $value="Ir a Youtube";
    }else if($type==="address"){
        $icon=get_icon_fw()." fa-map-marker-alt";
        $link=fw_companygooglemaps();
        $value=fw_companyaddress();
    }
    if($fwatts['text'] || empty($value)){
       $value=$fwatts['text'];
    }
    if($fwatts['link']){
       $link=$fwatts['link'];
    }
    if($fwatts['size']){
        $font_size=$fwatts['size'];
    }
   
    if($fwatts["isli"]){
        return '<li class="fw_icon_bs_short d-flex align-items-center "> 
          <span class="icon"><i class="'.$icon.'"></i></span> 
          <span class="text"> <big>'.$value.'</big> <small>'.$fwatts['stext'].'</small> </span>
        </li>';

    }
    $first='<a target="_blank" class="fw_quicklink '.$type.'" style="font-size:'.$font_size.'px !important;line-height:'.($font_size+20).'px !important;" href="'.$link.'"><i class="'.$icon.'" style="color:'.$fwatts['icon_color'].'"!important;></i>';
    if($fwatts['only_icon']!=="true")$first.='  <span style="color:'.$fwatts['text_color'].' !important;font-size:'.$fwatts['size'].'px !important;">'.$value.'</span>';
    $first.='</a>';
    return $first;
}


add_shortcode("fwi","fwi");
function fwi( $atts ) {
    $fwatts = shortcode_atts(
        array(
            'type' => '',
            'size' =>  '',
            'color' => '',
        ), $atts, 'fw_icons_fa' );
    $type=$fwatts["type"];
    $color=$fwatts["color"];
    $size=$fwatts["size"];
    if(strpos($type, "fa-") === false)$type="fa-".$type;
    if(strpos($type, " ") === false)$type=get_icon_fw()." ".$type;
    return  '<i class="'.$type.'" style="color:'.$color.'font-size:'.$size.'"></i>';        
}
function fw_extras_iconsnext( $atts ) {
    $fwatts = shortcode_atts(
        array(
            'type' => '',
            'size' =>  '',
            'icon_color' => '',
        ), $atts, 'fw_extras_iconsnext' );

    $font_size=16;
    $icon_color="var(--main)";
    if($fwatts['size']){
        $font_size=$fwatts['size'];
    }
    if($fwatts['icon_color']){
        $icon_color=$fwatts['icon_color'];
    }
    foreach (explode(",", $fwatts['type']) as $icon) {
        if($icon==="fb")$icon="fab fa-facebook";
        else if($icon==="ig")$icon="fab fa-instagram";
        else if($icon==="youtube")$icon="fab fa-youtube";
        else if($icon==="twitter")$icon="fab fa-twitter";
        $link=fw_company_data($icon);
        
        $first.='<a target="_blank" class="fw_quicklink" style="margin-right:5px !important;font-size:'.$font_size.'px !important;line-height:'.($font_size+20).'px !important;" href="'.$link.'"><i class="'.$icon.'" style="color:'.$icon_color.' !important;"></i>';
        $first.='</a>';
    }
    
    
    return $first;
}

function wporg_shortcodes_init(){
    add_shortcode('fw_icon', 'fw_icon', 10, 2);
    add_shortcode('fw_extras_short', 'fw_extras_short', 10, 2);
    add_shortcode('fw_extras_iconsnext', 'fw_extras_iconsnext', 10, 2);
       
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
    echo "<div class='fw_quicklinks '>";
    if(!empty(fw_companyfb()))echo '<a class="fb" href="'.fw_companyfb().'"><i class="fab fa-facebook" style="color:#4267B2;"></i><span> Facebook</span></a>';
    if(!empty(fw_companyyoutube()))echo '<a class=" youtube" href="'.fw_companyyoutube().'"><i class="fa-youtube-square" style="color:#FF0200;"></i><span>  Youtube</span></a>';
    if(!empty(fw_companywhatsapp()))echo '<a class="  whats" href="https://api.whatsapp.com/send?phone='.fw_companywhatsapp().'" style="color:var(--icon-header);"><i class="fa-whatsapp" style="color:green;"></i><span>  Whatsapp</span><span class="solochat" style="display:none;"> (Solo para chat)</a>';
    if(!empty(fw_companyig()))echo '<a class=" ig" href="'.fw_companyig().'"><i class="fa-instagram" style="color:#D1178A;"></i><span>  Instagram</span></a>';
    if(!empty(fw_companyemail()))echo '<a class=" mail" href="mailto:'.fw_companyemail().'"><i class="fa-envelope-o" style="color:var(--icon-header);"></i><span>  Mandar un mail</span></a>';
    if(!empty(fw_companyphone()))echo '<a class=" tel" href="tel:'.fw_companyphone().'"><i class="fa-phone" style="color:var(--icon-header);"></i><span>  Llamar</span></a>';
    if(!empty(fw_companyaddress()) && !empty(fw_companygooglemaps()))echo '<a class="map" href="'.fw_companygooglemaps().'"><i class="fa-map-marker" style="color:var(--icon-header);"></i><span>  '.fw_companyaddress().'</span></a>';
    
    echo "</div>";
}
