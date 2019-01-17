<!-- EL de bidcom -->
<?
global $product;
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );  // Removes the reviews tab
    return $tabs;
}
add_action( 'woocommerce_after_single_product_summary', 'comments_template', 50 );
$clasecant='vacio';
if(count($product->get_gallery_attachment_ids())>0)$clasecant='';

?>

<div class="container d-flex row px-0 mx-0">
	<div class="gallery col-md-8 px-0 <?=$clasecant?>">
         <div class="detalle-imagenListado  active">
            <div id="imagenListado" itemscope="" itemtype="http://schema.org/MediaObject" style="position: relative; overflow: hidden;">
                <?fw_product_gallery($product);?>
            </div>
            <div id="mainNextIL" class="swiper-next"><i class="fa fa-angle-right"></i></div>
            <div id="mainPrevIL" class="swiper-prev"><i class="fa fa-angle-left"></i></div>
         </div>

         <ul id="paginationIL" class="d-none d-sm-block"></ul>
	</div>
 	<div class="summary col-md-4">
			<?
			add_filter('woocommerce_get_price_html', 'fw_price_html1', 80, 2 );
			do_action( 'woocommerce_single_product_summary' );
			dynamic_sidebar('sp-sumary');
			echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('shop-single-product-html'))));
			echo getFinanciacion($product);
			echo fw_share_redes();
			?>
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
        <?fw_single_related($product);?>
    </div>

    <div class="swiper-prev swiper-prod-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-prod-next"><i class="fa fa-angle-right"></i></div>
  </div>
</div>



<style>
/*generales*/

.fw_single_product {
	background: #fff none repeat scroll 0 0;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	padding: 1% 2% 2%;
	-webkit-box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.1);
	box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.1);
}

.fw_single_product .content-area {
	padding: 0px;
}


/*THUMBNAILS*/

#paginationIL li {
	opacity: 0.4;
}

#paginationIL li.activeSlide {
	opacity: 1;
}

#paginationIL a {
	display: block;
	margin: 2px;
	padding: 2px 2px 0px 2px;
	border: 1px solid transparent;
}


/*break column*/

#paginationIL {
	display: flex !important;
	flex-direction: column;
	flex-wrap: wrap;
	height: 400px !important;
	width: 0;
}
.vacio #paginationIL{
	display:none !important;
}

/***** Pasador imagen detalle *****/

#imagenListado {
	height: 400px;
	text-align: center;
}

.detalle-imagenListado {
	position: relative;
	float: right;
	height: 400px;
	width: 80%;
}
/*si esta sin galeria*/
.vacio .detalle-imagenListado{
		float:none;
		width:100%;
}
.vacio .detalle-imagenListado .swiper-next,
.vacio .detalle-imagenListado .swiper-prev{
		display:none;
}

.detalle-imagenListado #imagenListado a {
	width: 100%;
	height: 100%;
}

.detalle-imagenListado #imagenListado img {
	max-width: 100%;
	position: absolute;
	left: 0;
	right: 0;
	margin: auto;
}

.detalle-imagenListado .lupaImg {
	opacity: 0.6;
	width: 80px;
	height: 80px;
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	margin: auto;
	background-color: rgba(255, 255, 255, 0.6);
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	transition: all 300ms linear 0s;
}

.detalle-imagenListado .lupaImg.active,
.detalle-imagenListado .lupaImg:hover {
	opacity: 1;
	transition: all 300ms linear 0s;
}

.detalle-imagenListado .lupaImg i {
	color: #444;
	font-size: 40px;
	text-align: center;
	margin: auto;
	margin-top: 20px;
	position: absolute;
	top: 0;
	bottom: 0;
	right: 0;
	left: 0;
}

.detalle-imagenListado.active #mainPrevIL,
.detalle-imagenListado.active #mainNextIL {
	opacity: 1;
	transition: all 450ms linear 0s;
}

@media (max-width: 992px) {
    #paginationIL{
        display: none;
    }
   .detalle-imagenListado{
	height:auto;
	width: 100%;
    }
    .detalle-imagenListado #imagenListado img{
        width: 100%;
        position: relative;
    }
}

/*precio*/

.fw_single_product .precio {
	line-height: 45px;
	font-weight: 300;
	font-size: 45px !important;
	display: block;
	margin-bottom: 0px;
	text-align: center !important;
}

.fw_single_product .precioproducto .tachado {
	text-align: center;
	font-size: 18px;
	margin-bottom: 20px;
}

.fw_single_product .precio-anterior {
	color: #999;
	font-size: 15px;
	line-height: 13px;
	padding: 5px 0 0 5px;
	text-align: center !important;
}


/*btn medios*/

.fw_single_product .btn-medios {
	display: block;
	text-decoration: none;
	padding: 2% 0 0% 2%;
	border-top: 1px solid #dfdfdf !important;
	margin-top: 25px;
	color: #444;
}

a.btn-medios:hover {
	text-decoration: none;
}

.btn-medios h4 {
	font-size: 18px;
	margin: 0px;
	color: var(--main);
}

.btn-medios .azul {
	font-size: 14px;
	color: blue;
}

.short-description.fixed .cuadro-tarjeta,
.short-description.fixed .btn-medios {
	display: none;
}

.txt-28 {
	font-size: 28px;
}

.btn-medios .col-10 span {
	font-size: 14px !important;
}

.fw_single_product .btn-medios {
	margin-top: 5px !important;
}


/*boton compra*/
.summary .single_add_to_cart_button {
      background: var(--main) ;
      color:white;
      border:0px ;
      font-size: 20px;
      font-weight:bold;
      color: white ;
      text-transform: capitalize ;
      padding: 20px ;
      padding-left: 30px;
      padding-right: 30px;
      margin: 0 auto  !important;
	float: none !important;
	display: block;
	margin: 0 auto !important;
	line-height: 5px !important;
	margin-bottom: 10px !important;
}

.fw_single_product .stock {
	text-align: center;
}
.summary .single_add_to_cart_button:before{
    content:"\f217";
    font-family: "Font Awesome 5 Pro";
    margin-right:10px;
    
}


/*titulo*/

.fw_single_product .product_title {
	font-size: 24px;
	line-height: 24px !important;
	font-weight: 200 !important;
	margin-bottom: 20px;
}


/* rating */

.fw_single_product .rating {
	margin-bottom: 5px !important;
}


/*mercadoenvios*/

.summary .col-md-12 b {
	font-size: 13px;
	font-weight: 100;
}

#btn_mp_calc_shipping {
	background-color: var(--main);
	color: white;
}

.summary .cart br {
	display: none !important;
}

</style>