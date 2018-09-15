<?php global $header_container,$header_middle,$header_container; ?>
<div class="<?php echo esc_attr( $header_middle ); ?> ">
	<div  class="d-flex <?php echo esc_attr( $header_container ); ?>">
      
      	<?php echo fastway_getLogo();?>
     
		<div class="d-flex col align-items-center">
      	<?php 
      	if(fw_theme_mod('header-headerwidget-switch')){
      	echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('header-headerwidget-text').'<style>'.fw_theme_mod('css_editor-header-headerwidget').'</style>' )));
      	}
      	?>
     	</div>
		
	</div>
</header>
