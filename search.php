<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
require_once("./system/global.php");

function showSearchResult(){
	if(isset($_POST)){
		var_dump($_POST);
	}
}

if($_action=="doSearch"){
	$_title = "Search result - ";
	require_once("./view/header.php");
	require_once("./view/searchPage.php");
	require_once("./view/footer.php");
}else{
	$_title = "Search Paper - ";
	require_once("./view/header.php");
	require_once("./view/searchPage.php");
	require_once("./view/footer.php");
}
?>