<?php
/**
* @author Eric Shang @ nexs.co.nz
* main template
*/

function showItemList(){
	$extraSql = "";
	if(isset($_GET['category']) && isset($_GET['cid'])){
		
		$category = trim($_GET['category']);
		$cid = (int)$_GET['cid'];
		if($category == "methodology" && $cid>0){
			$extraSql = "  AND m.`mid` = '$cid' ";
		}else if($category == "method" && $cid>0){
			$extraSql = "  AND m.`method_id` = '$cid' ";
		}
	}

	require_once('./system/db.php');
	$db=new DB();
	$sql = "select * from `evidenceitem` e, `method` m WHERE e.`method_id` = m.`method_id` $extraSql ";
	$query = $db->query($sql);
	$rows = $query->rows;
	$num=$query->num_rows;
	$i=1;
	foreach($rows as $v){
		echo "<div class='castSheet'>";
		$title = $v['title'];
		$what = $v['what'];
		$iid = $v['iid'];
		echo "<h2><a href='?act=showItem&id=$iid'>$title</a></h2>
			<p>$what</p>";
		echo "</div>";

	}
	if($num<1){
		echo "<div class='castSheet'>";
		$title = "Nothing Found";
		echo "<h2>$title</h2>";
		echo "</div>";
	}
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
    
        <?php showItemList(); ?>
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>