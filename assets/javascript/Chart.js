window.onload = Idle();
//google.charts.load('current', {'packages':['corechart']});
function Idle() {
  Get_Member();
}

function openarea(evt, cityName) // tab display or not
{
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

//人員追蹤 → 部門成員 
function Get_Member() {
  $.ajax({
    url: '../?/Chart_C/Get_Member',
    type: 'POST',
    error: function (xhr) {
      alert(xhr + 'Ajax request 發生錯誤');
    },
    success: function (data) {

      var JData = JSON.parse(data);

      $.each(JData, function (i, val) {
        $('#area_member').append($('<option>', {
          value: val.id,
          text: val.name
        }));
      });

    }
  });
}

//人員追蹤 → 搜尋
function Search_Chart_By_member() {

  var Start_date_v = $("#Start_date").val()
  var End_date_v = $("#End_date").val()
  var member_id_v = $("#area_member").find(":selected").val()

  $.ajax({
    url: '../?/Chart_C/Search_Chart_By_member',
    data: {
      Start_date: Start_date_v,
      End_date: End_date_v,
      member_id: member_id_v
    },
    type: 'POST',

    error: function (xhr) {
      alert(xhr + 'Ajax request 發生錯誤');
    },
    success: function (data) {

      var JData = JSON.parse(data);

      // 印DIV
      var html = "";
      $.each(JData, function (i, val) {
        html += "<div id='" + val.div_area + "'>" + val.Title + "</div>";
      });
      $('#chart_div').html(html);


      // 準備資料畫圖
      $.each(JData, function (i, val) {

        Search_Chart_By_Project_Item(Start_date_v, End_date_v, member_id_v, val.Title, val.div_area);

      });

    }
  });



}


function Search_Chart_By_Project_Item(Start_date_v, End_date_v, member_id_v, myTitle, div_area) {

  $.ajax({
    url: '../?/Chart_C/Search_Chart_By_Project_Item',
    data: {
      Start_date: Start_date_v,
      End_date: End_date_v,
      member_id: member_id_v,
      Item: myTitle
    },
    type: 'POST',

    error: function (xhr) {
      alert(xhr + 'Ajax request 發生錯誤');
    },
    success: function (data) {

      var JData = JSON.parse(data);

      console.log(JData);
      DrawChart(JData, myTitle, div_area);

    }
  });

}

function DrawChart(myData, myTitle, div_area) {

  var data = new google.visualization.DataTable(myData);

  var options = {

    is3D: 'true',
    width: 900,
    height: 600,
    title: myTitle,
    titleTextStyle: {
      fontName: "Microsoft JhengHei",
      fontSize: 18,
      bold: true
    },
    legend: {
      textStyle: {
        fontName: "Microsoft JhengHei",
        fontSize: 14
      }
    }
  };

  var chart = new google.visualization.PieChart(document.getElementById(div_area));
  chart.draw(data, options);

}

