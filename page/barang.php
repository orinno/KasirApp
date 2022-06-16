<?php
include 'authcheck.php';
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
		<?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') {?>
			<div class="alert alert-success" role="alert">
				<?=$_SESSION['success']?>
			</div>
		<?php
		}
		$_SESSION['success'] = '';
		?>
		<h1 style="margin-bottom: 0.5em;">List Barang</h1>
		<a href="index.php?page=barang_add" class="btn-sm btn-biru">Tambah data</a>
		<a href="barang_cetak_barcode.php"  class="btn-sm btn-biru">Cetak Barcode</a>
		<hr width="30%" style="margin-bottom: 0;">
		<div class="data-tables datatable-dark">
			<!-- Masukkan table nya disini, dimulai dari tag TABLE -->
            <table class="table table-bordered" width="100%" cellspacing="0" id="tbl">
				<thead class="table-light">
					<tr>
						<th width="15%">ID Barang</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Harga</th>
						<th width="150">Jumlah Stok</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<?php

				while ($row = $view->fetch_array()) { ?>
				
				<tr>
					<td> <?= $row['id_barang'] ?> </td>
					<td> <?= $row['kode_barang'] ?> </td>
					<td><?= $row['nama'] ?></td>
					<td><?=$row['harga']?></td>
					<td><?=$row['jumlah']?></td>
					<td>
						<a href="index.php?page=barang_edit&id=<?= $row['id_barang'] ?>"><i class="far fa-edit"></i></a> |
						<a href="index.php?page=barang_hapus&id=<?= $row['id_barang'] ?>" 
							onclick="javascript:return confirm('Hapus Data barang ?')">
							<i class="far fa-trash-alt"></i>
						</a>
					</td>
				</tr>

				<?php }
				?>     
				
            </table>           
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#tbl').DataTable();
});
</script>
</body>
</html>