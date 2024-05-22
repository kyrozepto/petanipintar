<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
        header("Location: index.php");
       }

   if (isset($_GET['id'])) {
    $id_alat = $_GET['id'];

    $sql_alat = "SELECT * FROM alat WHERE id = $id_alat";
    $result_alat = $con->query($sql_alat);
    $row_alat = $result_alat->fetch_assoc();
} else {
    echo "ID alat tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Sewa Alat</title>
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
                <div section="main-banner">
                    <div class="sec-wp">
                        <div class="box-container mt-5">
                            <div class="box form-box">
                                <section class="konfirmasi-program">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 mt-2">
                                                <h3><center><b>Konfirmasi Persetujuan dan Pembayaran</b></center></h3>
                                                <p><center>Alat: <?php echo $row_alat['nama']; ?></center></p>
                                                <p><center>Harga Sewa: Rp. <?php echo number_format($row_alat['harga'], 0, ',', '.'); ?> / musim</center></p>
                                                <p>Dengan melakukan pemesanan, Anda menyetujui syarat dan ketentuan yang berlaku. 
                                                Silahkan pilih metode pembayaran dan selesaikan proses pembayaran.</p>
                                                <form action="php/fungsi-mulai-sewa.php" method="post"> 
                                                    <input type="hidden" name="id_alat" value="<?php echo $id_alat; ?>">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="setuju_syarat" id="setuju_syarat" required>
                                                        <label class="form-check-label" for="setuju_syarat">
                                                            Saya menyetujui seluruh <b>Syarat dan Ketentuan</b> yang berlaku.
                                                        </label>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                                                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                                                            <option value="">Pilih Metode Pembayaran</option>
                                                            <option value="transfer_bank">Transfer Bank</option>
                                                            <option value="e_wallet">E-Wallet</option>
                                                            </select>
                                                    </div>
                                                    <div class="field mt-3">
                                                        <button type="submit" class="btn">Sewa Sekarang</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
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