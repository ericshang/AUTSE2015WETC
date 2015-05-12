<?php
/**
* @author Eric Shang @ nexs.co.nz
* main template
*/
?>

<!--mainbody start-->
<div class="boxMain">
	<div class="boxMainLeft">
    
    	<div class="mainLeftBar">
            <form>
            Search:<br />
            <div class="searchFormDiv">
                <input type="text" id="searchInput" /><input type="submit" value="Go" id="searchSubmit" />
            </div>
            </form>
            <h3>Operations:</h3>
            <ul class="mainLeftBarUl">
				<?php showUserCenterNav(); ?>
             </ul>
    	</div>
    </div>
    <div class="boxMainRight">
    
        <div class="castSheet">
        <h2>My Sumitted Papers</h2>
            <div class="inputFormDiv">
                <?php
					$uid = $_SESSION['user']->getUid();
					require_once('./system/db.php');
					$db=new DB();
					$sql = "select * from `evidenceitem` WHERE `uid` = '$uid'";
					$query = $db->query($sql);
					$rows = $query->rows;
					foreach($rows as $v){
						$title = $v['title'];
						$iid = $v['iid'];
						echo "<p><a href='$iid'>$title</a></p>";
					}
				?>
            </div>
        </div>
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>