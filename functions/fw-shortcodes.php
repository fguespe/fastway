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

function fw_extras_short( $atts ) {
    $fwatts = shortcode_atts(
        array(
            'type' => '',
            'text' =>  '',
            'size' =>  '',
            'link' =>  '',
            'cant' =>  '',
            'isli' =>  '',
            'isli_i' =>  '',
            'icon_color' =>  '',
            'icon' =>  '',
            'text_color' => '',
            'stext' =>  '',
            'blink' =>  '',
            'tlink' =>  '',
            'sblock' =>  '',
            'iframe' =>  '',
        ), $atts, 'fw_extras_short' );

    $font_size=16;
    $type=$fwatts['type'];
    $icon=$type;
    $icons_style=fw_theme_mod("icons_style");
    $value="";
    $cant=0;
    if($fwatts['cant'])$cant=intval($fwatts['cant']);

    if($type==="phone"){
        $icon=$icons_style." fa-phone";
        $link=fw_company_data($type,true,$cant);
        $value=fw_company_data($type,false,$cant);
    }else if($type==="whatsapp"){
        $icon="fab fa-whatsapp";
        $link=fw_company_data($type,true,$cant);
        $value=fw_company_data($type,false,$cant);
    }else if($type==="email"){
        $icon=$icons_style." fa-envelope";
        $link=fw_company_data($type,true,$cant);
        $value=fw_company_data($type,false,$cant);
    }else if($type==="fb"){
        $icon="fab fa-facebook";
        $link=fw_company_data($type,true,$cant);
        $value="Ir al Facebook";
    }else if($type==="ig"){
        $icon="fab fa-instagram";
        $link=fw_company_data($type,true,$cant);
        $value="Ir al Instagram";
    }else if($type==="youtube"){
        $icon=$icons_style." fa-youtube-square";
        $link=fw_company_data($type,true,$cant);
        $value="Ir a Youtube";
    }else if($type==="address"){
        $icon=$icons_style." fa-map-marker-alt";
        $link=fw_company_data("googlemaps",true,$cant);
        $value=fw_company_data("address",false,$cant);
    
    }if($fwatts['text'] || empty($value)){
       $value=$fwatts['text'];
    }
    if($fwatts['link']){
       $link=$fwatts['link'];
    }
    if($fwatts['size']){
        $font_size=$fwatts['size'];
    }
   
    if($fwatts["isli"]){
        $first= '<li class="fw_icon_bs_short d-flex align-items-center "> 
          <span class="icon"><i class="'.$icon.'"></i></span> 
          <span class="text"> <big>'.$value.'</big> <small>'.$fwatts['stext'].'</small> </span>
        </li>';
    }else if($fwatts["isli_i"]){
        $first= '<li class="fw_icon_bs_short d-flex align-items-center "> 
          <span class="icon"><i class="'.$icon.'"></i></span> 
          <span class="text"> <small>'.$value.'</small> <big>'.$fwatts['stext'].'</big> </span>
        </li>';
    }else{
        $first='<a target="_blank" class="fw_quicklink '.$type.'" style="font-size:'.$font_size.'px !important;line-height:'.($font_size+20).'px !important;" href="'.$link.'"><i class="'.$icon.'" style="color:'.$fwatts['icon_color'].'"!important;></i>';
        if($fwatts['only_icon']!=="true")$first.='  <span style="color:'.$fwatts['text_color'].' !important;font-size:'.$fwatts['size'].'px !important;">'.$value.'</span>';
        $first.='</a>';
    }
    if(!empty($fwatts['sblock'])){
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$fwatts['sblock'].'" class="fancybox">'.$first;
        $first.= "</a>".fw_modal_block($fwatts['sblock'],$fwatts['sblock']);
    }else if(!empty($fwatts['iframe'])){
        $rand=generateRandomString();
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$rand.'" class="fancybox">'.$first;
        $first.= "</a>".fw_modal_block($rand,$fwatts['iframe'],true);
    }else if(!empty($link) && $fwatts["isli_i"] || $fwatts["isli"]){
        $first='<a target="_blank" href="'.$link.'">'.$first;
        $first.= "</a>";
    }
    return $first;
}


function fwi( $atts ) {
    $fwatts = shortcode_atts(
        array(
            'type' => '',
            'size' =>  '',
            'color' => '',
        ), $atts, 'fwi' );
    $type=$fwatts["type"];
    $color=$fwatts["color"];
    $size=$fwatts["size"];

    $icons_style=fw_theme_mod("icons_style");
    if(strpos($type, "fa-") === false)$type="fa-".$type;
    if(strpos($type, " ") === false)$type=$icons_style." ".$type;
    return  '<i class="'.$type.'" style="color:'.$color.';font-size:'.$size.'px;"></i>';        
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
    add_shortcode('fw_extras_short', 'fw_extras_short', 10, 2);
    add_shortcode('fw_extras_iconsnext', 'fw_extras_iconsnext', 10, 2);
    add_shortcode("fwi","fwi",10,2);
}
 
add_action('init', 'wporg_shortcodes_init');


function quicklinks(){
    echo "<div class='fw_quicklinks '>";
    if(!empty(fw_company_data("fb")))echo '<a class="fb" href="'.fw_company_data("name",true).'"><i class="fab fa-facebook" style="color:#4267B2;"></i><span> Facebook</span></a>';
    if(!empty(fw_company_data("youtube")))echo '<a class=" youtube" href="'.fw_company_data("youtube",true).'"><i class="fab fa-youtube" style="color:#FF0200;"></i><span>  Youtube</span></a>';
    if(!empty(fw_company_data("whatsapp")))echo '<a class="  whats" href="https://api.whatsapp.com/send?phone='.fw_company_data("whatsapp",true).'" style="color:var(--icon-header);"><i class="fab fa-whatsapp" style="color:green;"></i><span>  Whatsapp</span><span class="solochat" style="display:none;"> (Solo para chat)</a>';
    if(!empty(fw_company_data("ig")))echo '<a class=" ig" href="'.fw_company_data("ig",true).'"><i class="fab fa-instagram" style="color:#D1178A;"></i><span>  Instagram</span></a>';
    if(!empty(fw_company_data("email")))echo '<a class=" mail" href="'.fw_company_data("email",true).'"><i class="fa fa-envelope" style="color:var(--icon-header);"></i><span>  Mandar un mail</span></a>';
    if(!empty(fw_company_data("phone")))echo '<a class=" tel" href="'.fw_company_data("phone",true).'"><i class="fa fa-phone" style="color:var(--icon-header);"></i><span>  Llamar</span></a>';
    if(!empty(fw_company_data("address")) && !empty(fw_company_data("googlemaps")))echo '<a class="map" href="'.fw_company_data("googlemaps",true).'"><i class="fa fa-map-marker" style="color:var(--icon-header);"></i><span>  '.fw_company_data("address",true).'</span></a>';
    
    echo "</div>";
}


function fw_company_data($value, $link=false,$cant=0) {
    $value=trim($value);$link=trim($link);$pre="";
    if($value=="whatsapp")$pre="https://api.whatsapp.com/send?phone=";
    if($value=="phone")$pre="tel: ";
    if($value=="mail" || $value==="email")$pre="mailto: ";
    $value=explode("|", fw_theme_mod('short-fw_company'.$value))[$cant];
    preg_match('#\((.*?)\)#', $value, $match);
    $link_en_parentesis= $match[1];
    if(!empty($link_en_parentesis)  && !$link){//Si hay link en parentesis
        $value=$pre.str_replace("(".$link_en_parentesis.")","",$value);
    }else if(!empty($link_en_parentesis) && $link){
        $value=$pre.$link_en_parentesis;
    }else if(empty($link_en_parentesis) && $link){
        $value=$pre.$value;
    }
    return $value;
}
