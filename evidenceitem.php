<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class EvidenceItem{
	private $iid;
	private $method_id;
	private $title;
	private $why;
	private $who;
	private $what;
	private $where;
	private $when;
	private $how;
	private $benefit;
	private $result;
	private $methodImplementation;
	private $uid;

	//constructor
	public function __construct($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid){
		$this->setEvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid);
	}
	
	//create new Methogology
	public function create(){
		$result = false;
		
		if(!($this->isExisted($this))){
			$iid= $this->iid ;
			$method_id= $this->method_id ;
			$title= $this->title ;
			$why = $this->why ;
			$who = $this->who ;
			$what = $this->what;
			$where = $this->where;
			$when = $this->when;
			$how = $this->how;
			$benefit = $this->benefit;
			$result = $this->result;
			$methodImplementation = $this->methodImplementation;
			$uid = $this->uid;
			
			$sql = "INSERT INTO  `EvidenceItem` (`title` ,
													`why` ,
													`who` ,
													`what` ,
													`where` ,
													`when` ,
													`how` ,
													`benefit` ,
													`result` ,
													`methodImplementation` ,
													`method_id`,`uid`) 
					VALUES ( '$title','$why','$who', '$what','$where','$when', '$how','$benefit','$result', '$methodImplementation','$method_id','$uid');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate the object
				$sql2 = "SELECT * FROM  `EvidenceItem` WHERE `title` = '$title'";
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
		
		if($this->isExisted($this) && $tempNew->iid >0 && $tempNew->title != null){
			$iid= $tempNew->iid ;
			$method_id= $tempNew->method_id ;
			$title= $tempNew->title ;
			$why = $tempNew->why ;
			$who = $tempNew->who ;
			$what = $tempNew->what;
			$where = $tempNew->where;
			$when = $tempNew->when;
			$how = $tempNew->how;
			$benefit = $tempNew->benefit;
			$result = $tempNew->result;
			$methodImplementation = $tempNew->methodImplementation;
			$dui= $tempNew->uid ;
			
			$sql = "UPDATE  `EvidenceItem` SET `method_id` = '".@mysql_escape_string($method_id)."',`title` = '".@mysql_escape_string($title)."',`why` = '".@mysql_escape_string($why)."',`who` = '".@mysql_escape_string($who)."`what` = '".@mysql_escape_string($what)."',`where` = '".@mysql_escape_string($where)."',`when` = '".@mysql_escape_string($when)."',`how` = '".@mysql_escape_string($how)."',`benefit` = '".@mysql_escape_string($benefit)."',`result` = '".@mysql_escape_string($result)."',`methodImplementation` = '".@mysql_escape_string($methodImplementation)."',`uid` = '".@mysql_escape_string($uid)."' WHERE `iid` = '".$this->iid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->setEvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid);
				$result = true;
			}
		}
		return $result;
	}

	private function setEvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid){
		$this->iid = $iid;
		$this->method_id = $method_id;
		$this->title = $title;
		$this->why = $why;
		$this->who = $who;
		$this->what = $what;
		$this->where = $where;
		$this->when = $when;
		$this->how = $how;
		$this->benefit = $benefit;
		$this->result = $result;
		$this->methodImplementation = $methodImplementation;
		$this->uid = $uid;
	}
	
	//gettters
	public function getIid(){ return $this->iid; }
	public function getMethodId(){ return $this->method_id; }
	public function getTitle(){ return $this->title; }
	public function getWhy(){ return $this->why; }
	public function getWho(){ return $this->who; }
	public function getWhat(){ return $this->what; }
	public function getWhere(){ return $this->where; }
	public function getWhen(){ return $this->when; }
	public function getHow(){ return $this->how; }
	public function getBenefit(){ return $this->benefit; }	
	public function getResult(){ return $this->result; }
	public function getMethodImplementation(){ return $this->methodImplementation; }
	public function getUid(){ return $this->uid; }
	
	//check if the Methogology has existed
	private function isExisted($EvidenceItem){
		$result = false;
		if($EvidenceItem->method_id >0 && $EvidenceItem->title !=null){
			$sql = "SELECT * FROM `EvidenceItem` WHERE `method_id` = '".$EvidenceItem->method_id."' AND `title` = '".$EvidenceItem->title."' ";
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
			   $this->title === $item->title  && 
			   $this->why === $item->why &&
			   $this->who === $item->who  && 
			   $this->what === $item->what  && 
			   $this->where === $item->where &&
			   $this->when === $item->when  && 
			   $this->how === $item->how  && 
			   $this->benefit === $item->benefit &&
			   $this->result === $item->result  && 
			   $this->methodImplementation === $item->methodImplementation &&
			   $this->uid === $item->uid;
	}
	
	
	//retrieve object by primary key
	public function retrieve($iid){
		if($iid>0){
			$sql ="SELECT * FROM `evidenceitem` WHERE `iid`='$iid'";
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			$num = $query->num_rows;
			if($num>0){
				$row = $query->row;
				$iid= $row['iid'];
				$method_id= $row['method_id'];
				$title= $row['title'];
				$why = $row['why'];
				$who = $row['who'];
				$what = $row['what'];
				$where =$row['where'];
				$when = $row['when'];
				$how = $row['how'];
				$benefit = $row['benefit'];
				$result = $row['result'];
				$methodImplementation = $row['methodImplementation'];
				
				$this->setEvidenceItem($iid ,$method_id ,$title,$why,$who,$what,$where,$when,$how,$benefit,$result,$methodImplementation,$uid);
			}
		}
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>