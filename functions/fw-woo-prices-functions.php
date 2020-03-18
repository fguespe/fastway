<?php


function get_currency_conversion($iscartcalc=false) {
    if(fw_is_admin())return 1;
    if(!fw_theme_mod('fw_currency_conversion'))return 1;
    $price=floatval(fw_theme_mod('fw_currency_conversion'));
    return $price; // x2 for testing
}



function fw_is_admin(){
    require_once(ABSPATH . 'wp-admin/includes/screen.php');
    $screen = get_current_screen();
    if ( $screen->parent_base == 'edit' ) return true;
    return false;
}

if(fw_theme_mod('fw_lili_discount'))add_action('woocommerce_cart_calculate_fees' , 'fw_apply_lili_discount');
function fw_apply_lili_discount( WC_Cart $cart ){
    if(fw_is_admin())return;
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
        if(count($catespromo)>1){
            $terms = get_the_terms ( $product_id, 'product_cat' );
            //acase fija si esta en la promo
            foreach ( $terms as $cat ) if(in_array($cat->slug,$catespromo))$esdelapromo=true;
        }else if(count($catespromo)==1){
            $esdelapromo=true;
        }
        
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
    if(fw_is_admin())return 1;
    if(!fw_theme_mod('fw_product_discount'))return 1;
    if(!fw_theme_mod('fw_product_discount_cant'))return 1;
    //is admin
    if(!(check_user_role('administrator') || check_user_role('customer') || check_user_role('subscriber') || check_user_role('guest') ) ) return  1;
    //Si ya tiene discount, volver
    
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
}else if(fw_theme_mod('fw_currency_conversion') && fw_theme_mod('fw_product_discount')){
    
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );
    function add_custom_price( $cart_object ) {
        foreach ( $cart_object->cart_contents as $key => $value ) {
            $product=wc_get_product($value['product_id']);
            if($value['variation_id'])$product=wc_get_product($value['variation_id']);
            $precio=$product->get_sale_price();
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



add_filter( 'woocommerce_product_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
function custom_dynamic_regular_price( $regular_price, $product ) {
    $devolver=$regular_price;
    if( empty($devolver) || $devolver == 0 )$devolver=$product->get_price();
    $devolver=round(floatval($devolver)*floatval(get_currency_conversion()));
    return $devolver;
}


// Generating dynamically the product "sale price"
add_filter( 'woocommerce_product_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
function custom_dynamic_sale_price( $sale_price, $product ) {
    $devolver=$sale_price;
    $noteniasale=empty($devolver) || $devolver == 0;
    if(fw_is_admin() && $noteniasale)return;
    else if( $noteniasale )$devolver=floatval($product->get_price())*floatval(fw_product_discount_multiplier($product));
    $devolver=round($devolver*get_currency_conversion());
    return $devolver;

}


// Displayed formatted regular price + sale price
add_filter( 'woocommerce_get_price_html', 'custom_dynamic_sale_price_html', 20, 2 );
function custom_dynamic_sale_price_html( $price_html, $product ) {
    if(fw_is_admin())return $price_html;
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
        if(!$sale_price || $sale_price==$regular_price)$sale_price=$regular_price*fw_product_discount_multiplier($product);
        $sale_price=round($sale_price*get_currency_conversion());
        
    }else {
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
    }
    if($regular_price){

        $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));  
    }

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








?>