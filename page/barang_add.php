
<?php
include 'authcheck.php';

if (isset($_POST['simpan'])) {
    // echo var_dump($_POST);
    $nama = $_POST['nama'];
    $kode_barang = $_POST['kode_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Menyimpan ke database;
    mysqli_query($dbconnect, "INSERT INTO barang VALUES (NULL,'$nama','$harga','$jumlah','$kode_barang')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

    // mengalihkan halaman ke list barang
    header('location: index.php?page=barang');
}

?>
<div class="container">
	<div class="page-box">
		<form method="post">
		<h1>Tambah Barang</h1>
		<div class="form-group">
			<label>Nama Barang</label>
			<input type="text" name="nama" class="form-control" placeholder="Nama barang">
		</div>
		<div class="form-group">
			<label>Kode Barang</label>
			<input type="text" name="kode_barang" class="form-control" placeholder="Kode barang">
		</div>
		<div class="form-group">
			<label>Harga</label>
			<input type="number" name="harga" class="form-control" placeholder="Harga Barang">
		</div>
		<div class="form-group">
			<label>Jumlah Stock</label>
			<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Stock">
		</div>
			<input type="submit" name="simpan" value="Simpan" class="btn-biru">
			<a href="?page=barang" style="text-decoration: none;" class="btn-biru text-a">Kembali</a>
		</form>
	</div>
</div>