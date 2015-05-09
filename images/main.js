// JavaScript Document
/**
* @author Eric Shang @ nexs.co.nz
*/
//top nav
function doNav(){
	var headerNavUl = document.getElementById("headerNavUl").getElementsByTagName("li"); //返回Ul下的所有子元素集合
	for(var i = 0; i<headerNavUl.length; i++){
		headerNavUl[i].onmouseover = function(){
			 if(this.getElementsByTagName("div")[0]){
				 this.getElementsByTagName("div")[0].style.display = "inherit";
			 }
		}
		headerNavUl[i].onmouseout = function(){
			 if(this.getElementsByTagName("div")[0]){
				 this.getElementsByTagName("div")[0].style.display = "none";
			 }
		}
		
	}
}
//start to excute the function when window are loaded
window.onload=doNav; 


/********************
 * 设定窗口滚动程序 
 ******************/
window.onscroll = function(){ 
    var t = document.documentElement.scrollTop || document.body.scrollTop;  
    var topBarBox = document.getElementById("topBarBox");
	var topMarginBox = document.getElementById("marginBox");
    if( t >= 20 ) { 
        topBarBox.className = "headerBoxScrollDown"; 
		//topMarginBox.style.padding = "30px 0";
    } else { 
        topBarBox.className= "headerBox"; 
		//topMarginBox.style.padding = "0";
    } 
}



//for Ajax
function getXmlHttp(){
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}


function AjaxPost(url, data){
	var xmlhttp;
	var results ="";
	xmlhttp = getXmlHttp();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			results = xmlhttp.responseText;
			return results;
		}
	}
	xmlhttp.open("POST","url",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(data);
}