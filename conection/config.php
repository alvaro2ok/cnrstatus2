<?php
//ini_set("display_errors", 1);
//error_reporting(E_ALL);
$dbhost 	= getenv("MYSQL_SERVICE_HOST");
$dbport 	= getenv("MYSQL_SERVICE_PORT");
$login		= getenv('MYSQL_USER');
$pass		= getenv('MYSQL_PASSWORD');
$basedatos	= getenv('MYSQL_DATABASE');
$app_email	= getenv('APP_EMAIL');

$dbHostZabbix 	= getenv("ZABBIX_MYSQL_SERVICE_HOST");
$dbPortZabbix 	= getenv("ZABBIX_MYSQL_SERVICE_PORT");;
$loginZabbix	= getenv('ZABBIX_MYSQL_USER');
$passZabbix		= getenv('ZABBIX_MYSQL_PASSWORD');
$baseDatosZabbix= getenv('ZABBIX_MYSQL_DATABASE');


$mysqli=new mysqli($dbhost, $login, $pass, $basedatos); 
if(mysqli_connect_errno()){
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}

$mysqliZabbix=new mysqli($dbHostZabbix,$loginZabbix,$passZabbix,$baseDatosZabbix); 
if(mysqli_connect_errno()){
	echo 'Conexion Fallida Zabbix: ', mysqli_connect_error();
	exit();
}
?>
