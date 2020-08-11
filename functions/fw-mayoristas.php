<?php


function parser_mayorista($value){
  //'a:1:{s:9:"mayorista";s:6:"943.64";}'
  $data=json_decode($value);
  $number=$data->mayorista;
  if(empty($number) && $value[0]=='a' && $value[1]==':'){
    preg_match_all('/"([^"]+)"/', $value, $m);
    $number=json_encode($m[0][1]);
    $number=preg_replace("/[^0-9.]/", "", $number);
  }
  return $number;
}

if(fw_theme_mod('fw_client_admin_columnaprecio')){
  add_filter( 'manage_edit-product_columns', 'manage_product_posts_custom_mayorista_title',11);
  function manage_product_posts_custom_mayorista_title($columns){
    $nombre='Mayorista';
    $columns[strtolower($nombre)] =ucfirst($nombre).'s';
    return $columns;
  }
  
  add_action( 'manage_product_posts_custom_column', 'manage_product_posts_custom_mayorista_set', 10, 2 );
  function manage_product_posts_custom_mayorista_set( $column, $postid ) {
      $nombre='Mayorista';
      $product = wc_get_product( $postid );
      if ( $column == strtolower($nombre) ) {
        $valor=get_post_meta( $postid, 'festiUserRolePrices', true );
        echo parser_mayorista($valor);
      }
  }
}


  