<?php

if( !function_exists( 'fw_sidebarMenu' ) ) {
    
    function fw_sidebarMenu(){
        if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
        global $woocommerce,$redux_demo;
        $style=$redux_demo['cart-style'];?>
        <button id="sidebarHeaderInvoker" class="navbar-toggler d-block btn u-hamburger u-hamburger--white ml-auto"
                  aria-controls="sidebarHeader"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-unfold-event="click"
                  data-unfold-hide-on-scroll="false"
                  data-unfold-target="#sidebarHeader"
                  data-unfold-type="css-animation"
                  data-unfold-animation-in="fadeInRight"
                  data-unfold-animation-out="fadeOutRight"
                  data-unfold-duration="500">
            <span id="hamburgerTrigger" class="u-hamburger__box">
              <span class="u-hamburger__inner"></span>
              
          <span class="fa fa-bars u-btn--icon__inner"></span>
            </span>
          </button>

            
<aside id="sidebarHeader" class="u-sidebar u-sidebar--right u-unfold--css-animation u-unfold--hidden" aria-labelledby="sidebarHeaderInvoker">
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

                  <?php wp_nav_menu(
                  array(
                        'theme_location'  => 'primary',
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

          <!-- SVG Background Shape -->
          <div class="position-absolute-bottom-0 z-index-minus-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               viewBox="0 0 300 126.5" style="margin-bottom: -0.375rem; enable-background:new 0 0 300 126.5;" xml:space="preserve">
              <path class="u-fill-primary" opacity=".6" d="M0,58.9c0-0.9,5.1-2,5.8-2.2c6-0.8,11.8,2.2,17.2,4.6c4.5,2.1,8.6,5.3,13.3,7.1C48.2,73.3,61,73.8,73,69
                c43-16.9,40-7.9,84-2.2c44,5.7,83-31.5,143-10.1v69.8H0C0,126.5,0,59,0,58.9z"/>
              <path class="u-fill-primary" d="M300,68.5v58H0v-58c0,0,43-16.7,82,5.6c12.4,7.1,26.5,9.6,40.2,5.9c7.5-2.1,14.5-6.1,20.9-11
                c6.2-4.7,12-10.4,18.8-13.8c7.3-3.8,15.6-5.2,23.6-5.2c16.1,0.1,30.7,8.2,45,16.1c13.4,7.4,28.1,12.2,43.3,11.2
                C282.5,76.7,292.7,74.4,300,68.5z"/>
              <circle class="u-fill-danger" cx="259.5" cy="17" r="13"/>
              <circle class="u-fill-primary" cx="290" cy="35.5" r="8.5"/>
              <circle class="u-fill-success" cx="288" cy="5.5" r="5.5"/>
              <circle class="u-fill-warning" cx="232.5" cy="34" r="2"/>
            </svg>
          </div>
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