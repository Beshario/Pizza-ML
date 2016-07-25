<?php 
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define('APP_FOLDER','');
define('M', '../model/');
define('V', '../view/');
define('C', '../controller/');
define('html', '../html');

require(C . "controller.php");
?>

