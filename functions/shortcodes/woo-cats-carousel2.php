
 <style>

    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      font-size: 18px;
      background: #fff;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>
  <?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);

?>

<div class="container carousel" style="max-width: 1200px;">
  <div class="swiper-cats-<?=$rand?> over-hidden container relative swiper-container-horizontal">
    <div class="swiper-wrapper">

  <?php 

  foreach ($terms as $term) {
            $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ); 
            $image = wp_get_attachment_url( $thumbnail_id ); 
            $link = get_term_link($term);
            echo '<div class="swiper-slide">';
            echo '<a href="'.$link.'" ><div class="item product-category">';
            echo '<img src="'.$image.'" width="300" height="300"/>';
            echo '<h2 class="woocommerce-loop-category__title" >'.$term->name.'</h2>';
            echo '</div></a></div>';         
    }
    ?>
</div>
<div class="swiper-prev swiper-cats-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-next swiper-cats-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
</div>
</div>
 <script>
     var ProductSwiper = new Swiper('.swiper-cats-<?=$rand?>', {
            //pagination: '.swiper-prod-rel-pagination',
            nextButton: '.swiper-cats-<?=$rand?>-next',
            prevButton: '.swiper-cats-<?=$rand?>-prev',
            slidesPerView: <?=$columns?>,
            slidesPerGroup:<?=$columns?>,
            paginationClickable: true,
            spaceBetween: 20,
            loop: true,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });
  </script>