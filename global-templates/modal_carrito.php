<div id="modal_carrito" class="modal fade addNewInputs show" role="dialog" aria-labelledby="modalAdd" aria-modal="true" style="" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center t2">
                <h4 class="modal-title text-center">Mi Carrito</h4>
                <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body mx-3">
                <div class="container"></div>
                <div style="padding:1em;">
                    <div class="row">
                        <div class="col-6 text-left">
                            <button type="button" class="btn seguir" data-dismiss="modal" aria-label="Close">Agregar más productos</button>
                        </div>
                        <div class="col-6 text-right">
                            <a rel="nofollow" href="<?=esc_url( wc_get_checkout_url() )?>" id="" class="btn comprar">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#modal_carrito .btn.seguir{
    background:var(--second);
    color:white;
    border:0px ;
}
#modal_carrito .btn.comprar{
    background:var(--main);
    color:white;
    border:0px ;
}
</style>
<script>

jQuery( "#color" ).change(function() {
  console.log(jQuery( "#color" ).val())
  
});


function addtocart(prod_id){
  jQuery('.fw_add_to_cart_button').addClass('loading')
  jQuery.get(ajaxurl,
  {'action': 'add_to_cart',id:prod_id}, 
  function (msg) { 
      jQuery('#modal_carrito').modal('show');
      jQuery('.fw_add_to_cart_button').removeClass('loading')
  });
}
jQuery('#modal_carrito').on('show.bs.modal', function () {
    jQuery('#modal_carrito .container').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    populatecart();
});

function addCant(index,cart_item_key,sum){
    let actual=parseInt(jQuery('#qty_'+index).val())
    jQuery('#modal_carrito .container').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    let total=parseInt(actual+sum)
    jQuery.get(ajaxurl, { 'action': 'sum_cart_qty',cart_item_key:cart_item_key,total:total}, 
    function (msg) { 
        populatecart();
    });
}


function populatecart(){
    jQuery.get(ajaxurl,
    {'action': 'fw_get_js_cart'}, 
    function (datos) { 
        datos=jQuery.parseJSON(datos)
        let jqe=''
        

        let conv=datos['conversion']
        if(!conv)conv=1

        let subtotal=datos['subtotal']*conv
        let promo=datos['promo']*conv
        let total=datos['total']*conv

        jQuery.each(datos['cart'], function (index, value) {
            let precio=value['precio']*conv
            let subtotal=value['subtotal']*conv
            let quantity=value['quantity']
            let line_subtotal=value['line_subtotal']*conv

            jqe+='<div class="row row-item-cart">'
            jqe+='<div class="col-2"><img src="'+value['url']+'" class="img-cart"></div>'
            jqe+='<div class="col-6">'
            jqe+='<div class="titulo-producto-cart">'+value['nombre']+'</div>'
            jqe+='<div id="loadingshow_'+index+'" style="display:none;"><i  class="fad fa-circle-notch fa-spin" style="color:var(--main);" ></i></div>'
            jqe+='<div class="row no-gutters item-cantidad " id="loadinghide_'+index+'">'
            jqe+='<div class="item-sumar col-2 col-md-1 text-left align-self-center"><a href="#" onclick="addCant('+index+',\''+value['cart_item_key']+'\',-1)" class="txt-22"><i class="fal fa-minus-circle"></i></a></div>'								
            jqe+='<div class="col-8 col-sm-5 col-md-2 text-center align-self-center">'
            jqe+='<input  type="text" id="qty_'+index+'" name="quantity" class="form-control input-number" value="'+value['quantity']+'" min="1" max="100">'
            jqe+='</div>'
            jqe+='<div class="item-restar col-2 col-md-1 text-right align-self-center"><a href="#" onclick="addCant('+index+',\''+value['cart_item_key']+'\',1)"  class="txt-22"> <i class="fal fa-plus-circle"></i></a></div> '
            jqe+='<div class="item-restar col-2 col-md-1 text-right align-self-center"><a href="#" onclick="remove('+index+',\''+value['cart_item_key']+'\')"  class="txt-22"> <i class="fad fa-trash-alt" style="color:red;"></i></a></div>'
            jqe+='</div>'
            jqe+='</div><div class="col-4 precio-cart text-right">'
            jqe+='<span id="qtyx_'+index+'">'+quantity+'</span> x <span> $'+precio+' </span><br>'
            jqe+='<span id="lineprice_'+index+'" data-price="'+precio+'"> $'+line_subtotal+' </span>'
            jqe+='</div></div>'
        });
        jqe+='<div id="loadinghide_totals"   class="row total" style="padding-top:0.5em;">'
        jqe+='<div class="col-6 col-md-8">Subtotal</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+subtotal+'</span></span></div>'
        if(datos['promo']>0){
            jqe+='<div class="col-6 col-md-8">Descuento</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">-$'+promo+'</span></span></div>'
            jqe+='<div class="col-6 col-md-8">TOTAL</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+total+'</span></span></div>'
        }
        jqe+='</div>'
        if(datos['subtotal']>0){
            jQuery('#modal_carrito .container').html(jqe);
        }else{
            jQuery('#modal_carrito .container').html('No hay produtos');
        }
    });
}

function remove(index,cart_item_key){
    jQuery('#modal_carrito .container').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    jQuery.get(ajaxurl,
    {'action': 'cart_remove_item',cart_item_key:cart_item_key}, 
    function (msg) { 
        populatecart();
    });
}
</script>