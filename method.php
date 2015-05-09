<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class Method{
	private $method_id;
	private $name;
	private $description;
	private $mid;

	//constructor
	public function __construct($method_id, $mid, $name, $description){
		$this->SetMethod($method_id, $mid, $name, $description);
	}
	
	//create new Methogology
	public function create(){
		$result = false;
		if($this->isExisted($this)==false){
			$method_id = $this->method_id;
			$mid = $this->mid;
			$name = $this->name;
			$description = $this->description;
			
			$sql = "INSERT INTO  `method` ( `name` , `description`,`mid`) 
					VALUES ( '$name',  '$description','$mid');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate the object
				$sql2 = "SELECT * FROM  `method` WHERE `name` = '$name'";
				if($query = $db->query($sql2)){
					$row =  $query->row;
					$this->method_id= $row['method_id'];
					$result = true;
				}
			}
		}
		return $result;
	}
	public function delete(){
		$result = false;
		//must check if no method is using this methogology
		//to do
		
		if($this->isExisted($this)){
			$sql = "DELETE FROM `method` WHERE `method_id` = '".$this->method_id."'";
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
		if($this->isExisted($this) && $tempNew->method_id >0 && $tempNew->method_id == $this->method_id && !empty($tempNew->name) ){
			$name = $tempNew->name;
			$description = $tempNew->description;
			$mid = $tempNew->mid;
			
			$sql = "UPDATE  `method` SET `name` = '".@mysql_escape_string($name)."',`description` = '".@mysql_escape_string($description)."',`mid` = '".@mysql_escape_string($mid)."' WHERE `method_id` = '".$this->method_id."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->setMethodology($this->method_id, $mid, $name, $description);
				$result = true;
			}
		}
		return $result;
	}

	private function SetMethod($method_id, $mid, $name, $description){
		$this->method_id = $method_id;
		$this->mid = $mid;
		$this->name = $name;
		$this->description = $description;
	}
	
	//gettters
	public function getMethodId(){ return $this->method_id; }
	public function getMid(){ return $this->mid; }
	public function getName(){ return $this->name; }
	public function getDescription(){ return $this->description; }
	
	//check if the Methogology has existed
	private function isExisted($method){
		$result = false;
		if($method->name != null){
			$sql = "SELECT * FROM `method` WHERE `name` = '".$method->name."' ";
			if($method->mid){
				$sql = "SELECT * FROM `method` WHERE `method_id` = '".$method->method_id."' ";
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
	public function isEqual($method){
		return $this->method_id ==$method->method_id &&
			   $this->mid === $method->mid  && 
			   $this->name === $method->name  && 
			   $this->description === $method->description  ;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>