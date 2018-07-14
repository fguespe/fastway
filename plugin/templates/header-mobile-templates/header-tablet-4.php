<?php
global $header_middle_mobile;
?>
<div class="u-header__section <?php echo esc_attr( $header_middle_mobile ); ?>">
  <div id="logoAndNav" class="container">
    <!-- Nav -->
    <nav class="navbar navbar-expand u-header__navbar py-2">
      <!-- Logo -->
      
      <?php echo fastway_getLogo();?>
      <!-- End Logo -->

      <!-- Button -->
      <div class="ml-auto">
        <a class="btn btn-primary u-btn-primary btn-sm transition-3d-hover" href="https://themes.getbootstrap.com/product/front-multipurpose-responsive-template/" target="_blank">Buy Now</a>
      </div>
      <!-- End Button -->
    </nav>
    <!-- End Nav -->
  </div>
</div>
