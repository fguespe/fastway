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


function fw_product_discount_multiplier($product,$iscartcalc=false){
    if(is_admin() && !$iscartcalc)return 1;
    if(!fw_theme_mod('fw_product_discount'))return 1;
    if(!fw_theme_mod('fw_product_discount_cant'))return 1;
    //is admin
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

    }
    if(fw_theme_mod('fw_product_discount_categories_ids_exc')){
        $esdelapromo=true;
        $arra=explode(",",fw_theme_mod('fw_product_discount_categories_ids_exc'));
        if(in_array($product->id,$arra))$esdelapromo=false;
        if(!$esdelapromo)return 1;
    }
    $multiplier=floatval(1-(fw_theme_mod('fw_product_discount_cant')/100));
    return $multiplier;
}

if(fw_theme_mod('fw_currency_conversion') && !fw_theme_mod('fw_product_discount')){
    
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );
    function add_custom_price( $cart_object ) {
        foreach ( $cart_object->cart_contents as $key => $value ) {
            $product=wc_get_product($value['product_id']);
            if($value['variation_id'])$product=wc_get_product($value['variation_id']);
            $precio=$product->get_price();
            $precio=$precio*get_currency_conversion();
            $value['data']->set_price($precio);
        }
    }


}else if(!fw_theme_mod('fw_currency_conversion') && fw_theme_mod('fw_product_discount')){
    
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );
    function add_custom_price( $cart_object ) {
        foreach ( $cart_object->cart_contents as $key => $value ) {
            $product=wc_get_product($value['product_id']);
            if($value['variation_id'])$product=wc_get_product($value['variation_id']);
            $precio=$product->get_sale_price();
            $precio=$precio*get_currency_conversion();
            $value['data']->set_price($precio);
        }
    }
}

add_filter( 'woocommerce_cart_item_price', 'fw_precio_item_carrito', 30, 3 );
function fw_precio_item_carrito( $price, $value, $cart_item_key ) {
    $product=wc_get_product($value['product_id']);
    if($value['variation_id'])$product=wc_get_product($value['variation_id']);
    $slashed_price = $product->get_price_html();
    $is_on_sale = $product->is_on_sale();
    if ( $is_on_sale ) $price = $slashed_price;
    return $price;
}

function get_currency_conversion($iscartcalc=false) {
    if(is_admin() && !$iscartcalc)return 1;
    if(!fw_theme_mod('fw_currency_conversion'))return 1;
    $price=floatval(fw_theme_mod('fw_currency_conversion'));
    return $price; // x2 for testing
}


// Generating dynamically the product "regular price"
add_filter( 'woocommerce_product_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
function custom_dynamic_regular_price( $regular_price, $product ) {
    $devolver=$regular_price;
    if( empty($devolver) || $devolver == 0 )$devolver=$product->get_price();
    $devolver=round($devolver*get_currency_conversion());
    return $devolver;
}


// Generating dynamically the product "sale price"
add_filter( 'woocommerce_product_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
function custom_dynamic_sale_price( $sale_price, $product ) {
    $devolver=$sale_price;
    //Ya vien con la conversion
    if( empty($devolver) || $devolver == 0 )$devolver=round($product->get_price()*fw_product_discount_multiplier($product));
    $devolver=round($devolver*get_currency_conversion());
    return $devolver;

}


// Displayed formatted regular price + sale price
add_filter( 'woocommerce_get_price_html', 'custom_dynamic_sale_price_html', 20, 2 );
function custom_dynamic_sale_price_html( $price_html, $product ) {
    $symbol=get_woocommerce_currency_symbol();

    
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
        $sale_price=round($sale_price*fw_product_discount_multiplier($product)*get_currency_conversion());
        
    }else {
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
    }
    $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  

    if(fw_check_hide_prices()) return;
    if(empty($product->get_price()))return '<a href="'.fw_company_data("email",true,$num).'"><span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar_price').'</span></span></a>';
    //else if(empty($product->get_price())) return '<span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar_price').'</span></span>';
    

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


/*
add_action('wp_ajax_nopriv_fw_get_minicart', 'fw_get_minicart');
add_action('wp_ajax_fw_get_minicart', 'fw_get_minicart');
function fw_get_minicart(){  
    $carta=array();
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      $product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      $product_id = $cart_item['product_id'];
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'featured-thumb' ); 
      $image_url = $image[0];
      $nombre = $product->get_name();
      $cant=$cart_item['quantity'];
      
      $precio=round($product->get_sale_price());
      $line_subtotal=round($precio*$cant);
      error_log($line_subtotal);
      $arr = array('nombre' => $nombre, 'link'=> get_permalink($product_id),'precio'=> $precio, 'quantity' => $cart_item['quantity'], 'url' => $image_url, 'cart_item_key' => $cart_item_key, 'line_subtotal' => $line_subtotal);
      array_push($carta,$arr);
    }
    $totals=WC()->cart->get_totals();

    $totales=array('cart' => $carta, 'totals'=> $totals,'items'=>WC()->cart->cart_contents_count,'conversion'=>get_currency_conversion(true));
    echo json_encode($totales);
    exit();
}*/



add_action('wp_ajax_nopriv_fw_get_minicart', 'fw_get_minicart');
add_action('wp_ajax_fw_get_minicart', 'fw_get_minicart');
function fw_get_minicart(){  
    $carta=array();

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

        $product=wc_get_product($cart_item['product_id']);
        if($cart_item['variation_id'])$product=wc_get_product($cart_item['variation_id']);
    
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $cart_item['product_id'] ), 'featured-thumb' ); 
        $image_url = $image[0];
        $nombre = $product->get_name();
        $cant=$cart_item['quantity'];
        $precio= $cart_item['line_subtotal'];
        $arr = array('nombre' => $nombre, 'link'=> get_permalink($cart_item['product_id']),'precio'=> $precio, 'quantity' => $cart_item['quantity'], 'url' => $image_url, 'cart_item_key' => $cart_item_key);
        array_push($carta,$arr);
    }
    $totals=WC()->cart->get_totals();

    $totales=array('cart' => $carta, 'totals'=> $totals,'items'=>WC()->cart->cart_contents_count,'conversion'=>get_currency_conversion(true));
    echo json_encode($totales);
    exit();
}




?>