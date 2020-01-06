function Idle()
{
  openarea(event, 'Update_page');
}


function Upload()
  {
    var error=Confirm_format();
    if(Confirm_Data_Type()=='txt' && error.length==0 )
    {
      var index_array=[];
      var inner_array=[];
      var file_name=Return_file_name();
      var table=document.getElementById('datatable');
  for(var c=0,m=table.rows.length;c<m;c++)
  {
    for(var k=0;k<table.rows[c].cells.length;k++)
    {
      inner_array.push(table.rows[c].cells[k].innerHTML);
    }
    index_array[c]=inner_array; //buid array
    inner_array=[];//Clear Array for next
  }
 
        var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸 
        xmlhttp.onreadystatechange = function()
          {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
             {              
                 var message=xmlhttp.responseText;
                 if(message=="Double")
                 {
                   var r=confirm("你上傳的資料有重複，是否要覆蓋");
                   if(r==true)
                   {
                      Cover();
                   }
                   else
                   {
                      alert("你已經取消動作!如果需上傳檔案，請重新動作!");
                   }
                 }
                 else
                 {
                   alert(message);
                 }
             }
          };
        var url="../index.php/Track_C/Insert_track_table/track_detail/"+encodeURI(file_name);
        xmlhttp.open("post", url, true);
        xmlhttp.send(JSON.stringify(index_array));
    }
    else
    {
      if(Confirm_format().length!=0 )
      {
        alert(error);
      }
      else
      {
        alert("沒有選擇檔案");
      }
      
    }
  }


  function Cover()
  {
    var error=Confirm_format();
    if(Confirm_Data_Type()=='txt' && error.length==0 )
    {
      var index_array=[];
      var inner_array=[];
      var file_name=Return_file_name();
      var table=document.getElementById('datatable');
  for(var c=0,m=table.rows.length;c<m;c++)
  {
    for(var k=0;k<table.rows[c].cells.length;k++)
    {
      inner_array.push(table.rows[c].cells[k].innerHTML);
    }
    index_array[c]=inner_array; //buid array
    inner_array=[];//Clear Array for next
  }

        var xmlhttp = new XMLHttpRequest();//開始進行非同步傳輸 
        xmlhttp.onreadystatechange = function()
          {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
             {              
                 var message=xmlhttp.responseText;                 
                 alert(message);
             }
          };
        var url="../index.php/Track_C/Cover_table/track_detail/"+file_name;
        xmlhttp.open("post", url, true);
        xmlhttp.send(JSON.stringify(index_array));
    }
    else
    {
      if(Confirm_format().length!=0 )
      {
        alert(error);
      }
      else
      {
        alert("沒有選擇檔案");
      }
      
    }
  }
 
 function readFile()
  {
    var error=Confirm_format();
    var file_name=Return_file_name();
    if(Confirm_Data_Type()=='txt' && error.length==0)
    {
      var fileInput=document.getElementById('csv');
    clear();
    var Html="<table id='datatable'>";    
    var reader=new FileReader(); 
    reader.onload = function () {
    var allTextLines = reader.result.split(/\r\n|\n/);
    for(var i=0;i<allTextLines.length-1;i++)
    {
      var r=allTextLines[i].split('\u0009');
      if(i==0)
      {
        Html+="<tr>";
        for(var j=0;j<r.length;j++)
        {
          Html+="<th class='th_d'>"+r[j]+"</th>";
        }
        Html+="</tr>";
      }
      else
      {
        Html+="<tr>";
        for(var j=0;j<r.length;j++)
        {
          Html+="<td class='td_d'>"+r[j]+"</td>";
        }
        Html+="</tr>";
      }

    }
        Html+="</table>";

       document.getElementById("out").innerHTML=Html;

   };
       
    reader.readAsText (fileInput.files[0]);//*********************************important  
    }
    else
    {
       if(Confirm_format().length!=0 )
      {
        alert(error);
      }
      else
      {
        alert('資料型態錯誤，檔案型態為CSV檔');
      }
      
    }
    
  }
  //***********Clear Tag from innerHTML
  function clear() 
  {
    document.getElementById("out").innerHTML = "";
  }
  function Confirm_Data_Type()
  {
    var fileInput=document.getElementById('csv').value;   
    var extIndex = fileInput.lastIndexOf('.');
       if (extIndex != -1) 
   {
      var name = fileInput.substr(0, extIndex);                     //檔名不含副檔名
 
      var ext= fileInput.substr(extIndex+1, fileInput.length); //副檔名
   }
   return ext;
    

  }

  function Confirm_format()
  {
    var fileInput=document.getElementById('csv').value;   
    var extIndex = fileInput.lastIndexOf('.');
       if (extIndex != -1) 
    {
       var name = fileInput.substr(0, extIndex);                     //檔名不含副檔名
 
      var ext= fileInput.substr(extIndex+1, fileInput.length); //副檔名
    }
    var string=name;
    var index=string.lastIndexOf('-');
    var name=string.substr(index+1,string.length);
    var error="";
    if(name.length!=8)
   {
       error+="日期格式長度錯誤，日期格式為8碼"+'\n';
   }
   else
   {
        if(parseInt(name.substr(0,4))<1911)
       {
            error+="年份格式錯誤，格式為西元"+'\n';
        }
        else
        {
            if(parseInt(name.substr(4,2))>13 || parseInt(name.substr(4,2))<0 )
            {
                error+="月份格式錯誤"+'\n';
            }
            else
            {
                if(parseInt(name.substr(6,2))>31 || parseInt(name.substr(4,2))<0)
                {
                     error+="日期錯誤"+'\n';
                }
        
            }
        }
    }
     return error;    


  }

   function Return_file_name()
  {
    var fileInput=document.getElementById('csv').value;   
    var extIndex = fileInput.lastIndexOf('.');
       if (extIndex != -1) 
   {
      //var name1 = fileInput.substr(0, extIndex);                     //檔名不含副檔名
      var name=fileInput.replace(/^.*[\\\/]/, '');
      var index=name.lastIndexOf('.');
      var out=name.substr(0,index);
      var ext= fileInput.substr(extIndex+1, fileInput.length); //副檔名
   }
   return out;
    

  }


  function openarea(evt, cityName) 
   {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }


function Search()
{
  var file=document.getElementById('file').value;
  var client=document.getElementById('client').value;
  var locate=document.getElementById('locate').value;
  var type=document.getElementById('type').value;
  var machine=document.getElementById('machine').value;
  var member=document.getElementById('member').value;
  var start=document.getElementById('start').value;
  var end=document.getElementById('end').value;
  var finish=document.getElementById('finish').value;
  
  var check=document.getElementById('All').checked;

  var judge=document.getElementById('judge').value;
  var out_date=document.getElementById('out_date').value;


  if(finish=="Y")
  {
    finish="Y";
  }
  else if(finish=="N")
  {
    finish="N";
  }
  else
  {
    finish="";
  }


  if(start.length==0 || end.length==0)
  {
    alert('日期塞選不能為空');
  }
  else
  {
    if(type==5)
    {

    }
    else
    {
      var Data=[file,client,locate,type,machine,member,finish,out_date,start,end,judge];
      //document.writeln(JSON.stringify(Data));
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
                           alert(message);
                        }                        
                                                                     
                      }
                    };
         if(check==false)
         {
            var url="../index.php/Track_C/Search_track_table/0";
         }
         else
         {
            var url="../index.php/Track_C/Search_track_table/1";
         }
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(JSON.stringify(Data));
    }
  }


}

function Inform(index)
{
   var number=index+"_member";
   var maintain_number=document.getElementById(number).value;
   var username=document.getElementById('username').value;

   if(maintain_number.length==0)
   {
      alert("完工申報，必須填寫維修單號");
   }
   else
   {
      Data=[index,maintain_number,username];
      var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                            var new_data=JSON.parse(message);                       
                            var finish_date=index+"_finish_date";
                            var finish_member=index+"_finsish_member";
                            var finish=index+"_finish";              

                           document.getElementById(finish_date).value=new_data[0];
                           document.getElementById(finish_member).value=new_data[1];
                           document.getElementById(finish).value=new_data[2]; 
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    }
       
         var url="../index.php/Track_C/Inform";
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(JSON.stringify(Data));
   }
 }

 function Report()
 {
  var file=document.getElementById('file').value;
  var client=document.getElementById('client').value;
  var locate=document.getElementById('locate').value;
  var type=document.getElementById('type').value;
  var machine=document.getElementById('machine').value;
  var member=document.getElementById('member').value;
  var start=document.getElementById('start').value;
  var end=document.getElementById('end').value;
  var finish=document.getElementById('finish').value;

  var check=document.getElementById('All').checked;
  var out_date=document.getElementById('out_date').value;

  if(finish=="Y")
  {
    finish="Y";
  }
  else if(finish=="N")
  {
    finish="N";
  }
  else
  {
    finish="";
  }


  if(start.length==0 || end.length==0)
  {
    alert('日期塞選不能為空');
  }
  else
  {
    if(type==5)
    {

    }
    else
    {
      var Data=[file,client,locate,type,machine,member,finish,out_date,start,end,judge];
      //document.writeln(JSON.stringify(Data));
      var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          //alert(message);
                           //window.open("../template/"+message+".xls");          
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
         if(check==false)
         {
            var url="../index.php/Track_C/Report/0";
         }
         else
         {
            var url="../index.php/Track_C/Report/1";
         }
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(JSON.stringify(Data));
    }
 }
}

function Cancel(index)
{
   var r=confirm("是否取消申報");

   if(r==true)
   {
      var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message=="Success")
                        {
                           var finish_date=index+"_finish_date";
                           var finish_member=index+"_finsish_member";
                           var finish=index+"_finish"; 
                           var number=index+"_member";
                           document.getElementById(finish_date).value="";
                           document.getElementById(finish_member).value="";
                           document.getElementById(finish).value="N"; 
                           document.getElementById(number).value="";

                           alert("取消成功");       
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
         
        var url="../index.php/Track_C/Cancel";
         
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(index);
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

     function Record(ele)
     {
       var checkboxes = document.getElementsByTagName('input');
       var area=document.getElementById('Group_area');
       area.value="";

       for(var i=0 ;i<checkboxes.length;i++)
       {
          if(checkboxes[i].type=='checkbox')
          {
            if(checkboxes[i].checked==true)
            {
               if(area.value==0)
               {
                 area.value=area.value+checkboxes[i].id;
               }
               else
               {
                area.value=area.value+","+checkboxes[i].id;
               }
            }
          }
       }
       
     }


     function Group_inform()
     {
        var area=document.getElementById('Group_area').value;
        var Group_number=document.getElementById('Group_number').value;
        var Data=[area,Group_number];

        var r=confirm("是否要群組申報");

        if(r==true)
        {
          if(Group_number.length==0)
          {
            alert("沒有勾選任何資料");
          }
          else
          {
            var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                                         
                          Search();
                          alert("更新成功");                                        
                      }
                    };
         
        var url="../index.php/Track_C/Group_inform";
         
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(JSON.stringify(Data));
          }
        }
     }



