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
}else if($_action=="doSubmitPaper" || $_action=="doEditPaper"){
	$_title = "Submit Paper - ";
	
	if(isset($_POST) && isset($_POST['method_id']) && isset($_POST['title']) && $_POST['title'] !="" && $_POST['method_id']>0){
		$uid = isset($_SESSION['user'])? $_SESSION['user']->getUid(): 0 ;
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
		
		if($_action=="doSubmitPaper"){
			$evidenceItem = new EvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid);			
			if($evidenceItem->create()){
				echo "New Evidence Item Created!";
				_alert("New Evidence Item Created!");
				//jump to add evidence source
				$url ="?act=addEvidenceSource&iid=".$evidenceItem->getIid();
			}else{
				echo "Misson Failed!";
				_alert("mission failed!");
				$url ="?act=submitpaper";
			}
		}else if($_action=="doEditPaper" && $uid == (int)$_POST['uid']){
			$iid = (int)$_POST['iid'];
			$uid = (int)$_POST['uid'];
			
			$evidenceItem = new EvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid);			
			
			if($evidenceItem->update($evidenceItem)){
				echo "Evidence Item Updated!";
				$url ="?act=mysubmitpaper";
			}else{
				echo "Misson Failed!";
				$url ="?";
			}
			
		}
	}else{
		echo "Field empty!";
		_alert("Field empty!");
		$url ="?act=submitpaper";
	}
	echo $url;
	_alert($url);
	_redirect($url);
}else if($_action == 'mysubmitpaper'){
	$_title = "My Submitted Papers - ";
	require_once("./view/header.php");
	require_once("./view/mysubmitpaper.php");
	require_once("./view/footer.php");
}else if($_action == "editpaper"){
	$_title = "Edit Paper - ";
	require_once("./view/header.php");
	require_once("./view/editpaper.php");
	require_once("./view/footer.php");
}else if($_action == "editEvidenceSource"){
	$_title = "Edit Evidence Source - ";
	require_once("./view/header.php");
	require_once("./view/editEvidenceSource.php");
	require_once("./view/footer.php");
}else if($_action == "addEvidenceSource"){
	$_title = "Add Evidence Source - ";
	require_once("./view/header.php");
	require_once("./view/addEvidenceSource.php");
	require_once("./view/footer.php");
}else if($_action == "doAddEvidenceSource"){
	$_title = "do Evidence Source - ";
	$url ="?";
	
	$uid = isset($_SESSION['user'])? $_SESSION['user']->getUid(): 0 ;
	$iid = (int)$_POST['iid'] ;
	$bibref = trim($_POST['bibref']);
	$author = trim($_POST['author']);
	$year = (int)$_POST['year'];
	$researchLevel = $_POST['researchLevel'];
	$question = $_POST['question'];
	$method = $_POST['method'];
	$Participants = $_POST['Participants'];
	$Metrics = $_POST['Metrics'];
	$approved = 0;
	
	
	if($iid>0 && isset($bibref) && isset($author) && isset($year)){
		$ES = new EvidenceSource(null ,$iid ,$bibref ,$researchLevel,$question,$method,$Participants,$Metrics,$uid,$approved ,$author,$year);
		if($ES->create()){
			echo "New Evidence Source Created!";
			_alert("New Evidence Source Created!");
			//jump to add evidence source
			$url ="?";
		}else{
			echo "Misson Failed!";
			_alert("mission failed!");
			$url ="?";
		}
		
	}

	_redirect($url);
}else if($_action == "doEditEvidenceSource"){
	$_title = "Edit Evidence Source - ";
	$url ="?";
	
	$uid = isset($_SESSION['user'])? $_SESSION['user']->getUid(): 0 ;
	$iid = (int)$_POST['iid'] ;
	$esid = (int)$_POST['esid'] ;
	$bibref = trim($_POST['bibref']);
	$author = trim($_POST['author']);
	$year = (int)$_POST['year'];
	$researchLevel = $_POST['researchLevel'];
	$question = $_POST['question'];
	$method = $_POST['method'];
	$Participants = $_POST['Participants'];
	$Metrics = $_POST['Metrics'];
	$approved = 0;
	
	if($iid>0 && $esid>0 && isset($bibref) && isset($author) && isset($year)){
		$ES = new EvidenceSource($esid ,$iid ,$bibref ,$researchLevel,$question,$method,$Participants,$Metrics,$uid,$approved ,$author,$year);
		if($ES->update($ES)){
			echo "Evidence Source Updated!";
			_alert("Evidence Source Updated!");
			//jump to add evidence source
			$url ="?";
		}else{
			echo "Misson Failed!";
			_alert("mission failed!");
			$url ="?";
		}
		
	}
	_redirect($url);
	
}else{
	$_title = "User Center - ";
	require_once("./view/header.php");
	require_once("./view/usercenter.php");
	require_once("./view/footer.php");
}
?>