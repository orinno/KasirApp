<?php
include 'config.php';
include 'authcheck.php';
?>
<html>
<head>
  <title>Laporan</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- DATATABLE -->
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
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
		
		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" />
		<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="/asset/css/style.css">
</head>

<body>

<div class="container">
    <div class="page-box">
        <div class="data-tables datatable-dark">
            <!-- Masukkan table nya disini, dimulai dari tag TABLE -->
            <table class="table table-bordered" width="100%" cellspacing="0" id="tblLaporan">
                <h1 style="margin-bottom: -1em;">Laporan Penjualan</h1>
                
                <div class="form-group" style="margin-top: 4em; margin-bottom: -3em; display: inline-flex; margin-left: -0.5em;">
                    <form action="" method="post">
                        <input type="date" name="tglAwal" class="form-control mx-sm-2"> 
                        <label class="p-2">s/d</label>
                        <input type="date" name="tglAkhir" class="form-control ms-sm-2">
                        <button type="submit" name="cari" class="btn btn-primary mx-sm-3">Cari</button>
                    </form>
                </div>

                <style>div.dataTables_wrapper div.dataTables_filter{display: none;}</style>

                <thead class="table-light">
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Tanggal</th>
                        <th>No.Transaksi</th>
                        <th>Total</th>
                        <th>Kasir</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        // jika tombol cari diklik, data yang dicari akan ditampilkan pada tabel berikut ini 
                        if(isset($_POST['cari'])){
                            $tglAwal = $_POST['tglAwal'];
                            $tglAkhir = $_POST['tglAkhir'];

                            if ($tglAwal != null || $tglAkhir != null) {
                                $query = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE tanggal_waktu 
                                BETWEEN '$tglAwal' AND DATE_ADD('$tglAkhir',INTERVAL 1 DAY)");
                            }else{
                                $query = mysqli_query($dbconnect, "select * from transaksi");
                            }
                        }
                        // jika tidak ada tombol cari yang diklik, maka data yang ada akan ditampilkan pada tabel berikut ini
                        else{
                            $query = mysqli_query($dbconnect, "select * from transaksi");
                        }

                        // $query = mysqli_query($dbconnect, "select * from transaksi");
                        while($data = mysqli_fetch_array($query)){
                            // $id = $data['id_transaksi'];
                            $tgl = $data['tanggal_waktu'];
                            $nomor = $data['nomor'];
                            $total = $data['total'];
                            $kasir = $data['nama'];
                            $cash = $data['bayar'];
                            $kembalian = $data['kembali'];
                    ?>
                    <tr>
                        <!-- <td><?php echo $id ?></td> -->
                        <td><?php echo $tgl ?></td>
                        <td><?php echo $nomor ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $kasir ?></td>
                        <td><?php echo $cash ?></td>
                        <td><?php echo $kembalian ?></td>
                    </tr>

                    <?php
                        }	
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- FUNGSI BUTTON PRINT DLL -->
<script>
$(document).ready(function() {
    $('#tblLaporan').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                // title dengan range tanggal tgl awal sampai tgl akhir diambil dari inputan form 
                title: 'Laporan Penjualan - <?php echo $tglAwal . " s/d " . $tglAkhir ?>'
            },
            {
                extend: 'pdf',
                messageTop: 'Laporan Penjualan',
                // title dengan tanggal yang di inputkan
                title: 'Laporan Penjualan - <?php echo $tglAwal . " s/d " . $tglAkhir ?>'
            },
            {
                extend: 'print',
                title: 'Laporan Penjualan',
                messageTop: 'Laporan Penjualan - <?php echo $tglAwal . " s/d " . $tglAkhir ?>'
            }
        ]
    } );
} );
</script>
<script>
    var tglawal = document.getElementById("tglAwal").value ;
    var tglakhir = document.getElementById("tglAkhir").value ;
</script>
</body>
</html>