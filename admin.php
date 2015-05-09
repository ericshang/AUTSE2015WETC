<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
class Admin{
	private $uid;
	private $email;
	private $password;
	private $regtime;
	private $role;
	private $activate;
	private $name;
	private $organization;

	//constructor
	public function __construct($uid, $email, $password, $regtime, $role, $activate, $name, $organization){
		$this->setAdmin($uid, $email, $password, $regtime, $role, $activate, $name, $organization);
	}
	//register a new Admin
	public function register(){
		$regResult = false;
		if($this->isExisted($this)==false){
			$email = $this->email;
			$password = $this->password;
			$regtime = time();
			$role = $this->role;
			$activate = 0;
			$name = $this->name;
			$organization = $this->organization;
			
			$sql = "INSERT INTO  `admin` ( `uid` , `password` , `regtime` , `role` , `email` , `activate` ,`name` , `organization`) 
					VALUES (NULL ,  '$password',  '$regtime',  '$role',  '$email',  '$activate',  '$name',  '$organization');";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate admin
				
				$sql2 = "SELECT * FROM  `admin` WHERE `email` = '$email'";
				if($query = $db->query($sql2)){
					$row =  $query->row;
					$this->uid= $row['uid'];
				}
				$regResult = true;
			}
			 
		}
		return $regResult;
	}
	//user login
	public function login(){
		$result = false;
		//the session must have started, other wise it can not finish login
		if(isset($_SESSION)){//when login, the user is only passed the email and password to the create the user object
			$sql = "SELECT * FROM `admin` WHERE `email` = '".$this->email."' AND `password` = '".$this->password."' ;";
			//db connection
			require_once('./system/db.php');
			$db = new DB();
			$query = $db->query($sql);
			if($row = $query->row){
				if($query->num_rows <1 ){
					echo "user not found";
					return false;
				}
				//repopulate admin
				//update admin object
				$this->setAdmin($row['uid'], $row['email'], $row['password'], $row['regtime'], $row['role'], $row['activate'], $row['name'], $row['organization']);
				
				$temp = new Admin($row['uid'], $row['email'], "", $row['regtime'], $row['role'], $row['activate'], $row['name'], $row['organization']);
				$_SESSION["Admin"] = $temp;	//do not store pw in session		
				$result = true;
			}
		}
		return $result;
	}
	//user logout
	public function logout(){
		if(isset($_SESSION) && isset($_SESSION['Admin'])){
			unset($_SESSION['Admin']);
		}
	}
	//update current user information using the newTempUser, uid and email are NOT changeable
	public function update($newTempUser){
		$result = false;
		if($newTempUser->uid > 0 && $newTempUser->uid == $this->uid && !empty($newTempUser->email) && $newTempUser->email == $this->email){
			$email = $newTempUser->email;
			$password = $newTempUser->password;
			$role = $newTempUser->role;
			$activate = $newTempUser->activate;
			$name = $newTempUser->name;
			$organization = $newTempUser->organization;
			
			$sql = "UPDATE  `admin` SET `password` = '$password' , `role` = '$role' , `email`='$email'  , `activate`='$activate' , `name` = '$name' , `organization` = '$organization' WHERE `uid` = '".$this->uid."'";
			require_once('./system/db.php');
			$db = new DB();
			if($db->query($sql)){
				//repopulate user
				setUser($this->uid, $email, $password, $this->regtime, $role, $activate, $name, $organization);
				//update sessions
				if(isset($_SESSION) && isset($_SESSION['Admin'])){
					$temp = new Admin($this->uid, $email, '', $this->regtime, $role, $activate, $name, $organization);
					$_SESSION['Admin'] = $temp;
				}
				$result = true;
			}
		}
		return $result;
	}

	//check if the user has existed
	private function isExisted($admin){
		$result = false;
		if($admin->email != null){
			$sql = "SELECT * FROM `admin` WHERE `email` = '".$admin->email."' ";
			if($user->uid){
				$sql = "SELECT * FROM `admin` WHERE `uid` = '".$admin->uid."' ";
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
	
	private function setAdmin($uid, $email, $password, $regtime, $role, $activate, $name, $organization){
		$this->uid = $uid;
		$this->email = $email;
		$this->password = $password;
		$this->regtime = $regtime;
		$this->role = $role;
		$this->activate = $activate;
		$this->name = $name;
		$this->organization = $organization;
	}
	
	//gettters
	public function getUid(){ return $this->uid; }
	public function getEmail(){ return $this->email; }
	public function getPassword(){ return $this->password; }
	public function getRegtime(){ return $this->regtime; }
	public function getRole(){ return $this->role; }
	public function getActivate(){ return $this->activate; }
	public function getName(){ return $this->name; }
	public function getOrganization(){ return $this->organization; }
	
	//check is two users are equal
	public function isEqual($user){
		return $this->uid === $user->uid  && 
			   $this->email === $user->email  && 
			   $this->password === $user->password  && 
			   $this->regtime === $user->regtime  && 
			   $this->role === $user->role  && 
			   $this->activate === $user->activate  && 
			   $this->name === $user->name  && 
			   $this->organization === $user->organization ;
	}
	
	public function __destruct() {
		unset($this);
	}
}
?>