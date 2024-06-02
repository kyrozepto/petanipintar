<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

$id_user = $_SESSION['id'];
$sql_notifikasi = "SELECT p.*, u.fullname FROM permohonan_pupuk p JOIN users u ON p.id_user = u.id WHERE p.id_user = $id_user ORDER BY p.tanggal_permohonan DESC";
$result_notifikasi = $con->query($sql_notifikasi);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .card-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
                                <li><a href="notifikasi.php">Notifikasi</a></li>
                                <li><a href="#">Riwayat Panen</a></li>
                                <li><a href="riwayat-pembayaran.php">Riwayat Pembayaran</a></li>
                                <li><a href="bot.php">Gemini</a></li>
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
                <section class="main-banner" id="home">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center mb-4">
                                        <h3 class="h3-title">Notifikasi</b></h3>
                                    </div>

                                    <?php
                                    if ($result_notifikasi->num_rows > 0) {
                                        while ($row = $result_notifikasi->fetch_assoc()) {
                                            echo '<div class="card mb-4">';
                                            echo '<div class="card-body">';
                                            echo '<h5 class="card-title">';
                                            echo '<span>Permohonan Pupuk: ' . $row['jenis_pupuk'] . ' (' . $row['jumlah_pupuk'] . ' Kg)</span>';
                                            echo '</h5>';
                                            echo '<hr>';
                                            echo '<p class="p-card">Tanggal Permohonan: <span>' . $row['tanggal_permohonan'] . '</span></p>';
                                            echo '<p class="p-card">Status: <span' . ($row['status'] == 'Ditolak' ? ' style="color: red;"' : '') . '>' . $row['status'] . '</span></p>';
                                             // Menampilkan alasan penolakan jika ada
                                             if ($row['status'] == 'Ditolak' && !empty($row['alasan_penolakan'])) {
                                                echo '<p class="p-card">Alasan Penolakan: <span>' . $row['alasan_penolakan'] . '</span></p>';
                                            } 
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Tidak ada notifikasi.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
                                                    <li><a href="profile.php">Profil Akun</a></li>
                                                    <li><a href="notifikasi.php">Notifikasi</a></li>
                                                    <li><a href="#">Riwayat Panen</a></li>
                                                    <li><a href="#">Riwayat Pembayaran</a></li>
                                                    <li><a href="profile.php">Profil Akun</a></li>
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