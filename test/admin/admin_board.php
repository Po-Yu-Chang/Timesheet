<?php require_once('../Connections/conn_web.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE board SET board_content=%s, board_re=%s, board_redate=%s WHERE board_id=%s",
                       GetSQLValueString($_POST['board_content'], "text"),
                       GetSQLValueString($_POST['board_re'], "text"),
                       GetSQLValueString($_POST['board_redate'], "date"),
                       GetSQLValueString($_POST['board_id'], "int"));

  mysql_select_db($database_conn_web, $conn_web);
  $Result1 = mysql_query($updateSQL, $conn_web) or die(mysql_error());

  $updateGoTo = "admin_board.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$maxRows_web_board = 10;
$pageNum_web_board = 0;
if (isset($_GET['pageNum_web_board'])) {
  $pageNum_web_board = $_GET['pageNum_web_board'];
}
$startRow_web_board = $pageNum_web_board * $maxRows_web_board;

mysql_select_db($database_conn_web, $conn_web);
$query_web_board = "SELECT * FROM board ORDER BY board_id DESC";
$query_limit_web_board = sprintf("%s LIMIT %d, %d", $query_web_board, $startRow_web_board, $maxRows_web_board);
$web_board = mysql_query($query_limit_web_board, $conn_web) or die(mysql_error());
$row_web_board = mysql_fetch_assoc($web_board);

if (isset($_GET['totalRows_web_board'])) {
  $totalRows_web_board = $_GET['totalRows_web_board'];
} else {
  $all_web_board = mysql_query($query_web_board);
  $totalRows_web_board = mysql_num_rows($all_web_board);
}
$totalPages_web_board = ceil($totalRows_web_board/$maxRows_web_board)-1;

$queryString_web_board = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_web_board") == false && 
        stristr($param, "totalRows_web_board") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_web_board = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_web_board = sprintf("&totalRows_web_board=%d%s", $totalRows_web_board, $queryString_web_board);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理後台</title>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Language" content="zh-tw" />
<meta name="description" content="Dreamweaver+PHP資料庫網站製作" />
<meta name="keywords" content="Dreamweaver+PHP資料庫網站製作" />
<meta name="author" content="joj設計、joj網頁設計、joj Design、joj Web Design、呂昶億、杜慎甄" />
<link href="../web.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function tfm_confirmLink(message) { //v1.0
	if(message == "") message = "Ok to continue?";	
	document.MM_returnValue = confirm(message);
}
//-->
</script>
</head>

<body>
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="admin_main2">
    <?php if ($totalRows_web_board > 0) { // Show if recordset not empty ?>
      <?php do { ?>
        <table width="555" border="0" cellspacing="0" cellpadding="0" class="board_add2">
          <tr>
            <td width="115" rowspan="2" align="center" valign="top"><br />
              <div id="board_pic"><img src="../images/face/face1.gif" width="80" height="80" /></div>
              <div id="board_namefont"><?php echo $row_web_board['board_name']; ?> </div>
              [ <a href="admin_boardDel.php?board_id=<?php echo $row_web_board['board_id']; ?>&amp;delSure=1" onclick="tfm_confirmLink('確定刪除本資料?');return document.MM_returnValue">刪除本資料</a> ] </td>
            <td width="260" align="left" class="font_black">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_web_board['board_title']; ?></td>
            <td width="180" height="20" align="right" class="font_black">留言時間：<?php echo $row_web_board['board_date']; ?>&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
              <table width="430" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="11" valign="top" background="../images/board02.gif"><img src="../images/board01.gif" width="11" height="40" /></td>
                  <td width="429" align="left" valign="top" class="board_line1"><div class="board_post">
                    <label>
                      <textarea name="board_content" id="board_content" cols="45" rows="5"><?php echo $row_web_board['board_content']; ?></textarea>
                    </label>
                    <br />
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%" valign="middle"><a href="mailto:"><img src="../images/board_email.gif" width="40" height="19" border="0" /></a></td>
                        <td width="87%" valign="middle" class="font_black">IP位置：<?php echo $row_web_board['board_ip']; ?></td>
                      </tr>
                    </table>
                  </div>
                    <div class="board_repost">
                      <table width="389" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="64" valign="top">管理回覆：</td>
                          <td width="325" align="left" valign="top" class="board_repost2"><label>
                            <textarea name="board_re" id="board_re" cols="37" rows="5"><?php echo $row_web_board['board_re']; ?></textarea>
                          </label></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td height="20" align="right">回覆時間：<?php echo $row_web_board['board_redate']; ?></td>
                        </tr>
                      </table>
                      <label>
                        <input type="submit" name="button" id="button" value="送出修改" />
                      </label>
                      <input name="board_id" type="hidden" id="board_id" value="<?php echo $row_web_board['board_id']; ?>" />
                      <input name="board_redate" type="hidden" id="board_redate" value="<? echo date("Y-m-d H:i:s");?>" />
                    </div></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1" />
            </form></td>
          </tr>
        </table>
        <?php } while ($row_web_board = mysql_fetch_assoc($web_board)); ?>
      <table width="555" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="bottom">&nbsp;
            <table border="0">
              <tr>
                <td><?php if ($pageNum_web_board > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_web_board=%d%s", $currentPage, 0, $queryString_web_board); ?>">第一頁</a>
                    <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_web_board > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_web_board=%d%s", $currentPage, max(0, $pageNum_web_board - 1), $queryString_web_board); ?>">上一頁</a>
                    <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_web_board < $totalPages_web_board) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_web_board=%d%s", $currentPage, min($totalPages_web_board, $pageNum_web_board + 1), $queryString_web_board); ?>">下一頁</a>
                    <?php } // Show if not last page ?></td>
                <td><?php if ($pageNum_web_board < $totalPages_web_board) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_web_board=%d%s", $currentPage, $totalPages_web_board, $queryString_web_board); ?>">最後一頁</a>
                    <?php } // Show if not last page ?></td>
              </tr>
            </table></td>
          <td align="right" valign="bottom">&nbsp;
            記錄 <?php echo ($startRow_web_board + 1) ?> 到 <?php echo min($startRow_web_board + $maxRows_web_board, $totalRows_web_board) ?> 共 <?php echo $totalRows_web_board ?></td>
        </tr>
      </table>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_web_board == 0) { // Show if recordset empty ?>
  <table width="555" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center" class="font_red2">目前資料庫中沒有任何資料!</td>
      </tr>
  </table>
  <?php } // Show if recordset empty ?>
  </div>
  <div id="admin_main3">
       <? include("right_zone.php");?>
  </div>
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($web_board);
?>
