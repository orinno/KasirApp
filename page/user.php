<?php
include 'authcheck.php';
$view = $dbconnect->query("SELECT u.*,r.nama as nama_role FROM user as u INNER JOIN role as r ON u.role_id=r.id_role");
?>

<html>
<head>
  <title>User</title>
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
		<?php if(isset($_SESSION['success']) && $_SESSION['success'] != '') {?>
			<div class="alert alert-success" role="alert">
				<?=$_SESSION['success']?>
			</div>
		<?php
			}
			$_SESSION['success'] = '';
		?>
		<h1 style="margin-bottom: 0.5em;">List User</h1>
		<a href="index.php?page=user_add" class="btn-sm btn-biru">Tambah data</a><br>
		<hr width="30%" style="margin-bottom: 0;">
		<table class="table table-bordered" width="100%" cellspacing="0" id="tbl">
			<thead class="table-light">
				<tr>
					<th>ID User</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Password</th>
					<th>Role Akses</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<?php
			while ($row = $view->fetch_array()) { ?>
			<tr>
				<td> <?= $row['id_user'] ?> </td>
				<td><?= $row['nama'] ?></td>
				<td><?=$row['username']?></td>
				<td><?=$row['password']?></td>
				<td><?=$row['nama_role']?></td>
				<td>
					<a href="index.php?page=user_edit&id=<?= $row['id_user'] ?>"><i class="far fa-edit"></i></a> |
					<a href="index.php?page=user_hapus&id=<?= $row['id_user'] ?>" onclick="return confirm('apakah anda yakin?')">
					<i class="far fa-trash-alt"></i>
					</a>
				</td>
			</tr>
			<?php }
			?>
		</table>
	</div>
	<style>
		a i{
			text-decoration: none;
			color: #333;
		}
		a i:hover{
			color:  #1c3d52;
		}
	</style>
</div>
<!-- fungsi -->
<script>
$(document).ready(function () {
    $('#tbl').DataTable();
});
</script>
</body>
</html>