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
    	<h1>Serller</h1>
    </div>
    <div class="boxHeaderRight">
    	<ul class="headerNavUl" id="headerNavUl">
			<li><a href="./">Home</a></li>
             <li>About Serller</li>
             <li><a href="https://www.linkedin.com/in/ericshang">The Developer</a></li>
        </ul>
    </div>
    <div class="headerBoxSmallNav">
    	<?php
			if(isset($_SESSION['user'])){
				$u = $_SESSION['user']; //must define __autoload() before session start, otherwise session can not convert to obj
				$name = $u->getName();
				$uid = $u->getUid();
				echo "Hello, <a href='./usercenter.php?uid=$uid'>$name</a> | <a href='./login.php?act=logout'>logout</a>";
			}else{
				echo "<a href='./login.php'>User Login</a>";
			}
		?>
    </div>
</div>
<div class="boxMainTopMarker"></div>


<!--header end-->

