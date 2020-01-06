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
  <div align="center">
  搜尋關鍵字：<span class="font_red"> &nbsp; &nbsp;</span>
  &nbsp;&nbsp;搜尋結果：相關商品共<span class="font_red"> &nbsp; &nbsp; &nbsp; &nbsp;</span>筆
  <br /><a href="search_advanced.php">前往進階搜尋</a>
  </div>
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
      <tr>
        <td width="25" align="left"><img src="images/board14.gif" /></td>
        <td width="93" align="center" valign="middle" background="images/board04.gif">商品圖</td>
        <td width="126" align="left" valign="middle" background="images/board04.gif">商品名稱</td>
        <td width="219" align="left" valign="middle" background="images/board04.gif">商品簡介</td>
        <td width="82" align="center" valign="middle" background="images/board04.gif">單價</td>
        <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="5">
      <tr class="font_black">
        <td width="14" align="center" class="board_add3">&nbsp;</td>
        <td width="84" align="center" class="board_add3"><a href="products_detial.php?p_id="><img src="images/shop/thum/" width="57" border="0" /></a></td>
        <td width="116" align="left" class="board_add3">&nbsp;</td>
        <td width="199" align="left" valign="middle" class="board_add3">&nbsp;</td>
        <td width="92" align="center" class="board_add3">&nbsp;</td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="bottom">&nbsp;</td>
        <td align="right" valign="bottom">&nbsp;</td>
      </tr>
    </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>