<?php require_once('../Connections/connection.php'); ?>
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

mysql_select_db($database_connection, $connection);
$query_Recordset1 = "SELECT * FROM proposal";
$Recordset1 = mysql_query($query_Recordset1, $connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
    <td>id_proposal</td>
    <td>tanggal_dikirim</td>
    <td>pelatihan_ke</td>
    <td>approvedby_HRD</td>
    <td>approvedby_HC</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  
  $id = $row_Recordset1['id_proposal'];

 $sql="UPDATE proposal SET approvedby_HRD='Approved' WHERE id='$id'";
  
  do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_proposal']; ?></td>
      <td><?php echo $row_Recordset1['tanggal_dikirim']; ?></td>
      <td><?php echo $row_Recordset1['pelatihan_ke']; ?></td>
      <td><?php echo $row_Recordset1['approvedby_HRD']; ?></td>
      <td><?php echo $row_Recordset1['approvedby_HC']; ?></td>
      <td><a href="coba_B.php?id_proposal=<?php echo $row_Recordset1['id_proposal']; ?>">
        <button>Approve</button>
      </a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
