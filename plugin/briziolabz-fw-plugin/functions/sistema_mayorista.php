<?php
if(empty(get_option('nubicommerce_damelosroles')))return;

function get_precio_por_rol( $product,$variable ){
    if($product->is_type( array('simple', 'variable') ) && get_post_meta( $product->id, $variable, true ) > 0 ){

        return get_post_meta( $product->id, $variable, true );

    }else if($product->is_type('variation') && get_post_meta( $product->variation_id, $variable, true ) > 0 ){

        return get_post_meta( $product->variation_id, $variable, true );
    }
    return 0;
}

function esconder_productos_sin_precio($where, $query) {
    if (empty(es_rol_mayorista()))return $where;
    global $wpdb;
    $args     = array( 'post_type' => 'product' , 'posts_per_page'=>-1, 'numberposts'=>-1);
    $products = get_posts( $args ); 
    $ids_mayoristasoro="";
    foreach ($products as $prod ) {
      $precio_mayoristasoro=get_post_meta($prod->ID,'_'.es_rol_mayorista().'_price',true);
      if($precio_mayoristasoro>0){
        $ids_mayoristasoro.=$prod->ID.", ";
      }
    }
    $ids_mayoristasoro=rtrim($ids_mayoristasoro,", ");//Saco la ultima coma
    //echo $ids_mayoristasoro;
    if (!current_user_can('administrator')) {
        $product = $query->query_vars['post_type'];

        if ($product == 'product') {
          $where .= " AND `post_type`='product' AND `ID` IN ($ids_mayoristasoro)";
        }
    }
    return $where;
}
add_filter('posts_where_paged', 'esconder_productos_sin_precio', 10, 2);



add_filter( 'woocommerce_product_get_price', 'w4dev_woocommerce_get_price', 10, 2);
add_filter( 'woocommerce_get_regular_price', 'w4dev_woocommerce_get_price', 10, 2);
function w4dev_woocommerce_get_price( $price, $product ){
    if (empty(es_rol_mayorista()))return $price;
    $price = get_precio_por_rol($product,'_'.es_rol_mayorista().'_price');
    if(!empty(get_option('conversion_usd')))if(get_option('conversion_usd')>0)$price = $price*get_option('conversion_usd');
    return $price;
}


function es_rol_mayorista(){
  if(current_user_can('administrator'))return;
  $roles=get_option('nubicommerce_damelosroles');
  $roles=explode(",",$roles);
  foreach ($roles as $label) {
    $varname=preg_replace('/[^a-z]/', "", strtolower($label));
    if(current_user_can($varname))return $varname;
  }
}

$roles=get_option('nubicommerce_damelosroles');
$roles=explode(",",$roles);
foreach ($roles as $label) {
  $varname=preg_replace('/[^a-z]/', "", strtolower($label));
  $result = add_role( $varname, __($label ),array( 'read' => true,'edit_posts' => true, 'edit_pages' => true,'edit_others_posts' => true, 'create_posts' => true, 'manage_categories' => true, 'publish_posts' => true,'edit_themes' => false, 'install_plugins' => false, 'update_plugin' => false,'update_core' => false ));
}
add_action( 'woocommerce_product_options_pricing', 'w4dev_woocommerce_product_options_pricing' );
function w4dev_woocommerce_product_options_pricing(){
  $roles=get_option('nubicommerce_damelosroles');
  $roles=explode(",",$roles);

   foreach ($roles as $label) {
       $varname=preg_replace('/[^a-z]/', "", strtolower($label));
       woocommerce_wp_text_input( array( 
         'id' => '_'.$varname.'_price',
         'class' => 'short',
         'label' => __( $label, 'woocommerce' ) . ' ('.get_woocommerce_currency_symbol().')',
         'type' => 'text'
       ));
   }    
}
add_action( 'woocommerce_process_product_meta_simple', 'w4dev_woocommerce_process_product_meta_simple', 10, 1 );
function w4dev_woocommerce_process_product_meta_simple( $product_id ){
     $roles=get_option('nubicommerce_damelosroles');
     $roles=explode(",",$roles);
     foreach ($roles as $label) {
        $varname=preg_replace('/[^a-z]/', "", strtolower($label));
        if( isset($_POST['_'.$varname.'_price']) )
           update_post_meta( $product_id, '_'.$varname.'_price', $_POST['_'.$varname.'_price'] );
   }
  
}




