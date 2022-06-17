<?php
include 'authcheck.php';
include 'config.php';
error_reporting(0);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box" style="background-image: url('asset/img/dots-pattern-bg.png'); background-size: cover">
                <div class="ihome">
                <i class='bx bx-cart-alt'></i>
                </div>
                <div class="ehome">
                    <h5 class="pb-2">Transaksi Selesai</h5>
                    <h1>
                    <?php
                    $sql = "SELECT * FROM transaksi";
                    if ($result=mysqli_query($dbconnect,$sql)) {
                        $rowcount=mysqli_num_rows($result);
                        echo ''.$rowcount; }
                    ?>
                    </h1>
                    <div class="detail">
                        <h6><a href="index.php?page=riwayat">Detail <i class='bx bx-right-arrow-alt'></i></a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box" style="background-image: url('asset/img/dots-pattern-bg.png'); background-size: cover">
                <div class="ihome">
                <i class='bx bx-package'></i>
                </div>
                <div class="ehome">
                    <h5 class="pb-2">Stok Barang</h5>
                    <h1>
                    <?php
                    $sql = "SELECT SUM(jumlah) as `stok` FROM barang";
                    $result = mysqli_query($dbconnect, $sql);
                    $data = mysqli_fetch_array($result);
                    echo "".number_format($data['stok']);
                    ?>
                    </h1>   
                    <div class="detail">
                        <h6><a href="index.php?page=barang">Detail <i class='bx bx-right-arrow-alt'></i></a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box" style="background-image: url('asset/img/dots-pattern-bg.png'); background-size: cover">
                <div class="ihome">
                <i class='bx bx-user'></i>
                </div>
                <div class="ehome">
                    <h5 class="pb-2">User / Pengguna</h5>
                    <h1>
                    <?php
                    $sql = "SELECT * FROM user";
                    if ($result=mysqli_query($dbconnect,$sql)) {
                        $rowcount=mysqli_num_rows($result);
                        echo ''.$rowcount; }
                    ?>
                    </h1>
                    <div class="detail">
                        <h6><a href="index.php?page=user">Detail <i class='bx bx-right-arrow-alt'></i></a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <section class="pendapatan">
        <div class="row">
            <div class="col-lg-6">
                <div class="box" style="background-image: url('asset/img/dots-pattern-bg.png'); background-size: contain;">
                    <div class="ihome">
                    <i style="font-size: 5em;" class='bx bx-wallet'></i>
                    </div>
                    <div class="ehome">
                        <hr style="margin-top: 0;">
                        <h5 class="pb-2">Pendapatan</h5>
                        <h1>
                        <?php
                        $sql = "SELECT SUM(total) as `sumtotal` FROM transaksi";
                        $result = mysqli_query($dbconnect, $sql);
                        $data = mysqli_fetch_array($result);
                        echo "Rp. ".number_format($data['sumtotal']);
                        ?>
                        </h1>
                        <div class="detail2">
                            <button type="submit"><a href="index.php?page=laporan">Detail <i class='bx bx-right-arrow-alt'></i></a></button>
                        </div>
                        <hr style="margin-bottom: 0;">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>