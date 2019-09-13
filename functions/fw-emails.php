<?php

// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

// Redefine user notification function
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('New user registration on your blog %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');

        wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);
        error_log('jeeje');
    }
}
function wpb_sender_email( $original_email_address ) {
    return 'avisos@altoweb.co';
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Web';
}



add_filter( 'woocommerce_email_recipient_backorder', 'change_stock_email_recipient', 10, 2 ); // For Backorders notification
add_filter( 'woocommerce_email_recipient_low_stock', 'change_stock_email_recipient', 10, 2 ); // For Low stock notification
add_filter( 'woocommerce_email_recipient_no_stock', 'change_stock_email_recipient', 10, 2 ); // For No stock notification
add_filter('woocommerce_email_recipient_new_order', 'orden_nueva', 1, 2);
add_filter('woocommerce_email_recipient_failed_order', 'email_orden_cancelada', 1, 2);
add_filter('woocommerce_email_recipient_cancelled_order', 'email_orden_fallida', 1, 2);

//Emails
add_filter( 'wpmu_welcome_user_notification', 'bbg_wpmu_welcome_user_notification', 10, 3 );
add_filter( 'wpmu_signup_user_notification', 'kc_wpmu_signup_user_notification', 10, 4 );
function bbg_wpmu_welcome_user_notification($user_id, $password, $meta = '') {
 
    global $current_site;
    $admin_email = "avisos@altoweb.co";
    $from_name = get_option( 'nubicommerce_desde_nombre' ) == '' ? $sitename : esc_html( get_option( 'blogname' ) );
        
    $welcome_email = get_site_option( 'welcome_user_email' );

    $user = new WP_User($user_id);

    $welcome_email = apply_filters( 'update_welcome_user_email', $welcome_email, $user_id, $password, $meta);

    // Get the current blog name
    $message = sprintf( "Hola, \n\nSe ha creado tu contraseña. Estos son tus datos: \n\nUsuario: %s\n\nContraseña: %s\n\n " ,
                $user->user_login, $password);

   

    $message_headers = "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
  
    $subject = "Datos de acceso";
    wp_mail($user->user_email, $subject, $message, $message_headers);

    return false; // make sure wpmu_welcome_user_notification() doesn't keep running
}
function kc_wpmu_signup_user_notification($user, $user_email, $key, $meta = '') {
        error_log('jaa2');
    $sitename = get_bloginfo( 'name' );
        $blog_id = get_current_blog_id();
        // Send email with activation link.
        $admin_email = "avisos@altoweb.co";
        $from_name = get_option( 'nubicommerce_desde_nombre' ) == '' ? $sitename : esc_html( get_option( 'blogname' ) );
        $message_headers = "From: \"{$from_name}\" <{$admin_email}>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
        $message = sprintf(
            apply_filters( 'wpmu_signup_user_notification_email',
                __( "Hi %s,\n\nThank you for registering with %s.\n\nTo activate your account, please click the following link:\n\n%s\n\nYou will then receive an email with your login details." ),
                $user, $user_email, $key, $meta
            ),
            site_url( "wp-activate.php?key=$key" )


        );
        // TODO: Don't hard code activation link.
        $subject = "Activar cuenta";
        wp_mail($user_email, $subject, $message, $message_headers);

        return false;
    }
    






    function whero_limit_image_size($file) {
    // Calculate the image size in KB
    $image_size = $file['size']/1024;

    // File size limit in KB
    $limit = 550;

    // Check if it's an image
    $is_image = strpos($file['type'], 'image');

    if ( ( $image_size > $limit ) && ($is_image !== false) )
            $file['error'] = 'La imagen es muy pesada, supera los '. $limit .'KB. Subí una imagen mas liviana o de un tamaño entre 500x500 y 1000x1000. Esto es para asegurar que la web cargue rapido.';

    return $file;

}
//config mails
if(get_option("fw_altoweb_mailconfig")){
    
    //Admin general
    //update_option("new_admin_email",get_option("nubicommerce_destinos_mail"));
    

    update_option("woocommerce_new_order_recipient",get_option("nubicommerce_destinos_mail"));
    update_option("woocommerce_cancelled_order_recipient",get_option("nubicommerce_destinos_mail"));
    update_option("woocommerce_failed_order_recipient",get_option("nubicommerce_destinos_mail"));
    
    update_option("woocommerce_product_enquiry_send_to",get_option("nubicommerce_destinos_mail"));
    update_option("woocommerce_stock_email_recipient",get_option("nubicommerce_destinos_mail"));
     
    update_option("sendgrid_from_email","avisos@altoweb.co");
    update_option("woocommerce_email_from_address","avisos@altoweb.co");
     
    update_option("woocommerce_email_from_name",get_option("nubicommerce_desde_nombre"));
    update_option("sendgrid_from_name",get_option("nubicommerce_desde_nombre"));

    
     //Mail woocommerce
    update_option("woocommerce_email_header_image",fw_theme_mod('general-logo') );
    update_option("woocommerce_email_footer_text","Powered by Altoweb");
    update_option("woocommerce_email_base_color",fw_theme_mod('opt-color-main'));


    update_option('fw_altoweb_mailconfig','0');

}

function change_stock_email_recipient( $recipient, $product ) {
    $recipients = ", ".get_option("nubicommerce_destinos_mail");
    return $recipients;
}
function orden_nueva( $recipient, $order ) {
    $recipients = ", ".get_option("nubicommerce_destinos_mail");
    return $recipients;
}

function email_orden_cancelada( $recipient, $order ) {
    $recipients = ", ".get_option("nubicommerce_destinos_mail");
    return $recipients;
}

function email_orden_fallida( $recipient, $order ) {
    $recipients = ", ".get_option("nubicommerce_destinos_mail");
    return $recipients;
}
?>