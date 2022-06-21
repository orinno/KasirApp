<?php
include 'config.php';
session_start();
include 'authcheckkasir.php';

if (isset($_POST['kode_barang'])) {
    $kode_barang = $_POST['kode_barang'];
    $qty = 1;

    //jika kode barang yang dikirimkan tidak ada di database
    if (!mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM barang WHERE kode_barang='$kode_barang'"))) {
        $_SESSION['danger'] = 'Kode barang tidak ditemukan';
        //keranjang tidak diupdate karena kode barang tidak ditemukan
        header('Location: kasir.php?page2=transaksi');
        exit;
    }

    // jika kode barang yang diinputkan, stok barang stok barang kosong (0) maka tidak dapat ditambahkan ke keranjang
    $q = mysqli_query($dbconnect, "SELECT * FROM barang WHERE kode_barang='$kode_barang'");
    $d = mysqli_fetch_array($q);
    if ($d['jumlah'] == 0) {
        $_SESSION['danger'] = 'Stok barang kosong';
        header('Location: kasir.php?page2=transaksi');
        exit;
    }

    // //kalo jumlah beli lebih dari stok barang yang ada, qty di set ke jumlah maksimum stok barang
    // if ($qty > $d['jumlah']) {
    //     $qty = $d['jumlah'];
    // }

    //menampilkan data barang
    $data = mysqli_query($dbconnect, "SELECT * FROM barang WHERE kode_barang='$kode_barang'");
    $b = mysqli_fetch_assoc($data);

    //cek diskon barang
    $disbarang = mysqli_query($dbconnect, "SELECT * FROM disbarang WHERE barang_id='$b[id_barang]'");
    $disb = mysqli_fetch_assoc($disbarang);

    $key = array_search($b['kode_barang'], array($_SESSION['cart'], 'id'));
    //cek jika di keranjang sudah ada barang yang masuk
	// return var_dump($key);

    if ($key !== false) {
        // return var_dump($_SESSION['cart']);

        //jika ada data yang sesuai di keranjang akan ditambahkan jumlah nya
        $c_qty = $_SESSION['cart'][$key]['qty'];
        $_SESSION['cart'][$key]['qty'] = $c_qty + 1;

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
    } else {
        // return var_dump($b);
        //Jika tidak ada yang sesuai akan menjadi barang baru dikeranjang
        $barang = [
            'id' => $b['id_barang'],
            'nama' => $b['nama'],
            'satuan' => $b['satuan'],
            'harga' => $b['harga'],
            'qty' => $qty,
            'diskon' => 0,
        ];

        $_SESSION['cart'][] = $barang;

        //merubah urutan tampil pada keranjang
        // krsort($_SESSION['cart']);
    }

    header('location:kasir.php');
}
