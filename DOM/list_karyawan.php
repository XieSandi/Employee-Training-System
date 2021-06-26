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

mysql_select_db($database_connection, $connection);
$query_list_karyawanikut = "SELECT * FROM karyawan";
$list_karyawanikut = mysql_query($query_list_karyawanikut, $connection) or die(mysql_error());
$row_list_karyawanikut = mysql_fetch_assoc($list_karyawanikut);
$totalRows_list_karyawanikut = mysql_num_rows($list_karyawanikut);
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
    <td>id_karyawan</td>
    <td>nama</td>
    <td>alamat</td>
    <td>tanggal lahir</td>
    <td>unit</td>
    <td>posisi</td>
    <td>username</td>
    <td>password</td>
    <td>access_level</td>
    <td>Tools</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_list_karyawanikut['id_karyawan']; ?></td>
      <td><?php echo $row_list_karyawanikut['nama']; ?></td>
      <td><?php echo $row_list_karyawanikut['alamat']; ?></td>
      <td><?php echo $row_list_karyawanikut['tanggal lahir']; ?></td>
      <td><?php echo $row_list_karyawanikut['unit']; ?></td>
      <td><?php echo $row_list_karyawanikut['posisi']; ?></td>
      <td><?php echo $row_list_karyawanikut['username']; ?></td>
      <td><?php echo $row_list_karyawanikut['password']; ?></td>
      <td><?php echo $row_list_karyawanikut['access_level']; ?></td>
      <td><a href="delete_karyawan.php?id_karyawan=<?php echo $row_list_karyawanikut['id_karyawan']; ?>">Delete</a> | <a href="edit_karyawan.php?id_karyawan=<?php echo $row_list_karyawanikut['id_karyawan']; ?>">Edit</a></td>
    </tr>
    <?php } while ($row_list_karyawanikut = mysql_fetch_assoc($list_karyawanikut)); ?>
</table>
<p>&nbsp;</p>
<p><a href="add_karyawan.php">Tambah</a></p>
</body>
</html>
<?php
mysql_free_result($list_karyawanikut);
?>
