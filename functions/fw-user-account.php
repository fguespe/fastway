<?php

if( !function_exists( 'fw_user_account' ) ) {
    add_shortcode('fw_account', 'fw_account');
    function fw_account(){
      if(fw_theme_mod("fw_user_text")=='username'){
        global $current_user;
        get_currentuserinfo();
        if(is_user_logged_in())return $current_user->display_name;
      }
      else return  fw_theme_mod("fw_user_text");
    }
  
    add_shortcode('fw_user_account', 'fw_user_account');
    function fw_user_account($atts = []){
          $atts = wp_parse_args($atts, array(
              'type'   => 0,
              'text' => '',
          ));
          
          $type=$atts['type'];
          $text=$atts['text'];
          $name=!empty($text)?$text:fw_account();
          $name="<span class='ingresar_text'>".$name."</span>";
          $iconstyle='fas';
          //0 only icon
          //1 only text
          //2 icon with text , also username
          $istyle='<i class="'.$iconstyle.' fa-user-circle "></i>';
          if($type==2){
            $name='';
          }else if($type==1){
            $istyle=$name;
          }else if($type==0){
            $istyle='<i class="'.$iconstyle.' fa-user-circle ">'.$name.'</i>';
          }

          $url='';
          if(is_plugin_active('woocommerce/woocommerce.php'))$url=wc_get_page_permalink('myaccount' );
return <<<HTML
<a class="fw-header-icon user" href="$url" role="button" data-target="" data-toggle="">
  $istyle 
</a>   
HTML;
        
      }

}
?>