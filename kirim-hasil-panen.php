<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $id_program = $_GET['id'];

    $sql = "SELECT * FROM program_tanam WHERE id = $id_program";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Program tidak ditemukan.";
        exit;
    }
} else {
    echo "ID program tidak ditemukan.";
    exit;
}

if (isset($_POST['submit_panen'])) {
    $id_user = $_SESSION['id'];
    $id_program_tanam = $_GET['id'];
    $jumlah_panen = $_POST['jumlah_panen'];

    $sql_insert = "INSERT INTO panen (id_user, id_program_tanam, jumlah_panen, tanggal_panen) VALUES ($id_user, $id_program_tanam, $jumlah_panen, NOW())";

    if ($con->query($sql_insert) === TRUE) {
        echo "<script>alert('Hasil panen berhasil dikirim.'); window.location.href = 'program-tanam.php';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Hasil Panen</title>
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
                                <li><a href="#">Forum</a></li>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                    echo '<li><a href="admin/dashboard-1.php">Kelola</a></li>';
                                }?>
                                <li>
                                    <button onclick="window.location.href='profile.php'" class="signin">Profil</button>
                                    <button onclick="window.location.href='program-tanam.php'" class="signup">Kembali</button>
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
                                <h2 class="h2-title mb-0">Kirim Hasil Panen</h2>
                                <h2 class="h2-title"><span><?php echo $row['nama']; ?></span></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="jumlah_panen">Jumlah Panen (ton):</label>
                                            <input type="number" class="form-control" id="jumlah_panen" name="jumlah_panen" required>
                                        </div>
                                        <button type="submit" name="submit_panen" class="btn btn-primary">Kirim</button>
                                    </form>
                                </div>
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
                                            <li><a href="#sdk">Syarat dan Ketentuan</a></li>
                                            <li><a href="#program">Program Tanam</a></li>
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

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
