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
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="../images/forum01.gif">
      <tr>
        <td height="34" colspan="2" align="left"><img src="../images/forum02.gif" width="158" height="34" /></td>
      </tr>
      <tr>
        <td width="411" height="36" align="left" class="font_title2">&nbsp;標題：</td>
        <td width="144" align="right" class="underline2"><span class="font_black">&nbsp;</span></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0" class="board_add2">
      <form id="repost1" name="repost1" method="post" action="">
        <tr>
          <td width="115" rowspan="2" align="center" valign="top"><br />
            <div id="board_pic"><img src="../images/face/fface1.gif" width="80" height="80" /></div>
            <div id="board_namefont">&nbsp;</div>
            [ <a href="admin_forumDel.php?delSure=1&forum_id=">刪除本資料</a> ] 
            </td>
        </tr>
        <tr>
          <td colspan="2" valign="top" align="left"><br />
            <img src="../images/icon_forum_top.gif" width="38" height="16" hspace="10" /><span class="font_black">文章設定置頂：
                        <label>
                          <input type="radio" name="forum_top" id="radio" value="Y" />
                        是
                        <input type="radio" name="forum_top" id="radio2" value="N" />
            否</label>
            </span>
            <table width="430" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="11" valign="top" background="../images/board02.gif"><img src="../images/board01.gif" width="11" height="40" /></td>
                <td width="429" align="left" valign="top" class="board_line1"><div class="board_post"><span class="font_black">標題：</span> 
                  <label>
                    <input name="forum_title" type="text" id="forum_title" size="45" />
                  </label>
                  <br />
                
                    <label>
                      <textarea name="forum_content" id="forum_content" cols="45" rows="5"></textarea>
                    </label>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="78%" valign="middle" class="font_black">IP位置：</td>
                      <td width="22%" align="right" valign="middle">&nbsp;</td>
                    </tr>
                  </table>
                </div>
                <div class="board_repost">
                <label>
                  <input type="submit" name="button" id="button" value="送出修改" />
                </label>
                <input type="hidden" name="forum_id" id="forum_id" />
                </div>
                </td>
              </tr>
            </table></td>
        </tr>
      </form>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0" class="board_add2">
      <form id="repost2" name="repost2" method="post" action="">
        <tr>
          <td width="115" rowspan="2" align="center" valign="top"><br />
            <div id="board_pic"><img src="../images/face/fface1.gif" width="80" height="80" /></div>
            <div id="board_namefont">&nbsp;</div>
            [ <a href="admin_forumDel2.php?delSure=1&forum_id=&re_id=">刪除本資料</a> ] 
            </td>
          <td width="260" align="left" class="font_black">&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td width="180" height="20" align="right" class="font_black">發表時間：&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><table width="430" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="11" valign="top" background="../images/board02.gif"><img src="../images/board01.gif" width="11" height="40" /></td>
              <td width="429" align="left" valign="top" class="board_line1"><div class="board_repost2"> <span class="font_black">引用 於  發表</span>
                <div class="board_repost3"></div>
              </div>
                <div class="board_post">
                <span class="font_black">標題：</span> 
                  <label>
                    <input name="re_title" type="text" id="re_title" size="45" />
                  </label>
                  <br />
                    <label>
                      <textarea name="re_content" id="re_content" cols="45" rows="5"></textarea>
                    </label>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="78%" valign="middle" class="font_black">IP位置：</td>
                      <td width="22%" align="right" valign="middle"></td>
                    </tr>
                  </table>
                </div>
                <div class="board_repost">
                <label>
                  <input type="submit" name="button" id="button" value="送出修改" />
                </label>
                <input type="hidden" name="re_id" id="re_id" />
                </div>
                </td>
            </tr>
          </table></td>
        </tr>
      </form>
    </table>
    <br />
    <div align="center"><input type="button" name="submit" value="回上一頁" onClick="window.history.back()";>
    <script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<input name="Submit" type="button" onclick="MM_goToURL('parent','admin_forum.php');return document.MM_returnValue" value="回討論區管理主頁面" />
    </div>
    <br />
  </div>
  <div id="admin_main3">
       <? include("right_zone.php");?>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>