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
    <title>Petani Pintar - Pupuk Subsidi</title>
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
                                <li><a href="#">Program Tanam</a></li>
                                <li><a href="program-pupuk-subsidi.php">Pupuk Subsidi</a></li>
                                <li><a href="program-sewa-alat.php">Sewa Alat</a></li>
                                <li><a href="#">Forum</a></li>
                                <li>
                                    <button onclick="window.location.href='profile.php'" class="signin">Profil Akun</button>
                                    <button onclick="window.location.href='menu.php'" class="signup">Sign Out</button>
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
                                <div class="banner-text">
                                    <h2 class="h2-title">Sewa Alat Pertanian dengan <span>PetaniPintar</span></h2>
                                    <p>
                                        Mempermudah petani untuk berkomunikasi dengan pihak terkait dalam sektor pertanian untuk dapat menyewa alat pertanian yang dibutuhkan.
                                    </p>
                                    <div class="banner-btn mt-4">
                                        <a href="#katalog" class="sec-btn">Cari Alat Pertanian</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img class="img-rounded" src="img2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
            <!-- <h2 class="h2-title"><center><span>Learn More</span><br>About our Program</center></h2> -->
                <section class="default-banner" id="about">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="banner-img-wp">
                                        <img src="image/form1.webp" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-text">
                                        <h2 class="h2-title">Tentang Program <span>PetaniPintar</span></h2>
                                        <p>
                                            Petani Pintar is a concept that combines technology and artificial intelligence to enhance productivity and efficiency in agriculture.
                                        </p>
                                        <p>
                                            Through the implementation of various technological solutions such as sensors, data analytics, and smart software,
                                            Petani Pintar enables farmers to monitor crop conditions, manage resources more efficiently, and optimize farming processes as a whole.
                                        </p>
                                        <p>
                                            Thus, Petani Pintar can help increase crop yields, reduce production costs, 
                                            and defaulttain environmental sustainability in the agriculture industry 
                                        </p>
                                        <h5>Ready to join the revolution?<button onclick="window.location.href='register.php'" class="signup">Daftarkan saya</button></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="default-banner" id="katalog">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">Katalog Peralatan</p>
                                    <h2 class="h2-title">Pertanian Modern</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row katalog-slider">
                            <div class="swiper-wrapper">
                                <div class="col-lg-4 swiper-slide">
                                    <div class="katalog-box text-center">
                                        <div style="background-image: url(image/alat/1.jpg);"
                                            class="katalog-img back-img">

                                        </div>
                                        <h3 class="h3-title">Kultivator</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <p>Deskripsi dan harga.</p>
                                                </li>
                                                <li>
                                                <button onclick="window.location.href=''" class="signin">Lihat Alat</button>
                                                <button onclick="window.location.href=''" class="signup">Sewa</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="katalog-box text-center">
                                    <div style="background-image: url(image/alat/2.jpg);"
                                            class="katalog-img back-img">

                                        </div>
                                        <h3 class="h3-title">Mesin Tanam Padi</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <p>Deskripsi dan harga.</p>
                                                </li>
                                                <li>
                                                <button onclick="window.location.href=''" class="signin">Lihat Alat</button>
                                                <button onclick="window.location.href=''" class="signup">Sewa</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="katalog-box text-center">
                                    <div style="background-image: url(image/alat/3.jpg);"
                                            class="katalog-img back-img">

                                        </div>
                                        <h3 class="h3-title">Alat Pertanian3</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <p>Deskripsi dan harga.</p>
                                                </li>
                                                <li>
                                                <button onclick="window.location.href=''" class="signin">Lihat Alat</button>
                                                <button onclick="window.location.href=''" class="signup">Sewa</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="katalog-box text-center">
                                    <div style="background-image: url(image/alat/4.jpg);"
                                            class="katalog-img back-img">

                                        </div>
                                        <h3 class="h3-title">Alat Pertanian4</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <p>Deskripsi dan harga.</p>
                                                </li>
                                                <li>
                                                <button onclick="window.location.href=''" class="signin">Lihat Alat</button>
                                                <button onclick="window.location.href=''" class="signup">Sewa</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="katalog-box text-center">
                                        <div style="background-image: url(assets/images/chef/c5.jpg);"
                                            class="katalog-img back-img">

                                        </div>
                                        <h3 class="h3-title">Priyotosh Dey</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="uil uil-youtube"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-wp">
                                <div class="swiper-button-prev swiper-button">
                                    <i class="uil uil-angle-left"></i>
                                </div>
                                <div class="swiper-button-next swiper-button">
                                    <i class="uil uil-angle-right"></i>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </section>
                <!-- <section class="default-banner" id="program">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <h2 class="h2-title">Tahapan Program</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img"
                                            style="background-image: url(image/program_tanam.jpg);"></div>
                                        <div class="programs-text">
                                            <h4>Buat Formulir Permohonan</h4>
                                            <p>Buat dan isi formulir permohonan dengan lengkap dan benar, termasuk data diri, lahan pertanian, dan kebutuhan pupuk.
                                                Upload dokumen yang diperlukan, seperti KTP dan KK.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img"
                                            style="background-image: url(image/program_pupuk.jpg);"></div>
                                        <div class="programs-text">
                                            <h4>Proses Verifikasi Berkas</h4>
                                            <p>Tim verifikator akan memeriksa kelengkapan dan keabsahan data dan dokumen yang Anda upload.
                                                Proses verifikasi dapat memakan waktu beberapa hari.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img"
                                            style="background-image: url(image/program_sewa.jpg);"></div>
                                        <div class="programs-text">
                                            <h4>Notifikasi Persetujuan Program</h4>
                                            <p>Jika verifikasi berkas berhasil, Anda akan menerima notifikasi persetujuan program melalui email.
                                                Cetak Kartu Tani dan gunakan untuk membeli pupuk bersubsidi di toko resmi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->
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
                                                <li><a href="#form">Formulir</a></li>
                                                <li><a href="#help" class="footer-active-menu">Pusat Bantuan</a></li>
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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
