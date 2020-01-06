<?php
session_start();
if(isset($_POST["captcha"])) {
	if(($_SESSION['captcha_code'] == $_POST['captcha']) && (!empty($_SESSION['captcha_code'])) ) {
		//Passed!
		$captcha_msg="Thank you";
	}else{
		// Not passed 8-(
		$captcha_msg="invalid code";
		if(isset($_POST["MM_insert"])){
	  		unset($_POST["MM_insert"]);
		}
		if(isset($_POST["MM_update"])){
			unset($_POST["MM_update"]);
		}
	}
}
class CaptchaImage {
	var $font = "verdana.ttf";
	function hex_to_dec($hexcolor){
	//convert hex hex values to decimal ones
	$dec_color=array('r'=>hexdec(substr($hexcolor,0,2)),'g'=>hexdec(substr($hexcolor,2,2)),'b'=>hexdec(substr($hexcolor,4,2)));
	return $dec_color;
	}
	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}
	function CaptchaImage($width='120',$height='30',$characters='6',$hex_bg_color='FFFFFF',$hex_text_color="FF0000",$hex_noise_color="CC0000", $img_file='captcha.jpg') {
		$rgb_bg_color=$this->hex_to_dec($hex_bg_color);
		$rgb_text_color=$this->hex_to_dec($hex_text_color);
		$rgb_noise_color=$this->hex_to_dec($hex_noise_color);
		$code = $this->generateCode($characters);
		/* font size will be 60% of the image height */
		$font_size = $height * 0.60;
		$image = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, $rgb_bg_color['r'], $rgb_bg_color['g'],$rgb_bg_color['b']);
		$text_color = imagecolorallocate($image, $rgb_text_color['r'], $rgb_text_color['g'],$rgb_text_color['b']);
		$noise_color = imagecolorallocate($image, $rgb_noise_color['r'], $rgb_noise_color['g'],$rgb_noise_color['b']);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code);
		/* save the image */
		imagejpeg($image,$img_file);
		imagedestroy($image);
		echo "<img src=\"$img_file?".time()."\" width=\"$width\" height=\"$height\" alt=\"security code\" id=\"captchaImg\">";
		$_SESSION['captcha_code'] = $code;
	}

}
?>
<?php require_once('Connections/conn_web.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "boardadd")) {
  $insertSQL = sprintf("INSERT INTO board (board_title, board_name, board_pic, board_email, board_content, board_date, board_ip) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['board_title'], "text"),
                       GetSQLValueString($_POST['board_name'], "text"),
                       GetSQLValueString($_POST['board_pic'], "text"),
                       GetSQLValueString($_POST['board_email'], "text"),
                       GetSQLValueString($_POST['board_content'], "text"),
                       GetSQLValueString($_POST['board_date'], "date"),
                       GetSQLValueString($_POST['board_ip'], "text"));

  mysql_select_db($database_conn_web, $conn_web);
  $Result1 = mysql_query($insertSQL, $conn_web) or die(mysql_error());

  $insertGoTo = "board.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
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
<script type="text/javascript">
<!--
function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/btn_shop1_2.gif','images/btn_shop2_2.gif','images/btn_shop3_2.gif','images/btn_shop4_2.gif','images/btn_shop5_2.gif','images/btn_shop6_2.gif')">
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3" align="center">
    <form action="<?php echo $editFormAction; ?>" method="POST" name="boardadd" id="boardadd" onsubmit="YY_checkform('boardadd','board_title','#q','0','請檢查留言標題欄位','board_name','#q','0','請檢查留言姓名欄位','captcha','#recaptcha','6','請檢查驗證碼','board_content','5','1','請檢查留言內容，至少5個字元');return document.MM_returnValue">
      <table width="540" border="0" cellspacing="0" cellpadding="0" background="images/back11_2.gif">
        <tr>
          <td width="25" align="left"><img src="images/board03.gif" /></td>
          <td width="505" align="left" background="images/board04.gif">&nbsp; <span class="font_black">任何與網站相關的問題，都歡迎留言喔~~</span></td>
          <td width="10" align="right"><img src="images/board05.gif" width="10" height="28" /></td>
        </tr>
      </table>
      <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="82" height="30" class="board_add">標&nbsp; 題：</td>
          <td width="468" align="left" class="board_add"><label>
            <input type="text" name="board_title" id="board_title" />
            </label><span class="font_red">* </span></td>
        </tr>
        <tr>
          <td height="30" class="board_add">姓&nbsp; 名：</td>
          <td align="left" class="board_add"><label>
            <input type="text" name="board_name" id="board_name" />
          </label><span class="font_red">* </span></td>
        </tr>
        <tr>
          <td height="30" class="board_add">圖&nbsp; 示：</td>
          <td align="left" class="board_add"><table width="480" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><div id="board_pic"><img src="images/face/face1.gif" width="80" height="80" /></div></td>
              <td align="center"><div id="board_pic"><img src="images/face/face2.gif" width="80" height="80" /></div></td>
              <td align="center"><div id="board_pic"><img src="images/face/face3.gif" width="80" height="80" /></div></td>
              <td align="center"><div id="board_pic"><img src="images/face/face4.gif" width="80" height="80" /></div></td>
            </tr>
            <tr>
              <td align="center"><label>
                <input name="board_pic" type="radio" id="radio" value="face1.gif" checked="checked" />
              </label></td>
              <td align="center"><label>
                <input type="radio" name="board_pic" id="radio" value="face2.gif" />
              </label></td>
              <td align="center"><label>
                <input type="radio" name="board_pic" id="radio" value="face3.gif" />
              </label></td>
              <td align="center"><label>
                <input type="radio" name="board_pic" id="radio" value="face4.gif" />
              </label></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="30" class="board_add">E-mail：</td>
          <td align="left" class="board_add"><label>
            <input name="board_email" type="text" id="board_email" size="35" />
          </label></td>
        </tr>
        <tr>
          <td class="board_add">留&nbsp; 言：</td>
          <td align="left" class="board_add"><label>
            <br />
            <textarea name="board_content" id="board_content" cols="50" rows="10"></textarea>
            </label>
            <span class="font_red">*</span><br /><br />
          </td>
        </tr>
        <tr>
          <td class="board_add">圖形驗證：</td>
          <td align="left" class="board_add"><label>
            <input name="captcha" type="text" id="captcha" size="10" />
            <?php $captcha = new CaptchaImage(150,50,5,'99FF00','000000','FFFFFF');?>
          </label></td>
        </tr>
        <tr>
          <td height="40" colspan="2" align="center"><label>
            <input type="submit" name="button" id="button" value="送出留言" />
            <input type="reset" name="button2" id="button2" value="重設" />
            <input name="board_date" type="hidden" id="board_date" value="<? echo date("Y-m-d H:i:s");?>" />
            <input name="board_ip" type="hidden" id="board_ip" value="<? echo $_SERVER["REMOTE_ADDR"];?>" />
            <input name="recaptcha" type="hidden" id="recaptcha" value="<? echo $_SESSION['captcha_code']?>" />
          </label></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="boardadd" />
    </form>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>