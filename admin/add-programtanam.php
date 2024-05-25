<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $daerah = $_POST['daerah'];
    $hasil = $_POST['hasil'];
    $jumlah = $_POST['jumlah'];
    $koordinat = $_POST['koordinat'];
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
            $uploadFileDir = '../image/tanaman/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = "INSERT INTO program_tanam (nama, waktu, daerah, hasil, jumlah, koordinat, latitude, longitude, gambar) VALUES ('$nama', $waktu, '$daerah', $hasil, $jumlah, '$koordinat', $latitude, $longitude, '$newFileName')";
                if (mysqli_query($con, $query)) {
                    echo '<script>alert("Berhasil Update");
                    window.location.href = "dashboard-2.php";
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
    <title>Add Program Tanam</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Program Tanam</h2>
        <form action="add-programtanam.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="number" class="form-control" id="waktu" name="waktu" required>
            </div>
            <div class="form-group">
                <label for="daerah">Daerah</label>
                <input type="text" class="form-control" id="daerah" name="daerah" required>
            </div>
            <div class="form-group">
                <label for="hasil">Hasil</label>
                <input type="number" step="0.01" class="form-control" id="hasil" name="hasil" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <div class="form-group">
                <label for="koordinat">Koordinat</label>
                <input type="text" class="form-control" id="koordinat" name="koordinat">
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
