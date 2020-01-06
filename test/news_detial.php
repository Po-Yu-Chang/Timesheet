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
  <div id="main3"><img src="images/adv2.gif" width="505" height="31" /><img src="images/adv4.gif" width="50" height="31" border="0" /><br />
    <div id="news_detial1">
      <table width="545" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
         <tr>
           <td width="35" height="28" align="left" valign="middle" class="font_newstitle1">
           <img src="images/icon_news.gif" />
           <img src="images/icon_action.gif" />
           </td>
           <td width="410" align="left" valign="middle" class="font_newstitle1" style="word-break:break-all;overflow:hidden;">&nbsp;</td>
           <td width="100" align="right" class="font_newstitle1">&nbsp;</td>
         </tr>
         <tr>
           <td height="25" colspan="3" align="right" valign="top"><table width="545" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="175" height="40" align="left" valign="middle">瀏覽次數：</td>
               <td width="370" align="right" valign="middle"></td>
             </tr>
           </table></td>
        </tr>
         <tr>
           <td colspan="3" align="left" valign="top"><p>&nbsp;</p>
           <p>&nbsp;</p>
           <table width="300" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td><img src="images/adminarrow.gif" alt="" width="10" height="10" /> 下載檔案：</td>
             </tr>
           </table>
           <p>&nbsp;</p>
           <p>
           <table width="545" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><img src="images/news01.gif" width="545" height="37" /></td>
    </tr>
  <tr>
    <td width="9" background="images/news02.gif">&nbsp;</td>
    <td width="527" align="center"><table width="96" border="0" cellspacing="1" cellpadding="8" bgcolor="#cdcdcd">
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><img src="" alt="" name="pic2" width="80" height="32" id="pic2" /></td>
      </tr>
    </table></td>
    <td width="9" background="images/news03.gif">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><img src="images/news04.gif" width="545" height="15" /></td>
    </tr>
</table>

           </p>
           <div align="center">
<input type="button" name="submit" value="回上一頁" onClick="window.history.back()";>
<input type="button" name="Submit" value="回首頁" onclick="window.location='index.php'">
</div>
           </td>
         </tr>
      </table>
    </div>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>