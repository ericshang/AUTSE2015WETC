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
		$result .= "<li>".$v['name']."</li>";
	}
	echo $result;
}

?>

<ul class="mainLeftBarUl">
<?php showCatagory(); ?>
</ul>
