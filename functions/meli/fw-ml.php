<?php

if(fw_theme_mod('fw_ml_stock_web_a_ml')){
  //esata corre antes!! add_action('woocommerce_checkout_order_processed', 'fw_ml_update_stock', 10, 1);
  add_action('woocommerce_thankyou', 'fw_ml_update_stock', 10, 1);
}
slm_test_prod('MLA803117761');
  
function slm_test_prod($sku){
    error_log("fguespe".$sku);
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
    

    $prod_id= wc_get_product_id_by_sku($sku);
    if(!$prod_id)return;
    $product = wc_get_product($prod_id);
    if(!$product)return;
    error_log("fguespe".$sku);

    
    $stock=$product->get_stock_quantity();
    if($stock<0)$stock=0;
    error_log("fguespe".$stock);
    $prod=$meli->get('/items/'.$sku, array('access_token' => $access_token));
    $vars=$prod['body']->variations;
    if(count($vars)>0){
      $note=$sku.' - es un prod variable' ;
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
      $note=$sku.' - es un prod simple' ;

      $item = array(
        "available_quantity"=>$stock
      );
    }
    $result=$meli->put('/items/'.$sku, $item, array('access_token' => $access_token));

    error_log(print_r($result,true));
}
function fw_ml_update_stock( $order_id ) {
    if ( ! $order_id )return;
    if(!empty(get_post_meta( $order_id, '_ml_done', true￼ )) )return;

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
    
    $order = wc_get_order( $order_id );
    
    foreach ( $order->get_items() as $item_id => $item ) {
        
        if( $item['variation_id'] > 0 )$product_id = $item['variation_id']; // variable product
        else  $product_id = $item['product_id']; // simple product

        $product = wc_get_product( $product_id );
        $sku=$product->get_sku(); 
        if(strpos( $sku, 'MLA' ) !== false){
          $stock=$product->get_stock_quantity();
          if($stock<0)$stock=0;
          $prod=$meli->get('/items/'.$sku, array('access_token' => $access_token));
          $vars=$prod['body']->variations;
          if(count($vars)>0){
            $note=$sku.' - es un prod variable' ;
            $order->add_order_note( $note);
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
            $note=$sku.' - es un prod simple' ;
            $order->add_order_note( $note);

            $item = array(
              "available_quantity"=>$stock
            );
          }
          $result=$meli->put('/items/'.$sku, $item, array('access_token' => $access_token));
          
          if($result['httpCode']==200)$note=$result['httpCode'].": Se actualizo el prod/var con id:".$sku.' a stock '.$stock;
          else $note=$result['httpCode'].": Hubo un error al actualizar id:".$sku.' a stock '.$stock;
          error_log($note);
          $order->add_order_note( $note );

          ## HERE you Create/update your custom post meta data to avoid repetition
          update_post_meta( $order_id, '_ml_done', 'yes' );
          
          
        }

    }
}
