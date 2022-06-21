<?php
ob_start();
include '../config.php';
session_start();
include '../authcheckkasir.php';

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	mysqli_query($dbconnect, "DELETE FROM `disbarang` WHERE id='$id' ");

	$_SESSION['success'] = 'Berhasil menghapus data';

	echo "<script>window.location.href='index.php?page=disbarang';</script>";
}
?>