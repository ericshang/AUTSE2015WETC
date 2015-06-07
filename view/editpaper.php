<?php
/**
* @author Eric Shang @ nexs.co.nz
* main template
*/

if(!isset($_GET['id'])){
	$url = "./";
	_redirect($url);
}else{
	$iid = (int)$_GET['id'];
	$evidenceItem = new EvidenceItem($iid , null ,null,null,null,null,null,null,null,null,null,null,null);
	$evidenceItem->retrieve($iid);
	
	/*if($evidenceItem->getUid() != $_SESSION['user']->getUid()){
		//$url = "./";
		//_redirect($url);
	}*/
	$iid = $evidenceItem->getIid();
	$method_id = $evidenceItem->getMethodId();
	$title = $evidenceItem->getTitle();
	$why = $evidenceItem->getWhy();
	$who = $evidenceItem->getWho();
	$what = $evidenceItem->getWhat();
	$where = $evidenceItem->getWhere();
	$when = $evidenceItem->getWhen();
	$how = $evidenceItem->getHow();
	$benefit = $evidenceItem->getBenefit();
	$result = $evidenceItem->getResult();
	$methodImplementation = $evidenceItem->getMethodImplementation();
	
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
        <h2>Sumit Papers</h2>
            <div class="inputFormDiv">
                <form method="post" action="?act=doEditPaper">
                <p>Title: <br /><input type="text" name="title" class="inputFormDivInput" value = '<?php echo $title; ?>'/> *</p>
                <input type="hidden" name="iid" value="<?php echo $iid; ?>" />
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <p><select name="method_id">
				<option value='0'>Select Method</option>
				<?php 
					require_once('./system/db.php');
					$db=new DB();
					$sql = "select * from `method`";
					$query = $db->query($sql);
					$rows = $query->rows;
					foreach($rows as $v){
						$name = $v['name'];
						$methodId = $v['method_id'];
						$checked = "";
						if($methodId == $method_id){
							$checked = "selected='selected'";
						}
						echo "<option value='$methodId' $checked>$name</option>";
					}
				 ?></select> *</p>
                <p>What:  *<br /><textarea name="what"  ><?php echo $what; ?></textarea></p>
                <p>Who: <br /><textarea name="who"  ><?php echo $who; ?></textarea></p>
                <p>Why: <br /><textarea name="why"  ><?php echo $why; ?></textarea></p>
                <p>Where: <br /><textarea name="where" ><?php echo $where; ?></textarea></p>
                <p>When: <br /><textarea name="when"  ><?php echo $when; ?></textarea></p>
                <p>How: <br /><textarea name="how"  ><?php echo $how; ?></textarea></p>
                <p>Benefit: <br /><textarea name="benefit"  ><?php echo $benefit; ?></textarea></p>
                <p>Result: <br /><textarea name="result"   ><?php echo $result; ?></textarea></p>
                <p>Method Implementation: <br /><textarea name="methodImplementation"  ><?php echo $methodImplementation; ?></textarea></p>
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