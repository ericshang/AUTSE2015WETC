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
			<h2>Search Cretieria </h2>
			<ul>
            	<?php //showSearchCretiria(); ?>
               
            </ul>
			<div><?php require_once('./view/searchForm.php'); ?></div>
            <div class="searchResult">
            	<?php showSearchResult(); ?>
            </div>
        </div>
        
       
    
  </div>
<div class="clear"></div>
</div>
<!--mainbody end-->
</body>
</html>