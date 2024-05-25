<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Alat</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
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
                                <li><a href="program-tanam.php">Program Tanam</a></li>
                                <li><a href="program-pupuk-subsidi.php">Pupuk Subsidi</a></li>
                                <li><a href="program-sewa-alat.php">Sewa Alat</a></li>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                    echo '<li><a href="admin/dashboard-1.php">Manage</a></li>';
                                }else{    
                                    echo "<li><a href='#'>Forum</a></li>";
                                }?>
                                <li>
                                    <button onclick="window.location.href='profile.php'" class="signin">Profil Akun</button>
                                    <button onclick="if(confirm('Apakah Anda yakin ingin keluar?')){window.location.href='login.php';}" class="signup">Keluar</button>
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
            <section class="main-banner" id="about">
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
                                        <a href="#program" class="sec-btn">Cari Alat Pertanian</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img class="img-rounded" src="image/illustration/program3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
                <section class="default-banner" id="program">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <h2 class="h2-title mb-0">Peralatan Pertanian</h2>
                                        <h2 class="h2-title"><span>PetaniPintar</span></h2>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                        echo '<div class="text-center mb-5">
                                            <a href="edit-sewa-alat.php" class="add">
                                                Ubah Alat
                                            </a>
                                            <a href="add-sewa-alat.php" class="add">
                                                + Tambah Alat
                                            </a>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row katalog-slider">
                                <div class="swiper-wrapper">

                                    <?php
                                    include("php/config.php");
                                    $sql = "SELECT * FROM alat";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<div class="col-lg-4 swiper-slide">
                                            <div class="katalog-box">
                                                <div style="background-image: url(image/alat/' . $row["gambar"] . ');" class="katalog-img back-img"></div>
                                                <h3 class="h3-title">' . $row["nama"] . '</h3>
                                                <div>
                                                    <ul>
                                                        <li>
                                                            <p class="p-katalog">' . $row["deskripsi"] . '</p> 
                                                        </li>
                                                        <li>
                                                            <p class="p-katalog">Rp. ' . number_format($row["harga"], 0, ',', '.') . ' / musim</p>
                                                        </li>
                                                        <li>
                                                            <button onclick="window.location.href=\'detail-sewa-alat.php?id=' . $row["id"] . '\'" class="signin">Lihat Detail</button>
                                                            <button onclick="window.location.href=\'mulai-sewa-alat.php?id=' . $row["id"] . '\'" class="signup">Sewa</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                    } else {
                                        echo "Tidak ada data alat.";
                                    }
                                    ?>
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
                                                <li><a href="#about">Tentang Program</a></li>
                                                <li><a href="#program">Peralatan Pertanian</a></li>
                                                <li><a href="#sdk">Syarat dan Ketentuan</a></li>
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
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>