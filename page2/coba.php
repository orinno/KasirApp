<?php 

include '../config.php';
session_start();
// menampilkan data dari tabel barang ke tabel dari kode_barang
$data = mysqli_query($dbconnect, "SELECT * FROM barang");
$b = mysqli_fetch_assoc($data);

// create array barang
$barang = [
	'id' => $b['id_barang'],
	'nama' => $b['nama'],
	'satuan' => $b['satuan'],
	'jumlah' => $b['jumlah']
];

?>

<html>
<head></head>
<body>
	

<div class="container">
	<table>
		<thead>
			<tr>
				<th>Nama Barang</th>
				<th>Satuan</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $barang['nama']; ?></td>
				<td><?php echo $barang['satuan']; ?></td>
				<td><?php echo $barang['jumlah']; ?></td>
			</tr>
		</tbody>
	</table>
</div>


</body>
</html>