<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$sticky="";
if($redux_demo['sticky-menu'])$sticky="sticky-top";
$classes=$container." ".$sticky." d-md-none";
?>

<div class="fw_header_middle <?php echo esc_attr( $classes ); ?> navbar flex-column flex-md-row align-items-center p-3 px-md-4">
      <?php echo fastway_getLogo();?>
     
		
</div>
