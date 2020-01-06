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
      <form id="form1" name="form1" method="post" action="">
        <p>&nbsp;</p>
        <p><span class="font_red2" >您確定要刪除 [] 資料的供下載檔案??</span></p>
        <p><br />
          檔案名稱：
        </p>
          <label>
            <br />
            <input type="submit" name="button" id="button" value="刪除檔案" /><input type="button" name="submit" value="回上一頁" onClick=window.history.back();>
          </label>
          <input type="hidden" name="news_id" id="news_id" />
          <input type="hidden" name="news_download" id="news_download" />
        </p>
        <input name="fileDel" type="hidden" id="fileDel" />
<p>&nbsp;</p>
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