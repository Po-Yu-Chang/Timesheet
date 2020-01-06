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
<script src="../ie6png.js" type="text/javascript"></script>
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
        <td width="25" align="left"><img src="../images/board11.gif" /></td>
        <td width="725" align="left" background="../images/board04.gif">&nbsp; <span class="font_black">編輯商品資料</span></td>
        <td width="10" align="right"><img src="../images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="760" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="80" height="20" align="left" class="board_add">商 品 名 稱：</td>
        <td width="669" align="left" class="board_add"><label>
          <input name="p_name" type="text" id="p_name" size="40" />
        </label></td>
      </tr>
      <tr>
        <td height="20" align="left" class="board_add">商 品 價 格：</td>
        <td align="left" class="board_add"><label>
          <input name="p_price" type="text" id="p_price" size="15" />
        </label></td>
      </tr>
      <tr>
        <td height="20" align="left" class="board_add">商 品 開 放：</td>
        <td align="left" class="board_add"><label>
          <input name="p_open" type="radio" id="radio" value="Y" />
        開放
        <input type="radio" name="p_open" id="radio2" value="N" />
        不開放</label></td>
      </tr>
      <tr>
        <td height="20" align="left" class="board_add">商 品 圖 片：</td>
        <td align="left" class="board_add"><span class="table_lineheight">
        <img src="../images/shop/thum/" alt="" name="pic" width="57" id="pic" /> 
        <input type="hidden" name="oldPic" id="oldPic" />
        <br />
        <label>
          <input type="file" name="p_pic" id="p_pic" />
        </label><br /><span class="font_red">**限制檔案格式為：JPG、GIF、PNG，檔案尺寸不能超過300KB</span></span></td>
      </tr>
      <tr>
        <td height="20" align="left" class="board_add">上 傳 日 期：</td>
        <td align="left" class="board_add"><label>
          <input name="p_date" type="text" id="p_date" />
        </label></td>
      </tr>
      <tr>
        <td colspan="2" align="left" class="board_add">商 品 介 紹：<br />
          <br />
          <label>
            <textarea name="p_content" id="p_content" cols="80" rows="5" class="ckeditor"></textarea>
          </label>          <br /></td>
      </tr>
    </table>
    <label>
      <br />
      <input type="submit" name="button" id="button" value="編輯商品" />
    </label>
    <label>
      <input type="reset" name="button2" id="button2" value="重設" />
    </label>
    <input type="button" name="submit" value="回上一頁" onClick=window.history.back();>
    <input type="hidden" name="p_id" id="p_id" />
    <input type="hidden" name="shop_id" id="shop_id" />
    <br />
    <br />
    </form>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>