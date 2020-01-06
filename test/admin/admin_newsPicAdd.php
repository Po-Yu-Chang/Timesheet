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
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      您正在為 [<span class="font_red">  </span>] 資料，新增資料圖片<br />
      <br />
      <table width="370" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="70" height="35" align="left" valign="middle" class="board_add">&nbsp; 圖片標題：</td>
          <td width="300" align="left" class="board_add"><label>
            <input type="text" name="newspic_title" id="newspic_title" />
          </label></td>
        </tr>
        <tr>
          <td width="70" align="left" valign="top" class="board_add">&nbsp; 上傳圖片：</td>
          <td align="left" class="board_add">
        <label>
        <input type="file" name="newspic_pic" id="newspic_pic" />
        </label><span class="font_red"><br />
        **格式為.jpg、.gif、.png，檔案大小請勿超過300KB!!</span>
          </td>
        </tr>
      </table>
        <label>
          <br />
          <input type="submit" name="button" id="button" value="新增圖片" />
      </label>
      <input type="button" name="submit" value="回上一頁" onClick=window.history.back();>
      <input type="hidden" name="news_id" id="news_id" />
      </p>
    </form>
  </div>
  <div id="admin_main3">
       <? include("right_zone.php");?>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>