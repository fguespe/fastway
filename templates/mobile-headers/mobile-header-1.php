<?php 
global $header_middle_mobile;
?>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?> ">
      <div class="col-5 " style="padding: 0px;"><?php echo fastway_getLogo();?></div>
      <div class="col-5 align-items-center" style="padding: 0px;"><div id="mobileicons" style="display: none;"><?php if(fw_theme_mod('fw-quicklinks'))quicklinks();?></div></div>
      <div class="col-1 align-items-center">
        <button class="navbar-toggler fw-header-icon toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown2" aria-controls="navbarNavDropdown2" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
      </div>
      
      
      <div class="collapse navbar-collapse" id="navbarNavDropdown2">
      
           <?php wp_nav_menu(
          array(
            'theme_location'  => 'primary',
            'container_class' => 'align-items-center',
            'container_id'    => '',
            'menu_class'      => 'navbar-nav ml-auto',
            'fallback_cb'     => '',
            'menu_id'         => 'main-menu-mobile',
            'depth'           => 2,
            'walker'          => new fw_Navwalker(),
          )
        ); 
            if(fw_theme_mod('fw-quicklinks'))quicklinks();
            ?>

        </nav>
      </div>
     
     
      
</div>