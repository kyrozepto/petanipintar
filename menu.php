<?php
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
        header("Location: index.php");
       }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petani Pintar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
                                <li><a href="menu.php">PetaniPintar</a></li>
                                <li><a href="program-tanam.php">Program Tanam</a></li>
                                <li><a href="program-pupuk-subsidi.php">Pupuk Subsidi</a></li>
                                <li><a href="program-sewa-alat.php">Sewa Alat</a></li>
                                <li><a href="#">Forum</a></li>
                                <li>
                                    <button onclick="window.location.href='profile.php'" class="signin">Profil Akun</button>
                                    <button onclick="window.location.href='login.php'" class="signup">Sign Out</button>
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
            <section class="main-banner" id="home">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php 
                                
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

                                while($result = mysqli_fetch_assoc($query)){
                                        $res_username = $result['username'];
                                }
                                ?>
                                <div class="banner-text">
                                    <h2 class="h2-title">Halo <?php echo $res_username ?></b>!<br>Selamat datang di<br><span>PetaniPintar</span></h2>
                                    <p>
                                        Jadilah penentu kemajuan pertanian masa depan melalui inovasi dan pemanfaatan teknologi digital.
                                        Kamu bisa jadi wajah baru pertanian modern yang mandiri, produktif, dan berkelanjutan.
                                    </p>
                                    <div class="banner-btn mt-4">
                                        <a href="#program" class="sec-btn">Mulai Program</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img src="image/illustration/menu.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
            <h2 class="h2-title"><center><span>Lebih Lanjut</span><br>Mengenai Program Kami</center></h2>
                <section class="main-banner" id="about">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="banner-img-wp">
                                        <img src="image/Componen5.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-text">
                                        <h2 class="h2-title">Apa itu   <span>PetaniPintar</span> dan bagaimana cara kerjanya</h2>
                                        <p>
                                            Petani Pintar adalah sebuah konsep yang menggabungkan teknologi dan kecerdasan buatan untuk meningkatkan
                                            produktivitas dan efisiensi di bidang pertanian.
                                        </p>
                                        <p>
                                            Melalui penerapan berbagai solusi teknologi seperti sensor, analisis data, dan perangkat lunak pintar, 
                                            Petani Pintar memungkinkan petani memantau kondisi tanaman, mengelola sumber daya dengan lebih efisien, 
                                            dan mengoptimalkan proses pertanian secara keseluruhan.
                                        </p>
                                        <p>
                                            Dengan demikian, Petani Pintar dapat membantu meningkatkan hasil panen, 
                                            menurunkan biaya produksi, dan menjaga kelestarian lingkungan dalam industri pertanian    
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="default-banner" id="program">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <h2 class="h2-title">Program <span>PetaniPintar</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img"
                                            style="background-image: url(image/program_tanam.jpg);"></div>
                                        <div class="programs-text">
                                            <h4 href="#" class="h4-title">Program Tanam berdasarkan Wilayah</h4>
                                            <p>Memberdayakan petani dengan memberikan program tanam dan akses sumber daya yang sesuai dengan wilayah mereka.</p>
                                            <a href="program-tanam.php" class="sec-btn">Pilih Program</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img"
                                            style="background-image: url(image/program_pupuk.jpg);"></div>
                                        <div class="programs-text">
                                            <h4 href="#" class="h4-title">Bantuan pengajuan untuk Pupuk Bersubsidi</h4>
                                            <p>Mempercepat proses pengajuan permohonan untuk mendapatkan subsidi pupuk dan menerima laporan masalah yang dihadapi petani.</p>
                                            <a href="program-pupuk-subsidi.php" class="sec-btn">Pilih Program</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img"
                                            style="background-image: url(image/program_sewa.jpg);"></div>
                                        <div class="programs-text">
                                            <h4 href="#" class="h4-title">Peminjaman Alat Pertanian</h4>
                                            <p>Mempermudah petani untuk berkomunikasi dengan pihak terkait dalam sektor pertanian untuk dapat menyewa alat pertanian yang dibutuhkan.</p>
                                            <a href="program-sewa-alat.php" class="sec-btn">Pilih Program</a>
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
                                        <h4 class="h4-title">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h4>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="footer-flex-box">
                                        <div class="footer-menu">
                                            <h3 class="h3-title">Kontak</h3>
                                            <ul>
                                                <li><a href="#">petanipintar@gmail.com</a></li>
                                                <li><a href="#">+62 1234567890</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu food-nav-menu">
                                            <h3 class="h3-title">Menu</h3>
                                            <ul class="column-2">
                                                <li><a href="#about">Tentang Program</a></li>
                                                <li><a href="#sdk">Syarat dan Ketentuan</a></li>
                                                <li><a href="#program">Pilihan Program</a></li>
                                                <li><a href="#help">Pusat Bantuan</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu">
                                            <h3 class="h3-title">Informasi Lain</h3>
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
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
