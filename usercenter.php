<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
require_once("./system/global.php");
if($_action=="submitpaper"){
	$_title = "Submit Paper - ";
	require_once("./view/header.php");
	require_once("./view/submitpaper.php");
	require_once("./view/footer.php");
}else if($_action=="doSubmitPaper"){
	$_title = "Submit Paper - ";
	if(isset($_POST) && isset($_POST['method_id']) && isset($_POST['title']) && $_POST['title'] !="" && $_POST['method_id']>0){
		$uid = $_SESSION['user']->getUid();
		$iid = 0 ;
		$method_id = $_POST['method_id'];
		$title = $_POST['title'];
		$why = $_POST['why'];
		$who = $_POST['who'];
		$what = $_POST['what'];
		$where = $_POST['where'];
		$when = $_POST['when'];
		$how = $_POST['how'];
		$benefit = $_POST['benefit'];
		$result = $_POST['result'];
		$methodImplementation = $_POST['methodImplementation'];
		
		$evidenceItem = new EvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid);
		if($evidenceItem->create()){
			echo "New Evidence Item Created!";
			$url ="?act=submitpaper";
		}else{
			echo "Misson Failed!";
			$url ="?act=submitpaper";
		}
	}else{
		echo "Field empty!";
		$url ="?act=submitpaper";
	}
	_redirect($url);
}else if($_action == 'mysubmitpaper'){
	$_title = "My Submitted Papers - ";
	require_once("./view/header.php");
	require_once("./view/mysubmitpaper.php");
	require_once("./view/footer.php");
}else{
	$_title = "User Center - ";
	require_once("./view/header.php");
	require_once("./view/usercenter.php");
	require_once("./view/footer.php");
}
?>