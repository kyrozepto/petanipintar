<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_email = $result['email'];
    $res_username = $result['username'];
    $res_fullname = $result['fullname'];
    $res_age = $result['age'];
    $res_id = $result['id'];
    $res_alamat = $result['alamat'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        p {
            font-size: 16px;
            margin: 15px 0;
        }

        .p-halo {
            padding-left: 30px;
        }

        .add-alt {
            font-size: 14px;
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
                <section class="main-banner">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mb-5">
                                    <div class="text-center mb-4">
                                        <h3 class="h3-title">Profil<br><span>Pengguna</span></b></h3>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <p class="p-halo mb-0">Halo <b><?php echo $res_username ?></b>!</p>
                                        <?php echo "<a href='edit-profile.php?Id=$res_id' class='add-alt'>Ubah Profil</a>"; ?>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <p>Nama Lengkap: <b><?php echo $res_fullname ?></b></p>
                                            <p>Umur: <b><?php echo $res_age ?> tahun</b></p>
                                            <p>Alamat: <b><?php echo $res_alamat ?></b></p>
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
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="p-halo">Informasi Rekening</p>
                                        <a href="add-rekening.php" class="add-alt">Tambahkan</a>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <?php
                                            $sql_rekening = "SELECT * FROM rekening_pemilik WHERE id_user = $id";
                                            $result_rekening = $con->query($sql_rekening);

                                            if ($result_rekening->num_rows > 0) {
                                                while ($row_rekening = $result_rekening->fetch_assoc()) {
                                                    echo "<div>";
                                                    echo "<p>Jenis Rekening: <b>" . $row_rekening['jenis_rekening'] . "</b></p>";
                                                    if ($row_rekening['jenis_rekening'] == 'Bank') {
                                                        echo "<p>Nama Bank: <b>" . $row_rekening['nama_bank'] . "</b></p>";
                                                    }
                                                    if ($row_rekening['jenis_rekening'] == 'E-Wallet') {
                                                        echo "<p>Nama E-Wallet: <b>" . $row_rekening['nama_bank'] . "</b></p>";
                                                    }
                                                    echo "<p>Nomor Rekening: <b>" . $row_rekening['nomor_rekening'] . "</b></p>";
                                                    echo "<p>Atas Nama: <b>" . $row_rekening['atas_nama'] . "</b></p>";
                                                    echo "<div style='display: flex; justify-content: flex-end;'>";
                                                    echo "<form action='edit-rekening.php' method='POST' style='display: inline; margin-right: 10px;'>
                                                            <input type='hidden' name='id_rekening' value='" . $row_rekening['id'] . "'>
                                                            <button type='submit' class='add-alt'>Ubah</button>
                                                        </form>";

                                                    echo "<form action='php/fungsi-hapus-rekening.php' method='POST' style='display: inline;'>
                                                            <input type='hidden' name='id_rekening' value='" . $row_rekening['id'] . "'>
                                                            <button type='submit' class='add-alt' onclick='return confirm(\"Apakah Anda yakin ingin menghapus rekening ini?\")'>Hapus</button>
                                                        </form>";

                                                    echo "</div>";

                                                    echo "<hr>";
                                                }
                                            } else {
                                                echo "<p>Belum ada rekening yang ditambahkan.</p>";
                                            }
                                            ?>
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
                                                <li><a href="notifikasi.php">Notifikasi</a></li>
                                                <li><a href="#">Riwayat Panen</a></li>
                                                <li><a href="riwayat-pembayaran.php">Riwayat Pembayaran</a></li>
                                                <li><a href="#">Gemini</a></li>
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