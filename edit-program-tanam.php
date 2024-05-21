<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: index.php");
    exit;
}

$program = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_program_tanam']) && !empty($_POST['id_program_tanam']) && !isset($_POST['update'])) {
        $id_program_tanam = $_POST['id_program_tanam'];

        $sql = "SELECT * FROM program_tanam WHERE id = $id_program_tanam";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $program = $result->fetch_assoc();
        } else {
            echo "Program tidak ditemukan.";
        }
    } elseif (isset($_POST['update'])) {
        $id_program_tanam = $_POST['id_program_tanam'];
        $nama = $_POST['nama'];
        $waktu = $_POST['waktu'];
        $daerah = $_POST['daerah'];
        $hasil = $_POST['hasil'];

        $sql = "SELECT * FROM program_tanam WHERE id = $id_program_tanam";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $program = $result->fetch_assoc();
        }

        if (isset($_FILES["gambar"]) && $_FILES["gambar"]["name"] != "") {
            $target_dir = "image/tanaman/";
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
                    if (isset($program['gambar']) && file_exists($target_dir . $program['gambar'])) {
                        unlink($target_dir . $program['gambar']);
                    }
                    $gambar = basename($_FILES["gambar"]["name"]);
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file.";
                    $gambar = $program['gambar'];
                }
            } else {
                $gambar = $program['gambar'];
            }
        } else {
            $gambar = $program['gambar']; 
        }

        $stmt = $con->prepare("UPDATE alat SET nama = ?, waktu = ?, daerah = ?, hasil = ?, gambar = ? WHERE id = ?");
        $stmt->bind_param("ssdsi", $nama, $waktu, $daerah, $hasil, $gambar, $id_program_tanam);

        if ($stmt->execute()) {
            echo "Program Tanam berhasil diperbarui.";
            header("Location: program-tanam.php");
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
    <title>PetaniPintar - Edit Program Tanam</title>
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
                                                <button onclick="window.location.href='program-tanam.php'" class="signup">Kembali</button>
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
                                <header>Edit Informasi Program</header>
                                
                                <form method="post" enctype="multipart/form-data">
                                    <div class="field input">
                                        <label for="id_program_tanam">Pilih Program Tanam</label>
                                        <select id="id_program_tanam" name="id_program_tanam" onchange="this.form.submit()">
                                            <option value=""></option>
                                            <?php
                                            $sql = "SELECT id, nama FROM program_tanam";
                                            $result = $con->query($sql);

                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="'.$row['id'].'"'.($program['id'] == $row['id'] ? ' selected' : '').'>'.$row['nama'].'</option>';
                                                }
                                            } else {
                                                echo '<option value="">Tidak ada program</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>

                                <?php if (!empty($program)): ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_program_tanam" value="<?php echo $program['id']; ?>">

                                        <div class="field input">
                                            <label for="nama">Nama Tanaman</label>
                                            <input type="text" id="nama" name="nama" value="<?php echo $program['nama']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="waktu">Perkiraan Waktu Panen</label>
                                            <input type="number" id="waktu" name="waktu" value="<?php echo $program['waktu']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="daerah">Daerah</label>
                                            <input type="text" id="daerah" name="daerah" value="<?php echo $program['daerah']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="hasil">Hasil Panen / ton</label>
                                            <input type="number" id="hasil" name="hasil" value="<?php echo $program['hasil']; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="gambar">Gambar</label>
                                            <img src="image/tanaman/<?php echo $program['gambar']; ?>" width="400"><br>
                                            <input type="file" class="form-control" id="gambar" name="gambar">
                                        </div>

                                        <div class="field">
                                            <input type="submit" class="btn" name="update" value="Update">
                                        </div>

                                        <div class="links">
                                                Tambah item baru? <a href="add-program-tanam.php">Tambah Program</a>
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