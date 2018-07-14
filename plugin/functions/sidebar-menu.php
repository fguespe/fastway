<?php

if( !function_exists( 'fw_sidebarMenu' ) ) {
    
    function fw_sidebarMenu(){
        $style=$redux_demo['cart-style'];?>
       <button id="sidebarHeaderInvoker" class="navbar-toggler d-block btn u-hamburger u-hamburger--white ml-auto"
                  aria-controls="sidebarHeader"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-unfold-event="click"
                  data-unfold-hide-on-scroll="false"
                  data-unfold-target="#sidebarHeader"
                  data-unfold-type="css-animation"
                  data-unfold-animation-in="fadeInLeft"
                  data-unfold-animation-out="fadeOutLeft"
                  data-unfold-duration="500">
                <span class="fa fa-bars u-btn--icon__inner"></span>
            </span>
          </button>

            
<aside id="sidebarHeader" class="u-sidebar u-sidebar--left u-unfold--css-animation u-unfold--hidden" aria-labelledby="sidebarHeaderInvoker">
    <div class="u-sidebar__scroller">
      <div class="u-sidebar__container">
        <div class="u-header-sidebar__footer-offset">
          <!-- Toggle Button -->
          <div class="d-sm-none position-absolute-top-right-0 z-index-2 pt-4 pr-7">
            <button type="button" class="close ml-auto"
                    aria-controls="sidebarHeader"
                    aria-haspopup="true"
                    aria-expanded="false"
                    data-unfold-event="click"
                    data-unfold-hide-on-scroll="false"
                    data-unfold-target="#sidebarHeader"
                    data-unfold-type="css-animation"
                    data-unfold-animation-in="fadeInLeft"
                    data-unfold-animation-out="fadeOutLeft"
                    data-unfold-duration="500">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- End Toggle Button -->

          <!-- Content -->
          <div class="js-scrollbar u-sidebar__body">
            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
              <!-- Logo -->
              <?php echo fastway_getLogo();?>
          
              <!-- End Logo -->

              <!-- List -->
              
              <?php 
              wp_nav_menu(
              array(
                    'theme_location'  => 'mobile',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'u-header-collapse__nav',
                    'fallback_cb'     => '',
                    'menu_id'         => 'headerSidebarList',
                    'walker'          => new fw_Navwalker('sidebar-1'),
                  )
              ); 
              ?>
                <!-- End Starter Section -->
             
              <!-- End List -->
           
          </div>
          <!-- End Content -->
        </div>

        <!-- Footer -->
        <div class="u-header-sidebar__footer">
          <ul class="list-inline mb-0">
            
          </ul>

          
          <!-- End SVG Background Shape -->
        </div>
        <!-- End Footer -->
      </div>
    </div>
  </aside>
       <?php
          
      
    }
}


?>