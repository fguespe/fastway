<style type="text/css">
	
.catalogo-loop{
/*CUADRADITO*/ 
    font-size: 14px;
    border: 1px solid #ccc;
 
    text-align: left;
padding-bottom:40px;
    background: white !important;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.50) !important;
    transition: box-shadow .1s;

}
.catalogo-loop .meta{

    padding-left: 10px;

}
.catalogo-loop .metas{

    padding-left: 10px;

}


.precio{
float:left;
width:50% !important;
}
.boton_comprar{
float:right;
width:50% !important;
}
.metas{
display:block !important;
}
.catalogo-loop .boton_comprar{
/*BOTON COMPRAR*/
    text-align: left;
   margin: 0 auto;
    margin-top: 5px;
    border-radius: 20px !important;
text-align:right !important;
}

.catalogo-loop .boton_comprar a{
    /*BOTON COMPRAR*/
    color: #fff !important;
    text-transform: uppercase;
    font-size: 20px;
    padding: 5px;
padding-left:0px !important;
padding-right:20px !important;
background-color: #4377B1;

}



.catalogo-loop .titulo{
    /*TITULO PRODUCTO*/
    text-overflow: ellipsis;
    text-transform: capitalize;
    min-height: 55px !important;;
    height:55px !important;
    text-align: left;
    color: #181818;
    font-size: 16px !important;
    display: block;
}
/*PRECIO*/

.catalogo-loop .precio{
    text-align:left !important;
}
.catalogo-loop .precio .woocommerce-Price-amount.amount,.catalogo-loop .precio{
    font-size: 45px;
    line-height: 40px;
    color:black;
}

.catalogo-loop .agotado{
    background-color: #3A3A3A !important;
}



@media (max-width: 800px) {
    .catalogo-loop{
        margin: 3px !important;
        padding: 0px !important;
    }
    .catalogo-loop .precio .woocommerce-Price-amount.amount{
        font-size: 25px !important;
    }
    .catalogo-loop .titulo{
        font-size: 13px !important;
        min-height: 0px !important;
        text-align:left !important;
        margin:5px;
        margin-top: 0px;
        margin-bottom: 0px;
        height: 35px;
    }   
    .catalogo-loop .precio_off,.catalogo-loop .precio_off{
        display: none !important;
    }
    .catalogo-loop .thumbnail {
        /*IMAGEN DE PRODUCTO*/
        height:150px !important;
    }
    .catalogo-loop .thumbnail img{
            /*IMAGEN DE PRODUCTO*/
        max-height:150px !important;
        height:100%;
        width:auto !important;  
    }
    
}
</style>
<?
global $product;

?>
<div class="catalogo-loop">
        <a href="<?php echo get_the_permalink();?>">
        <div class="thumbnail">
            <?php echo woocommerce_get_product_thumbnail(); ?>
        </div>
        <div class="meta">
            <span class="titulo"><?php echo get_the_title()?><br>
        </div>
        <div class="metas">
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
            
           <?php if ( !$product->is_in_stock() ) : ?>
             <div class="boton_comprar agotado"><a href="<?php echo get_the_permalink();?>">Agotado</a></div>
            <?php else: ?>
                 <div class="boton_comprar"><a href="<?php echo get_the_permalink();?>">+ <i class="fa fa-shopping-cart"></i></a></div>
            <?php endif; ?>
            
        </div>
         
        </a>
    </div>
