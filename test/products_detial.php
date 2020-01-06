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
<!--[if IE 6]><script src="ie6png.js" type="text/javascript"></script><![endif]-->
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3">
  <table width="555" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="23" valign="middle" class="underline3"><img src="images/icon_cube.gif" width="23" height="21" /></td>
      <td height="25" valign="middle" class="underline3"> &nbsp;<a href="index.php">首頁</a> &gt;  &gt; </td>
    </tr>
  </table>
  <table width="555" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="300" align="center" valign="top"><img src="images/shop/" width="300" /></td>
      <td width="255" align="center" valign="top"><p><span class='font_title3'>&nbsp;</span></p>
        <p>NT：</p>
        <p><a href="shopcart_add.php?p_name=&p_price=&p_pic="><img src="images/car_add.gif" width="75" height="16" border="0" /></a></p></td>
    </tr>
  </table>
  <table width="555" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top"><br />        <br /></td>
    </tr>
  </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>