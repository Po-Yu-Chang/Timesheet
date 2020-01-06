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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_web_board = 3;
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
</head>

<body onload="MM_preloadImages('images/btn_shop1_2.gif','images/btn_shop2_2.gif','images/btn_shop3_2.gif','images/btn_shop4_2.gif','images/btn_shop5_2.gif','images/btn_shop6_2.gif')">
<?php include("header.php"); ?>
<div id="main">
  <div id="main1"></div>
  <div id="main2">
      <? include("leftzone.php")?>
  </div>
  <div id="main3">
  <div align="center"><a href="boardAdd.php"><img src="images/board_post.gif" width="100" height="22" border="0" align="middle" /></a>
  </div>
  <?php if ($totalRows_web_board > 0) { // Show if recordset not empty ?>
    <?php do { ?>
      <table width="555" border="0" cellspacing="0" cellpadding="0" class="board_add2">
        <tr>
          <td width="115" rowspan="2" align="center" valign="top"><br />
            <div id="board_pic"><img src="images/face/<?php echo $row_web_board['board_pic']; ?>" width="80" height="80" /></div>
            <div id="board_namefont">&nbsp;<?php echo $row_web_board['board_name']; ?></div></td>
          <td width="260" align="left" class="font_black">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_web_board['board_title']; ?></td>
          <td width="180" height="20" align="right" class="font_black">留言時間：<?php echo $row_web_board['board_date']; ?>&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><table width="430" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
            <tr>
              <td width="11" valign="top" background="images/board02.gif"><img src="images/board01.gif" width="11" height="40" /></td>
              <td width="429" align="left" valign="top" class="board_line1" style="word-break:break-all;overflow:hidden;"><div class="board_post"> <?php echo nl2br(strip_tags($row_web_board['board_content'])); ?><br />
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="13%" valign="middle"><a href="mailto:<?php echo $row_web_board['board_email']; ?>">
                      <?php /*START_PHP_SIRFCIT*/ if ($row_web_board['board_email']!=""){ ?>
                        <img src="images/board_email.gif" width="40" height="19" border="0" />
                        <?php } /*END_PHP_SIRFCIT*/ ?>
                    </a></td>
                    <td width="87%" valign="middle" class="font_black">IP位置：<?php echo $row_web_board['board_ip']; ?></td>
                  </tr>
                </table>
              </div>
                <?php /*START_PHP_SIRFCIT*/ if ($row_web_board['board_re']!=""){ ?>
                  <div class="board_repost">
                    <table width="389" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="64" valign="top">管理回覆：</td>
                        <td width="325" align="left" valign="top" class="board_repost2"><?php echo $row_web_board['board_re']; ?></td>
                        </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td height="20" align="right">回覆時間：<?php echo $row_web_board['board_redate']; ?></td>
                        </tr>
                      </table>
                  </div>
                  <?php } /*END_PHP_SIRFCIT*/ ?></td>
            </tr>
          </table></td>
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
  <div id="main4"></div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($web_board);
?>
