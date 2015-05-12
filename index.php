<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
require_once("./system/global.php");
if($_action == "showItem"){
	if(isset($_GET['id'])){
		$iid = (int)$_GET['id'];
	}
	$evidenceItem = new EvidenceItem($iid ,null,null,null,null,null,null,null,null,null,null,null,null);
	if($iid>0){
		$evidenceItem->retrieve($iid);
	}
	$_title = $evidenceItem->getTitle(). " - ";
	require_once("./view/header.php");
	require_once("./view/showitem.php");
	require_once("./view/footer.php");
}else{
	$_title = "Home - ";
	require_once("./view/header.php");
	require_once("./view/main.php");
	require_once("./view/footer.php");
}
?>