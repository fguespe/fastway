<?php 
global $header_middle_mobile;
?>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?> ">
      <div class="col-5 " style="padding: 0px;"><?php echo fw_logo();?></div>
      <div class="col-5 align-items-center" style="padding: 0px;"><div id="mobileicons" style="display: none;"><?php if(fw_theme_mod('fw-quicklinks'))quicklinks();?></div></div>
      <div class="col-1 align-items-center">
        <button class="navbar-toggler fw-header-icon toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown2" aria-controls="navbarNavDropdown2" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
      </div>
      
      
      <div class="collapse navbar-collapse" id="navbarNavDropdown2">
      
           
            <?php echo fw_menu_vertical("mobile"); 
            if(fw_theme_mod('fw-quicklinks'))quicklinks();
            ?>

        </nav>
      </div>
     
     
      
</div>