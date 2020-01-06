

function Search()
{
    var Start_date=document.getElementById('Start_date').value;
    var End_date=document.getElementById('End_date').value;
    var Data=[Start_date,End_date];

    var xmlhttp = new XMLHttpRequest();//傳送資料
                xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                      {
                        var message=xmlhttp.responseText;
                        if(message!="Error")
                        {
                           document.getElementById('Display_area').innerHTML=message;           
                        }
                        else
                        {
                           alert(message);
                        }                        
                                                                     
                      }
                    };
    var url="../index.php/Compare_C/Search";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));
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




function Logout()
     {   
        var r = confirm("是否要登出");
        if (r == true)
         {
            window.location.assign("../index.php/Logout");       
         } 


     }




