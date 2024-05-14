<?php
   session_start();

   include("php/config.php");
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
                        <a href="index.php">
                            <img src="image/logo_petanipintar.png" width="40" height="40" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu">
                                <li><a class="active" href="#home">PetaniPintar</a></li>
                                <li><a href="#about">Tentang Kami</a></li>
                                <li><a href="#program">Program</a></li>
                                <li><a href="#tutorial">Petunjuk</a></li>
                                <li><a href="#help">Pusat Bantuan</a></li>
                                <li>
                                    <button onclick="window.location.href='login.php'" class="signin">Sign In</button>
                                    <button onclick="window.location.href='register.php'" class="signup">Sign Up</button>
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
                                    <h1 class="h1-title">Tumbuh Bersama <span>PetaniPintar</span></h1>
                                    <p>Jadilah penentu kemajuan pertanian masa depan melalui inovasi dan pemanfaatan teknologi digital.
                                        Kamu bisa jadi wajah baru pertanian modern yang mandiri, produktif, dan berkelanjutan.
                                    </p>
                                    <div class="banner-btn mt-4">
                                        <a href="#program" class="sec-btn">Lihat Program</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img src="img1.png" alt="">
                                </div>
                            </div>
                        </div>
            </section>
        
            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
                <h2 class="h2-title"><center><span>Learn More</span><br>About our Program</center></h2>
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
                                        <h2 class="h2-title">What is <span>PetaniPintar</span> and How Does it Work?</h2>
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
                                        <h5>Ready to join the revolution?<button href="register.php" class="signup">Daftarkan saya</button></h5>
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
                                            <a href="#" class="sec-btn">Read More</a>
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
                                            <a href="#" class="sec-btn">Read More</a>
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
                                            <a href="#" class="sec-btn">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="default-banner" id="tutorial">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <h2 class="h2-title"><center>Start <span>PetaniPintar</span> in 3 steps</center></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-text">
                                        <h4 class="h4-title"><span>1.</span></h4>
                                        <h2>Kunjungi Situs</h2>
                                        <p>Kunjungi Situs Website Petani Pintar pada link <span>kamipetanipintar.com</span>
                                            Pada Browser kesayangan anda.</p>
                                        <h4 class="h4-title"><span>2.</span></h4>
                                        <h2>Buat Akun</h2>
                                        <p>Pilih login/resister pada menu pojok kanan atas. Kemudian lakukan registrasi akun baru anda.
                                            Setelah membuat akun tunggu hingga akun baru anda diverifikasi.</p>
                                        <h4 class="h4-title"><span>3.</span></h4>
                                        <h2>Pilih Program</h2>
                                        <p>Setelah berhasil login anda dapat menikmati berbagai program dan fitur yang petani pintar sediakan. </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-img-wp">
                                        <img src="image/Component6.png" alt="">
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
                                            <a href="index.html">
                                                <img src="image/petanipintar_logo80.png" alt="">
                                            </a>
                                        </div>
                                            <h4 class="h4-title">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                            </h4>
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
                                                <li><a href="#home">Halaman Utama</a></li>
                                                <li><a href="#about">Tentang Kami</a></li>
                                                <li><a href="#program">Program</a></li>
                                                <li><a href="#tutorial">Petunjuk</a></li>
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
    <script src="js/smooth-scroll.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>