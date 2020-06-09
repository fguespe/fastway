<?php


//add_action('woocommerce_checkout_order_processed', 'fw_ml_update_stock', 10, 1);
//add_action('woocommerce_thankyou', 'fw_ml_update_stock', 10, 1);
function fw_ml_update_stock( $order_id ) {
    if ( ! $order_id )return;
    if(!fw_theme_mod('fw_ml_on'))return;
    $usuario=getconfig(fw_theme_mod('fw_id_ml'));

    $iduser=trim($usuario['iduser']);
    $access_token= trim($usuario['access_token']);
    $refresh_token = trim($usuario['refresh_token']);
    $appId=fw_theme_mod('fw_ml_appid');
    $secretKey=fw_theme_mod('fw_ml_appsecret');

    $meli = new Meli($appId, $secretKey,$access_token,$refresh_token);
    $nuevos=$meli->refreshAccessToken();
    $access_token=$nuevos['body']->access_token;
    $refresh_token=$nuevos['body']->refresh_token;
    if(!empty($refresh_token) && !empty($access_token))saveconfig($iduser,$access_token,$refresh_token);
    

    // Getting an instance of the order object
    $order = wc_get_order( $order_id );
    foreach ( $order->get_items() as $item_id => $item ) {
        
        if( $item['variation_id'] > 0 )$product_id = $item['variation_id']; // variable product
        else  $product_id = $item['product_id']; // simple product

        $product = wc_get_product( $product_id );
        $sku=$product->get_sku(); 
        $stock=$product->get_stock_quantity();
        if(strpos( $sku, 'MLA' ) !== false){

          $prod=$meli->get('/items/'.$sku, array('access_token' => $access_token));
          $vars=$prod['body']->variations;
          if(count($vars)>0){
            error_log('es un prod variable');
            foreach($vars as $var){
              $item = array(
                "variations" => array(
                  array(
                    "id"=>$var->id,
                    "available_quantity"=>$stock
                  )
                )
              );
            }
          }else{
            error_log('es un prod simple');
            $item = array(
              "available_quantity"=>$stock
            );
          }
          $result=$meli->put('/items/'.$sku, $item, array('access_token' => $access_token));
          error_log($result['httpCode']);
        }

    }
}
