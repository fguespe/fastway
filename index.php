<?php
get_header();

$container   = fw_theme_mod('container-main');
?>


<div class="wrapper" id="index-wrapper">
	
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

	

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
				<header class="page-header">

		<?php if(fw_theme_mod('fw_blog_title_switch')){ ?>
		<?php echo '<h1 class="page-title">'.wp_title('').'</h1>'; ?></h1>
		<?php } ?>

	</header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>

					<?php 
					if(fw_theme_mod('fw_blog_columns')==1){
						echo fw_recentposts_ver(); 
					}else{

						echo fw_recentposts_hor(); 
					}
					?>
				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
		

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
