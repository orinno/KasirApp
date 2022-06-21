<?php
include 'authcheck.php';
$view = $dbconnect->query("SELECT * FROM barang");

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	//menampilkan data berdasarkan ID
	$data = mysqli_query($dbconnect, "SELECT * FROM disbarang where id='$id'");
	$data = mysqli_fetch_assoc($data);
}

if(isset($_POST['update']))
{
	$id = $_GET['id'];

    $barang_id = $_POST['barang_id'];
	$qty = $_POST['qty'];
	$potongan = $_POST['potongan'];

	// Menyimpan ke database;
	mysqli_query($dbconnect, "UPDATE disbarang SET barang_id='$barang_id', qty='$qty', potongan='$potongan' where id='$id' ");

	$_SESSION['success'] = 'Berhasil memperbaruhi data';

	// mengalihkan halaman ke list barang
	echo "<script>window.location.href='index.php?page=disbarang';</script>";
}
?>

<div class="container">
	<div class="page-box">
		<h1>Tambah Diskon</h1><br>
		<form method="post">

		<div class="form-group">
			<label class="fw-bold">Barang yang di diskon</label>
			<select name="barang_id" id="" class="form-control">
			<?php while ($row = $view->fetch_array()): ?>
				<option value="<?=$row['id_barang']?>" <?=$data['barang_id']==$row['id_barang']?'selected':''?> ><?=$row['nama']?></option>
			<?php endwhile; ?>
			</select>
		</div>

		<div class="form-group">
			<label class="fw-bold">Batas Nominal Qty</label>
			<input type="text" name="qty" class="form-control" placeholder="Batas Nominal" value="<?=$data['qty']?>">
		</div>

		<div class="form-group">
			<label class="fw-bold">Jumlah Potongan</label>
			<input type="text" name="potongan" class="form-control" placeholder="Jumlah Potongan" value="<?=$data['potongan']?>">
		</div>

		<input type="submit" name="update" value="Update" class="btn btn-success">
		<a href="?page=dis_barang" class="btn btn-warning">Kembali</a>
		</form>
	</div>
</div>