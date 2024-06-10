<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['id'];
    $alamat = $_POST['alamat'];
    $nik = $_POST['nik'];
    $luas_lahan = $_POST['luas_lahan'];
    $koordinat = $_POST['koordinat'];
    $jenis_pupuk = $_POST['jenis_pupuk'];
    $jumlah_pupuk = $_POST['jumlah_pupuk'];

    // Upload foto KTP
    $target_dir_ktp = "image/berkas_permohonan/ktp/";
    $foto_ktp = $target_dir_ktp . basename($_FILES["foto_ktp"]["name"]);
    $uploadOk = 1;
    $imageFileType_ktp = strtolower(pathinfo($foto_ktp, PATHINFO_EXTENSION));

    // Cek apakah gambar benar atau tidak
    if (isset($_POST["submit"])) {
        $check_ktp = getimagesize($_FILES["foto_ktp"]["tmp_name"]);
        if ($check_ktp !== false) {
            $uploadOk = 1;
        } else {
            echo "File yang diupload bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Cek apakah file sudah ada
    if (file_exists($foto_ktp)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["foto_ktp"]["size"] > 500000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Format file yang diperbolehkan
    if (
        $imageFileType_ktp != "jpg" && $imageFileType_ktp != "png" && $imageFileType_ktp != "jpeg"
        && $imageFileType_ktp != "gif"
    ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika $uploadOk = 0 maka upload gagal
    if ($uploadOk == 0) {
        echo "Maaf, file anda gagal diupload.";
        // Jika berhasil, upload file
    } else {
        if (move_uploaded_file($_FILES["foto_ktp"]["tmp_name"], $foto_ktp)) {
            // echo "File " . htmlspecialchars(basename($_FILES["foto_ktp"]["name"])) . " berhasil diupload.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file anda.";
        }
    }

    // Upload foto KK
    $target_dir_kk = "image/berkas_permohonan/kk/";
    $foto_kk = $target_dir_kk . basename($_FILES["foto_kk"]["name"]);
    $uploadOk = 1;
    $imageFileType_kk = strtolower(pathinfo($foto_kk, PATHINFO_EXTENSION));

    // Cek apakah gambar benar atau tidak
    if (isset($_POST["submit"])) {
        $check_kk = getimagesize($_FILES["foto_kk"]["tmp_name"]);
        if ($check_kk !== false) {
            $uploadOk = 1;
        } else {
            echo "File yang diupload bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Cek apakah file sudah ada
    if (file_exists($foto_kk)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["foto_kk"]["size"] > 500000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Format file yang diperbolehkan
    if (
        $imageFileType_kk != "jpg" && $imageFileType_kk != "png" && $imageFileType_kk != "jpeg"
        && $imageFileType_kk != "gif"
    ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika $uploadOk = 0 maka upload gagal
    if ($uploadOk == 0) {
        echo "Maaf, file anda gagal diupload.";
        // Jika berhasil, upload file
    } else {
        if (move_uploaded_file($_FILES["foto_kk"]["tmp_name"], $foto_kk)) {
            // echo "File " . htmlspecialchars(basename($_FILES["foto_kk"]["name"])) . " berhasil diupload.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file anda.";
        }
    }

    // Simpan data ke database
    $sql = "INSERT INTO permohonan_pupuk (id_user, alamat, nik, foto_ktp, foto_kk, luas_lahan, koordinat, jenis_pupuk, jumlah_pupuk) 
            VALUES ('$id_user', '$alamat', '$nik', '$foto_ktp', '$foto_kk', '$luas_lahan', '$koordinat', '$jenis_pupuk', '$jumlah_pupuk')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Permohonan pupuk berhasil diajukan!'); window.location.href='program-pupuk-subsidi.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupuk Subsidi</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/form.css">
    <style>
        ul {
            list-style-type: disc;
            margin-left: 10px;
        }
    </style>
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
                                <li><a href="menu.php">PetaniPintar</a></li>
                                <li><a href="bertani.php">Bertani</a></li>
                                <li><a href="program-tanam.php">Program Tanam</a></li>
                                <li><a href="program-pupuk-subsidi.php">Pupuk Subsidi</a></li>
                                <li><a href="program-sewa-alat.php">Sewa Alat</a></li>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                    echo '<li><a href="admin/dashboard-1.php">Kelola</a></li>';
                                }?>
                                <li>
                                    <button onclick="window.location.href='profile.php'" class="signin">Profil</button>
                                    <button onclick="if(confirm('Apakah Anda yakin ingin keluar?')){window.location.href='login.php';}" class="signup">Keluar</button>
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
            <section class="main-banner" id="home">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h2 class="h2-title">Program Pupuk Bersubsidi dengan <span>PetaniPintar</span></h2>
                                    <p>
                                        Program yang dirancang untuk membantu petani dalam meningkatkan produksi pertanian melalui akses pupuk bersubsidi yang mudah, tepat, dan akuntabel.
                                    </p>
                                    <div class="banner-btn mt-4">
                                        <a href="#form" class="sec-btn">Kirim Permohonan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img class="img-rounded" src="image/illustration/program2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
                <section class="default-banner" id="program">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sec-title text-center mb-5">
                                        <h2 class="h2-title">Tahapan Program</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img" style="background-image: url(image/program_tanam.jpg);"></div>
                                        <div class="programs-text">
                                            <h4><b>1.</b> Buat Formulir Permohonan</h4>
                                            <p>Buat dan isi formulir permohonan dengan lengkap dan benar, termasuk data diri, lahan pertanian, dan kebutuhan pupuk.
                                                Upload dokumen yang diperlukan, seperti KTP dan KK.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img" style="background-image: url(image/program_pupuk.jpg);"></div>
                                        <div class="programs-text">
                                            <h4><b>2.</b> Proses Verifikasi Berkas</h4>
                                            <p>Tim verifikator akan memeriksa kelengkapan dan keabsahan data dan dokumen yang Anda upload.
                                                Proses verifikasi dapat memakan waktu beberapa hari.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="programs-box">
                                        <div class="programs-img back-img" style="background-image: url(image/program_sewa.jpg);"></div>
                                        <div class="programs-text">
                                            <h4><b>3.</b> Notifikasi Persetujuan</h4>
                                            <p>Jika verifikasi berkas berhasil, Anda akan menerima notifikasi persetujuan program melalui email.
                                                Cetak Kartu Tani dan gunakan untuk membeli pupuk bersubsidi di toko resmi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="main-banner" id="sdk">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="banner-img-wp">
                                        <img src="image/form1.webp" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-text">
                                        <h2 class="h2-title"><span>Syarat dan Ketentuan</span> Program Pupuk</h2>
                                        <p>
                                            Berikut adalah syarat dan ketentuan yang harus dipenuhi untuk mengikuti program pupuk bersubsidi:
                                        </p>
                                        <ul>
                                            <li>Adalah petani aktif dan memiliki lahan pertanian.</li>
                                            <li>Memiliki Izin Tani yang berlaku.</li>
                                            <li>Memiliki dokumen identitas yang sah dan melampirkan foto KTP dan KK yang jelas dan valid.</li>
                                            <li>Mengisi formulir permohonan dengan benar dan lengkap.</li>
                                            <li>Menyertakan data lahan pertanian yang akurat, termasuk luas lahan dan koordinat.</li>
                                            <li>Menggunakan pupuk yang dibeli melalui program pupuk bersubsidi untuk keperluan pertanian.</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="default-banner mb-5" id="form">
                    <div class="sec-wp">
                        <div class="box-container">
                            <div class="box form-box">
                                <?php
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

                                while ($result = mysqli_fetch_assoc($query)) {
                                    $res_email = $result['email'];
                                    $res_username = $result['username'];
                                    $res_fullname = $result['fullname'];
                                    $res_age = $result['age'];
                                }
                                ?>
                                <header>Formulir Permohonan</header>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="field input">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" value="<?php echo $res_email; ?>" autocomplete="off" readonly>
                                    </div>

                                    <div class="field input">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" value="<?php echo $res_username; ?>" autocomplete="off" readonly>
                                    </div>

                                    <div class="field input">
                                        <label for="fullname">Nama Lengkap</label>
                                        <input type="text" name="fullname" id="fullname" value="<?php echo $res_fullname; ?>" autocomplete="off" readonly>
                                    </div>

                                    <div class="field input">
                                        <label for="age">Umur</label>
                                        <input type="number" name="age" id="age" value="<?php echo $res_age; ?>" autocomplete="off" readonly>
                                    </div>

                                    <div class="field input">
                                        <label for="alamat">Alamat Lengkap</label>
                                        <input type="text" name="alamat" id="alamat" autocomplete="off" required>
                                    </div>

                                    <div class="field input">
                                        <label for="nik">NIK</label>
                                        <input type="number" name="nik" id="nik" autocomplete="off" required>
                                    </div>

                                    <div class="mb-2">
                                        <label for="foto_ktp">Foto KTP</label>
                                        <input <?php if (!isset($_GET['ubah'])) {
                                                    echo "required";
                                                } ?> class="form-control" type="file" name="foto_ktp" id="foto_ktp" accept="image/*">
                                    </div>

                                    <div class="mb-2">
                                        <label for="foto_kk">Foto KK</label>
                                        <input <?php if (!isset($_GET['ubah'])) {
                                                    echo "required";
                                                } ?> class="form-control" type="file" name="foto_kk" id="foto_kk" accept="image/*">
                                    </div>

                                    <div class="field input">
                                        <label for="luas_lahan">Luas Lahan (hektar)</label>
                                        <input type="number" name="luas_lahan" id="luas_lahan" autocomplete="off" required>
                                    </div>

                                    <div class="field input">
                                        <label for="koordinat">Titik Koordinat Lahan</label>
                                        <input type="text" name="koordinat" id="koordinat" autocomplete="off" required>
                                    </div>

                                    <div class="field input">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="jenis_pupuk">Jenis Pupuk</label>
                                                <div>
                                                    <select name="jenis_pupuk" id="jenis_pupuk" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="urea">Urea</option>
                                                        <option value="NPK">NPK</option>
                                                        <option value="TSP">TSP</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="jumlah_pupuk">Jumlah Pupuk (kg)</label>
                                                <input type="number" name="jumlah_pupuk" id="jumlah_pupuk" min="1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <input type="submit" class="btn" name="submit" value="Submit" required>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="site-footer" id="help">
                <div class="top-footer section">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="footer-info">
                                        <div class="footer-logo">
                                            <a href="index.php">
                                                <img src="image/petanipintar_logo80.png" alt="Logo">
                                            </a>
                                        </div>
                                        <h5>Butuh Bantuan?</h5>
                                        <a>Hubungi kami untuk informasi lebih lanjut.</a>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="footer-flex-box">
                                        <div class="footer-menu">
                                            <h4 class="h4-title">Kontak</h4>
                                            <ul>
                                                <li><a href="#">petanipintar@gmail.com</a></li>
                                                <li><a href="#">+62 1234567890</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu food-nav-menu">
                                            <h4 class="h4-title">Menu</h4>
                                            <ul class="column-2">
                                                <li><a href="#about">Tentang Program</a></li>
                                                <li><a href="#sdk">Syarat dan Ketentuan</a></li>
                                                <li><a href="#form">Formulir</a></li>
                                                <li><a href="#help">Pusat Bantuan</a></li>
                                            </ul>
                                        </div>
                                        <div class="footer-menu">
                                            <h4 class="h4-title">Informasi Lain</h4>
                                            <ul>
                                                <li><a href="#">FAQ</a></li>
                                                <li><a href="#">Kebijakan Privasi</a></li>
                                                <li><a href="#">Syarat dan Ketentuan</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="end-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-3">
                                <a>kamipetanipintar.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>