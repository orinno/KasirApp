<?php
include 'config.php';
session_start();
include "authcheckkasir.php";

//menghilangkan Rp pada nominal
$bayar = preg_replace('/\D/', '', $_POST['bayar']);
// print_r(preg_replace('/\D/', '', $_POST['total']));

// print_r($_SESSION['cart']) ;

// mengurangi stok barang jika transaksi berhasil
foreach ($_SESSION['cart'] as $key => $value) {
	$id = $value['id'];
	$stok = $_SESSION['cart'][$key]['qty'];
	$stok_barang = mysqli_query($dbconnect, "SELECT * FROM barang WHERE id_barang='$id'");
	$s = mysqli_fetch_assoc($stok_barang);
	$stok_barang = $s['jumlah'];
	$stok_barang = $stok_barang - $stok;
	if ($stok_barang < 0) {
		$stok_barang = 0;
	}
	mysqli_query($dbconnect, "UPDATE barang SET jumlah='$stok_barang' WHERE id_barang='$id'");
}

//set zone time to indonesia time
date_default_timezone_set('Asia/Jakarta');

$tanggal_waktu = date('Y-m-d H:i:s');
$nomor = rand(111111,999999);
$total = $_POST['total'];
$nama = $_SESSION['nama'];
$kembali = $bayar - $total;


//insert ke tabel transaksi
mysqli_query($dbconnect, "INSERT INTO transaksi (id_transaksi,tanggal_waktu,nomor,total,nama,bayar,kembali) VALUES (NULL,'$tanggal_waktu','$nomor','$total','$nama','$bayar','$kembali')");

//mendapatkan id transaksi baru
$id_transaksi = mysqli_insert_id($dbconnect);

//insert ke detail transaksi
foreach ($_SESSION['cart'] as $key => $value) {

	$id_barang = $value['id'];
	$harga = $value['harga'];
	$satuan = $value['satuan'];
	$qty = $value['qty'];
	$tot = $harga*$qty;
	$disk = $value['diskon'];

	mysqli_query($dbconnect,"INSERT INTO transaksi_detail (id_transaksi_detail,id_transaksi,id_barang,satuan,harga,qty,total,diskon) VALUES (NULL,'$id_transaksi','$id_barang','$harga','$qty','$tot','$disk')");

	// $sum += $value['harga']*$value['qty'];
}

$_SESSION['cart'] = [];


//redirect ke halaman transaksi selesai
header("location:transaksi_selesai.php?idtrx=".$id_transaksi);



?>