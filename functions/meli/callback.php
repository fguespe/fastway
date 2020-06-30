<?php


$path = preg_replace('/wp-content.*$/','',__DIR__);require_once($path."/wp-load.php");
header("HTTP/1.1 200 OK");

$notifications=file_get_contents("php://input");
function wc_get_product_id_by_variation_sku($sku) {
  $args = array(
      'post_type'  => 'product_variation',
      'meta_query' => array(
          array(
              'key'   => '_sku',
              'value' => $sku,
          )
      )
  );
  // Get the posts for the sku
  $posts = get_posts( $args);
  if ($posts) {
      return $posts[0]->post_parent;
  } else {
      return false;
  }
}

if($notifications){
    $obj = json_decode($notifications, true);
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
      $item=$key->item;
      $variation_id=$item->variation_id;
      $item_id=$item->id;
      $quantity=$key->quantity;
      echo $variation_id;
      $var= wc_get_product_id_by_variation_sku($variation_id);
      print_r($var,true);
    }
      

}