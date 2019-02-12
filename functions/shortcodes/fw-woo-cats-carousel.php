
  <?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);

?>
<div class="swiper-cats-<?=$rand?> over-hidden relative">
<div class="swiper-wrapper clear-ul">

  <?php 

  foreach ($terms as $term) {
            $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ); 
            $image = wp_get_attachment_url( $thumbnail_id ); 
            $link = get_term_link($term);
            if(!is_string($link))continue;
    }
    ?>
</div>
<div class="swiper-prev swiper-cats-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-next swiper-cats-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
</div>
 <script>
     var ProductSwiper = new Swiper('.swiper-cats-<?=$rand?>', {
            navigation: {
                nextEl: '.swiper-cats-<?=$rand?>-next',
                prevEl: '.swiper-cats-<?=$rand?>-prev',
            },   
            slidesPerView: <?=$columns?>,
            slidesPerGroup:<?=$columns?>,
            paginationClickable: true,
            spaceBetween: 10,
            loop: true,autoplay: {
    delay: 4000,
  },
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });
  </script>