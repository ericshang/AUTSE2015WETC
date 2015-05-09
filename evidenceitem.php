<?php
class EvidenceItem{
	private $iid;
	private $method_id;
	private $why;
	private $who;
	private $what;
	private $where;
	private $when;
	private $how;
	private $benefit;
	private $result;
	private $methodImplementation;
	private $esid;//every evidenceItem must belong to an evidence Source

	//constructor
	public function __construct($iid ,$method_id ,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$esid){
		setEvidenceItem($iid ,$method_id ,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$esid);
	}
	
	//create new Methogology
	public function create(){
		$result = false;
		if($this->isExisted($this)==false){
			$iid= $this->iid ;
			$method_id= $this->method_id ;
			$why = $this->why ;
			$who = $this->who ;
			$what = $this->what;
			$where = $this->where;
			$when = $this->when;
			$how = $this->how;
			$benefit = $this->benefit;
			$result = $this->result;
			$methodImplementation = $this->methodImplementation;
			$esid= $this->esid ;
			
			$sql = "INSERT INTO  `EvidenceItem` ( `esid` , `method_id`,`why`,`who` , `what`,`where`,`when` , `how`,`benefit`,`result` , `methodImplementation`) 
					VALUES ( '$esid',  '$method_id','$why','$who',  '$what','$where','$when',  '$how','$benefit','$result',  '$methodImplementation');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate the object
				$sql2 = "SELECT * FROM  `EvidenceItem` WHERE `esid` = '$esid' AND `what` = '$what'";
				if($query = $db->query($sql2)){
					$row =  $query->row;
					$this->iid= $row['iid'];
					$result = true;
				}
			}
		}
		return $result;
	}
	public function delete(){
		$result = false;
		//must check if no ConfidenceRating is using this EvidenceItem
		//to do
		
		if($this->isExisted($this)){
			$sql = "DELETE FROM `EvidenceItem` WHERE `iid` = '".$this->iid."'";
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
		
		$iid ,$method_id ,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$esid
		
		if($this->isExisted($this) && $tempNew->iid >0 && $tempNew->esid >0){
			$iid= $tempNew->iid ;
			$method_id= $tempNew->method_id ;
			$why = $tempNew->why ;
			$who = $tempNew->who ;
			$what = $tempNew->what;
			$where = $tempNew->where;
			$when = $tempNew->when;
			$how = $tempNew->how;
			$benefit = $tempNew->benefit;
			$result = $tempNew->result;
			$methodImplementation = $tempNew->methodImplementation;
			$esid= $tempNew->esid ;
			
			$sql = "UPDATE  `EvidenceItem` SET `method_id` = '".@mysql_escape_string($method_id)."',`why` = '".@mysql_escape_string($why)."',`who` = '".@mysql_escape_string($who)."`what` = '".@mysql_escape_string($what)."',`where` = '".@mysql_escape_string($where)."',`when` = '".@mysql_escape_string($when)."',`how` = '".@mysql_escape_string($how)."',`benefit` = '".@mysql_escape_string($benefit)."',`result` = '".@mysql_escape_string($result)."',`methodImplementation` = '".@mysql_escape_string($methodImplementation)."',`esid` = '".@mysql_escape_string($esid)."' WHERE `iid` = '".$this->iid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				setEvidenceItem($iid ,$method_id ,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$esid);
				$result = true;
			}
		}
		return $result;
	}

	private function setEvidenceItem($iid ,$method_id ,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$esid){
		$this->iid = $iid;
		$this->method_id = $method_id;
		$this->why = $why;
		$this->who = $who;
		$this->what = $what;
		$this->where = $where;
		$this->when = $when;
		$this->how = $how;
		$this->benefit = $benefit;
		$this->result = $result;
		$this->methodImplementation = $methodImplementation;
		$this->esid = $esid;
	}
	
	//gettters
	public function getIid(){ return $this->iid; }
	public function getMethodId(){ return $this->method_id; }
	public function getWhy(){ return $this->why; }
	public function getWho(){ return $this->who; }
	public function getWhat(){ return $this->what; }
	public function getWhere(){ return $this->where; }
	public function getWhen(){ return $this->when; }
	public function getHow(){ return $this->how; }
	public function getBenefit(){ return $this->benefit; }	
	public function getResult(){ return $this->result; }
	public function getMethodImplementation(){ return $this->methodImplementation; }
	public function getEsId(){ return $this->esid; }
	
	//check if the Methogology has existed
	private function isExisted($EvidenceItem){
		$result = false;
		if($EvidenceItem->iid >0 && $EvidenceItem->esid >0 ){
			$sql = "SELECT * FROM `EvidenceItem` WHERE `iid` = '".$EvidenceItem->iid."' AND `esid` = '".$EvidenceItem->esid."' ";
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
	public function isEqual($item){
		return $this->iid === $item->iid  && 
			   $this->method_id === $item->method_id  && 
			   $this->why === $item->why
			   $this->who === $item->who  && 
			   $this->what === $item->what  && 
			   $this->where === $item->where
			   $this->when === $item->when  && 
			   $this->how === $item->how  && 
			   $this->benefit === $item->benefit &&
			   $this->result === $item->result  && 
			   $this->methodImplementation === $item->methodImplementation  && 
			   $this->esid === $item->esid  ;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>