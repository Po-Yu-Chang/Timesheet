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
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/forum01.gif">
      <tr>
        <td height="34" colspan="4" align="left"><img src="images/forum02.gif" width="158" height="34" align="left" /><a href="forum_post.php"><img src="images/icon_addForum.gif" width="96" height="19" hspace="5" vspace="7" border="0" align="right" /></a></td>
      </tr>
      <tr>
        <td width="234" height="36" align="left" class="font_title2">&nbsp;討論文章標題</td>
        <td width="110" align="center" class="font_title2">發表者</td>
        <td width="92" align="center" class="font_title2">回覆/瀏覽</td>
        <td width="119" align="center" class="font_title2">最後發表</td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr class="board_add3">
        <td width="25" align="center" class="board_add3"><img src="images/face/1.gif" width="19" height="19" /></td>
        <td width="210" height="30" align="left" class="board_add3">
        <img src="images/icon_forum_top.gif" width="38" height="16" hspace="2" /> 
        <img src="images/icon_hot.gif" />
        <img src="images/icon_new2.gif" />
        </td>
        <td width="109" align="center" class="board_add3"><span class="font_mini"></span></td>
        <td width="92" align="center" class="board_add3">&nbsp;</td>
        <td width="119" align="center" class="board_add3"><span class="font_mini"></span></td>
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
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>