<?php
$path = preg_replace('/wp-content.*$/','',__DIR__);require_once($path."/wp-load.php");
header("HTTP/1.1 200 OK");
function custom_logs($message) { 
  if(is_array($message)) { 
      $message = json_encode($message); 
  } 
  $file = fopen(ABSPATH."ml_logs/".fw_theme_mod('fw_id_ml').".log","a"); 
  echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message); 
  fclose($file); 
}
if(!fw_theme_mod('fw_ml_on'))return;
$notifications=file_get_contents("php://input");
if(fw_theme_mod('fw_ml_stock_ml_a_web') && $notifications){

    try{

    
      $obj = json_decode($notifications, true);
      $order_id=explode("/",$obj['resource'])[2]; 
      custom_logs('Se recibio de ml la order: '.$order_id);
      $nombre_array='ml_array_orders_'.date("m");
      if(!get_option($nombre_array))update_option($nombre_array,array());

      /*
      $orders_used=get_option($nombre_array);
      if(!isset($orders_used[$order_id]))$orders_used[$order_id]=true;
      else if(isset($orders_used[$order_id])){
        http_response_code(200);
        custom_logs("Repetido: ".$order_id);
        return;
      }*/

      custom_logs('Se procesara la orden: '.$order_id);

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

      foreach ($items as $item_id => $item) {
        
        $variation_id=$item['variation_id'];
        $quantity=$item['quantity'];
        $price=$item['price'];
        
        $prod_id= wc_get_product_id_by_sku($variation_id);
        if(!$prod_id)continue;
        $variation = wc_get_product($prod_id);
        if(!$variation)continue;
        
        $quantity=$variation->get_stock_quantity()-$quantity;
        $variation->set_stock($quantity);
        $variation->set_price($price);

        if($quantity==0)$variation->set_stock_status('outofstock');

        $variation->save();   
        
        custom_logs($item_id.": ".$variation_id.' restado '.$quantity.' quedo en '.$variation->get_stock_quantity().' y price: '.$price);
      
        update_option($nombre_array,$orders_used);
      }
      http_response_code(200);
      custom_logs("Se devolvio 200");
      return;

    }catch (Exception $e) {
      custom_logs('Excepción capturada: ',  $e->getMessage(), "\n"); 
      http_response_code(400);
      custom_logs("Se devolvio 400");
      return;
    }
}
