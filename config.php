<?php
session_start();
if(file_exists("localconf.php"))
{
	include_once("localconf.php");
}
else
{
	$objConn = mysql_connect('localhost','zz','zz');
	define("REDIRECT_PATH","http://".$_SERVER['SERVER_NAME']."/career");
}
if(!$objConn)
{
	die("Unable to connect to server ");
	exit;
}
mysql_select_db('new_survey', $objConn);
?>