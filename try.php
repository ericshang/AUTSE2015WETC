<?php
/**
* @author Eric Shang @ nexs.co.nz
*/
session_start();
require_once("./user.php");

$uid = null;
$email = "email@email.com";
$password = "123456";
$regtime = "0";
$role = "1";
$activate = "1";
$name = "a new user";
$organization = "";

$user = new User($uid, $email, $password, $regtime, $role, $activate, $name, $organization);
$user2 = new User($uid, $email, $password, $regtime, $role, $activate, 'name', $organization);

if($user->register()){
	echo "Yay, user registered!";
}else{
	$re = $user->login();
	if($user->login()){
		echo "user logined!";
	}else{
		echo "Nothing happened!";
	}
}
echo "<br .>";
if(isset($_SESSION['user'])){
	echo "user session exisited";
	$u = $_SESSION['user'];
	echo "User email is: ". $u->getEmail();
}else{
	echo "no user session";
}
echo "<br />";
echo "now user will log out";
//$user->logout();
echo "<br />";
echo "check is user existed: ";
print_r($_SESSION['user']);
echo "check if it's equal";

if($user->isEqual($user2)){
	echo "true";
}else{
	echo "false";
}

?>