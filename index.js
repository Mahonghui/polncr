// JavaScript Document

	function displaySubMenu(li) { 
		var subMenu = li.getElementsByTagName("ul")[0]; 
		subMenu.style.display ="block";
	} 
	function hideSubMenu(li) { 
		var subMenu = li.getElementsByTagName("ul")[0]; 
		subMenu.style.display ="none"; 
	}
	
	window.onload=init;

	function init ()
	{
		window.setInterval("showtime()",1000);
		window.setInterval("changePic()",1500);
	    //	scrollInit();
  
	}
	var scrolltime;
   function scrollInit()
   {
	   var dome = document.getElementById("dome");
	   var dome1 = document.getElementById("dome1");
	   var dome2 = document.getElementById("dome2");
	   dome1.style.height=dome1.offsetHeight+"px";
	   dome2.style.height=dome1.style.height;
	   dome2.innerHTML=dome1.innerHTML;
	   scrolltime=window.setInterval("startScroll(dome)",40);
	  
	   }
	   function startScroll(dome)
	   {
		   if(dome.scrollTop==dome.offsetHeight)
		     dome.scrollTop=0;
		   dome.scrollTop++; 
		   }

	function showtime()
	{
		var date = new Date();
		var weekday = date.getDay();
		var str =date.toLocaleDateString()+"  "+ date.toLocaleTimeString();
		var str1 = date.toDateString() +" " ;
		var objDate = document.getElementById("showdate");  
		objDate.innerHTML=str;	
	}
	
	var indexOfPic = 0;
function changePic()
{
	var imgObj = document.getElementById("ScrollImg");
	var Imgpath = "images/scroimg0";
	indexOfPic++;
    imgObj.src=Imgpath+indexOfPic+".jpg";
	if(indexOfPic>3)indexOfPic=0;
	}


				
				
      
