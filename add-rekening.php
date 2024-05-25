<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekening</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
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
                                <li>
                                    <button onclick="window.location.href='profile.php'" class="signup">Kembali</button>
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
                <div section="main-banner">
                    <div class="sec-wp">
                        <div class="box-container mt-5">
                            <div class="box form-box">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $id_user = $_SESSION['id'];
                                    $jenis_rekening = $_POST['jenis_rekening'];
                                    $nama_bank = $_POST['nama_bank'];
                                    $nomor_rekening = $_POST['nomor_rekening'];
                                    $atas_nama = $_POST['atas_nama'];

                                    $insert_query = mysqli_query($con, "INSERT INTO rekening_pemilik (id_user, jenis_rekening, nama_bank, nomor_rekening, atas_nama) 
                                                                        VALUES ('$id_user', '$jenis_rekening', '$nama_bank', '$nomor_rekening', '$atas_nama')")
                                                    or die("Error occurred");

                                    if ($insert_query) {
                                        echo "<div class='message'>
                                                <h5>Rekening berhasil ditambahkan!</h5>
                                              </div> <br>";
                                        echo "<a href='profile.php'><center><button class='signin'>Kembali ke Profil</button></center>";
                                    }
                                } else {
                                ?>
                                    <header>Tambah Rekening</header>
                                    <form action="" method="post">
                                        <div class="field input">
                                            <label for="jenis_rekening">Jenis Rekening</label>
                                            <select name="jenis_rekening" id="jenis_rekening" autocomplete="off" required>
                                                <option value="Bank">Bank</option>
                                                <option value="E-Wallet">E-Wallet</option>
                                            </select>
                                        </div>

                                        <div class="field input">
                                            <label for="nama_bank">Nama Bank / E-Wallet</label>
                                            <input type="text" name="nama_bank" id="nama_bank" autocomplete="off">
                                        </div>

                                        <div class="field input">
                                            <label for="nomor_rekening">Nomor Rekening</label>
                                            <input type="text" name="nomor_rekening" id="nomor_rekening" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="atas_nama">Atas Nama</label>
                                            <input type="text" name="atas_nama" id="atas_nama" autocomplete="off" required>
                                        </div>

                                        <div class="field">
                                            <input type="submit" class="btn" name="submit" value="Tambah" autocomplete="off" required>
                                        </div>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>