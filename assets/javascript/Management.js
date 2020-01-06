window.onload = Idle();


function Idle() {

  Get_State();
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

function Send() {
  var Project_Name = document.getElementById('Project_Name').value;
  var Project_item = document.getElementById('Project_item').value;
  var serial_number = document.getElementById('serial_number').value;
  var Start = Get_Current_Day() + "T" + document.getElementById('Start_hour').value + ":" + document.getElementById('Start_Second').value;
  var End = Get_Current_Day() + "T" + document.getElementById('End_hour').value + ":" + document.getElementById('End_Second').value;
  var Overtime = document.getElementById('Overtime').checked;
  var myTextarea = document.getElementById('myTextarea').value;
  var Resolution = (document.getElementById('End_hour').value * 60 + document.getElementById('End_Second').value) - (document.getElementById('Start_hour').value * 60 + document.getElementById('Start_Second').value);
  var duty = document.getElementById('duty').value;
  if (document.getElementById('Start_hour').value == '12' || (document.getElementById('End_hour').value == '12' && document.getElementById('Start_Second').value == '30')) {
    alert('不能再此時段填寫工時');
  }
  else {
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

function Restore() {
  var id = document.getElementById('id').value;
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
  var id = document.getElementById('member').value;
  if (date.length == 0) {
    var moment = $('#calendar').fullCalendar('getDate');//time
    var date = moment.format('YYYY-MM-DD');//time
  }
  //var date=Get_Current_Day();     
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      Clear_All();
      Get_Information();
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

function Message_Reload(id, date) {
  document.getElementById('member').value = id;
  console.log(id);
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
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
        Get_Information();

      }

    }
  };

  url = "../index.php/Maintain_C/Reload/" + id + "/" + date;

  xmlhttp.open("post", url, true);
  xmlhttp.send();
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

function Edit_Fill(event) {
  var title = event.title.split(':');
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


  document.getElementById('Project_Name').value = title[0];
  document.getElementById('Project_item').value = title[1];
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

function Sumbit() {
  Restore();
  var id = document.getElementById('id').value;//id
  var moment = $('#calendar').fullCalendar('getDate');//time
  var Day = moment.format('YYYY-MM-DD');//time
  var array = $('#calendar').fullCalendar('clientEvents');//object
  var out = [id, Day];
  var Data = [];
  for (var i = 0; i < array.length; i++) {
    Data[i] = [array[i].title, array[i].start, array[i].end, array[i].backgroundColor, id, array[i].description];
  }
  if (Count_time(Data) != 8) {
    alert("請填滿8小時送審核");
  }
  else {
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var message = xmlhttp.responseText;
        //alert(message);                    
      }
    };
    url = "../index.php/Maintain_C/Sumbit";
    xmlhttp.open("post", url, true);
    xmlhttp.send(out);
  }
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

    if (Data[i][3] != 'red') {
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

  var id = document.getElementById('id').value;
  var dept_id = document.getElementById('dept_id').value;
  console.log(id);
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('member_area').innerHTML = message;
    }
  };
  url = "../index.php/Management_C/Get_Dept_Member/" + id + "/" + dept_id;
  xmlhttp.open("post", url, true);
  xmlhttp.send();

  //
  /*
    $.ajax({
      url: "../index.php/Management_C/Get_Dept_Member/",
      data: {
        "id": id,
        "dept_id": dept_id
      }
      ,
      type: "POST",
      dataType: 'text',
  
      success: function (message) {
        document.getElementById('member_area').innerHTML = message;
      },
      error: function (jqXHR, textStatus, errorThrown) {
  
      }
    });*/
}
function Change_Member_Data() {
  $('#calendar').fullCalendar('removeEvents');
  Reload('');
}

function Apply() {
  var id = document.getElementById('member').value;
  var moment = $('#calendar').fullCalendar('getDate');//time
  var Day = moment.format('YYYY-MM-DD');
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      Get_Information();
      Get_State();
      Reload(Day);
      alert(message);
    }
  };
  url = "../index.php/Management_C/Apply/" + Day + "/" + id;
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}

function Back() {
  var r = confirm("是否要退件?");
  if (r == true) {
    var id = document.getElementById('member').value;
    var reason = document.getElementById('myTextarea').value;
    var moment = $('#calendar').fullCalendar('getDate');//time
    var Day = moment.format('YYYY-MM-DD');
    var xmlhttp = new XMLHttpRequest();//傳送資料
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var message = xmlhttp.responseText;
        Get_Information();
        Get_State();
        Reload(Day);
        alert(message);
      }
    };
    url = "../index.php/Management_C/Back/" + Day + "/" + id;
    xmlhttp.open("post", url, true);
    xmlhttp.send(JSON.stringify(reason));
  }

}

function Clear_All() {
  var array = $('#calendar').fullCalendar('clientEvents');
  for (var i = 0; i < array.length; i++) {
    Destory(array[i].id);
  }
}

function Get_State() {
  var id = document.getElementById('id').value;
  var id = document.getElementById('dept_id').value;
  console.log(id);
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('Default_message').innerHTML = message;
    }
  };
  url = "../index.php/Management_C/Get_State/" + id;
  xmlhttp.open("post", url, true);
  xmlhttp.send();

}

function Go_to_Date(date) {
  $('#calendar').fullCalendar('gotoDate', date);
}

