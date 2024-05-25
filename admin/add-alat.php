<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $spesifikasi = $_POST['spesifikasi'];
    $id_pemilik = $_POST['id_pemilik'];
    $pemilik = $_POST['pemilik'];
    $harga = $_POST['harga'];
    $lokasi = $_POST['lokasi'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $error = '';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar']['tmp_name'];
        $fileName = $_FILES['gambar']['name'];
        $fileSize = $_FILES['gambar']['size'];
        $fileType = $_FILES['gambar']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions) && $fileSize <= 500000) {
            $newFileName = uniqid() . '.' . $fileExtension;
            $uploadFileDir = '../image/alat/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = "INSERT INTO alat (nama, deskripsi, spesifikasi, id_pemilik, pemilik, harga, gambar, lokasi, latitude, longitude) 
                          VALUES ('$nama', '$deskripsi', '$spesifikasi', $id_pemilik, '$pemilik', $harga, '$newFileName', '$lokasi', $latitude, $longitude)";
                if (mysqli_query($con, $query)) {
                    echo '<script>alert("Berhasil menambah alat");
                    window.location.href = "dashboard-4.php";
                    </script>';
                } else {
                    $error = 'Database insertion failed';
                }
            } else {
                $error = 'File move failed';
            }
        } else {
            $error = 'Invalid file type or size';
        }
    } else {
        $error = 'No file uploaded or file upload error';
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
    <title>Add Alat</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Alat Baru</h2>
        <form action="add-alat.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="spesifikasi">Spesifikasi</label>
                <textarea class="form-control" id="spesifikasi" name="spesifikasi" required></textarea>
            </div>
            <div class="form-group">
                <label for="id_pemilik">ID Pemilik</label>
                <input type="number" class="form-control" id="id_pemilik" name="id_pemilik" required>
            </div>
            <div class="form-group">
                <label for="pemilik">Pemilik</label>
                <input type="text" class="form-control" id="pemilik" name="pemilik" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" step="0.01" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude">
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
