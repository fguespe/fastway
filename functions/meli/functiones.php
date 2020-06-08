<?php

function saveconfig($iduser,$access_token,$refresh_token){
    $myfile = fopen(dirname(__FILE__)."/accesos/".$iduser.".txt", "w") or die("Unable to open file!");
    $vars=array(
        "iduser" => $iduser,
        "access_token" => $access_token,
        "refresh_token" => $refresh_token);

    foreach ($vars as $key => $value) {
        fwrite($myfile, $key.":".$value."\n");
    }
    
    fclose($myfile);
    return $vars;
}



function getconfig($config){
	$myfile = fopen(dirname(__FILE__)."/accesos/".$config.".txt", "r") or die("Unable to open file!");
	$vars=array(
		"iduser" => "",
		//"expires_in" => "",
		"access_token" => "",
		"refresh_token" => "");
  
	// Output one line until end-of-file
	while(!feof($myfile)) {
	 $ambos=explode(":",fgets($myfile));
	 if($ambos[0]==="access_token")$vars['access_token']=$ambos[1];
	 if($ambos[0]==="iduser")$vars['iduser']=$ambos[1];
	 //if($ambos[0]==="expires_in")$vars['expires_in']=$ambos[1];
	 if($ambos[0]==="refresh_token")$vars['refresh_token']=$ambos[1];
  
	}
	//print_r($vars);
	fclose($myfile);
	return $vars;
}
