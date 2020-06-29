<?php


header("HTTP/1.1 200 OK");

$notifications=file_get_contents("php://input");
if($notifications && isset($notifications['resource'])){
    $order_id=explode($notifications['resource'],'/')[1];
    error_log('order_id: '.$order_id);
}