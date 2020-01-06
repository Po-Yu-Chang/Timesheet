<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理後台</title>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Language" content="zh-tw" />
<meta name="description" content="Dreamweaver+PHP資料庫網站製作" />
<meta name="keywords" content="Dreamweaver+PHP資料庫網站製作" />
<meta name="author" content="joj設計、joj網頁設計、joj Design、joj Web Design、呂昶億、杜慎甄" />
<link href="../web.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="admin_main2">
  <table width="555" border="0" cellspacing="0" cellpadding="0" background="../images/back11_2.gif">
  <tr>
    <td width="25" align="left"><img src="../images/board13.gif" /></td>
    <td width="78" align="left" valign="middle" background="../images/board04.gif">&nbsp; <span class="font_black">訂 單 管 理 區</span></td>
    <td width="442" align="left" valign="middle" background="../images/board04.gif">&nbsp;</td>
    <td width="10" align="right"><img src="../images/board05.gif" width="10" height="28" /></td>
  </tr>
</table>
  <table width="555" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="70" align="center" class="board_add3"><span class="font_black">訂單編號</span></td>
      <td width="245" height="30" align="left" class="board_add3"><span class="font_black">會員姓名(帳號)-訂購日期<span class="font_red">&nbsp;&nbsp;&nbsp;&nbsp;</span></span></td>
      <td width="70" align="center" class="board_add3"><span class="font_black">付款方式</span><span class="font_red">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
      <td width="70" align="center" class="board_add3"><span class="font_black">付款狀態</span><span class="font_red"></span></td>
      <td width="50" align="center" class="board_add3"><span class="font_black">檢視</span></td>
      <td width="50" align="center" class="board_add3">刪除</td>
    </tr>
    <tr>
      <td align="center" class="board_add3">&nbsp;</td>
      <td height="30" align="left" class="board_add3">()-</td>
      <td align="center" class="board_add3">&nbsp;</td>
      <td align="center" class="board_add3">&nbsp;</td>
      <td align="center" class="board_add3"><a href="admin_ordersDetial.php?order_id=&amp;order_sid=&amp;order_group=">檢視</a></td>
      <td align="center" class="board_add3"><a href="admin_ordersDel.php?order_id=&delSure=1">刪除</a></td>
    </tr>
  </table>
  <table width="555" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="bottom">&nbsp;</td>
      <td align="right" valign="bottom">&nbsp;</td>
    </tr>
  </table>
  <table width="555" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center" class="font_red2">目前資料庫中沒有任何資料!</td>
    </tr>
  </table>
  </div>
  <div id="admin_main3">
       <? include("right_zone.php");?>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>