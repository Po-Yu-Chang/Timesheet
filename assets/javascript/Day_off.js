// JavaScript Document


	  function send()
	  {
		 var Reason=document.getElementById("myTextarea").value;
		 var off_hour=document.getElementById("off_hour").value;
		 var base_hour=document.getElementById("base_hour").value;
		 if(document.getElementById("f_date").value!="" && document.getElementById("e_date").value!="" && Reason.length>2 )
		 {
		 var sDT_string=document.getElementById("f_date").value+" "+document.getElementById("f_hour").value+":00:00";
		 var eDT_string=document.getElementById("e_date").value+" "+document.getElementById("e_hour").value+":00:00";
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

var sDT = new Date(sDT_string);  //必要項。sDT- 這是在計算中想要使用的第一個日期/時間值。 
var eDT = new Date(eDT_string);  //必要項。eDT- 這是在計算中想要使用的第二個日期/時間值。

if(sDT.dateDiff("h",eDT)>0 )// ◎1_Start //確認開始時間小於結束時間
{
	
	
	if( (off_hour-sDT.dateDiff("h",eDT))>0 &&  ((sDT.dateDiff("h",eDT)-1)% base_hour)==0)//◎2_Start 確保剩餘時數 大於 申請休假時數  && 讓休假時數為最小單位的倍數 
	{
		
		var f_date=document.getElementById("f_date").value;
		var e_date=document.getElementById("e_date").value;
		var year=new Date().getFullYear();
		if(f_date.substring(0,4)==e_date.substring(0,4))//  ◎3_Start 排除跨年度請假
		{
			
			var Day_off_class=document.getElementById("Day_off_class").value;
			var sumbit_later=document.getElementById("sumbit_later").checked;
			
			if(sumbit_later==false)//◎4_Start 判別是否為補單
		    {
				if(Day_off_class=='Sick_Minor' || Day_off_class=='Sick_Serious' )//◎5_Start 病假於休假三天後可以申請
			{
				var nDT = new Date(getnowtime(3));
				if(eDT.dateDiff("d",nDT)<4)
				{
					
					var username=document.getElementById("username").value;//姓名
		            var id=document.getElementById("id").value;//帳號
		            var start_date=document.getElementById("f_date").value+" "+document.getElementById("f_hour").value+":00:00";//開始時間
		            var end_date=document.getElementById("e_date").value+" "+document.getElementById("e_hour").value+":00:00";//結束時間
			        var reason=document.getElementById("myTextarea").value;
			         
		            var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並發送m
			          
                    xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
                     // document.getElementById("resolution_Reshape_NGs").innerHTML = xmlhttp.responseText;
				       alert(xmlhttp.responseText);
				       window.location.reload("../index.php/Day_off_C");
				      }
                    };
	
		var url="../index.php/Day_off_C/send"+ '/' +username+ '/' +id + '/' +start_date+ '/' +end_date+ '/' +sDT.dateDiff("h",eDT)+'/' +year+'/'+Day_off_class+'/'+encodeURIComponent('請假')+"/"+encodeURIComponent(reason);
		
		xmlhttp.open("post", url, true);
        xmlhttp.send();
				}
				else
				{
					alert("病假以當日後三天內可申請")
				}
			}
			else
			{
				
				var nDT = new Date(getnowtime(0));
				if(eDT.dateDiff("d",nDT)<1)
				{
					var username=document.getElementById("username").value;//姓名
		            var id=document.getElementById("id").value;//帳號
		            var start_date=document.getElementById("f_date").value+" "+document.getElementById("f_hour").value+":00:00";//開始時間
		            var end_date=document.getElementById("e_date").value+" "+document.getElementById("e_hour").value+":00:00";//結束時間
			        var reason=document.getElementById("myTextarea").value;
			
		            var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並發送m
			          
                    xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
                     // document.getElementById("resolution_Reshape_NGs").innerHTML = xmlhttp.responseText;
				       alert(xmlhttp.responseText);
				       window.location.reload("../index.php/Day_off_C");
				      }
                    };
		
		var url="../index.php/Day_off_C/send"+ '/' +username+ '/' +id + '/' +start_date+ '/' +end_date+ '/' +sDT.dateDiff("h",eDT)+'/' +year+'/'+Day_off_class+'/'+encodeURIComponent('請假')+"/"+encodeURIComponent(reason);
        //document.writeln(url);
		xmlhttp.open("post", url, true);
        xmlhttp.send();
				}
				else
				{
				  alert("除了病假別，請假必須於當前申請完成")
				}
			}//◎5_End
		
			}
			else //有補單
			{
				    var username=document.getElementById("username").value;//姓名
		            var id=document.getElementById("id").value;//帳號
		            var start_date=document.getElementById("f_date").value+" "+document.getElementById("f_hour").value+":00:00";//開始時間
		            var end_date=document.getElementById("e_date").value+" "+document.getElementById("e_hour").value+":00:00";//結束時間
			        var reason=document.getElementById("myTextarea").value;
			         
		            var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並發送m
			          
                    xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
                     // document.getElementById("resolution_Reshape_NGs").innerHTML = xmlhttp.responseText;
				       alert(xmlhttp.responseText);
				       window.location.reload("../index.php/Day_off_C");
				      }
                    };
	
		var url="../index.php/Day_off_C/send"+ '/' +username+ '/' +id + '/' +start_date+ '/' +end_date+ '/' +sDT.dateDiff("h",eDT)+'/' +year+'/'+Day_off_class+'/'+encodeURIComponent('補單')+"/"+encodeURIComponent(reason);
		xmlhttp.open("post", url, true);
        xmlhttp.send();				
			}//◎4_End
			
		}
		else  // ◎3_End
		{
			alert('如果要跨年度請假，請拆成兩次請假');
		}
	}
	else // ◎2_End
	{
		alert('休假時數不夠  或必須以最小單位請假');
	} 

}
else 
{
	alert('起始日期必續小於結束日期');
}
		 }
		 else //◎1_End
		 {
			 alert('日期不能為空 且 請假事由必須超過20個字');
		 }
	  }
	  
	  	 function Change_day_off()
	  {
		  
		  var Day_off_class=document.getElementById("Day_off_class").value;
		  var id=document.getElementById("id").value;
		  var year=new Date().getFullYear();
		  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var response_data= xmlhttp.responseText;
				var array = JSON.parse(response_data);
				
				document.getElementById("off_hour").value=array[0];
				document.getElementById("off_day").value=(+array[0]/24).toFixed(2);
				document.getElementById("base_hour").value=array[3];
				
				if(array[1]==0)
				{
					document.getElementById('pay').selectedIndex="0";
			    }
				else if(array[1]==1)
				{
					document.getElementById('pay').selectedIndex="1";
				}
				else
				{
					document.getElementById('pay').selectedIndex="2";
				}
				
				if(array[3]==0)
			  {
				document.getElementById("attendace").checked = false;
			  }
			  else
			  {
				 document.getElementById("attendace").checked = true; 
			  }
				}
        };
	   // document.writeln("../index.php/Day_off_C/Find_Day_off_Option"+ '/' +Day_off_class + '/'+id+ '/'+year );
        xmlhttp.open("get", "../index.php/Day_off_C/Find_Day_off_Option"+ '/' +Day_off_class + '/'+id+ '/'+year, true);
        xmlhttp.send();// JavaScript Document
		 
	  }
	  function Detection_String()//檢查字數
	  {
		  var length_number=document.getElementById("myTextarea").value.length;
		  if(length_number <20)
		  {
			document.getElementById("Display_String").value="已鍵入"+length_number+"個字 還差"+(20-length_number)+"個字";  
		  }
		  else
		  {
			document.getElementById("Display_String").value="已鍵入"+length_number+"個字 字數達成";
		  }
		  
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
function logout2()//強迫登出
{
	 window.location.assign("../index.php/Logout");
}
function Relogin()//如果SESSION 失效後強迫登入
{
	var Login_id=document.getElementById("Login_id").value;
	var Login_pass=document.getElementById("Login_pass").value;
	
	 var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並發送m
			
            
            xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			 {
              var response_data= xmlhttp.responseText;
			  if(response_data=="Login_Success")
			  {
				  alert("登入成功!系統行跳轉");
				  window.location.assign("../index.php/Day_off_C");
			  }
			  else
			  {
				  alert(response_data);
			  }
			 }
        };
		
		var url="../index.php/User/Relogin/"+Login_id +'/' +Login_pass;
	
        xmlhttp.open("post", url, true);
        xmlhttp.send();
	
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




function home()
{
	var id=document.getElementById("id").value;
    var url="../?/Day_off_C/";
	window.location.assign(url);
}

