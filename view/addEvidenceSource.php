<?php
/**
* @author Eric Shang @ nexs.co.nz
* main template
*/

if(!isset($_GET['iid'])){
	$url = "./";
	_redirect($url);
}else{
	$iid = (int)$_GET['iid'];	
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
        <h2>Add Evidence Source</h2>
            <div class="inputFormDiv">
                <form method="post" action="?act=doAddEvidenceSource">
                <p>Bib Ref: <br /><input type="text" name="bibref" class="inputFormDivInput" value = ''/> *</p>
                <input type="hidden" name="iid" value="<?php echo $iid; ?>" />
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                
                <p>Author: <br /><input name="author" value="" class="inputFormDivInput" /> *</p>
                <p>Year: <br /><input name="year" value=""class="inputFormDivInput"  /> *</p>
                <p>Research Level:<br /><input name="researchLevel" value=""class="inputFormDivInput"  /></p>
                
                <h4>Research Design:</h4>
                <p>Question:<br /><input name="question" value=""class="inputFormDivInput"  /></p>
                <p>Method:<br /><input name="method" value=""class="inputFormDivInput"  /></p>
                
                <p>Participants: <br /><textarea name="Participants"  ></textarea></p>
                <p>Metrics: <br /><textarea name="Metrics"  ></textarea></p>                
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