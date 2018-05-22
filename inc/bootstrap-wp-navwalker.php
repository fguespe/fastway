<?php
/**
 * Adapted from Edward McIntyre's wp_bootstrap_navwalker class.
 * Removed support for glyphicon and added support for Font Awesome.
 *
 * @package understrap
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (! class_exists ( 'fw_Navwalker' )) :
class fw_Navwalker extends Walker_Nav_Menu {
	var $atts;
    function __construct($tipo="") {
    	if($tipo==="desktop-1"){
	        $this->atts['li_class'] = 'nav-item hs-has-sub-menu u-header__nav-item';
	        
	        $this->atts['submenu_id'] = 'pagesSubMenu';
	        $this->atts['submenu_class']='list-inline hs-sub-menu u-header__sub-menu py-3 mb-0';
	        $this->atts['submenu_li_class']='hs-has-sub-menu';
	        $this->atts['submenu_data_parent']='';
	        
	        $this->atts['class']= 'nav-link u-header__nav-link';	
	        $this->atts['href']        = '#';
			$this->atts['aria-haspopup'] = 'true';
			$this->atts['aria-expanded'] = 'false';
			$this->atts['aria-labelledby'] = 'pagesSubMenu';
			$this->atts['role']='';
	     	$this->atts['data-toggle']='';
	     	$this->atts['aria-controls']='';

    	}else if($tipo==="mobile-1"){
	        $this->atts['li_class'] = 'nav-item hs-has-sub-menu u-header__nav-item';

	        $this->atts['submenu_id'] = 'pagesSubMenu';
	        $this->atts['submenu_class']='list-inline hs-sub-menu u-header__sub-menu py-3 mb-0';
	        $this->atts['submenu_li_class']='hs-has-sub-menu';
	        $this->atts['submenu_data_parent']='';

	        $this->atts['class'] = 'nav-link u-header__nav-link';	
	        $this->atts['href']= '#';
			$this->atts['aria-haspopup'] = 'true';
			$this->atts['aria-expanded'] = 'false';
			$this->atts['aria-labelledby'] = 'pagesSubMenu';
	     	$this->atts['role']='';
	     	$this->atts['data-toggle']='';
	     	$this->atts['aria-controls']='';

    	}else if($tipo==="sidebar-1"){
	        $this->atts['li_class'] = 'u-has-submenu u-header-collapse__submenu';
	        //Submenu
	        $this->atts['submenu_id'] = 'headerSidebarHomeCollapse';//??????
	        $this->atts['submenu_class']='collapse u-header-collapse__nav-list';
	        $this->atts['submenu_li_class']='u-has-submenu u-header-collapse__submenu';
	        $this->atts['submenu_data_parent']='#headerSidebarContent';
	        //a first
	        $this->atts['class'] = 'u-header-collapse__nav-link u-header-collapse__nav-pointer';	
	        $this->atts['href']='#'.$this->atts['submenu_id'];
			$this->atts['aria-haspopup'] = '';
	     	$this->atts['aria-expanded']='';
			$this->atts['aria-labelledby'] = '';
	     	$this->atts['role']='button';
	     	$this->atts['data-toggle']='collapse';
	     	$this->atts['aria-controls']=$this->atts['submenu_id'];

	           
    	}

    }
	/**
	 * The starting level of the menu.
	 *
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 * @param mixed  $args Rest of arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul id=\"".$this->atts['submenu_id']."\"  class=\"".$this->atts['submenu_class']."\" data-parent=\"".$this->atts['submenu_data_parent']."\" >\n";
	}

	/**
	 * Open element.
	 *
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 * @param mixed  $args Rest arguments.
	 * @param int    $id Element's ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */

		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li class="dropdown-divider" role="presentation">';
		} else if ( strcasecmp( $item->title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li class="dropdown-divider" role="presentation">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li class="dropdown-header" role="presentation">' . esc_html( $item->title );
		} else if ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li class="disabled" role="presentation"><a href="#">' . esc_html( $item->title ) . '</a>';
		} else {
			$class_names = $value = '';
			$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[]   = 'nav-item menu-item-' . $item->ID;
			$class_names = " ";///join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			/*
			if ( $args->has_children )
			  $class_names .= ' dropdown';
			*/
			if ( $args->has_children && $depth === 0 ) {
				$class_names .= $this->atts['li_class'];
			} elseif ( $args->has_children && $depth > 0 ) {
				$class_names .= $this->atts['li_class'];
			}
			if ( in_array( 'current-menu-item', $classes ) ) {
				$class_names .= ' active';
			}
			// remove Font Awesome icon from classes array and save the icon
			// we will add the icon back in via a <span> below so it aligns with
			// the menu item
			if ( in_array( 'fa', $classes ) ) {
				$key         = array_search( 'fa', $classes );
				$icon        = $classes[ $key + 1 ];
				$class_names = str_replace( $classes[ $key + 1 ], '', $class_names );
				$class_names = str_replace( $classes[ $key ], '', $class_names );
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id          = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id          = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			if ( $args->has_children && $depth === 0 ) {
				$output .= $indent . '<li ' . $id . $value . $class_names . ' data-event="hover" data-animation-in="fadeIn" data-animation-out="fadeOut">';
			}else{
				$output .= $indent . '<li ' . $id .' class="'.$this->atts['submenu_li_class'].'" >';

			}
			//echo $value.":".$args->has_children." - ".$depth." <br>";
			
			$atts           = array();
			if ( empty( $item->attr_title ) ) { $atts['title'] = ! empty( $item->title ) ? strip_tags( $item->title ) : ''; } else { $atts['title'] = $item->attr_title; }
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			// If item has_children add atts to a.

			if ( $args->has_children && $depth === 0 ) {
				$this->atts['submenu_id']=$this->atts['submenu_id'].trim($item->ID);
				$this->atts['href']='#'.$this->atts['submenu_id'];
	     		$this->atts['aria-controls']=$this->atts['submenu_id'];
	     		$atts['href'] = $this->atts['href'];
				$atts['aria-haspopup'] = $this->atts['aria-haspopup'] ;
	     		$atts['aria-expanded'] = $this->atts['aria-expanded'];
				$atts['aria-labelledby'] = $this->atts['aria-labelledby'];
	     		$atts['role'] = $this->atts['role'];
	     		$atts['data-toggle'] = $this->atts['data-toggle'];
	     		$atts['aria-controls'] = $this->atts['aria-controls'];
				$atts['class']       =  $this->atts['class'];
				
			}else {
				$atts['href']  = ! empty( $item->url ) ? $item->url : '';
				$atts['class'] =  $this->atts['class'];

			}
			$atts       = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output = $args->before;
			// Font Awesome icons
			$item_output .= '<a id="pagesMegaMenu"' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title,
					$item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="fa fa-angle-down u-header__nav-link-icon"></span></a>' : '</a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array  $children_elements List of elements to continue traversing.
	 * @param int    $max_depth Max depth to traverse.
	 * @param int    $depth Depth of current element.
	 * @param array  $args
	 * @param string $output Passed by reference. Used to append additional content.
	 *
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return;
		}
		$id_field = $this->db_fields['id'];
		// Display this element.
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {
			extract( $args );
			$fb_output = null;
			if ( $container ) {
				$fb_output = '<' . $container;
				if ( $container_class ) {
					$fb_output .= ' class="' . $container_class . '"';
				}
				if ( $container_id ) {
					$fb_output .= ' id="' . $container_id . '"';
				}
				$fb_output .= '>';
			}
			$fb_output .= '<ul';
			if ( $menu_class ) {
				$fb_output .= ' class="' . $menu_class . '"';
			}
			if ( $menu_id ) {
				$fb_output .= ' id="' . $menu_id . '"';
			}
			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';
			if ( $container ) {
				$fb_output .= '</' . $container . '>';
			}
			echo $fb_output;
		}
	}
}

endif; /* End if class exists */
