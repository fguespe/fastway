<div id="modal_carrito" class="modal fade addNewInputs show" role="dialog" aria-labelledby="modalAdd" aria-modal="true" style="" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center t2">
                <h4 class="modal-title text-center">Mi Carrito</h4>
                <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body mx-3">
                <?php if(!empty(WC()->cart->get_cart())){?>
                <div class="container">
                    <?php
                    $index=0;
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'featured-thumb' ); 
                        $image_url = $image[0];
                    ?>
                    <div class="row row-item-cart">
                        <div class="col-2"><img src="<?=$image_url?>" class="img-cart"></div>
                        <div class="col-6">
                            <div class="titulo-producto-cart"><?=$_product->get_name()?></div>
                            <div id="loadingshow_<?=$index?>" style="display:none;"><i  class="fad fa-circle-notch fa-spin" style="color:var(--main);" ></i></div>
                            <div class="row no-gutters item-cantidad " id="loadinghide_<?=$index?>">													
                                    <div class="item-sumar col-2 col-md-1 text-left align-self-center"><a href="#" onclick="addCant(<?=$index?>,'<?=$cart_item_key?>',-1)" class="txt-22"><i class="fal fa-minus-circle"></i></a></div>													
                                    <div class="col-8 col-sm-5 col-md-2 text-center align-self-center">
                                        <input type="text" id="qty_<?=$index?>" name="quantity" class="form-control input-number" value="<?=$cart_item['quantity']?>" min="1" max="100">
                                    </div>
                                    <div class="item-restar col-2 col-md-1 text-right align-self-center"><a href="#" onclick="addCant(<?=$index?>,'<?=$cart_item_key?>',1)"  class="txt-22"> <i class="fal fa-plus-circle"></i></a></div> 
                                    <div class="item-restar col-2 col-md-1 text-right align-self-center"><a href="#" onclick="remove(<?=$index?>,'<?=$cart_item_key?>')"  class="txt-22"> <i class="fad fa-trash-alt" style="color:red;"></i></a></div>
                            </div>
                        </div>
                        <div class="col-4 precio-cart text-right">
                            <span id="qtyx_<?=$index?>"><?=$cart_item['quantity']?></span> x <span> <?=WC()->cart->get_product_price( $_product )?></span><br>
                            <span id="lineprice_<?=$index?>" data-price="<?=$_product->get_price();?>"><?=wc_price($cart_item['line_subtotal']);?></span>
                        </div>
                    </div>	
                    <?php 
                    $index++;
                    } ?>				
                    <div class="row total" style="padding-top:0.5em;">
                            <div class="col-6 col-md-8">TOTAL</div>
                            <div id="loadinghide_totals" class="col-6 col-md-4 text-right">
                                <span id="order-cost"><span id="total"><?=wc_price(WC()->cart->subtotal);?></span></span>
                            </div>
                            <div id="loadingshow_totals" class="col-6 col-md-4 text-right" style="display:none;"><i  class="fad fa-circle-notch fa-spin" style="color:var(--main);" ></i></div>
                    </div>	
                </div>
                <?php }else{?> <div class="container">No hay productos</div><?php } ?>
                <div style="padding:1em;">
                    <div class="row">
                        <div class="col-6 text-left">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" aria-label="Close">Agregar más productos</button>
                        </div>
                        <div class="col-6 text-right">
                            <a rel="nofollow" href="<?=esc_url( wc_get_checkout_url() )?>" id="" class="t2 btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function addCant(index,cart_item_key,sum){
    toggleloading(index)
    jQuery.get(ajaxurl,
    {'action': 'sum_cart_qty',cart_item_key:cart_item_key,sum:sum}, 
    function (msg) { 
        toggleloading(index)
        updatecant(index,sum)
    });
}
function getUpdatedPriceCart(){
    jQuery.get(ajaxurl,
    {'action': 'cart_get_subtotal'}, 
    function (totals) { 
        console.log(totals)
        jQuery('#total').text(totals.subtotal)
    });
}
function updatecant(index,sum){

    let actual=parseInt(jQuery('#qty_'+index).val())
    let precio=parseInt(jQuery('#lineprice_'+index).data('price'))
    let total=parseInt(actual+sum)
    let lineprice=parseInt(total)*parseInt(precio)
    let format='$' + parseFloat(lineprice, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
    
    jQuery('#qty_'+index).val(total)
    jQuery('#qtyx_'+index).text(total)
    jQuery('#lineprice_'+index).text(format)
    this.getUpdatedPriceCart();
}
function toggleloading(index){
    jQuery('#loadingshow_'+index).toggle();jQuery('#loadinghide_'+index).toggle();
    jQuery('#loadingshow_totals').toggle();jQuery('#loadinghide_totals').toggle();
}

function remove(index,cart_item_key){
    toggleloading(index)
    jQuery.get(ajaxurl,
    {'action': 'cart_remove_item',cart_item_key:cart_item_key}, 
    function (msg) { 
        toggleloading(index)
    });
}
</script>