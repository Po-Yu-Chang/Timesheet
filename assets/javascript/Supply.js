function Send()
{
	var f_date=document.getElementById("f_date").value;
    var S_H=document.getElementById("Start_time_H").value;
    var S_M=document.getElementById("Start_time_M").value;
	var type=document.getElementById('timing').value;
	var id=document.getElementById('id').value;
    var year=new Date().getFullYear();
    var username=document.getElementById("username").value;

    var date=f_date+" "+S_H+":"+S_M+":00";


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
    var sDT_string=document.getElementById("f_date").value+" "+"08:00:00";
    var sDT=new Date(sDT_string);
    var nDT = new Date(getnowtime(0));
    
   if(sDT.dateDiff("d",nDT)>-1)//只能補今天以前的日期
   {
   	 var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸(送出審核 並發送m
			          
                    xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
                    
				       alert(xmlhttp.responseText);
                       window.location.reload("../index.php/Supply_C");
				  
				      }
                    };
	
		var url="../index.php/Supply_C/send/"+encodeURIComponent(date)+"/"+type+"/"+id+"/"+encodeURIComponent(username)+"/"+year;	
		xmlhttp.open("post", url, true);
        xmlhttp.send();
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
out_put = yyyy+'-'+mm+'-'+dd+" "+"08:00:00";
return out_put;
}