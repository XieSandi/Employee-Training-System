<?php require_once('Connections/connection.php'); ?>
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

$index_peserta_list_peserta = 1;
if (isset($index_peserta_list_peserta)) {
  $index_peserta_list_peserta = $index_peserta_list_peserta;
}
mysql_select_db($database_connection, $connection);
$query_list_peserta = sprintf("SELECT training_list.pelatihan_ke,     karyawan.id_karyawan,     karyawan.nama,     training_list.nama_training, 	training_list.tanggal_training FROM training_list INNER JOIN karyawan ON karyawan.id_karyawan = training_list.id_karyawan WHERE training_list.pelatihan_ke = %s", GetSQLValueString($index_peserta_list_peserta, "int"));
$list_peserta = mysql_query($query_list_peserta, $connection) or die(mysql_error());
$row_list_peserta = mysql_fetch_assoc($list_peserta);
$totalRows_list_peserta = mysql_num_rows($list_peserta);
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
    <td colspan="5">Pelatihan Ke : <?php echo $row_list_peserta['pelatihan_ke']; ?></td>
  </tr>
  <tr>
    <td width="25%">id_karyawan</td>
    <td width="25%">nama</td>
    <td width="25%">nama_training</td>
    <td width="25%">tanggal_training</td>
    <td width="25%">TOOLS</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_list_peserta['id_karyawan']; ?></td>
      <td><?php echo $row_list_peserta['nama']; ?></td>
      <td><?php echo $row_list_peserta['nama_training']; ?></td>
      <td><?php echo $row_list_peserta['tanggal_training']; ?></td>
      <td>HAPUS</td>
    </tr>
    <?php } while ($row_list_peserta = mysql_fetch_assoc($list_peserta)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($list_peserta);
?>
