<?php


add_shortcode('fw_loop_price', 'fw_loop_price');
function fw_loop_price(){
    global $product;
    echo $product->get_price_html();
}
add_shortcode('fw_single_price', 'fw_single_price');
function fw_single_price(){
    global $product;
    echo $product->get_price_html();
}
// Hook before calculate fees
if(fw_theme_mod('fw_lili_discount'))add_action('woocommerce_cart_calculate_fees' , 'fw_apply_lili_discount');
function fw_apply_lili_discount( WC_Cart $cart ){
    if(is_admin())return;
    if(!(check_user_role('administrator') || check_user_role('customer') || check_user_role('subscriber') || check_user_role('guest') ) ) return;
    $cuantos=fw_theme_mod('fw_lili_discount_cant');
    $catespromo=explode(",",fw_theme_mod('fw_lili_discount_categories'));
    $porcentage=floatval(fw_theme_mod('fw_lili_discount_percentage'));
    if( $cart->cart_contents_count < $cuantos ) return;
    $cantqueespromo=0;
    $items = $cart->get_cart();
    $menorprecio=100000000;
    $aplicardescuento=true;

    foreach($items as $item => $values) { 
        $product_id=$values['data']->get_id() ;
        $product=wc_get_product( $product_id);
        //cates
        $esdelapromo=false;
        $terms = get_the_terms ( $product_id, 'product_cat' );
        //acase fija si esta en la promo
        foreach ( $terms as $cat ) if(in_array($cat->slug,$catespromo))$esdelapromo=true;
        
        if(!$esdelapromo)continue;
        $cantqueespromo+=$values['quantity'];
        //Aca si es de la cate
        $precio=$product->get_price();
        if($menorprecio>$precio)$menorprecio=$precio;
       
    }
    if($menorprecio==100000000)return;
    //$discount = $cart->subtotal * 0.1;
    $discount=$menorprecio*-1/(100/$porcentage)*floor($cantqueespromo/$cuantos);
    $cart->add_fee( 'Promo:', $discount);
}

if(fw_theme_mod('fw_product_discount')){
  function fw_product_discount($price,$product){
    if(is_admin())return  $price;
    if($price)return $price;
    if(!(check_user_role('administrator') || check_user_role('customer') || check_user_role('subscriber') || check_user_role('guest') ) ) return  $price;
  
    global $woocommerce;
    if($woocommerce->cart && !empty($woocommerce->cart->get_applied_coupons()))return  $price;


    if(fw_theme_mod('fw_product_discount_categories')){
      $esdelapromo=false;
      $terms = get_the_terms ( $product->id, 'product_cat' );
      $catespromo=explode(",",fw_theme_mod('fw_product_discount_categories'));
      foreach ( $terms as $cat )if(in_array($cat->slug,$catespromo))$esdelapromo=true;
      if(!$esdelapromo)return  $price;
    }else if(fw_theme_mod('fw_product_discount_categories_ext')){
      $esdelapromo=true;
      $terms = get_the_terms ( $product->id, 'product_cat' );
      $catespromo=explode(",",fw_theme_mod('fw_product_discount_categories_ext'));
      foreach ( $terms as $cat )if(in_array($cat->slug,$catespromo))$esdelapromo=false;
      if(!$esdelapromo)return  $price;

    }
    $multiplier=floatval(1-(fw_theme_mod('fw_product_discount_cant')/100));
    if($product->regular_price)return ceil(floatval($product->regular_price * $multiplier));
  }

  //add_filter('woocommerce_product_get_price', 'custom_price', 99, 2 );
  //add_filter('woocommerce_product_variation_get_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_get_sale_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_variation_get_sale_price', 'custom_price', 99, 2 );
  function custom_price( $price, $product ) {
    return fw_product_discount($price,$product);
  }

  add_filter('woocommerce_variation_prices_price', 'custom_variable_price', 99, 3 );
  add_filter('woocommerce_variation_prices_regular_price', 'custom_variable_price', 99, 3 );
  add_filter('woocommerce_variation_prices_sale_price', 'custom_variable_price', 99, 3 );
  function custom_variable_price( $price, $variation, $product ) {
    return fw_product_discount($price,$product);
  }

}


if(fw_theme_mod('fw_currency_conversion')  && !is_admin()){
  // Utility function to change the prices with a multiplier (number)
  function get_price_multiplier() {
    $price+=floatval(fw_theme_mod('fw_currency_conversion'));
    return $price; // x2 for testing
  }

  // Simple, grouped and external products
  add_filter('woocommerce_product_get_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_get_regular_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_get_sale_price', 'custom_price', 99, 2 );
  // Variations
  add_filter('woocommerce_product_variation_get_regular_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_variation_get_sale_price', 'custom_price', 99, 2 );
  add_filter('woocommerce_product_variation_get_price', 'custom_price', 99, 2 );
  function custom_price( $price, $product ) {
    if($price)return intval($price * get_price_multiplier());
  }

  // Variable (price range)
  add_filter('woocommerce_variation_prices_price', 'custom_variable_price', 99, 3 );
  add_filter('woocommerce_variation_prices_regular_price', 'custom_variable_price', 99, 3 );
  add_filter('woocommerce_variation_prices_sale_price', 'custom_variable_price', 99, 3 );
  function custom_variable_price( $price, $variation, $product ) {
    // Delete product cached price  (if needed)
    // wc_delete_product_transients($variation->get_id());
    if($price){
    return intval($price * get_price_multiplier());
    }
  }

  // Handling price caching (see explanations at the end)
  add_filter( 'woocommerce_get_variation_prices_hash', 'add_price_multiplier_to_variation_prices_hash', 99, 1 );
  function add_price_multiplier_to_variation_prices_hash( $hash ) {
    $hash[] = get_price_multiplier();
    return $hash;
  }
}

/*
// Displayed formatted regular price + sale price
add_filter( 'woocommerce_get_price_html', 'custom_dynamic_sale_price_html', 20, 2 );
function custom_dynamic_sale_price_html( $price_html, $product ) {
    if( $product->is_type('variation') ) return $price_html;

    $price_html = wc_format_sale_price( $product->regular_price, wc_get_price_to_display(  $product, array( 'price' => $product->get_sale_price() ) ) ) . $product->get_price_suffix();

    return $price_html;
}
add_filter('woocommerce_format_sale_price', 'fw_format_sale_price', 100, 3);
function fw_format_sale_price( $regular_price, $sale_price ) {
    error_log($regular_price);
    $price = ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) ;
    return $price;
}
*/


/*
function fw_price_html1($price,$product,$single=false){
    if(fw_check_hide_prices()) return;
    if(empty($product->get_price()) && $single)return '<a href="'.fw_company_data("email",true,$num).'"><span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar').'</span></span></a>';
    else if(empty($product->get_price()) && !$single) return '<span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar').'</span></span>';

    $symbol=get_woocommerce_currency_symbol();
    if($product->product_type == 'variable'){
        $available_variations = $product->get_available_variations();                               
        $maximumper = 0;
        for ($i = 0; $i < count($available_variations); ++$i) {
            $variation_id=$available_variations[$i]['variation_id'];
            $variable_product1= new WC_Product_Variation( $variation_id );
            $regular_price = $variable_product1 ->regular_price;
            $sale_price = $variable_product1 ->sale_price;
            if(intval($regular_price) && intval($sale_price)){
                $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
                if ($percentage > $maximumper) $maximumper = $percentage;
            }
            
            
        }
        $percentage=$maximumper;
    }else{
        //fix para roles
        
        $regular_price=$product->regular_price;
        $sale_price=$product->sale_price;
        
        if(!empty(fw_theme_mod('ca_roles_mayorista'))){
          $roles=fw_theme_mod('ca_roles_mayorista');
          if(is_string($roles))$roles=explode(",",$roles);
          
          //Festi
          if (function_exists('get_product_prices') && in_array(fw_get_current_user_role(),$roles)) {
            $prica=get_product_prices($product->get_id());
            if($prica[fw_get_current_user_role()]){//verifica el precio seteado
              $sale_price=$prica['salePrice'][fw_get_current_user_role()];
              $regular_price=$prica[fw_get_current_user_role()];
            }
            //custom fields
          }else if(in_array(fw_get_current_user_role(),$roles)) {
            $precio=get_post_meta($product->id,'_lista_'.fw_get_current_user_role(),true);
            if($precio)$regular_price=$precio;
          }
  
        }

        if(intval($regular_price) && intval($sale_price)){
          $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
        }else{
            $percentage=0;
        }
        
    }
    if($product->is_on_sale() && $sale_price!=$regular_price){
        return '<span class="fw_price price1" data-precio="'.$product->get_price().'">
            <span class="precio">'.$symbol.$sale_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').'</span></span>
            <span class="tachado">
                <span class="precio-anterior"><del>'.$symbol.$regular_price.'</del></span>
                <span class="badge badge-success ofertita">'.$percentage.'% OFF</span>
            </span>
            </span>';
    }else{
        $preciolabel=$symbol.$regular_price;
        return '<span class="fw_price price1" data-precio="'.$product->get_price().'"><span class="precio">'.$preciolabel.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').'</span></span></span>';
    }      
}

*/



// Generating dynamically the product "regular price"
add_filter( 'woocommerce_product_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
function custom_dynamic_regular_price( $regular_price, $product ) {
    if( empty($regular_price) || $regular_price == 0 ){
        return $product->get_price();

    }
    else
        return $regular_price;
}


// Generating dynamically the product "sale price"
add_filter( 'woocommerce_product_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
function custom_dynamic_sale_price( $sale_price, $product ) {
    if( empty($sale_price) || $sale_price == 0 )
        return $product->get_regular_price();
    else
        return $sale_price;
};


add_filter( 'woocommerce_cart_item_price', 'fw_precio_item_carrito', 30, 3 );
function fw_precio_item_carrito( $price, $values, $cart_item_key ) {
  $slashed_price = $values['data']->get_price_html();
  $is_on_sale = $values['data']->is_on_sale();
  if ( $is_on_sale ) $price = $slashed_price;
  return $price;
}

// Displayed formatted regular price + sale price
add_filter( 'woocommerce_get_price_html', 'custom_dynamic_sale_price_html', 20, 2 );
function custom_dynamic_sale_price_html( $price_html, $product ) {
    if( $product->is_type('variable') ){

        // Searching for the default variation
        $default_attributes = $product->get_default_attributes();
        // Loop through available variations
        foreach($product->get_available_variations() as $variation){
            $found = true; // Initializing
            // Loop through variation attributes
            foreach( $variation['attributes'] as $key => $value ){
                $taxonomy = str_replace( 'attribute_', '', $key );
                // Searching for a matching variation as default
                if( isset($default_attributes[$taxonomy]) && $default_attributes[$taxonomy] != $value ){
                    $found = false;
                    break;
                }
            }
            // When it's found we set it and we stop the main loop
            if( $found ) {
                $default_variaton = $variation;
                break;
            } // If not we continue
            else {
                continue;
            }
        }
        // Get the default variation prices or if not set the variable product min prices
        $regular_price = isset($default_variaton) ? $default_variaton['display_regular_price']: $product->get_variation_regular_price( 'min', true );
        $sale_price = isset($default_variaton) ? $default_variaton['display_price']: $product->get_variation_sale_price( 'min', true );
    }else {
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
    }
    
    $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  

    if(fw_check_hide_prices()) return;
    if(empty($product->get_price()))return '<a href="'.fw_company_data("email",true,$num).'"><span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar').'</span></span></a>';
    //else if(empty($product->get_price())) return '<span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar').'</span></span>';
    
    $symbol=get_woocommerce_currency_symbol();


    if ( $regular_price !== $sale_price && $product->is_on_sale()) {
        return '<span class="fw_price price1" data-precio="'.$product->get_price().'">
            <span class="precio">'.$symbol.$sale_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').'</span></span>
            <span class="tachado">
                <span class="precio-anterior"><del>'.$symbol.$regular_price.'</del></span>
                <span class="badge badge-success ofertita">'.$percentage.'% OFF</span>
            </span>
            </span>';
    }else{
        return '<span class="fw_price price1" data-precio="'.$product->get_price().'"><span class="precio">'.$symbol.$regular_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').'</span></span></span>';
    }      

}



?>