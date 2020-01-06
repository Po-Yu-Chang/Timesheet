 <!DOCTYPE html>
<html lang="en">
<head>
  <title>基本資料</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/javascript/Base.js"></script>
  
  <script src="../../JSCal2-1.7/src/js/jscal2.js"></script>
  <script src="../../JSCal2-1.7/src/js/lang/en.js"></script>
  <link rel="stylesheet" type="text/css" href="../assets/JSCal2-1.7/src/css/jscal2.css" />
  <link rel="stylesheet" type="text/css" href="../assets/JSCal2-1.7/src/css/border-radius.css" />
  <link rel="stylesheet" type="text/css" href="../assets/JSCal2-1.7/src/css/steel/steel.css" />
 
</head>
<style>
body
{
  background-color:#F0F0F0;
}
table{
    border: 1px solid ;
    text-align: center;
    padding: 10px;
    font-family:"微軟正黑體";
     border: 1px solid black;


}
td
{
  border: 0px solid #fff;
  word-break:normal;
  font-size: 20px;
  font-family:"微軟正黑體";
}

th 
{
  text-align: center;
  border: 0px solid #fff;
  font-size: 20px;
  font-family:"微軟正黑體";
  background-color: #FFFFFF;
  width: 100px
}
option {
  font-size: 30px;
  font-family:"微軟正黑體";
  }
  input
  {
    width: 100px;
    font-size: 12px;
    text-align: center;
  }
.table {
  font-family: arial, sans-serif;
    border-collapse: collapse;
    width:100%;
}
.td_d,.th_d {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 5px;
}

.tr:nth-child(even) {
    background-color: #dddddd;

}
.Header
{
  color:black;
  font-size:20px;
  font-family:"微軟正黑體";
  background-color:#FFFFFF;


}

.area
  {
    width:500px;
    height:100px;
    resize:none;
    border:2px green solid;
  }
.option
{
  font-size: 20px;
}
ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {background-color: #ddd;}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {background-color: #ccc;}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.search_table
{
   border: 1px solid black;
}

.red
{
  color:red;
}
.input_type
{
   width: 150px;
}
@media only screen and (max-width: 500px) {
  
   .area
  {
    width:300px;
    height:100px;
    resize:none;
    border:2px green solid;
  }
  
}

</style>
<body onload="Idle()" >
<input type='hidden' id='sql' value="">
  <input type='hidden' id='Edit_index' value="">
<div>
  <table class='Header' style="width:100%">
    <tr>
      <td align="left" style="font-size:40px;font-weight: bold;">
        <a href="../index.php/User/main">
        <img src="../../images/Apply.png" class="img-responsive" style="width:100px;display: inline-block;height:100px;" >
        </a>
基本資料頁面</td>
      <td>
      
    </td>
      <td><div class="member_detail" style="float:right">

<?php
$username=$this->session->userdata('username');
$id=$this->session->userdata('id');
$leavel=$this->session->userdata('leavel');
if($leavel="admin")
{
  $power='最高權限';
}
elseif($leavel="Leader")
{
  $power='主管';
}
else
$power="一般員工";

$html=<<<end2_html
帳號:<input readonly type='text' id='id' value='$id' style="background-color:transparent;border:0px;width:100px;">
姓名:<input readonly type='text' id='username' value='$username' style="background-color:transparent;border:0px;width:100px;">
<input type="hidden" id="leavel" vlaue=$leavel>
    
end2_html;

echo $html;

?>
<button class="btn btn-info btn-lg" onclick="Logout();">Log out</button>
</div>
</td>

    </tr>
  </table>
</div>



<dialog id="New_Panel">
  <form method="dialog">
    <input type="hidden" id="Note_index">
    <table>
      <tr>
        <td>姓名:</td>
        <td><input type='text' id='name' class="input_type"></td>
      </tr>
      <tr>
        <td>帳號:</td>
        <td><input type='text' id='id_1' class="input_type"></td>
      </tr>
      <tr>
        <td>密碼:</td>
        <td><input type='text' id='password' class="input_type"></td>
      </tr>
      <tr>
        <td>等級:</td>
        <td>
          <Select id="leavel_1">
            <option value="admin">最高權限</option>
            <option value="Top">文員</option> 
            <option value="user">普通使用者</option>        
          </Select>
          </td>
      </tr>
      <tr>
        <td><button  class = "btn btn-warning" id="sumbit" onclick="Update();" >送出</button></td>
        <td> <button  class = "btn btn-danger" id="cancel" onclick="Close_New_Panel();">取消</button></td>
      </tr>
      </table>    
     
  </form>
</dialog>


<dialog id="Inser_Panel">
  <form method="dialog">
    <table>
      <tr>
        <td>姓名:</td>
        <td><input type='text' id='name_2' class="input_type"></td>
      </tr>
      <tr>
        <td>帳號:</td>
        <td><input type='text' id='id_2' class="input_type"></td>
      </tr>
      <tr>
        <td>密碼:</td>
        <td><input type='text' id='password_2' class="input_type"></td>
      </tr>
      <tr>
        <td>等級:</td>
        <td>
          <Select id="leavel_2">
            <option value="admin">最高權限</option>
            <option value="Top">文員</option> 
            <option value="user">普通使用者</option>        
          </Select>
          </td>
      </tr>
      <tr>
        <td><button  class = "btn btn-warning" id="sumbit" onclick="Insert();" >送出</button></td>
        <td> <button  class = "btn btn-danger" id="cancel" onclick="Close_New_Panel();">取消</button></td>
      </tr>
      </table>    
     
  </form>
</dialog>

<div>
<ul class="tab">  
  
  <li><a href="javascript:void(0)" class="tablinks" onclick="member();openarea(event, 'member')">人員基本資料</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Log_area')">Log</a></li>
  
 
</ul>
</div>

<div  id='member' class="tabcontent" ></div>
<div  id='Log_area' class="tabcontent" >
  <TABLE>
    <tr>
      <th>人員</th>
      <th>開始日期</th>
      <th>結束日期</th>
      <th>搜尋</th>
    </tr>
    <tr>
      <td>
      <input style="width:200px;" type="text" id="Log_id">
    </td>
       <td>
      <input style="width:200px;" type="date" id="Log_Start">
    </td>
    <td>
      <input style="width:200px;" type="date" id="Log_end">
    </td>
    <td>
      <button onclick="Search_Log();">搜尋</button>
    </td>
    </tr>
    
  </TABLE>
  <div id="Log_display"></div>

</div>


</html>

