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
$query_proposal = "SELECT * FROM proposal";
$proposal = mysql_query($query_proposal, $connection) or die(mysql_error());
$row_proposal = mysql_fetch_assoc($proposal);
$totalRows_proposal = mysql_num_rows($proposal);
?>

<div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Proposal</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../DOM/dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Proposal</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                Action Notes :
                </br>
                <i class="far fa-clipboard"></i> = Details | 
                <i class="far fa-user"></i> = Daftar Peserta | 
                <i class="far fa-trash-alt"></i> = Hapus | 
                <i class="far fa-edit"></i> = Edit |
                <i class="far fa-check-circle"></i> = Approve |
                <i class="far fa-times-circle"></i> = Reject
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Karyawan
            </div>
            <div class="card-body">
                <!-- <div class="d-grid gap-2 pb-3">
                    <button class="btn btn-primary block">Tambah Data</button>
                </div> -->
                <table id="datatablesSimple">
                    <thead class="text-center">
                        <tr>
                            <td>ID Propsal</td>
                            <td>Tanggal Diajukan</td>
                            <!-- <td>pelatihan_ke</td> -->
                            <td>Status at HR</td>
                            <td>Status at HC</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tfoot class="text-center">
                        <tr>
                            <td>ID Propsal</td>
                            <td>Tanggal Diajukan</td>
                            <!-- <td>pelatihan_ke</td> -->
                            <td>Status at HR</td>
                            <td>Status at HC</td>
                            <td>Actions</td>
                        </tr>
                    </tfoot>
                    <tbody class="text-center">
                        <?php 

                        // switch($access){
                        //     case 'Manager' :
                        //         $actionManager = "";
                        //         $actionHC = "hidden";
                        //         $actionHR = "hidden";
                        //     break;
                        //     case 'HC' :
                        //         $actionManager = "hidden";
                        //         $actionHC = "";
                        //         $actionHR = "hidden";
                        //     break;

                        // }

                        if ($_SESSION['access_level'] == "Manager"){
                            $actionManager = "";
                            $actionHC = "hidden = true";
                            $actionHR = "hidden = true";
                        }
                        else if ($_SESSION['access_level'] == "HR"){
                            $actionManager = "hidden = true";
                            $actionHC = "hidden = true";
                            $actionHR = "";
                        }
                        else if ($_SESSION['access_level'] == "HC"){
                            $actionManager = "hidden = true";
                            $actionHC = "";
                            $actionHR = "hidden = true";
                        }
                        else if ($_SESSION['access_level'] == "Employee"){
                            $actionManager = "hidden = true";
                            $actionHC = "hidden = true";
                            $actionHR = "hidden = true";
                        }

                        do { ?>
                            <tr>
                                <td width='10%'><?php echo $row_proposal['id_proposal']; ?></td>
                                <td width='20%'><?php echo $row_proposal['tanggal_dikirim']; ?></td>
                                <!-- <td><?php //echo $row_proposal['pelatihan_ke']; ?></td> -->
                                <td width='20%'><?php echo $row_proposal['approvedby_HRD']; ?></td>
                                <td width='20%'><?php echo $row_proposal['approvedby_HC']; ?></td>
                                <td>
                                    <div>
                                        <a class="btn btn-success m-1" href="test.php?index_proposal=<?php echo $row_proposal['pelatihan_ke']; ?>"><i class="far fa-clipboard"></i>Detail</a>
                                        <a class="btn btn-secondary m-1" href="#"><i class="far fa-user"></i></a>
                                        
                                        <span <?php echo $actionManager?>>
                                            <a class="btn btn-primary m-1" href="#"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-danger m-1" href="#"><i class="far fa-trash-alt"></i></a>
                                        </span>
                                        
                                        <span <?php echo $actionHR?>>
                                            <a class="btn btn-success m-1" href="#"><i class="far fa-check-circle"></i></a>
                                            <a class="btn btn-danger m-1" href="#"><i class="far fa-times-circle"></i></a>
                                        </span>
                                        
                                        <span <?php echo $actionHC?>>
                                            <a class="btn btn-success m-1" href="#"><i class="far fa-check-circle"></i></a>
                                            <a class="btn btn-danger m-1" href="#"><i class="far fa-times-circle"></i></a>
                                        </span>     
                                    </div>            
                                </td>
                            </tr>
                        <?php } while ($row_proposal = mysql_fetch_assoc($proposal)); ?>
                    </tbody>
                </table>
                <div class="d-grid gap-2 pt-3">
                    <a class="btn btn-primary block" href="../DOM/dashboard.php?page=tambah_karyawan">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>

<?php mysql_free_result($proposal);?>