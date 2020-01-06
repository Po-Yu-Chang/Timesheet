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
    <form action="" method="shopcart" name="order" id="order">
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
      <tr>
        <td width="25" align="left"><img src="images/board13.gif" /></td>
        <td width="78" align="left" valign="middle" background="images/board04.gif">&nbsp; <span class="font_black">訂 單 細 節&nbsp;-</span></td>
        <td width="442" align="left" valign="middle" background="images/board04.gif"><span class="font_black">親愛的客戶 (<span class="font_red"> </span>) 
          
          您好，這是您的訂單資料：</span></td>
        <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="93" align="right" class="board_add"><span class="font_black">收 件 者 姓 名：</span></td>
        <td width="442" align="left" class="board_add">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="board_add"><span class="font_black">聯 絡 電 話：</span></td>
        <td align="left" class="board_add">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="board_add"><span class="font_black">收 件 者 地 址：</span></td>
        <td align="left" class="board_add">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="board_add"><span class="font_black">付 款 方 式：</span></td>
        <td align="left" class="board_add">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="board_add"><span class="font_black">完 成 付 款：</span></td>
        <td align="left" class="board_add"><input name="order_payok" type="radio" id="radio" value="y" checked="checked" />
          已完成付款
          <label>
            <input type="radio" name="order_payok" id="radio2" value="n" />
          未完成付款</label></td>
      </tr>
      <tr>
        <td align="right" class="board_add"><span class="font_black">匯款帳號末5碼：</span></td>
        <td align="left" class="board_add"><label>
          <input name="order_paynumber" type="text" id="order_paynumber" size="10" />
          </label><span class="font_black">**匯款完成，請留下匯款帳號末5碼</span></td>
      </tr>
    </table>
<div align="center"><br />
                  <label>
                    <input type="submit" name="button3" id="button3" value="修改付款狀態" />
                  </label>
                  <input type="button" name="submit" value="回上一頁" onClick="window.history.back()";>
                  <input type="hidden" name="order_id" id="order_id" />
                  <br /><br />
    </div>
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
        <td width="255" align="left" class="board_add3"><span class="font_black">訂購商品名稱</span></td>
        <td width="100" align="center" valign="middle" class="board_add3"><span class="font_black">單價</span></td>
        <td width="100" align="center" class="board_add3"><span class="font_black">訂購數量</span></td>
        </tr>
      <tr>
        <td align="center" class="board_add3"><img src="images/shop/thum/" width="57" /></td>
        <td height="30" align="left" class="board_add3"><span class="font_black">&nbsp;</span></td>
        <td align="center" valign="middle" class="board_add3"><span class="font_black">&nbsp;</span></td>
        <td align="center" class="board_add3">&nbsp;</td>
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
    </form>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" class="font_red2">這不是屬於您的訂單資料!!</td>
      </tr>
    </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>