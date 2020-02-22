<?php

add_shortcode("fw_info_modal","fw_info_modal",10,2);
function fw_info_modal( $atts ) {
    $rand=generateRandomString();
        
    $atts = shortcode_atts(
        array(
            'sblock' => '',
            'label' => '',
            'class' =>  '',
            'color' =>  '',
            'size' =>  '',
            'content' => '',
        ), $atts, 'fw_info_modal' );
    $first='<a target="_blank" data-toggle="modal" data-target="#'.$rand.'" style="color:'.$atts['color'].';font-size:'.$atts['size'].';" class="fancybox '.$atts['class'].'">'.$atts['label'].'</a>';
    //$first='<button target="_blank" data-toggle="modal" data-target="#'.$rand.'" class="fancybox '.$atts['class'].'">'.$atts['label'].'</button>';
    $first.= ( fw_modal_block($rand,$atts['sblock']));
    return $first;
}





function quicklinks(){
    $quick =trim(fw_theme_mod("fw_quickmenu_links"));
    if(empty($quick))$quick="fb,youtube,whatsapp,ig,email,phone,address";
    $arra=array(
        "fb"=>array("fab fa-facebook"), 
        "youtube"=>array("fab fa-youtube"), 
        "whatsapp"=>array("fab fa-whatsapp"), 
        "ig"=>array("fab fa-instagram"), 
        "linkedin"=>array("fab fa-linkedin"), 
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
    if(empty($value))return false;
    preg_match('#\((.*?)\)#', $value, $match);
    $link_en_parentesis= $match[1];
    if(!empty($link_en_parentesis)  && !$link){//Si hay link en parentesis
        $value=$pre.str_replace("(".$link_en_parentesis.")","",$value);
    }else if(!empty($link_en_parentesis) && $link){
        $value=$pre.$link_en_parentesis;
    }else if(empty($link_en_parentesis) && $link){
        $value=$pre.$value;
    }

    /*prevent dobles*/
    if( strpos( $value, 'tel:tel:' ) !== false) {
        $value=str_replace('tel:tel:','tel:',$value);
    }else if( strpos( $value, 'mailto:mailto:' ) !== false) {
        $value=str_replace('mailto:mailto:','mailto:',$value);
    }
    
    return $value;
}

function fw_whatsappfooter(){
    $whats=fw_company_data('whatsapp',true);
    if(empty($whats))return;

    if(fw_theme_mod('whats-button')=='simple'){
        
        $label=fw_theme_mod('fw_whats_btn');
        $label=str_replace("[br]","<br>",$label);
        echo '<a href="'.$whats.'" target="_blank" class="btn-wapp">
            <i class="fab fa-whatsapp" style="color:white !important;"></i>
            <span class="t5">'.$label.'</span>
        </a>';
    }else if(fw_theme_mod('whats-button')=='random'){
        if(!empty(fw_company_data('whatsapp',true,2))){
            //Si tiene 2 whatsapp
            $whats=rand(1,2)==1?fw_company_data('whatsapp',true,2):fw_company_data('whatsapp',true);
        } 
        $label=fw_theme_mod('fw_whats_btn');
        $label=str_replace("[br]","<br>",$label);
        echo '<a href="'.$whats.'" target="_blank" class="btn-wapp">
            <i class="fab fa-whatsapp" style="color:white !important;"></i>
            <span class="t5">'.$label.'</span>
        </a>';
    }else if(fw_theme_mod('whats-button')=='multi'){
        $label=fw_company_data('whatsapp',false);
        echo '<a href="'.$whats.'" target="_blank" class="btn-wapp multi first">
            <i class="fab fa-whatsapp" style="color:white !important;"></i>
            <span class="t5">'.$label.'</span>
        </a>';
        $whats=fw_company_data('whatsapp',true,2);
        $label=fw_company_data('whatsapp',false,2);
        echo '<a href="'.$whats.'" target="_blank" class="btn-wapp multi second" style="right:20%;">
        <i class="fab fa-whatsapp" style="color:white !important;"></i>
        <span class="t5">'.$label.'</span>
        </a>';
    }
    
}



if( !function_exists('fw_m_logo') ) {
    add_shortcode('fw_m_logo', 'fw_m_logo');
    function fw_m_logo( $type="" ){
        
        switch( $type ) {
            case 'sticky':
                break;
            default:
                $title = !empty(fw_theme_mod('logo-text'))? esc_attr(fw_theme_mod('logo-text')): get_bloginfo('name');
                $logo_arg = array(
                    'title' => esc_attr($title),
                    'alt'   => esc_attr($title)
                );

                if( !empty( fw_theme_mod('fw_mobile_logo') ) && strlen(trim(fw_theme_mod('fw_mobile_logo'))) > 0 ){
                    $logo_arg['src'] =  fw_theme_mod('fw_mobile_logo') ;
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

if( !function_exists('fw_compra_protegida') ) {
    add_shortcode('fw_compra_protegida', 'fw_compra_protegida');
    function fw_compra_protegida( $type="" ){
        $devolver='';
        if(get_option('testing_new_checkout')){
            $devolver= '
            <li class="text-right safe-box"> 
                <img width="36" src="/wp-content/themes/fastway/assets/img/safe-shopping.svg" alt="Compra Segura">
                <p><strong>Compra Segura</strong>
                100% Protegido</p>
            </li>';
        }
       
        return $devolver;
    }
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
function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}
add_shortcode('fw_whats','fw_whats');
function fw_whats( $atts ) {
    $atts = shortcode_atts(array('num' => '' ), $atts );

    $num=$atts['num'];
    $num=str_replace("+", "", $num);
    $num=str_replace(" ", "", $num);
    if(substr( $num, 0, 2 ) === "15")$num=str_replace_first("15","11",$num);

    $num='<a href="https://api.whatsapp.com/send?text=Hola!, vimos tu consulta en nuestra web&phone=549'.$num.'">Hablar al whatsapp: '.$num.'</a>';
    return $num;
}

add_shortcode('fw_m_menu','fw_m_menu');
function fw_m_menu(){
    return '<button class="navbar-toggler fw-header-icon toggler btn-bars-mobile" type="button"><i class="'.fw_theme_mod('fw_icons_style').' fa-bars"></i></button>';
}
add_shortcode('fw_m_search_form','fw_m_search_form');
function fw_m_search_form(){
    return '<button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="'.fw_theme_mod('fw_icons_style').' fa-search"></i></button>';
}
add_shortcode('fw_m_search_box','fw_m_search_box');
function fw_m_search_box(){
    return '<button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="'.fw_theme_mod('fw_icons_style').' fa-search"></i></button>';
}