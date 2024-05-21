<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $waktu = $_POST['waktu'];
        $daerah = $_POST['daerah'];
        $hasil = $_POST['hasil'];
    
        $target_dir = "image/tanaman/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    
        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        if ($_FILES["gambar"]["size"] > 500000) { // Maksimum 500KB
            echo "Maaf, file terlalu besar.";
            $uploadOk = 0;
        }
    
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.";
            $uploadOk = 0;
        }
    
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO program_tanam (nama, waktu, daerah, hasil, gambar) VALUES ('$nama', '$waktu', '$daerah', '$hasil', '".basename($_FILES["gambar"]["name"])."')";
    
                if ($con->query($sql) === TRUE) {
                    echo "Data program berhasil ditambahkan.";
                    header("Location: program-tanam.php"); 
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
    <title>PetaniPintar - Tambah Program</title>
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
                            <header>Tambah Program</header>
                            <form method="post" enctype="multipart/form-data">
                                <div class="field input">
                                    <label for="nama">Nama Tanaman</label>
                                    <input type="text" id="nama" name="nama" autocomplete="off" required>
                                </div>
                                
                                <div class="field input">
                                    <label for="waktu">Perkiraan Waktu Panen</label>
                                    <input type="number" id="waktu" name="waktu" autocomplete="off" required>
                                </div>

                                <div class="field input">
                                    <label for="daerah">Daerah</label>
                                    <input type="text" id="daerah" name="daerah" autocomplete="off" required>
                                </div>

                                <div class="field input">
                                    <label for="hasil">Hasil Panen / ton</label>
                                    <input type="number" id="hasil" name="hasil" autocomplete="off" required>
                                </div>

                                <div class="field input">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                </div>
                                
                                <div class="field">
                                    <input type="submit" class="btn" name="submit" value="Tambah">
                                </div>

                                <div class="links">
                                    Edit program yang sudah ada? <a href="edit-program-tanam.php">Edit Program</a>
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