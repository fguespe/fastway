<?php 
global $header_middle_mobile;
?>
<style type="text/css">

  .fw_header_middle.mobile i{
    font-size:24px !important;
}

  .fw_header_middle.mobile .col-3:nth-child(1){
        padding:0px
    }

</style>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?>  align-items-center">
      <div class="col-3 d-flex justify-content-around">
          <button class="navbar-toggler fw-header-icon toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
          <button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-search"></i></button>
          
      </div>
      <div class="col-6 text-center align-items-center"><?php echo fw_logo();?></div>
      <div class="col-3 text-right align-items-center"><?php echo fw_shoppingCart();?></div>
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <nav class="navbar navbar-expand-md ">
            <?php echo fw_menu_vertical("mobile"); 
            if(fw_theme_mod('fw-quicklinks'))quicklinks();
            ?>
            </nav>
          </div>
           <div class="collapse navbar-collapse" id="navbarsExample02">
          <?php echo fw_search_form(3);?>
      </div>
</div>
