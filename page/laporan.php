<?php
//import koneksi ke database
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
                        <h1 style="margin-bottom: -1em;">Laporan Penjualan</h1><br>
				        <thead class="table-light">
					        <tr>
                                <th>ID</th>
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
                                $query = mysqli_query($dbconnect, "select * from transaksi");
                                while($data = mysqli_fetch_array($query)){
                                    $id = $data['id_transaksi'];
                                    $tgl = $data['tanggal_waktu'];
                                    $nomor = $data['nomor'];
                                    $total = $data['total'];
                                    $kasir = $data['nama'];
                                    $cash = $data['bayar'];
                                    $kembalian = $data['kembali'];
                               
                            ?>
                                <tr>
                                    <td><?php echo $id ?></td>
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
            'copy','excel', 'pdf', 'print'
        ]
    } );
} );
</script>
</body>
</html>