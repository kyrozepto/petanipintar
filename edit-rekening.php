<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_rekening'])) {
    $id_rekening = $_POST['id_rekening'];
    $id_user = $_SESSION['id'];

    $sql_rekening = "SELECT * FROM rekening_pemilik WHERE id = '$id_rekening' AND id_user = '$id_user'";
    $result_rekening = $con->query($sql_rekening);

    if ($result_rekening->num_rows > 0) {
        $row_rekening = $result_rekening->fetch_assoc();
    } else {
        echo "Rekening tidak ditemukan.";
        exit;
    }

    if (isset($_POST['update'])) {
        $jenis_rekening = $_POST['jenis_rekening'];
        $nama_bank = $_POST['nama_bank'];
        $nomor_rekening = $_POST['nomor_rekening'];
        $atas_nama = $_POST['atas_nama'];

        $update_query = "UPDATE rekening_pemilik SET 
                          jenis_rekening='$jenis_rekening',
                          nama_bank='$nama_bank', 
                          nomor_rekening='$nomor_rekening', 
                          atas_nama='$atas_nama' 
                          WHERE id='$id_rekening' AND id_user='$id_user'";

        if ($con->query($update_query) === TRUE) {
            echo "<script>
                    window.location.href = 'profile.php';
                  </script>";
        } else {
            echo "Error: " . $update_query . "<br>" . $con->error;
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ubah Rekening</title>
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
                                    <header>Ubah Rekening</header>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_rekening" value="<?php echo $row_rekening['id']; ?>">
                                        <div class="field input">
                                            <label for="jenis_rekening">Jenis Rekening</label>
                                            <select name="jenis_rekening" id="jenis_rekening" required>
                                                <option value="Bank" <?php if ($row_rekening['jenis_rekening'] == 'Bank') echo 'selected'; ?>>Bank</option>
                                                <option value="E-Wallet" <?php if ($row_rekening['jenis_rekening'] == 'E-Wallet') echo 'selected'; ?>>E-Wallet</option>
                                            </select>
                                        </div>

                                        <div class="field input">
                                            <label for="nama_bank">Nama Bank / E-Wallet</label>
                                            <input type="text" name="nama_bank" id="nama_bank" value="<?php echo $row_rekening['nama_bank']; ?>">
                                        </div>

                                        <div class="field input">
                                            <label for="nomor_rekening">Nomor Rekening</label>
                                            <input type="text" name="nomor_rekening" id="nomor_rekening" value="<?php echo $row_rekening['nomor_rekening']; ?>" required>
                                        </div>

                                        <div class="field input">
                                            <label for="atas_nama">Atas Nama</label>
                                            <input type="text" name="atas_nama" id="atas_nama" value="<?php echo $row_rekening['atas_nama']; ?>" required>
                                        </div>

                                        <div class="field">
                                            <input type="submit" class="btn" name="update" value="Simpan Perubahan">
                                        </div>
                                    </form>
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

<?php
} else {
    header("Location: profile.php");
    exit;
}
?>