<?php
global $redux_demo,$header_middle;

?>
<div class="<?php echo esc_attr( $header_middle ); ?> ">
      	<?php echo fastway_getLogo();?>
     
		<div class="d-flex col-4 align-items-center">
      	<?php 
      	if($redux_demo['header-headerwidget-switch']){
      	echo do_shortcode(stripslashes(htmlspecialchars_decode( $redux_demo['header-headerwidget-text'].'<style>'.$redux_demo['css_editor-header-headerwidget'].'</style>' )));
      	}
      	?>
     	</div>
		
</header>
