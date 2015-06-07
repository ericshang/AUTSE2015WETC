<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class EvidenceSource{
	private $esid;
	private $iid;
	private $bibref;
	private $researchlevel;
	private $question;
	private $method;
	private $participants;
	private $metrics;
	private $submitby;
	private $approved;
	private $author;
	private $year;

	//constructor
	public function __construct($esid ,$iid ,$bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved ,$author,$year){
		$this->setEvidenceSource($esid,$iid ,$bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved,$author,$year);
	}
	
	//create new Methogology
	public function create(){
		$result = false;
		if($this->isExisted($this)==false){
			$esid= $this->esid ;
			$iid= $this->iid ;//must not be null
			$bibref= $this->bibref ;
			$researchlevel = $this->researchlevel ;
			$question = $this->question ;
			$method = $this->method;
			$participants = $this->participants;
			$metrics = $this->metrics;
			$submitby = $this->submitby;
			$approved = $this->approved;
			$author = $this->author;
			$year = $this->year;
			
			$sql = "INSERT INTO  `serller`.`evidencesource` (`iid` ,`bibref` ,`researchlevel` ,`question` ,`method` ,`participants` ,`metrics` ,`submitby` ,`approved` ,`author` ,`year`)
					VALUES ('$iid', '$bibref', '$researchlevel','$question','$method',  '$participants','$metrics','$submitby',  '$approved', '$author','$year');";
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
		if($this->isExisted($this) && $tempNew->getEsId() >0 && $tempNew->getEsId() == $this->getEsId()  && $tempNew->getIid() >0 && !empty($tempNew->getBibRef()) ){
			$esid= $tempNew->getEsId() ;
			$iid= $tempNew->getIid();
			$bibref= $tempNew->getBibRef() ;
			$researchlevel = $tempNew->getResearchLevel() ;
			$question = $tempNew->getQuestion() ;
			$method = $tempNew->getMethod();
			$participants = $tempNew->getParticipants();
			$metrics = $tempNew->getMetrics();
			$submitby = $tempNew->getSubmitby();
			$approved = $tempNew->getApproved();
			$author = $tempNew->getAuthor();
			$year = $tempNew->getYear();
			
			$sql = "UPDATE  `EvidenceSource` SET `iid` = '".@mysql_escape_string($iid)."',`bibref` = '".@mysql_escape_string($bibref)."',`researchlevel` = '".@mysql_escape_string($researchlevel)."',`question` = '".@mysql_escape_string($question)."', `method` = '".@mysql_escape_string($method)."',`participants` = '".@mysql_escape_string($participants)."',`metrics` = '".@mysql_escape_string($metrics)."',`submitby` = ".@mysql_escape_string($submitby).",`approved` = ".@mysql_escape_string($approved).",`author` = '".@mysql_escape_string($author)."',`year` = ".@mysql_escape_string($year)." WHERE `esid` = '".$this->esid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->setEvidenceSource($this->esid ,$iid, $bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved,$author,$year);
				$result = true;
			}
		}
		return $result;
	}

	private function setEvidenceSource($esid ,$iid, $bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved,$author,$year){
		$this->esid = $esid;
		$this->iid = $iid;
		$this->bibref = $bibref;
		$this->researchlevel = $researchlevel;
		$this->question = $question;
		$this->method = $method;
		$this->participants = $participants;
		$this->metrics = $metrics;
		$this->submitby = $submitby;
		$this->approved = $approved;
		$this->author = $author;
		$this->year = $year;
	}
	
	//gettters
	public function getEsId(){ return $this->esid; }
	public function getIid(){ return $this->iid; }
	public function getBibRef(){ return $this->bibref; }
	public function getResearchLevel(){ return $this->researchlevel; }
	public function getMethod(){ return $this->method; }
	public function getParticipants(){ return $this->participants; }
	public function getQuestion(){ return $this->question; }
	public function getMetrics(){ return $this->metrics; }
	public function getSubmitby(){ return $this->submitby; }
	public function getApproved(){ return $this->approved; }
	public function getAuthor(){ return $this->author; }
	public function getYear(){ return $this->year; }
	
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
			   $this->iid === $es->iid  && 
			   $this->bibref === $es->bibref  && 
			   $this->researchlevel === $es->researchlevel &&
			   $this->question === $es->question  && 
			   $this->method === $es->method  && 
			   $this->participants === $es->participants &&
			   $this->metrics === $es->metrics  && 
			   $this->submitby === $es->submitby  && 
			   $this->approved === $es->approved  &&
			   $this->author === $es->author  &&
			   $this->year === $es->year  ;
	}
	
	//retrieve object by primary key
	public function retrieve($esid){
		$result = false;
		if($esid>0){
			$sql ="SELECT * FROM `evidencesource` WHERE `esid`='$esid'";
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			$num = $query->num_rows;
			if($num>0){
				$row = $query->row;
				$esid= $row['esid'];
				$iid= $row['iid'];
				$bibref= $row['bibref'];
				$researchlevel = $row['researchlevel'];
				$question = $row['question'];
				$method = $row['method'];
				$participants = $row['participants'];
				$metrics = $row['metrics'];
				$submitby = $row['submitby'];
				$approved = $row['approved'];
				$author = $row['author'];
				$year = $row['year'];
				
				$this->setEvidenceSource($esid ,$iid, $bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved,$author,$year);
				$result = true;
			}
		}
		return $result;
	}
	
	//retrieve object by primary key
	public function retrieveByIId($iid){
		$result = false;
		if($iid>0){
			$sql ="SELECT * FROM `evidencesource` WHERE `iid`='$iid'";
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			$num = $query->num_rows;
			if($num>0){
				$row = $query->row;
				$esid= $row['esid'];
				$iid= $row['iid'];
				$bibref= $row['bibref'];
				$researchlevel = $row['researchlevel'];
				$question = $row['question'];
				$method = $row['method'];
				$participants = $row['participants'];
				$metrics = $row['metrics'];
				$submitby = $row['submitby'];
				$approved = $row['approved'];
				$author = $row['author'];
				$year = $row['year'];
				
				$this->setEvidenceSource($esid ,$iid, $bibref ,$researchlevel,$question,$method,$participants,$metrics,$submitby,$approved,$author,$year);
				$result = true;
			}
		}
		return $result;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>