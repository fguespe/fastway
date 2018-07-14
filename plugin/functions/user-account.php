<?php

if( !function_exists( 'fw_userAccount' ) ) {
    
    add_shortcode('fw_user_account', 'fw_userAccount');

    function fw_userAccount(){
        $url=get_permalink( wc_get_page_id( 'myaccount' ) );
        return <<<HTML
          <li class="list-inline-item position-relative">
                    <a id="" class="btn btn-xs u-btn--icon u-btn-text-secondary" href="$url" role="button">
                      <span class="fa fa-user u-btn--icon__inner"></span>
                    </a>
        </li>
HTML;
        
      }

}
?>