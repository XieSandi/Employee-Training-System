<?php
require_once('../Connections/connection.php');
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
 
$query = mysql_query("select * from karyawan where username='$username' and password='$password'");
$cek = mysql_num_rows($query);

 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysql_fetch_assoc($query);
	
	echo $data['username'];
 	echo $data['access_level'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['nama'] = $data['nama'];
	
	// cek level akses
	if($data['access_level']=="Manager"){
		$_SESSION['access_level'] = "Manager";
			header("location:dashboard.php");
			echo("<script>console.log('anda manager , ini log nya');</script>");
	}
	else if($data['access_level']=="Employee"){
		$_SESSION['access_level'] = "Employee";
			header("location:dashboard.php");
			echo("<script>console.log('anda employee , ini log nya');</script>");
	}
	else{
		header("location:../index.php?pesan=gagal");
	}	
}else{
	header("location:../index.php?pesan=gagal");
}
?>