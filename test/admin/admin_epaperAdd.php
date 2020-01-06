<?
//變數$paperContent儲存電子報預設顯示內容，請自行替換電子報內容，圖片請修改為絕對網址
$paperContent="
<table width='696' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><img src='../images/epaper_01.gif' width='696' height='106' /></td>
  </tr>
  <tr>
    <td align='center' bgcolor='#ECECEC'><table width='678' border='0' cellspacing='0' cellpadding='5'>
      <tr>
        <td align='left' valign='top' bgcolor='#FFFFFF'>
		哇，這是一份圖文並茂的精美電子報，請自行修改內容，透過CKEditor+CKFinder可以任意設定文字樣式、插入圖片、製作超連結，記得發信前要將圖片改為絕對網址喔。
        <br /><br /><a href='http://tw.yahoo.com'>前往Yahoo</a>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src='../images/epaper_02.gif' width='696' height='85' /></td>
  </tr>
</table>
              ";
?>
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
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div align="center">
    <form action="" method="post" enctype="multipart/form-data" name="form1">
    <table width="760" border="0" cellspacing="0" cellpadding="0" background="../images/back11_2.gif">
      <tr>
        <td width="25" align="left"><img src="../images/board09.gif" /></td>
        <td width="725" align="left" background="../images/board04.gif">&nbsp; <span class="font_black">新增電子報</span></td>
        <td width="10" align="right"><img src="../images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="760" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="74" height="20" align="left" class="board_add">標&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 題：</td>
        <td width="666" align="left" class="board_add"><label>
          <input name="epaper_title" type="text" id="epaper_title" size="40" />
        </label></td>
      </tr>
      <tr>
        <td height="20" align="left" class="board_add">新 增 日 期：</td>
        <td align="left" class="board_add"><label>
          <input name="epaper_date" type="text" id="epaper_date" value="<? echo date('Y-m-d')?>" />
          </label></td>
      </tr>
      <tr>
        <td colspan="2" align="left" class="board_add">電 子 報 內 容：<br />
          <br />
          <label>
            <textarea name="epaper_content" id="epaper_content" cols="80" rows="5" class="ckeditor">
            <? echo $paperContent;?>
            </textarea>
          </label>          <br /></td>
      </tr>
    </table>
    <label>
      <br />
      <input type="submit" name="button" id="button" value="新增電子報" />
    </label>
    <label>
      <input type="reset" name="button2" id="button2" value="重設" />
    </label>
    <input type="button" name="submit" value="回上一頁" onClick=window.history.back();><br />
    <br />
    </form>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>