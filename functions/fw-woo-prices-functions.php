<?php


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


function fw_product_discount_multiplier($product){
    if(!fw_theme_mod('fw_product_discount'))return 1;
    if(!fw_theme_mod('fw_product_discount_cant'))return 1;

    if(is_admin())return  1;
    if($price)return 1;
    if(!(check_user_role('administrator') || check_user_role('customer') || check_user_role('subscriber') || check_user_role('guest') ) ) return  1;

    global $woocommerce;
    if($woocommerce->cart && !empty($woocommerce->cart->get_applied_coupons()))return 1;


    if(fw_theme_mod('fw_product_discount_categories')){
        $esdelapromo=false;
        $terms = get_the_terms ( $product->id, 'product_cat' );
        $catespromo=explode(",",fw_theme_mod('fw_product_discount_categories'));
        foreach ( $terms as $cat )if(in_array($cat->slug,$catespromo))$esdelapromo=true;
        if(!$esdelapromo)return 1;
    }else if(fw_theme_mod('fw_product_discount_categories_ext')){
        $esdelapromo=true;
        $terms = get_the_terms ( $product->id, 'product_cat' );
        $catespromo=explode(",",fw_theme_mod('fw_product_discount_categories_ext'));
        foreach ( $terms as $cat )if(in_array($cat->slug,$catespromo))$esdelapromo=false;
        if(!$esdelapromo)return 1;

    }else if(fw_theme_mod('fw_product_discount_categories_ids_exc')){
        $esdelapromo=true;
        $arra=explode(",",fw_theme_mod('fw_product_discount_categories_ids_exc'));
        if(in_array($product->id,$arra))$esdelapromo=false;
        if(!$esdelapromo)return 1;

    }
    $multiplier=floatval(1-(fw_theme_mod('fw_product_discount_cant')/100));
    return $multiplier;
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

add_filter( 'woocommerce_cart_item_price', 'fw_precio_item_carrito', 30, 3 );
function fw_precio_item_carrito( $price, $values, $cart_item_key ) {
  $slashed_price = $values['data']->get_price_html();
  $is_on_sale = $values['data']->is_on_sale();
  if ( $is_on_sale ) $price = $slashed_price;
  return $price;
}






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
    $rate=fw_product_discount_multiplier($product);
    if( empty($sale_price) || $sale_price == 0 )
        return $product->get_regular_price()*$rate;
    else
        return $sale_price;
};

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
        $sale_price=$sale_price*fw_product_discount_multiplier($product);
        
    }else {
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
    }
    $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  

    if(fw_check_hide_prices()) return;
    if(empty($product->get_price()))return '<a href="'.fw_company_data("email",true,$num).'"><span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar').'</span></span></a>';
    //else if(empty($product->get_price())) return '<span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar').'</span></span>';
    
    $symbol=get_woocommerce_currency_symbol();
    if ( $sale_price<$regular_price) {
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



?>