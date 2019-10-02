<?php

//Esto va a al menu


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
    function fw_user_account(){

          $istyle=fw_theme_mod("fw_icons_style");
          $name=fw_account();

          if(!empty($name))$name="<span class='ingresar_text'>".$name."</span>";
          $url='';
          if(is_plugin_active('woocommerce/woocommerce.php'))$url=wc_get_page_permalink('myaccount' );
return <<<HTML
<a class="fw-header-icon user" href="$url" role="button" data-target="" data-toggle="">
  <span class="p1 fa-stack">
    <i class="p3 $istyle fa-user-circle fa-stack-1x xfa-inverse"></i>
  </span>
</a>   
HTML;
        
      }

}
?>