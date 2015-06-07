<?php
/**
* @author Eric Shang @ nexs.co.nz
* main template
*/

if(!isset($_GET['iid'])){
	$url = "?";
	_redirect($url);
}else{
	$iid = (int)$_GET['iid'];
	$ES = new EvidenceSource(null,$iid ,null ,null,null,null,null,null,null,null,null,null);
	if($ES->retrieveByIId($iid) == false){
		$url = "?act=addEvidenceSource&iid=".$iid;
		_redirect($url);
	}
	

	
	/*if($evidenceItem->getUid() != $_SESSION['user']->getUid()){
		//$url = "./";
		//_redirect($url);
	}*/
	$iid = $ES->getIid();
	$esid = $ES->getEsid();
	$bibRef = $ES->getBibRef();
	$researchLevel = $ES->getResearchLevel();
	$method = $ES->getMethod();
	$participants = $ES->getParticipants();
	$metrics = $ES->getMetrics();
	$question = $ES->getQuestion();
	$submitby = $ES->getSubmitby();
	$approved = $ES->getApproved();
	
	$year = $ES->getYear();
	$author = $ES->getAuthor();
	
}

$uid = isset($_SESSION['user'])?$_SESSION['user']->getUid() : 0 ;

?>

<!--mainbody start-->
<div class="boxMain">
	<div class="boxMainLeft">
    
    	<div class="mainLeftBar">
            <form>
            Search:<br />
            <div class="searchFormDiv">
                <input type="text" id="searchInput" /><input type="submit" value="Go" id="searchSubmit" />
            </div>
            </form>
            <h3>Operations:</h3>
            <ul class="mainLeftBarUl">
				<?php showUserCenterNav(); ?>
             </ul>
    	</div>
    </div>
    <div class="boxMainRight">
    
        <div class="castSheet">
        <h2>Evidence Source</h2>
            <div class="inputFormDiv">
                <form method="post" action="?act=doEditEvidenceSource">
                <p>Bib Ref: <br /><input type="text" name="bibref" class="inputFormDivInput" value = '<?php echo $bibRef; ?>'/> *</p>
                <input type="hidden" name="esid" value="<?php echo $esid; ?>" />
                <input type="hidden" name="iid" value="<?php echo $iid; ?>" />
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                
                <p>Author: <br /><input name="author" value="<?php echo $author; ?>" class="inputFormDivInput" /> *</p>
                <p>Year: <br /><input name="year" value="<?php echo $year; ?>"class="inputFormDivInput"  /> *</p>
                <p>Research Level:<br /><input name="researchLevel" value="<?php echo $researchLevel; ?>"class="inputFormDivInput"  /></p>
                
                <h4>Research Design:</h4>
                <p>Question:<br /><input name="question" value="<?php echo $question; ?>"class="inputFormDivInput"  /></p>
                <p>Method:<br /><input name="method" value="<?php echo $method; ?>"class="inputFormDivInput"  /></p>
                
                <p>Participants: <br /><textarea name="Participants"  ><?php echo $participants; ?></textarea></p>
                <p>Metrics: <br /><textarea name="Metrics"  ><?php echo $metrics; ?></textarea></p>                
                <p><input type="submit" value="Submit" class="inputSubmit"/></p>
                </form>
            </div>
        </div>
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>