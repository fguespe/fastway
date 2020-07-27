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
                $roles = ( array ) $the_user->roles;
                $role=$roles[0];
                if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest'  || $role == '' )$role='minorista';
                echo $role;
            }
      }
  }
}