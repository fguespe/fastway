<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host=$_SERVER['HTTP_HOST'];
if($host==='fastway')$con=mysqli_connect('localhost', 'root', 'root', 'ecom3');
else {
    $host=explode('-',gethostname())[1];
    $pass="";
    /*
    http://ecomaltoweb.kinsta.cloud/wp-content/themes/fastway/stats.php
    http://altoweb.kinsta.cloud/wp-content/themes/fastway/stats.php
    http://ecom2.kinsta.cloud/wp-content/themes/fastway/stats.php
    http://ecom3.kinsta.cloud/wp-content/themes/fastway/stats.php
    http://insti2.kinsta.cloud/wp-content/themes/fastway/stats.php
    */
    if($host=='ecomaltoweb')$pass="AzTqSBeLgPxjaeT";
    else if($host=='altoweb')$pass="kByecetGFisPWnS";
    else if($host=='ecom2')$pass="iYOIxmdkxXnuJb4";
    else if($host=='ecom3')$pass="zulinVXs3DLo2Nh";
    else if($host=='insti2')$pass="PzpevImJBia4PnJ";
    $con=mysqli_connect('localhost', $host, $pass, $host);
}

$query = "SELECT * FROM wp_altoweb_visits";
$result = mysqli_query($con, $query);
if(empty($result)) {
    $query = "CREATE TABLE `wp_altoweb_visits` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `site` int(10) DEFAULT NULL,
        `fecha` varchar(430) DEFAULT NULL,
        `dominio` varchar(200) DEFAULT NULL,
        `type` varchar(20) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=181786 DEFAULT CHARSET=utf8;";
    $result = mysqli_query($con, $query);
}



$filas=array();
$fila=array("id","name","facturacion","ventas","productos","consultas","cant_users","visitas","wp");
array_push($filas, $fila);


$sql="select * from wp_blogs";
$result=mysqli_query($con,$sql);
while($row = $result->fetch_assoc()) {
    echo "entra";
    $name=str_replace('www.','',$row['domain']);
    //if( strpos( $name, 'kinsta' ) !== false) continue;
    $id=$row['blog_id'];
    $prom=4;
    $sum=0;$cantsales=0;$consu=0;$productos_cant=0;$cant=0;$visitas_cant=0;$wps_cant=0;//colummsn

    $sql='select "Cliente",ROUND(sum(total)/'.$prom.') promedio,count(*) cant  from (select p.ID as order_id,p.post_date, max( CASE WHEN pm.meta_key = "_order_total" and p.ID = pm.post_id THEN pm.meta_value END ) as total from wp_'.$id.'_posts p join wp_'.$id.'_postmeta pm on p.ID = pm.post_id join wp_'.$id.'_woocommerce_order_items oi on p.ID = oi.order_id where post_type = "shop_order" AND period_diff(date_format(now(), "%Y%m"), date_format(p.post_date, "%Y%m"))<='.$prom.'   group by p.ID order by post_date desc )a';
    $ventas=mysqli_query($con,$sql);
    if($ventas){
        foreach($ventas as $fact){
        $sum=$fact['promedio'];
        $cantsales=$fact['cant'];
        }
    }

    $sql='SELECT p.ID, p.post_title "nome", GROUP_CONCAT(cat.name SEPARATOR " | ") "Category", MAX(CASE WHEN meta.meta_key = "_sku" THEN meta.meta_value END) "SKU", p.post_content "descripction", MAX(CASE WHEN meta.meta_key = "_price" THEN meta.meta_value END) "Price", MAX(CASE WHEN meta.meta_key = "_weight" THEN meta.meta_value END) "Weight", MAX(CASE WHEN meta.meta_key = "_stock" THEN meta.meta_value END) "Stock" FROM wp_'.$id.'_posts AS p JOIN wp_'.$id.'_postmeta AS meta ON p.ID = meta.post_ID LEFT JOIN ( SELECT pp.id, GROUP_CONCAT(t.name SEPARATOR " > ") AS name FROM wp_'.$id.'_posts AS pp JOIN wp_'.$id.'_term_relationships tr ON pp.id = tr.object_id JOIN wp_'.$id.'_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id JOIN wp_'.$id.'_terms t ON tt.term_id = t.term_id || tt.parent = t.term_id WHERE tt.taxonomy = "product_cat" GROUP BY pp.id, tt.term_id ) cat ON p.id = cat.id WHERE (p.post_type = "product" ) AND meta.meta_key IN ("_sku", "_price", "_weight", "_stock") AND meta.meta_value is not null GROUP BY p.ID ';
    $productos=mysqli_query($con,$sql);
    if($productos)$productos_cant=mysqli_num_rows($productos);

    $sql='select count(*) users from wp_users u join wp_usermeta um on u.id=um.user_id where um.meta_key="wp_'.$id.'_capabilities"';
    $cant_users=mysqli_query($con,$sql);
    if($cant_users)foreach($cant_users as $fact) $cant=$fact['users'];

    $sql='select ROUND(count(*)/'.$prom.') consus from wp_'.$id.'_gf_entry where period_diff(date_format(now(), "%Y%m"), date_format(date_created, "%Y%m"))<=30';
    $consultas=mysqli_query($con,$sql);
    if($consultas)foreach($consultas as $fact) $consu=$fact['consus'];


    $sql="select count(*) cant,site ,dominio,type from wp_altoweb_visits where type='visit' and site=".$id." AND STR_TO_DATE(fecha,'%c/%e/%Y %r') BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() group by dominio,type order by count(*)  desc";
    $visitas=mysqli_query($con,$sql);
    if($visitas)foreach($visitas as $fact) $visitas_cant=floor($fact['cant']);

    $sql="select count(*) cant,site ,dominio,type from wp_altoweb_visits where type='wp' and site=".$id." AND STR_TO_DATE(fecha,'%c/%e/%Y %r') BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() group by dominio,type order by count(*)  desc";
    $wps=mysqli_query($con,$sql);
    if($wps)foreach($wps as $fact) $wps_cant=floor($fact['cant']);

    array_push($filas, array($id,$name,$sum,$cantsales,$productos_cant,$consu,$cant,$visitas_cant,$wps_cant));
}

$fp = fopen("../../../stats.csv", 'w') or die("Can't create file");
foreach ($filas as $fields) { fputcsv($fp, $fields);}
fclose($fp);
echo "Exito!";

