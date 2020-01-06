<? session_start();?>
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
        <script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3">
<br />
    <br />
    <br />
    <table width="364" border="0" align="center" cellpadding="0" cellspacing="0" background="images/memberSendPass2.gif">
      <tr>
        <td width="22" height="55">&nbsp;</td>
        <td width="306">&nbsp;</td>
      </tr>
      <tr>
        <td height="129">&nbsp;</td>
        <td align="left" valign="top" class="font_black">您的新密碼已經寄出到您的信箱，請收信<br />
        後使用新帳號、密碼登入網站，謝謝。<br />
        <br />
<input name="Submit" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="回首頁" />

        </td>
      </tr>
    </table>
    <br />
    <table width="364" border="0" align="center" cellpadding="0" cellspacing="0" background="images/memberSendPass3.gif">
      <tr>
        <td width="22" height="55">&nbsp;</td>
        <td width="306">&nbsp;</td>
      </tr>
      <tr>
        <td height="129">&nbsp;</td>
        <td align="left" valign="top" class="font_black">對不起!!資料庫中沒有您的會員E-mail，請<br />
        回上一頁重新輸入，或是加入會員。<br />
        <br />
<input type="button" name="submit" value="回上一頁" onClick=window.history.back();>
<input name="Submit" type="button" onclick="MM_goToURL('parent','memberAdd.php');return document.MM_returnValue" value="加入會員" />
<input name="Submit" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="回首頁" />

        </td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>