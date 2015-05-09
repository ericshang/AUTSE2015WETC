<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class EvidenceSource{
	private $esid;
	private $bibref;
	private $researchlevel;
	private $question;
	private $method;
	private $participants;
	private $metrics;
	private $submitby;
	private $approved;

	//constructor
	public function __construct($esid ,$bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved){
		setEvidenceSource($esid ,$bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved);
	}
	
	//create new Methogology
	public function create(){
		$result = false;
		if($this->isExisted($this)==false){
			$esid= $this->esid ;
			$bibref= $this->bibref ;
			$researchlevel = $this->researchlevel ;
			$question = $this->question ;
			$method = $this->method;
			$participants = $this->participants;
			$metrics = $this->metrics;
			$submitby = $this->submitby;
			$approved = $this->approved;
			
			$sql = "INSERT INTO  `EvidenceSource` ( `bibref` , `researchlevel`,`question`,`method` , `participants`,`metrics`,`submitby` , `approved`) 
					VALUES ( '$bibref',  '$researchlevel','$question','$method',  '$participants','$metrics','$submitby',  '$approved');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate the object
				$sql2 = "SELECT * FROM  `EvidenceSource` WHERE `bibref` = '$bibref'";
				if($query = $db->query($sql2)){
					$row =  $query->row;
					$this->esid= $row['esid'];
					$result = true;
				}
			}
		}
		return $result;
	}
	public function delete(){
		$result = false;
		//must check if no CredibilityRa<ng is using this EvidenceSource
		//to do
		
		if($this->isExisted($this)){
			$sql = "DELETE FROM `EvidenceSource` WHERE `esid` = '".$this->esid."'";
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
		if($this->isExisted($this) && $tempNew->esid >0 && $tempNew->esid == $this->esid && !empty($tempNew->bibref) ){
			$esid= $tempNew->esid ;
			$bibref= $tempNew->bibref ;
			$researchlevel = $tempNew->researchlevel ;
			$question = $tempNew->question ;
			$method = $tempNew->method;
			$participants = $tempNew->participants;
			$metrics = $tempNew->metrics;
			$submitby = $tempNew->submitby;
			$approved = $tempNew->approved;
			
			$sql = "UPDATE  `EvidenceSource` SET `bibref` = '".@mysql_escape_string($bibref)."',`researchlevel` = '".@mysql_escape_string($researchlevel)."',`question` = '".@mysql_escape_string($question)."`method` = '".@mysql_escape_string($method)."',`participants` = '".@mysql_escape_string($participants)."',`metrics` = '".@mysql_escape_string($metrics)."',`submitby` = '".@mysql_escape_string($submitby)."',`approved` = '".@mysql_escape_string($approved)."' WHERE `esid` = '".$this->esid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->setEvidenceSource($this->esid ,$bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved);
				$result = true;
			}
		}
		return $result;
	}

	private function setEvidenceSource($esid ,$bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved){
		$this->esid = $esid;
		$this->bibref = $bibref;
		$this->researchlevel = $researchlevel;
		$this->question = $question;
		$this->method = $method;
		$this->participants = $participants;
		$this->metrics = $metrics;
		$this->submitby = $submitby;
		$this->approved = $approved;
	}
	
	//gettters
	public function getEsId(){ return $this->esid; }
	public function getBibRef(){ return $this->bibref; }
	public function getResearchLevel(){ return $this->researchlevel; }
	public function getMethod(){ return $this->method; }
	public function getParticipants(){ return $this->participants; }
	public function getMetrics(){ return $this->metrics; }
	public function getSubmitby(){ return $this->submitby; }
	public function getApproved(){ return $this->approved; }
	
	//check if the Methogology has existed
	private function isExisted($EvidenceSource){
		$result = false;
		if($EvidenceSource->bibref != null){
			$sql = "SELECT * FROM `EvidenceSource` WHERE `bibref` = '".$EvidenceSource->bibref."' ";
			if($EvidenceSource->esid){
				$sql = "SELECT * FROM `EvidenceSource` WHERE `esid` = '".$EvidenceSource->esid."' ";
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
	public function isEqual($es){
		return $this->esid === $es->esid  && 
			   $this->bibref === $es->bibref  && 
			   $this->researchlevel === $es->researchlevel
			   $this->question === $es->question  && 
			   $this->method === $es->method  && 
			   $this->participants === $es->participants
			   $this->metrics === $es->metrics  && 
			   $this->submitby === $es->submitby  && 
			   $this->approved === $es->approved  ;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>