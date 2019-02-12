<?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);
?>
<div class="swiper-products-<?=$rand?> over-hidden relative">
<div class="swiper-wrapper clear-ul">
<?php 
while ( $products->have_posts() ) : 
    $products->the_post(); 
    echo '<div class="swiper-slide">';
    wc_get_template_part( 'content','product' ); 
    echo '</div>';    
endwhile; 
?>
</div>
<div class="swiper-prev swiper-products-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-next swiper-products-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
</div>
 <script>
     var ProductSwiper2 = new Swiper('.swiper-products-<?=$rand?>', {
            navigation: {
                nextEl: '.swiper-products-<?=$rand?>-next',
                prevEl: '.swiper-products-<?=$rand?>-prev',
            }, 
            slidesPerView: <?=$columns?>,
            slidesPerGroup:<?=$columns?>,
            paginationClickable: true,
            spaceBetween: 10,
            loop: true,autoplay: {
    delay: 5000,
  },
	        autoplayDisableOnInteraction: false,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });
  </script>



  