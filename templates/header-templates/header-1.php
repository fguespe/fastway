<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$classes=$container;
if($redux_demo['sticky-menu'])$classes.=" sticky-top";
if($redux_demo['transparent-header'])$classes.=" fw-transparent-header";
?>
<div class="d-none d-md-block">
<div class="fw_header_middle d-flex flex-column flex-md-row py-1 <?php echo esc_attr( $classes ); ?> d-none d-md-flex">
      <div class="my-0 mr-md-auto font-weight-normal"><?php echo fastway_getLogo();?></div>
      <nav class="navbar navbar-expand-md">
      	<?php wp_nav_menu(
		array(
					'theme_location'  => 'primary',
					'container_class' => 'navbar-collapse',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'walker'          => new understrap_WP_Bootstrap_Navwalker(),
				)
		); 
		?>
	</nav>
</div>
</div>
