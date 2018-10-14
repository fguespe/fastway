
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

<div class="container" style="max-width: 1200px;">
  <div class="swiper-products-rel over-hidden container relative swiper-container-horizontal">
    <div class="swiper-wrapper">

  <?php 

  while ( $products->have_posts() ) : 
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
 <script>
     var ProductSwiper = new Swiper('.swiper-products-rel', {
            pagination: '.swiper-prod-rel-pagination',
            nextButton: '.swiper-prod-rel-next',
            prevButton: '.swiper-prod-rel-prev',
            slidesPerView: 5,
            slidesPerGroup:5,
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



  