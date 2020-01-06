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
        <td width="25" align="left"><img src="../images/board09.gif" /></td>
        <td width="90" align="left" valign="middle" background="../images/board04.gif">&nbsp; <span class="font_black">電子報管理區</span></td>
        <td width="160" align="left" valign="bottom" background="../images/board04.gif"><a href="admin_epaperAdd.php"><img src="../images/icon_add.gif" width="47" height="19" border="0" /></a>
          <a href="admin_epaperMember.php"><img src="../images/icon_mepaperOrder.gif" border="0"></a>
        </td>
        <td width="270" align="left" valign="middle" background="../images/board04.gif" class="font_black">總訂閱人數：</td>
        <td width="10" align="right"><img src="../images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr class="font_black">
        <td align="center" class="board_add3"><span class="font_black">編號</span></td>
        <td height="30" align="center" class="board_add3"><span class="font_black">發送狀態</span></td>
        <td align="left" class="board_add3"><span class="font_black">&nbsp; 電子報標題</span></td>
        <td width="270" align="center" class="board_add3"><span class="font_black">編輯</span></td>
      </tr>
      <tr>
        <td width="48" align="center" class="board_add3">&nbsp;</td>
        <td width="57" height="30" align="center" class="board_add3">
        <img src="../images/icon_epapery.gif" />
        <img src="../images/icon_epapern.gif" />
        </td>
        <td width="180" align="left" class="board_add3">&nbsp;</td>
        <td align="center" class="board_add3">[ <a href="admin_epaperView.php?epaper_id=">預覽</a> ] [ <a href="admin_epaperSend1.php?epaper_id=">指定寄發</a> ] [ <a href="admin_epaperSend2.php?epaper_id=">發行電子報</a> ]&nbsp;&nbsp;[ <a href="admin_epaperUpdate.php?epaper_id=">編輯</a> ] [ <a href="admin_epaperDel.php?epaper_id=&delSure=1">刪除</a> ]</td>
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