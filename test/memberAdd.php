<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dreamweaver+PHP資料庫網站製作</title>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta name="description" content="Dreamweaver+PHP資料庫網站製作" />
<meta name="keywords" content="Dreamweaver+PHP資料庫網站製作" />
<meta name="author" content="joj設計、joj網頁設計、joj Design、joj Web Design、呂昶億、杜慎甄" />
<link href="web.css" rel="stylesheet" type="text/css" />
<script language=javascript src="address.js"></script><!--引入郵遞區號.js檔案-->
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3" align="center">
    <form id="memberadd" name="memberadd" method="post" action="">
      <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" bgcolor="#FF0000" class="font_white">帳號或電子郵件已經註冊過了!!</td>
        </tr>
      </table>
      <table width="540" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
        <tr>
          <td width="25" align="left"><img src="images/board03.gif" /></td>
          <td width="505" align="left" background="images/board04.gif">&nbsp; <span class="font_black">歡迎您填妥資料，加入成為網站會員~~</span></td>
          <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
        </tr>
      </table>
      <table width="540" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="82" height="30" align="right" class="board_add">姓名：</td>
          <td width="458" align="left" class="board_add"><label>
            <input type="text" name="uname" id="uname" />
          </label><span class="font_red">* </span></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">帳號：</td>
          <td align="left" class="board_add"><label>
            <input type="text" name="username" id="username" />
          </label><span class="font_red">* </span></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">密碼：</td>
          <td align="left" class="board_add"><label>
            <input name="password" type="password" id="password" size="15" />
          </label><span class="font_red">* </span></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">確認密碼：</td>
          <td align="left" class="board_add"><label>
            <input name="repassword" type="password" id="repassword" size="15" />
          </label><span class="font_red">* </span></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">E-mail：</td>
          <td align="left" class="board_add"><label>
            <input name="email" type="text" id="email" size="35" />
          </label><span class="font_red">*</span><br />
          <span class="font_black">請勿使用會檔信的yahoo、pchome信箱，以免收不到註冊信及訂閱之會員電子報。</span></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">性別：</td>
          <td align="left" class="board_add"><label>
            <input name="sex" type="radio" id="radio" value="man" checked="checked" />
          男
          <input type="radio" name="sex" id="radio2" value="woman" />
          女&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
          <label>
            <input name="orderPaper" type="checkbox" id="orderPaper" value="Y" checked="checked" />
         </label> 訂閱電子報
          </td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">生日：</td>
          <td align="left" class="board_add">
          <select name="year" id="year">
             <option>年</option>
               <script language="javascript" type="text/javascript">
                   var watch=new Date();
                   var thisYear=watch.getFullYear();
				   for(y=1900;y<=thisYear;y++){
                       document.write("<option value='"+y+"'>"+y+"</option>")
	                  }
	           </script>
          </select>
          
          <select name="month" id="month">
            <option>月</option>
               <script language="JavaScript" type="text/JavaScript">
                   for(m=01;m<=12;m++){
                       document.write("<option value='"+m+"'>"+m+"</option>")
	                  }
	           </script>
           </select>
 
           <select name="day" id="day">
            <option>日</option>
               <script language="JavaScript" type="text/JavaScript">
                   for(d=01;d<=31;d++){
                       document.write("<option value='"+d+"'>"+d+"</option>")
	                  }
	           </script>
          </select>
          </td>
        </td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">電話：</td>
          <td align="left" class="board_add"><label>
            <input type="text" name="phone" id="phone" />
          </label></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">郵遞區號：</td>
          <td align="left" class="board_add">
                          <select onChange="citychange(this.form)" name="Area">
                              <option value="基隆市">基隆市</option>
                              <option value="臺北市" selected="selected">臺北市</option>
                              <option value="新北市">新北市</option>
                              <option value="桃園縣">桃園縣</option>
                              <option value="新竹市">新竹市</option>
                              <option value="新竹縣">新竹縣</option>
                              <option value="苗栗縣">苗栗縣</option>
                              <option value="臺中市">臺中市</option>
                              <option value="彰化縣">彰化縣</option>
                              <option value="南投縣">南投縣</option>
                              <option value="雲林縣">雲林縣</option>
                              <option value="嘉義市">嘉義市</option>
                              <option value="嘉義縣">嘉義縣</option>
                              <option value="臺南市">臺南市</option>
                              <option value="高雄市">高雄市</option>
                              <option value="屏東縣">屏東縣</option>
                              <option value="臺東縣">臺東縣</option>
                              <option value="花蓮縣">花蓮縣</option>
                              <option value="宜蘭縣">宜蘭縣</option>
                              <option value="澎湖縣">澎湖縣</option>
                              <option value="金門縣">金門縣</option>
                              <option value="連江縣">連江縣</option>
                            </select>
                              <select onChange="areachange(this.form)" name="cityarea">
                                <option value="中正區" selected="selected">中正區</option>
                                <option value="大同區">大同區</option>
                                <option value="中山區">中山區</option>
                                <option value="松山區">松山區</option>
                                <option value="大安區">大安區</option>
                                <option value="萬華區">萬華區</option>
                                <option value="信義區">信義區</option>
                                <option value="士林區">士林區</option>
                                <option value="北投區">北投區</option>
                                <option value="內湖區">內湖區</option>
                                <option value="南港區">南港區</option>
                                <option value="文山區">文山區</option>
                              </select>
                           <input type="hidden" value="100" name="Mcode" />
                           <input name="cuszip" value="100" size="5" maxlength="5" readonly="readOnly" />
          </td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">完整地址：</td>
          <td align="left" class="board_add"><span class="bs">
            <input name="cusadr" type="text" id="cusadr" value="" size="60" />
          </span></td>
        </tr>
        <tr>
          <td height="30" align="right" class="board_add">驗證碼：</td>
          <td align="left" class="board_add">
          <label>
            <input name="captcha" type="text" id="captcha" size="10" />
          </label>
          &nbsp;
          <input type="hidden" name="recaptcha" id="recaptcha" /></td>
        </tr>
        <tr>
          <td height="40" colspan="2" align="center"><label>
            <input type="submit" name="button" id="button" value="送出資料" />
            <input type="reset" name="button2" id="button2" value="重設" />
            <input name="date" type="hidden" id="date" value="<? echo date("Y-m-d H:i:s");?>" />
          </label></td>
        </tr>
      </table>
    </form>
    <div align="center"><img src="images/memberAdderr.gif"></div>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>