<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$sticky="";
if($redux_demo['sticky-menu'])$sticky="sticky-top";
$classes=$container." ".$sticky;
?>

<header class="fw_header_middle <?php echo esc_attr( $classes ); ?> flex-column flex-md-row align-items-center p-3 px-md-4 d-none d-md-flex">
      <?php echo fastway_getLogo();?>
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
		<div><? fw_shoppingCart();?></div>
		
		<div><? fw_search_form();?></div>
		
	</nav>
</header>
