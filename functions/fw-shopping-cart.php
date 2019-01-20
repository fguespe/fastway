<?php

if( !function_exists( 'fw_shoppingCart' ) ) {
    add_shortcode('fw_shopping_cart', 'fw_shoppingCart');

    function fw_shoppingCart($style=""){

        if( !is_plugin_active('woocommerce/woocommerce.php') ) return;
        global $woocommerce;
        if(empty($style))$style=fw_theme_mod('cart-style');
        $rand=generateRandomString(5);
        $cant=$woocommerce->cart->cart_contents_count;
        $total=$woocommerce->cart->get_cart_total();
        $carturl=wc_get_cart_url();
        $checkurl=wc_get_checkout_url();
        $istyle=fw_theme_mod("icons_style");
        if($style==="link" || $style==="modal"){
          return <<<HTML
<a class="fw-header-icon minicart"  href="$carturl" role="button" data-target="#$idname2" data-toggle="modal">
    <span class="p1 header-cart-count-badge fa-stack has-badge" data-count="$cant">
      <i class="p3 $istyle fa-shopping-cart fa-stack-1x xfa-inverse" data-count="$cant"></i>
    </span>
</a>
HTML;
        }/*else if($style==="popup"){
        $idname=$rand."cart-popover";
        $idname2=$rand.'popover_content_wrapper';
        $istyle=fw_theme_mod("icons_style");
        echo '
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery("'.$idname2.'").popover({
        html : true,
        container: \'body\',
        content: function() {
            return jQuery("'.$idname2.'").html();
        }
    });
});
</script>

<a class="fw-header-icon minicart"  href="$carturl" role="button" data-target="#$idname2" data-toggle="modal">
  <span class="p1 header-cart-count-badge fa-stack has-badge" data-count="$cant">
    <i class="p3 $istyle fa-shopping-cart fa-stack-1x xfa-inverse" data-count="$cant"></i>
  </span>
</a>   

<div id="$idname2" class="fw-mini-cart" style="display: none">
   <div class="mini-cart-item-title">Carrito</div>
      <div class="widget_shopping_cart_content"></div>
      <div class="mini-cart-footer">
         <span>SUBTOTAL:<span class="d-block total-mini-cart">$total</span></span>
         <a class="checkoutbtn" href="$checkurl">Completar la compra</a>
    </div>
</div>';
        }else if($style==="modal"){
        $idname2=$rand.'shoppingCartModal';
        $istyle=fw_theme_mod("icons_style");
        
        echo '<a class="fw-header-icon minicart"  href="#" role="button" data-target="#'.$idname2.'" data-toggle="modal">
  <span class="p1 header-cart-count-badge fa-stack has-badge" data-count="'.$cant.'">
    <i class="p3  '.$istyle.' fa-shopping-cart fa-stack-1x xfa-inverse" data-count="'.$cant.'"></i>
  </span>
</a>
<!-- Modal -->
<div class="modal fade fw-mini-cart " id="'.$idname2.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <div class="mini-cart-item-title">Carrito</div>
        </div>
        <div class="modal-body">
          <div class="widget_shopping_cart_content">El carrito esta vacío.</div>
        </div>';
      if($total>0)echo '
        <div class="modal-footer">
          <div class="mini-cart-footer">
            <span>SUBTOTAL:<span class="d-block total-mini-cart">'.$total.'</span></span>
            <a class="checkoutbtn" href="'.$checkurl.'">Completar la compra</a>
          </div>
        </div>';
  echo '</div>
  </div>
</div>';
        }*/
    }


  

}
//actualiza counter
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {
    
    //$fragments['.header-cart-count'] = '<span class="header-cart-count u-badge u-badge-primary u-badge-pos rounded-circle">' . WC()->cart->get_cart_contents_count() . '</span>';
    $fragments['.header-cart-count-badge'] = '<span class="p1 header-cart-count-badge fa-stack has-badge" data-count="'.WC()->cart->get_cart_contents_count().'">
    <i class="p3 '.fw_theme_mod("icons_style").' fa-shopping-cart fa-stack-1x xfa-inverse" data-count="'.WC()->cart->get_cart_contents_count().'"></i> </span>';

    
    $fragments['.total-mini-cart'] = '<span class="d-block total-mini-cart">' . WC()->cart->get_cart_total() . '</span>';
    
    
     ob_start();
    ?>

    <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>

    <?php $fragments['div.widget_shopping_cart_content'] = ob_get_clean();

    return $fragments;
    
}




// Remove product in the cart using ajax
function warp_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );
?>