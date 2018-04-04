<?php
/**
 * The template for displaying all woocommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

global $redux_demo;
$container   = $redux_demo['container-main'];

$datas = array(
	'show_bcrumb'	=> 1,
	'is_shop'		=> 1
); 
do_action( 'theshopier_breadcrumb', $datas );
?>

<div class="wrapper" id="woocommerce-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

			<?php 
				$template_name = '/archive-product.php'; 
				$args = array(); 
				$template_path = ''; 
				$default_path = untrailingslashit( plugin_dir_path(__FILE__) ) . '/woocommerce';
					if ( is_singular( 'product' ) ) {

						woocommerce_content();

			//For ANY product archive, Product taxonomy, product search or /shop landing page etc Fetch the template override;
				} 	elseif ( file_exists( $default_path . $template_name ) )
					{
					wc_get_template( $template_name, $args, $template_path, $default_path );

			//If no archive-product.php template exists, default to catchall;
				}	else  {
					woocommerce_content( );
				}

			;?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

	</div><!-- .row -->
	<!-- .footer block -->
	<?php if(is_product() && is_numeric($redux_demo['product-page-footer-block']))echo do_shortcode('[static_block_content id="'.$redux_demo['product-page-footer-block'].'"]'); ?>

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
