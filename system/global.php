<?php
/**
* @author Eric Shang @ nexs.co.nz
* Glabal functions and settings for the system
*/
//!important, used to autoload class names
function __autoload($class_name) {
	require_once ("./".strtolower($class_name) . '.php');
}

$_siteName = "Serller";
$_title="";

if(!isset($_SESSION))session_start();
$_action =isset($_GET['act'])? trim($_GET['act']) : "";
$_page =isset($_GET['page'])? (int)($_GET['page']) : "";


function _redirect($url){
	echo "<script>window.location.href='$url'</script>";
}

?>