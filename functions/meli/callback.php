<?php


header("HTTP/1.1 200 OK");

$notifications=file_get_contents("php://input");
error_log('jeje');
echo "jeje";
if($notifications){
    error_log('jaja');
    error_log(print_r($notifications,true));
    $order_id=explode($notifications['resource'],'/')[1];
    error_log('order_id: '.$order_id);
}
if($_POST){
    error_log("Es post");
    error_log(print_r($_POST,true));
}