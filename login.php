<?php
/**
* @author Eric Shang @ nexs.co.nz
* used to user reg, login, logout
*/
require_once("./system/global.php");
$uid = 0; 
$email = null; 
$password = null;
$regtime = null;
$role = null;
$activate = null;
$name = null;
$organization = null;

if($_action == "login"){
	if(isset($_SESSION['user'])){//user has logged in
		
	}
	require_once("./view/header.php");
	require_once("./view/login.htm");
	require_once("./view/footer.php");
}else if($_action == "dologin"){
	//if(isset($_SESSION))unset($_SESSION);
	if(isset($_POST['email']) && isset($_POST['password'])){
		$email= trim($_POST['email']);
		$password = trim($_POST['password']);
		$tempUser = new User($uid, $email, $password, $regtime, $role, $activate, $name, $organization);
		
		$url="";
		if($tempUser->login()){
			echo "login Successful";
			$url ="./";
		}else{
			echo  "login failed.";
			$url ="?";
		}
		_redirect($url);
	}
}else if($_action =="logout"){
	$tempUser = new User($uid, $email, $password, $regtime, $role, $activate, $name, $organization);
	if($tempUser->logout()){
		echo "user has logged out";
	}
	$url="./";
	_redirect($url);
}else if($_action =="reg"){
	require_once("./view/header.php");
	require_once("./view/reg.htm");
	require_once("./view/footer.php");
}else if($_action =="doreg"){
	if(isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['name'])){
		$email = trim($_POST['email']);
		$pw1 =  trim($_POST['password1']);
		$pw2 = trim($_POST['password2']);
		
		$password = $pw1 == $pw1 ? $pw1 : null;
		$name = trim($_POST['name']);
		$organization = trim($_POST['organization']);
		$tempUser = new User($uid, $email, $password, $regtime, $role, $activate, $name, $organization);
		if($tempUser->register()){
			echo "user registered!";
		}else{
			echo "User registration failed!";
		}		
	}else{
		echo "User registration failed!";
	}
	
}else{
	require_once("./view/header.php");
	require_once("./view/login.htm");
	require_once("./view/footer.php");
}
//destroy temp object
if(isset($tempUser)){ unset($tempUser); }
?>