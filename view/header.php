<?php
/**
* @author Eric Shang @ nexs.co.nz
* header template
*/
require_once("./system/global.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_title.$_siteName; ?></title>
<link href="images/default.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="images/main.js"></script>
</head>

<body>
<!--header start-->
<div class="boxHeader">
	<div class="boxHeaderLeft">
    	<h1><a href="./" style="text-decoration:none;">Serller</a></h1>
    </div>
    <div class="boxHeaderRight">
    	<ul class="headerNavUl" id="headerNavUl">
			<li><a href="./">Home</a></li>
            <?php
				/*if(isset($_SESSION['user'])){
					echo "<li><a href='./usercenter.php'>User Center</a></li>";
				}*/
				//open user center without login
				echo "<li><a href='./usercenter.php'>User Center</a></li>";
			
			 ?>
             <li><a href="./search.php">Search</a></li>
        </ul>
    </div>
    <div class="headerBoxSmallNav">
    	<?php
			if(isset($_SESSION['user'])){
				$u = $_SESSION['user']; //must define __autoload() before session start, otherwise session can not convert to obj
				$name = $u->getName();
				$uid = $u->getUid();
				echo "Hello, <a href='./usercenter.php'>$name</a> | <a href='./login.php?act=logout'>logout</a>";
			}else{
				echo "<a href='./login.php'>User Login</a> | <a href='./login.php?act=reg'>Register</a>";
			}
		?>
    </div>
</div>
<div class="boxMainTopMarker"></div>


<!--header end-->


