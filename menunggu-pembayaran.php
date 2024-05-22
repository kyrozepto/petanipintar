<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

if (isset($_GET['id_alat'])) {
    $id_alat = $_GET['id_alat'];
    $id_user = $_SESSION['id'];

    $sql_alat = "SELECT * FROM alat WHERE id = $id_alat";
    $result_alat = $con->query($sql_alat);
    $row_alat = $result_alat->fetch_assoc();

    $sql_sewa = "SELECT * FROM sewa_alat WHERE id_user = $id_user AND id_alat = $id_alat ORDER BY tanggal_sewa DESC LIMIT 1";
    $result_sewa = $con->query($sql_sewa);

    if ($result_sewa->num_rows > 0) {
        $data_sewa = $result_sewa->fetch_assoc();

        $batas_waktu = date('Y-m-d H:i:s', strtotime($data_sewa['tanggal_sewa'] . ' +1 day'));
    } else {
        echo "Data sewa tidak ditemukan.";
        exit;
    }
} else {
    echo "ID alat tidak ditemukan.";
    exit;
}

$sql_rekening = "SELECT * FROM rekening_pemilik WHERE id_user = " . $row_alat['id_pemilik'];
$result_rekening = $con->query($sql_rekening);
$rekening_pemilik = [];

if ($result_rekening->num_rows > 0) {
    while ($row_rekening = $result_rekening->fetch_assoc()) {
        $rekening_pemilik[] = $row_rekening;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Menunggu Pembayaran</title>
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
                                                <h3>
                                                    <center><b>Menunggu Pembayaran</b></center>
                                                </h3>
                                                <p>
                                                    <center>Alat:
                                                        <?php echo $row_alat['nama']; ?>
                                                    </center>
                                                </p>
                                                <p>
                                                    <center>Harga Sewa: Rp.
                                                        <?php echo number_format($row_alat['harga'], 0, ',', '.'); ?> /
                                                        musim
                                                    </center>
                                                </p>
                                                <p>Terima kasih telah melakukan pemesanan. Silakan lakukan pembayaran
                                                    sesuai dengan metode yang Anda pilih.</p>

                                                <hr>
                                                <h5 class="mb-3"><b>Detail Pembayaran</b></h5>
                                                <p>Metode:
                                                    <?php echo $data_sewa['metode_pembayaran']; ?>
                                                </p>
                                                <p>Total Pembayaran: Rp.
                                                    <?php echo number_format($row_alat['harga'], 0, ',', '.'); ?>
                                                </p>
                                                <p>Batas Waktu Pembayaran:
                                                    <?php echo $batas_waktu; ?>
                                                </p>

                                                <hr>
                                                <h5 class="mb-3"><b>Informasi Rekening</b></h5>
                                                <ul>
                                                    <?php if (!empty($rekening_pemilik)): ?>
                                                    <?php foreach ($rekening_pemilik as $rekening): ?>
                                                    <?php if (($data_sewa['metode_pembayaran'] == 'transfer_bank' && $rekening['jenis_rekening'] == 'Bank') || 
                                                          ($data_sewa['metode_pembayaran'] == 'e_wallet' && $rekening['jenis_rekening'] == 'E-Wallet')): ?>
                                                    <li>
                                                        <?php echo $rekening['jenis_rekening'] . ' - ' . ($rekening['jenis_rekening'] == 'Bank' ? $rekening['nama_bank'] . ' ' : ''); ?>
                                                        No.
                                                        <?php echo $rekening['nomor_rekening']; ?> a.n
                                                        <?php echo $rekening['atas_nama']; ?>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <li>Tidak ada informasi rekening tersedia.</li>
                                                    <?php endif; ?>
                                                </ul>
                                                <hr>
                                                <p>Jika Anda sudah melakukan pembayaran, silakan tunggu konfirmasi dari
                                                    kami.
                                                    Anda dapat melihat status sewa Anda di halaman Riwayat Sewa.
                                                </p>

                                                <div class="field mt-3 text-center">
                                                    <button onclick="window.location.href='riwayat-pembayaran.php'"
                                                        class="btn">Lihat Riwayat Sewa</button>
                                                </div>

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