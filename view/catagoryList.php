<?php
/**
* @author Eric Shang @ nexs.co.nz
* the catagorylist on the left nav
*/
function showCatagory(){
	$result ="";
	$sql ="SELECT * FROM  `methodology` ;";
	require_once('./system/db.php');
	$db = new DB();
	$query = $db->query($sql);
	$num = $query->num_rows;
	$rows = $query->rows;
	
	foreach($rows as $v){
		$mid = $v['mid'];
		$name = $v['name'];
		$description = $v['description'];
		$tempMethodology = new Methodology($mid, $name, $description);
		
		$tempMethodology->setChildren();
		$methods = $tempMethodology->getChildren(); // this is an array
		
		$childrenList = "";
		if($methods != null){
			$childrenList .="<div><ul class='childUl'>";
			foreach($methods as $method){
				 $childrenList .= "<li><a href=''>".$method->getName()."</a></li>";
			}
			$childrenList .="</ul></div>";
		}
				
		$result .= "<li><a href=''>$name</a> $childrenList</li>";
	}
	echo $result;
}

?>

<ul class="mainLeftBarUl">
<?php showCatagory(); ?>
</ul>
