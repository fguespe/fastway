<?php
add_action( 'fastway_header_init', 'fw_get_template_part', 20 ,2);
add_action( 'fastway_header_init_mobile', 'fw_get_template_part', 20,2 );
add_action( 'fastway_product_loop_init', 'fw_get_template_part', 20 ,2);
add_action( 'fastway_product_loop_init_mobile', 'fw_get_template_part', 20,2 );
add_action( 'fastway_product_single_init', 'fw_get_template_part', 20 ,2);
if( !function_exists('fw_get_template_part') ){
    function fw_get_template_part( $style = 1 ,$var){
        global $TEMPLATE_DIR;
        if( strlen( $style ) == 0 || !file_exists($TEMPLATE_DIR . '/'.$var.'s/'.$var.'-'.$style.'.php') ) $style = 1;
        get_template_part('plugin/templates/'.$var.'s/'.$var, $style);
    }
}

$theme_headers=loadimgs("header");
$theme_headers_mobile=loadimgs("mobile-header");
$loop_templates=loadimgs("product-loop");
$loop_templates_mobile=loadimgs("mobile-product-loop",true);
$single_templates=loadimgs("single-product");



function loadimgs($phpprefix){
    global $TEMPLATE_DIR,$TEMPLATE_URI;
    $lavar=$phpprefix."s";
    $imgurl=$lavar."/images/".$phpprefix."-";

    $dir = new DirectoryIterator($TEMPLATE_DIR .$lavar );
    
    $miarray=array();
    foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot()) {
            if(!strpos($fileinfo->getFilename(),".php"))continue;
            $nombre= str_replace($phpprefix."-", "", str_replace(".php", "", $fileinfo->getFilename()));
            $i=explode("-", $nombre)[0];
            $j=explode("-", $nombre)[1];
            $imgg=$TEMPLATE_URI . $imgurl.$i;
            $alt=$i;
            if(isset($j)){
                $imgg.="-".$j;
                $alt.="-".$j;
            }
            $imgg.=".png";

            
            $miarray[$alt] = array(
                'alt' => $alt,
                'img' => $imgg
            );  
        }
    }

    return $miarray;
}
function loadnoimgs($phpprefix,$usesame=false){
    global $TEMPLATE_DIR,$TEMPLATE_URI;
    $lavar=$phpprefix."s";
    $dir = new DirectoryIterator($TEMPLATE_DIR .$lavar);
    $miarray=array();
    if($usesame)$miarray[0]= "Use same as desktop";
    
    foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot()) {
            if(!strpos($fileinfo->getFilename(),".php"))continue;
            $nombre= str_replace($phpprefix."-", "", str_replace(".php", "", $fileinfo->getFilename()));
            $i=explode("-", $nombre)[0];
            $j=explode("-", $nombre)[1];
            $alt=$i;
            if(isset($j))$alt.="-".$j;
            
            $miarray[$alt] =$phpprefix."-".$alt;
        }
    }
    

    return $miarray;
}
/*
$loop_templates_mobile = array();
$loop_templates_mobile =  array_merge($loop_templates_mobile,array( 0 => "Use same as desktop"));
for( $i=1; $i<=1; $i++ )$loop_templates_mobile=array_merge($loop_templates_mobile,array( $i => "Product Loop Template ".$i));

$single_templates = array();
$single_templates =  array_merge($single_templates,array( 0 => "Select en option"));
for( $i=1; $i<=4; $i++ )$single_templates=array_merge($single_templates,array( $i => "Single Product Template ".$i));
*/