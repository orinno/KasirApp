
<?php
ob_start();
include '../config.php';
session_start();
include '../authcheckkasir.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($dbconnect, "DELETE FROM `barang` WHERE id_barang='$id' ");

    $_SESSION['success'] = 'Berhasil menghapus data';

    header("Location: kasir.php?page2=barang");
}

?>