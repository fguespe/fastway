<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$classes=$container;
if($redux_demo['sticky-menu'])$classes.=" fixed-top";
if($redux_demo['transparent-header'])$classes.=" fw-transparent-header";
$classes.=" py-".$redux_demo['header-padding'];
?>
<div class="d-none d-md-block">
<div class="fw_header_middle d-flex flex-md-row <?php echo esc_attr( $classes ); ?> d-none d-md-flex">
      <div class="col-2"><?php echo fastway_getLogo();?></div>
      <div class="col-8 d-flex flex-md-row ">
      	<?php wp_nav_menu(
		array(
					'theme_location'  => 'primary',
					'container_class' => 'navbar-collapse',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav d-flex flex-row  justify-content-around',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'walker'          => new understrap_WP_Bootstrap_Navwalker(),
				)
		); 
		?>

	</div>
</div>
</div>
