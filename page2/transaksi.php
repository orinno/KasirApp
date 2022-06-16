<?php
include 'authcheckkasir.php';
include 'config.php';

$barang = mysqli_query($dbconnect, 'SELECT * FROM barang AND disbarang');
// print_r($_SESSION);

$sum = 0;
$kembalian = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += ($value['harga'] * $value['qty']) - $value['diskon'];
    }
}
	$total = $_POST['total'];
	$bayar = $_POST['bayar'];
	$kembalian = $total - $bayar;
?>

<div class="container">
	<!-- bayar dan total -->
	<div class="page-box">
		<div class="row">
			<div class="col-lg-6">
				<form action="transaksi_act.php" name="autoSumForm" method="POST">
					<input type="hidden" name="total" value="<?=$sum?>">
					<div class="form-group">
						<label style="font-size: 20px;">Bayar :</label>
						<input type="text" id="bayar" name="bayar" class="form-control txt-input">
					</div>
					<button type="submit" class="btn-sm btn-biru">Selesai</button>
				</form>
			</div>
			<div class="col-lg-6">
				<form action="" name="autoSumForm">
				<div class="form-group">
					<label style="font-size: 20px; padding-bottom: 0.5em;">Total :</label>
					<h1 class="total"><?=number_format($sum)?></h1>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- tabel  -->
	<div class="page-box">
		<div class="row">
			<div class="col-lg-12">
				<form method="post" action="keranjang_act.php">
					<div class="form-group">
						<input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang" autofocus>
					</div>
					<a href="keranjang_reset.php" class="btn-sm btn-biru">Reset Keranjang</a><br><br>
				</form>
			</div>
			<!-- <div class="col-lg-4">
				<input type="text" style="width: 150px;" readonly="readonly" class="form-control" value="<?php echo date("j F Y");?>">
			</div> -->
		</div>
		<br>
		<form method="post" action="keranjang_update.php">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<tr class="table-light">
					<th>Nama</th>
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
							<?php if ($value['diskon'] > 0): ?>
								<br><small class="label label-danger">Diskon <?=number_format($value['diskon'])?></small>
							<?php endif;?>
						</td>
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
		background-color: #ededed;
		text-align: right;
		border-radius: 10px;
		font-weight: 600;
		color: #c00808;
		font-size: 3em;
		border: none;
	}
	.txt-input{
		font-weight: 600;
		background-color: #ededed;
	}
	.table{
		margin-top: -1.5em;
	}
	.form-group input{
		background: #f2f2f2;
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
