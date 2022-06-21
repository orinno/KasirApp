<?php
include 'authcheckkasir.php';
$view = $dbconnect->query('SELECT * FROM barang');
?>

<html>
<head>
  <title>Barang</title>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
        <!-- button bootstrap -->
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" />
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
        <!-- button -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

		<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
		
		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" />
		<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

        <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>

<div class="container">
    <div class="page-box">
		
		<h1 style="margin-bottom: 0.5em;">List Barang</h1>
		<a href="kasir.php?page2=barang_add" class="btn btn-success">Tambah data</a>
		<a href="barang_cetak_barcode.php"  class="btn btn-primary">Cetak Barcode</a>
		<hr style="margin-bottom: 1em;">
		
		<?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') {?>
			<div class="alert alert-success" role="alert">
				<?=$_SESSION['success']?>
			</div>
		<?php
		}
		$_SESSION['success'] = '';
		?>

		<!-- alert stok barang kosong -->
		<?php 
			$ambildatastok = mysqli_query($dbconnect, "SELECT * FROM barang WHERE jumlah < 1");

			while ($fetch=mysqli_fetch_array($ambildatastok)) {
				$barang = $fetch['nama'];
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Perhatian!</strong> stok <?=$barang?> telah kosong.
			<button type="button" style="padding: 12px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php } ?>

		<!-- datatable -->
		<div class="data-tables datatable-dark">
            <table class="table table-bordered" width="100%" cellspacing="0" id="tbl">
				<thead class="table-light">
					<tr>
						<th>Kode</th>
						<th>Nama</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th width="150">Jumlah Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<?php

				while ($row = $view->fetch_array()) { ?>
				
				<tr>
					<td> <?= $row['kode_barang'] ?> </td>
					<td><?= $row['nama'] ?></td>
					<td><?= $row['satuan'] ?></td>
					<td><?=$row['harga']?></td>
					<td><?=$row['jumlah']?></td>
					<td>
						<a href="kasir.php?page2=barang_edit&id=<?= $row['id_barang'] ?>"><i class="far fa-edit"></i></a> |
						<a href="kasir.php?page2=barang_hapus&id=<?= $row['id_barang'] ?>" 
							onclick="javascript:return confirm('Hapus Data barang ?')">
							<i class="far fa-trash-alt"></i>
						</a>
					</td>
				</tr>

				<?php }
				?>     
				
            </table>           
        </div>
		<!-- end datatable -->
    </div>
</div>

<!-- script dataTable -->
<script>
$(document).ready(function () {
    $('#tbl').DataTable();
});
</script>

</body>
</html>