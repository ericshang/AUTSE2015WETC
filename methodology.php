<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class Methodology{
	private $mid;
	private $name;
	private $description;

	//constructor
	public function __construct($mid, $name, $description){
		$this->setMethodology($mid, $name, $description);
	}
	
	//create new Methogology
	public function create(){
		$regResult = false;
		if($this->isExisted($this)==false){
			$mid = $this->mid;
			$name = $this->name;
			$description = $this->description;
			
			$sql = "INSERT INTO  `methodology` ( `name` , `description`) 
					VALUES ( '$name',  '$description');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate the object
				$sql2 = "SELECT * FROM  `methodology` WHERE `name` = '$name'";
				if($query = $db->query($sql2)){
					$row =  $query->row;
					$this->mid= $row['mid'];
					$regResult = true;
				}
			}
		}
		return $regResult;
	}
	public function delete(){
		$result = false;
		//must check if no method is using this methogology
		//to do
		
		if($this->isExisted($this)){
			$sql = "DELETE FROM `methodology` WHERE `mid` = '".$this->mid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				unset($this);
				return true;
			}
		}
		return $result;
	}
	//use a new object to update current one
	public function update($tempNew){
		$result = false;		
		if($this->isExisted($this) && $tempNew->mid >0 && $tempNew->mid == $this->mid && !empty($tempNew->name) ){
			$name = $tempNew->name;
			$description = $tempNew->description;
			
			$sql = "UPDATE  `methodology` SET `name` = '".@mysql_escape_string($name)."',`description` = '".@mysql_escape_string($description)."' WHERE `mid` = '".$this->mid."'";
			echo $sql;
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->setMethodology($this->mid, $name, $description);
				$result = true;
			}
		}
		return $result;
	}

	private function setMethodology($mid, $name, $description){
		$this->mid = $mid;
		$this->name = $name;
		$this->description = $description;
	}
	
	//gettters
	public function getMid(){ return $this->mid; }
	public function getName(){ return $this->name; }
	public function getDescription(){ return $this->description; }
	
	//check if the Methogology has existed
	private function isExisted($methodology){
		$result = false;
		if($methodology->name != null){
			$sql = "SELECT * FROM `methodology` WHERE `name` = '".$methodology->name."' ";
			if($methodology->mid){
				$sql = "SELECT * FROM `methodology` WHERE `mid` = '".$methodology->mid."' ";
			}
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			$num = $query->num_rows;
			if($num>0){
				$result=true;
			}
		}
		return $result;
	}
	
	//check is two users are equal
	public function isEqual($methodology){
		return $this->mid === $methodology->mid  && 
			   $this->name === $methodology->name  && 
			   $this->description === $methodology->description  ;
	}
	
	//retrieve object by primary key
	public function retrieve($mid){//composite key
		if($iid>0 && $rater>0){
			$sql ="SELECT * FROM `methodology` WHERE `mid`='$mid'; ";
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			$num = $query->num_rows;
			if($num>0){
				$row = $query->row;
				$mid = $row['mid'];
				$name = $row['name'];
				$description = $row['description'];		
				$this->setMethodology($mid, $name, $description);
			}
		}
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>