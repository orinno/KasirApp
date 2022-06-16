
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
    <h1>Tambah Diskon Barang</h1>
    <form method="post">
      <div class="form-group">
        <label>Barang Yang Di Diskon</label>
        <select name="barang_id" id="" class="form-control">
          <?php while ($row = $view->fetch_array()): ?>
              <option value="<?=$row['id_barang']?>"><?=$row['nama']?></option>
          <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group">
        <label>Qty Min Potongan</label>
        <input type="text" name="qty" class="form-control" placeholder="Batas Nominal">
        </div>
        <div class="form-group">
        <label>Potongan</label>
        <input type="text" name="potongan" class="form-control" placeholder="Jumlah Potongan">
      </div>
      <input type="submit" name="simpan" value="Simpan" class="btn-biru">
      <a href="?page2=dis_barang" class="btn-biru">Kembali</a>
    </form>
  </div>
</div>