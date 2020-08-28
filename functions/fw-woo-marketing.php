 <?php


function filter_woocommerce_coupon_is_valid( $true, $instance ) { 
    if(esMultitienda()) return false;
    return $true;
}

add_filter( 'woocommerce_coupon_is_valid', 'filter_woocommerce_coupon_is_valid', 10, 2 ); 



add_action('woocommerce_cart_calculate_fees' , 'fw_cart_calculate_fees');
function fw_cart_calculate_fees( WC_Cart $cart ){
    if(fw_theme_mod('fw_lili_discount')){
        $discount=get_lili_discount($cart);
        if($discount<0)$cart->add_fee( 'Promo:',$discount);
    }
}
function get_lili_discount($cart){
    if(fw_is_admin())return;
    if(esMultitienda()) return;
    if(!fw_theme_mod('fw_lili_discount'))return;
    if (!empty($cart->applied_coupons) && !fw_theme_mod('fw_lili_discount_cupones'))return;
    $cuantos=fw_theme_mod('fw_lili_discount_cant');
    if( $cart->cart_contents_count < $cuantos ) return;
    $catespromo=array();
    $porcentage=floatval(fw_theme_mod('fw_lili_discount_percentage'));

    if(fw_theme_mod('fw_lili_discount_categories'))$catespromo=explode(",",fw_theme_mod('fw_lili_discount_categories'));
    
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
        if(count($catespromo)>0){
            foreach ( $terms as $cat ) {
                if(in_array($cat->slug,$catespromo))$esdelapromo=true;
            }
        }else{
            $esdelapromo=true;
        }
        
        if(!$esdelapromo)continue;
        $cantqueespromo+=$values['quantity'];
        //Aca si es de la cate
        $precio=$product->get_price();
        if($menorprecio>$precio)$menorprecio=$precio;
    }

    error_log('menor precio es'.$menorprecio);
    if($menorprecio==100000000)return;
    $discount=$menorprecio*-1/(100/$porcentage)*floor($cantqueespromo/$cuantos);
    error_log('discount'.$discount);
    return $discount;
}