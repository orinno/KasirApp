<?php
include 'config.php';
include 'authcheckkasir.php';

$barang = mysqli_query($dbconnect, 'SELECT * FROM barang');

// print_r($_SESSION);

$sum = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += ($value['harga'] * $value['qty']) - $value['diskon'];
    }
}
?>

<html>
<body>

<div class="container">
	<h2 style="font-weight: 600; margin-left: 16px;">Transaksi</h2>
	<div class="row">
		<div class="col-lg-3">
			<div class="box" style="padding: 2.1em; border-left: 5px solid #006900">
				<h2>Hai <?=$_SESSION['nama']?></h2>
				<input type="text" style="width: 150px;" readonly="readonly" class="form-control" value="<?php echo date("j F Y");?>">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="box" style="border-left: 5px solid #006900">
				<form action="transaksi_act.php" name="autoSumForm" method="POST">
					<input type="hidden" name="total" value="<?=$sum?>">
					<div class="form-group">
						<label style="font-size: 20px;">Bayar :</label>
						<input type="text" id="bayar" name="bayar" class="form-control txt-input">
					</div>
					<button type="submit" class="btn btn-primary">Selesai</button>
				</form>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="box" style="border-left: 5px solid #006900">
				<form action="">
					<div class="form-group">
						<label style="font-size: 20px; padding-bottom: 0.5em;">Total :</label>
						<h1 class="total"><?=number_format($sum)?></h1>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- tabel  -->
	<div class="page-box" style="margin: 1em 0.3em 1em 0.3em; border-left: 5px solid #006900">
		<div class="row">
			<div class="col-lg-12">
				<form class="row g-3" method="POST" action="keranjang_act.php">
					<div class="col-3">
						<input type="search" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang" autofocus>
					</div>
					<div class="col-auto">
						<a href="keranjang_reset.php" class="btn btn-warning mb-3">Reset</a>
					</div>
				</form>
			</div>
		</div>

		<?php if (isset($_SESSION['danger']) && $_SESSION['danger'] != '') {?>
			<div class="alert alert-danger" role="alert">
				<?=$_SESSION['danger']?>
			</div>
		<?php
		}
		$_SESSION['danger'] = '';
		?>
		<br>

		<form method="post" action="keranjang_update.php">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<tr class="table-light">
					<th>Nama</th>
					<th>Satuan</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
					<th>Hapus</th>
				</tr>
				<?php if (isset($_SESSION['cart'])): ?>
				<?php foreach ($_SESSION['cart'] as $key => $value) { ?>
					<tr>
						<td>
							<?=$value['nama']?>
							<?=$_SESSION['danger']?>
							<?php if ($value['diskon'] > 0): ?>
								<br><small class="label label-danger" style="color: red;">Diskon <?=number_format($value['diskon'])?></small>
							<?php endif;?>
						</td>
						<td><?=$value['satuan']?></td>
						<td align="right"><?=number_format($value['harga'])?></td>
						<td class="col-md-2">
							<input type="number" name="qty[<?=$key?>]" value="<?=$value['qty']?>" class="form-control txt-input">
						</td>
						<td align="right"><?=number_format(($value['qty'] * $value['harga'])-$value['diskon'])?></td>
						<td><a href="keranjang_hapus.php?id=<?=$value['id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
					</tr>
				<?php } ?>
				<?php endif; ?>
			</table>
			<button hidden type="submit">Perbaharui</button>
		</form>
	</div>
<style>
	*{
		font-weight: 600;
		font-size: 18px;
	}
	.total{
		margin: 0;
		padding: 10px;
		background-color: #f6f6f6;
		text-align: right;
		border-radius: 5px;
		font-weight: 600;
		color: #c00808;
		font-size: 3em;
		border: none;
	}
	.txt-input{
		font-weight: 600;
	}
	.table{
		margin-top: -1.5em;
	}
	.form-group input{
		background: #f6f6f6;
	}
	.box{
		display: flow-root;
		margin: none;
	}
</style>
</div>

<script type="text/javascript">

	//inisialisasi inputan
	var bayar = document.getElementById('bayar');

	bayar.addEventListener('keyup', function (e) {
        bayar.value = formatRupiah(this.value, 'Rp. ');
        // harga = cleanRupiah(dengan_rupiah.value);
        // calculate(harga,service.value);
    });

    //generate dari inputan angka menjadi format rupiah

	function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    //generate dari inputan rupiah menjadi angka

    function cleanRupiah(rupiah) {
        var clean = rupiah.replace(/\D/g, '');
        return clean;
        // console.log(clean);
    }
</script>

</body>
</html>
