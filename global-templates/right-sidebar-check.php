<?php 
// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = fw_theme_mod('layout-main');
if(is_plugin_active("woocommerce/woocommerce.php")){
  if(is_shop() || is_product_category())$sidebar_pos = fw_theme_mod('shop-layout');
  else if(is_product())$sidebar_pos = fw_theme_mod('product-page-layout');
}

if ( (is_home() && ! is_front_page() ) || is_archive() || is_singular()){
  $sidebar_pos = fw_theme_mod('layout-blog');
}
?>

<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

  <?php get_sidebar( 'right' ); ?>

<?php endif; ?>
