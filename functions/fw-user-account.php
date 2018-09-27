<?php

if( !function_exists( 'fw_userAccount' ) ) {
    
    add_shortcode('fw_user_account', 'fw_userAccount');

    function fw_userAccount(){
        $url=get_permalink( wc_get_page_id( 'myaccount' ) );
        return <<<HTML
          <a id="" class="" href="$url" role="button">
                <span class="fa fa-user u-btn--icon__inner"></span>
          </a>
HTML;
        
      }

}
?>