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

$index_proposal_Recordset1 = "-1";
if (isset($GET['index_proposal'])) {
  $index_proposal_Recordset1 = $GET['index_proposal'];
}
mysql_select_db($database_connection, $connection);
$query_Recordset1 = sprintf("SELECT 	proposal.id_proposal,     proposal.tanggal_dikirim,     proposal.pelatihan_ke,     sum(training_list.biaya_training) as total_biaya,     proposal.approvedby_HRD,     proposal.approvedby_HC from 	proposal INNER JOIN training_list ON proposal.pelatihan_ke = training_list.pelatihan_ke WHERE 	proposal.pelatihan_ke = %s", GetSQLValueString($index_proposal_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<table border="1">
  <tr>
    <td>id_proposal</td>
    <td>tanggal_dikirim</td>
    <td>pelatihan_ke</td>
    <td>total_biaya</td>
    <td>approvedby_HRD</td>
    <td>approvedby_HC</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_proposal']; ?></td>
      <td><?php echo $row_Recordset1['tanggal_dikirim']; ?></td>
      <td><?php echo $row_Recordset1['pelatihan_ke']; ?></td>
      <td><?php echo $row_Recordset1['total_biaya']; ?></td>
      <td><?php echo $row_Recordset1['approvedby_HRD']; ?></td>
      <td><?php echo $row_Recordset1['approvedby_HC']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<?php
mysql_free_result($Recordset1);
?>
