<div class="container d-flex row px-0 mx-0">
	<div class="gallery col-md-8 px-0">
         <div class="detalle-imagenListado active">
            <div id="imagenListado" itemscope="" itemtype="http://schema.org/MediaObject" style="position: relative; overflow: hidden;">
                <?
                global $product;
                $fotos=$product->get_gallery_attachment_ids();
                array_push($fotos,intval(get_post_thumbnail_id( $product->id )));
                $fotos=array_reverse($fotos);
                
                foreach ($fotos as $ids) {
                    
                    $url=wp_get_attachment_url( $ids);
                    ?>
                    <a href="<?php echo $url;?>" data-fancybox="gallery" style="background-color: rgb(0, 0, 0); position: absolute; top: 0px; left: 0px; z-index: 8; opacity: 1;">
                      <img itemprop="image" src="<?php echo $url;?>" width=400 height="auto">
                      <div class="lupaImg"><i class="fa fa-search-plus"></i></div>
                    </a>
                <? } ?>
               <!--<div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject" style="width: 100%; background-color: rgb(0, 0, 0); position: absolute; top: 0px; left: 0px; display: none; z-index: 1;">
                  <span hidden="true" itemprop="name">Scooter Balance Gadnic 10" | Bluetooth</span>
                  <span hidden="true" itemprop="thumbnailUrl">https://www.youtube.com/embed/JJJDgPSzboo?rel=0 </span>
                  <span hidden="true" itemprop="description">Video del: SCOOTER6XXX</span>
                  <span hidden="true" itemprop="uploadDate">2018-01-02 16:59:09</span>
                  <iframe width="100%" height="400" src="https://www.youtube.com/embed/JJJDgPSzboo?rel=0" frameborder="0" allowfullscreen=""></iframe>
               </div>-->
            </div>
            <div id="mainNextIL" class="swiper-next"><i class="fa fa-angle-right"></i></div>
            <div id="mainPrevIL" class="swiper-prev"><i class="fa fa-angle-left"></i></div>
         </div>
         <ul id="paginationIL" class="d-none d-sm-block"></ul>
	</div>
 	<div class="summary col-md-4">
     
         <?

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
            add_action('woocommerce_single_product_summary', 'send_to_html', 10 );
            function send_to_html(){
                global $product;echo fw_price_html1(null,$product);}

			remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
			do_action( 'woocommerce_single_product_summary' );



         ?>
         <div class="compra-segura"><i class="fa fa-shield"></i> <a href="#" target="_blank">Compra segura</a>, recibi el producto que esperas o te devolvemos el dinero.</div>
		<a target="_blank" data-toggle="modal" data-target="#modalMediosPago" class="fancybox btn-medios block btn-mobile t2">
	            <div class="row">
	                <div class="col-2 text-left v-top txt-28"><i class="fa fa-credit-card"></i></div>
	                <div class="col-10 text-left calcular-costo-envio">
	                	<h4 class="verde">Pagá en cuotas sin interes</h4>
	                    <span class="azul">(Chequear promociones vigentes)</span>
	                </div>
	            </div>
	       </a>

                    <?php  global $product; echo getFinanciacion($product);?>
	</div>

</div>
<?php
		
remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
do_action( 'woocommerce_after_single_product_summary' );
?>

<div class="container related" style="max-width: 1200px;">
<h4 class="titulo">Quienes vieron este producto también compraron</h3>
        
  <div class="swiper-related over-hidden container relative swiper-container-horizontal">
    <div class="swiper-wrapper">
        <?
        $myarray = wc_get_related_products($product->id,12);

        $args = array(
           'post_type' => 'product',
           'post__in'      => $myarray
        );
        // The Query
        $products = new WP_Query( $args );

        while ( $products->have_posts() ) : 
            //$contada++;
            $products->the_post(); 
            echo '<div class="swiper-slide">';
            wc_get_template_part( 'content', 'product' ); 
            echo '</div>';    
        endwhile; 
        ?>

    </div>

    <div class="swiper-prev swiper-prod-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-prod-next"><i class="fa fa-angle-right"></i></div>
  </div>
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {
	//Crea las thumnails de la izquierda
    var ProductSwiper = new Swiper('.swiper-related', {
            //pagination: '.swiper-prod-rel-pagination',
            nextButton: '.swiper-prod-next',
            prevButton: '.swiper-prod-prev',
            slidesPerView:6,
            slidesPerGroup:6,
            paginationClickable: true,
            spaceBetween: 10,
            loop: true,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });

        //Fancybox
        jQuery("[data-fancybox]").fancybox({
            // Options will go here
            iframe : {
                // Iframe tag attributes
                attr : {
                    scrolling : 'true'
                }
            }
        });  
        //Fancybox con scrollbar
        jQuery(".fancybox").click(function(){
            jQuery(".fancybox-iframe").attr("scrolling", "auto");            
        });        
    jQuery('#imagenListado').before('<ul id="navIL">').cycle({ 
        fx:     'scrollLeft', 
        speed:  'fast', 
        timeout: 0, 
        next:   '#mainNextIL', 
        prev:   '#mainPrevIL',
        pager:  '#paginationIL', 
        // callback fn that creates a thumbnail to use as pager anchor 
        pagerAnchorBuilder: function(idx, slide) {             
            var img     = jQuery(slide).find('img').attr('src');
            if(img == null){
                return '<li><a href="#"><img src="https://www.bidcom.com.ar/images/video-thumb.png" width="50" height="50" /></a></li>'; 
            }else{
                return '<li><a href="#"><img src="'+ img + '" width="50" /></a></li>';
            }    
        } 
    });

});
</script>

<style type="text/css">
.fw_single_product{
background:white;
}

/************************************************************************************ 
DETALLE PRODUCTO
************************************************************************************/


#paginationIL {
    left: 0;
    right: 0;
    bottom: 0;
    padding-right: 0px;
    z-index: 1000;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    height: auto;
    left: 0;
    position: relative;
    margin-bottom: 10px;
}
#paginationIL {
    float: left !important;
    width: 10% !important;
}
#paginationIL li {
    list-style: none;
    display: block;
    max-width: 20%;
    opacity: 0.4;
}
#paginationIL li.activeSlide {
    opacity: 1;
}
#paginationIL a {
    border: 0;
    display: block;
    margin: 2px;
    padding: 2px 2px 0px 2px;
    border: 1px solid transparent;
}

/***** Pasador imagen detalle *****/

#imagenListado {
    height: 400px;
    text-align: center;
}


@media (max-width: 992px){
#paginationIL {
display: none !important;
}
.detalle-imagenListado {
 width: 100% !important;
}
}
@media (max-width: 760px){
.detalle-imagenListado {
height: auto !important;
}
}

#imagenListado {
height: 400px;
text-align: center; 
}
@media (max-width: 512px) {
#imagenListado {
height: 300px;
text-align: center;
        
}
}


.detalle-imagenListado{
    position: relative;
    float: right;
    height: 400px;
    width: 80%
}
<?php if(count($fotos)==1){ ?>
    
    #paginationIL{
        display: none !important;
    }
    .detalle-imagenListado{
        width:100%;
    }

    .detalle-imagenListado.active #mainPrevIL,
    .detalle-imagenListado.active #mainNextIL{
        display: none;
    }
 
<?php } ?>

.detalle-imagenListado #imagenListado a{
    width: 100%;
    height: 100%;
    background: transparent !important;
}
.detalle-imagenListado #imagenListado img{
    max-width: 100%;
    position: absolute;
    left: 0;
    right: 0;
    margin:auto;
}
.detalle-imagenListado .lupaImg{
    opacity: 0.6;
    width: 80px;
    height: 80px;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin:auto;
    background-color: rgba(255,255,255,0.6);
    z-index: 300;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px; 
    transition: all 300ms linear 0s;
}
.detalle-imagenListado .lupaImg.active,
.detalle-imagenListado .lupaImg:hover{
    opacity: 1;
    transition: all 300ms linear 0s;
}
.detalle-imagenListado .lupaImg i{
    color: #444;
    font-size: 40px;
    text-align: center;
    margin-top: 20px!important;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    margin:auto;
}
.detalle-imagenListado.active #mainPrevIL,
.detalle-imagenListado.active #mainNextIL{
    opacity: 1;
    transition: all 450ms linear 0s;
}



.side-detalle {
    width: 30%;
    float: right;
    position: relative;
}


/*====================
AdaptaciÃ³n Fancybox  */


</style>
