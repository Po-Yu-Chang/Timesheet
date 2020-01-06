function Change_attendace_Type()
{
	var Attendance_Class=document.getElementById('Attendance_Class').value;

    if(Attendance_Class=='請假')
    {
    	
    	document.getElementById('Day_off').style.display = 'block';
        document.getElementById('Supply').style.display = 'none';
        document.getElementById('main_button').style.display = 'block';
        document.getElementById('supply_button').style.display = 'none';
    }
    else if(Attendance_Class=='補單')
    {
        document.getElementById('Day_off').style.display = 'none';
        document.getElementById('Supply').style.display = 'block';
        document.getElementById('main_button').style.display = 'none';
        document.getElementById('supply_button').style.display = 'block';
    }
    else
    {
    	document.getElementById('Day_off').style.display = 'none';
        document.getElementById('Supply').style.display = 'none';
        document.getElementById('main_button').style.display = 'block';
        document.getElementById('supply_button').style.display = 'none';
    }

}

function Change_Edit_attendace_Type()
{
    var Edit_Attendance_Class=document.getElementById('Edit_Attendance_Class').value;
    if(Edit_Attendance_Class=='請假')
    {
        
        document.getElementById('Edit_Day_off').style.display = 'block';
        document.getElementById('Edit_Supply').style.display = 'none';
    }
    else if(Edit_Attendance_Class=='補單')
    {
        document.getElementById('Edit_Day_off').style.display = 'none';
        document.getElementById('Edit_Supply').style.display = 'block';
    }
    else
    {
        document.getElementById('Edit_Day_off').style.display = 'none';
    }

}

function Initialize()
{
     document.getElementById('sql').value="Select * from holiday_detail where `time`=curdate()";
	 document.getElementById('Day_off').style.display = 'block';
     document.getElementById('Supply').style.display = 'none';
     document.getElementById('main_button').style.display = 'block';
     document.getElementById('supply_button').style.display = 'none';
     List_name('0200');
     Get_Recent_Data();
      
}

function List_name(Dept)
{
	
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
					{
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					  {
				        var message=xmlhttp.responseText;
				        document.getElementById('List_name').innerHTML=message;
				      }
                    };
		
		var url="../index.php/Manually_C/List_name/"+Dept;
        xmlhttp.open("post", url, true);
        xmlhttp.send();
}

 function Change_Dept()
 {
    var Dept_number=document.getElementById('Dept_Class').value;
    List_name(Dept_number);
   

 }

 function Change_month(v_year)//月份異動
 {
    
    if(v_year=='start_year' || v_year=='start_month')
    {
        var year=document.getElementById('start_year').value;
        var month=document.getElementById('start_month').value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;                     
                        document.getElementById('start_date').innerHTML=message;
                      }
                    };
        
        var url="../index.php/Manually_C/Change_month/"+year+"/"+month+"/start_date";
        xmlhttp.open("post", url, true);
        xmlhttp.send();
    }
    else
    {
        var year=document.getElementById('end_year').value;
        var month=document.getElementById('end_month').value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        document.getElementById('end_date').innerHTML=message;
                      }
                    };
        
        var url="../index.php/Manually_C/Change_month/"+year+"/"+month+"/end_date";
        xmlhttp.open("post", url, true);
        xmlhttp.send();
    }
 }    
     function Send()
    {
       
        var id=document.getElementById('id').value;
        var Attendance_Class=document.getElementById('Attendance_Class').value;//申請項目
        var name=document.getElementById('name').value;//人員姓名
        var Day_off_class=document.getElementById('Day_off').value;//請假類別
       
        //開始時間

        var start_year=document.getElementById('start_year').value;
        var start_month=document.getElementById('start_month').value;
        var start_date=document.getElementById('start_date').value;
        var start_hour=document.getElementById('start_hour').value;
        var start_second=document.getElementById('start_second').value;

        var start=start_year+"-"+start_month+"-"+start_date+" "+start_hour+":"+start_second+":"+"00";

         //結束時間
        var end_year=document.getElementById('end_year').value;
        var end_month=document.getElementById('end_month').value;
        var end_date=document.getElementById('end_date').value;
        var end_hour=document.getElementById('end_hour').value;
        var end_second=document.getElementById('end_second').value;

        var end=end_year+"-"+end_month+"-"+end_date+" "+end_hour+":"+end_second+":"+"00";

        //理由

        var reason=document.getElementById('reason').value;

        document.getElementById('sql').value="Select * from holiday_detail where `time`=curdate()"; 

        if(Attendance_Class=='請假')
        {
            
            var type="1";
            var data=[type,name,id,start,end,Attendance_Class,Day_off_class,reason];//build array
        }
        else
        {
            
            var type="1";
            var data=[type,name,id,start,end,Attendance_Class,Attendance_Class,reason];//build array
        }

        if(reason.length==0)
        {
            alert("申請事由不能是空的")
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();//傳送資料
            xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          document.getElementById('content').innerHTML=message;
                          document.getElementById('reason').value="";

                        }
                        else
                        {
                            alert("此單資料重複");
                        }                        
                                                                     
                      }
                    };
        
            var url="../index.php/Manually_C/Send";
            xmlhttp.open("post", url, true);
            xmlhttp.send(JSON.stringify(data));
        }
        
    }

function Delete(index,item)
{
    var r = confirm("確認是否要刪除，刪除後無法回復。");
    if(r==true)
    {
        if(item=='補單')
        {
            var type=0;
        }
        else
        {
            var type=1;
        }
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function()
                    {
                      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        document.getElementById('target_page').value=document.getElementById('nowpage').value;                       
                        jump_page();                                              
                      }
                    };
        
        var url="../index.php/Manually_C/Delete/"+index+"/"+type;
        xmlhttp.open("post", url, true);
        xmlhttp.send();
    }
        
}

function Get_Recent_Data()
{
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;                        
                        document.getElementById('content').innerHTML=message;                                              
                      }
                    };
        
        var url="../index.php/Manually_C/Get_Recent_Data";
        xmlhttp.open("post", url, true);
        xmlhttp.send();
}
    

function jump_page()
{
    var target_page=parseInt(document.getElementById('target_page').value);
   
    var totalpage=parseInt(document.getElementById('totalpage').value);
    var sql=document.getElementById('sql').value;
  
    if(target_page<totalpage+1 || target_page<0)
    {
        var start=(target_page)*8-8;
        sql=sql.concat(" limit "+start+",8");
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;                        
                        document.getElementById('content').innerHTML=message;
                        document.getElementById('nowpage').value= target_page;                                             
                      }
                    };
        
        var url="../index.php/Manually_C/Receive_Data";
        xmlhttp.open("post", url, true);
        xmlhttp.send(sql);
    }
    else
    {
        alert("超出範圍");
    }
}

function Edit_jump_page()
{
    var nowpage=document.getElementById('nowpage').value;
   
    var totalpage=parseInt(document.getElementById('totalpage').value);
    var sql=document.getElementById('sql').value;
     
   
    var start=(nowpage)*8-8;
    sql=sql.concat(" limit "+start+",8");
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var message=xmlhttp.responseText;                        
                    document.getElementById('content').innerHTML=message;
                    document.getElementById('nowpage').value= target_page;                                             
                }
            };
        
    var url="../index.php/Manually_C/Receive_Data";
    xmlhttp.open("post", url, true);
     xmlhttp.send(sql);
   
}

function Up_Page()
{
    var nowpage=document.getElementById('nowpage').value;
    var sql=document.getElementById('sql').value;
    if(nowpage==1)
    {
        alert("已經是第一頁");
    }
    else
    {
        var start=(nowpage-1)*8-8;
        
        sql=sql.concat(" limit "+start+",8");
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;                        
                        document.getElementById('content').innerHTML=message;
                        document.getElementById('nowpage').value=+nowpage-1;                                             
                      }
                    };
        
        var url="../index.php/Manually_C/Receive_Data";
        xmlhttp.open("post", url, true);
        xmlhttp.send(sql);
        
    }
}

function Down_Page()
{
    var totalpage=document.getElementById('totalpage').value;
    var nowpage=document.getElementById('nowpage').value;
    var sql=document.getElementById('sql').value;

    if(totalpage==nowpage)
    {
        alert("已經是最後一頁");
    }
    else
    {
        var start=(nowpage)*8;
        sql=sql.concat(" limit "+start+",8");
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;                        
                        document.getElementById('content').innerHTML=message;
                        document.getElementById('nowpage').value=+nowpage+1;                                            
                      }
                    };
        
        var url="../index.php/Manually_C/Receive_Data";
        xmlhttp.open("post", url, true);
        xmlhttp.send(sql);
       
    }
}
function Get_Initial_Page()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message==0)
                        {
                           document.getElementById('totalpage').value=0;
                           document.getElementById('nowpage').value=0;
                        }
                        else
                        {
                            document.getElementById('totalpage').value=message;
                            document.getElementById('nowpage').value=1;
                        }                       
                                                                      
                      }
                    };
        
    var url="../index.php/Manually_C/Initial_Page";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
}

function Count_Page()
{   
       var sql=document.getElementById('sql').value;
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message==0)
                        {
                           document.getElementById('totalpage').value=0;
                           document.getElementById('nowpage').value=0;
                        }
                        else
                        {
                            document.getElementById('totalpage').value=message;
                            document.getElementById('nowpage').value=1;
                        }                       
                                                                      
                      }
                    };
        
        var url="../index.php/Manually_C/Count_Page";
        xmlhttp.open("post", url, true);
        xmlhttp.send(sql); 
}

     function Click(pa)
     {
        var reason_id=pa+"_reason";
        var reason=document.getElementById(reason_id).value;
        document.getElementById('area_reason').value=reason; 
        var updateButton = document.getElementById('updateDetails');
        var cancelButton = document.getElementById('cancel');
        var favDialog = document.getElementById('favDialog');
        favDialog.showModal();
        
     }
     function Close()
     {
        var updateButton = document.getElementById('updateDetails');
        var cancelButton = document.getElementById('cancel');
        var favDialog = document.getElementById('favDialog');
        favDialog.close();
     }

     function Edit_Click(index)
     {
        document.getElementById('Edit_index').value=index;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        var data=JSON.parse(message);
                        if(data[0]=='請假')
                        {
                            document.getElementById("Edit_Attendance_Class").selectedIndex = "0";
                            document.getElementById("Edit_Day_off").selectedIndex = data[1];
                            document.getElementById('Edit_Day_off').style.display = 'block';
                            document.getElementById('Edit_Supply').style.display = 'none';
                        }
                        else if(data[0]=='外出')
                        {
                            document.getElementById("Edit_Attendance_Class").selectedIndex = "1";
                            document.getElementById('Edit_Day_off').style.display = 'none';
                            document.getElementById('Edit_Supply').style.display = 'none';
                        }
                        else if(data[0]=='出差')
                        {
                            document.getElementById("Edit_Attendance_Class").selectedIndex = "2";
                            document.getElementById('Edit_Day_off').style.display = 'none';
                            document.getElementById('Edit_Supply').style.display = 'none';
                        }
                        else if(data[0]=='加班')
                        {
                            document.getElementById("Edit_Attendance_Class").selectedIndex = "3";
                            document.getElementById('Edit_Day_off').style.display = 'none';
                            document.getElementById('Edit_Supply').style.display = 'none';
                        } 
                        else
                        {
                            document.getElementById("Edit_Attendance_Class").selectedIndex = "4";
                            document.getElementById('Edit_Day_off').style.display = 'none';
                            document.getElementById('Edit_Supply').style.display = 'block';                           
                        }                                     
                      }
                            document.getElementById('Edit_Name').innerHTML=data[2]+"";
                            document.getElementById('orginal_start').innerHTML=data[3];
                            document.getElementById('orginal_end').innerHTML=data[4];
                            document.getElementById('edit_reason').value=data[7];
                    };
        
        var url="../index.php/Manually_C/Get_Edit_Data/"+index;
        xmlhttp.open("post", url, true);
        xmlhttp.send(); 
        var EditDialog = document.getElementById('EditDialog');
        EditDialog.showModal();
     }

     function Edit_Close()
     {
        var EditDialog = document.getElementById('EditDialog');
        EditDialog.close();
     }

function Supply_Send()
{
        var id=document.getElementById('id').value;
        var Attendance_Class=document.getElementById('Attendance_Class').value;//申請項目
        var name=document.getElementById('name').value;//人員姓名
        var Supply=document.getElementById('Supply').value;//請假類別
       
        //開始時間

        var start_year=document.getElementById('start_year').value;
        var start_month=document.getElementById('start_month').value;
        var start_date=document.getElementById('start_date').value;
        var start_hour=document.getElementById('start_hour').value;
        var start_second=document.getElementById('start_second').value;

        var start=start_year+"-"+start_month+"-"+start_date+" "+start_hour+":"+start_second+":"+"00";

         //結束時間
        var end_year=document.getElementById('end_year').value;
        var end_month=document.getElementById('end_month').value;
        var end_date=document.getElementById('end_date').value;
        var end_hour=document.getElementById('end_hour').value;
        var end_second=document.getElementById('end_second').value;

        var end=end_year+"-"+end_month+"-"+end_date+" "+end_hour+":"+end_second+":"+"00";
        var type=0;
        
        var reason=document.getElementById('reason').value;//理由
       
        var data=[type,name,id,start,end,Attendance_Class,Supply,reason];//build array
        

        if(reason.length==0)
        {
            alert("申請事由不能是空的")
        }
        else
        {
            
            var xmlhttp = new XMLHttpRequest();//傳送資料
            xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          document.getElementById('content').innerHTML=message;   
                        }
                        else
                        {
                            alert("此單資料重複");
                        }                        
                                                                     
                      }
                    };
        
            var url="../index.php/Manually_C/Supply_Send";
            xmlhttp.open("post", url, true);
            xmlhttp.send(JSON.stringify(data));
        }
    }


    function Send_Edit()
    {
        var index=document.getElementById('Edit_index').value;

        var start_date=document.getElementById('Edit_Start_Date').value;
        var start_time=document.getElementById('Edit_Start_Time').value;
        
        var start=start_date+" "+start_time+":"+"00";
    
        var end_date=document.getElementById('Edit_End_Date').value;
        var end_time=document.getElementById('Edit_End_Time').value;

        var end=end_date+" "+end_time+":"+"00";

        var id=document.getElementById('id').value;
        var Attendance_Class=document.getElementById('Edit_Attendance_Class').value;//申請項目
        var name=document.getElementById('Edit_Name').innerHTML;//人員姓名
        var Day_off_class=document.getElementById('Edit_Day_off').value;//請假類別
        var Edit_Supply=document.getElementById('Edit_Supply').value;

        var reason=document.getElementById('edit_reason').value;

        var data=[index,name,id,start,end,Attendance_Class,Day_off_class,reason,Edit_Supply];//build array

        if(start_date.length==0 && start_time.length==0 && end_date.length==0 && end_time.length==0 )
        {
            alert('修改時間不能為空的');
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();//傳送資料
            xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          //document.getElementById('content').innerHTML=message;
                          Edit_jump_page();
                          Count_Page()   
                        }
                        else
                        {
                            alert("此單資料重複");
                        }                        
                                                                     
                      }
                    };
        
            var url="../index.php/Manually_C/Send_Edit";
            xmlhttp.open("post", url, true);
            xmlhttp.send(JSON.stringify(data));
        }
        
     }

     function Logout()
     {   
        var r = confirm("是否要登出");
        if (r == true)
         {
            window.location.assign("../index.php/Logout");       
         } 


     }

     function Search()
     {
        var id="'"+document.getElementById('id').value+"'";
        var Attendance_Class="'"+document.getElementById('Attendance_Class').value+"'";//申請項目
        var name="'"+document.getElementById('name').value+"'";//人員姓名
        var Day_off_class="'"+document.getElementById('Day_off').value+"'";//請假類別
        var All=document.getElementById('All').checked;
       
        //開始時間

        var start_year=document.getElementById('start_year').value;
        var start_month=document.getElementById('start_month').value;
        var start_date=document.getElementById('start_date').value;
        var start_hour=document.getElementById('start_hour').value;
        var start_second=document.getElementById('start_second').value;

        var start="'"+start_year+"-"+start_month+"-"+start_date+" "+start_hour+":"+start_second+":"+"00"+"'";

         //結束時間
        var end_year=document.getElementById('end_year').value;
        var end_month=document.getElementById('end_month').value;
        var end_date=document.getElementById('end_date').value;
        var end_hour=document.getElementById('end_hour').value;
        var end_second=document.getElementById('end_second').value;

        var end="'"+end_year+"-"+end_month+"-"+end_date+" "+end_hour+":"+end_second+":"+"00"+"'";

        if(All==false)
        {
          sql="Select * from holiday_detail where `name`="+name+" and `item`="+Attendance_Class+" and `start_date`>= "+start+" and `end_date` <="+ end;  
        }
        else
        {
          sql="Select * from holiday_detail where  `item`="+Attendance_Class+" and `start_date`>= "+start+" and `start_date` <="+ end;  
        }
    
        //document.writeln(sql);

            document.getElementById('sql').value=sql;
            var xmlhttp = new XMLHttpRequest();//傳送資料
            xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        Count_Page();
                        document.getElementById('content').innerHTML=message;                                   
                                                                     
                      }
                    };
            sql=sql+"  limit 0,8";
            var url="../index.php/Manually_C/Search";
            xmlhttp.open("post", url, true);
            xmlhttp.send(sql);
      
        
        
     }
     function No_pay_Send(index)
     {
         var r = confirm("是否要送出");
        if (r == true)
         {
               var id=document.getElementById('id').value;
               var Attendance_Class=document.getElementById('Attendance_Class').value;//申請項目
               var name=document.getElementById('name').value;//人員姓名
               var Day_off_class=document.getElementById('Day_off').value;//請假類別
       
        //開始時間

               var start_year=document.getElementById('start_year').value;
               var start_month=document.getElementById('start_month').value;
               var start_date=document.getElementById('start_date').value;
               var start_hour=document.getElementById('start_hour').value;
               var start_second=document.getElementById('start_second').value;

               var start=start_year+"-"+start_month+"-"+start_date+" "+start_hour+":"+start_second+":"+"00";

         //結束時間
               var end_year=document.getElementById('end_year').value;
               var end_month=document.getElementById('end_month').value;
               var end_date=document.getElementById('end_date').value;
               var end_hour=document.getElementById('end_hour').value;
               var end_second=document.getElementById('end_second').value;

               var end=end_year+"-"+end_month+"-"+end_date+" "+end_hour+":"+end_second+":"+"00";

        //理由

               var reason=document.getElementById('reason').value;

               document.getElementById('sql').value="Select * from holiday_detail where `time`=curdate()"; 

               if(index==1)
               {
                     
                     var data=[1,name,id,start,end,'請假','Typhoon',reason];//build array
               }
               else
               {
                     var data=[1,name,id,start,end,'請假','power_failure',reason];//build array
               }

               if(reason.length==0)
              {
                  alert("申請事由不能是空的")
              }
              else
              {  
                  var xmlhttp = new XMLHttpRequest();//傳送資料
                  xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          document.getElementById('content').innerHTML=message;
                          document.getElementById('reason').value="";


                        }
                        else
                        {
                            alert("此單資料重複");
                        }                        
                                                                     
                      }
                    };
        
                  var url="../index.php/Manually_C/No_pay_Send";
                  xmlhttp.open("post", url, true);
                  xmlhttp.send(JSON.stringify(data));      
             }
        
         } 
     }

     function Annual()
     {
        var xmlhttp = new XMLHttpRequest();//傳送資料
                  xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                            alert("更新成功");

                        }
                        else
                        {
                            alert("錯誤");
                        }                        
                                                                     
                      }
                    };
        
                  var url="../index.php/Manually_C/Annual";
                  xmlhttp.open("post", url, true);
                  xmlhttp.send(JSON.stringify(data));
     }
        
