<?php

$heading_start = '<h3 class="heading-title">'.$title.'</h3>';
?>
<?php if( strlen( $title ) > 0 ):?>
<?php echo $heading_start;?>
<?php endif;?>	

<div id="owl-slider">
<div class="owl-carousel owl-theme">
	<?php 
	$i=0;
	$ultimo=0;
	while ( $products->have_posts() ) : $products->the_post(); 

        echo '<div class="item">';
    	wc_get_template_part( 'content', 'product' ); 
        echo '</div>';		
	endwhile; 
    ?>
</div>
</div>

<style type="text/css">
#owl-slider img{height:auto ;}
#owl-slider .owl-nav .owl-prev, 
#owl-slider .owl-nav .owl-next {
    color: black !important;;
    font-size: 20px;
    margin-top: -20px;
    position: absolute;
    top: 50%;
    text-align: center;
    line-height: 39px;
    opacity: 0;
    border:1px solid black;
    width: 40px;
    height: 40px;
    border-radius:40px;
}
#owl-slider .owl-nav .owl-prev{
    left: 0%;
    -webkit-transition: 0.4s;
    -moz-transition: 0.4s;
    -o-transition: 0.4s;
    -ms-transition: 0.4s;
}
#owl-slider .owl-nav .owl-next {
    right: 0%;
    -webkit-transition: 0.4s;
    -moz-transition: 0.4s;
    -o-transition: 0.4s;
    -ms-transition: 0.4s;
}
#owl-slider:hover .owl-nav .owl-next{
    right: 2%;
    -webkit-transition: 0.4s;
    -moz-transition: 0.4s;
    -o-transition: 0.4s;
    -ms-transition: 0.4s;
    opacity: 1;
}
#owl-slider:hover .owl-nav .owl-prev{
    left: 2%;
    -webkit-transition: 0.4s;
    -moz-transition: 0.4s;
    -o-transition: 0.4s;
    -ms-transition: 0.4s;
    opacity: 1;
}
#owl-slider:hover .owl-nav .owl-next:hover,
#owl-slider:hover .owl-nav .owl-prev:hover{
    color:black !important;

}
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
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
            items: 6,
            loop: false,
            nav: true,
            margin: 20
          }

        }
      });
});
</script>