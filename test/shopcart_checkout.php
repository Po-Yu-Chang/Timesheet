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
    <form action="" method="shopcart" name="order" id="order" onsubmit="YY_checkform('order','order_name2','#q','0','請輸入收件者姓名','order_phone','#q','0','請輸入收件者電話','order_cusadr','#q','0','請輸入收件者地址');return document.MM_returnValue">
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
      <tr>
        <td width="25" align="left"><img src="images/board13.gif" /></td>
        <td width="78" align="left" valign="middle" background="images/board04.gif">&nbsp; <span class="font_black">訂 購 資 料&nbsp;-</span></td>
        <td width="442" align="left" valign="middle" background="images/board04.gif"><span class="font_black">親愛的客戶 (<span class="font_red"> </span>)
          <input type="hidden" name="order_username" id="order_username" />
<input type="hidden" name="order_name1" id="order_name1" />
          您好，請確認收件人資料及訂購清單：</span></td>
        <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="87" class="board_add"><span class="font_black">收 件 者 姓 名：</span></td>
        <td width="448" class="board_add"><label>
          <input type="text" name="order_name2" id="order_name2" />
          </label><span class="font_red">*</span></td>
      </tr>
      <tr>
        <td class="board_add"><span class="font_black">聯 絡 電 話：</span></td>
        <td class="board_add"><label>
          <input type="text" name="order_phone" id="order_phone" />
          <input type="hidden" name="email" id="email" />
        </label><span class="font_red">*</span></td>
      </tr>
      <tr>
        <td class="board_add"><span class="font_black">收 件 者 地 址：</span></td>
        <td class="board_add"><label>
          <input name="order_cusadr" type="text" id="order_cusadr" size="50" />
        </label><span class="font_red">*</span></td>
      </tr>
      <tr>
        <td class="board_add"><span class="font_black">付 款 方 式：</span></td>
        <td class="board_add">
          <span class="font_black">
          <label>
          <input name="order_paytype" type="radio" id="radio" value="ATM轉帳" checked="checked" />
          ATM轉帳
          <input name="order_paytype" type="radio" id="radio2" value="銀行匯款" />
          銀行匯款
          <input type="radio" name="order_paytype" id="radio3" value="貨到付款" />
          貨到付款</label></span></td>
      </tr>
    </table>
    <br />
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
        <td height="20" align="right" class="board_add3"><span class="font_red">
          總 計：</span></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="70" align="center" valign="middle">
           <input name="button" type="submit" id="button" value="確認無誤，進行結帳">
           <input name="button2" type="button" id="button2" onclick="window.location='index.php'" value="我要繼續購物流程">
           <input type="hidden" name="order_total" id="order_total" value="" />
           <input type="hidden" name="order_sid" id="order_sid" />
           <input type="hidden" name="order_group" id="order_group" />
           <input name="order_date" type="hidden" id="order_date" value="<? echo date("Y-m-d H:i:s")?>" /></td>
      </tr>
    </table>
    </form>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" class="font_red2">結帳前請先登入會員!!</td>
      </tr>
    </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>