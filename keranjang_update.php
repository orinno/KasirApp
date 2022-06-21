<?php
include 'config.php';
session_start();
include 'authcheckkasir.php';

$qty = $_POST['qty'];
$cart = $_SESSION['cart'];




// print_r($qty);

foreach ($cart as $key => $value) {
    $_SESSION['cart'][$key]['qty'] = $qty[$key];

    $idbarang = $_SESSION['cart'][$key]['id'];
    //cek diskon barang
    $disbarang = mysqli_query($dbconnect, "SELECT * FROM disbarang WHERE barang_id='$idbarang'");
    $disb = mysqli_fetch_assoc($disbarang);

    //cek jika di keranjang sudah ada barang yang masuk
    $key = array_search($idbarang, array_column($_SESSION['cart'], 'id'));
    // return var_dump($key);
    if ($key !== false) {
        // return var_dump($_SESSION['cart']);

        //cek jika ada potongan dan cek jumlah barang lebih besar sama dengan minimum order potongan
        if ($disb['qty'] && $_SESSION['cart'][$key]['qty'] >= $disb['qty']) {

            //cek kelipatan jumlah barang dengan batas minimum order
            $mod = $_SESSION['cart'][$key]['qty'] % $disb['qty'];

            if ($mod == 0) {

                //Jika benar jumlah barang kelipatan batas minimum order
                $d = $_SESSION['cart'][$key]['qty'] / $disb['qty'];
            } else {

                //Simpan jumlah potongan yang didapat
                $d = ($_SESSION['cart'][$key]['qty'] - $mod) / $disb['qty'];
            }

            //Simpan diskon dengan jumlah kelipatan dikali potongan barang
            $_SESSION['cart'][$key]['diskon'] = $d * $disb['potongan'];
        }
    }
    
    // mengurangi stok barang dengan jumlah yang dibeli 
    // foreach ($cart as $key => $value) {
    //     $id = $value['id'];
    //     $stok = $_SESSION['cart'][$key]['qty'];
    //     $stok_barang = mysqli_query($dbconnect, "SELECT * FROM barang WHERE id_barang='$id'");
    //     $s = mysqli_fetch_assoc($stok_barang);
    //     $stok_barang = $s['jumlah'];
    //     $stok_barang = $stok_barang - $stok;
    //     if ($stok_barang < 0) {
    //         $stok_barang = 0;
    //     }
    //     mysqli_query($dbconnect, "UPDATE barang SET jumlah='$stok_barang' WHERE id_barang='$id'");
    // }

    //mengurangi stok barang dengan jumlah barang yang keluar
    // $stok_barang = mysqli_query($dbconnect, "SELECT * FROM barang WHERE id_barang='$idbarang'");
    // $s = mysqli_fetch_assoc($stok_barang);
    // $qty = $value['qty'];
    // $stok_barang = $s['jumlah'];
    // $stok_barang = $stok_barang - $qty;
    // if ($stok_barang < 0) {
    //     $stok_barang = 0;
    // }
    // mysqli_query($dbconnect, "UPDATE barang SET jumlah='$stok_barang' WHERE id_barang='$idbarang'");



}
header('location:kasir.php');