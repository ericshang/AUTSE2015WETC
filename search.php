<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
require_once("./system/global.php");

function showSearchResult(){
	$defualtAndOr = 1;// "And"
	if(isset($_POST['title'])){
		$authorSql = "";
		$yearSql = "";
		$resultSql ="";
		$metricSql = "";
	
		$title = $_POST['title'];
		
		
		$authorAndOr = $_POST['authorAndOr']==2 ? $_POST['authorAndOr']:$defualtAndOr;
		$authorAndOr2 = (int) $authorAndOr;
		$authorAndOr = $authorAndOr ==2 ? " OR " :" AND " ;
		$author = $_POST['author'];
		$authorSql = strlen($author)>0 ? $authorAndOr." S.`author` LIKE '%$author%' ": "";
		
		
		$yearAndOr = $_POST['yearAndOr'] == 2 ?  $_POST['yearAndOr'] :$defualtAndOr;
		$yearAndOr2 = (int) $yearAndOr;
		$yearAndOr = $yearAndOr==2 ? " OR " :" AND " ;
		$year = (int)$_POST['year'];
		$yearSql = $year>0 ? $yearAndOr."S.`year` = $year ": "";
	
	
		$resultAndOr = $_POST['resultAndOr']==2 ? $_POST['resultAndOr']:$defualtAndOr;
		$resultAndOr2 = (int) $resultAndOr;
		$resultAndOr =$resultAndOr==2 ? " OR " :" AND " ;
		$result = $_POST['result'];
		$resultSql = strlen($result) >0 ? $resultAndOr." I.`result` LIKE '%$result%' ": "";
		
		
		$metricAndOr = $_POST['metricAndOr']==2? $_POST['metricAndOr']:$defualtAndOr;
		$metricAndOr2 = (int) $metricAndOr;
		$metricAndOr = $metricAndOr==2 ? " OR " :" AND " ;
		$Metric = $_POST['Metric'];
		$metricSql = strlen($Metric) >0 ? $metricAndOr." S.`metrics` LIKE '%$Metric%' ": "";
		
		
		$andSql = "";
		$andSql = $authorAndOr2 ==1 ? $authorSql :"";
		$andSql .= $yearAndOr2 ==1 ? $yearSql :"";
		$andSql .= $resultAndOr2 ==1 ? $resultSql :"";
		$andSql .= $metricAndOr2 ==1 ? $metricSql :"";
		
		$orSql = "";
		$orSql  = $authorAndOr2 ==2 ? $authorSql :"";
		$orSql .= $yearAndOr2 ==2 ? $yearSql :"";
		$orSql .= $resultAndOr2 ==2 ? $resultSql :"";
		$orSql .= $metricAndOr2 ==2 ? $metricSql :"";
		
		$sql = "SELECT I.`title`, I.`iid`, S.`author`,  S.`year`, S.`metrics`  
				FROM 
					`evidenceitem` I, `evidencesource` S 
				WHERE 
					I.`title` LIKE '%$title%' 
					$andSql  
					$orSql ;";
		require_once("./system/db.php");
		
		$db = new DB();
		$query = $db->query($sql);
		$num_rows = $query->num_rows;
		$rows = $query->rows;
		
		if($num_rows >0 ){		
		
			echo "<table class='articleListTable'>";
			echo "<tr class='trHeader'><td>id</td><td>title</td><td>author</td><td>year</td><td>metrics</td></tr>";
			$counter = 1;
			foreach($rows as $row){
				$iid = $row['iid'];
				$title = $row['title'];
				$author=$row['author'];
				$year = $row['year'];
				$metrics = $row['metrics'];
				
				$trClass = $counter%2 ==0 ?" class ='trGray' ":"";
				
				
				echo "<tr $trClass ><td>$iid</td><td><a href='./?act=showItem&id=$iid' >$title</a></td><td>$author</td><td>$year</td><td>$metrics</td></tr>";
				$counter++;
			}
			echo "</table>";
		}else{
			echo "No Result Found. ";
		}
	}
	
}

function doChecked($optionValue, $selectedValue){
	$checked = " selected='selected' ";
	if($optionValue == $selectedValue ){
		echo $checked;
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