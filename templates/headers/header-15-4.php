<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		  <div class="col-3 d-flex align-items-center">
          <?php echo fastway_getLogo();?>
			</div>
      
			<div class="col-5 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
      <div class="d-flex col-3 align-items-center header-text"><?php fastway_getWidgetHeaderText();?></div>
			<div class="col-1 row align-items-center justify-content-end px-4">
          <?php echo fw_shoppingCart();?>
			</div>
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
<?php clean_custom_menu("primary"); ?>
  </div>
</div>
<?
function clean_custom_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
 
        $menu_list  = '<nav id="menu-madre" class="navbar navbar-expand-md"><div class="collapse navbar-collapse" id=""><ul class="navbar-nav mr-auto">'."\n";
 
        $width=100;
        $cols=4;
        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                //error_log($menu_item->title." ".$menu_item->menu_item_parent);
                //error_log(print_r($menu_item,true));

                $parent = $menu_item->ID;
                $menu_array = array();
                        
                foreach( $menu_items as $submenu ) {
                   if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        $url=$submenu->url;
                        $title=$submenu->title;
                        if($submenu->attr_title=="col"){
                          error_log($submenu->title." ".$submenu->attr_title);
                          $nuevoitem='<div class="col-md-'.$cols.'">';
                        }
                        $nuevoitem .= '<li class="nav-item padre"><a class="nav-link" href="' . $url . '">' . $title . '</a></li>' ."\n";
                        $menu_array[] = $nuevoitem;
                        
                        //3er nivel
                        $s_parent = $submenu->ID;
                        foreach( $menu_items as $s_submenu ) {
                            if( $s_submenu->menu_item_parent == $s_parent ) {
                              $s_url=$s_submenu->url;
                              $s_title=$s_submenu->title;
                              $s_nuevoitem = '<li class="nav-item hijo"><a class="nav-link" href="' . $s_url . '">' . $s_title . '</a></li>' ."\n";
                              $menu_array[] = $s_nuevoitem;
                              error_log("------------".$s_submenu->title);
                          } 
                        }
                        if($submenu->attr_title=="col")$menu_array[] ='</div>';
                        
                        
                    }
                    
                }

                if( $bool == true && count( $menu_array ) > 0 ) {
                     
                    $menu_list .= '<li class="nav-item dropdown " style="position:static;">' ."\n";
                    $menu_list .= '<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>' ."\n";
                     
                    $menu_list .= '<ul class="submenu-madre" style="width:'.$width.'%;">' ."\n";
                    $menu_list .= '<div class="row">';
                
                    $menu_list .= implode( "\n", $menu_array );
                    $menu_list .= '</div>';
                
                    $menu_list .= '</ul>' ."\n";
                     
                } else {
                     
                    $menu_list .= '<li class="nav-item">' ."\n";
                    $menu_list .= '<a href=" class="nav-link"' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
                }
                 
            }
            // end <li>
            $menu_list .= '</li>' ."\n";
        }
        $menu_list .= '</ul></div></nav><div class="submenu-overlay"></div>' ."\n";

    } 
    echo $menu_list;
}
