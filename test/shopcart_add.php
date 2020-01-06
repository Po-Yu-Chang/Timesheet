<?
//啟動session功能
session_start();

//如果Session變cart是空的，就註冊Session變數cart，值為1
//用在判別使用者是否已經有將任何商品加入購物車
if(empty($_SESSION["cart"])){
$_SESSION["cart"]='1';
}

//如果Session變數order_sid是空的，就註冊Session變數order_sid，取目前session的session id為值
//用在判別訂單資料
if(empty($_SESSION["order_sid"])){
$_SESSION["order_sid"]=session_id();
}

//如果Session變數order_group是空的，就註冊Session變數order_group，取目前unixtime為值
//用在判別訂單資料
if(empty($_SESSION["order_group"])){
$_SESSION["order_group"]=time(NULL);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script language=javascript> 
//0秒後，直接送出表單form1 
setTimeout("document.form1.submit()",0); 
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <input type="hidden" name="p_name" id="p_name" />
  <input type="hidden" name="p_price" id="p_price" />
  <input type="hidden" name="p_pic" id="p_pic" />
  <input name="odlist_date" type="hidden" id="odlist_date" value="<? echo date("Y-m-d H:i:s")?>" />
  <input name="order_sid" type="hidden" id="order_sid" value="<? echo session_id()?>" />
  <input name="order_group" type="hidden" id="order_group" value="<? echo $_SESSION["order_group"]?>" />
</form>
</body>
</html>