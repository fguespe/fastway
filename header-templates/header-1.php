<?php
/**
 * Package: TheShopier.
 * User: kinhdon
 * Date: 10/31/2015
 * Vertion: 1.0
 */

global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$sticky="";
if($redux_demo['sticky-menu'])$sticky="sticky-top";
$classes=$container." ".$sticky;
?>

<header class="fw_header_middle <?php echo esc_attr( $classes ); ?> navbar flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow d-none d-md-flex">
      <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
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
</header>
