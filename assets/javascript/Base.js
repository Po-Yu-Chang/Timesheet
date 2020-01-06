    function Idle()
    {
        member();
        openarea(event, 'member');
    }

    function Search_Log()
   {
    var id=document.getElementById('Log_id').value;
    var start=document.getElementById('Log_Start').value;
    var end=document.getElementById('Log_end').value;
    var Data=[id,start,end];

   if(start.length!=0 || end.length!=0)
   {
      var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                       
                        document.getElementById('Log_display').innerHTML=message;       
                                                                  
                      }
                    };
         
        var url="../index.php/Base_C/Log";
         
        xmlhttp.open("post", url, true);
        xmlhttp.send(JSON.stringify(Data));
   }
   else
   {
      alert("塞選日期不能為空");
   }
    


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

    function member()
    {
        var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          
                          document.getElementById('member').innerHTML=message;         
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
        
        var url="../index.php/Base_C/member";
       
         
         xmlhttp.open("post", url, true);
         xmlhttp.send();
    }

    function Open_New_Panel()
    {
        var favDialog = document.getElementById('New_Panel');
        favDialog.showModal();
    }

    function Close_New_Panel()
    {
        var favDialog = document.getElementById('New_Panel');
        favDialog.close();
    }

    function Open_Insert_Panel()
    {
        var favDialog = document.getElementById('Inser_Panel');
        favDialog.showModal();
    }

    function Close_Insert_Panel()
    {
        var favDialog = document.getElementById('Inser_Panel');
        favDialog.close();
    }

    function find_member(index)
    {
        var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                           var new_data=JSON.parse(message); 


 
                           document.getElementById('Note_index').value=new_data[0]
                           document.getElementById('name').value=new_data[1];
                           document.getElementById('id_1').value=new_data[2]; 
                           document.getElementById('password').value=new_data[3]; 

                           if(new_data[4]=='admin')
                           {
                             document.getElementById('leavel').selectedIndex =0;
                           }
                           else
                           {
                              document.getElementById('leavel').selectedIndex=1;
                           }       
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
        
        var url="../index.php/Base_C/find_member/"+index;
       
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(); 
    }

  function Update()
{
   var index=document.getElementById('Note_index').value;
   var name=document.getElementById('name').value;
   var id=document.getElementById('id_1').value;
   var password=document.getElementById('password').value;
   var leavel=document.getElementById('leavel_1').value;


   var Data=[index,name,id,password,leavel];

   var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message=="Success")
                        {
                          member();
                          alert("Update Success");         
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
         
        var url="../index.php/Base_C/Update";
         
         xmlhttp.open("post", url, true);
         xmlhttp.send(JSON.stringify(Data));

   
}
function Delete(index)
{
    var r = confirm("是否要刪除");
    if(r==true)
    {
        var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                          member();
                          alert("Delete Success");         
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
         
        var url="../index.php/Base_C/Delete/"+index;
         
         xmlhttp.open("post", url, true);
         xmlhttp.send();
    }
    
}

function Insert()
{
   var r = confirm("是否要新增");
   if(r==true)
   {
     var name=document.getElementById('name_2').value;
     var id=document.getElementById('id_2').value;
     var password=document.getElementById('password_2').value;
     var leavel=document.getElementById('leavel_2').value;

     var Data=[name,id,password,leavel];

     if(name.length==0 || id.length==0 || password.length==0 || leavel.length==0)
     {
        alert("欄位不能為空");
     }
     else
     {
        var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message=="Success")
                        {
                           member();
                           alert("新增成功"); 
                                
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
         
        var url="../index.php/Base_C/Insert";
         
        xmlhttp.open("post", url, true);
        xmlhttp.send(JSON.stringify(Data));
     }

     
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

