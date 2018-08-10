<?php global $redux_demo,$header_container,$header_middle,$header_container; ?>
<div class="<?php echo esc_attr( $header_middle ); ?> ">
	<div  class="d-flex <?php echo esc_attr( $header_container ); ?>">
      
      	<?php echo fastway_getLogo();?>
     
		<div class="d-flex col align-items-center">
      	<?php 
      	if($redux_demo['header-headerwidget-switch']){
      	echo do_shortcode(stripslashes(htmlspecialchars_decode( $redux_demo['header-headerwidget-text'].'<style>'.$redux_demo['css_editor-header-headerwidget'].'</style>' )));
      	}
      	?>
     	</div>
		
	</div>
</header>
