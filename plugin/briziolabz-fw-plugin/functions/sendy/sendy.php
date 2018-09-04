<?php
function custom_send_newletter(){
    $sendy_url = 'http://app.albertmail.com.ar/';
    $list = get_option('sendy_list');
    //------------------ /Edit here --------------------//

    //--------------------------------------------------//
    //POST variables
    $name = 'Guest';
    $email = $_POST['email'];

    //subscribe
    $postdata = http_build_query(
        array(
            'name' => $name,
            'email' => $email,
            'list' => $list,
            'boolean' => 'true'
        )
    );
    $opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
    $context  = stream_context_create($opts);
    $result = file_get_contents($sendy_url.'/subscribe', false, $context);
    //--------------------------------------------------//

    echo $result;
    die();
}
add_action( 'wp_ajax_custom_send_newletter', 'custom_send_newletter' );
add_action( 'wp_ajax_nopriv_custom_send_newletter', 'custom_send_newletter' );


function newletter_javascript() {
    wp_enqueue_script( 'newletter-javascript', plugins_url('sendy.js', __FILE__), array(), NULL, true );
}
add_action( 'wp_enqueue_scripts', 'newletter_javascript' );
