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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE proposal SET approvedby_HRD=%s WHERE id_proposal=%s",
                       GetSQLValueString($_POST['approvedby_HRD'], "text"),
                       GetSQLValueString($_POST['id_proposal'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "coba_A.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_proposal = "-1";
if (isset($_GET['id_proposal'])) {
  $colname_proposal = $_GET['id_proposal'];
}
mysql_select_db($database_connection, $connection);
$query_proposal = sprintf("SELECT * FROM proposal WHERE id_proposal = %s", GetSQLValueString($colname_proposal, "int"));
$proposal = mysql_query($query_proposal, $connection) or die(mysql_error());
$row_proposal = mysql_fetch_assoc($proposal);
$totalRows_proposal = mysql_num_rows($proposal);$colname_proposal = "-1";
if (isset($_GET['id_proposal'])) {
  $colname_proposal = $_GET['id_proposal'];
}
mysql_select_db($database_connection, $connection);
$query_proposal = sprintf("SELECT * FROM proposal WHERE id_proposal = %s", GetSQLValueString($colname_proposal, "int"));
$proposal = mysql_query($query_proposal, $connection) or die(mysql_error());
$row_proposal = mysql_fetch_assoc($proposal);
$totalRows_proposal = mysql_num_rows($proposal);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_proposal:</td>
      <td><?php echo $row_proposal['id_proposal']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Approvedby_HRD:</td>
      <td><input type="text" name="approvedby_HRD" value="Approved" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_proposal" value="<?php echo $row_proposal['id_proposal']; ?>" />
</form>

<?php
mysql_free_result($proposal);
?>
