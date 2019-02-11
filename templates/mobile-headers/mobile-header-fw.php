<?php 
echo fw_header_html_mobile();
?>
    <div class="mobile-menu-overlay ">&nbsp;</div>
    <div class="menu-madre-mobile">
        <div class="sub-menu-mobile"> 
        <div class="telefono-header t1 txt-16 text-left">      
          <?if(!empty(fw_company_data("phone"))){?>   
          <a href="<?echo fw_company_data("phone",true)?>" rel="nofollow" title="Llamar" class="btn" style="color:white !important;background:#307BFF;font-size:20px !important;"><i class="fal fa-phone" style="color:white;" aria-hidden="true"></i> Llamar Ahora</a><br>
          <?}if(!empty(fw_company_data("whatsapp"))){?>
          <a href="<?echo fw_company_data("whatsapp",true)?>" rel="nofollow" title="WhatsApp" class="btn" style="color:white !important;font-size:20px !important;background:#2AD348 !important;"><i class="fab fa-whatsapp" style="color:white !important;"></i> Consultar</a>
          <?}?>
        </div>
        <div class="separa-menu-mobile">&nbsp;</div>
   
        <?php echo fw_menu_vertical("mobile"); 
        if(fw_theme_mod('fw-quicklinks'))quicklinks();?>
      </div>
    </div>
   

    <div class="collapse" id="navbarsExample02">
      <?php echo fw_search_form(3);?>
    </div>
</div>
