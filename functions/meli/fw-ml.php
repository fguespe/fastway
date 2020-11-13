<?php

function ml_log_register_plugin_page() {
	add_options_page('ML Log', 'ML Log', 'manage_options', 'mllog', 'mllog_options_page');
}
add_action('admin_menu', 'ml_log_register_plugin_page');
	
function mllog_options_page(){
  $handle = fopen(ABSPATH."ml_logs/".fw_theme_mod('fw_id_ml').".log","r"); 
  if ($handle) {
      $logs=[];
      while (($line = fgets($handle)) !== false){
        if(empty($line))continue;
        $line='<span class="fecha">'.$line;
        $line=str_replace('::','</span>',$line);
        $line=$line.'<br>';
        $logs[]= $line;
      }
      fclose($handle);
      $logs=array_reverse($logs);
      foreach($logs as $log){
        $log_total.= nl2br($log);
      }
  } ?>
  <h2>Log mercadolibre</h2>
  <pre class="log_fw" ><?=$log_total?></pre>
  <style>
  .log_fw{
    overflow-y: scroll; 
    height:400px !important;
    width:95% ;
    height:100%;
    min-height:500px;
    margin-top:10px;
    background:#1F1E1E;
    color:white;
    white-space: pre-line;
  }
  .log_fw .fecha{
    color:green;
  }
</style>
<?php 
}

if(fw_theme_mod('fw_ml_stock_web_a_ml')){
  //esata corre antes!! add_action('woocommerce_checkout_order_processed', 'fw_ml_update_stock', 10, 1);
 add_action('woocommerce_thankyou', 'fw_ml_update_stock', 10, 1);
}
function fw_ml_update_stock( $order_id ) {
    if ( ! $order_id )return;
    
    if(get_post_meta( $order_id, '_ml_done' )=='yes' )return;
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
        $parent_sku=null;
        if( $item['variation_id'] > 0 ){
          $product_id = wp_get_post_parent_id($item['variation_id']);
          $product = wc_get_product($product_id);
          $parent_sku=$product->get_sku(); 
          $product_id = $item['variation_id']; // simple product
        }else {
          $product_id = $item['product_id']; // simple product
        } 


        $product = wc_get_product($product_id);
        $sku=$parent_sku?$parent_sku:$product->get_sku(); 
        
        $note="Nuevo Proceso: ".$product_id."-".$sku."\n";
        if($product_id == $item['product_id'])$note.="Es un prod simple\n";
        else if($product_id == $item['variation_id'])$note.="Es una variacion\n";
        $order->add_order_note($note);


        if(strpos( $sku, 'MLA' ) !== false){
          $stock=$product->get_stock_quantity();
          if($stock<0)$stock=0;
          error_log('stock:'.$stock);
          $prod=$meli->get('/items/'.$sku, array('access_token' => $access_token));
          $vars=$prod['body']->variations;
          $permalink=$prod['body']->permalink;
          if(count($vars)>0){
            foreach($vars as $var){
              if($var->id==$item['variation_id']){
                $note=$sku.' - es un prod variable' ;
                $order->add_order_note($note);
                $item = array(
                  "variations" => array(
                    array(
                      "id"=>$var->id,
                      "available_quantity"=>$stock
                    )
                  )
                );
              }
            }
          }else{
            $note=$sku.' - es un prod simple' ;
            $order->add_order_note( $note);
            //error_log($note);

            $item = array("available_quantity"=>$stock);
          }
          $result=$meli->put('/items/'.$sku, $item, array('access_token' => $access_token));
          
          if($result['httpCode']==200)$note=$result['httpCode'].": Se actualizo el prod/var con id:".$sku.' a stock '.$stock;
          else $note=$result['httpCode'].": Hubo un error al actualizar id:".$sku.' a stock '.$stock;
          $note.='\n'.$permalink;
          $order->add_order_note( $note );

          ## HERE you Create/update your custom post meta data to avoid repetition
          update_post_meta( $order_id, '_ml_done', 'yes' );
          
          
        }

    }
}
