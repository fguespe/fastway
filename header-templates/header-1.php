<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$sticky="";
if($redux_demo['sticky-menu'])$sticky="sticky-top";
$classes=$container." ".$sticky;
?>

<header class="fw_header_middle <?php echo esc_attr( $classes ); ?> navbar flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow d-none d-md-flex">
      <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo fastway_getLogo();?></h5>
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
		<div><? theshopier_shoppingCart();?></div>
		<div><?php do_shortcode('[custom-mini-cart]');?></div>
		
	</nav>
</header>
