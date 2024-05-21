<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

// Ambil ID program dari URL
if (isset($_GET['id'])) {
    $id_program = $_GET['id'];

    // Ambil detail program dari database
    $sql = "SELECT * FROM program_tanam WHERE id = $id_program";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Program tidak ditemukan.";
        exit; // Hentikan skrip jika program tidak ditemukan
    }
} else {
    echo "ID program tidak ditemukan.";
    exit; // Hentikan skrip jika ID program tidak ada
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petani Pintar - Detail Program Tanam</title>
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
                                            <button onclick="history.back()" class="signup">Kembali</button>
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
                                <div class="sec-title text-center mb-5">
                                        <p class="sec-sub-title mb-1">PetaniPintar</p>
                                        <h2 class="h2-title mb-0">Program Tanam</h2>
                                        <h2 class="h2-title"><span><?php echo $row['nama']; ?></span></h2>
                                </div>
                                <div class="row">
                                <div class="col-lg-4">
                                        <div class="detail-program-img-wp">
                                        <img class="img-rounded" src="image/tanaman/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama']; ?>">
                                        </div>
                                </div>
                                <div class="col-lg-8 detail-box">
                                        <div class="detail-program-text">
                                        <p class="p-detail">
                                                <!-- <?php echo $row['deskripsi']; ?> -->
                                        </p>
                                        <div class="detail-info">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                            <p class="p-detail">Perkiraan Waktu Panen:<br><b><?php echo $row['waktu']; ?> bulan</b><p>
                                                            <p class="p-detail">Banyak Permintaan:<br><b><?php echo $row['jumlah']; ?> ton</b></p>
                                                            
                                                    </div>
                                                    <div class="col-lg-6">
                                                            <p class="p-detail">Daerah Permintaan:<br><b><?php echo $row['daerah']; ?></b></p>
                                                            <p class="p-detail">Lokasi Pabrik:<br><b><?php echo $row['koordinat']; ?></b></p>
                                                    </div>
                                                    <div class="col-lg-12">
                                                            <p class="p-detail">Perkiraan Hasil Panen:<br><b>Rp. <?php echo number_format($row['hasil'], 0, ',', '.'); ?> / ton</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 mt-5 text-center">
                                    <a href="simpan-program-tanam.php?id=<?php echo $row['id']; ?>" class="add-alt uil-bookmark"></a>
                                    <a href="mulai-program-tanam.php?id=<?php echo $row['id']; ?>" class="add">Mulai Program</a>
                                </div>
                            </div>
                        </div>
                </section>
        </div>
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
                                                <li><a href="#program">Program Tanam</a></li>
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

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>