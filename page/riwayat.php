<?php
include 'config.php';
include 'authcheck.php';
session_start();
$view = $dbconnect->query('SELECT * FROM transaksi');
// return var_dump($view);
?>

<html>
<head>
  		<title>Riwayat Transaksi</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Toko Momsky</title>
		<link rel="stylesheet" href="asset/css/style.css">
		<!-- Bootstrap -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" ></script>
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"/>
		<!-- data table -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" />
		<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
		<!-- css -->
        <link rel="stylesheet" href="asset/css/style.css">
</head>
<body style="background: #ededed;">

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
    <h1 style="margin-bottom: 0.5em;">Riwayat Transaksi</h1>
	<hr width="50%" style="margin-bottom: 0;">
	<table class="table table-bordered" id="tbl" width="100%">
		<thead class="table-light">
			<tr >
				<th>Nomor</th>
				<th>Tanggal</th>
				<th>Total</th>
				<th>Kasir</th>
				<th>Struk</th>
			</tr>
		</thead>
		<?php
        while ($row = $view->fetch_array()) { ?>
		<tr>
			<td> <?= $row['nomor'] ?> </td>
			<td><?= $row['tanggal_waktu'] ?></td>
			<td><?=$row['total']?></td>
			<td><?=$row['nama']?></td>
			<td>
                <a href="unduh_struk.php?idtrx=<?=$row['id_transaksi']?>" class="btn btn-primary">Lihat</a>
			</td>
		</tr>
		<?php } ?>
	</table>
	</div>
</div>
<!-- fungsi -->
<script>
$(document).ready(function () {
    $('#tbl').DataTable();
});
</script>

</body>
</html>