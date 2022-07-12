<?php

defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
do_action( 'woocommerce_before_main_content' );
?>
<div class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

		<?php woocommerce_get_category_banner(); ?>
	<?php endif; ?>

	<?php
	do_action( 'woocommerce_archive_description' );
	?>
</div>
<?php
if ( woocommerce_product_loop() ) {
	do_action( 'woocommerce_before_shop_loop' );
	woocommerce_product_loop_start();
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
			if(fw_theme_mod('fw_search_priced_only') && is_plugin_active('woocommerce-prices-by-user-role/plugin.php')){
				$product=json_decode(get_post_meta(get_the_ID())['festiUserRolePrices'][0],true);
				$role=fw_get_current_user_role()?fw_get_current_user_role():'customer';
				$role=fw_get_current_user_role();
				if(empty(fw_get_current_user_role()))$role='guest';
				$price=$product[$role];
				error_log($role);
				if(!$price && ($role!=='administrator' && $role!=='shop_manager'  && $role!=='guest'))continue;
			}
			do_action( 'woocommerce_shop_loop' );
			wc_get_template_part( 'content', 'product' );
		}
	}
	woocommerce_product_loop_end();
	do_action( 'woocommerce_after_shop_loop' );
} else {
	do_action( 'woocommerce_no_products_found' );
}
do_action( 'woocommerce_after_main_content' );
