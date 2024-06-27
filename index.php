<?php
session_start();

include("php/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
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
                                    <button onclick="window.location.href='login.php'" class="signin">Masuk</button>
                                    <button onclick="window.location.href='register.php'" class="signup">Daftar</button>
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
                                        <a href="#about" class="sec-btn">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img src="image/illustration/index.png" alt="">
                                </div>
                            </div>
                        </div>
            </section>

            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
                <h2 class="h2-title">
                    <center><span>Lebih Lanjut</span><br>Mengenai Program Kami</center>
                </h2>
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
                                        <h2 class="h2-title">Apa itu <span>PetaniPintar</span> dan bagaimana cara kerjanya</h2>
                                        <p style="text-align: justify;">
                                            PetaniPintar adalah sebuah konsep yang menggabungkan teknologi dan kecerdasan buatan untuk meningkatkan
                                            produktivitas dan efisiensi di bidang pertanian.
                                        <br><br>
                                            Melalui penerapan berbagai solusi teknologi seperti sensor, analisis data, dan perangkat lunak pintar,
                                            PetaniPintar memungkinkan petani memantau kondisi tanaman, mengelola sumber daya dengan lebih efisien,
                                            dan mengoptimalkan proses pertanian secara keseluruhan.
                                        <br><br>
                                            Dengan demikian, PetaniPintar dapat membantu meningkatkan hasil panen,
                                            menurunkan biaya produksi, dan menjaga kelestarian lingkungan dalam industri pertanian
                                        </p>
                                        <h5>Tertarik untuk bergabung?<button onclick="window.location.href='register.php'" class="signup">Daftarkan saya</button></h5>
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
                                        <div class="programs-img back-img" style="background-image: url(image/program_tanam.jpg);"></div>
                                        <div class="programs-text">
                                            <h4 href="#" class="h4-title">Program Tanam berdasarkan Wilayah</h4>
                                            <p>Memberdayakan petani dengan memberikan program tanam dan akses sumber daya yang sesuai dengan wilayah mereka.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img" style="background-image: url(image/program_pupuk.jpg);"></div>
                                        <div class="programs-text">
                                            <h4 href="#" class="h4-title">Bantuan pengajuan untuk Pupuk Bersubsidi</h4>
                                            <p>Mempercepat proses pengajuan permohonan untuk mendapatkan subsidi pupuk dan menerima laporan masalah yang dihadapi petani.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img" style="background-image: url(image/program_sewa.jpg);"></div>
                                        <div class="programs-text">
                                            <h4 href="#" class="h4-title">Peminjaman Alat Pertanian</h4>
                                            <p>Mempermudah petani untuk berkomunikasi dengan pihak terkait dalam sektor pertanian untuk dapat menyewa alat pertanian yang dibutuhkan.</p>
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
                                        <h2 class="h2-title mt-4">
                                            <center>Mulai <span>PetaniPintar</span> dengan 3 langkah</center>
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-text">
                                        <h4 class="h4-title"><span>1.</span></h4>
                                        <h2>Kunjungi Situs</h2>
                                        <p>Kunjungi Situs Website PetaniPintar pada link <span>kamipetanipintar.com</span>
                                            Pada Browser kesayangan anda.</p>
                                        <h4 class="h4-title"><span>2.</span></h4>
                                        <h2>Buat Akun</h2>
                                        <p>Pilih login/resister pada menu pojok kanan atas. Kemudian lakukan registrasi akun baru anda.
                                            Setelah membuat akun tunggu hingga akun baru anda diverifikasi.</p>
                                        <h4 class="h4-title"><span>3.</span></h4>
                                        <h2>Pilih Program</h2>
                                        <p>Setelah berhasil login anda dapat menikmati berbagai program dan fitur yang PetaniPintar sediakan. </p>
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
                                                <li><a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=petanipintar@gmail.com">petanipintar@gmail.com</a></li>
                                                <li><a href="https://wa.me/628234567890">+62 1234567890</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu food-nav-menu">
                                            <h4 class="h4-title">Menu</h4>
                                            <ul class="column-2">
                                                <li><a href="#home">Halaman Utama</a></li>
                                                <li><a href="#about">Tentang Kami</a></li>
                                                <li><a href="#program">Program</a></li>
                                                <li><a href="#tutorial">Petunjuk</a></li>
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
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>