
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
  <div class="swiper-container">
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
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
</div>
 <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 4,
      spaceBetween: 0,
      slidesPerGroup: 4,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        // when window width is <= 320px
            600:    {slidesPerView: 1,slidesPerGroup:1},
            900:    {slidesPerView: 1,slidesPerGroup:2},
            1000:   {slidesPerView: 1,slidesPerGroup:1},            
            1200:    {slidesPerView: 4,slidesPerGroup:4}
        },
    });
  </script>



  