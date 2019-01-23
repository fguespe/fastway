<?php
add_action( 'fastway_header_init', 'fw_get_template_part', 20 ,2);
add_action( 'fastway_header_init_mobile', 'fw_get_template_part', 20,2 );
add_action( 'fastway_product_loop_init', 'fw_get_template_part', 20 ,2);
add_action( 'fastway_product_loop_init_mobile', 'fw_get_template_part', 20,2 );
add_action( 'fastway_product_single_init', 'fw_get_template_part', 20 ,2);
if( !function_exists('fw_get_template_part') ){
    function fw_get_template_part( $style = 1 ,$var){
        global $TEMPLATE_DIR,$CHILDTEMPLATE_DIR;
        if( strlen( $style ) == 0  ) $style = 1;
        //if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/'.$var.'s/'.$var.'-'.$style.'.php') ) $style = 1;
        //if( file_exists($CHILDTEMPLATE_DIR . '/'.$var.'s/'.$var.'-'.$style.'.php') )error_log('existe en child');
        //if(preg_match('/\bsingle\b/',$var)) error_log($CHILDTEMPLATE_DIR . '/'.$var.'s/'.$var.'-'.$style.'.php');
        get_template_part('templates/'.$var.'s/'.$var, $style);
        
    }
}

$theme_headers=loadnoimgs("header");
$theme_header_tops=loadnoimgs("header-top");
$theme_header_bottoms=loadnoimgs("header-bottom");
$theme_headers_mobile=loadnoimgs("mobile-header");
$loop_templates=loadnoimgs("product-loop");
$loop_templates_mobile=loadnoimgs("mobile-product-loop",true);
$single_templates=loadnoimgs("single-product");


function loadnoimgs($phpprefix,$usesame=false){
    global $TEMPLATE_DIR,$CHILDTEMPLATE_DIR;
    $lavar=$phpprefix."s";
    $dires=array();
    array_push($dires,new DirectoryIterator($TEMPLATE_DIR .$lavar));
    $path=$CHILDTEMPLATE_DIR .$lavar;
    if(is_dir($path))array_push($dires,new DirectoryIterator($path));    
    
    $miarray=array();
    if($usesame)$miarray[0]= "Use same as desktop";
    foreach($dires as $dir){
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if(!strpos($fileinfo->getFilename(),".php"))continue;
                $nombresinphp=str_replace(".php", "", $fileinfo->getFilename());
                $nombre= str_replace($phpprefix."-", "",$nombresinphp );
                $i=explode("-", $nombre)[0];
                $j=explode("-", $nombre)[1];
                $alt=$i;
                if(isset($j))$alt.="-".$j;
                
                $miarray[$alt] =$nombresinphp;
            }
        }
    }
    
    

    return $miarray;
}

add_shortcode('fw_header_showcase','fw_header_showcase');
function fw_header_showcase(){
    $theme_headers=loadnoimgs("header");

    foreach($theme_headers as $jaja){
        echo '<div class="headershow" style="margin-top:30px;"><h4>'.$jaja.'</h4>';
        fw_get_template_part(str_replace('header-','',$jaja),'header');
        echo '</div>';
    }
}