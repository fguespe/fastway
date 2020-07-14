<?php
$path = preg_replace('/wp-content.*$/','',__DIR__);require_once($path."/wp-load.php");
header("HTTP/1.1 200 OK");


session_start();


if(!fw_theme_mod('fw_ml_on'))return;
$notifications=file_get_contents("php://input");
if(fw_theme_mod('fw_ml_stock_ml_a_web') && $notifications){
    $obj = json_decode($notifications, true);
    $order_id=explode("/",$obj['resource'])[2]; 

    if(!get_option('ml_array_orders_'.date("m")))update_option('ml_array_orders_'.date("m"),array());
    $orders_used=get_option('ml_array_orders_'.date("m"));
    
    if(!isset($orders_used[$order_id]))$orders_used[$order_id]=true;
    else if(isset($orders_used[$order_id])){
      error_log("Repetido: ".$order_id);
      return;
    }
    error_log('Se recibio de ml la order v1: '.$order_id);

    //Init
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
    $order=$meli->get('/orders/'.$order_id, array('access_token' => $access_token));
    $items=$order['body']->order_items;

    foreach ($items as $key) {
      $item=$key->item;
      $variation_id=$item->variation_id;
      $item_id=$item->id;
      $quantity=$key->quantity;

      $prod_id= wc_get_product_id_by_sku($variation_id);
      if(!$prod_id)continue;
      $variation = wc_get_product($prod_id);
      if(!$variation)continue;
      

      $variation->set_stock($variation->get_stock_quantity()-$quantity);
      if($quantity==0)$variation->set_stock_status('outofstock');
      $variation->save();   
      
      $log= "LOOPSYNC: ".$variation_id.' restado '.$quantity.' quedo en '.$variation->get_stock_quantity();
    
      error_log($log);
      update_option('ml_array_orders_'.date("m"),$orders_used);
    }
}
