<?php 
global $header_container,$header_main,$header_middle;
?>
<header id="header" class="u-header <?php echo esc_attr( $header_main ); ?>  u-header--bg-transparent u-header--abs-top">
<?php do_action( 'add_topbar');?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
      <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar">
          <!-- Logo -->
          <?php echo fastway_getLogo();?>
         <!-- Button -->
          <div class="ml-auto">
            <a class="btn btn-primary u-btn-primary btn-sm transition-3d-hover" href="https://themes.getbootstrap.com/product/front-multipurpose-responsive-template/" target="_blank">Buy Now</a>
          </div>
          <!-- End Button --> 
        </nav>
        <!-- End Nav -->
      </div>
</div>
</header>