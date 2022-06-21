<?php
include 'authcheck.php';
include 'config.php';
error_reporting(0);
?>

<div class="container">
    <h2 style="font-weight: 600; margin-left: 3px;">Dashboard</h2>
    <div class="row" style="margin-bottom: 1em;">
        <div class="col-lg-4">
            <div class="box" style="border-left: 5px solid #006900; background-image: url('asset/img/dots-pattern-bg.png'); background-size: cover">
                <div class="ihome" style="background-color: #006900;">
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
            <div class="box" style="border-left: 5px solid #2b2bad; background-image: url('asset/img/dots-pattern-bg.png'); background-size: cover">
                <div class="ihome" style="background-color: #2b2bad;">
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
            <div class="box" style="border-left: 5px solid #b72626; background-image: url('asset/img/dots-pattern-bg.png'); background-size: cover">
                <div class="ihome" style="background-color: #b72626;">
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
    

    <section class="pendapatan">
        <div class="row">
            <div class="col-lg-7">
                <div class="box" style="border-left: 5px solid #006900;">
                    <?php require 'chart.php' ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="box" style="border-left: 5px solid #ffc107; background-image: url('asset/img/dots-pattern-bg.png'); background-size: contain;">
                    <div class="ihome" style="background-color: #ffc107;">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>