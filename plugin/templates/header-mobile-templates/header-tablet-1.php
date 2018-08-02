<?php 
global $header_main,$header_middle_mobile,$redux_demo;
?>
<header id="header" class="<?php echo esc_attr( $header_main ); ?>">
<div class="<?php echo esc_attr( $header_middle_mobile ); ?> ">
      <div class="col-6 " style="padding: 0px;" ><?php echo fastway_getLogo();?></div>
      <div class="col-4 align-items-center"><div id="mobileicons"><?php if($redux_demo['fw-quicklinks'])quicklinks();?></div></div>
      <div class="col-1 align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown2" aria-controls="navbarNavDropdown2" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
      </div>
      
      
      <div class="collapse navbar-collapse" id="navbarNavDropdown2">
      
           <?php wp_nav_menu(
          array(
            'theme_location'  => 'primary',
            'container_class' => 'align-items-center',
            'container_id'    => '',
            'menu_class'      => 'navbar-nav ml-auto',
            'fallback_cb'     => '',
            'menu_id'         => 'main-menu',
            'depth'           => 2,
            'walker'          => new fw_Navwalker(),
          )
        ); 
            if($redux_demo['fw-quicklinks'])quicklinks();
            ?>

        </nav>
      </div>
     
     
      
</div>
</header>