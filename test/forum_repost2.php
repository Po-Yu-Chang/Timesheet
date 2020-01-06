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
  <form id="formPost" name="formPost" method="post" action="">
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/forum01.gif">
      <tr>
        <td height="34" colspan="4" align="left"><img src="images/forum04.gif" width="158" height="34" /></td>
        <td width="393" align="right" class="font_red">您的IP位置：<? echo $_SERVER["REMOTE_ADDR"];?> </td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2" class="board_add"><span class="font_black">原文作者：</span><br />          
          <label>
            <textarea name="re_quote" id="re_quote" cols="65" rows="5"></textarea>
          </label>
          <br />
          <span class="font_black">引用原文：</span><label>
  <input name="re_quoteY" type="checkbox" id="re_quoteY" value="Y" />
  <span class="font_black">**如果不需引用原文，不必勾選!!</span>
  <input type="hidden" name="re_quoteUser" id="re_quoteUser" />
  <input type="hidden" name="re_quoteDate" id="re_quoteDate" />
</label></td>
      </tr>
      <tr>
        <td width="82" height="30" class="board_add">回覆標題：</td>
        <td width="468" align="left" class="board_add"><label>
          <input name="re_title" type="text" id="re_title" value="Re:" size="60" />
          </label><span class="font_red">* </span></td>
      </tr>
      <tr>
        <td height="30" class="board_add">表&nbsp; 情：</td>
        <td align="left" class="board_add"><table width="480" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><div id="board_pic"><img src="images/face/fface1.gif" width="80" height="80" /></div></td>
            <td align="center"><div id="board_pic"><img src="images/face/fface2.gif" width="80" height="80" /></div></td>
            <td align="center"><div id="board_pic"><img src="images/face/fface3.gif" width="80" height="80" /></div></td>
            <td align="center"><div id="board_pic"><img src="images/face/fface4.gif" width="80" height="80" /></div></td>
          </tr>
          <tr>
            <td align="center"><label>
              <input name="re_img" type="radio" id="radio" value="fface1.gif" checked="checked" />
            </label></td>
            <td align="center"><label>
              <input type="radio" name="re_img" id="radio" value="fface2.gif" />
            </label></td>
            <td align="center"><label>
              <input type="radio" name="re_img" id="radio" value="fface3.gif" />
            </label></td>
            <td align="center"><label>
              <input type="radio" name="re_img" id="radio" value="fface4.gif" />
            </label></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" class="board_add"><label> 回覆內容：<span class="font_red">*</span><br />
            <textarea name="re_content" id="re_content" cols="65" rows="10"></textarea>
            <br />
            <br />
        </label></td>
      </tr>
      <tr>
        <td height="40" colspan="2" align="center"><label>
          <input type="submit" name="button2" id="button2" value="送出回覆文章" />
          <input type="button" name="submit" value="回上一頁" onClick="window.history.back()";>
          <input type="hidden" name="forum_id" id="forum_id" />
          <input name="re_date" type="hidden" id="re_date" value="<? echo time();?>" />
          <input name="re_username" type="hidden" id="re_username" value="<? echo $_SESSION["MM_Username"]?>" />
          <input name="re_ip" type="hidden" id="re_ip" value="<? echo $_SERVER["REMOTE_ADDR"];?>" />
        </label></td>
      </tr>
    </table>
    </form>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" class="font_red2">回覆文章前請先登入會員，謝謝。</td>
      </tr>
    </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>