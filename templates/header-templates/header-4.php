<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$classes=$container;
if($redux_demo['sticky-menu'])$classes.=" sticky-top";
if($redux_demo['transparent-header'])$classes.=" fw-transparent-header";
$classes.=" py-".$redux_demo['header-padding'];
?>

<header class="fw_header_middle <?php echo esc_attr( $classes ); ?> navbar flex-column flex-md-row align-items-center p-3 px-md-4 d-none d-md-flex">
      	<?php echo fastway_getLogo();?>
     
		<div class="d-flex col-4 align-items-center">
      	<?php 
      	if($redux_demo['header-headerwidget-switch']){
      	echo do_shortcode(stripslashes(htmlspecialchars_decode( $redux_demo['header-headerwidget-text'].'<style>'.$redux_demo['css_editor-header-headerwidget'].'</style>' )));
      	}
      	?>
     	</div>
		
</header>
