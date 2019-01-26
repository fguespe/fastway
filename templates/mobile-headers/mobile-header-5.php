<?php //CSB y elementos
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
      <div class="container text-center align-items-around py-3"><?php echo fw_logo();?></div>
      <style>
      
      </style>
      <div class="container d-flex justify-content-around py-2 iconosmenumobile px-4">
          <button class="navbar-toggler fw-header-icon toggler btn-bars-mobile" type="button"><i class="fal fa-bars"></i></button>
          <button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="fal fa-search"></i></button>
          <?php echo fw_shoppingCart("link");?>
          <?php echo fw_userAccount();?>
      </div>
      <div class="menu-madre-mobile">
        <div class="sub-menu-mobile"> 
        <div class="telefono-header t1 txt-16 text-left">         
          <a href="<?echo fw_company_data("phone",true)?>" rel="nofollow" title="Llamar" class="btn" style="color:white !important;background:#307BFF;font-size:20px;"><i class="fa fa-phone" style="color:white;" aria-hidden="true"></i> Llamar Ahora</a><br>
          <?if(!empty(fw_company_data("whatsapp"))){?>
          <a href="<?echo fw_company_data("whatsapp",true)?>" rel="nofollow" title="WhatsApp" class="btn" style="color:white !important;font-size:20px !important;background:#2AD348 !important;"><i class="fab fa-whatsapp" style="color:white !important;"></i> Consultar</a>
          <?}?>
        </div>
        <div class="separa-menu-mobile">&nbsp;</div>
        <?php echo fw_menu_vertical("mobile"); 
        if(fw_theme_mod('fw-quicklinks'))quicklinks();?>
      </div>
    </div>

    <div class="collapse navbar-collapse" id="navbarsExample02">
      <?php echo fw_search_form(3);?>
    </div>
     
</div>
