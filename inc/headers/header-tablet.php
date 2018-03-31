<?php
/**
 * Package: TheShopier.
 * User: kinhdon
 * Date: 11/28/2015
 * Vertion: 1.0
 */
?>
<?php
$sidebar_name = "header-top-widget-area-mb";
if( is_active_sidebar( $sidebar_name ) ):?>
<div class="nth_header_top header-tablet-top visible-xs visible-sm">
    <div class="container">
        <div>
            <ul class="widgets-sidebar">
                <?php dynamic_sidebar( $sidebar_name ); ?>
            </ul>
        </div>
    </div>
</div>
<?php endif;?>

<div class="nth_header_middle header-tablet-middle visible-xs visible-sm">
    <div class="container">
        <div class="row">
            <!--<div class="visible-xs nth-phone-menu-icon"><i class="fa fa-bars"></i></div>-->
            <div class="col-sm-12"><?php theshopier_getLogo();?></div>
            <div class="col-sm-12 text-right">
                <div class="nth-tini-wrapper"><?php theshopier_login_form();?></div>
                <div class="nth-tini-wrapper"><?php theshopier_shoppingCart();?></div>
            </div><!-- .col-sm-18 -->
        </div>
    </div>
</div>

<div class="nth_header_bottom header-tablet-bottom visible-xs visible-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 nth-menu-vertical">
                <div class="nth-menu-button">
                    <div class="mobmenu-active-wrapper">
                        <a id="c-button--push-left" role="button" class="active-push-out">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="tb-search-wrapper">
                        <span id="searchIconActiveId" data-form=".nth-searchform" class="nth-icon icon-nth-search"></span>
                        <div class="tb-search-inner"><?php theshopier_search_form(); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-16">
                <div class="hidden-xs nth-menu-wrapper">
                    <?php if ( has_nav_menu( 'primary-menu' )) {
                        wp_nav_menu( array(
                            'container_class' => 'main-menu text-right pc-menu animated',
                            'theme_location' => 'primary-menu',
                            'walker' => new Theshopier_Mega_Menu_Frontend(),
                            'items_wrap' => '<ul class="%1$s %2$s">%3$s</ul>'
                        ) );
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
