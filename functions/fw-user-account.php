<?php

if( !function_exists( 'fw_userAccount' ) ) {
    
    add_shortcode('fw_user_account', 'fw_userAccount');

    function fw_userAccount(){
          $name="";
          $current_user = wp_get_current_user();
          if ( 0 != $current_user->ID && fw_theme_mod("fw_user_template")=="iconwu") {
              $name=$current_user->user_login;
          }else if(fw_theme_mod("fw_user_template")=="iconwt"){
              $name=fw_theme_mod("fw_user_text");
          }

          if(!empty($name))$name="<span class='ingresar_text'>".$name."</span>";
          $url=get_permalink( wc_get_page_id( 'myaccount' ) );
return <<<HTML
<a class="fw-header-icon user" href="$url" role="button" data-target="" data-toggle="">
  <span class="p1 fa-stack">
    <i class="p3  fa fa-user fa-stack-1x xfa-inverse"></i>
  </span>
</a>   
HTML;
        
      }

}
?>