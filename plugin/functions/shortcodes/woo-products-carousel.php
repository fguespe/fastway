<?php
global $woocommerce_loop;

$woocommerce_loop['columns'] = $columns;

$heading_start = '<h3 class="heading-title">'.$title.'</h3>';


?>
<?php if( strlen( $title ) > 0 ):?>
<?php echo $heading_start;?>
<?php endif;?>	

<div id="fwcarousel" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
	<?php wc_get_template( 'loop/loop-start.php', array("item_style" => $item_style) ); 
	$i=0;
	$ultimo=0;
	echo '<div class="carousel-item active">';
	while ( $products->have_posts() ) : $products->the_post(); 

		wc_get_template_part( 'content', 'product' ); 
		$i++;
		if ($i % $columns == 0 ){
			if($i>1){
				echo '</div>';
			}
			echo '<div class="carousel-item">';

		}

		
	endwhile;
	woocommerce_product_loop_end(); ?>

</div>
</div>
<a class="carousel-control-prev d-flex p-2 align-left" href="#fwcarousel" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#fwcarousel" role="button" data-slide="next">
<span class="carousel-control-next-icon " aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
<style type="text/css">

.carousel-control-prev-icon,
.carousel-control-next-icon{
position: absolute;
    z-index: 2;
    width: 40px !important;
    height: 40px !important;
    border-radius: 50%!important;
    background: #ffffff;
    border: 1px solid #cccccc;
    cursor: pointer;
}

.carousel-control-prev-icon::after,
.carousel-control-next-icon::after{
    position: absolute;
    top: 13px;
    content: '';
    width: 12px;
    height: 12px;
    display: block;
    border-top: 1px solid #000000;
    border-right: 1px solid #000000;
}

.carousel-control-next-icon::after{
    transform: rotate(45deg);
    
    right: 15px;
}
.carousel-control-prev-icon::after{
    transform: rotate(225deg);
    left: 15px;
    
}


</style>