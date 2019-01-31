<?php

function fw_header_builder($atts = [], $content = null){
  $atts = shortcode_atts(array('type' => 'middle' ), $atts );
  $header_container   = fw_theme_mod('header-width');
  $header_class=" fw_header ".$atts['type']." desktop d-none d-md-block ";
  if(fw_theme_mod("transparent-header"))$header_class.=" fw_transparent_header ";
  $volver='<div class="'.esc_attr( $header_class ).'">';
  $volver.='<div class="'.esc_attr( $header_container).'">';
  $volver.='<div class=" d-flex row align-items-center codes">';
  $volver .= do_shortcode(stripslashes(htmlspecialchars_decode($content)));
  $volver .='</div></div></div>';
  error_log($volver);
  return $volver;
}
add_shortcode('fw_header', 'fw_header_builder');

function fw_header_html(){
  return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('header_code'))));
}
function fw_header_html_mobile(){
  return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('header_mobile_code'))));
}
echo fw_header_html();


?>


<style>
/*
centrar menu
.fw_header.bottom.desktop #fw-menu .navbar-nav{
		margin:0 auto;
}
centrar logo o cualquier otro
.logo{
margin:0 auto !important;
}


#fw-menu{
		width:100% !important;
}
.fw_header.bottom.desktop #fw-menu .navbar-nav{
  width:100% !important;
  justify-content:space-around !important;
}

*/
</style>