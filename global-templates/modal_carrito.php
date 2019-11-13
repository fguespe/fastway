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
                    <div class="row d-flex justify-content-between">
                        <button type="button" class="btn seguir" data-dismiss="modal" aria-label="Close">Agregar más productos</button>
                        <a rel="nofollow" href="<?=esc_url( wc_get_checkout_url() )?>" id="" class="btn comprar">Comprar</a>
                    
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
.fw_variations{
    text-align:center !important;
    width:100% !important;
}
</style>
<script>

jQuery( ".fw_variations select" ).change(function() {
    let vara=getVariation()
    let suffix=jQuery('#fwprice .precio .suffix').text()
    jQuery('#fwprice .precio').html('<span class="fw_price price1"><span class="precio">$'+vara['display_price']+'<span class="suffix">'+suffix+'</span></span></span>');
    
});
function getVariation(){
    let selects=jQuery( ".fw_variations select" )
    let vars=jQuery( ".fw_variations" ).data( "product_variations" );
    let indexes=[]
    let elid=-1
    selects.each(function( index ) {
        indexes[jQuery(this).data('attribute_name')]=jQuery(this).val()
    });
    let vara=null
    vars.forEach(function(element) {
        let atr=element['attributes']
        let names=Object.keys(indexes)
        let esigual=true
        console.log(indexes)
        names.forEach(function(name) {
            if(atr[name]!=indexes[name])esigual=false
        })

        console.log(esigual,element)
        if(esigual) {
            vara=element
        }
    });
    return vara
    
}


function addtocart(prod_id){
    let var_id=0;

    if(jQuery( ".fw_variations" ).length){
        var_id=getVariation()
        if(!var_id){
            alert("Seleccionar una opcion")
            return;
        }else{
            var_id=var_id['variation_id']
        }
    }
    jQuery('.fw_add_to_cart_button').addClass('loading')
    console.log('var_id',var_id)

    jQuery.get(ajaxurl,
    {'action': 'add_to_cart',id:prod_id,var_id:var_id}, 
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
        let totals=datos['totals']

        let subtotal=totals['subtotal']*conv
        let discount_total=totals['fee_total']*conv
        let total=totals['total']*conv

        console.log(datos)
        jQuery.each(datos['cart'], function (index, value) {
            let precio=value['precio']*conv
            let subtotal=value['subtotal']*conv
            let quantity=value['quantity']
            let line_subtotal=value['line_subtotal']*conv

            jqe+='<div class="row row-item-cart">'
            jqe+='<div class="col-2" style="padding:0px !important;text-align:center !important;;"><img src="'+value['url']+'" class="img-cart"></div>'
            jqe+='<div class="col-6">'
            jqe+='<div class="titulo-producto-cart">'+value['nombre']+'</div>'
            jqe+='<div id="loadingshow_'+index+'" style="display:none;"><i  class="fad fa-circle-notch fa-spin" style="color:var(--main);" ></i></div>'
            jqe+='<div class="row d-flex justify-content-left item-cantidad " id="loadinghide_'+index+'">'
            jqe+='<div class="item-sumar text-left align-self-center"><a href="#" onclick="addCant('+index+',\''+value['cart_item_key']+'\',-1)" class="txt-22"><i class="fal fa-minus-circle"></i></a></div>'	
            jqe+='<input  type="text" style="width:40px;text-align:center;margin-left:10px;margin-right:10px;" id="qty_'+index+'" name="quantity" class="input-number" value="'+value['quantity']+'" min="1" max="100">'
            jqe+='<div class="item-restar align-self-center"><a href="#" onclick="addCant('+index+',\''+value['cart_item_key']+'\',1)"  class="txt-22"> <i class="fal fa-plus-circle"></i></a></div> '
            jqe+='<div class="item-restar align-self-center" style="margin-left:10px;"><a href="#" onclick="remove('+index+',\''+value['cart_item_key']+'\')"  class="txt-22"> <i class="fad fa-trash-alt" style="color:red;"></i></a></div>'
            jqe+='</div>'
            jqe+='</div><div class="col-4 precio-cart text-right">'
            jqe+='<span id="qtyx_'+index+'">'+quantity+'</span> x <span> $'+precio+' </span><br>'
            jqe+='<span id="lineprice_'+index+'" data-price="'+precio+'"> $'+line_subtotal+' </span>'
            jqe+='</div></div>'
        });
        jqe+='<div id="loadinghide_totals"   class="row total" style="padding-top:0.5em;">'
        jqe+='<div class="col-6 col-md-8">Subtotal</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+subtotal+'</span></span></div>'
        if(discount_total<0){
            jqe+='<div class="col-6 col-md-8">Descuento</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+discount_total+'</span></span></div>'
            jqe+='<div class="col-6 col-md-8">TOTAL</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+total+'</span></span></div>'
        }
        jqe+='</div>'
        if(subtotal>0){
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