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
        <td height="34" colspan="2" align="left"><img src="images/forum02.gif" width="158" height="34" /></td>
      </tr>
      <tr>
        <td width="411" height="36" align="left" class="font_title2">&nbsp;標題：</td>
        <td width="144" align="right" class="underline2"><span class="font_black">&nbsp;</span></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0" class="board_add2">
      <form id="repost1" name="form1" method="get" action="forum_repost1.php">
      <tr>
        <td width="115" rowspan="2" align="center" valign="top"><br />
          <div id="board_pic"><img src="images/face/fface1.gif" width="80" height="80" /></div>
          <div id="board_namefont">&nbsp;</div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><br />
          <table width="430" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="11" valign="top" background="images/board02.gif"><img src="images/board01.gif" width="11" height="40" /></td>
            <td width="429" align="left" valign="top" class="board_line1">
            
            <div class="board_post"> <br />
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="45%" valign="middle" class="font_black">IP位置：</td>
                  <td width="55%" align="right" valign="middle">
                    <input type="hidden" name="forum_id" id="forum_id" />
                    <label>
                      <input type="image" name="imageField3" id="imageField3" src="images/icon_re.gif" />
                    </label>
                  </td>
                </tr>
              </table>
            </div>
             </td>
          </tr>
        </table></td>
      </tr>
      </form>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0" class="board_add2">
      <form id="repost2" name="form1" method="get" action="forum_repost2.php">
      <tr>
        <td width="115" rowspan="2" align="center" valign="top"><br />
          <div id="board_pic"><img src="images/face/fface1.gif" width="80" height="80" /></div>
          <div id="board_namefont">&nbsp;</div></td>
        <td width="260" align="left" class="font_black">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td width="180" height="20" align="right" class="font_black">發表時間：&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="430" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="11" valign="top" background="images/board02.gif"><img src="images/board01.gif" width="11" height="40" /></td>
            <td width="429" align="left" valign="top" class="board_line1"><div class="board_repost2"> <span class="font_black">引用 於  發表</span>
              <div class="board_repost3"></div>
            </div>
              <div class="board_post"> <br />
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%" valign="middle" class="font_black">IP位置：</td>
                    <td width="55%" align="right" valign="middle">
                      <input type="hidden" name="re_id" id="re_id" />
                      <label>
                        <input type="image" name="imageField3" id="imageField3" src="images/icon_re.gif" />
                    </label></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </table></td>
      </tr>
      </form>
    </table>
    <br />
    <div align="center"><input type="button" name="submit" value="回上一頁" onClick="window.history.back()";><input type="button" name="Submit2" value="回討論區主頁" onclick="window.location='forum.php'"></div>
    <br />
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>