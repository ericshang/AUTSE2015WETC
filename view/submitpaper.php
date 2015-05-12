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
        <h2>Sumit Papers</h2>
            <div class="inputFormDiv">
                <form method="post" action="?act=doSubmitPaper">
                <p>Title: <br /><input type="text" name="title" class="inputFormDivInput" /> *</p>
                <p><select name="method_id">
				<option value='0'>Select Method</option>
				<?php 
					require_once('./system/db.php');
					$db=new DB();
					$sql = "select * from `method`";
					$query = $db->query($sql);
					$rows = $query->rows;
					foreach($rows as $v){
						$name = $v['name'];
						$methodId = $v['method_id'];
						echo "<option value='$methodId'>$name</option>";
					}
				 ?></select> *</p>
                <p>What:  *<br /><textarea name="what" ></textarea></p>
                <p>Who: <br /><textarea name="who" ></textarea></p>
                <p>Why: <br /><textarea name="why" ></textarea></p>
                <p>Where: <br /><textarea name="where" ></textarea></p>
                <p>When: <br /><textarea name="when" ></textarea></p>
                <p>How: <br /><textarea name="how" ></textarea></p>
                <p>Benefit: <br /><textarea name="benefit" ></textarea></p>
                <p>Result: <br /><textarea name="result" ></textarea></p>
                <p>Method Implementation: <br /><textarea name="methodImplementation" ></textarea></p>
                <p><input type="submit" value="Submit" class="inputSubmit"/></p>
                </form>
            </div>
        </div>
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>