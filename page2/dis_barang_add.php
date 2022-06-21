
<?php

include 'authcheckkasir.php';

$view = $dbconnect->query('SELECT * FROM barang');

if (isset($_POST['simpan'])) {
    // return var_dump($_POST);
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    $potongan = $_POST['potongan'];

    // Menyimpan ke database;
    mysqli_query($dbconnect, "INSERT INTO disbarang VALUES (NULL,'$barang_id','$qty','$potongan')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

    // mengalihkan halaman ke list barang
    header('location: kasir.php?page2=dis_barang');
}

?>
<div class="container">
  <div class="page-box">
    <h1>Tambah Diskon Barang</h1><br>

    <form method="post">
      <div class="form-group mb-2">
        <label class="fw-bold">Nama Barang</label>
        <select name="barang_id" id="" class="form-control">
          <!-- select dengan ngambil dari data barang -->
          <?php while ($row = $view->fetch_array()): ?>
              <option value="<?=$row['id_barang']?>"><?=$row['nama']?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group mb-2">
        <label class="fw-bold">Batas Nominal</label>
        <input type="text" name="qty" class="form-control" placeholder="Batas Nominal">
      </div>

      <div class="form-group mb-2">
        <label class="fw-bold">Jumlah Potongan</label>
        <input type="text" name="potongan" class="form-control" placeholder="Jumlah Potongan">
      </div>

      <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
      <a href="?page2=dis_barang" class="btn btn-warning">Kembali</a>
    </form>

  </div>
</div>