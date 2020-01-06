<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
#heig{
     height:25px;
}
#color{
     background-color: #E5E5E5;
}
</style>
</head>
<body>
<div class="container">
  <div align="center">
    <form id="form1" name="form1" method="post" action="../index.php/member/login">
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="300" border="1" class="table table-bordered table-condensed">
        <tr>
          <td colspan="2" id="color"><div align="center"><strong>登入</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>帳號</strong></div></td>
          <td><label id="heig">
            <input type="text" name="account" id="account" />
          </label></td>
        </tr>
        <tr>
          <td><div align="center"><strong>密碼</strong></div></td>
          <td><label id="heig">
            <input type="password" name="password" id="password" />
          </label></td>
        </tr>
        <tr>
          <td colspan="2" id="color">
          <div class="btn-group">
          <button class="btn" type="submit">登入</button>
          <button class="btn" type="reset">重新填寫</button>
          </div>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>