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
    $sendy_list=fw_theme_mod('fw_crear_cuenta_a_sendy');

    sendtoSendy($sendy_list,$email);
  }
  add_action('user_register', 'fw_crear_cuenta_a_sendy');
}

function sendtoSendy($sendy_list,$email){
  //error_log('sendy_list:'.$sendy_list);
  //error_log('email:'.$email);
	$your_installation_url = 'http://app.albertmail.com.ar';
	$api_key = 'JUu2WMpouY4wjSFvc2SF'; //Can be retrieved from your Sendy's main settings
	//Subscribe
	$postdata = http_build_query(
	    array(
        'email' => $email,
        'list' => $sendy_list,
        'api_key' => $api_key,
        'boolean' => 'true'
	    )
	);
	$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
	$context  = stream_context_create($opts);
	$result = file_get_contents($your_installation_url.'/subscribe', false, $context);
}



if(fw_theme_mod('fw_forms_a_sendy')){
  add_action('gform_after_submission', 'post_to_third_party', 10, 2);
  function post_to_third_party($entry, $form) {
    $integraciones=explode("|",trim(fw_theme_mod('fw_forms_a_sendy')));
    foreach ($integraciones as $forma){
      $formm=explode(",",$forma);
      $form_id=$formm[0];
      $field_number=$formm[1];
      $sendy_list=$formm[2];
      $email=$entry[$field_number];

      if(fw_theme_mod('fw_crear_cuenta_a_sendy') && email_exists($email))continue;
      else if($form_id==$entry['form_id'])sendtoSendy($sendy_list,$email);
    }
  }
}



if(fw_theme_mod('fw_gift_fields')){
  add_action( 'woocommerce_admin_order_data_after_shipping_address', 'fw_gift_fields_admin', 10, 1 );
  add_action( 'woocommerce_email_order_meta', 'fw_gift_fields_admin', 10, 3 );
}

function fw_gift_fields_admin($order){
  if( $order->get_billing_address_1() != $order->get_shipping_address_1() ) {
    $r5=get_post_meta( $order->get_id(), '_shipping_mensaje', true );
    echo '<div class="regalo" style="border:1px solid pink;padding:10px;margin-bottom:10px;">
    <p><strong style="color:pink !important;">PARA REGALO</strong></p>
    <p><strong>Mensaje</strong> ' . $r5 . '</p>
    </div>';
  } 
}
?>