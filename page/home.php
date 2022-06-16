<?php
include 'authcheck.php';
include 'config.php';
?>

    <div class="container" style="display: flex;">
        <div class="box">
            <h2>Transaksi</h2>
            <h1>
            <?php
            $sql = "SELECT * FROM transaksi";
            if ($result=mysqli_query($dbconnect,$sql)) {
                $rowcount=mysqli_num_rows($result);
                echo ''.$rowcount; 
            }
            ?>
            </h1>
        </div>
        <div class="box">
            <h2>Barang</h2>
            <h1>
                <?php
                $sql = "SELECT * FROM barang";
                if ($result=mysqli_query($dbconnect,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    echo ''.$rowcount; 
                }
                ?>
            </h1>
        </div>
        <div class="box">
            <h2>User</h2>
            <h1>
                <?php 
                $sql = "SELECT * FROM user";
                if ($result=mysqli_query($dbconnect,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    echo ''.$rowcount; 
                }   
                ?>
            </h1>
        </div>
        <div class="box">
            <h2>Pendapatan</h2>
            <h1 class="bayar">
                <?php 
                $sql = "SELECT SUM(total) as `sumtotal` FROM transaksi";
                $result = mysqli_query($dbconnect, $query);
                $data = mysqli_fetch_array($result);
                echo ''.$data['sumtotal'];
                ?>
            </h1>
        </div>
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