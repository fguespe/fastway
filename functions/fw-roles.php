<?php

function fw_get_current_user_role() {
  if( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $role = ( array ) $user->roles;
    return $role[0];
  } else {
    return false;
  }
}
function get_is_role_or_name_before(){
  $users=explode(",", fw_theme_mod('ca_users'));
  if(in_array(wp_get_current_user()->user_login,$users)){
      return wp_get_current_user()->user_login;

  }
  return fw_get_current_user_role();
}
  
function fw_getmeroles_and_names(){
      $usuarios=explode(",", fw_theme_mod('ca_users'));
      $devolver=fw_getme_roles();
      foreach ($usuarios as $key) {
          $devolver=array_merge($devolver,array($key=>$key));
      }
      return $devolver;
}

add_filter( 'body_class','fw_role_body_classes' );
function fw_role_body_classes( $classes ) {
    $roles=fw_get_all_roles();
    if(is_string($roles))$roles=explode(",",$roles);
    
    foreach ($roles as $key=>$nombre) {
      if ( check_user_role( strtolower($key) )) {
        $classes[]= strtolower($key); //or your name
      }
    }
    return $classes;
}



function check_user_role($role){
    $user = wp_get_current_user();
    if($role=='administrator' && is_super_admin())return true;
    if($role=='guest' && empty((array) $user->roles ))return true;
    if ( in_array( $role, (array) $user->roles ) ) {
      return true;
    }
	return false;
}

function fw_get_all_roles() {

    global $wp_roles;
    
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();
    
    return $wp_roles->get_names();
  }
  function fw_get_all_roles_string(){
    $roles=fw_get_all_roles();
    return strtolower(implode(fw_get_all_roles(),", "));
  }
  function fw_getme_roles(){
      if ( ! function_exists( 'get_editable_roles' ) ) {
          require_once ABSPATH . 'wp-admin/includes/user.php';
      }
      $editable_roles = get_editable_roles();
      $roles=array();
      foreach ($editable_roles as $role => $details) {
          $rol = esc_attr($role);
          if($rol=='administrator')continue;
          $name = translate_user_role($details['name']);
          $roles=array_merge($roles,array($rol => $name));
         
      }
      return $roles;
  }
  


function fw_editable_roles( $roles ) {
  $arr=fw_get_all_roles();
  if(is_string($arr))$arr=explode(",",$arr);
  foreach ($arr as $key => $nombre) {
    if($key=='administrator' || empty($key)  || empty($nombre))continue;
    $roles[] = $key;
  }
  return $roles;
}
add_filter( 'woocommerce_shop_manager_editable_roles', 'fw_editable_roles' ); 
  
  /*
  
add_filter( 'woocommerce_shop_manager_editable_roles', 'fw_shop_manager_role_edit_capabilities' );
function fw_shop_manager_role_edit_capabilities( $roles ) {
    error_log(print_r($roles,true));
    if(function_exists('fw_theme_mod')){
      $roles=fw_theme_mod('ca_extra_roles');
      if(is_string($roles))$roles=explode(",",$roles);
      
      foreach ($roles as $nombre) {
        $roles[]=strtolower($nombre);
      }
    }
    $roles[]='shop_manager';
    $roles[]='subscriber';
    $roles[]='customer';
    
    return $roles;
}*/


add_action( 'admin_init', 'fw_allow_users_to_shopmanager');
function fw_allow_users_to_shopmanager() {
    /*supuestamente funciona*/
    $role = get_role( 'shop_manager' );
    $role->add_cap( 'edit_theme_options' ); 
    $role->add_cap( 'manage_options' ); 
    $role->add_cap( 'add_users' ); 
    $role->add_cap( 'edit_dashboard' ); 
    $role->add_cap( 'create_users' ); 
    $role->add_cap( 'edit_users' ); 
    $role->add_cap( 'gravityforms_create_form' ); 
    $role->add_cap( 'gravityforms_edit_forms' ); 
    $role->add_cap( 'gravityforms_view_entries' ); 
    $role->add_cap( 'gravityforms_user_registration');
}

// Remove Administrator role from roles list
add_action( 'editable_roles' , 'hide_adminstrator_editable_roles' );
function hide_adminstrator_editable_roles( $roles ){
  if($role=='administrator' || is_super_admin())return $roles;
  unset( $roles['editor'] );
  unset( $roles['author'] );
  unset( $roles['administrator'] );
  unset( $roles['subscriber'] );
  unset( $roles['contributor'] );
  return $roles;
}
if(!empty(fw_theme_mod('ca_extra_roles'))) {
    
    function fw_create_roles() {  
        $roles=fw_theme_mod('ca_extra_roles');
        $roles=explode(",",$roles);
        foreach ($roles as $nombre) {
            //add the new user role
            $field= str_replace(" ","_",strtolower($nombre));
            add_role(
                $field,
                $nombre,
                array(
                    'read'         => true,
                    'delete_posts' => false
                )
            );
        }

    }
    add_action('admin_init', 'fw_create_roles');
  
}