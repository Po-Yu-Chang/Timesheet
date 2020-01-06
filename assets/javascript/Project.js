var baseUrl = document.getElementById('baseurl').value;
window.onload = Idle();
function Idle() {
    //openarea(event, 'Project_New');
    Get_Machine();
    Get_Dept();
    Get_Project_Name();
    Get_Due_Machine();
    Get_Check_box();
    Get_Check_box2();
    Get_Client();
}


function openarea(evt, cityName) // tab display or not
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

function Add_Child_Item(target, area, class_name) {

    //var Item= document.getElementById("Child_Item").value;//Get Item string
    var Item = document.getElementById(target).value;//Get target value   
    var Item_array = Item.split(",");//Get the target value and string to array
    var html = "";

    for (var i = 0; i < Item_array.length; i++) {
        html += "<Input readonly id='Child" + i + "' Class='" + class_name + "'" + "value='" + Item_array[i] + "'><br>";
    }
    document.getElementById(area).innerHTML = html;
    //document.getElementById('Item_area').innerHTML=html;
}

function Get_Project_Item_value(target) {
    var Data_Out = [];
    var out = "";
    var Item_array = document.getElementsByClassName(target);

    for (var i = 0; i < Item_array.length; i++) {
        Data_Out[i] = Item_array[i].value;

    }

    return Data_Out;
}

function Send() {
    var Project_Name = document.getElementById('Project_Name').value;
    var Macine_Number = document.getElementById('Macine_Number').value;
    var Machine = document.getElementById('Machine_Name').value;
    var Start_date = document.getElementById('Start_date').value;
    var End_date = document.getElementById('End_date').value;
    var State = document.getElementById('State').value;
    var apply = Get_Check_box_Data(1);

    //var Item=Get_Project_Item_value().join();
    //console.log(Item);
    var Show_Message = "";
    var Data_Name = ['專案名稱', '機台編號', '機台名稱', '開始日期', '結束日期', '狀態'];
    var Data = [Project_Name, Macine_Number, Machine, Start_date, End_date, State, apply];

    for (var i = 0; i < Data.length; i++) {
        if (Data[i].length == 0) {
            Show_Message += Data_Name[i] + "不能為空的" + '\n';

        }
    }

    if (Show_Message.length == 0)//Check message if message have data
    {
        var url = "../index.php/Project_C/Send";
        var judge = true;
        Ajax(url, judge, Data);
    }
    else {
        alert(Show_Message);
    }

}

function Ajax(url, judge, Data) {

    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            alert(xmlhttp.responseText);
            //Search_Item();                 
        }
    };



    xmlhttp.open("post", url, true);
    if (judge == true) {
        xmlhttp.send(JSON.stringify(Data));
    }
    else {
        xmlhttp.send();
    }



}

function New_Client() {
    $.ajax({
        url: '../?/Project_C/New_Client',
        data: {
            "client": $('#new_Client').val()
        },
        type: 'POST',
        error: function (xhr) {
            alert(xhr + 'Ajax request 發生錯誤');
        },
        success: function (data) {

            alert(data);
            Get_Client()

        }
    });
}

function Get_Client() {
    $.ajax({
        url: '../?/Project_C/Get_Client',
        type: 'POST',
        error: function (xhr) {
            alert(xhr + 'Ajax request 發生錯誤');
        },
        success: function (data) {
            $('#Client_table tbody').html(data);

            //console.log(data);
        }
    });
}

function Get_Dept() {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;

            var Data = JSON.parse(message);
            var Due_Dept = document.getElementById('Due_Dept');
            var Dept = document.getElementById('Dept');
            var Child_Due_Dept = document.getElementById('Child_Due_Dept');
            Child_Due_Dept.setAttribute("onchange", "Find_Class_Item();");

            for (var i = Due_Dept.options.length; i-- > 0;) {
                Due_Dept.options[i] = null;
                Dept.options[i] = null;
                Child_Due_Dept.options[i] = null;
            }

            for (var i = 0; i < Data.length; i++) {
                Due_Dept.options[i] = new Option(Data[i][1], Data[i][0]);
                Dept.options[i] = new Option(Data[i][1], Data[i][0]);
                Child_Due_Dept.options[i] = new Option(Data[i][1], Data[i][0]);
            }

        }
    };
    url = "../index.php/Project_C/Get_Dept";
    xmlhttp.open("post", url, true);
    xmlhttp.send();

}

function Get_Project_Name() {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            document.getElementById("Project_Select_Name").innerHTML = message;
        }
    };
    url = "../index.php/Project_C/Get_Project_Name";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
}

function Send_Project_Item() {
    var Get_Project_Name = document.getElementById('Get_Project_Name').value;
    var Dept = document.getElementById('Dept').value;
    var Item = Get_Project_Item_value('New_Item').join();

    var Show_Message = "";
    var Data_Name = ['專案名稱', '部門別', '項目'];
    var Data = [Get_Project_Name, Dept, Item];

    for (var i = 0; i < Data.length; i++) {
        if (Data[i].length == 0) {
            Show_Message += Data_Name[i] + "不能為空的" + '\n';

        }
    }

    if (Show_Message.length == 0)//Check message if message have data
    {
        var url = "../index.php/Project_C/Send_Project_Item";
        var judge = true;
        Ajax(url, judge, Data);
    }
    else {
        alert(Show_Message);
    }
}

function Send_Due_Item() {
    // var Due_Machine=document.getElementById('Target_Machine').value;
    var Dept = document.getElementById('Due_Dept').value;
    var Item = Get_Project_Item_value('Item_Class').join();
    var Show_Message = "";
    var Data_Name = ['部門別', '項目'];
    var Data = [Dept, Item];

    for (var i = 0; i < Data.length; i++) {
        if (Data[i].length == 0) {
            Show_Message += Data_Name[i] + "不能為空的" + '\n';
        }
    }

    if (Show_Message.length == 0)//Check message if message have data
    {
        var url = "../index.php/Project_C/Send_Due_Item";
        var judge = true;
        Ajax(url, judge, Data);
    }
    else {
        alert(Show_Message);
    }
}


function Search_Item() {
    var Project_Name = document.getElementById('Get_Project_Name').value;
    var Dept = document.getElementById('Dept').value;
    Data_Name = ['專案名稱', '部門'];
    Data = [Project_Name, Dept];
    Show_Message = "";
    for (var i = 0; i < Data.length; i++) {
        if (Data[i].length == 0) {
            Show_Message += Data_Name[i] + "不能為空的" + '\n';

        }
    }

    if (Show_Message.length == 0)//Check message if message have data
    {
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var message = xmlhttp.responseText;
                document.getElementById("Project_Item_area").innerHTML = message;
            }
        };
        url = "../index.php/Project_C/Search_Item";
        xmlhttp.open("post", url, true);
        xmlhttp.send(JSON.stringify(Data));
    }
    else {
        alert(Show_Message);
    }

}

function Show_New_Item_Console() {
    document.getElementById('Display_Name').innerHTML = document.getElementById('Get_Project_Name').value;
    document.getElementById('Display_Dept').innerHTML = document.getElementById('Get_Dept').value;
    favDialog = document.getElementById('favDialog');
    favDialog.showModal();
}

function Close_Item_Console() {
    favDialog = document.getElementById('favDialog');
    favDialog.close();
}
function Open_Console(name) {
    name = document.getElementById(name);
    name.showModal();
}
function Close_Consloe(name) {
    name = document.getElementById(name);
    name.close();
}

function Update(index, start, end, state) {
    document.getElementById('update_index').value = index;
    document.getElementById('U_Start_date').value = start;
    document.getElementById('U_End_date').value = end;
    document.getElementById('U_State').value = state;
    $("#dialog_div").dialog();
}

function Send_Update() {
    var index = document.getElementById('update_index').value;
    var start = document.getElementById('U_Start_date').value;
    var end = document.getElementById('U_End_date').value;
    var state = document.getElementById('U_states').value;
    var Data = [index, start, end, state];

    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            Search_Main();
            alert(message);
        }
    };
    url = "../index.php/Project_C/Send_Update";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));
}

function Delete(index) {
    var Data = [];
    var t = confirm("是否確認要刪除?");

    if (t == true) {
        var url = "../index.php/Project_C/Delete/" + index;
        var judge = false;
        Ajax(url, judge, Data);

    }
}

function Delete_Child_Item(index) {
    var Data = [];
    var t = confirm("是否確認要刪除?");

    if (t == true) {
        var url = "../index.php/Project_C/Delete_Child_Item/" + index;
        var judge = false;
        Ajax(url, judge, Data);
        Search_Child_Item();

    }
}

function Close_Update_Console() {
    UpdateDialog = document.getElementById('UpdateDialog');
    UpdateDialog.close();
}

function Show_Update_Console(index) {
    document.getElementById('Update_index').value = index;
    UpdateDialog = document.getElementById('UpdateDialog');
    UpdateDialog.showModal();
}

function Search_Main() {
    // var Start_date = document.getElementById('Search_Start').value;
    // var End_date = document.getElementById('Search_End').value;
    var Project_Name = document.getElementById('Search_Project_Name').value;
    var Dept = document.getElementById('Search_Dept').value;

    var Data = [Project_Name, Dept];

    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;

            document.getElementById("Main_area").innerHTML = message;
        }
    };
    url = "../index.php/Project_C/Search_Main";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));

}

function Get_Machine() {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            var Data = JSON.parse(message);
            var Machine_Name = document.getElementById('Machine_Name');

            Machine_Name.setAttribute("onchange", "Get_Machine_Number();");
            if (Data.length == 0) {
                for (var i = Machine_Name.options.length; i-- > 0;)
                    Machine_Name.options[i] = null;

            }
            for (var i = 0; i < Data.length; i++) {
                Machine_Name.options[i] = new Option(Data[i], Data[i]);

            }
            Get_Machine_Number();
        }

    };
    url = "../index.php/Project_C/Get_Machine_ALL";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
}

function Get_Machine_Number() {
    var Machine_Name = document.getElementById('Machine_Name').value;
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            var Data = JSON.parse(message);
            var Macine_Number = document.getElementById('Macine_Number');

            for (var i = Macine_Number.options.length; i-- > 0;)
                Macine_Number.options[i] = null;

            for (var i = 0; i < Data.length; i++) {
                Macine_Number.options[i] = new Option(Data[i], Data[i]);
            }
        }
    };
    url = "../index.php/Project_C/Get_Machine_Number";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Machine_Name));
}
function Display_Machine_Name() {
    document.getElementById('Display_Machine_Name').innerHTML = document.getElementById('Machine_Name').value;
}

function New_Machine() {
    var Machine_Name = document.getElementById('New_Machine_Name').value;
    var apply = Get_Check_box_Data(2);
    var Data = [Machine_Name, apply];
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            alert(message);
            Get_Machine();
        }
    };
    url = "../index.php/Project_C/New_Machine_Name";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));
}

function New_Number() {
    var Machine_Name = document.getElementById('Machine_Name').value;
    var Machine_Number = document.getElementById('New_Machine_Number').value;
    console.log(Machine_Name);
    var Data = [Machine_Name, Machine_Number];
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            alert(message);
            Get_Machine_Number();
        }
    };
    url = "../index.php/Project_C/New_Machine_Number";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));
}

function Get_Due_Machine() {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            //document.getElementById('Due_Machine').innerHTML=message;                       
        }
    };
    url = "../index.php/Project_C/Get_Due_Machine";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
}

function Search_Due_Item() {
    //var Machine=document.getElementById('Target_Machine').value;
    var Dept = document.getElementById('Due_Dept').value;
    var Data = [Dept];
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var message = xmlhttp.responseText;
            document.getElementById('Project_Due_area').innerHTML = message;
        }
    };
    url = "../index.php/Project_C/Search_Due_Item";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));
}
function Delete_Item(index) {
    var r = confirm("是否確認要刪除");
    if (r == true) {
        var xmlhttp = new XMLHttpRequest();//傳送資料
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var message = xmlhttp.responseText;
                alert(message);
                Search_Due_Item();
            }
        };
        url = "../index.php/Project_C/Delete_Item/" + index;
        xmlhttp.open("post", url, true);
        xmlhttp.send();
    }
}

function Find_Class_Item() {
    //var Machine=document.getElementById('Child_Due_Machine').value;
    var Dept = document.getElementById('Child_Due_Dept').value;
    var Data = [Dept];
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Data = JSON.parse(xmlhttp.responseText);
            var Class_Item = document.getElementById('Class_Item');

            for (var i = Class_Item.options.length; i-- > 0;)
                Class_Item.options[i] = null;

            for (var i = 0; i < Data.length; i++) {
                Class_Item.options[i] = new Option(Data[i], Data[i]);
            }

        }
    };
    url = "../index.php/Project_C/Find_Class_Item";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));


}

function Search_Child_Item() {
    //var Machine=document.getElementById('Child_Due_Machine').value;
    var Dept = document.getElementById('Child_Due_Dept').value;
    var Item = document.getElementById('Class_Item').value;

    var Data = [Dept, Item];
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('Child_Item_area').innerHTML = xmlhttp.responseText;
        }
    };
    url = "../index.php/Project_C/Search_Child_Item";
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(Data));

}

function Send_Child_Item() {
    //var Machine=document.getElementById('Child_Due_Machine').value;
    var Dept = document.getElementById('Child_Due_Dept').value;
    var Item = document.getElementById('Class_Item').value;
    var Child_Item = Get_Project_Item_value('Child_Class').join();

    var Show_Message = "";
    var Data_Name = ['部門', '類別', '子項目'];
    var Data = [Dept, Item, Child_Item];

    for (var i = 0; i < Data.length; i++) {
        if (Data[i].length == 0) {
            Show_Message += Data_Name[i] + "不能為空的" + '\n';
        }
    }

    if (Show_Message.length == 0)//Check message if message have data
    {
        var url = "../index.php/Project_C/Send_Child_Item";
        var judge = true;
        Ajax(url, judge, Data);
    }
    else {
        alert(Show_Message);
    }
}

var expanded = false;
function showCheckboxes() {

    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    }
    else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}

var expanded2 = false;
function showCheckboxes_m() {

    var checkboxes = document.getElementById("showCheckboxes_m");
    if (!expanded2) {
        checkboxes.style.display = "block";
        expanded2 = true;
    }
    else {
        checkboxes.style.display = "none";
        expanded2 = false;
    }
}

function Get_Check_box() {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('checkboxes').innerHTML = xmlhttp.responseText;
        }
    };
    url = "../index.php/Project_C/Get_Check_box/1";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
}
function Get_Check_box2() {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('showCheckboxes_m').innerHTML = xmlhttp.responseText;
        }
    };
    url = "../index.php/Project_C/Get_Check_box/2";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
}

function Get_Check_box_Data(type) {
    switch (type) {
        case 1:
            var checkbox = document.getElementsByClassName("Checkbox_Dept");
            break;
        case 2:
            var checkbox = document.getElementsByClassName("Dept2");
            break;
    }
    var out_data = []; k = 0;

    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].checked == true) {
            out_data[k] = checkbox[i].value;
            k++;
        }
    }

    return out_data.toString();
}

