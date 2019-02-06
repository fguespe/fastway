<?php


if( !function_exists( 'fw_user_account' ) ) {
    
    add_shortcode('fw_user_account', 'fw_user_account');
    function fw_user_account(){
          $name="";

          $istyle=fw_theme_mod("fw_icons_style");
          error_log($istyle);
          $current_user = wp_get_current_user();
          if ( 0 != $current_user->ID && fw_theme_mod("fw_user_template")=="iconwu") {
              $name=$current_user->user_login;
          }else if(fw_theme_mod("fw_user_template")=="iconwt"){
              $name=fw_theme_mod("fw_user_text");
          }

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