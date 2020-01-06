<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onLoad="MM_preloadImages('images/btn_shop1_2.gif','images/btn_shop2_2.gif','images/btn_shop3_2.gif','images/btn_shop4_2.gif','images/btn_shop5_2.gif','images/btn_shop6_2.gif')"><div id="header">
  <table width="770" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="180" rowspan="2"><a href="index.php"><img src="images/header_1.gif" width="207" height="80" border="0" /></a></td>
      <td height="32"><img src="images/header_2.gif" width="563" height="32" border="0" usemap="#Map" /></td>
    </tr>
    <tr>
      <td height="48"><a href="products.php?shop_id=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','images/btn_shop1_2.gif',1)"><img src="images/btn_shop1_1.gif" name="Image3" width="92" height="48" border="0" id="Image3" /></a><a href="products.php?shop_id=2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','images/btn_shop2_2.gif',1)"><img src="images/btn_shop2_1.gif" name="Image4" width="93" height="48" border="0" id="Image4" /></a><a href="products.php?shop_id=3" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','images/btn_shop3_2.gif',1)"><img src="images/btn_shop3_1.gif" name="Image5" width="96" height="48" border="0" id="Image5" /></a><a href="products.php?shop_id=4" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','images/btn_shop4_2.gif',1)"><img src="images/btn_shop4_1.gif" name="Image6" width="96" height="48" border="0" id="Image6" /></a><a href="products.php?shop_id=5" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','images/btn_shop5_2.gif',1)"><img src="images/btn_shop5_1.gif" name="Image7" width="97" height="48" border="0" id="Image7" /></a><a href="products.php?shop_id=6" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','images/btn_shop6_2.gif',1)"><img src="images/btn_shop6_1.gif" name="Image8" width="89" height="48" border="0" id="Image8" /></a></td>
    </tr>
  </table>
</div>
<map name="Map" id="Map">
  <area shape="rect" coords="492,4,560,29" href="board.php" />
  <area shape="rect" coords="250,4,310,26" href="index.php">
</map>
