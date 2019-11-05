
<div id="modal_carrito" class="modal fade addNewInputs show" role="dialog" aria-labelledby="modalAdd" aria-modal="true" style="display:block;" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center t2">
                <h4 class="modal-title text-center">Mi Carrito</h4>
                <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="container">
                    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                    <div class="row row-item-cart">
                            <div class="col-2"><img src="https://www.bidcom.com.ar/publicacionesML/productos/NOT00060/1000x1000-NOT00060.jpg" border="0" class="img-cart"></div>
                            <div class="col-6">
                                <div class="titulo-producto-cart">NOT00060 - Notebook Asus X540 Celeron 4Gb 500Gb 15.6”</div>
                                <div class="row no-gutters item-cantidad">													
                                        <div class="item-sumar col-2 col-md-1 text-left align-self-center">
                                            <a href="#" onclick="restarCart(JSON.stringify({&quot;productId&quot;:&quot;8000&quot;,&quot;productDescription&quot;:&quot;Notebook Asus X540 Celeron 4Gb 500Gb 15.6\u201d&quot;,&quot;productPrice&quot;:21299,&quot;productPhoto&quot;:&quot;https:\/\/www.bidcom.com.ar\/publicacionesML\/productos\/NOT00060\/1000x1000-NOT00060.jpg&quot;,&quot;productPaused&quot;:&quot;0&quot;,&quot;productShippingType&quot;:&quot;6&quot;,&quot;productQuantity&quot;:2,&quot;productCategoryId&quot;:&quot;160&quot;,&quot;productCategory&quot;:&quot;Notebooks&quot;,&quot;productSKU&quot;:&quot;NOT00060&quot;,&quot;productMarca&quot;:&quot;Asus&quot;,&quot;productTienda&quot;:&quot;bidcom&quot;,&quot;productSlug&quot;:&quot;notebooks&quot;,&quot;productoPostName&quot;:&quot;notebook-asus-x540-4gb-500gb-linux-15-6-intel&quot;}))" class="txt-22">
                                                <i class="fal fa-minus-circle"></i>
                                            </a>
                                        </div>													<div class="col-8 col-sm-5 col-md-2 text-center align-self-center">
                                        <input type="text" disabled="disabled" id="8000" name="quantity" class="form-control input-number" value="2" min="1" max="100">
                                    </div>
                                    <div class="item-restar col-2 col-md-1 text-right align-self-center">
                                        <a href="#" onclick="sumarCart(JSON.stringify({&quot;productId&quot;:&quot;8000&quot;,&quot;productDescription&quot;:&quot;Notebook Asus X540 Celeron 4Gb 500Gb 15.6\u201d&quot;,&quot;productPrice&quot;:21299,&quot;productPhoto&quot;:&quot;https:\/\/www.bidcom.com.ar\/publicacionesML\/productos\/NOT00060\/1000x1000-NOT00060.jpg&quot;,&quot;productPaused&quot;:&quot;0&quot;,&quot;productShippingType&quot;:&quot;6&quot;,&quot;productQuantity&quot;:2,&quot;productCategoryId&quot;:&quot;160&quot;,&quot;productCategory&quot;:&quot;Notebooks&quot;,&quot;productSKU&quot;:&quot;NOT00060&quot;,&quot;productMarca&quot;:&quot;Asus&quot;,&quot;productTienda&quot;:&quot;bidcom&quot;,&quot;productSlug&quot;:&quot;notebooks&quot;,&quot;productoPostName&quot;:&quot;notebook-asus-x540-4gb-500gb-linux-15-6-intel&quot;}))" class="txt-22">
                                            <i class="fal fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="#" onclick="deleteCart(JSON.stringify({&quot;productId&quot;:&quot;8000&quot;,&quot;productDescription&quot;:&quot;Notebook Asus X540 Celeron 4Gb 500Gb 15.6\u201d&quot;,&quot;productPrice&quot;:21299,&quot;productPhoto&quot;:&quot;https:\/\/www.bidcom.com.ar\/publicacionesML\/productos\/NOT00060\/1000x1000-NOT00060.jpg&quot;,&quot;productPaused&quot;:&quot;0&quot;,&quot;productShippingType&quot;:&quot;6&quot;,&quot;productQuantity&quot;:2,&quot;productCategoryId&quot;:&quot;160&quot;,&quot;productCategory&quot;:&quot;Notebooks&quot;,&quot;productSKU&quot;:&quot;NOT00060&quot;,&quot;productMarca&quot;:&quot;Asus&quot;,&quot;productTienda&quot;:&quot;bidcom&quot;,&quot;productSlug&quot;:&quot;notebooks&quot;,&quot;productoPostName&quot;:&quot;notebook-asus-x540-4gb-500gb-linux-15-6-intel&quot;}))" class="delete-item-cart rojo">Eliminar</a>
                            </div>
                            <div class="col-4 precio-cart text-right">$21,299.00</div>
                        </div>									<div class="row total">
                        <div class="col-6 col-md-8">TOTAL</div>
                        <div class="col-6 col-md-4 text-right">
                            <span id="order-cost"><span id="total">$42,598.00</span></span>
                        </div>
                    </div>					
                        <?php do_action( 'woocommerce_before_cart_table' ); ?>

                        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                            
                            <tbody>
                                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        ?>
                                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                            <td class="product-remove">
                                                <?php
                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                                            esc_attr( $product_id ),
                                                            esc_attr( $_product->get_sku() )
                                                        ),
                                                        $cart_item_key
                                                    );
                                                ?>
                                            </td>

                                            <td class="product-thumbnail">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                            if ( ! $product_permalink ) {
                                                echo $thumbnail; // PHPCS: XSS ok.
                                            } else {
                                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                            }
                                            ?>
                                            </td>

                                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }

                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                            // Meta data.
                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                            // Backorder notification.
                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                            }
                                            ?>
                                            </td>

                                            <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                ?>
                                            </td>

                                            <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                            } else {
                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                                        'min_value'    => '0',
                                                        'product_name' => $_product->get_name(),
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                            }

                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                            ?>
                                            </td>

                                            <td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                        </table>
                        <?php do_action( 'woocommerce_after_cart_table' ); ?>
                    </form>
                </div>
                <div style="padding:2em;">
                    <div class="row">
                        <div class="col-6 text-left">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" aria-label="Close">Agregar más productos</button>
                        </div>
                        <div class="col-6 text-right">
                            <a rel="nofollow" href="/Producto/enviar_productos" id="AddToCart" class="t2 btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

