<?php
global $woocommerce_loop;

$woocommerce_loop['columns'] = $columns;

$title="JAJA";
$heading_start = '<h3 class="heading-title">'.$title.'</h3>';


?>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">

    
	<?php if( strlen( $title ) > 0 ):?>
	<?php echo $heading_start;?>
	<?php endif;?>	

	<?php 
	wc_get_template( 'loop/loop-start.php', array("item_style" => $item_style) ); 
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
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
<span class="carousel-control-next-icon " aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>


