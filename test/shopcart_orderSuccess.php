<? 
session_start();
//將session變數cart,取消登記,網頁左方的觀看購物車按鈕會取消顯示
session_unregister("cart");
//將session變數order_group,取消登記,下次商品新加入購物車時會再登記，訂單才不會產生錯誤
session_unregister("order_group");
?>
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
    <form name="form1" method="shopcart" action="">
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
      <tr>
        <td width="25" align="left"><img src="images/board12.gif" /></td>
        <td width="104" align="left" valign="middle" background="images/board04.gif">&nbsp; <span class="font_black">完成訂購&nbsp;</span></td>
        <td width="416" align="left" valign="bottom" background="images/board04.gif">&nbsp;</td>
        <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="70" align="center" valign="middle">
          <table width="555" border="0" cellpadding="10" cellspacing="0">
            <tr>
              <td align="left" class="font_black"><p>親愛的客戶<span class="font_red">  </span>非常感謝您的訂購商品! &nbsp;&nbsp;&nbsp;&nbsp; 建議您[ <a href='javascript:window.print()'><font color="red">列印本頁</font></a> ]<br />
                </p>
                <p>如果您選擇「貨到付款」我們將盡快處理您的交易訂單!</p>
                <p>如果您選擇「ATM轉帳」或「銀行匯款」，下面是我們的匯款資料，付款完成後請記得回到網站登入會員後，檢視您的訂單記錄，修改已付款選項勾選，並留下匯款帳號後5碼，方便我們的人員作確認及處理後續的出貨。<br />
                  <br />
                  <span class="font_red">本公司匯款帳戶資料如下：</span><br />
                  代表名稱：xxxxxx 有限公司<br />
                  銀行代號：011   xxxx 銀行   xxxx分行<br />
                代表帳號：xxxxxxx                </p></td>
            </tr>
          </table>
          <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
            <tr>
              <td width="25" align="left"><img src="images/board13.gif" /></td>
              <td width="212" align="left" valign="middle" background="images/board04.gif">&nbsp; <span class="font_black">本 次 訂 單 資 料&nbsp;</span></td>
              <td width="308" align="left" valign="middle" background="images/board04.gif">&nbsp;</td>
              <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
            </tr>
          </table>
          <table width="555" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td align="left" class="board_add"><span class="font_black">訂 單 編 號：</span></td>
              </tr>
            <tr>
              <td align="left" class="board_add"><span class="font_black">訂 購 者：</span></td>
              </tr>
            <tr>
              <td align="left" class="board_add"><span class="font_black">收 件 者：</span></td>
              </tr>
            <tr>
              <td align="left" class="board_add"><span class="font_black">聯 絡 電 話：</span></td>
            </tr>
            <tr>
              <td align="left" class="board_add"><span class="font_black">收 件 者 地 址：</span></td>
              </tr>
            <tr>
              <td align="left" class="board_add"><span class="font_black">付 款 方 式：</span></td>
            </tr>
            <tr>
              <td align="left" class="board_add"><span class="font_black">訂 單 總 金 額：</span></td>
            </tr>
          </table>
<p>&nbsp;</p>
          <p>
            <input name="button" type="button" id="button" onclick="window.location='index.php'" value="回首頁">
          </p></td>
      </tr>
    </table>
    </form>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>