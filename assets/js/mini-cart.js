// Ajax delete product in the cart
jQuery(document).on('click', '.mini_cart_item a.remove', function (e)
{
    e.preventDefault();

    var product_id = jQuery(this).attr("data-product_id"),
        cart_item_key = jQuery(this).attr("data-cart_item_key"),
        product_container = jQuery(this).parents('.mini_cart_item');
    
    //var counter=jQuery("#minicart_counter").html('100');
    

    product_container.hide();
    $("<div class='loading-div'><img style='margin: 7px 0px 0px 0px;' src='/wp-admin/images/spinner-2x.gif' /></div>").insertBefore(product_container);
    
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: "product_remove",
            product_id: product_id,
            cart_item_key: cart_item_key
        },
        success: function(response) {
            if ( ! response || response.error )
                return;

            var fragments = response.fragments;

            // Replace fragments
            if ( fragments ) {
                jQuery.each( fragments, function( key, value ) {
                    //alert(value);
                    jQuery( key ).replaceWith( value );
                });
            }
            //jQuery("#minicart_counter").html('100');
        }
    });
});