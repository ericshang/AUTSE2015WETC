<?php
/**
* @author Eric Shang @ nexs.co.nz
* used to list all objects based on object type
*/
class List{
	private $objArray = array();
	private $objType;
	private $count; // number of members in the list

	//constructor
	public function __construct($objType){
		setObjType($objType);
	}
	//set up an array of objType, retrive from database
	public function setList(){//default, get all
		$regResult = false;
		if($this->getObjType() != null){
			$tableName = $this->getObjType();
			$sql = "SELECT * FROM `$tableName` ;";
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			$count = $query->num_rows;
			//set the List count 
			$this->setCount($count);
			if($count>0){//populate the List
				$rows = $query->rows;
				if(){
				}
			}
		}
		return $regResult;
	}
	
	public function setListByNum(){//get part of list
		$regResult = false;
		
		
		return $regResult;
	}
	
	//gettters
	public function getObjArray(){ return $this->objArray; }
	public function getObjType(){ return $this->objType; }
	public function getCount(){ return $this->count; }
	//setters
	public function setObjArray($a){ $this->objArray = $a; }
	public function setObjType($type){ $this->objType = $type; }
	public function setCount($count){ $this->objType = $count; }
	

	
	public function __destruct() {
		unset($this);
	}
}
?>