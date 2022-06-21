<?php
include 'authcheck.php';
$role = mysqli_query($dbconnect,"SELECT * FROM role");

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	//menampilkan data berdasarkan ID
	$data = mysqli_query($dbconnect, "SELECT * FROM user where id_user='$id'");
	$data = mysqli_fetch_assoc($data);
}

if(isset($_POST['updateBrg']))
{
	$id = $_GET['id'];

	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role_id = $_POST['role_id'];

	// Menyimpan ke database;
	mysqli_query($dbconnect, "UPDATE user SET nama='$nama', username='$username', password='$password', role_id=$role_id where id_user='$id' ");

	$_SESSION['success'] = 'Berhasil memperbaruhi data';

	// mengalihkan halaman ke list barang
	echo "<script>window.location.href='index.php?page=user';</script>";
	// header('location: index.php?page=user');
}
?>

<div class="container">
	<div class="page-box">
	<h1>Edit User</h1>
		<form method="post">
		<div class="form-group">
			<label class="fw-bold">Nama</label>
			<input type="text" name="nama" class="form-control p-2" placeholder="Nama User" value="<?=$data['nama']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Username</label>
			<input type="text" name="username" class="form-control p-2" placeholder="Username" value="<?=$data['username']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Password</label>
			<input type="text" name="password" class="form-control p-2" placeholder="Password" value="<?=$data['password']?>">
		</div>
		<div class="form-group">
			<label class="fw-bold">Role Akses</label>
			<select class="form-control" name="role_id">
				<option value="">Pilih Role Akses</option>

			<?php while($row = mysqli_fetch_array($role)){?>

				<option value="<?=$row['id_role']?>" <?=$row['id_role']==$data['role_id']?'selected':''?> ><?=$row['nama']?></option>

			<?php } ?>
			</select>
		</div>
		<input type="submit" name="updateBrg" value="Perbaruhi" class="btn bnt-primary">
		<a href="?page=user" class="btn btn-warning">Kembali</a>
		</form>
	</div>
</div>