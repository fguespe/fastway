<?php 
global $header_container,$header_main,$header_middle;
?>
<?php do_action( 'add_topbar');?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
      <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
        <!-- Nav -->
        <nav class="navbar navbar-expand u-header__navbar py-2">
          <!-- Logo -->
          <?php echo fastway_getLogo();?>
         <!-- Button -->
          <!-- Fullscreen Toggle Button -->
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
                  data-unfold-duration="500"><i class="fa fa-bars"></i></button>
          <!-- End Button --> 
        </nav>
        <!-- End Nav -->
      </div>
</div>
</header>
 <!-- ========== HEADER SIDEBAR ========== -->
  <aside id="sidebarHeader" class="u-sidebar u-unfold--css-animation u-unfold--hidden" aria-labelledby="sidebarHeaderInvoker">
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
                    data-unfold-animation-in="fadeInRight"
                    data-unfold-animation-out="fadeOutRight"
                    data-unfold-duration="500">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- End Toggle Button -->

          <!-- Content -->
          <div class="js-scrollbar u-sidebar__body">
            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
              <!-- Logo -->
              <a class="navbar-brand u-header-sidebar__navbar-brand" href="../../html/home/index.html" aria-label="Front">
                <img src="../../assets/svg/logos/logo-vertical.svg" alt="Logo">
              </a>
              <!-- End Logo -->

              <!-- List -->
              <ul id="headerSidebarList" class="u-header-collapse__nav">
                <!-- Home Section -->
                <li class="u-has-submenu u-header-collapse__submenu">
                  <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="#headerSidebarHomeCollapse" role="button"
                     data-toggle="collapse"
                     aria-expanded="false"
                     aria-controls="headerSidebarHomeCollapse">
                    Home
                  </a>

                  <ul id="headerSidebarHomeCollapse" class="collapse u-header-collapse__nav-list"
                      data-parent="#headerSidebarContent">
                    <!-- Home - Classic -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarHomeClassicSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarHomeClassicSubNavCollapse">
                        Classic
                      </a>

                      <ul id="headerSidebarHomeClassicSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/index.html">Classic Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/classic-crypto.html">Classic Crypto</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/classic-business.html">Classic Business</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/classic-marketing.html">Classic Marketing</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/classic-consulting.html">Classic Consulting</a></li>
                      </ul>
                    </li>
                    <!-- End Home - Classic -->

                    <!-- Home - Corporate -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarHomeCorporateSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarHomeCorporateSubNavCollapse">
                        Corporate
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarHomeCorporateSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/corporate-agency.html">Corporate Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/corporate-start-up.html">Corporate Start-Up</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Home - Corporate -->

                    <!-- Home - Blog -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerHomeSidebarBlogSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerHomeSidebarBlogSubNavCollapse">
                        Blog
                      </a>

                      <!-- Links -->
                      <ul id="headerHomeSidebarBlogSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/blog-agency.html">Blog Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/blog-start-up.html">Blog Start-Up</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/blog-business.html">Blog Business</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Home - Blog -->

                    <!-- Home - Portfolio -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarHomePortfolioSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarHomePortfolioSubNavCollapse">
                        Portfolio
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarHomePortfolioSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/portfolio-agency.html">Portfolio Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/home/portfolio-profile.html">Portfolio Profile</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Home - Portfolio -->
                  </ul>
                </li>
                <!-- End Home Section -->

                <!-- Page Section -->
                <li class="u-has-submenu u-header-collapse__submenu">
                  <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesCollapse" role="button"
                     data-toggle="collapse"
                     aria-expanded="false"
                     aria-controls="headerSidebarPagesCollapse">
                    Pages
                  </a>

                  <ul id="headerSidebarPagesCollapse" class="collapse u-header-collapse__nav-list"
                      data-parent="#headerSidebarContent">
                    <!-- Page - About -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesAboutSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesAboutSubNavCollapse">
                        About
                      </a>

                      <ul id="headerSidebarPagesAboutSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/about-agency.html">About Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/about-start-up.html">About Start-Up</a></li>
                      </ul>
                    </li>
                    <!-- End Page - About -->

                    <!-- Page - Services -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesServicesSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesServicesSubNavCollapse">
                        Services
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarPagesServicesSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/services-agency.html">Services Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/services-start-up.html">Services Start-Up</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Page - Services -->

                    <!-- Page - Careers -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesCareersSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesCareersSubNavCollapse">
                        Careers
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarPagesCareersSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/careers.html">Careers</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/careers-single.html">Careers Single</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/hire-us.html">Hire Us</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Page - Careers -->

                    <!-- Page - Login -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesLoginSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesLoginSubNavCollapse">
                        Login
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarPagesLoginSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/login-simple.html">Login Simple</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/signup-simple.html">Signup Simple</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/recover-account.html">Recover Account</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Page - Login -->

                    <!-- Page - Contacts -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesContactsSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesContactsSubNavCollapse">
                        Contacts
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarPagesContactsSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/contacts-agency.html">Contacts Agency</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/contacts-start-up.html">Contacts Start-Up</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Page - Contacts -->

                    <!-- Page - Utilities -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesUtilitiesSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesUtilitiesSubNavCollapse">
                        Utilities
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarPagesUtilitiesSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/help.html">Help</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/pricing.html">Pricing</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/terms.html">Terms &amp; Conditions</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/privacy.html">Privacy &amp; Policy</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Page - Utilities -->

                    <!-- Page - Specialty -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarPagesSpecialtySubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarPagesSpecialtySubNavCollapse">
                        Specialty
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarPagesSpecialtySubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/cover-page.html">Cover Page</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/coming-soon.html">Coming Soon</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/maintenance-mode.html">Maintenance Mode</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/error-404.html">Error 404</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Page - Specialty -->
                  </ul>
                </li>
                <!-- End Page Section -->

                <!-- Works -->
                <li class="u-has-submenu u-header-collapse__submenu">
                  <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="#headerSidebarWorksCollapse" role="button"
                     data-toggle="collapse"
                     aria-expanded="false"
                     aria-controls="headerSidebarWorksCollapse">
                    Works
                  </a>

                  <ul id="headerSidebarWorksCollapse" class="collapse u-header-collapse__nav-list"
                      data-parent="#headerSidebarContent">
                    <!-- Works - Boxed Layouts -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarWorksBoxedLayoutsSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarWorksBoxedLayoutsSubNavCollapse">
                        Boxed Layouts
                      </a>

                      <ul id="headerSidebarWorksBoxedLayoutsSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/boxed-classic.html">Portfolio Classic</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/boxed-grid.html">Portfolio Grid</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/boxed-masonry.html">Portfolio Masonry</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/boxed-modern.html">Portfolio Modern</a></li>
                      </ul>
                    </li>
                    <!-- End Works - Boxed Layouts -->

                    <!-- Works - Full Width Layouts -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarWorksFullWidthLayoutsSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarWorksFullWidthLayoutsSubNavCollapse">
                        Full Width Layouts
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarWorksFullWidthLayoutsSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/fullwidth-classic.html">Portfolio Classic</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/fullwidth-grid.html">Portfolio Grid</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/fullwidth-masonry.html">Portfolio Masonry</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/fullwidth-modern.html">Portfolio Modern</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Works - Full Width Layouts -->

                    <!-- Works - Case Studies -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarWorksSinglePageSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarWorksSinglePageSubNavCollapse">
                        Single Pages
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarWorksSinglePageSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/single-page-simple.html">Single Page Simple</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/single-page-grid.html">Single Page Grid</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/single-page-masonry.html">Single Page Masonry</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Works - Case Studies -->

                    <!-- Works - Single Pages -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarWorksCaseStudiesSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarWorksCaseStudiesSubNavCollapse">
                        Case Studies
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarWorksCaseStudiesSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/case-studies-simple.html">Case Studies Simple</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/portfolio/case-studies-modern.html">Case Studies Modern</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Works - Single Pages -->
                  </ul>
                </li>
                <!-- End Works -->

                <!-- Blog -->
                <li class="u-has-submenu u-header-collapse__submenu">
                  <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogCollapse" role="button"
                     data-toggle="collapse"
                     aria-expanded="false"
                     aria-controls="headerSidebarBlogCollapse">
                    Blog
                  </a>

                  <ul id="headerSidebarBlogCollapse" class="collapse u-header-collapse__nav-list"
                      data-parent="#headerSidebarContent">
                    <!-- Blog - Classic -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogClassicSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarBlogClassicSubNavCollapse">
                        Classic
                      </a>

                      <ul id="headerSidebarBlogClassicSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/classic-left-sidebar.html">Left Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/classic-right-sidebar.html">Right Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/classic-full-width.html">Full Width</a></li>
                      </ul>
                    </li>
                    <!-- End Blog - Classic -->

                    <!-- Blog - Grid -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogGridSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarBlogGridSubNavCollapse">
                        Grid
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarBlogGridSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/grid-left-sidebar.html">Left Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/grid-right-sidebar.html">Right Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/grid-full-width.html">Full Width</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Blog - Grid -->

                    <!-- Blog - List -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogListSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarBlogListSubNavCollapse">
                        List
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarBlogListSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/list-left-sidebar.html">Left Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/list-right-sidebar.html">Right Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/list-full-width.html">Full Width</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Blog - List -->

                    <!-- Blog - Modern -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogModernSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarBlogModernSubNavCollapse">
                        Modern
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarBlogModernSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/modern-left-sidebar.html">Left Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/modern-right-sidebar.html">Right Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/modern-full-width.html">Full Width</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Blog - Modern -->

                    <!-- Blog - Masonry -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogMasonrySubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarBlogMasonrySubNavCollapse">
                        Masonry
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarBlogMasonrySubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/masonry-left-sidebar.html">Left Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/masonry-right-sidebar.html">Right Sidebar</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/masonry-full-width.html">Full Width</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Blog - Masonry -->

                    <!-- Blog - Single Article -->
                    <li class="u-has-submenu u-header-collapse__submenu">
                      <a class="u-header-collapse__submenu-nav-link u-header-collapse__nav-pointer" href="#headerSidebarBlogSingleArticleSubNavCollapse" role="button"
                         data-toggle="collapse"
                         aria-expanded="false"
                         aria-controls="headerSidebarBlogSingleArticleSubNavCollapse">
                        Single Article
                      </a>

                      <!-- Links -->
                      <ul id="headerSidebarBlogSingleArticleSubNavCollapse" class="collapse u-header-collapse__submenu-list"
                          data-parent="headerSidebarList">
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/single-article-classic.html">Classic</a></li>
                        <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/blog/single-article-simple.html">Simple</a></li>
                      </ul>
                      <!-- End Links -->
                    </li>
                    <!-- End Blog - Single Article -->
                  </ul>
                </li>
                <!-- End Blog -->

                <!-- Specialty Section -->
                <li class="u-has-submenu u-header-collapse__submenu">
                  <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="#headerSidebarSpecialtyCollapse" role="button"
                     data-toggle="collapse"
                     aria-expanded="false"
                     aria-controls="headerSidebarSpecialtyCollapse">
                    Specialty
                  </a>

                  <!-- Links -->
                  <ul id="headerSidebarSpecialtyCollapse" class="collapse u-header-collapse__nav-list"
                      data-parent="#headerSidebarContent">
                    <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/cover-page.html">Cover Page</a></li>
                    <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/coming-soon.html">Coming Soon</a></li>
                    <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/maintenance-mode.html">Maintenance Mode</a></li>
                    <li><a class="nav-link u-header-collapse__submenu-list-link py-2 px-0" href="../../html/pages/error-404.html">Error 404</a></li>
                  </ul>
                  <!-- End Links -->
                </li>
                <!-- End Specialty Section -->

                <!-- Starter Section -->
                <li class="u-header-collapse__submenu">
                  <a class="u-header-collapse__nav-link" href="../index.html">
                    Starter
                  </a>
                </li>
                <!-- End Starter Section -->
              </ul>
              <!-- End List -->
            </div>
          </div>
          <!-- End Content -->
        </div>

        <!-- Footer -->
        <footer class="u-header-sidebar__footer">
          <ul class="list-inline mb-0">
            <li class="list-inline-item pr-3">
              <a class="u-header-sidebar__footer-link" href="../../html/pages/privacy.html">Privacy</a>
            </li>
            <li class="list-inline-item pr-3">
              <a class="u-header-sidebar__footer-link" href="../../html/pages/terms.html">Terms</a>
            </li>
            <li class="list-inline-item">
              <a class="u-header-sidebar__footer-link" href="../../html/pages/help.html">
                <i class="fa fa-info-circle"></i>
              </a>
            </li>
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
        </footer>
        <!-- End Footer -->
      </div>
    </div>
  </aside>
  