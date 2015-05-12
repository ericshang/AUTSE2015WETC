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
            <table class="articleListTable" cellpadding="0" cellspacing="0">
            <tr class = 'trGray'>
            	<td>ID</td>
                <td>Title</td>
            </tr>
                <?php
					$uid = $_SESSION['user']->getUid();
					require_once('./system/db.php');
					$db=new DB();
					$sql = "select * from `evidenceitem` WHERE `uid` = '$uid'";
					$query = $db->query($sql);
					$rows = $query->rows;
					$i=1;
					foreach($rows as $v){
						
						$trGray = ($i%2 ==0)?"class = 'trGray'":"";
						echo "<tr $trGray >";
						$title = $v['title'];
						$iid = $v['iid'];
						echo "<td>$iid </td><td><a href='./?act=showItem&id=$iid'>$title</a></td>";
						echo "</tr>";
						$i++;
					}
				?>
             </table>
            </div>
        </div>
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>