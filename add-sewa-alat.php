<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $spesifikasi = $_POST['spesifikasi'];
    $lokasi = $_POST['lokasi'];
    $pemilik = $_POST['pemilik'];
    $harga = $_POST['harga'];

    $target_dir = "image/alat/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    if ($_FILES["gambar"]["size"] > 500000) { // Maks 500KB
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO alat (nama, deskripsi, harga, gambar) VALUES ('$nama', '$deskripsi', '$spesifikasi', '$lokasi', '$pemilik', '$harga', '" . basename($_FILES["gambar"]["name"]) . "')";

            if ($con->query($sql) === TRUE) {
                echo "Data alat berhasil ditambahkan.";
                header("Location: program-sewa-alat.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alat</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

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
                                        <button onclick="window.location.href='program-sewa-alat.php'" class="signup">Kembali</button>
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
                                    <header>Tambah Alat</header>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="field input">
                                            <label for="nama">Nama Alat</label>
                                            <input type="text" id="nama" name="nama" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi" autocomplete="off"></textarea>
                                        </div>

                                        <div class="field input">
                                            <label for="spesifikasi">Spesifikasi Alat</label>
                                            <textarea id="spesifikasi" name="spesifikasi" autocomplete="off"></textarea>
                                        </div>

                                        <div class="field input">
                                            <label for="lokasi">Daerah Penyimpanan</label>
                                            <input type="text" id="lokasi" name="lokasi" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="pemilik">Pemilik</label>
                                            <input type="text" id="pemilik" name="pemilik" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="harga">Harga</label>
                                            <input type="number" id="harga" name="harga" autocomplete="off" required>
                                        </div>

                                        <div class="mb-2">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar">
                                        </div>

                                        <div class="field">
                                            <input type="submit" class="btn" name="submit" value="Tambah">
                                        </div>

                                        <div class="links">
                                            Ubah item yang sudah ada? <a href="edit-sewa-alat.php">Ubah Katalog</a>
                                        </div>
                                    </form>
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