<style type="text/css">

.nscproduct{
    font-size: 14px;
    border: 1px solid #ccc;

}

.nscproduct .descuento .woocommerce-Price-amount.amount{

    font-size: 18px;
    font-weight: 400;
    line-height: 20px;
    padding: 0px;
    text-decoration: line-through;
    color: #666;

}


.nscproduct .precio .woocommerce-Price-amount.amount{

    font-size: 30px;
    line-height: 40px;
    font-weight: bold;
    color: #D1030F;
    text-align: left;
    margin-right: 4px;
    float: left;

}

.nscproduct .precio .nscproduct_save .woocommerce-Price-amount.amount{

    font-size: 13px;

    line-height: 16px;

    text-align: left;

    float: none;

    color: #fff;

}

@media (max-width: 800px) {

    .nscproduct_save,.nscproduct_seemore,.nscproduct_discount{
        display: none !important;
    }
    .nscproduct_title{
        margin: 0px;
    }

}
.nscproduct .precio .nscproduct_save{

    padding-top: 3px;

    height: 21px;

    color: white !important;

    background: #FFA500;

    padding-left: 5px;

    padding-right: 5px;

    font-size: 13px;

    line-height: 16px;

    padding-bottom: 2px;

    text-align: left;

    float: left;

}

.nscproduct .nscproduct_seemore{

    text-align: center;

    margin-top: 20px;

}

.nscproduct .nscproduct_seemore a{
   display: inline-block;
    color: #fff !important;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 700;
    background-color: #D1030F;
    padding: 10px;
    border-radius: 4px;

}
.agotado a{
    background-color: #3A3A3A !important;
}
.nscproduct .nscproduct_title{
    margin: 5px 0 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    text-transform: uppercase;;
    height: 40px;
    text-align: left;
    color: #D1030F;
    display: block;
    font-weight: bold;
}
.nscproduct .nscproduct-meta{
    min-height: 45px;
}
.nscproduct .nscproduct_discount{
    height:21px;
}

.nscproduct_extra{

    color: #333;

    font-weight: bold;

}




</style>
<?php
global $product;
?>
<div class="nscproduct d-none d-md-block">
        <a href="<?php echo get_the_permalink();?>">
        <div class="nscproduct_thumbnail">
            <?php
            echo woocommerce_get_product_thumbnail();
            ?>
        </div>
        <div class="nscproduct_meta">
            <a href="<?php echo get_the_permalink();?>" class="nscproduct_title"><?php echo get_the_title()?></a>
            <div class="nscproduct-meta">
            <?php 
                $regular_price=$product->get_regular_price();
                $sale_price=$product->get_sale_price();
                if($sale_price > 0) {
                        $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                        if ($percentage) {
                            $current_price = wc_price($sale_price);
                            echo '<div class="precio">'.$current_price.'</div>';
                        }
                }else{
                    echo '<div class="precio">'.wc_price($regular_price).'</div>';   
                }

            
            ?>
            </div>
            <p class="nscproduct_extra">Oferta en 1 Pago</p>
            
            <?php if ( !$product->is_in_stock() ) : ?>
             <div class="nscproduct_seemore agotado"><a href="<?php echo get_the_permalink();?>">Agotado</a></div>
            <?php else: ?>
                 <div class="nscproduct_seemore"><a href="<?php echo get_the_permalink();?>">COMPRAR</a></div>
            <?php endif; ?>

        </div>
        </a>
</div>
