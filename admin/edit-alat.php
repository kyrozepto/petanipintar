<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM alat WHERE id = $id";
    $result = mysqli_query($con, $query);
    $alat = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $spesifikasi = $_POST['spesifikasi'];
    $id_pemilik = $_POST['id_pemilik'];
    $pemilik = $_POST['pemilik'];
    $harga = $_POST['harga'];
    $lokasi = $_POST['lokasi'];
    $latitude = !empty($_POST['latitude']) ? $_POST['latitude'] : "NULL";
    $longitude = !empty($_POST['longitude']) ? $_POST['longitude'] : "NULL";

    $error = '';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar']['tmp_name'];
        $fileName = $_FILES['gambar']['name'];
        $fileSize = $_FILES['gambar']['size'];
        $fileType = $_FILES['gambar']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions) && $fileSize <= 500000) {
            $newFileName = $id . '.' . $fileExtension;
            $uploadFileDir = '../image/alat/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = "UPDATE alat SET nama='$nama', deskripsi='$deskripsi', spesifikasi='$spesifikasi', id_pemilik=$id_pemilik, pemilik='$pemilik', harga=$harga, gambar='$newFileName', lokasi='$lokasi', latitude=$latitude, longitude=$longitude WHERE id=$id";
                if (mysqli_query($con, $query)) {
                    echo '<script>alert("Berhasil Update");
                    window.location.href = "dashboard-4.php";
                    </script>';
                } else {
                    $error = 'Database update failed';
                }
            } else {
                $error = 'File move failed';
            }
        } else {
            $error = 'Invalid file type or size';
        }
    } else {
        $query = "UPDATE alat SET nama='$nama', deskripsi='$deskripsi', spesifikasi='$spesifikasi', id_pemilik=$id_pemilik, pemilik='$pemilik', harga=$harga, lokasi='$lokasi', latitude=$latitude, longitude=$longitude WHERE id=$id";
        if (mysqli_query($con, $query)) {
            echo '<script>alert("Berhasil Update");
                    window.location.href = "dashboard-4.php";
                    </script>';
        } else {
            $error = 'Database update failed';
        }
    }

    if ($error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Alat</title>
    <link rel="icon" href="../image/icon64.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="body-fixed">
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="../menu.php">
                            <img src="../image/logo_petanipintar.png" width="40" height="40" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu">
                                <li>
                                    <button onclick="window.location.href='dashboard-4.php'" class="signup">Kembali</button>
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
            <div class="repeat-img" style="background-image: url('../image/pattern1_background.png');">
                <div section="main-banner">
                    <div class="sec-wp">
                        <div class="box-container mt-5">
                            <div class="box form-box">
                                <header>Ubah Alat</header>
                                <form action="edit-alat.php?id=<?php echo $alat['id']; ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $alat['id']; ?>">
                                    <div class="field input">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $alat['nama']; ?>" required>
                                    </div>
                                    <div class="field input">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $alat['deskripsi']; ?></textarea>
                                    </div>
                                    <div class="field input">
                                        <label for="spesifikasi">Spesifikasi</label>
                                        <textarea class="form-control" id="spesifikasi" name="spesifikasi" required><?php echo $alat['spesifikasi']; ?></textarea>
                                    </div>
                                    <div class="field input">
                                        <label for="id_pemilik">ID Pemilik</label>
                                        <input type="number" class="form-control" id="id_pemilik" name="id_pemilik" value="<?php echo $alat['id_pemilik']; ?>" required>
                                    </div>
                                    <div class="field input">
                                        <label for="pemilik">Pemilik</label>
                                        <input type="text" class="form-control" id="pemilik" name="pemilik" value="<?php echo $alat['pemilik']; ?>" required>
                                    </div>
                                    <div class="field input">
                                        <label for="harga">Harga</label>
                                        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="<?php echo $alat['harga']; ?>" required>
                                    </div>
                                    <div class="field input">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $alat['lokasi']; ?>" required>
                                    </div>
                                    <div class="field input">
                                        <label for="latitude">Latitude</label>
                                        <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude" value="<?php echo $alat['latitude']; ?>">
                                    </div>
                                    <div class="field input">
                                        <label for="longitude">Longitude</label>
                                        <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude" value="<?php echo $alat['longitude']; ?>">
                                    </div>
                                    <div class="field">
                                        <label for="gambar">Gambar</label><br>
                                        <img src="../image/alat/<?php echo $alat['gambar']; ?>" width="400"><br>
                                        <input type="file" class="form-control" id="gambar" name="gambar">
                                    </div>
                                    <div class="field">
                                        <button type="submit" class="btn">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/jquery.mixitup.min.js"></script>
    <script src="../js/swiper-bundle.min.js"></script>
    <script src="../js/gsap.min.js"></script>
    <script src="../main.js"></script>
</body>
</html>
