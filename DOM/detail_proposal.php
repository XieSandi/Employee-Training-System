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

$maxRows_Detail_Proposal = 10;
$pageNum_Detail_Proposal = 0;
if (isset($_GET['pageNum_Detail_Proposal'])) {
  $pageNum_Detail_Proposal = $_GET['pageNum_Detail_Proposal'];
}
$startRow_Detail_Proposal = $pageNum_Detail_Proposal * $maxRows_Detail_Proposal;

$index_proposal_Detail_Proposal = "2";
mysql_select_db($database_connection, $connection);
$query_Detail_Proposal = sprintf("SELECT 	proposal.id_proposal,     proposal.tanggal_dikirim,     proposal.pelatihan_ke,     sum(training_list.biaya_training) as total_biaya,     proposal.approvedby_HRD,     proposal.approvedby_HC from 	proposal INNER JOIN training_list ON proposal.pelatihan_ke = training_list.pelatihan_ke WHERE 	proposal.pelatihan_ke = %s", GetSQLValueString($index_proposal_Detail_Proposal, "int"));
$query_limit_Detail_Proposal = sprintf("%s LIMIT %d, %d", $query_Detail_Proposal, $startRow_Detail_Proposal, $maxRows_Detail_Proposal);
$Detail_Proposal = mysql_query($query_limit_Detail_Proposal, $connection) or die(mysql_error());
$row_Detail_Proposal = mysql_fetch_assoc($Detail_Proposal);

if (isset($_GET['totalRows_Detail_Proposal'])) {
  $totalRows_Detail_Proposal = $_GET['totalRows_Detail_Proposal'];
} else {
  $all_Detail_Proposal = mysql_query($query_Detail_Proposal);
  $totalRows_Detail_Proposal = mysql_num_rows($all_Detail_Proposal);
}
$totalPages_Detail_Proposal = ceil($totalRows_Detail_Proposal/$maxRows_Detail_Proposal)-1;
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
    <td>total_biaya</td>
    <td>approvedby_HRD</td>
    <td>approvedby_HC</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Detail_Proposal['id_proposal']; ?></td>
      <td><?php echo $row_Detail_Proposal['tanggal_dikirim']; ?></td>
      <td><?php echo $row_Detail_Proposal['pelatihan_ke']; ?></td>
      <td><?php echo $row_Detail_Proposal['total_biaya']; ?></td>
      <td><?php echo $row_Detail_Proposal['approvedby_HRD']; ?></td>
      <td><?php echo $row_Detail_Proposal['approvedby_HC']; ?></td>
    </tr>
    <?php } while ($row_Detail_Proposal = mysql_fetch_assoc($Detail_Proposal)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Detail_Proposal);
?>
