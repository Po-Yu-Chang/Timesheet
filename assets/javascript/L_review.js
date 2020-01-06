function reload_reivew_data(page,item_class)
{
	//alert("../index.php/L_review_c/reload_reivew_data/"+ id+ '/'+page+'/'+item_class);
	var id=document.getElementById("id").value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("Display_data").innerHTML= xmlhttp.responseText;
				
				}
        };
        xmlhttp.open("post", "../index.php/L_review_c/reload_reivew_data/"+ id+ '/'+page+'/'+item_class, true);
        xmlhttp.send();// JavaScript Documen
}
function Display_Pagging(item_class,page)
{
	var id=document.getElementById("id").value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("List_data").innerHTML= xmlhttp.responseText;
				document.getElementById("now_item").value=item_class;
				}
        };

        xmlhttp.open("post", "../index.php/L_review_c/count_page/"+ id+'/'+item_class+'/'+page, true);
        xmlhttp.send();// JavaScript Documen
}
  function logout()//登出
{
	
    var txt;
    var r = confirm("是否要登出");
    if (r == true) {
		 window.location.assign("../index.php/Logout");
	   
    } else {
        
    }
 }
 function jump(page)
 {
	
	 var nowpage=document.getElementById("nowpage").value;
	 var totalpage=document.getElementById("totalpage").value;
	 var item_class=document.getElementById("now_item").value;
   
	 if(page=='Up')
	 {
		  
		if(nowpage==1)
		{
			alert("已經是第一頁");
		} 
		else
		{
			start_page=nowpage-1;
			reload_reivew_data(start_page,item_class);
			Display_Pagging(item_class,start_page)
		}		 
	 }
	 else if(page=='down')
	 {
		 if(nowpage==totalpage)
		 {
			 alert("已經是最後一頁");
		 }
		 else
		 {
			start_page=+nowpage+1;
			reload_reivew_data(start_page,item_class);
			Display_Pagging(item_class,start_page)
		 }
	 }
	 else
	 {
		 reload_reivew_data(page,item_class);
		 Display_Pagging(item_class,page)
	 }
	
 }
 function gopage()
 {
	 var start_page=document.getElementById("gopage").value;
	 var totalpage=document.getElementById("totalpage").value;
	 if(+start_page>+totalpage)
	 {
		 alert("跳頁超出最大頁數");
	 }
	 else
	 {
		 jump(start_page);
	 }
	 
 }
 function count_qty_case()
 {
	var id=document.getElementById("id").value; 
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var response_data= xmlhttp.responseText;
				var array = JSON.parse(response_data);
				document.getElementById("Day_off_qty").value=array[0];
				document.getElementById("Overtime_qty").value=array[1];
				document.getElementById("Travel_qty").value=array[2];
				document.getElementById("Out_qty").value=array[3];
				document.getElementById("Repair_qty").value=array[4];
				}
        };

        xmlhttp.open("post", "../index.php/L_review_c/count_qty_case/"+ id, true);
        xmlhttp.send();// JavaScript Documen
 }
 function View(item_class)
 {
	 
	 reload_reivew_data(1,item_class);
	 Display_Pagging(item_class,1);
 }
 function Sign(index)
 {
	 var nowpage=document.getElementById("nowpage").value;
	 var item_class=document.getElementById("now_item").value;
	 var r = confirm("是否要簽核");
    if (r == true) {
		
	   var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var response_data= xmlhttp.responseText;
				alert(response_data);
				reload_reivew_data(nowpage,item_class);
	            Display_Pagging(item_class,nowpage); 
				}
        };

        xmlhttp.open("post", "../index.php/L_review_c/sign/"+ index, true);
        xmlhttp.send();// JavaScript Documen
    } else {
        
    }
	 
 }
 function reject(index)
 {
	 var nowpage=document.getElementById("nowpage").value;
	 var item_class=document.getElementById("now_item").value;
	var reason = prompt("請輸入退件理由");
	if(reason.length==0)
	{
		alert("退件理由不能是空白的");
	}
	else
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var response_data= xmlhttp.responseText;
				alert(response_data);
				reload_reivew_data(nowpage,item_class);
	            Display_Pagging(item_class,nowpage); 
				}
        };

        xmlhttp.open("post", "../index.php/L_review_c/reject/"+ index+"/"+reason, true);
        xmlhttp.send();// JavaScript Documen
	}
 }