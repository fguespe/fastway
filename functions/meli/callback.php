<?php


$path = preg_replace('/wp-content.*$/','',__DIR__);require_once($path."/wp-load.php");
header("HTTP/1.1 200 OK");

$notifications=file_get_contents("php://input");

if($notifications){
    $obj = json_decode($notifications, true);
    echo $obj['resource'];
    $order_id=explode("/",$obj['resource'])[2]; 

    //Init
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
    
    $order=$meli->get('/orders/'.$order_id, array('access_token' => $access_token));

    $items=$order['body']->order_items;
	
    foreach ($items as $key) {
      $variation_id=$key->item->variation_id;
      $item_id=$key->item->id;
      echo $item_id.'\n<br>';

      echo $variation_id.'\n<br>';
    }
      

}