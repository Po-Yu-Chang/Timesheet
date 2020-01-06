<link href="web.css" rel="stylesheet" type="text/css" />
    <table width="199" border="0" cellspacing="0" cellpadding="0" background="images/memberzone2.gif">
      <tr>
        <td><img src="images/memberzone1.gif" width="199" height="40" /></td>
      </tr>
      <tr>
        <td align="center">
        <form id="memberLogin" name="memberLogin" method="post" action="">
        <table width="175" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" colspan="3" align="center" valign="middle" bgcolor="#FF0000" class="font_white">帳號或密碼錯誤，請重新登入!!</td>
          </tr>
          <tr>
            <td width="36" height="20" valign="middle">帳號：</td>
            <td width="78"><label>
              <input name="uCheck" type="text" class="inputstyle1" id="uCheck" />
            </label></td>
            <td width="61" rowspan="2" valign="middle"><label>
              <input type="image" name="imageField" id="imageField" src="images/memberzonebtn3.gif" />
            </label></td>
          </tr>
          <tr>
            <td height="20" valign="middle">密碼：</td>
            <td><label>
              <input name="pCheck" type="password" class="inputstyle1" id="pCheck" />
            </label></td>
            </tr>
          <tr>
            <td height="20" colspan="3" align="center" valign="middle"><label>
              <input name="remember" type="checkbox" id="remember" value="1" checked="checked" />
            </label>記住我的帳號密碼</td>
          </tr>
        </table>
        </form>
        </td>
      </tr>
      <tr>
        <td align="center" height="10"><img src="images/memberzone4.gif" width="166" height="2" /></td>
      </tr>
      <tr>
        <td align="center"><a href="memberAdd.php"><img src="images/memberzonebtn1.gif" width="79" height="19" border="0" /></a><a href="memberLostPass.php"><img src="images/memberzonebtn2.gif" width="86" height="19" border="0" /></a></td>
      </tr>
      <tr>
        <td><img src="images/memberzone3.gif" width="199" height="10" /></td>
      </tr>
    </table>
    <br />
    <table width="199" border="0" cellspacing="0" cellpadding="0" background="images/memberzone2.gif">
      <tr>
        <td><img src="images/memberzone1.gif" width="199" height="40" /></td>
      </tr>
      <tr>
        <td height="20" align="center" valign="top">親愛的會員<span class="font_red">&nbsp; &nbsp;&nbsp; &nbsp;</span>您好</td>
      </tr>
      <tr>
        <td align="center" height="10"><img src="images/memberzone4.gif" width="166" height="2" /></td>
      </tr>
      <tr>
        <td align="center">
        <a href="admin/admin.php"><img src="images/memberzonebtn7.gif" border="0" /></a><br />
        <a href="shopcart_myorder.php"><img src="images/memberzonebtn6.gif" border="0" /></a>
        <br /><a href="memberUpdate.php"><img src="images/memberzonebtn4.gif" width="79" height="19" border="0" /></a><a href="logout.php"><img src="images/memberzonebtn5.gif" width="86" height="19" border="0" /></a></td>
      </tr>
      <tr>
        <td><img src="images/memberzone3.gif" width="199" height="10" /></td>
      </tr>
    </table>
    <br />
   <div align="center"><a href="shopcart_show.php"><img src="images/btn_car1.gif" width="84" height="18" border="0" /></a></div> 
    <br />
    <form id="shopSearch" name="shopSearch" method="get" action="search.php">
    <table width="180" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="61" rowspan="2" align="right"><img src="images/shopsearch01.gif" width="45" height="43" /></td>
        <td width="98"><img src="images/shopsearch02.gif" width="54" height="21" /></td>
        <td width="21">&nbsp;</td>
      </tr>
      <tr>
        <td><label>
          <input name="keyword" type="text" class="inputstyle2" id="keyword" />
        </label><br /><a href="search_advanced.php">進階搜尋</a></td>
        <td valign="top"><label>
          <input type="image" name="imageField2" id="imageField2" src="images/shopsearchbtn.gif" />
        </label></td>
      </tr>
    </table>
    </form>
    <table width="193" border="0" cellspacing="0" cellpadding="0" background="images/btn_onlineservice.gif">
  <tr>
    <td width="125" height="50">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="26" align="right" valign="top">
<a target="_blank" href="http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=c8bccc1881e1d6da@apps.messenger.live.com&mkt=zh-tw"><img style="border-style: none;" src="http://messenger.services.live.com/users/c8bccc1881e1d6da@apps.messenger.live.com/presenceimage?mkt=zh-tw" width="16" height="16" /></a><img src="images/im_icon_03.gif" width="76" height="16"><a href="http://wowimme.spaces.live.com/" target="_blank"><img src="images/im_icon_04.gif" width="18" height="16" border="0"></a>
    &nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
    <a href="forum.php"><img src="images/btn_forum.gif" width="193" height="76" border="0" /></a><br />
    <form id="epaperOder" name="epaperOder" method="post" action="epaperOrder.php">
    <table width="193" border="0" cellspacing="0" cellpadding="0" background="images/btn_epaper.gif">
      <tr>
        <td width="129" height="40">&nbsp;</td>
        <td width="64">&nbsp;</td>
      </tr>
      <tr>
        <td height="36" align="right" valign="middle"><label>
          <input name="orderemail" type="text" id="orderemail" size="13" />
        </label></td>
        <td align="left" valign="middle"> &nbsp;
          <input type="submit" name="button" id="button" value="訂閱" />&nbsp;</td>
      </tr>
    </table>
</form>