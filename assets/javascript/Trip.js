function get_area()
{
	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/get_area";
		xmlhttp.open("post", url, true);
        xmlhttp.send();				
}

function send()
{
	var Start_date=document.getElementById("f_date").value;
	var End_date=document.getElementById("e_date").value;
	var area=document.getElementById("Location").value;
	var reason=document.getElementById("myTextarea").value;
	var sumbit_later=document.getElementById("sumbit_later").checked;//補單
	var username=document.getElementById("username").value;//姓名
    var id=document.getElementById("id").value;//帳號
	var year=new Date().getFullYear();
	var Overtime_class="Trip";
	
	var sDT=new Date(Start_date);
	var eDT=new Date(End_date);
	var nDT=new Date(getnowtime(0));
	
	if(Start_date!="" && End_date!=""  && reason!="")//確認資料都有填入
	{
		
		if(sDT.dateDiff("h",eDT)>0 )//確認開始日期小於結束日期
		{
			
			if(sumbit_later==true)//確認是否為補單
			{
				var xmlhttp=new XMLHttpRequest()
			xmlhttp.onreadystatechange=function()
			{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				      alert(xmlhttp.responseText);
					  window.location.reload("../index.php/Trip_C");		       
				      }
                    };
		
		var url="../index.php/Trip_C/send"+ '/' +username+ '/' +id + '/' +Start_date+ '/' +End_date+ '/' +sDT.dateDiff("d",eDT)+'/' +year+'/'+Overtime_class+'/'+encodeURIComponent('補單')+"/"+encodeURIComponent(reason)+"/"+area;
		
		xmlhttp.open("post", url, true);
        xmlhttp.send();			
			}
			else
			{
				if(eDT.dateDiff("d",nDT)<1)//確認是否超過可申請日期
				{
					
					var xmlhttp=new XMLHttpRequest()
			xmlhttp.onreadystatechange=function()
			{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				      alert(xmlhttp.responseText);
					  window.location.reload("../index.php/Trip_C");		       
				      }
                    };

		var url="../index.php/Trip_C/send"+ '/' +username+ '/' +id + '/' +Start_date+ '/' +End_date+ '/' +sDT.dateDiff("d",eDT)+'/' +year+'/'+Overtime_class+'/'+encodeURIComponent('出差')+"/"+encodeURIComponent(reason)+"/"+area;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
				}
				else
				{
					alert("超過可以申請日期，如要繼續申請請勾選補單");
				}
			}
		}
		else
		{
			alert("出差開始日期必須小於結束日期");
		}
		
	}
	else
	{
		alert("日期與與出差事由不能空的")
	}
}

Date.prototype.dateDiff = function(interval,objDate){//計算日期演算法
         var dtEnd = new Date(objDate);
         if(isNaN(dtEnd)) return undefined;
         switch (interval) {
         case "s":return parseInt((dtEnd - this) / 1000);  //秒
         case "n":return parseInt((dtEnd - this) / 60000);  //分
         case "h":return parseInt((dtEnd - this) / 3600000);  //時
         case "d":return parseInt((dtEnd - this) / 86400000);  //天
         case "w":return parseInt((dtEnd - this) / (86400000 * 7));  //週
         case "m":return (dtEnd.getMonth()+1)+((dtEnd.getFullYear()-this.getFullYear())*12) - (this.  getMonth()+1);  //月份
         case "y":return dtEnd.getFullYear() - this.getFullYear();  //天
}
}

function getnowtime(date) {
var today = new Date();
var dd = today.getDate()+date;
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
var HH=today.getHours();
var M=today.getMinutes();
var s=today.getSeconds();
if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 
if(HH<10) {
    mm='0'+mm
} 
if(s<10) {
    s='0'+s
} 
if(M<10) {
    M='0'+M
} 
out_put = yyyy+'-'+mm+'-'+dd+' '+HH+':'+M+':'+s;
return out_put;
}

function Load_detail()
{
	var id=document.getElementById("id").value;//帳號
	 window.location.assign("../index.php/Trip_C/Load_detail/"+id);	
}


function apply()
{
	 window.location.assign("../index.php/Trip_C");
	 document.getElementById("apply_area").style.display= "block";
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


function Load_detail()
{
	 document.getElementById("apply_area").style.display= "none";
	 var id=document.getElementById("id").value;
	 var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
					  
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Load_detail/"+id;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
	
}

function Trip_detail(index)
{
	    var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Trip_detail/"+index;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
}

function Sum_carfare(qty,first)
{
	var sum=0;
	//var id="'"+id_name+"'";
	for(i=0;i<qty;i++)
	{
		
		var new_index= +first + +i;
		var id="carfare_"+new_index;
		var id_name=String(id);
		var a=document.getElementById(id_name).value;
		sum=+sum + +a;
	}
   
	document.getElementById('carfare').value=sum;
}
function Sum_homestay(qty,first)
{
    var sum=0;
	//var id="'"+id_name+"'";
	for(i=0;i<qty;i++)
	{
		
		var new_index= +first + +i;
		var id="homestay_"+new_index;
		var id_name=String(id);
		var a=document.getElementById(id_name).value;
		sum=+sum + +a;
	}
   
	document.getElementById('homestay').value=sum;
}

function Sum_Expense(qty,first)
{
    
    var sum=0;
	//var id="'"+id_name+"'";
	for(i=0;i<qty;i++)cc
	{
		
		var new_index= +first + +i;
		var id="Expense_"+new_index;
		var id_name=String(id);
		var a=document.getElementById(id_name).value;
		sum=+sum + +a;
	}
   
	document.getElementById('Expense').value=sum;
}

function Expansion(date)
{
	var id=document.getElementById('id').value;
	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Expansion/"+id+"/"+date;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		


}
function Update_detail(index)
{
	var case_index="case_"+index;
	var reason_index="case_"+index;
	var cash=document.getElementById(case_index);
	var reason=document.getElementById(reason_index);
	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       alert(xmlhttp.responseText);		       
				      }
                    };
		var url="../index.php/Trip_c/Update_detail/"+index+"/"+cash+"/"+reason;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
}
function delete_detail(index,date)
{
	var id=document.getElementById('id').value;
	var r=confirm("是否要刪除?確認後會重新整理頁面")
	if(r==true)
	{
		var table=document.getElementById('datatable');
		var m=table.rows.length;
		if(m==2)
		{
			alert("單筆明細至少一筆");
		}
		else
		{
			var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       alert(xmlhttp.responseText);
				       Expansion(date);
				      }
                    };
		var url="../index.php/Trip_c/delete_detail/"+index;
		xmlhttp.open("post", url, true);
        xmlhttp.send();	
		}
		
	}
	 
}
function add(index,date)
{
	    var id=document.getElementById('id').value;
	    var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {				        
				         	var html_text=document.getElementById('area').innerHTML;//取出資料 動態新增欄位
				         	var new_area=html_text.replace("</table>","");
				         	new_area=new_area+xmlhttp.responseText;
				         	document.getElementById('area').innerHTML=new_area;
				           
				      }
                    };
		var url="../index.php/Trip_c/add/"+id+"/"+index+"/"+date;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
}
//...............儲存檔案
function save()
{
	var index_array=[];
	var table=document.getElementById('datatable');
	var index_key=String(table.rows[1].cells[2].innerHTML);
	for(var c=1,m=table.rows.length;c<m;c++)
	{
		var index=table.rows[c].cells[0].innerHTML;
		var item_id=String('item_'+index);
		var cash_id=String('cash_'+index);
		var reason_id=String('reason_'+index);
		var item=document.getElementById(item_id).value;
		var cash=document.getElementById(cash_id).value;
		var reason=document.getElementById(reason_id).value;

		index_array[c]=[index,item,cash,reason];
	}
	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸 
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {				        
				         	
				         	 alert(xmlhttp.responseText);
				         	 Expansion(index_key);
				          //document.writeln(xmlhttp.responseText);
				      }
                    };
		var url="../index.php/Trip_c/save";
		xmlhttp.open("post", url, true);
        xmlhttp.send(JSON.stringify(index_array));		

}
//.............................................
function Save_Currency()
{
	var table=document.getElementById('datatable');
	var index_key=String(table.rows[1].cells[1].innerHTML);
	var currency=document.getElementById('currency').value;

	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{

		}
	}
	var url="../index.php/Trip_c/Save_Currency/"+index_key+"/"+currency;
    xmlhttp.open("post", url, true);
    xmlhttp.send();

}
//-------------
function Up()
{
	var table=document.getElementById('datatable');
	var index=+table.rows[1].cells[1].innerHTML+0;
	
	Trip_detail(index);
}

function Report_Page(index)
{
	 var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Upload_detail/"+index;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
	
}

function Upload_Page(index)
{
	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Upload_Page/"+index;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
}


function upload(){ 
  var input = document.getElementById("UpFile"); 
  var id=document.getElementById('id').value;
  var index=document.getElementById('Upload_index').value;
  
  if(input.files.length != 0)
  {
  	 var file = input.files[0]; 
  
     var xhr = new XMLHttpRequest();  
     var fd = new FormData(); 
 
     fd.append("UpFile", file); 
     xhr.onreadystatechange = function()
					{
                        if (xhr.readyState == 4 && xhr.status == 200)
					  {
				      document.getElementById('Message').innerHTML=xhr.responseText;		       
				      }
                    };
 
  //监听事件 
     xhr.upload.addEventListener("progress", uploadProgress, false); 
 
  //发送文件和表单自定义参数 
     var url="../index.php/Trip_c/Upload/"+id+"/"+index;
     xhr.open("POST", url,true);  
     xhr.send(fd);
  }
  else
  {
  	alert("沒有選擇資料");
  }
  
 
 }
 function Date_Amount()
 {
 	var table=document.getElementById('datatable');
	var index_key=String(table.rows[1].cells[1].innerHTML);
	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("area").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Date_Amount/"+index_key;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
 } 

function uploadProgress(evt)
{ 
  if (evt.lengthComputable) {     
   //evt.loaded：文件上传的大小 evt.total：文件总的大小      
   var percentComplete = Math.round((evt.loaded) * 100 / evt.total);  
   //加载进度条，同时显示信息   
   $("#percent").html(percentComplete + '%') 
   $("#progressNumber").css("width",""+percentComplete+"px");    
  } 
 } 

 function Amount_Display(index,date)
 {
 	var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
        xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       document.getElementById("Amount_Display").innerHTML=xmlhttp.responseText;		       
				      }
                    };
		var url="../index.php/Trip_c/Amount_Display/"+index+"/"+date;
		xmlhttp.open("post", url, true);
        xmlhttp.send();		
 }


