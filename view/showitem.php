<?php
/**
* @author Eric Shang @ nexs.co.nz
* main template
*/

if($evidenceItem!=null){
	$iid = $evidenceItem->getIid();
	$method_id = $evidenceItem->getMethodId();
	$title = $evidenceItem->getTitle();
	
	$why = $evidenceItem->getWhy();
	$why = $why!=""?$why:"empty";
	
	$who = $evidenceItem->getWho();
	$who = $who!=""?$who:"empty";
	
	$what = $evidenceItem->getWhat();
	$what = $what!=""?$what:"empty";
	
	$where = $evidenceItem->getWhere();
	$where = $where!=""?$where:"empty";
	
	$when = $evidenceItem->getWhen();
	$when = $when!=""?$when:"empty";
	
	$how = $evidenceItem->getHow();
	$how = $how!=""?$how:"empty";
	
	$benefit = $evidenceItem->getBenefit();
	$benefit = $benefit!=""?$benefit:"empty";
	
	$result = $evidenceItem->getResult();
	$result = $result!=""?$result:"empty";
	
	$methodImplementation = $evidenceItem->getMethodImplementation();
	$methodImplementation = $methodImplementation!=""?$methodImplementation:"empty";
	
	$uid = $evidenceItem->getUid();
	$author = new User($uid, null, null, null, null, null, null, null);
	$author->retrieve($uid);
	$authorName = $author->getName();
	
	$method = new Method($method_id, null, null, null);
	$method->retrieve($method_id);
	$methodName = $method->getName();
	
}

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
            <h3>Categories:</h3>
            <?php require_once('./view/catagoryList.php'); ?>
    	</div>
    </div>
    <div class="boxMainRight">
    
        <div class="castSheet">
        <p>Method Category:  <?php echo $methodName; ?> </p>
			<h2><?php echo $title; ?></h2>
			<div class='castSheet_facts'>Submitted By: <?php echo $authorName; ?></div>
            <div class="castSheet_share"><a>Read More</a><a>Evidence Source</a> <a>Confidence Raing: 4.5</a> <a>My Raing: 0.5</a></div>
            <div class="clear"></div>
            <h4>What</h4>
            <p><?php echo $what; ?></p>
            <h4>Why:</h4>
            <p><?php echo $why; ?></p>
            <h4>Who: </h4>
            <p><?php echo $who; ?></p>
            <h4>Where:</h4>
            <p><?php echo $where; ?></p>
            <h4>When:</h4>
            <p><?php echo $when; ?></p>
            <h4>How:</h4>
            <p><?php echo $how; ?></p>
            <h4>Benefit:</h4>
            <p><?php echo $benefit; ?></p>
            <h4>Result:</h4>
            <p><?php echo $result; ?></p>
            <h4>Method implementation integrity:</h4>
            <p><?php echo $methodImplementation; ?></p>
            <div class="clear"></div>
        </div>
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>