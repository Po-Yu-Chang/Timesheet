function Compute()
{
	var S_H=document.getElementById("Start_time_H");
	var E_H=document.getElementById("End_time_H");
	for(i=0;i<23;i++)
	{
		if(i<10)
		{
			var j='0'+i;
			var new_option=new Option(j,j);
			S_H.options.add(new_option);
		}
		else
		{
			var new_option=new Option(i,i);
			S_H.options.add(new_option);
		}
		
		if(i<10)
		{
			var j='0'+i;
			var new_option=new Option(j,j);
			E_H.options.add(new_option);
		}
		else
		{
			var new_option=new Option(i,i);
			E_H.options.add(new_option);
		}
	}
}


function Send()
{
	
	var username=document.getElementById("username").value;//姓名
    var id=document.getElementById("id").value;//帳號
	var Start_time=document.getElementById("Start_time_H").value;//開始時間(時)
	var End_time=document.getElementById("End_time_H").value;//結束時間(時)
	var S_M=document.getElementById("Start_time_M").value;
	var E_M=document.getElementById("End_time_M").value;
	var f_date=document.getElementById("f_date").value;//日期
	var reason=document.getElementById("myTextarea").value;//理由
	var sumbit_later=document.getElementById("sumbit_later").checked;//補單
	
	var hour=((parseInt(End_time))+trans(E_M))-((parseInt(Start_time))+trans(S_M));//外出
	
		
	var year=new Date().getFullYear();
	var start_date=f_date+" "+Start_time+":"+S_M+":00";//開始時間
	var end_date=f_date+" "+End_time+":"+E_M+":00"//結束時間
	
	var eDT = new Date(start_date);
	var nDT = new Date(getnowtime(0));
	
	var Overtime_class="Out";

	if(Start_time!="" && End_time!="" && f_date!="")//#1_Start
	{
		if(hour<0)//#2_Start
		{
			alert("開始時間不能與結束時間一樣且結束時間必須大於開始時間");
		}
		else
		{
			if(reason.length>0)//#3_Start
			{
				if(sumbit_later==true)//#4_Start
				{
					var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
                    xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       alert(xmlhttp.responseText);
				       window.location.reload("../index.php/Out_C");
				      }
                    };
	
		var url="../index.php/Out_C/send"+ '/' +username+ '/' +id + '/' +start_date+ '/' +end_date+ '/' +hour+'/' +year+'/'+Overtime_class+'/'+encodeURIComponent('補單')+"/"+encodeURIComponent(reason);
		xmlhttp.open("post", url, true);
        xmlhttp.send();				
				}
				else
				{
					if(eDT.dateDiff("d",nDT)<1)
					{
						var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並mail
                    xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				       alert(xmlhttp.responseText);
				       window.location.reload("../index.php/Out_C");
				      }
                    };
	
		var url="../index.php/Out_C/send"+ '/' +username+ '/' +id + '/' +start_date+ '/' +end_date+ '/' +hour+'/' +year+'/'+Overtime_class+'/'+encodeURIComponent('外出')+"/"+encodeURIComponent(reason);
		xmlhttp.open("post", url, true);
        xmlhttp.send();				
					}
					else
					{
						alert("超過可申請日期");
					}
				}//#4_End
			}
			else
			{
				alert("外出理由不能是空的");
			}//#3_End
			
		}//#2_End
	}
	else
	{
		alert("日期不能是空的")
	}//#1_End
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
function trans(M)
{
	if(M=='30')
	{
		return 0.5; 
	}
	else
	{
		return 0;
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