<?php
class ConfidenceRating{
	private $iid;//storign evidenceItemid 
	private $credibilitylevel;
	private $reason;
	private $rater;//storing unique rater's uid

	//constructor
	public function __construct($iid, $credibilitylevel, $reason, $rater){
		$this->setConfidenceRating($iid, $credibilitylevel, $reason, $rater);
	}
	
	//create new ConfidenceRating
	public function create(){
		$result = false;
		if($this->isExisted($this)==false){
			$iid = $this->iid;
			$credibilitylevel = $this->credibilitylevel;
			$reason = $this->reason;
			$rater = $this->rater;
			if($esid<1 || $rater <1 || $credibilitylevel<0 ){//composite key, must not be empty
				return false;
			}			
			$sql = "INSERT INTO  `ConfidenceRating` (`iid` `credibilitylevel` , `reason`,`rater`) 
					VALUES ( '$iid','$credibilitylevel', '$reason','$rater');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				$result = true;
			}
		}
		return $result;
	}
	public function delete(){
		$result = false;
		if($this->isExisted($this)){
			$sql = "DELETE FROM `ConfidenceRating` WHERE `iid` = '".$this->iid."' AND `rater` = '".$this->rater."'";
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
		if($this->isExisted($this) && $tempNew->iid >0 && $tempNew->rater>0 && $tempNew->iid == $this->iid && $tempNew->rater== $this->rater && $tempNew->credibilitylevel >=0 ){
			$iid = $tempNew->iid;
			$credibilitylevel = $tempNew->credibilitylevel;
			$reason = $tempNew->reason;
			$rater = $tempNew->rater;
			
			$sql = "UPDATE  `ConfidenceRating` SET `iid` = '".@mysql_escape_string($iid)."',`credibilitylevel` = '".@mysql_escape_string($credibilitylevel)."',`reason` = '".@mysql_escape_string($reason)."',`rater` = '".@mysql_escape_string($rater)."' WHERE `rater` = '".$this->rater."' AND `iid` = '".$this->iid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->SetCredibilityRating($iid, $credibilitylevel, $reason, $rater);
				$result = true;
			}
		}
		return $result;
	}

	private function setConfidenceRating($iid, $credibilitylevel, $reason, $rater){
		$this->iid = $iid;
		$this->credibilitylevel = $credibilitylevel;
		$this->reason = $reason;
		$this->rater = $rater;
	}
	
	//gettters
	public function getIid(){ return $this->iid; }
	public function getCredibilityLevel(){ return $this->credibilitylevel; }
	public function getReason(){ return $this->reason; }
	public function getRater(){ return $this->rater; }
	
	//check if the Methogology has existed
	private function isExisted($cr){
		$result = false;
		if($cr->rater >0 && $cr->iid >0){
			$sql = "SELECT * FROM `ConfidenceRating` WHERE `iid` = '".$cr->iid."' AND `rater` = '".$cr->rater."' ";
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
	public function isEqual($cr){
		return $this->iid === $cr->iid  && 
			   $this->credibilitylevel === $cr->credibilitylevel  && 
			   $this->reason === $cr->reason &&
			   $this->rater === $cr->rater  ;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>