<?php


header("HTTP/1.1 200 OK");

error_log('entro una noti de ML ');
if($_POST)error_log(print_r($_POST,true));

$notifications=file_get_contents("php://input");
error_log(print_r($notifications,true));