<!-- EL de bidcom -->
<?
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );  // Removes the reviews tab
    return $tabs;
}
add_action( 'woocommerce_after_single_product_summary', 'comments_template', 50 );

?>

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
                    <a href="<?php echo $url;?>" data-fancybox="gallery" class="d-flex align-items-center" style="background-color: white; position: absolute; top: 0px; left: 0px; opacity: 1;">
                      <img itemprop="image" src="<?php echo $url;?>" width=400 height="auto">
                      <div class="lupaImg"><i class="fa fa-search-plus"></i></div>
                    </a>
                <?}
                foreach(fw_get_yt_videos() as $coin){
                    $url = $coin[1]; ?>
                   <div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject" style="width: 100%; background-color: rgb(0, 0, 0); position: absolute; top: 0px; left: 0px; display: none; z-index: 1;">
                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?=$url?>?rel=0" frameborder="0" allowfullscreen=""></iframe>
                    </div>

               <? }?>
               
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
            <a target="_blank" data-toggle="" data-target="" class="fancybox btn-medios block btn-mobile t2 segura">
	            <div class="row">
	                <div class="col-2 text-left v-top txt-28"><i class="far fa-shield-alt"></i></div>
	                <div class="col-10 text-left calcular-costo-envio">
	                	<h4 class="">Compra Segura</h4>
	                    <span class="">Garantía de Fabrica</span>
	                </div>
                </div>
            </a>
            <a target="_blank" data-toggle="" data-target="" class="fancybox btn-medios block btn-mobile t2 prueba">
	            <div class="row">
	                <div class="col-2 text-left v-top txt-28"><i class="fal fa-credit-card"></i></div>
	                <div class="col-10 text-left calcular-costo-envio">
	                	<h4 class="">Beneficio incluído</h4>
	                    <span class="">10 días de prueba</span>
	                </div>
                </div>
            </a>
            <a target="_blank" data-toggle="modal" data-target="#modalMediosPago" class="fancybox btn-medios block btn-mobile pagos">
	            <div class="row">
	                <div class="col-2 text-left v-top txt-28"><i class="fal fa-gift"></i></div>
	                <div class="col-10 text-left calcular-costo-envio">
	                	<h4 class="">Ver cuotas y medios de pago</h4>
	                    <span class="">(Chequear promociones vigentes)</span>
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
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    height: auto;
    left: 0;
    position: relative;
    margin-bottom: 10px;
}
#paginationIL {
    float: left ;
    width: 20% ;
}
#paginationIL li {
    list-style: none;
    display: block;
    opacity: 0.4;
    margin: 0 auto ;
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
display: none ;
}
.detalle-imagenListado {
 width: 100% ;
}
}


@media (max-width: 760px){
.detalle-imagenListado {
height: auto ;
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


.detalle-imagenListado #imagenListado a{
    width: 100%;
    height: 100%;
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
    margin:auto;
    margin-top: 20px;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
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

.fw_single_product .precio {
    line-height: 45px;
    font-weight: 300;
font-size:45px ;
display: block;
    margin-bottom: 0px;
text-align:center ;
}
.precioproducto{
text-align:center;
}


.fw_single_product .precioproducto .tachado{
		text-align:center;
		font-size:18px;
    margin-bottom:20px;
}
		
.fw_single_product .precio-anterior {
    color: #999;
    font-size: 15px;
    line-height: 13px;
    padding: 5px 0 0 5px;
		text-align:center ;
}



@media (min-width: 799px) {
.woocommerce-product-gallery {
  width:90% ;
}
}


.fw_single_product .woocommerce-product-gallery a img{
max-width:400px ;
max-height: 400px ;
margin:0 auto ;
max-width: 100%;
}





.fw_single_product .btn-medios {
		display:block ;
 text-decoration: none;
padding: 2% 0 0% 2%;
border-top: 1px solid #dfdfdf ;
margin-top:25px;
}
a.btn-medios:hover{
        text-decoration: none;        
 }
.btn-medios h4{
        font-size: 18px;
        margin:0px;
}
.btn-medios .azul{
        font-size: 14px;
}
    .short-description.fixed .cuadro-tarjeta, .short-description.fixed .btn-medios {
        display: none;
    }
.txt-28 {
    font-size: 28px;
}

.fw_single_product .summary .quantity{
		display:none;
}
.woocommerce div.product form.cart .button{
		float:none ;
		display:block;
		margin:0 auto ;

}
.fw_single_product .stock{
		text-align:center;
}
.fw_single_product .single_add_to_cart_button{
		background: #8c3482 ;
        color:white;
		border:0px ;
		font-weight:bold;
}



.compra-segura,
.compra-segura a {
margin-top:20px ;
	font-size:13px ;
}
.fw_single_product .compra-segura a,
.fw_single_product .compra-segura .fa{
		color:orange;
		font-size:15px ;
		line-height:20px;
}

.fw_single_product .compra-segura i {
 color: #999;
font-size: 17px ;
}
.fw_single_product{
    background: #fff none repeat scroll 0 0;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    padding: 1% 2% 2%;
    -webkit-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.1);
    -moz-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.1);
    box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.1);
}


@media (min-width: 799px) {

.fw_single_product .side-detalle{
    width: 30% ;
    float: right ;
    position: relative ;
}
.fw_single_product .fw_gallery{
   width: 67%;
		padding-right: 1%;
float:left;
}
.woocommerce-product-gallery{
width:100% ;
}
		.fw_single_product .onsale{
				display:none;
		}
.single-product div.product .woocommerce-product-gallery .flex-viewport {
width: 80% ;
float: right;
}

.single-product div.product .woocommerce-product-gallery li{
width:100% ;
padding-left:0px ;;
padding-right:60%;
}


}
.fw_single_product .product_title{
		font-size:22px ;
		line-height:24px ;
		font-weight:400 ;
		margin-bottom:10px ;
}



@media (max-width: 992px){
#paginationIL {
display: none ;
}
.detalle-imagenListado {
 width: 100% ;
}
}
@media (max-width: 760px){
.detalle-imagenListado {
height: auto ;
}
}

#imagenListado {
height: 400px;
text-align: center;	
}
@media (max-width: 799px) {
#imagenListado {
height: 400px;
width: 100%;
text-align: center;
margin-bottom:20px;
}
}

.content-area{
padding:0px;
}





/*break column*/
#paginationIL {
  display:flex !important;
  flex-direction:column;
  flex-wrap:wrap;
  height:400px !important;
  width:0;
}
@media (max-width: 799px) {
#paginationIL {
  display:none !important;
}  
}
/* demo show */
#paginationIL  {
  padding:0;
  counter-reset:lis;
}
#paginationIL  li {
  display:block;
  width:60px;
}
#mainNextIL,#mainPrevIL{
    z-index:999;
}


</style>
