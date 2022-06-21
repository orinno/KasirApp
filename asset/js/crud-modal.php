<script type="text/javascript">
$(document).ready(function(e) {
  //CRUD data-siswa
  $('.tambah-barang').click (function() {
    var kode_barang = $("#kode_barang").val().trim();
    var nama = $("#nama").val().trim();
    var satuan = $("#satuan").val().trim();
    var harga = $("#harga").val().trim();
    var jumlah = $("#jumlah").val().trim();

    if (kode_barang=="") {
      alert("Kode barang tidak boleh kosong");
    }
    else {
      $.ajax({
        type: "POST",
        url: "eks=tambah",
        data: "nis="+nis+"&nama="+nama+"&jk="+jk+"&tmpt_lahir="+tmpt_lahir+"&tgl_lahir="+tgl_lahir+"&alamat="+alamat+"&nama_ayah="+nama_ayah+"&nama_ibu="+nama_ibu,
        success: function (msg) {
        tampil_data_siswa();
        clear_siswa_tambah();
        }
      });
    }
  });
}
);

// $eks = $_GET['eks'];

// if ($eks=="tambah") {
//   $kode_barang = $_GET['kode_barang'];
//   $nama = $_GET['nama'];
//   $satuan = $_GET['satuan'];
//   $harga = $_GET['harga'];
//   $jumlah = $_GET['jumlah'];

//   $sql = "INSERT INTO barang (kode_barang, nama, satuan, harga, jumlah) VALUES ('$kode_barang', '$nama', '$satuan', '$harga', '$jumlah')";
//   $simpan = $dbconnect->prepare($sql);

//   $simpan->bindParam(':kode_barang',$kode_barang);
//   $simpan->bindParam(':nama',$nama);
//   $simpan->bindParam(':satuan',$satuan);
//   $simpan->bindParam(':harga',$harga);
//   $simpan->bindParam(':jumlah',$jumlah);
//   $simpan->execute();
// }
