<?php
include 'authcheck.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //menampilkan data berdasarkan ID
    $data = mysqli_query($dbconnect, "SELECT * FROM barang where id_barang='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];

    $nama = $_POST['nama'];
	$satuan = $_POST['satuan'];
    $kode_barang = $_POST['kode_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Menyimpan ke database;
    mysqli_query($dbconnect, "UPDATE barang SET nama='$nama', satuan='$satuan', harga='$harga', jumlah='$jumlah', kode_barang='$kode_barang' where id_barang='$id' ");

    $_SESSION['success'] = 'Berhasil memperbaruhi data';

    // mengalihkan halaman ke list barang
    echo "<script>window.location.href='index.php?page=barang';</script>";
}
?>

<div class="container">
	<div class="page-box">
	<form method="post">
		<h1>Edit Barang</h1>
		<hr style="margin-bottom: 1em;">
		<div class="form-group">
			<label class="fw-bold">Kode Barang</label>
			<input type="text" name="kode_barang" class="form-control p-2" placeholder="Kode barang" value="<?=$data['kode_barang']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Nama Barang</label>
			<input type="text" name="nama" class="form-control p-2" placeholder="Nama barang" value="<?=$data['nama']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Satuan/Berat</label>
			<input type="text" name="satuan" class="form-control p-2" placeholder="Satuan / Berat" value="<?=$data['satuan']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Harga</label>
			<input type="number" name="harga" class="form-control p-2" placeholder="Harga Barang" value="<?=$data['harga']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Jumlah Stock</label>
			<input type="number" name="jumlah" class="form-control p-2" placeholder="Jumlah Stock" value="<?=$data['jumlah']?>">
		</div>
		<input type="submit" name="update" value="Perbaruhi" class="btn btn-success">
		<a href="index.php?page=barang" class="btn btn-warning">Kembali</a>
	</form>
	</div>
</div>