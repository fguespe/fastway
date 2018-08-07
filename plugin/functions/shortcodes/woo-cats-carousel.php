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
<div class="owl-carousel owl-theme <?=$rand?>-owl product-cats">
    <?php 
    foreach ($terms as $term) {
            $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ); 
            $image = wp_get_attachment_url( $thumbnail_id ); 
            $link = get_term_link($term);
            echo '<div class="item">';
            echo '<img src="'.$image.'" width="300" height="300"/>';
            echo '<a href="'.$link.'" title="'.$title.'">'.$title.'</a>';
            echo '</div>';         
    }
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