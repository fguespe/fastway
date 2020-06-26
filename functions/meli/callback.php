<?php


header("HTTP/1.1 200 OK");

$notifications=file_get_contents("php://input");
error_log('entro una noti de ML ');
error_log(print_r($notifications,true));