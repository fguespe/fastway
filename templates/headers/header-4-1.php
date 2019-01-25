
<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
      <div class="row">
        <div class="col-4"></div>
        
        <div class="col-4 form-row align-items-center" >
            <?php echo fw_logo();?> 
        </div>    
        <div class="col-4 form-row align-items-center" >
        </div> 
    </div>
  </div>
</div>

<!-- Nav -->
<div class="<?php echo esc_attr( $header_bottom ); ?> align-items-center justify-content-center">
<nav class="navbar navbar-expand-md align-items-center">
    <!-- Logo -->
    <?php echo fw_menu("primary"); ?>
</nav>
</div>