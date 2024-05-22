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
    <title>Petani Pintar - Program Tanam</title>
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
            <section class="main-banner" id="about">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h2 class="h2-title">Mulai Program Tanam dengan <span>PetaniPintar</span></h2>
                                    <p>
                                        Memberdayakan petani dengan memberikan program tanam dan akses sumber daya yang sesuai dengan wilayah mereka.                                    </p>
                                    <div class="banner-btn mt-4">
                                        <a href="#program" class="sec-btn">Mulai Program Tanam</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img class="img-rounded" src="image/illustration/program1.png" alt="">
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
                                    <h2 class="h2-title mb-0">Program Tanam</h2>
                                    <h2 class="h2-title"><span>PetaniPintar</span></h2>
                                </div>
                                <?php 
                                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                    echo '<div class="text-center mb-5">
                                            <a href="edit-program-tanam.php" class="add">
                                                Edit Program
                                            </a>
                                            <a href="add-program-tanam.php" class="add">
                                                + Tambah Program
                                            </a>
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row katalog-tanam-slider">
                            <div class="swiper-wrapper">

                            <?php
                            include("php/config.php");
                            $sql = "SELECT * FROM program_tanam";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $sql_user_program = "SELECT * FROM user_program_tanam WHERE id_user = " . $_SESSION['id'] . " AND id_program_tanam = " . $row["id"];
                                    $result_user_program = $con->query($sql_user_program);

                                    echo '<div class="col-lg-3 swiper-slide">
                                            <div class="katalog-box">
                                                <div style="background-image: url(image/tanaman/' . $row["gambar"] . ');" class="katalog-tanam-img back-img"></div>
                                                <h3 onclick="window.location.href=\'detail-program-tanam.php?id=' . $row["id"] . '\'" class="h3-title">' . $row["nama"] . '</h3>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p class="p-katalog">Perkiraan<br>' . $row["waktu"] . ' bulan</p> 
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p class="p-katalog">' . $row["daerah"] . '</p>
                                                    </div>
                                                    <p class="p-katalog">Rp. ' . number_format($row["hasil"], 0, ',', '.') . ' / ton</p>
                                                </div>
                                                <div>
                                                    <ul>
                                                        <li>
                                                            <button onclick="window.location.href=\'detail-program-tanam.php?id=' . $row["id"] . '\'" class="signin">Lihat Detail</button>';

                                                            if ($result_user_program->num_rows > 0) {
                                                                echo '<button onclick="window.location.href=\'kirim-hasil-panen.php.php?id=' . $row["id"] . '\'" class="signup">Kirim</button>';
                                                            } else {
                                                                echo '<button onclick="window.location.href=\'mulai-program-tanam.php?id=' . $row["id"] . '\'" class="signup">Mulai</button>';
                                                            }

                                                        echo '</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo "Tidak ada program tanam yang tersedia saat ini.";
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
                                                <li><a href="#program">Program Tanam</a></li>
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
