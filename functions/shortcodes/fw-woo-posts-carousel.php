<?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);
?>
<div id="<?=$rand?>" class="swiper-posts swiper-posts-<?=$rand?> over-hidden relative">
<div class="swiper-wrapper clear-ul">
<?php 
if(!$autoplay)$autoplay='false';
if(!$loop)$loop='false';
$cant=0;		
while ($posts->have_posts()){
    $cant++;
    $posts->the_post(); 
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumb' ); 
    $image_url = $image[0]; ?>

    <div class="swiper-slide" data-swiper-autoplay="<?php echo $slider_delay?>">
    <li class="fw_post">
    <a href="<?php echo esc_url( get_permalink($post->ID) )?>">
        <div class="foto"><img src="<?php echo $image_url; ?>" width="100%"/></div>
        <h4 class="title"><?php the_title();?></h4>
        <?php the_excerpt(); ?>
        <span class="vermas" target="_blank"><?php echo fw_theme_mod('fw_label_read_more')?> </span>
    </a>
    </li>
    </div>
  <?php

 }?>
</div>
<?php if($cant>$columns){
    
?>
<div class="swiper-prev swiper-posts-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-next swiper-posts-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
<?php } ?>
</div>
 <script>
     var postswiper2 = new Swiper('.swiper-posts-<?=$rand?>', {
            navigation: {
                nextEl: '.swiper-posts-<?=$rand?>-next',
                prevEl: '.swiper-posts-<?=$rand?>-prev',
            }, 
            slidesPerView: <?=$columns?>,
            slidesPerGroup:<?=$columns?>,
            paginationClickable: true,
            spaceBetween: 10,
            loop: <?=$loop;?>,
            touchRatio: 0 ,
            autoplay: <?=$autoplay;?>,
	        autoplayDisableOnInteraction: false,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });
  </script>



  