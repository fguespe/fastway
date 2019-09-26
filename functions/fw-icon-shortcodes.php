<?php 
add_shortcode('fw_social_icons', 'fw_social_icons', 10, 2);
function fw_social_icons( $atts ) {
    //Este pone iconos
    $atts = shortcode_atts(
        array(
            'type' => '',
            'icon_align' => '',
            'icon_size' =>  12,
            'icon_color' =>  '',
            'el_class' =>  '',
            'el_id' =>  '',
            //Depreceated
                
        ), $atts );

    $type=$atts['type'];
    $icons_style=fw_theme_mod("fw_icons_style");
    $value="";
    $cant=1;
    $num=0;
    $char=substr($type, -1);
    if(intval($char)){
        $type=str_replace($char,"",$type);
        $cant=intval($char);
    }

    $iconclass=" fw_icon fw_icon_bs_short ".$atts['el_class'].' ';

    $first.='<div id="'.$atts['el_id'].'" class=" '.$iconclass.'" style="text-align:'.$atts['icon_align'].'";>';
    foreach (explode(",", $atts['type']) as $icon) {
        $type=$icon;
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
        }else if($type==="linkedin"){
            $icon="fab fa-linkedin";
            $link=fw_company_data($type,true,$cant);
            $value="Ir al Linkedin";
            $icon_color="#2673B0";
        }else if($type==="youtube"){
            $icon="fab fa-youtube-square";
            $link=fw_company_data($type,true,$cant);
            $value="Ir a Youtube";
            $icon_color="#FF0400";
        }else if($type==="address"){
            $icon=$icons_style." fa-map-marker-alt";
            $link=fw_company_data("googlemaps",true,$cant);
            $value=fw_company_data("address",false,$cant);
            $link=fw_company_data("address",true,$cant);
            if(empty($link))fw_company_data("googlemaps",true,$cant);
        }
        //$link=fw_company_data($icon);
        if($atts['icon_color'])$icon_color=$atts['icon_color'];
        $first.='<a target="_blank" class="fw_icon_link" style="line-height:'.($atts['icon_size']+20).'px ;margin-right:5px !important;" href="'.$link.'">
        <i class="'.$icon.'" style="color:'.$icon_color.'!important;font-size:'.$atts['icon_size'].'px !important;">
        </i>
        </a>';
    }
    $first.="</div>";
    
    
    return $first;
}


add_shortcode('fw_only_icon', 'fw_only_icon', 10, 2);
function fw_only_icon( $atts ) {
    //Este pone iconos
    $atts = shortcode_atts(
        array(
            'type' => '',
            'icon_align' => 'center',
            'icon_size' =>  '',
            'icon_color' =>  'var(--main)',
            'el_class' =>  '',
            'el_id' =>  '',
            //Depreceated
                
    ), $atts );

    $type=$atts['type'];
    $icons_style=fw_theme_mod("fw_icons_style");

    //Puso directo las clases
    if( strpos( $type, 'fa-' ) === false) {
        $type='fa-'.$type;
    }

    $iconclass=" fw_icon ".$atts['el_class'].' ';
    $first.='<div id="'.$atts['el_id'].'" class=" '.$iconclass.'" style="text-align:'.$atts['icon_align'].'";>';
    $first.='<i class="'.$atts['type'].'" style="color:'.$atts['icon_color'].';font-size:'.$atts['icon_size'].'px !important;"></i>';
    $first.="</div>";
    
    
    return $first;
}

add_shortcode("fwi","fw_data",10,2);
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
            'text_align' => '',
            'stext_color' => '',
            'stext' =>  '',
            'sblock' =>  '',
            'iframe' =>  '',
            'modal' =>  '',
            'format' =>  '',
            'only_text' =>  '',
            
            'el_class' =>  '',
            'el_id' =>  '',
            //Depreceated
            'isli' =>  '',
            'isli_i' =>  '',
            'iconsnext' =>  '',
                
        ), $atts );

    $atts['size']=16;$$atts['weight']='normal';
    $type=$atts['type'];
    $icon=$type;
    $icons_style=fw_theme_mod("fw_icons_style");
    $value="";
    $cant=1;
    $num=0;
    $char=substr($type, -1);
    if(intval($char)){
        $type=str_replace($char,"",$type);
        $atts['cant']=$char;
    }
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
    }else if($type==="linkedin"){
        $icon="fab fa-linkedin";
        $link=fw_company_data($type,true,$cant);
        $value="Ir al Linkedin";
        $icon_color="#2673B0";
    }else if($type==="youtube"){
        $icon="fab fa-youtube-square";
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
        if( strpos( $type, 'fa-' ) === false) {
            $type='fa-'.$type;
        }
        $icon=$icons_style.' '.$type;
        $type='custom';
       
       
    }
    if(!empty($atts['icon_color']))$icon_color=$atts['icon_color'];

    if($atts['text'] || empty($value))$value=$atts['text'];
    if($atts['link'])$link=$atts['link'];
    if($atts['text_align'])$text_align=$atts['text_align'];
    if($atts['size'])$font_size=$atts['size'];
    if($atts['weight'])$font_weight=$atts['weight'];
    $only_text=false;
    if(($atts["only_text"]))$only_text=true;
    //format
    if($atts["format"])$format=$atts["format"];
    else if($atts["isli"])$format="isli";
    else if($atts["isli_i"])$format="isli_i";
    else if($atts["iconsnext"])$format="iconsnext";

    $iconclass=" fw_icon fw_icon_bs_short ".$atts['el_class'].' ';

    if($format=="isli" || $format=="isli_i"){
        $first= '<li class="'.$iconclass.'  d-flex '.$format.'" style="text-align:'.$text_align.';"> ';
        if(!$atts["only_text"])$first.='<span class="icon"><i class="'.$icon.'"></i></span>';
        $big="big";
        $small="small";
        $valueb=$value;
        $values=$atts['stext'];
        if($format=="isli_i"){$big="small";$small="big";$valueb=$values;$values=$value;}
        $first.=' <span class="text"> <'.$big.' style="color:'.$atts['text_color'].' ;">'.$valueb.'</'.$big.'> <'.$small.' style="color:'.$atts['text_color'].' ;">'.$values.'</'.$small.'> </span></li>';
    }else if($format=="iconbox"){
        $first= '<li class=" '.$iconclass.' '.$format.'" style="text-align:'.$text_align.';"> ';
        if(!$atts["only_text"])$first.='<span class="icon"><i class="'.$icon.'"></i></span>';
        $first.=' <span class="text"> <big style="color:'.$atts['text_color'].';text-align:'.$text_align.';">'.$value.'</big> <small style="color:'.$atts['text_color'].' ;">'.$atts['stext'].'</small> </span></li>';
    }else if(!empty($atts['sblock'])){
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$atts['sblock'].'" class="fancybox">'.$first;
        $first.= "</a>".fw_modal_block($atts['sblock'],$atts['sblock']);
    }else if($format=='iconsnext'){//deprecetead
        
        $first.='<div id="'.$atts['el_id'].'" class=" '.$iconclass.'">';
        foreach (explode(",", $atts['type']) as $icon) {
            if($icon==="fb")$icon="fab fa-facebook";
            else if($icon==="ig")$icon="fab fa-instagram";
            else if($icon==="youtube")$icon="fab fa-youtube-square";
            else if($icon==="twitter")$icon="fab fa-twitter";
            else if($icon==="whatsapp")$icon="fab fa-whatsapp";
            $link=fw_company_data($icon);
            
            $first.='<a target="_blank" class="fw_quicklink" style="margin-right:5px ;font-size:'.$font_size.'px ;font-weight:'.$font_weight.' ;line-height:'.($font_size+20).'px ;" href="'.$link.'"><i class="'.$icon.'" style="color:'.$icon_color.' !important;"></i>';
            $first.='</a>';
        }
        $first.="</div>";
    
    }else{
        $first='<a target="_blank" class="fw_icon_link '.$iconclass.' '.$type.'" style="font-size:'.$font_size.'px ;font-weight:'.$font_weight.' ;line-height:'.($font_size+20).'px ;" href="'.$link.'">';
        if(!$atts["only_text"])$first.='<i class="'.$icon.'" style="color:'.$icon_color.' ;"></i>';
        $first.='  <span style="color:'.$atts['text_color'].' ;font-size:'.$font_size.'px ;font-weight:'.$font_weight.' ;">'.$value.'</span>';
        $first.='</a>';
    }

    if(!empty($atts['iframe'] )){
        $rand=generateRandomString();
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$rand.'" class="fw_icon_link fancybox">'.$first;
        $first.= "</a>".fw_modal_block($rand,$atts['iframe'],true);
    }
    
    if(!empty($atts['modal'] )){
        $first='<a target="_blank" data-toggle="modal" data-target="#'.$atts['modal'].'" class="fw_icon_link fancybox">'.$first;
        $first.= "</a>";
    }
    
    if(!empty($link) && ($format=="isli_i" || $format=="isli" || $format == "iconbox")){

        $first='<a target="_blank" class="fw_icon_link" href="'.$link.'">'.$first."</a>";
    }
    
    return $first;
}