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
            <h1>
                <?php 
                $sql = "SELECT SUM(total) FROM transaksi_detail";
                if ($result=mysqli_query($dbconnect,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                    echo ''.$rowcount; 
                }   
                ?>
            </h1>
        </div>
    </div>