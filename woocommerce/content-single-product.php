<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_single_product' );

global $product;
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$single_classes=" fw_single_product ";

?>
<div <?php post_class($single_classes); ?>>
<!-- EL de bidcom -->
<?
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
                <div class="swiper-single over-hidden relative">
                    <div class="swiper-wrapper clear-ul">

                        <?//fw_product_gallery($product);
                        $fotos=array();
                        array_push($fotos,intval(get_post_thumbnail_id( $product->id )));
                        $fotos=array_merge($fotos,$product->get_gallery_attachment_ids());
                       
                        $index=0;
                        foreach ($fotos as $ids) {
                            echo '<div class="swiper-slide">';
                            $url=wp_get_attachment_url( $ids);
                            echo '<a href='.$url.' data-fancybox="gallery" class="d-flex align-items-center" style="background-color: white; position: absolute; top: 0px; left: 0px; opacity: 1;">
                                <img itemprop="image" src="'.$url.'" width=400 height="auto">
                                <div class="lupaImg"><i class="fa fa-search-plus"></i></div>
                            </a>';
                            echo '</div>';
                            if($index==0)$claseactive="active";
                            else $claseactive='';
                            $ul.= '
                            <li class="lithumb c'.$index.' '.$claseactive.'">
                                <a class="thumb " href="javascript:slideTo('.$index.')">
                                    <img  src="'.$url.'" width="50">
                                </a>
                            </li>';
                            $index++;
                        }?>
                    </div>
                    
                    <div class="swiper-prev swiper-single-prev"><i class="fa fa-angle-left"></i></div>
                    <div class="swiper-next swiper-single-next"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
        </div>

<script>
   
var swiper = new Swiper(".swiper-single", {
    navigation: {
        nextEl: ".swiper-single-next",
        prevEl: ".swiper-single-prev",
    },   
    paginationClickable: true,
    spaceBetween: 30,
    centeredSlides: true,
    loop: true,
    on: {
        slideChange: function(){
            var val=this.activeIndex-1;
            jQuery('.lithumb').removeClass('active');
            jQuery('.lithumb.c'+val).addClass('active');
        },
    },
    autoplay: { delay: 4500, },
    autoplayDisableOnInteraction: true,
    slidesPerView: 1
});
function slideTo(val){
    swiper.slideTo(val+1, 500);
}

    
</script>
       
         <ul id="paginationIL" class="d-none d-sm-block"><?=$ul?></ul>
  </div>
    
  <div class="summary col-md-4">
      <?
      add_filter('woocommerce_get_price_html', 'fw_price_html1', 10, 2 );
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

<div class="related" style="max-width: 1200px;">
<h4 class="titulo">Quienes vieron este producto también compraron</h3>
        
  <div class="swiper-related over-hidden relative swiper-container-horizontal">
    <div class="swiper-wrapper">
        <?fw_single_related($product);?>
    </div>

    <div class="swiper-prev swiper-prod-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-prod-next"><i class="fa fa-angle-right"></i></div>
  </div>
</div>
<script>
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
</script>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
