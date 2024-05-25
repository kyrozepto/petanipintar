<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM program_tanam WHERE id = $id";
    $result = mysqli_query($con, $query);
    $program = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $daerah = $_POST['daerah'];
    $hasil = $_POST['hasil'];
    $jumlah = $_POST['jumlah'];
    $deskripsi = $_POST['deskripsi'];
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
            $newFileName = $id . '.' . $fileExtension;
            $uploadFileDir = '../image/tanaman/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = "UPDATE program_tanam SET nama='$nama', waktu=$waktu, daerah='$daerah', hasil=$hasil, jumlah=$jumlah, deskripsi='$deskripsi', latitude=$latitude, longitude=$longitude, gambar='$newFileName' WHERE id=$id";
                if (mysqli_query($con, $query)) {
                    echo '<script>alert("Berhasil Update");
                    window.location.href = "dashboard-2.php";
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
        $query = "UPDATE program_tanam SET nama='$nama', waktu=$waktu, daerah='$daerah', hasil=$hasil, jumlah=$jumlah, deskripsi='$deskripsi', latitude=$latitude, longitude=$longitude WHERE id=$id";
        if (mysqli_query($con, $query)) {
            echo '<script>alert("Berhasil Update");
                    window.location.href = "dashboard-2.php";
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
    <title>Ubah Program Tanam</title>
    <link rel="icon" href="../image/icon64.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Ubah Program Tanam</h2>
        <form action="edit-programtanam.php?id=<?php echo $program['id']; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $program['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $program['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="number" class="form-control" id="waktu" name="waktu" value="<?php echo $program['waktu']; ?>" required>
            </div>
            <div class="form-group">
                <label for="daerah">Daerah</label>
                <input type="text" class="form-control" id="daerah" name="daerah" value="<?php echo $program['daerah']; ?>" required>
            </div>
            <div class="form-group">
                <label for="hasil">Hasil</label>
                <input type="number" step="0.01" class="form-control" id="hasil" name="hasil" value="<?php echo $program['hasil']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $program['jumlah']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $program['deskripsi']; ?>">
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude" value="<?php echo $program['latitude']; ?>">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude" value="<?php echo $program['longitude']; ?>">
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label><br>
                <img src="../image/tanaman/<?php echo $program['gambar']; ?>" width="400"><br>
                <input type="file" class="form-control mt-2" id="gambar" name="gambar">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
