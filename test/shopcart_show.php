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
<!--[if IE 6]><script src="ie6png.js" type="text/javascript"></script><![endif]-->
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3">
    <form name="form1" method="shopcart" action="">
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
      <tr>
        <td width="25" align="left"><img src="images/board12.gif" /></td>
        <td width="104" align="left" valign="middle" background="images/board04.gif">&nbsp; <span class="font_black">訂購清單&nbsp; &nbsp;</span></td>
        <td width="416" align="left" valign="bottom" background="images/board04.gif">&nbsp;</td>
        <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="5">
      <tr class="font_black">
        <td width="100" align="center" class="board_add3"><span class="font_black">商品圖</span></td>
        <td width="205" align="left" class="board_add3"><span class="font_black">訂購商品名稱</span></td>
        <td width="100" align="center" valign="middle" class="board_add3"><span class="font_black">單價</span></td>
        <td width="100" align="center" class="board_add3"><span class="font_black">訂購數量</span></td>
        <td width="50" align="center" class="board_add3"><span class="font_black">取消</span></td>
      </tr>
      <tr>
        <td align="center" class="board_add3"><img src="images/shop/thum/" width="57" /></td>
        <td height="30" align="left" class="board_add3"><span class="font_black">&nbsp;</span></td>
        <td align="center" valign="middle" class="board_add3"><span class="font_black">&nbsp;</span></td>
        <td align="center" class="board_add3"><label>
          <input name="odlist_qty[]" type="text" id="odlist_qty[]" size="3" maxlength="3" />
          <input type="hidden" name="odlist_id[]" id="odlist_id[]" />
          <input type="hidden" name="order_total" id="order_total" />
        </label></td>
        <td align="center" class="board_add3"><span class="font_black"><a href="shopcart_del2.php?delSure=1&amp;odlist_id=">取消</a></span></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td height="20" align="right" class="board_add3"><span class="font_black">小 計：</span></td>
      </tr>
      <tr>
        <td height="20" align="right" class="board_add3"><span class="font_black">運 費：100</span></td>
      </tr>
      <tr>
        <td height="20" align="right" class="board_add3"><span class="font_red">總 計：</span></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="70" align="center" valign="middle">
    <input name="button" type="button" id="button" onclick="window.location='index.php'" value="繼續購物">
    <input name="button2" type="submit" id="button2" value="更新購物車">
    <input name="button3" type="button" id="button3" onclick="window.location='shopcart_del.php'" value="清空購物車">
    <input name="button4" type="button" id="button4" onclick="window.location='shopcart_checkout.php'" value="前往結帳">
        </td>
      </tr>
    </table>
    </form>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" class="font_red2">目前您的購物車中沒有任何資料!</td>
        </tr>
    </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>