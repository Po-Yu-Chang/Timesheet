
window.onload = Idle();
//google.charts.load('current', {'packages':['corechart']});
function Idle() {
  Get_area_member();
  Get_Machine_Data();
}
function Search_Project() {
  document.getElementById('ambit').innerHTML = "";
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      //document.getElementById('Display_Project_Name').innerHTML=message;
      Get_Base_Data();//取得基本資料
      Get_Sum_Data();
      Get_tab_area();
    }
  };
  url = "../index.php/Analysis_C/Search_Project";
  xmlhttp.open("post", url, true);
  xmlhttp.send();


}

function Fill_Project_Table(Data) {
  var Data = JSON.parse(Data);
  var html = "";
  for (var i = 0; i < Data.length; i++) {
    html += "<tr><td>" + Data[i][0] + "</td>";
    html += "<td>" + Data[i][1] + "</td>";
    html += "<td>" + Data[i][2] + "</td>";
    html += "<td>" + Data[i][3] + "</td>";
    html += "<td>" + Data[i][4] + "</td></tr>";
  }
  document.getElementById('Project_table_area').innerHTML = html;
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

function openarea_sub(evt, cityName) // tab display or not
{
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent_sub");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}




function Fill_Project_Dept_Table(Data) {
  var Data = JSON.parse(Data);
  var html = "";
  for (var i = 0; i < Data.length; i++) {
    html += "<tr><td>" + Data[i][0] + "</td>";
    html += "<td>" + Data[i][1] + "</td>";
    html += "<td>" + Data[i][2] + "</td>";
    html += "<td>" + Data[i][3] + "</td>";
    html += "<td>" + Data[i][4] + "</td>";
    html += "<td>" + Data[i][5] + "</td>";
    html += "<td>" + Data[i][6] + "</td></tr>";
  }
  document.getElementById('Dept_area').innerHTML = html;
}


function Change_Dept() {
  var Dept = document.getElementById('Get_Dept').value;
  Get_Project_name_Dept(Dept);
}

function Get_Dept_Member() {
  var id = document.getElementById('id').value;
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('Dept_Member').innerHTML = message;
    }
  };
  url = "../index.php/Management_C/Get_Dept_Member/" + id;
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}

function Get_Base_Data() {
  var Machine = document.getElementById('Machine').value;
  var Project_Name = document.getElementById('Project_name').value;
  var Data = [Machine, Project_Name];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);

      document.getElementById('Base_Name').innerHTML = Data[0];
      document.getElementById('Base_Number').innerHTML = Data[1];
      document.getElementById('Base_Machine').innerHTML = Data[2];

    }
  };
  url = "../index.php/Analysis_C/Get_Base_Data";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));

}

function Get_Sum_Data() {
  var id = document.getElementById('id').value;
  var Project_Name = document.getElementById('Project_name').value;
  var Data = [id, Project_Name];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('Sum_Area').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Get_Sum_Data";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Data);
}

function Get_tab_area() {
  var id = document.getElementById('id').value;
  var Project_Name = document.getElementById('Project_name').value;
  var Machine = document.getElementById('Machine').value;
  var Data = [id, Project_Name, Machine];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('tab_area').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Get_tab_area";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Data)
}

function Display(Dept) {
  Get_Child_Item(Dept);
  Get_Member(Dept);
  document.getElementById('Display_btn').innerHTML = "<button onclick='Search(" + Dept + ")'>搜尋</button>";
}

function Get_Child_Item(Dept) {
  var Project_Name = document.getElementById('Project_name').value;
  var Data = [Dept, Project_Name];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('Child_Item').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Get_Child_Item";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Data);
}

function Get_Member(Dept) {
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('Member_Item').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Get_Member";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Dept);
}

function Change_Project_Name() {
  Get_Base_Data();
  Get_Sum_Data();
  Get_tab_area();

}

function Search(Dept) {
  var Machine = document.getElementById('Machine').value;
  var project_item = document.getElementById('project_name').value;
  var id = document.getElementById('member').value;
  document.getElementById('ambit').innerHTML = "";
  if (Dept.toString().length == 3) {
    Dept = "0" + Dept.toString();
  }

  var Data = [project_item, id, Dept, Machine];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('ambit').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Search";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));
}

function Get_area_member() {
  var id = document.getElementById('id').value;
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('area_member').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Get_area_member/" + id;
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}

// 人員追蹤 [Search]
function Search_Member_performance() {
  var start = document.getElementById('Start_date').value;
  var end = document.getElementById('End_date').value;
  var member = document.getElementById('member2').value;
  var Data = [start, end, member];

  //取得總時數
  Search_four_Item_member(Data);

  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      //console.log(message);
      var Data = JSON.parse(message);


      Fill_Table(Data);
      DrawChart(Data);
      //DrawChart_O(Data);

    }
  };
  url = "../index.php/Analysis_C/Search_Member_performance";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));
}
// 總時數
function Search_four_Item_member(Data) {
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      Fill_Data_For_Item(Data, 'area3');  //填入表格
      DrawChart_four(Data, 'four_chart'); //畫總時數
      DrawChart_O(Data, 'overtimechart'); //畫加班時數
    }
  };
  url = "../index.php/Analysis_C/Search_four_Item_member";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));
}
function Search_Dept_Data() {
  var start = document.getElementById('Start_date_D').value;
  var end = document.getElementById('End_date_D').value;
  var Data = [start, end];
  Get_Detail_Data(0, 4);
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      Fill_Data_For_Item(Data, 'area4');
      DrawChart_four(Data, 'Dept_chart');
    }
  };
  url = "../index.php/Analysis_C/Search_Dept_Data";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));
}

function Get_Detail_Data(i, max) {
  var area = ['develope', 'maintain_code', 'change_Spec', 'else', 'routine', 'mis'];
  var start = document.getElementById('Start_date_D').value;
  var end = document.getElementById('End_date_D').value;


  var xmlhttp = new XMLHttpRequest();//傳送資料
  var Data = [area[i], start, end];
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var area = ['develope', 'maintain_code', 'change_Spec', 'else', 'routine', 'mis'];
      var chart = ['develope_chart', 'maintain_chart', 'Spec_chart', 'el_chart', 'routine_chart', 'mis_chart'];
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      Fill_Detail_Data(Data, Data[0][0]);//填入資料
      var i = area.indexOf(Data[0][0]);
      Draw_Detail_Chart(Data, chart[i]);//畫圖
      if (i < area.length) {
        Get_Detail_Data(i + 1, max);
      }
      //console.log(i,max);
    }
  };
  url = "../index.php/Analysis_C/Get_Detail_Data";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));

}

function Fill_Detail_Data(Data, area) {
  var html = "";
  var Normal = 0;
  var Overtime = 0;
  var total = 0;
  for (var i = 0; i < Data.length; i++) {
    html += "<tr><td>" + Data[i][1] + "</td>";
    html += "<td>" + Data[i][2] + "</td>";
    html += "<td>" + Data[i][3] + "</td>";
    html += "<td>" + Data[i][4] + "</td>";
    html += "<td>" + Data[i][5] + "</td>";
    total += parseFloat(Data[i][3]);
    Normal += parseFloat(Data[i][4]);
    Overtime += parseFloat(Data[i][5]);
  }

  html += "<tr><td>Total</td>";
  html += "<td></td>";
  html += "<td>" + total + "</td>";
  html += "<td>" + Normal + "</td>";
  html += "<td>" + Overtime + "</td>";

  document.getElementById(area).innerHTML = html;
}

function Fill_Data_For_Item(Data, area) {
  var html = "";
  var Normal = 0;
  var Overtime = 0;
  var total = 0;
  for (var i = 0; i < Data.length; i++) {
    html += "<tr><td>" + Data[i][0] + "</td>";
    html += "<td>" + Data[i][1] + "</td>";
    html += "<td>" + Data[i][2] + "</td>";
    html += "<td>" + Data[i][3] + "</td>";
    total += parseFloat(Data[i][1]);
    Normal += parseFloat(Data[i][2]);
    Overtime += parseFloat(Data[i][3]);
  }

  html += "<tr><td>Total</td>";
  html += "<td>" + total + "</td>";
  html += "<td>" + Normal + "</td>";
  html += "<td>" + Overtime + "</td>";
  document.getElementById(area).innerHTML = html;
}

function Fill_Table(Data) {
  if (Data.length < 1) { Data[0] = ["無", "無", 0, 0] }
  var html = "";
  var Normal = 0;
  var Overtime = 0;
  for (var i = 0; i < Data.length; i++) {
    html += "<tr><td>" + Data[i][0] + "</td>";
    html += "<td>" + Data[i][1] + "</td>";
    html += "<td>" + Data[i][2] + "</td>";
    html += "<td>" + Data[i][3] + "</td>";
    Normal += parseFloat(Data[i][2]);
    Overtime += parseFloat(Data[i][3]);
  }

  html += "<tr><td>Total</td>";
  html += "<td></td>";
  html += "<td>" + Normal + "</td>";
  html += "<td>" + Overtime + "</td>";
  document.getElementById('area2').innerHTML = html;
}

// 部門資料查詢 圓餅圖
function Draw_Detail_Chart(Data, area) {
  var total = 0, number = 0;
  var color_arr = [], Out = [];
  Out[0] = ['Task', 'Hours per Day'];

  var Machine = '';
  var m_arr = [], n_arr = [];

  Machine = Data[0][1];
  m_arr[0] = Data[0][1];
  n_arr[0] = 0;

  for (var i = 0; i < Data.length; i++) {

    if (Machine == Data[i][1]) {

      index = m_arr.indexOf(Machine)
      n_arr[index] = parseFloat(n_arr[index]) + parseFloat(Data[i][3]);

    } else if (Machine != Data[i][1]) {

      Machine = Data[i][1];
      m_arr[i] = Data[i][1];
      index = m_arr.indexOf(Machine)
      n_arr[index] = parseFloat(Data[i][3]);

    }
  }

  //application
  for (var j = 0; j < n_arr.length; j++) {
    if (parseFloat(n_arr[j]) > 0) {
      total += parseFloat(n_arr[j]);
    }
  }

  for (var i = 0; i < n_arr.length; i++) {
    var num = new Number((parseFloat(n_arr[i]) / total) * 100);
    number = num.toFixed(1);
    Out[i + 1] = [m_arr[i] + ": " + number + "% (" + n_arr[i] + "小時)", n_arr[i]];

    switch (m_arr[i]) {
      case '例行性事務':
        color_arr.push({ color: '#e4e7e6' });
        break;
      case '研磨機':
        color_arr.push({ color: '#e57f7f' });
        break;
      case '大刃面檢查機':
        color_arr.push({ color: '#f1995b' });
        break;
      case '小刃面檢查機':
        color_arr.push({ color: '#eede0e' });
        break;
      case '桌上刃面檢查機':
        color_arr.push({ color: '#42b97c' });
        break;
      case '補環刃檢機':
        color_arr.push({ color: '#b1c7ee' });
        break;
      case '盲孔機':
        color_arr.push({ color: '#6495ed' });
        break;
      case '大铣刀檢查機':
        color_arr.push({ color: '#bbb1f6' });
        break;
      case '段差研磨機':
        color_arr.push({ color: '#6CDBEE' });
        break;
      case '配針設備':
        color_arr.push({ color: '#f4a2e8' });
        break;
      case 'MIS事務':
        color_arr.push({ color: '#46a582' });
        break;
      case '其他':
        color_arr.push({ color: '#d11919' });
        break;
      case '新人學習':
        color_arr.push({ color: '#717080' });
        break;
      case '工業4.0相關':
        color_arr.push({ color: '#7E6BAD' });
        break;
      case '清洗機':
        color_arr.push({ color: '#ab968e' });
        break;
      case '維修APP':
        color_arr.push({ color: '#aadade' });
        break;
      case '客服APP':
        color_arr.push({ color: '#c4ffc1' });
        break;
      case '高速研磨機':
        color_arr.push({ color: '#ff82ab' });
        break;
      case '防火牆導入':
        color_arr.push({ color: '#ffc0cb' });
        break;
      default:
        color_arr.push({ color: '#e4e7e6' });
        break;
    }

  }
  //application
  /*
    for (var j = 0; j < Data.length; j++) {
      total += parseFloat(Data[j][3]);
    }
  
    for (var i = 0; i < Data.length; i++) {
      var num = new Number((parseFloat(Data[i][3]) / total) * 100);
      number = num.toFixed(1);
      Out[i + 1] = [Data[i][1] + number + "% (" + Data[i][3] + "小時)", parseFloat(Data[i][3])];
  
      switch (Data[i][1]) {
        case '例行性事務':
          color_arr.push({ color: '#e4e7e6' });
          break;
        case '研磨機':
          color_arr.push({ color: '#e57f7f' });
          break;
        case '大刃面檢查機':
          color_arr.push({ color: '#f1995b' });
          break;
        case '小刃面檢查機':
          color_arr.push({ color: '#eede0e' });
          break;
        case '桌上刃面檢查機':
          color_arr.push({ color: '#42b97c' });
          break;
        case '補環刃檢機':
          color_arr.push({ color: '#b1c7ee' });
          break;
        case '盲孔機':
          color_arr.push({ color: '#6495ed' });
          break;
        case '大铣刀檢查機':
          color_arr.push({ color: '#bbb1f6' });
          break;
        case '段差研磨機':
          color_arr.push({ color: '#6CDBEE' });
          break;
        case '配針設備':
          color_arr.push({ color: '#f4a2e8' });
          break;
        case 'MIS事務':
          color_arr.push({ color: '#46a582' });
          break;
        case '其他':
          color_arr.push({ color: '#d11919' });
          break;
        default:
          color_arr.push({ color: '#e4e7e6' });
          break;
      }
  
    }
  */
  var data = google.visualization.arrayToDataTable(Out);
  var options = {
    title: 'Performance',
    chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
    is3D: true,
    slices: color_arr //一組圖內，每個資料的個別顏色
    ,
    legend: {
      textStyle: {
        fontName: "Microsoft JhengHei",
        fontSize: 20
      }
    }

  };
  var chart = new google.visualization.PieChart(document.getElementById(area));
  chart.draw(data, options);
}

//四大項目圖 (總時數)
function DrawChart_four(Data, area) {
  var total = 0, number = 0;
  var Out = [];
  Out[0] = ['Task', 'Hours per Day'];
  for (var j = 0; j < Data.length; j++) {
    total += parseFloat(Data[j][1]);
  }

  for (var i = 0; i < Data.length; i++) {
    var num = new Number((parseFloat(Data[i][1]) / total) * 100);
    number = num.toFixed(1);

    Out[i + 1] = [Data[i][0] + ":" + number + "% (" + parseFloat(Data[i][1]) + "小時)", parseFloat(Data[i][1])];
  }
  var data = google.visualization.arrayToDataTable(Out);

  var options = {
    chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
    is3D: true,
    slices: {  //一組圖內，每個資料的個別顏色
      0: { color: '#33A1EE' },
      1: { color: '#2AC075' },
      2: { color: '#FFAA00' },
      3: { color: '#c1d2d2' },
      4: { color: '#c481fb' },
      5: { color: '#a1ee33' },
      6: { color: '#717080' },
      7: { color: '#F06261' }
    },
    legend: {
      textStyle: {
        fontName: "Microsoft JhengHei",
        fontSize: 20
      }
    }
  };
  var chart = new google.visualization.PieChart(document.getElementById(area));
  chart.draw(data, options);
}

//其他細部資料
function DrawChart(Data) {

  var Out = [];
  Out[0] = ['Task', 'Hours per Day'];
  console.log(Data);

  for (var i = 0; i < Data.length; i++) {
    Out[i + 1] = [Data[i][0] + ":" + Data[i][1] + " (" + (parseFloat(Data[i][2]) + parseFloat(Data[i][3])) + "小時)", (Data[i][2] * 1) + (Data[i][3] * 1)];
  }
  var data = google.visualization.arrayToDataTable(Out);

  var options = {
    title: 'Performance',
    chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
    is3D: true,
    slices: {  //一組圖內，每個資料的個別顏色
      0: { color: '#F06261' },
      1: { color: '#f68a8e' }
    },
    legend: {
      textStyle: {
        fontName: "Microsoft JhengHei",
        fontSize: 20
      }
    }

  };

  var chart = new google.visualization.PieChart(document.getElementById('chart'));

  chart.draw(data, options);
}
//加班時數
function DrawChart_O(Data, area) {
  /*
    var Out = [];
    Out[0] = ['Task', 'Hours per Day'];
    for (var i = 0; i < Data.length; i++) {
      Out[i + 1] = ["(加班)" + Data[i][0] + ":" + Data[i][1], Data[i][3] * 1];
    }
    var data = google.visualization.arrayToDataTable(Out);
  
    var options = {
      title: 'Overtime',
      chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
      is3D: true
  
    };
  
    var chart = new google.visualization.PieChart(document.getElementById('overtimechart'));
  
    chart.draw(data, options);
  */
  var total = 0, number = 0;
  var Out = [];
  Out[0] = ['Task', 'Hours per Day'];
  for (var j = 0; j < Data.length; j++) {
    total += parseFloat(Data[j][3]);
    console.log(j);
  }

  for (var i = 0; i < Data.length; i++) {
    var num = new Number((parseFloat(Data[i][3]) / total) * 100);
    number = num.toFixed(1);
    Out[i + 1] = ["(加班) " + Data[i][0] + ":" + number + "% (" + parseFloat(Data[i][3]) + "小時)", parseFloat(Data[i][3])];
  }
  var data = google.visualization.arrayToDataTable(Out);
  console.log(total);
  console.log(Data);

  var options = {
    title: '圓餅圖',
    chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
    is3D: true,
    slices: {  //一組圖內，每個資料的個別顏色
      0: { color: '#33A1EE' },
      1: { color: '#2AC075' },
      2: { color: '#FFAA00' },
      3: { color: '#c1d2d2' },
      4: { color: '#c481fb' },
      5: { color: '#a1ee33' },
      6: { color: '#717080' },
      7: { color: '#F06261' }
    },
    legend: {
      textStyle: {
        fontName: "Microsoft JhengHei",
        fontSize: 20
      }
    }
  };
  var chart = new google.visualization.PieChart(document.getElementById(area));
  chart.draw(data, options);

}


function Get_Machine_Data() {
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      var Machine_area = document.getElementById('Machine_area');
      var Machine = document.getElementById("Machine");
      Machine.setAttribute("onchange", "Machine_Change();");
      Machine_area.setAttribute("onchange", "Get_Machine_Number()");
      for (var i = Machine_area.options.length; i-- > 0;) {
        Machine_area.options[i] = null;
        Machine.options[i] = null;
      }

      for (var i = 0; i < Data.length; i++) {
        Machine_area.options[i] = new Option(Data[i], Data[i]);
        Machine.options[i] = new Option(Data[i], Data[i]);
      }

    }
  };
  url = "../index.php/Analysis_C/Get_Machine_Data";
  xmlhttp.open("post", url, true);
  xmlhttp.send();
}

function Get_Machine_Number() {
  var Machine = document.getElementById('Machine_area').value;
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      var Data = JSON.parse(message);
      var Machine_Number = document.getElementById('Machine_Number');
      for (var i = Machine_Number.options.length; i-- > 0;) {
        Machine_Number.options[i] = null;
      }

      for (var i = 0; i < Data.length; i++) {
        Machine_Number.options[i] = new Option(Data[i], Data[i]);
      }


    }
  };
  url = "../index.php/Analysis_C/Get_Machine_Number";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Machine);
}

function Search_Machine_Data() {
  var Machine = document.getElementById('Machine_area').value;
  var Machine_Number = document.getElementById('Machine_Number').value;
  var Client = document.getElementById('Machine_Client').value;
  var Data = [Machine, Machine_Number, Client];
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      //alert(message);
      var Data = JSON.parse(message);
      Fill_Machine_Table(Data);
      Draw_Machine_Chart_R(Data);
      Draw_Machine_Chart_O(Data);
    }
  };
  url = "../index.php/Analysis_C/Search_Machine_Data";
  xmlhttp.open("post", url, true);
  xmlhttp.send(JSON.stringify(Data));

}

function Fill_Machine_Table(Data) {
  var html = "";
  var Normal = 0;
  var Overtime = 0;
  for (var i = 0; i < Data.length; i++) {
    html += "<tr><td>" + Data[i][0] + "</td>";
    html += "<td>" + Data[i][1] + "</td>";
    html += "<td>" + Data[i][2] + "</td></tr>";
    Normal = parseFloat(Data[i][1]) + Normal;
    Overtime = parseFloat(Data[i][2]) + Overtime;
  }
  html += "<tr><td>Total</td>";
  html += "<td>" + Normal + "</td>";
  html += "<td>" + Overtime + "</td></tr>";
  document.getElementById('Machine_table').innerHTML = html;
}

function Draw_Machine_Chart_R(Data) {

  var Out = [];
  Out[0] = ['Task', 'Hours per Day'];
  for (var i = 0; i < Data.length; i++) {
    Out[i + 1] = [Data[i][0], Data[i][1] * 1];
  }
  var data = google.visualization.arrayToDataTable(Out);

  var options = {
    title: 'Overtime',
    chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
    is3D: true

  };

  var chart = new google.visualization.PieChart(document.getElementById('Machine_chart_R'));

  chart.draw(data, options);
}

function Draw_Machine_Chart_O(Data) {

  var Out = [];
  Out[0] = ['Task', 'Hours per Day'];
  for (var i = 0; i < Data.length; i++) {
    Out[i + 1] = ["(加班)" + Data[i][0], Data[i][2] * 1];
  }
  var data = google.visualization.arrayToDataTable(Out);

  var options = {
    title: 'Overtime',
    chartArea: { left: 20, top: 0, width: '100%', height: '100%' },
    is3D: true

  };

  var chart = new google.visualization.PieChart(document.getElementById('Machine_chart_O'));

  chart.draw(data, options);
}

function Machine_Change() {

  Get_Project_Name_By_Machine();
}

function Get_Project_Name_By_Machine() {
  var Machine = document.getElementById('Machine').value;
  var xmlhttp = new XMLHttpRequest();//傳送資料
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var message = xmlhttp.responseText;
      document.getElementById('Display_Project_Name').innerHTML = message;
    }
  };
  url = "../index.php/Analysis_C/Get_Project_Name_By_Machine";
  xmlhttp.open("post", url, true);
  xmlhttp.send(Machine)
}