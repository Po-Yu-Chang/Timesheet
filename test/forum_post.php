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
//變換文章類型圖示
function forum_typeImg(){ 
  if (document.forumPost.forum_type.value=="1"){ 
      document.face.src="images/face/1.gif"; 
  }else{ 
      document.face.src="images/face/"+document.forumPost.forum_type.value; 
  }
}
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

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3">
  <form action="" method="post" name="forumPost" id="forumPost" onsubmit="YY_checkform('forumPost','forum_title','#q','0','請檢查標題','forum_content','5','1','請檢查留言內容');return document.MM_returnValue">
    <table width="555" border="0" cellspacing="0" cellpadding="0" background="images/forum01.gif">
      <tr>
        <td height="34" colspan="4" align="left"><img src="images/forum03.gif" width="158" height="34" /></td>
        <td width="393" align="right" class="font_red">您的IP位置：<? echo $_SERVER["REMOTE_ADDR"];?> </td>
      </tr>
    </table>
    <table width="555" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="82" height="30" class="board_add">標 題：</td>
        <td width="468" align="left" class="board_add"><label>
          <input name="forum_title" type="text" id="forum_title" size="50" />
          <span class="font_red">* </span></label></td>
      </tr>
      <tr>
        <td height="30" class="board_add">文章類別：</td>
        <td align="left" class="board_add">
<select name="forum_type" class="I" id="forum_type" onchange="forum_typeImg()">
<option value="1.gif" selected="selected">一般</option>
<option value="2.gif">推薦</option>
<option value="3.gif">疑問</option>
<option value="4.gif">求救</option>
</select>
 <img name="face" src="images/face/1.gif" alt="forum_type" />
        </td>
      </tr>
      <tr>
        <td height="30" class="board_add">表 情：</td>
        <td align="left" class="board_add"><table width="480" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><div id="board_pic"><img src="images/face/fface1.gif" width="80" height="80" /></div></td>
            <td align="center"><div id="board_pic"><img src="images/face/fface2.gif" width="80" height="80" /></div></td>
            <td align="center"><div id="board_pic"><img src="images/face/fface3.gif" width="80" height="80" /></div></td>
            <td align="center"><div id="board_pic"><img src="images/face/fface4.gif" width="80" height="80" /></div></td>
          </tr>
          <tr>
            <td align="center"><label>
              <input name="forum_img" type="radio" id="radio" value="fface1.gif" checked="checked" />
            </label></td>
            <td align="center"><label>
              <input type="radio" name="forum_img" id="radio" value="fface2.gif" />
            </label></td>
            <td align="center"><label>
              <input type="radio" name="forum_img" id="radio" value="fface3.gif" />
            </label></td>
            <td align="center"><label>
              <input type="radio" name="forum_img" id="radio" value="fface4.gif" />
            </label></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" class="board_add"><label> 留言內容：<span class="font_red">*</span><br />
            <textarea name="forum_content" id="forum_content" cols="65" rows="10"></textarea>
            <br />
            <br />
        </label></td>
      </tr>
      <tr>
        <td height="40" colspan="2" align="center"><label>
          <input type="submit" name="button2" id="button2" value="送表文章" />
          <input type="reset" name="button2" id="button3" value="重設" />
          <input type="button" name="submit" value="回上一頁" onClick="window.history.back()";>
          <input name="forum_username" type="hidden" id="forum_username" value="<? echo $_SESSION["MM_Username"]?>" />
          <input name="forum_lastman" type="hidden" id="forum_lastman" value="<? echo $_SESSION["MM_Username"]?>" />
          <input name="forum_date" type="hidden" id="forum_date" value="<? echo time();?>" />
          <input name="forum_lastdate" type="hidden" id="forum_lastdate" value="<? echo time();?>" />
          <input name="forum_ip" type="hidden" id="forum_ip" value="<? echo $_SERVER["REMOTE_ADDR"];?>" />
        </label></td>
      </tr>
    </table>
    </form>
    <table width="555" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" class="font_red2">發表文章前請先登入會員，謝謝。</td>
      </tr>
    </table>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>