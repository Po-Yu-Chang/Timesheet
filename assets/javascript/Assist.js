window.onload = Idle();


function Idle() {

  Get_Machine();
  Fill_the_hour();
  Get_Dept();

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



function Get_Current_Day() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();

  if (dd < 10) {
    dd = '0' + dd
  }

  if (mm < 10) {
    mm = '0' + mm
  }
  today = yyyy + '-' + mm + '-' + dd;
  return today;
}
function Get_Day(value) {
  var today = new Date(value);
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();

  if (dd < 10) {
    dd = '0' + dd
  }

  if (mm < 10) {
    mm = '0' + mm
  }
  today = yyyy + '-' + mm + '-' + dd;
  return today;
}



function Open_Console(name) {
  name = document.getElementById(name);
  name.showModal();
}
function Close_Consloe(name) {
  name = document.getElementById(name);
  name.close();
}

function Fill_the_hour() {
  var Start_hour = document.getElementById('Start_hour');
  var End_hour = document.getElementById('End_hour');
  for (var i = 0; i < 24; i++) {
    if (10 - i > 0) {
      Start_hour.options[i] = new Option('0' + i, '0' + i);
      End_hour.options[i] = new Option('0' + i, '0' + i)
    }
    else {
      Start_hour.options[i] = new Option(i, i);
      End_hour.options[i] = new Option(i, i);
    }

  }
}

function Get_Project_Name() {
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById("Project_Name").innerHTML = message;
      Get_Project_Item();
    }
  };
  url = "../index.php/Project_C/Get_Project_Name";
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}
function Get_Project_Item() {
  var id = document.getElementById('id').value;
  var Project_Name = document.getElementById('Project_Name').value;
  var Data = [id, Project_Name];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      var Project_item = document.getElementById('Project_item');
      Project_item.setAttribute("onchange", "Get_Child_Item();");
      for (var i = Project_item.options.length; i-- > 0;) {
        Project_item.options[i] = null;
      }

      for (var i = 0; i < Data.length; i++) {
        Project_item.options[i] = new Option(Data[i], Data[i]);
      }
      Get_Child_Item();
    }

  };
  url = "../index.php/Maintain_C/Get_Project_Item";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));

}

function Get_Child_Item() {
  var id = document.getElementById('id').value;
  var Project_Name = document.getElementById('Project_Name').value;
  var Project_item = document.getElementById('Project_item').value;
  var Data = [id, Project_Name, Project_item];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      var Child_item = document.getElementById('Child_item');

      for (var i = Child_item.options.length; i-- > 0;) {
        Child_item.options[i] = null;
      }

      for (var i = 0; i < Data.length; i++) {
        Child_item.options[i] = new Option(Data[i], Data[i]);
      }

    }

  };
  url = "../index.php/Maintain_C/Get_Child_Item";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));
}
function Send() {
  var Machine = document.getElementById('Machine').value;
  var Project_Name = document.getElementById('Project_Name').value;
  var Project_item = document.getElementById('Project_item').value;
  var serial_number = document.getElementById('serial_number').value;
  var moment = $('#calendar').fullCalendar('getDate');//time
  var Day = moment.format('YYYY-MM-DD');//time
  var Start = Day + "T" + document.getElementById('Start_hour').value + ":" + document.getElementById('Start_Second').value;
  var End = Day + "T" + document.getElementById('End_hour').value + ":" + document.getElementById('End_Second').value;
  var Overtime = document.getElementById('Overtime').checked;
  var myTextarea = document.getElementById('myTextarea').value;
  var Resolution = (document.getElementById('End_hour').value * 60 + document.getElementById('End_Second').value) - (document.getElementById('Start_hour').value * 60 + document.getElementById('Start_Second').value);
  var duty = document.getElementById('duty').value;
  var Child_item = document.getElementById('Child_item').value;
  if (Get_Current_Day() < Day) {
    alert("只能填寫當天之前的工時");
  }
  else {
    if (document.getElementById('Start_hour').value == '12' || (document.getElementById('End_hour').value == '12' && document.getElementById('End_Second').value == '30')) {
      alert('不能再此時段填寫工時');
    }
    else {
      if (duty == 'on')//確認是否是假日
      {
        if (Overtime == true) {
          var color = 'Red';
        }
        else {
          var color = 'gray';
        }
      }
      else {
        var color = 'Red';
      }

      if (Resolution > 0) {
        var myEvent = {
          title: Machine + ":" + Project_Name + ":" + Project_item + ":" + Child_item,
          start: Start,
          end: End,
          id: serial_number,
          overlap: false,
          description: myTextarea,
          backgroundColor: color,
          className: serial_number
        };
        $('#calendar').fullCalendar('renderEvent', myEvent);

        document.getElementById('serial_number').value = document.getElementById('serial_number').value + 1;
      }
      else
        alert("結束時間必須大於開始時間");
    }
  }


}
function Check_Time(Data) {
  var Check = false;
  for (var i = 0; i < Data.length; i++) {

    var d1 = new Date(Data[i][1]);
    var d2 = new Date(Data[i][2]);
    var n1 = d1.getHours() - 8;
    var n2 = d2.getHours() - 8;
    var n1_minu = d1.getMinutes();

    var n2_minu = d2.getMinutes();
    if (n1 < 0) {
      if (n1_minu == 30)
        n1 = 24 + n1 + 0.5;
      else
        n1 = 24 + n1;
    }
    if (n2 < 0) {
      if (n1_minu == 30)
        n1 = 24 + n1 + 0.5;
      else
        n1 = 24 + n1;
    }

    if (n1 < '12' && n2 > '12') {
      Check = true;
      break;
    }
  }
  return Check;
}

function Destory(id) {
  $('#calendar').fullCalendar('removeEvents', id);
}
function Clear_All() {
  var array = $('#calendar').fullCalendar('clientEvents');
  for (var i = 0; i < array.length; i++) {
    Destory(array[i].id);
  }
}

function Restore() {
  var id = document.getElementById('member').value;
  var r = confirm("是否要儲存");
  var Data = [];
  if (r == true) {
    var array = $('#calendar').fullCalendar('clientEvents');
    for (var i = 0; i < array.length; i++) {
      Data[i] = [array[i].title, array[i].start, array[i].end, array[i].backgroundColor, id, array[i].description];
    }
    if (Check_Time(Data)) {
      alert("中午時段不能填寫工時");
    }
    else {
      var xmlhttp = new XMLHttpRequest();//傳送資料
      xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var message = xmlhttp.responseText;
          alert(message);
        }
      };
      url = "../index.php/Maintain_C/Restore";
      xmlhttp.open("post", url, true);
      xmlhttp.send(JSON.stringify(Data));
    }

  }

}

function Reload(date) {
  var id = document.getElementById('member').value

  if (date.length == 0)
    var date = Get_Current_Day();
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      Get_Information();
      Clear_All();
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);

      for (var i = 0; i < Data.length; i++) {
        var myEvent = {
          title: Data[i][0],
          start: Data[i][1],
          end: Data[i][2],
          id: Data[i][5],
          overlap: false,
          description: Data[i][4],
          backgroundColor: Data[i][3],
          className: Data[i][5]
        };
        $('#calendar').fullCalendar('renderEvent', myEvent);

      }

    }
  };
  url = "../index.php/Maintain_C/Reload/" + id + "/" + date;

  xmlhttp.open("post", url, true);
  xmlhttp.send();
}

function Edit_Fill(event) {
  var title = event.title.split(':');
  console.log(event.title);
  console.log(event.id);
  console.log(title[3]);
  var start = new Date(event.start.format());
  var end = new Date(event.end.format());
  Get_Project_Item();
  var Data = [start.getHours(), end.getHours(), start.getMinutes(), end.getMinutes()];
  var Out = [];
  for (var i = 0; i < Data.length; i++) {
    if (Data[i] < 10) {
      Out[i] = '0' + Data[i];
    }
    else {
      Out[i] = Data[i];
    }

  }


  document.getElementById('Machine').value = title[0];
  Get_Project_Name(document.getElementById('Project_Name').value = title[1]);

  document.getElementById('Project_item').value = title[2];
  document.getElementById('Child_item').value = title[3];
  document.getElementById('serial_number').value = event.id;
  document.getElementById('Start_hour').value = Out[0];
  document.getElementById('Start_Second').value = Out[2];
  document.getElementById('End_hour').value = Out[1];
  document.getElementById('End_Second').value = Out[3];
  document.getElementById('Update_id').value = event.id;


  if (event.backgroundColor == 'red') {
    document.getElementById('Overtime').checked = true;
  }
  document.getElementById('myTextarea').value = event.description;

  document.getElementById('Send_btn').style.display = "none";
  document.getElementById('Update_btn').style.display = "block";
}
function Disable_Button() {
  document.getElementById('Send_btn').style.display = "block";
  document.getElementById('Update_btn').style.display = "none";
}

function Edit() {
  Destory(document.getElementById('Update_id').value);
  var Project_Name = document.getElementById('Project_Name').value;
  var Project_item = document.getElementById('Project_item').value;
  var serial_number = document.getElementById('serial_number').value;
  var Start = Get_Current_Day() + "T" + document.getElementById('Start_hour').value + ":" + document.getElementById('Start_Second').value;
  var End = Get_Current_Day() + "T" + document.getElementById('End_hour').value + ":" + document.getElementById('End_Second').value;
  var Overtime = document.getElementById('Overtime').checked;
  var myTextarea = document.getElementById('myTextarea').value;
  var Resolution = (document.getElementById('End_hour').value * 60 + document.getElementById('End_Second').value) - (document.getElementById('Start_hour').value * 60 + document.getElementById('Start_Second').value);
  console.log(myTextarea);
  if (Overtime == true) {
    var color = 'Red';
  }
  else {
    var color = 'gray';
  }
  if (Resolution > 0) {
    var myEvent = {
      title: Project_Name + ":" + Project_item,
      start: Start,
      end: End,
      id: serial_number,
      overlap: false,
      description: myTextarea,
      backgroundColor: color,
      className: serial_number
    };
    $('#calendar').fullCalendar('renderEvent', myEvent);

    document.getElementById('serial_number').value = document.getElementById('serial_number').value + 1;
  }
  else
    alert("結束時間必須大於開始時間");

}

function Edit() {
  Destory(document.getElementById('Update_id').value);
  var Machine = document.getElementById('Machine').value;
  var Project_Name = document.getElementById('Project_Name').value;
  var Project_item = document.getElementById('Project_item').value;
  var serial_number = document.getElementById('serial_number').value;
  var moment = $('#calendar').fullCalendar('getDate');//time
  var Day = moment.format('YYYY-MM-DD');//time
  var Start = Day + "T" + document.getElementById('Start_hour').value + ":" + document.getElementById('Start_Second').value;
  var End = Day + "T" + document.getElementById('End_hour').value + ":" + document.getElementById('End_Second').value;
  var Overtime = document.getElementById('Overtime').checked;
  var myTextarea = document.getElementById('myTextarea').value;
  var Resolution = (document.getElementById('End_hour').value * 60 + document.getElementById('End_Second').value) - (document.getElementById('Start_hour').value * 60 + document.getElementById('Start_Second').value);
  var duty = document.getElementById('duty').value;
  var Child_item = document.getElementById('Child_item').value;
  if (Overtime == true) {
    var color = 'Red';
  }
  else {
    var color = 'gray';
  }
  if (Resolution > 0) {
    var myEvent = {
      title: Machine + ":" + Project_Name + ":" + Project_item + ":" + Child_item,
      start: Start,
      end: End,
      id: serial_number,
      overlap: false,
      description: myTextarea,
      backgroundColor: color,
      className: serial_number
    };
    $('#calendar').fullCalendar('renderEvent', myEvent);

    document.getElementById('serial_number').value = document.getElementById('serial_number').value + 1;
  }
  else
    alert("結束時間必須大於開始時間");

}

function Count_time(Data) {
  var Out = 0;
  for (var i = 0; i < Data.length; i++) {
    var d1 = new Date(Data[i][1]);
    var d2 = new Date(Data[i][2]);
    var n1 = d1.getHours() - 8;
    var n2 = d2.getHours() - 8;
    var n1_minu = d1.getMinutes();
    var n2_minu = d2.getMinutes();
    if (n1 < 0) {
      n1 = 24 + n1;
    }
    if (n2 < 0) {
      n2 = 24 + n2;
    }

    if (Data[i][3] != 'Red') {
      Out = Out + (n2 - n1);
    }
  }
  return Out;
}

function Get_Day_Off() {
  var moment = $('#calendar').fullCalendar('getDate');
  var Day = moment.format('YYYY-MM-DD');
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('duty').value = message;
    }
  };
  url = "../index.php/Maintain_C/Get_Day_Off";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Day);
}

function Get_Dept() {
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      var Dept = document.getElementById('Dept_area');
      for (var i = 0; i < Data.length; i++) {
        Dept.options[i] = new Option(Data[i][1], Data[i][0]);
      }
      Dept.setAttribute('onchange', 'Get_Member()');
      Get_Member();

    }
  };
  url = "../index.php/Project_C/Get_Dept";
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}

function Get_Member() {
  var Dept = document.getElementById('Dept_area').value;
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;

      document.getElementById('Member_Item').innerHTML = message;

      Reload('');
    }
  };
  url = "../index.php/Assist_C/Get_Member/";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Dept)
}

function Get_Information() {
  var id = document.getElementById('member').value;
  var moment = $('#calendar').fullCalendar('getDate');//time
  var Day = moment.format('YYYY-MM-DD');//time
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var target = document.getElementById('Statement');
      if (message == 'Apply') {
        target.setAttribute('class', 'glyphicons-icon circle_ok');
        target.title = "審核完成";
      }
      else if (message == 'Back') {
        target.setAttribute('class', 'glyphicons-icon new_window');
        target.title = "退件";
      }
      else if (message == 'Hold') {
        target.setAttribute('class', 'glyphicons-icon stopwatch')
        target.title = "待審核中";
      }
      else {
        target.setAttribute('class', 'glyphicons-icon circle_exclamation_mark');
        target.title = "未送審核";
      }
    }
  };
  url = "../index.php/Maintain_C/Get_Information/" + id + "/" + Day;

  xmlhttp.open("post", url, true);
  xmlhttp.send();

}

function Get_Machine() {
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      var Machine_Name = document.getElementById('Machine');
      Machine_Name.setAttribute("onchange", "Get_Project_Name();");
      if (Data.length == 0) {
        for (var i = Machine_Name.options.length; i-- > 0;)
          Machine_Name.options[i] = null;

      }
      for (var i = 0; i < Data.length; i++) {
        Machine_Name.options[i] = new Option(Data[i], Data[i]);
      }
      Get_Project_Name();
    }

  };
  url = "../index.php/Project_C/Get_Machine";
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}





