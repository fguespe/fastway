<?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);

?>
<style type="text/css">
  .vc_row-fluid{
    max-width:1440px;
  }
</style>
<div id="owl-slider">
<div class="owl-carousel owl-theme <?=$rand?>-owl">
	<?php 
	while ( $products->have_posts() ) : 
        
        $products->the_post(); 
        echo '<div class="item">';
        wc_get_template_part( 'content', 'product' ); 
        echo '</div>';  	
	endwhile; 
    ?>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.<?=$rand?>-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsiveClass: true,
        responsive: {
          0: {
            items: 2,
            nav: true,
          },
          600: {
            items: 3,
            nav: true,
          },
          1000: {
            items: <?=$columns?>,
            loop: false,
            nav: true,
            margin: 20
          }

        }
      });
});
</script>