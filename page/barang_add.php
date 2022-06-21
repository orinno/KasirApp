<?php
include 'authcheck.php';
if (isset($_POST['simpan'])) {
    // echo var_dump($_POST);
		$nama = $_POST['nama'];
		$satuan = $_POST['satuan'];
		$kode_barang = $_POST['kode_barang'];
		$harga = $_POST['harga'];
		$jumlah = $_POST['jumlah'];
    // Menyimpan ke database;
    mysqli_query($dbconnect, "INSERT INTO barang VALUES (NULL,'$nama','$satuan', '$harga','$jumlah','$kode_barang')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

    // mengalihkan halaman ke list barang
	echo "<script>window.location.href='index.php?page=barang';</script>";
    // header('location: index.php?page=barang');
} 
?>

<div class="container">
	<div class="page-box">
		<form method="post">
			<h1>Tambah Barang</h1>
			<hr style="margin-bottom: 1em;">
			<div class="form-group">
				<label class="fw-bold">Kode Barang</label>
				<input type="text" name="kode_barang" class="form-control p-2" placeholder="Kode barang">
			</div>
			<div class="form-group">
				<label class="fw-bold">Nama Barang</label>
				<input type="text" name="nama" class="form-control p-2" placeholder="Nama barang">
			</div>
			<div class="form-group">
				<label class="fw-bold">Satuan</label>
				<input type="text" name="satuan" class="form-control p-2" placeholder="Satuan Berat">
			</div>
			<div class="form-group">
				<label class="fw-bold">Harga</label>
				<input type="number" name="harga" class="form-control p-2" placeholder="Harga Barang">
			</div>
			<div class="form-group">
				<label class="fw-bold">Jumlah Stock</label>
				<input type="number" name="jumlah" class="form-control p-2" placeholder="Jumlah Stock">
			</div>
			<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
			<a href="?page=barang" style="text-decoration: none;" class="btn btn-warning text-a">Kembali</a>
		</form>
	</div>
</div>


