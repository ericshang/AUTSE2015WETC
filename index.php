<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
if(!isset($_SESSION))session_start();
$action =isset($_GET['act'])? trim($_GET['act']) : "";
$page =isset($_GET['page'])? (int)($_GET['page']) : "";

require_once("./view/header.php");
require_once("./view/main.php");
require_once("./view/footer.php");
?>