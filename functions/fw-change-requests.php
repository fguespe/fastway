<?php

if(fw_theme_mod('fw_client_admin_columnarol')){
  add_filter('manage_edit-shop_order_columns', 'add_column_heading', 20, 1);
  function add_column_heading($array) {
      $res = array_slice($array, 0, 2, true) +
              array("customer_role" => "Rol") +
              array_slice($array, 2, count($array) - 1, true);

      return $res;
  }
  add_action('manage_posts_custom_column', 'add_column_data', 20, 2);
  function add_column_data($column_key, $order_id) {
      if ('customer_role' != $column_key)return;
      $customer = new WC_Order( $order_id );
      if($customer->user_id != ''){
              $user = new WP_User( $customer->user_id );
              if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
                $roles = ( array ) $user->roles;
                $role=$roles[0];
                if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest'  || $role == '' )$role='minorista';
                echo $role;
            }
      }
  }
}


if(fw_theme_mod('fw_crear_cuenta_a_sendy')){
  function fw_crear_cuenta_a_sendy( $user_id ) {
    $user    = get_userdata( $user_id );
    $email   = $user->user_email;

    $post_url = 'http://app.albertmail.com.ar/subscribe';
    $body = array('email' => $email,'list' => fw_theme_mod('fw_crear_cuenta_a_sendy'));
    $request = new WP_Http();
    $response = $request->post($post_url, array('body' => $body));
    
  }
  add_action('user_register', 'fw_crear_cuenta_a_sendy');
}

/*
add_action('gform_after_submission', 'post_to_third_party', 10, 2);
function post_to_third_party($entry, $form) {
    error_log(print_r($form,true));
    $post_url = 'http://app.albertmail.com.ar/subscribe';
    $body = array(
        'email' => $entry['4'],
        'list' => 'mDYPUij8vdt4gLZzsrv7aw'
        );
    $request = new WP_Http();
    $response = $request->post($post_url, array('body' => $body));
}
*/
