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
$query_recordset_karyawan = "SELECT * FROM karyawan";
$recordset_karyawan = mysql_query($query_recordset_karyawan, $connection) or die(mysql_error());
$row_recordset_karyawan = mysql_fetch_assoc($recordset_karyawan);
$totalRows_recordset_karyawan = mysql_num_rows($recordset_karyawan);
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tables</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                DataTables is a third party plugin that is used to generate the demo table below. For more information
                about DataTables, please visit the
                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                .
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nama</td>
                            <td>Alamat</td>
                            <td>Tanggal Lahir</td>
                            <td>Unit</td>
                            <td>Posisi</td>
                            <td>Username</td>
                            <td>Password</td>
                            <td>Access_level</td>
                            <td>Tools</td>
                        </tr>
                    </thead>
                    <tfoot>
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
                    </tfoot>
                    <tbody>
                        <?php do { ?>
                        <tr>
                            <td><?php echo $row_recordset_karyawan['id_karyawan']; ?></td>
                            <td><?php echo $row_recordset_karyawan['nama']; ?></td>
                            <td><?php echo $row_recordset_karyawan['alamat']; ?></td>
                            <td><?php echo $row_recordset_karyawan['tanggal lahir']; ?></td>
                            <td><?php echo $row_recordset_karyawan['unit']; ?></td>
                            <td><?php echo $row_recordset_karyawan['posisi']; ?></td>
                            <td><?php echo $row_recordset_karyawan['username']; ?></td>
                            <td><?php echo $row_recordset_karyawan['password']; ?></td>
                            <td><?php echo $row_recordset_karyawan['access_level']; ?></td>
                            <td><a
                                    href="../DOM/delete_karyawan.php?id_karyawan=<?php echo $row_recordset_karyawan['id_karyawan']; ?>">Delete</a>
                                | <a
                                    href="edit_karyawan.php?id_karyawan=<?php echo $row_recordset_karyawan['id_karyawan']; ?>">Edit</a>
                            </td>
                        </tr>
                        <?php } while ($row_recordset_karyawan = mysql_fetch_assoc($recordset_karyawan)); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
mysql_free_result($recordset_karyawan);
?>