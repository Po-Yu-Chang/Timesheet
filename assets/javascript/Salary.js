 function account()
  {
    var ref_table=Get_table_data('datatable');
    var main_table=Get_table_data('attendance_table');
    var base_money_h=0;
    var total_money=0;
    var add_money=0;
    var abstract=0;
    var full=0;
    var helf=0;
    var Final=0;
    var out="";
    var temp_1d_array=[];
    for(var i=0;i<53;i++)
    {
      
      temp_1d_array[i]=ref_table[i][0]+ "";

    }
        if(ref_table.length>0 && main_table.length>0)//先確認是否有資料
    {
      for(var i=1;i<53;i++) //ref_table[a][2]
      {
         var b=main_table[i][0];

//****************************
        var a=temp_1d_array.indexOf(b);
        

//****************************
       if(a>0)
       {
         if(ref_table[a][1]=='月薪' )
         {
            
            base_money_h=Math.round(ref_table[a][2]/30/8);//一小時時薪
            total_money= parseInt(ref_table[a][2])+parseInt(ref_table[a][3])+parseInt(ref_table[a][4])+parseInt(ref_table[a][5])+
            parseInt(ref_table[a][6])+parseInt(ref_table[a][7])+parseInt(ref_table[a][8])
            +parseInt(ref_table[a][9])+parseInt(ref_table[a][10])+parseInt(ref_table[a][11])+parseInt(ref_table[a][12])
            +parseInt(ref_table[a][13])-parseInt(ref_table[a][14])-parseInt(ref_table[a][15])
            -parseInt(ref_table[a][16])-parseInt(ref_table[a][17]);
            
//************************************************************************************加班
            add_money=Math.round((main_table[i][8]*base_money_h*1.88)+(main_table[i][9]*base_money_h*2.22));
//************************************************************************************全勤
            if((parseInt(main_table[i][4])+parseInt(main_table[i][6])+parseInt(main_table[i][7]))>2)
            {
              abstract=abstract+parseInt(ref_table[a][5]);//全扣
             
            }
            else if((parseInt(main_table[i][4])+parseInt(main_table[i][6])+parseInt(main_table[i][7]))==2)
              {
                abstract=abstract+parseInt(ref_table[a][5]*2/3); // 扣2/3
              }
              
           
            else if((parseInt(main_table[i][4])+parseInt(main_table[i][6])+parseInt(main_table[i][7])==1))
            {
              abstract=abstract+parseInt(ref_table[a][5]*1/3);// 扣1/3
             
            }
            else
            {
              abstract=0;
             
            }
    
 //************************************************************************************
             full=(parseInt(main_table[i][3])+parseInt(main_table[i][5])+parseInt(main_table[i][11])+parseInt(main_table[i][21])+
              parseInt(main_table[i][22]))*base_money_h;
             helf=(parseInt(main_table[i][12])+parseInt(main_table[i][18])+parseInt(main_table[i][19])+
              parseInt(main_table[i][20]))*base_money_h/2;            
             abstract=abstract+full+helf;
             Final=total_money+add_money-abstract;
 //*********************************************************************************************display
             out+="<div style='margin-bottom:10px;'><table><tr>";
             for(var k=0;k<main_table[0].length;k++)
             {
               out+="<th>"+main_table[0][k]+"</th>";
             }            
              out+="</tr><tr>";

             for(var k=0;k<main_table[i].length;k++)
             {
              out+="<td>"+main_table[i][k]+"</td>";
             }
              out+="</tr><tr>";

              for(var k=0;k<ref_table[0].length;k++)
             {
               out+="<th>"+ref_table[0][k]+"</th>";
             }            
              out+="</tr><tr>";
              
             for(var k=0;k<ref_table[a].length;k++)
             {
              out+="<td>"+ref_table[a][k]+"</td>";
             }
              out+="</tr>";

              out+="<tr><th>加班總金額</th><th>應扣總金額</th><th>實領薪資</th></tr>";
              out+="<td>"+add_money+"</td><td>"+abstract+"</td><td>"+Final+"</td></table></div>";

         }
         else 
         {
           
               base_money_h=Math.round(ref_table[a][2]/30/8);//一小時時薪
            total_money= parseInt(ref_table[a][2])+parseInt(ref_table[a][3])+parseInt(ref_table[a][4])+parseInt(ref_table[a][5])+
            parseInt(ref_table[a][6])+parseInt(ref_table[a][7])+parseInt(ref_table[a][8])
            +parseInt(ref_table[a][9])+parseInt(ref_table[a][10])+parseInt(ref_table[a][11])+parseInt(ref_table[a][12])
            +parseInt(ref_table[a][13])-parseInt(ref_table[a][14])-parseInt(ref_table[a][15])
            -parseInt(ref_table[a][16])-parseInt(ref_table[a][17]);
            
//************************************************************************************加班
            add_money=Math.round((main_table[i][8]*base_money_h*1.88)+(main_table[i][9]*base_money_h*2.22));
//************************************************************************************全勤
            if((parseInt(main_table[i][4])+parseInt(main_table[i][6])+parseInt(main_table[i][7]))>2)
            {
              abstract=abstract+parseInt(ref_table[a][5]);//全扣
             
            }
            else if((parseInt(main_table[i][4])+parseInt(main_table[i][6])+parseInt(main_table[i][7]))==2)
            {
              abstract=abstract+parseInt(ref_table[a][5]*2/3); // 扣2/3
            }              
            else if((parseInt(main_table[i][4])+parseInt(main_table[i][6])+parseInt(main_table[i][7])==1))
            {
              abstract=abstract+parseInt(ref_table[a][5]*1/3);// 扣1/3
             
            }
            else
            {
              abstract=0;
             
            }
    
 //************************************************************************************
             full=(parseInt(main_table[i][3])+parseInt(main_table[i][5])+parseInt(main_table[i][11])+parseInt(main_table[i][21])+
              parseInt(main_table[i][22]))*base_money_h;
             helf=(parseInt(main_table[i][12])+parseInt(main_table[i][18])+parseInt(main_table[i][19])+
              parseInt(main_table[i][20]))*base_money_h/2;            
             abstract=abstract+full+helf;
             Final=total_money+add_money-abstract;
 //*********************************************************************************************display
             out+="<div style='margin-bottom:10px;'><table><tr>";
             for(var k=0;k<main_table[0].length;k++)
             {
               out+="<th>"+main_table[0][k]+"</th>";
             }            
              out+="</tr><tr>";

             for(var k=0;k<main_table[i].length;k++)
             {
              out+="<td>"+main_table[i][k]+"</td>";
             }
              out+="</tr><tr>";

              for(var k=0;k<ref_table[0].length;k++)
             {
               out+="<th>"+ref_table[0][k]+"</th>";
             }            
              out+="</tr><tr>";
              
             for(var k=0;k<ref_table[a].length;k++)
             {
              out+="<td>"+ref_table[a][k]+"</td>";
             }
              out+="</tr>";

              out+="<tr><th>加班總金額</th><th>應扣總金額</th><th>實領薪資</th></tr>";
              out+="<td>"+add_money+"</td><td>"+abstract+"</td><td>"+Final+"</td></table></div>";
         }
       }
      document.getElementById('result').innerHTML=out;
  }
}
}
  function Get_table_data(name)
  {
      var table=document.getElementById(name);
      var index_array=[];var inner_array=[];
      for(var c=0,m=table.rows.length;c<m;c++)
     {
       for(var k=0;k<table.rows[c].cells.length;k++)
       {
         inner_array.push(table.rows[c].cells[k].innerHTML);
       }
        index_array[c]=inner_array; //buid array
        inner_array=[];//Clear Array for next
     }
     return index_array;
  }

  function Export()
  {
      var year=document.getElementById('year').value;
      var month=document.getElementById('month').value;
      var ref_table=Get_table_data('datatable');
      var main_table=Get_table_data('attendance_table');
      var new_data=JSON.stringify(ref_table)+":"+JSON.stringify(main_table);
      var xmlhttp=new XMLHttpRequest()
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
               window.open("../template/"+year+month+".xls");
            }
      };
     
    var url="../index.php/Salary_C/Export/"+year+month;
    xmlhttp.open("post", url, true);
    xmlhttp.send(new_data);
   
  }

  function get()
  {
      var ref_table=Get_table_data('datatable');
      var main_table=Get_table_data('attendance_table');
      var new_data=JSON.stringify(ref_table)+":"+JSON.stringify(main_table);
      document.writeln(new_data);
  }

  function cloud()
 {
      var year=document.getElementById('year').value;
      var month=document.getElementById('month').value;

      if(year>0 && month>0)
      {
        var xmlhttp=new XMLHttpRequest()
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
              document.getElementById('detail_area').innerHTML=xmlhttp.responseText; 
              openarea(event, 'detail_area');
              close_cloud();
              alert('運算完成');
            }
      };

    var url="../index.php/Salary_C/cloud/"+year+month;

    xmlhttp.open("post", url, true);
    xmlhttp.send(); 
    action_cloud();    
      }
      else
      {
        alert('日期格式錯誤')
      }
 }
 
  function readFile()
  {
    if(Confirm_Data_Type()=='csv')
    {
      var fileInput=document.getElementById('csv');
    clear();
    var Html="<table id='datatable'>";    
    var reader=new FileReader(); 
    reader.onload = function () {
    var allTextLines = reader.result.split(/\r\n|\n/);
    for(var i=0;i<allTextLines.length-1;i++)
    {
      var r=allTextLines[i].split(",");
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
    reader.readAsText (fileInput.files[0],'big5');//*********************************important  
    }
    else
    {
      alert('資料型態錯誤，檔案型態為CSV檔');
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
  function openwindow(name)
  {
    var year=document.getElementById('year').value;
    var month=document.getElementById('month').value;
    var date=year+month;
    url="../index.php/Salary_C/find/"+encodeURIComponent(name)+date;
    window.location=url;
  }
  function openarea(evt, cityName) {
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
  function Initial_date()
  {
    var d = new Date();
    var year = d.getFullYear()-1911;
    var month = d.getMonth();
    document.getElementById('year').value=year;
    document.getElementById("month").selectedIndex = ""+month+"";

  }

  function test()
  {
    var ref_table=Get_table_data('datatable');
      var main_table=Get_table_data('attendance_table');
      var new_data=JSON.stringify(ref_table)+":"+JSON.stringify(main_table);
      alert(new_data);
  }

  function Logout()
     {   
        var r = confirm("是否要登出");
        if (r == true)
         {
            window.location.assign("../index.php/Logout");       
         } 


     }


  function action_cloud()
  {

      var favDialog = document.getElementById('MessageDialog');
      favDialog.showModal(); 

  }
  
  function close_cloud()
  {
       var favDialog = document.getElementById('MessageDialog');
       favDialog.close();
  }

