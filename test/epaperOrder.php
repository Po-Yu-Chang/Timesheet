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
    <br />
    <table width="328" border="0" align="center" cellpadding="0" cellspacing="0" background="images/memberPaperOrder.gif">
      <tr>
        <td width="22" height="55">&nbsp;</td>
        <td width="306">&nbsp;</td>
      </tr>
      <tr>
        <td height="93">&nbsp;</td>
        <td align="left" valign="top" class="font_black"><br />
          您輸入的Email已經完成訂閱電子報!<br /><br />
          <script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<input name="Submit" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="回首頁" />
</td>
      </tr>
    </table>
    <table width="328" border="0" align="center" cellpadding="0" cellspacing="0" background="images/memberPaperOrderN.gif">
      <tr>
        <td width="22" height="55">&nbsp;</td>
        <td width="306">&nbsp;</td>
      </tr>
      <tr>
        <td height="93">&nbsp;</td>
        <td align="left" valign="top" class="font_black"><br />
          您輸入的Email已存在資料庫中，請<br />
          登入會員，確認訂閱電子報選項。<br />
          <script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
          <input name="Submit2" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="回首頁" /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>