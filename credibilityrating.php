<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class CredibilityRating{
	private $esid;//storign evidencesourceid 
	private $credibilitylevel;
	private $reason;
	private $rater;//storing unique rater's uid

	//constructor
	public function __construct($esid, $credibilitylevel, $reason, $rater){
		$this->setCredibilityRating($esid, $credibilitylevel, $reason, $rater);
	}
	
	//create new CredibilityRating
	public function create(){
		$result = false;
		if($this->isExisted($this)==false){
			$esid = $this->esid;
			$credibilitylevel = $this->credibilitylevel;
			$reason = $this->reason;
			$rater = $this->rater;
			if($esid<1 || $rater <1 || $credibilitylevel<0 ){//composite key, must not be empty
				return false;
			}			
			$sql = "INSERT INTO  `CredibilityRating` (`esid` `credibilitylevel` , `reason`,`rater`) 
					VALUES ( '$esid','$credibilitylevel', '$reason','$rater');";
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
			$sql = "DELETE FROM `CredibilityRating` WHERE `esid` = '".$this->esid."' AND `rater` = '".$this->rater."'";
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
		if($this->isExisted($this) && $tempNew->esid >0 && $tempNew->rater>0 && $tempNew->esid == $this->esid && $tempNew->rater== $this->rater && $tempNew->credibilitylevel >=0 ){
			$esid = $tempNew->esid;
			$credibilitylevel = $tempNew->credibilitylevel;
			$reason = $tempNew->reason;
			$rater = $tempNew->rater;
			
			$sql = "UPDATE  `CredibilityRating` SET `esid` = '".@mysql_escape_string($esid)."',`credibilitylevel` = '".@mysql_escape_string($credibilitylevel)."',`reason` = '".@mysql_escape_string($reason)."',`rater` = '".@mysql_escape_string($rater)."' WHERE `rater` = '".$this->rater."' AND `esid` = '".$this->esid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				$this->setCredibilityRating($esid, $credibilitylevel, $reason, $rater);
				$result = true;
			}
		}
		return $result;
	}

	private function setCredibilityRating($esid, $credibilitylevel, $reason, $rater){
		$this->esid = $esid;
		$this->credibilitylevel = $credibilitylevel;
		$this->reason = $reason;
		$this->rater = $rater;
	}
	
	//gettters
	public function getEsId(){ return $this->esid; }
	public function getCredibilityLevel(){ return $this->credibilitylevel; }
	public function getReason(){ return $this->reason; }
	public function getRater(){ return $this->rater; }
	
	//check if the Methogology has existed
	private function isExisted($cr){
		$result = false;
		if($cr->rater >0 && $cr->esid >0){
			$sql = "SELECT * FROM `CredibilityRating` WHERE `esid` = '".$cr->esid."' AND `rater` = '".$cr->rater."' ";
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
		return $this->esid === $cr->esid  && 
			   $this->credibilitylevel === $cr->credibilitylevel  && 
			   $this->reason === $cr->reason &&
			   $this->rater === $cr->rater  ;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>