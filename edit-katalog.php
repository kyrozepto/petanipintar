<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: index.php");
    exit;
}

$alat = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_alat']) && !empty($_POST['id_alat']) && !isset($_POST['update'])) {
        $id_alat = $_POST['id_alat'];

        $sql = "SELECT * FROM alat WHERE id = $id_alat";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $alat = $result->fetch_assoc();
        } else {
            echo "Alat tidak ditemukan.";
        }
    } elseif (isset($_POST['update'])) {
        $id_alat = $_POST['id_alat'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $spesifikasi = $_POST['spesifikasi'];
        $lokasi = $_POST['lokasi'];
        $pemilik = $_POST['pemilik'];
        $harga = $_POST['harga'];

        $sql = "SELECT * FROM alat WHERE id = $id_alat";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $alat = $result->fetch_assoc();
        }

        if (isset($_FILES["gambar"]) && $_FILES["gambar"]["name"] != "") {
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
                echo "File sudah ada.";
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
                    if (isset($alat['gambar']) && file_exists($target_dir . $alat['gambar'])) {
                        unlink($target_dir . $alat['gambar']);
                    }
                    $gambar = basename($_FILES["gambar"]["name"]);
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file.";
                    $gambar = $alat['gambar'];
                }
            } else {
                $gambar = $alat['gambar'];
            }
        } else {
            $gambar = $alat['gambar'];
        }

        $stmt = $con->prepare("UPDATE alat SET nama = ?, deskripsi = ?, spesifikasi = ?, lokasi = ?, pemilik = ?, harga = ?, gambar = ? WHERE id = ?");
        $stmt->bind_param("ssdsi", $nama, $deskripsi, $spesifikasi, $lokasi, $pemilik, $harga, $gambar, $id_alat);

        if ($stmt->execute()) {
            echo "Data alat berhasil diperbarui.";
            header("Location: program-sewa-alat.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Edit Informasi Alat</title>
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
                                <header>Edit Informasi Alat</header>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="field input">
                                        <label for="id_alat">Pilih Item</label>
                                        <select id="id_alat" name="id_alat" onchange="this.form.submit()">
                                            <option value=""></option>
                                            <?php
                                            $sql = "SELECT id, nama FROM alat";
                                            $result = $con->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row['id'] . '"' . ($alat['id'] == $row['id'] ? ' selected' : '') . '>' . $row['nama'] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">Tidak ada alat</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>

                                <?php if (!empty($alat)) : ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_alat" value="<?php echo $alat['id']; ?>">

                                        <div class="field input">
                                            <label for="nama">Nama Alat</label>
                                            <input type="text" id="nama" name="nama" value="<?php echo $alat['nama']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi" autocomplete="off"><?php echo $alat['deskripsi']; ?></textarea>
                                        </div>

                                        <div class="field input">
                                            <label for="spesifikasi">Spesifikasi Alat</label>
                                            <textarea id="spesifikasi" name="spesifikasi" autocomplete="off"><?php echo $alat['spesifikasi']; ?></textarea>
                                        </div>

                                        <div class="field input">
                                            <label for="lokasi">Lokasi Penyimanan</label>
                                            <input type="text" id="lokasi" name="lokasi" value="<?php echo $alat['lokasi']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="pemilik">Pemilik</label>
                                            <input type="text" id="pemilik" name="pemilik" value="<?php echo $alat['pemilik']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="harga">Harga</label>
                                            <input type="number" id="harga" name="harga" value="<?php echo $alat['harga']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="mb-2">
                                            <label for="gambar">Gambar</label>
                                            <img src="image/alat/<?php echo $alat['gambar']; ?>" width="400"><br>
                                            <input type="file" class="form-control mt-2" id="gambar" name="gambar">
                                        </div>

                                        <div class="field">
                                            <input type="submit" class="btn" name="update" value="Update">
                                        </div>

                                        <div class="links">
                                            Tambah item baru? <a href="add-katalog.php">Tambah Katalog</a>
                                        </div>

                                    </form>
                                <?php endif; ?>

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