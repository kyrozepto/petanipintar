<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM permohonan_pupuk WHERE id = $id";
    $result = mysqli_query($con, $query);
    $permohonan = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $alasan_penolakan = isset($_POST['alasan_penolakan']) ? $_POST['alasan_penolakan'] : NULL;

    $query = "UPDATE permohonan_pupuk SET status='$status', alasan_penolakan = '$alasan_penolakan' WHERE id=$id";
    if (mysqli_query($con, $query)) {
        echo '<script>alert("Status permohonan berhasil diperbarui.");
        window.location.href = "dashboard-3.php";
        </script>';
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui status permohonan: " . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Status Permohonan</title>
    <link rel="icon" href="../image/icon64.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <script>
        function toggleAlasanPenolakan() {
            var alasanPenolakanDiv = document.getElementById("alasan-penolakan");
            var statusSelect = document.getElementById("status");
            var selectedStatus = statusSelect.options[statusSelect.selectedIndex].value;

            if (selectedStatus === "Ditolak") {
                alasanPenolakanDiv.style.display = "block";
            } else {
                alasanPenolakanDiv.style.display = "none";
            }
        }
    </script>
</head>
<body class="body-fixed">
    <header class="site-header">
        </header>

    <div id="viewport">
        <div id="js-scroll-content">
            <div class="repeat-img" style="background-image: url('../image/pattern1_background.png');">
                <div section="main-banner">
                    <div class="sec-wp">
                        <div class="box-container mt-5">
                            <div class="box form-box">
                                <header>Ubah Status Permohonan</header>
                                <form action="edit-permohonan-pupuk.php?id=<?php echo $permohonan['id']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $permohonan['id']; ?>">
                                    <div class="field input">
                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status" onchange="toggleAlasanPenolakan()" required>
                                            <option value="Menunggu Konfirmasi" <?php if ($permohonan['status'] == 'Menunggu Konfirmasi') echo 'selected'; ?>>Menunggu Konfirmasi</option>
                                            <option value="Diproses" <?php if ($permohonan['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                                            <option value="Disetujui" <?php if ($permohonan['status'] == 'Disetujui') echo 'selected'; ?>>Disetujui</option>
                                            <option value="Ditolak" <?php if ($permohonan['status'] == 'Ditolak') echo 'selected'; ?>>Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="field input" id="alasan-penolakan" style="display: <?php echo $permohonan['status'] == 'Ditolak' ? 'block' : 'none'; ?>;">
                                        <label for="alasan_penolakan">Alasan Penolakan:</label>
                                        <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan"><?php echo $permohonan['alasan_penolakan']; ?></textarea>
                                    </div>
                                    <div class="field">
                                        <button type="submit" class="btn">Update Status</button>
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