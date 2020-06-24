<?php


function conditionals($template,$data) {
  $conditionals=array();

  if (preg_match_all('#'.'{{'.'if (.+)'.'}}'.'(.+)'.'{{'.'/if'.'}}'.'#sU', $template, $conditionals, PREG_SET_ORDER)) {
              
      if(count($conditionals) > 0) {
      
          foreach($conditionals AS $condition) {
          
              $raw_code = (isset($condition[0])) ? $condition[0] : FALSE;
              $cond_str = (isset($condition[1])) ? $condition[1] : FALSE;
              $insert = (isset($condition[2])) ? $condition[2] : '';
              
              if(!preg_match('/('.'{{'.'|'.'}}'.')/', $cond_str, $problem_cond)) {
                  // If the the conditional statment is formated right, lets procoess it!
                  if(!empty($raw_code) OR $cond_str != FALSE OR !empty($insert)) {
                      // Get the two values
                      $cond = preg_split("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str);
                      
                      // Do we have a valid if statment?
                      if(count($cond) == 2) {
                         
                          // Get condition
                          preg_match("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str, $cond_m);
                          array_push($cond, $cond_m[0]);
                          
                          // Remove quotes - they cause to many problems!   
                          $cond[0]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[0])));   
                          $cond[1]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[1])));
                          
                          // Test condition                            
                          eval("\$result = (\"".$data[$cond[0]]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");
                      
                          error_log("\$result = (\"".$data[$cond[0]]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");
                      } else {
                        error_log('jaja');
                        // Looks like a if 'variable' conditional, let's make sure the variable is set
                        
                          /*if (isset($data->$cond_str)) {
                            // Check the variable isn't empty...
                            if (!empty($data->$cond_str)) {
                              // This adds support for using {if var}then this{/if}
                              $result = TRUE;
                            } else {
                                 $result = FALSE;
                            }
                          } else {
                            $result = FALSE;
                          }*/
                          
                          //$result = (isset($data->$cond_str)) ? TRUE : FALSE;
                      
                      }
                  }
                  
                  // If the condition is TRUE then show the text block
                  $insert = preg_split('#'.'{{'.'else'.'}}'.'#sU', $insert);
                  if($result == TRUE)
                  {
                      $template = str_replace($raw_code, $insert[0], $template);
                  } else {
                      // Do we have an else statment?
                      if(is_array($insert))
                      {
                          $insert = (isset($insert[1])) ? $insert[1] : '';
                          $template = str_replace($raw_code, $insert, $template);    
                      } else {
                          $template = str_replace($raw_code, '', $template);        
                      }
                  }
              } elseif(!$show_errors) {
                  // Remove any if statments we can't process
                  $template = str_replace($raw_code, '', $template);            
              }
               
          }
            
      }
  }
  return $template;    
}
function myplugin_register_settings() {
  add_option( 'fw_email_subject_customer_new_account', 'Tu cuenta esta lista');
  add_option( 'fw_email_content_customer_new_account', 'Bienvenido a {{blogname}}

  Gracias por crear una cuenta en nuestra web. Tu nombre de usuario es {{user_name}}
  Podés acceder a tu cuenta para ver pedidos, cambiar tu contraseña y más en: {{myaccount}}
    
  Tu contraseña se generó automáticamente: <strong>{{user_pass}}</strong>
  Pero podés cambiarla cuando quieras.
    
  ¡Te esperamos! ;-)');

  add_option( 'fw_email_subject_customer_processing_order', 'Gracias por tu pedido');
  add_option( 'fw_email_content_customer_processing_order', 'Hola {{customer_name}},

Solo para que estés informado — hemos recibido tu pedido #248, y ahora se está procesando:');


add_option( 'fw_email_subject_customer_completed_order', 'Gracias por tu pedido');
add_option( 'fw_email_content_customer_completed_order', 'Hola {{customer_name}},

Solo para que estés informado — hemos recibido tu pedido #248, y ahora se está procesando:');



add_option( 'fw_email_subject_customer_on-hold_order', 'Gracias por tu pedido');
add_option( 'fw_email_content_customer_on-hold_order', 'Hola {{customer_name}},

Solo para que estés informado — hemos recibido tu pedido #248, y ahora se está procesando:');



  register_setting( 'fw_email_options_group', 'fw_email_subject_customer_new_account', 'myplugin_callback' );
  register_setting( 'fw_email_options_group', 'fw_email_subject_customer_processing_order', 'myplugin_callback' );
  register_setting( 'fw_email_options_group', 'fw_email_subject_customer_completed_order', 'myplugin_callback' );
  register_setting( 'fw_email_options_group', 'fw_email_subject_customer_on-hold_order', 'myplugin_callback' );

  register_setting( 'fw_email_options_group', 'fw_email_content_customer_new_account', 'myplugin_callback' );
  register_setting( 'fw_email_options_group', 'fw_email_content_customer_processing_order', 'myplugin_callback' );
  register_setting( 'fw_email_options_group', 'fw_email_content_customer_completed_order', 'myplugin_callback' );
  register_setting( 'fw_email_options_group', 'fw_email_content_customer_on-hold_order', 'myplugin_callback' );

}

add_action( 'admin_init', 'myplugin_register_settings' );

function myplugin_register_options_page() {
  add_options_page('Email Templates', 'Email Templates', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');



function myplugin_options_page(){
  $order_variables='<small>Variables: {{blogname}} {{customer_name}} {{order_number}} {{order_details}} {{order_meta}} {{customer_details}} {{shipping_method_title}} {{shipping_method_type}} {{shipping_method_id}} {{payment_method_id}} {{payment_method_title}}</small>';

?>
  <div>
  <?php screen_icon(); ?>
  <form method="post" action="options.php">
  <?php settings_fields( 'fw_email_options_group' ); ?>
  <div class="tipomail">
    <h3 class="titulo"><?=__( 'New Account', 'woocommerce' )?></h3>
    <small><?=__( 'Customer "new account" emails are sent to the customer when a customer signs up via checkout or account pages.', 'woocommerce' );?></small>
    <input type="text" class="w100" id="fw_email_subject_customer_new_account" name="fw_email_subject_customer_new_account" value="<?php echo get_option('fw_email_subject_customer_new_account'); ?>" />
    <small>Variables: {{blogname}} {{user_name}} {{user_pass}} {{myaccount}}</small><br>
    <?php
    $content = get_option('fw_email_content_customer_new_account');
    wp_editor( $content, 'fw_email_content_customer_new_account', $settings = array('textarea_rows'=> '10') );
    ?>
  </div>
  <div class="tipomail">
    <h3 class="titulo"><?=__( 'Processing order', 'woocommerce' )?></h3>
    <small><?=__( 'This is an order notification sent to customers containing order details after payment.', 'woocommerce' );?></small>
    <input type="text" class="w100" id="fw_email_subject_customer_processing_order" name="fw_email_subject_customer_processing_order" value="<?php echo get_option('fw_email_subject_customer_processing_order'); ?>" /><br>
    <?=$order_variables;?>
    <?php
    $content = get_option('fw_email_content_customer_processing_order');
    wp_editor( $content, 'fw_email_content_customer_processing_order', $settings = array('textarea_rows'=> '10') );
    ?>
  </div>
  <div class="tipomail">
    <h3 class="titulo"><?=__( 'Completed order', 'woocommerce' )?></h3>
    <small><?=__( 'Order complete emails are sent to customers when their orders are marked completed and usually indicate that their orders have been shipped.', 'woocommerce' );?></small>
    <input type="text" class="w100" id="fw_email_subject_customer_completed_order" name="fw_email_subject_customer_completed_order" value="<?php echo get_option('fw_email_subject_customer_completed_order'); ?>" /><br>
    <?=$order_variables?>
    <?php
    $content = get_option('fw_email_content_customer_completed_order');
    wp_editor( $content, 'fw_email_content_customer_completed_order', $settings = array('textarea_rows'=> '10') );
    ?>
  </div>
  <div class="tipomail">
    <h3 class="titulo"><?=__( 'Order on-hold', 'woocommerce' )?></h3>
    <small><?=__( 'This is an order notification sent to customers containing order details after an order is placed on-hold.', 'woocommerce' );?></small>
    <input type="text" class="w100" id="fw_email_subject_customer_on-hold_order" name="fw_email_subject_customer_on-hold_order" value="<?php echo get_option('fw_email_subject_customer_on-hold_order'); ?>" /><br>
    <?=$order_variables?>
    <?php
    $content = get_option('fw_email_content_customer_on-hold_order');
    wp_editor( $content, 'fw_email_content_customer_on-hold_order', $settings = array('textarea_rows'=> '10') );
      ?>
  </div>



  <?php  submit_button(); ?>
  </form>
  </div>
<style>
.tipomail{

  margin-bottom:20px;
}
input.w100{
  width:100%;
}
h3.titulo{
  margin-top:20px;
  margin-bottom:0px;
}
</style>
<?php
} ?>
