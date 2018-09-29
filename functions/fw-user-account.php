<?php

if( !function_exists( 'fw_userAccount' ) ) {
    
    add_shortcode('fw_user_account', 'fw_userAccount');

    function fw_userAccount(){
    	$name=__('Ingresar','fastway');
    	$current_user = wp_get_current_user();
    	if ( 0 != $current_user->ID ) {
	       //$name=$current_user->user_login;
	       $name="MI CUENTA";
	    }
        $url=get_permalink( wc_get_page_id( 'myaccount' ) );
        return <<<HTML
          <a href="$url"><i class="fa fa-user"></i><span class="ingresar"> $name</span></a>
HTML;
        
      }

}
?>