<?php require_once('Connections/connection.php'); ?>
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

$maxRows_List = 10;
$pageNum_List = 0;
if (isset($_GET['pageNum_List'])) {
  $pageNum_List = $_GET['pageNum_List'];
}
$startRow_List = $pageNum_List * $maxRows_List;

$index_pelatihan_List = "1";
mysql_select_db($database_connection, $connection);
$query_List = sprintf("SELECT * FROM training_list where pelatihan_ke = %s", GetSQLValueString($index_pelatihan_List, "int"));
$query_limit_List = sprintf("%s LIMIT %d, %d", $query_List, $startRow_List, $maxRows_List);
$List = mysql_query($query_limit_List, $connection) or die(mysql_error());
$row_List = mysql_fetch_assoc($List);

if (isset($_GET['totalRows_List'])) {
  $totalRows_List = $_GET['totalRows_List'];
} else {
  $all_List = mysql_query($query_List);
  $totalRows_List = mysql_num_rows($all_List);
}
$totalPages_List = ceil($totalRows_List/$maxRows_List)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>pelatihan_ke</td>
    <td>id_karyawan</td>
    <td>nama_training</td>
    <td>tanggal_training</td>
    <td>biaya_training</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_List['pelatihan_ke']; ?></td>
      <td><?php echo $row_List['id_karyawan']; ?></td>
      <td><?php echo $row_List['nama_training']; ?></td>
      <td><?php echo $row_List['tanggal_training']; ?></td>
      <td><?php echo $row_List['biaya_training']; ?></td>
    </tr>
    <?php } while ($row_List = mysql_fetch_assoc($List)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($List);
?>
