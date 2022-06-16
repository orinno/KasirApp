
<?php
include 'authcheckkasir.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //menampilkan data berdasarkan ID
    $data = mysqli_query($dbconnect, "SELECT * FROM barang where id_barang='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];

    $nama = $_POST['nama'];
    $kode_barang = $_POST['kode_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Menyimpan ke database;
    mysqli_query($dbconnect, "UPDATE barang SET nama='$nama', harga='$harga', jumlah='$jumlah', kode_barang='$kode_barang' where id_barang='$id' ");

    $_SESSION['success'] = 'Berhasil memperbaruhi data';

    // mengalihkan halaman ke list barang
    header('location: kasir.php?page2=barang');
}

?>

<div class="container">
	<div class="page-box">
	<form method="post">
	<h1>Edit Barang</h1>
	  <div class="form-group">
	    <label>Nama Barang</label>
	    <input type="text" name="nama" class="form-control" placeholder="Nama barang" value="<?=$data['nama']?>">
	  </div>
	  <div class="form-group">
	    <label>Kode Barang</label>
	    <input type="text" name="kode_barang" class="form-control" placeholder="Kode barang" value="<?=$data['kode_barang']?>">
	  </div>
	  <div class="form-group">
	    <label>Harga</label>
	    <input type="number" name="harga" class="form-control" placeholder="Harga Barang" value="<?=$data['harga']?>">
	  </div>
	  <div class="form-group">
	    <label>Jumlah Stock</label>
	    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock" value="<?=$data['jumlah']?>">
	  </div>
  	<input type="submit" name="update" value="Perbaruhi" class="btn-biru">
  	<a href="kasir.php?page2=barang" class="btn-biru">Kembali</a>
	</form>
	</div>
</div>