<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }

   $id = $_SESSION['id'];
   $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

   while($result = mysqli_fetch_assoc($query)){
       $res_email = $result['email'];
       $res_username = $result['username'];
       $res_fullname = $result['fullname'];
       $res_age = $result['age'];
       $res_id = $result['id'];
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Profil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        p {
            margin: 20px 0;
        }
        .p-halo {
            padding-left: 30px;
        }
    </style>
</head>

<body class="body-fixed">
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="menu.php">
                            <img src="image/logo_petanipintar.png" width="40" height="40" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu">
                                <li><a href="profile.php">Profil Akun</a></li>
                                <li><a href="#">Riwayat Panen</a></li>
                                <li><a href="riwayat-pembayaran.php">Riwayat Pembayaran</a></li>
                                <li><a href="#">Pengaturan Lainnya</a></li>
                                <li>
                                    <button onclick="window.location.href='menu.php'" class="signup">Kembali</button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="viewport">
        <div id="js-scroll-content">
            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
            <section class="main-banner">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mb-4">
                                        <h3 class="h3-title">Profil<br><span>Pengguna</span></b></h3>
                                    </div>
                                <div class="d-flex justify-content-between align-items-center mb-4"> 
                                    <p class="p-halo mb-0">Halo <b><?php echo $res_username ?></b>!</p>
                                    <?php echo "<a href='edit-profile.php?Id=$res_id' class='add-alt'>Edit Profil</a>"; ?> 
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <p>Nama Lengkap: <b><?php echo $res_fullname ?></b></p>
                                        <p>Umur: <b><?php echo $res_age ?> tahun</b></p>
                                        <p>Email anda adalah <b><?php echo $res_email ?></b></p>
                                        <p>Status Akun
                                            <b>
                                                <?php
                                                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                                    echo "Admin";
                                                } else {
                                                    echo "Belum Diverifikasi";
                                                }
                                                ?>
                                            </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
            <footer class="site-footer" id="help">
                <div class="top-footer section">
                <div class="sec-wp">
                        <div class="container">
                        <div class="row">
                                <div class="col-lg-4">
                                <div class="footer-info">
                                        <div class="footer-logo">
                                        <a href="index.php">
                                                <img src="image/petanipintar_logo80.png" alt="Logo">
                                        </a>
                                        </div>
                                        <h5>Butuh Bantuan?</h5>
                                        <a>Hubungi kami untuk informasi lebih lanjut.</a>
                                </div>
                                </div>
                                <div class="col-lg-8">
                                <div class="footer-flex-box">
                                        <div class="footer-menu">
                                        <h4 class="h4-title">Kontak</h4>
                                        <ul>
                                                <li><a href="#">petanipintar@gmail.com</a></li>
                                                <li><a href="#">+62 1234567890</a></li>
                                        </ul>
                                        </div>
                                        <div class="footer-menu food-nav-menu">
                                        <h4 class="h4-title">Menu</h4>
                                        <ul class="column-2">
                                            <li><a href="#">Profil Akun</a></li>
                                            <li><a href="#">Riwayat Panen</a></li>
                                            <li><a href="riwayat-pembayaran.php">Riwayat Pembayaran</a></li>
                                            <li><a href="#">Pengaturan Lainnya</a></li>
                                            <li><a href="#help">Pusat Bantuan</a></li>
                                        </ul>
                                        </div>
                                        <div class="footer-menu">
                                        <h4 class="h4-title">Informasi Lain</h4>
                                        <ul>
                                                <li><a href="#">FAQ</a></li>
                                                <li><a href="#">Kebijakan Privasi</a></li>
                                                <li><a href="#">Syarat dan Ketentuan</a></li>
                                        </ul>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="end-footer">
                    <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-center mb-3">
                                        <a>kamipetanipintar.com</a>
                                </div>
                            </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
