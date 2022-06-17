<?php 
include "config.php";
session_start();
error_reporting(0);
include 'authcheck.php';
// print_r($_SESSION);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Momsky</title>
    <script src="../asset/js/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- ICON FONT AWESOME -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" integrity="sha512-P9vJUXK+LyvAzj8otTOKzdfF1F3UYVl13+F8Fof8/2QNb8Twd6Vb+VD52I7+87tex9UXxnzPgWA3rH96RExA7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body style="background: #ededed;">
  
<!-- SIDEBAR -->
  <div class="sidebar open bg-dark-blue">
    <div class="logo-details">
    <i class="fab fa-shopify icon"></i>
        <div class="logo_name">MomskyApp</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list" style="padding-left: 0px;">
      <li class="active">
        <a href="index.php?page=home">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="index.php?page=user">
       <i class='bx bxs-user-detail' ></i>
         <span class="links_name">User</span>
       </a>
       <span class="tooltip">User</span>
     </li>
     <li>
       <a href="index.php?page=barang">
       <i class='bx bx-package'></i>
         <span class="links_name">Barang</span>
       </a>
       <span class="tooltip">Barang</span>
     </li>
     <li>
       <a href="index.php?page=dis_barang">
       <i class="fas fa-percentage"></i>
         <span class="links_name">Disbarang</span>
       </a>
       <span class="tooltip">Disbarang</span>
     </li>
     <li>
       <a href="index.php?page=laporan">
         <i class='bx bx-folder' ></i>
         <span class="links_name">Laporan Transaksi</span>
       </a>
       <span class="tooltip">Laporan Transaksi</span>
     </li>
     <li>
       <a href="index.php?page=riwayat">
       <i class='bx bx-history'></i>
         <span class="links_name">Riwayat Transaksi</span>
       </a>
       <span class="tooltip">Riwayat Transaksi</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <img src="asset/img/pic-profile.png" alt="profileImg">
           <div class="name_job">
             <div class="name"><?=$_SESSION['nama']?></div>
             <div class="job">Admin</div>
           </div>
         </div>
         <a href="logout.php"><i class='bx bx-log-out' id="log_out" ></i></a>
     </li>
    </ul>
  </div>
<!-- END SIBEBAR -->
  
<!-- ISI -->
  <section class="home-section">
    <!-- header -->
    <header class="header">
        <nav class="navbar navbar-light ">
            <div class="container-fluid">
            <a class="navbar-brand">
                <h3 class="m-0">Toko Momsky</h3>
            </a>
            </div>
        </nav> 
    </header>
    <!-- end header -->
    
    <?php
      if (isset($_GET['page']) && $_GET['page'] != '') {
          include 'page/' . $_GET['page'] . '.php';
      } else {
          include 'page/home.php';
      }
    ?>
  </section>
<!-- END ISIS -->

<!-- SCRIPT SIDEBAR -->
<script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
</script>
<style>
  *{font-weight: 400;}
</style>
<!-- END SCRIPT SIDEBAR -->
</body>
</html>