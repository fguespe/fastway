<?php

woocommerce_breadcrumb();
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );  // Removes the reviews tab
    return $tabs;
}
add_action( 'woocommerce_after_single_product_summary', 'comments_template', 50 );

add_shortcode('fw_echo', 'fw_echo');
function fw_echo($atts = [], $content = null){
    echo stripslashes(htmlspecialchars_decode($content));
}

add_shortcode('fw_div_open', 'fw_div_open');
function fw_div_open($atts = [], $content = null){
    echo '<div class="'.$atts['class'].'" style="'.$atts['style'].'" >';
}
add_shortcode('fw_div_close', 'fw_div_close');
function fw_div_close($atts = [], $content = null){
    echo '</div>';
}

add_shortcode('fw_single_container', 'fw_single_container');
function fw_single_container($atts = [], $content = null){
    $class='';
    if(isset($atts['class']))$class=$atts['class'];
    echo '<div class="fw_single_product d-flex row '.$class.' ">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</div>';
}

add_shortcode('fw_single_meta', 'fw_single_meta');
function fw_single_meta(){
    woocommerce_template_single_meta();
}
add_shortcode('fw_single_title', 'fw_single_title');
function fw_single_title(){
    global $product;
    echo '<h1 class="product_title entry-title">'.$product->post->post_title.'</h1>';
    if('yes' === get_option( 'woocommerce_enable_reviews'))echo '<div class="rating" >'.fw_getfastars($product->get_average_rating()).'<a href="#reviews">'.__('Reviews','woocommerce').' </a></div>';
}
add_shortcode('fw_single_price', 'fw_single_price');
function fw_single_price(){
    global $product;
    echo '<span class="price">'.fw_price_html1(null,$product).'</span>';
}
add_shortcode('fw_summary_container', 'fw_summary_container');
function fw_summary_container($atts = [], $content = null){
    $class='';
    if(isset($atts['class']))$class=$atts['class'];
    echo '<div class="'.$class.'">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</div>';
}
add_shortcode('fw_single_cart', 'fw_single_cart');
function fw_single_cart(){
    global $product;
    if((fw_theme_mod("fw_purchases_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_purchases_visibility")==="hide")return;
    woocommerce_template_single_add_to_cart();
}

add_shortcode('fw_single_tabs','fw_single_tabs');
function fw_single_tabs(){
    remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    do_action( 'woocommerce_after_single_product_summary' );

}
add_shortcode('fw_single_related','fw_single_related');
function fw_single_related($atts){
    $atts = shortcode_atts(array('cols' => 6 ), $atts );
    $cols=$atts['cols'];


    echo '
<div class="related" style="max-width: 1200px;">
<h4 class="titulo">Quienes vieron este producto también compraron</h3>
        
  <div class="swiper-related over-hidden relative swiper-container-horizontal">
    <div class="swiper-wrapper">';

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
            echo '<div class="swiper-slide data-swiper-autoplay="'.$atts['slider_delay'].'">';
            wc_get_template_part( 'content', 'product' ); 
            echo ob_get_clean();
            echo '</div>';    
        endwhile; 
        echo'</div>

    <div class="swiper-prev swiper-prodrel-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-prodrel-next"><i class="fa fa-angle-right"></i></div>
  </div>
</div>
<script>
var ProductSwiper = new Swiper(".swiper-related", {
    slidesPerView: '.$cols.',
    spaceBetween: 10,
    loop: true,
    autoplay: true,
    navigation: {
        nextEl: ".swiper-prodrel-next",
        prevEl: ".swiper-prodrel-prev",
    },
    breakpoints: {
        // when window width is <= 320px
            900:    {slidesPerView: 2,slidesPerGroup:2},
            1000:   {slidesPerView: 3,slidesPerGroup:3},            
            1200:    {slidesPerView: 4,slidesPerGroup:4}
        }
});
</script>';
}

/*
add_shortcode('fw_single_quantity', 'fw_single_quantity');
function fw_single_quantity(){
    global $product;
    woocommerce_quantity_input( array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
    ) );
}*/

add_shortcode('fw_single_share', 'fw_single_share');
function fw_single_share(){

    echo fw_share_redes();
}

add_shortcode('fw_single_summary', 'fw_single_summary');
function fw_single_summary($atts = [], $content = null){
     
    echo '<div class="summary">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</div>';
}
add_shortcode('fw_single_gallery', 'fw_single_gallery');
function fw_single_gallery(){
    global $product;
    $clasecant='vacio';
    $loop="true";
    if(count($product->get_gallery_attachment_ids())>0)$clasecant='';
    if(!empty($clasecant)){
        $loop="false";
        
    }    echo '
    <div class="gallery '.$clasecant.'">
    <div class="detalle-imagenListado  active">
       <div id="imagenListado" style="position: relative; overflow: hidden;">
           <div class="swiper-single over-hidden relative">
               <div class="swiper-wrapper clear-ul">';

    $fotos=array();
    array_push($fotos,intval(get_post_thumbnail_id( $product->id )));
    $fotos=array_merge($fotos,$product->get_gallery_attachment_ids());
    
    $index=0;
    foreach ($fotos as $ids) {
        echo '<div class="swiper-slide">';
        $url=wp_get_attachment_url( $ids);
        echo  '<a href='.$url.' data-fancybox="gallery" class="d-flex align-items-center" style="background-color: white; position: absolute; top: 0px; left: 0px; opacity: 1;">
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
    }
    foreach(fw_get_yt_videos() as $video){
        $url = $video[1];
        echo '<div class="swiper-slide">';
        echo '<iframe width="100%" height="90%" src="https://www.youtube.com/embed/'.$url.'?rel=0" frameborder="0" allowfullscreen=""></iframe>';
        echo '</div>';
        if($index==0)$claseactive="active";
        else $claseactive='';
        $ul.= '
        <li class="lithumb c'.$index.' '.$claseactive.'">
            <a class="thumb " href="javascript:slideTo('.$index.')">
                <i class="fab fa-youtube" style="font-size:35px;width:100% !important;
                text-align:center;"></i>
            </a>
        </li>';
        
        $index++;
    }
    echo '</div>
               
               <div class="swiper-prev swiper-single-prev"><i class="fa fa-angle-left"></i></div>
               <div class="swiper-next swiper-single-next"><i class="fa fa-angle-right"></i></div>
           </div>
       </div>
    </div>
    <ul id="paginationIL" class="d-none d-sm-block">'.$ul.'</ul>
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
loop: '.$loop.',
on: {
   slideChange: function(){
       var val=this.activeIndex-1;
       jQuery(".lithumb").removeClass("active");
       jQuery(".lithumb.c"+val).addClass("active");
   },
},
autoplay: { delay: 4500, },
autoplayDisableOnInteraction: true,
slidesPerView: 1
});
function slideTo(val){
swiper.slideTo(val+1, 500);
}


</script>';
}




if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function woo_single(){
    return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_single_code'))));
}


do_action( 'woocommerce_before_single_product' );

global $product;
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>

<!-- EL de bidcom -->
<?php

woo_single();

?>

<script>
//Fix fancybox
jQuery( document ).ready(function( $ ) {
   $.fancybox.defaults.hash = false;
});
</script>

