<?php

add_shortcode("fwi","fwi",10,2);
add_shortcode("fw_info_modal","fw_info_modal",10,2);


add_shortcode("fw_shortcode_metaslider","fw_shortcode_metaslider");
function fw_shortcode_metaslider( $atts ) {
    $atts = shortcode_atts(
    array(
        'sl_desktop' => '',
        'sl_mobile' => '',
    ), $atts, 'fw_shortcode_metaslider' );
    $desk=$atts["sl_desktop"];
    $mob=$atts["sl_mobile"];
    if(empty($mob))$mob=$desk;
    echo '<div class="d-none d-md-block">'.do_shortcode('[metaslider id="'.$desk.'"]').'</div>';
    echo '<div class="d-md-none">'.do_shortcode('[metaslider id="'.$mob.'"]').'</div>';

}

add_shortcode('fw_extras_short', 'fw_data', 10, 2);
add_shortcode('fw_data', 'fw_data', 10, 2);
function fw_data( $atts ) {
    $atts = shortcode_atts(
        array(
            'type' => '',
            'text' =>  '',
            'size' =>  '',
            'weight' =>  '',
            'link' =>  '',
            'cant' =>  '',
            'icon_color' =>  '',
            'text_color' => '',
            'stext_color' => '',
            'stext' =>  '',
            'sblock' =>  '',
            'iframe' =>  '',
            'modal' =>  '',
            'format' =>  '',
            'only_text' =>  '',
            //Depreceated
            'isli' =>  '',
            'isli_i' =>  '',
            'iconsnext' =>  '',
            'el_class' =>  '',
            'el_id' =>  '',
        ), $atts );

    $font_size=16;$font_weight='normal';
    $type=$atts['type'];
    $icon=$type;
    $icons_style=fw_theme_mod("fw_icons_style");
    $value="";
    $cant=1;
    if($atts['cant'])$cant=intval($atts['cant']);
    
    if($type==="phone"){
        $icon=$icons_style." fa-phone";
        $link=fw_company_data($type,true,$cant);
        $value=fw_company_data($type,false,$cant);
    }else if($type==="whatsapp"){
        $icon="fab fa-whatsapp";
        $link=fw_company_data($type,true,$cant);
        $value=fw_company_data($type,false,$cant);
        $icon_color="#0CBC47";
    }else if($type==="name"){
        $icon="";
        $link='';
        $value=fw_company_data($type,false,$cant);
        $icon_color="";
    }else if($type==="email"){
        $icon=$icons_style." fa-envelope";
        $link=fw_company_data($type,true,$cant);
        $value=fw_company_data($type,false,$cant);
    }else if($type==="fb"){
        $icon="fab fa-facebook";
        $link=fw_company_data($type,true,$cant);
        $value="Ir al Facebook";
        $icon_color="#3A5999";
    }else if($type==="ig"){
        $icon="fab fa-instagram";
        $link=fw_company_data($type,true,$cant);
        $value="Ir al Instagram";
        $icon_color="#9A3CC3";
    }else if($type==="youtube"){
        $icon="fab fa-youtube";
        $link=fw_company_data($type,true,$cant);
        $value="Ir a Youtube";
        $icon_color="#FF0400";
    }else if($type==="address"){
        $icon=$icons_style." fa-map-marker-alt";
        $link=fw_company_data("googlemaps",true,$cant);
        $value=fw_company_data("address",false,$cant);
        $link=fw_company_data("address",true,$cant);
        if(empty($link))fw_company_data("googlemaps",true,$cant);
    }else{
        //Puso directo las clases
        $icon=$icons_style.' '.$type;
        $type='custom';
    }
    if(!empty($atts['icon_color']))$icon_color=$atts['icon_color'];
    //error_log($type.' '.$icon_color);
    if($atts['text'] || empty($value))$value=$atts['text'];
    if($atts['link'])$link=$atts['link'];
    if($atts['size'])$font_size=$atts['size'];
    if($atts['weight'])$font_weight=$atts['weight'];
    $only_text=false;
    if(($atts["only_text"]))$only_text=true;
    //format
    if($atts["format"])$format=$atts["format"];
    else if($atts["isli"])$format="isli";
    else if($atts["isli_i"])$format="isli_i";
    else if($atts["iconsnext"])$format="iconsnext";
    //error_log($type);
    $iconclass=" fw_icon fw_icon_bs_short ".$atts['el_class'].' ';

    if($format=="isli"){
        $first= '<li class="'.$iconclass.'  d-flex align-items-center "> ';
        if(!$atts["only_text"])$first.='<span class="icon"><i class="'.$icon.'"></i></span>';
        $first.=' <span class="text"> <big style="color:'.$atts['text_color'].' !important;">'.$value.'</big> <small style="color:'.$atts['text_color'].' !important;">'.$atts['stext'].'</small> </span></li>';
    }else if($format=="isli_i"){
        $first= '<li class="'.$iconclass.'  d-flex align-items-center "> ';
        if(!$atts["only_text"])$first.='<span class="icon"><i class="'.$icon.'"></i></span>';
        $first.='<span class="text"> <small>'.$value.'</small> <big>'.$atts['stext'].'</big> </span></li>';
    }else if(!empty($atts['sblock'])){
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$atts['sblock'].'" class="fancybox">'.$first;
        $first.= "</a>".fw_modal_block($atts['sblock'],$atts['sblock']);
    }else if($format=='iconsnext'){
        $first.='<div id="'.$atts['el_id'].'" class="'.$iconclass.'">';

        foreach (explode(",", $atts['type']) as $icon) {
            if($icon==="fb")$icon="fab fa-facebook";
            else if($icon==="ig")$icon="fab fa-instagram";
            else if($icon==="youtube")$icon="fab fa-youtube";
            else if($icon==="twitter")$icon="fab fa-twitter";
            $link=fw_company_data($icon);
            
            $first.='<a target="_blank" class="fw_quicklink" style="margin-right:5px !important;font-size:'.$font_size.'px !important;font-weight:'.$font_weight.' !important;line-height:'.($font_size+20).'px !important;" href="'.$link.'"><i class="'.$icon.'" style="color:'.$icon_color.' !important;"></i>';
            $first.='</a>';
        }
        $first.="</div>";
    
    }else{
        $first='<a target="_blank" class="'.$iconclass.' '.$type.'" style="font-size:'.$font_size.'px !important;font-weight:'.$font_weight.' !important;line-height:'.($font_size+20).'px !important;" href="'.$link.'">';
        if(!$atts["only_text"])$first.='<i class="'.$icon.'" style="color:'.$icon_color.' !important;"></i>';
        $first.='  <span style="color:'.$atts['text_color'].' !important;font-size:'.$font_size.'px !important;font-weight:'.$font_weight.' !important;">'.$value.'</span>';
        $first.='</a>';
    }

    if(!empty($atts['iframe'] )){
        $rand=generateRandomString();
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$rand.'" class="fancybox">'.$first;
        $first.= "</a>".fw_modal_block($rand,$atts['iframe'],true);
    }if(!empty($atts['modal'] )){
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$atts['modal'].'" class="fancybox">'.$first;
        $first.= "</a>";
    }else if(!empty($link) && ($format=="isli_i" || $format=="isli")){
        $first='<a target="_blank" href="'.$link.'">'.$first;
        $first.= "</a>";
    }
    return $first;
}

function fw_info_modal( $atts ) {
    $rand=generateRandomString();
        
    $atts = shortcode_atts(
        array(
            'sblock' => '',
            'label' => '',
            'class' =>  '',
            'content' => '',
        ), $atts, 'fw_info_modal' );
    $first='<button target="_blank" data-toggle="modal" data-target="#'.$rand.'" class="fancybox '.$atts['class'].'">'.$atts['label'].'</button>';
    $first.= ( fw_modal_block($rand,$atts['sblock']));
    return $first;
}

function fwi( $atts ) {
    $atts = shortcode_atts(
        array(
            'type' => '',
            'size' =>  '',
            'color' => '',
        ), $atts, 'fwi' );
    $type=$atts["type"];
    $color=$atts["color"];
    $size=$atts["size"];

    $icons_style=fw_theme_mod("fw_icons_style");
    if(strpos($type, "fa-") === false)$type="fa-".$type;
    if(strpos($type, " ") === false)$type=$icons_style." ".$type;
    return  '<i class="'.$type.'" style="color:'.$color.';font-size:'.$size.'px;"></i>';        
}




function quicklinks(){
    $quick =trim(fw_theme_mod("fw_quickmenu_links"));
    $arra=array(
        "fb"=>array("fab fa-facebook"), 
        "youtube"=>array("fab fa-youtube"), 
        "whatsapp"=>array("fab fa-whatsapp"), 
        "ig"=>array("fab fa-instagram"), 
        "email"=>array("fa fa-envelope"),  
        "phone"=>array("fa fa-phone"),  
        "address"=>array("fa fa-map-marker"), 
    );
    $quick = explode(",",$quick);
    echo "<div class='fw_quicklinks '>";
    $i=0;
    foreach($quick as $q){
        $i++;
        $num=0;
        $char=substr($q, -1);
        if(intval($char)){
            $num=$char;
            $q=str_replace($char,"",$q);
        }
        $label=fw_company_data($q,false,$num);
        if(!empty($label))echo '<a class="quick'.$i.'" href="'.fw_company_data($q,true,$num).'"><i class="'.$arra[$q][0].'" ></i><span>'.$label.'</span></a>';
        
    }
    
    echo "</div>";
}


function fw_company_data($type, $link=false,$cant=1) {
    $type=trim($type);$link=trim($link);$pre="";
  
    if($type=="whatsapp" && $link)$pre="https://api.whatsapp.com/send?text=".fw_theme_mod('fw_share_message')."&phone=";
    else if($type=="phone" && $link)$pre="tel:";
    else if($type==="email" && $link)$pre="mailto:";
    $value=fw_theme_mod('short-fw_company'.$type);
    
    //fix whatsapp +
    if($type=="whatsapp" && $link)$value=str_replace("+",'',$value);

    if(empty($value))return "";
    
    
    if($cant==0)$cant=1;
    $value=explode("|", $value)[$cant-1];
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

function fw_whatsappfooter(){
    if(!fw_theme_mod('whats-widget'))return;
 
    echo '<a href="'.fw_company_data('whatsapp',true).'" target="_blank" class="btn-wapp">
            <i class="fab fa-whatsapp" style="color:white !important;"></i>
            <span class="t5">Estamos<br>On-Line!</span>
        </a>';
}




if( !function_exists('fw_logo') ) {
    add_shortcode('fw_logo', 'fw_logo');
    function fw_logo( $type="" ){
        
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
                $devolver = '<a class="logo "  href="'.esc_attr(home_url()).'">';
                $devolver .= fastway_getImage($logo_arg);
                $devolver .=  '</a>';
                return $devolver;
        }
    }
}

add_shortcode('fw_shortcode_stblock', 'fw_shortcode_stblock');
function fw_shortcode_stblock( $atts ) {
    $atts = shortcode_atts(array('slug' => '' ), $atts );
    return fw_StaticBlock::getSticBlockContent( $atts["slug"],true );
}


add_shortcode('fw_m_menu','fw_m_menu');
function fw_m_menu(){
    return '<button class="navbar-toggler fw-header-icon toggler btn-bars-mobile" type="button"><i class="'.fw_theme_mod('fw_icons_style').' fa-bars"></i></button>';
}
add_shortcode('fw_m_search_form','fw_m_search_form');
function fw_m_search_form(){
    return '<button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="'.fw_theme_mod('fw_icons_style').' fa-search"></i></button>';
}