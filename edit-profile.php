<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
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
                                    <button onclick="window.location.href='profile.php'" class="signup">Kembali</button>
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
                                <?php
                                if (isset($_POST['submit'])) {
                                    $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                                    $username = $_POST['username'];
                                    $fullname = $_POST['fullname'];
                                    $age = $_POST['age'];
                                    $alamat = $_POST['alamat'];
                                    $id = $_SESSION['id'];

                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        echo "<div class='message'>
                                            <p>Format email tidak valid!</p>
                                        </div> <br>";
                                        echo "<a href='javascript:self.history.back()'><button class='btn'>Ulangi</button>";
                                    } else {
                                        $latitude = null;
                                        $longitude = null;
                                        $alamat_valid = true;

                                        // Periksa apakah alamat diisi dan valid sebelum melakukan pencarian OpenStreetMap
                                        if (!empty(trim($alamat)) && preg_match("/^[a-zA-Z0-9\s.,-]+$/", $alamat)) {
                                            $options = array(
                                                'http' => array(
                                                    'method' => "GET",
                                                    'header' => "User-Agent: PetaniPintar\r\n"
                                                )
                                            );

                                            $context = stream_context_create($options);
                                            $geocode = file_get_contents('https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($alamat), false, $context);
                                            $output = json_decode($geocode);

                                            if (isset($output[0]->lat) && isset($output[0]->lon)) {
                                                $latitude = $output[0]->lat;
                                                $longitude = $output[0]->lon;
                                            } else {
                                                $alamat_valid = false;
                                                echo "<div class='message'>
                                                    <p>Alamat tidak valid. Silakan coba lagi!</p>
                                                </div> <br>";
                                                echo "<a href='javascript:self.history.back()'><button class='btn'>Ulangi</button>";
                                            }
                                        } elseif (!empty(trim($alamat))) {
                                            $alamat_valid = false;
                                            echo "<div class='message'>
                                            <p>Alamat tidak valid. Silakan masukkan alamat yang valid!</p>
                                        </div> <br>";
                                            echo "<a href='javascript:self.history.back()'><button class='btn'>Ulangi</button>";
                                        }

                                        if ($alamat_valid) {
                                            $edit_query = "UPDATE users SET 
                                                        Username='$username', 
                                                        Email='$email', 
                                                        Fullname='$fullname', 
                                                        Age='$age'";

                                            if (!empty(trim($alamat))) {
                                                $edit_query .= ", Alamat='$alamat', latitude='$latitude', longitude='$longitude'";
                                            }

                                            $edit_query .= " WHERE Id=$id";

                                            $result = mysqli_query($con, $edit_query) or die("error occurred");

                                            if ($result) {
                                                echo "<div class='message'>
                                                    <h5><b>Profil Diperbarui!</b></h5>
                                                </div> <br>";
                                                echo "<a href='profile.php'><center><button class='signin'>Kembali ke Profil</button></center>";
                                            } else {
                                                echo "<div class='message'>
                                                    <p>Terjadi kesalahan saat mengupdate profil. Silakan coba lagi.</p>
                                                </div> <br>";
                                                echo "<a href='javascript:self.history.back()'><button class='btn'>Ulangi</button>";
                                            }
                                        }
                                    }
                                } else {
                                    $id = $_SESSION['id'];
                                    $query = mysqli_query($con, "SELECT*FROM users WHERE id=$id ");

                                    while ($result = mysqli_fetch_assoc($query)) {
                                        $res_email = $result['email'];
                                        $res_username = $result['username'];
                                        $res_fullname = $result['fullname'];
                                        $res_age = $result['age'];
                                        $res_alamat = $result['alamat'];
                                    }

                                ?>
                                    <header>Ubah Profile</header>
                                    <form action="" method="post">
                                        <div class="field input">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" value="<?php echo $res_email; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" value="<?php echo $res_username; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="fullname">Nama Lengkap</label>
                                            <input type="text" name="fullname" id="fullname" value="<?php echo $res_fullname; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="age">Umur</label>
                                            <input type="number" name="age" id="age" value="<?php echo $res_age; ?>" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" id="alamat" value="<?php echo $res_alamat; ?>" autocomplete="off">
                                        </div>

                                        <div class="field">
                                            <input type="submit" class="btn" name="submit" value="Update" required>
                                        </div>

                                    </form>
                            </div>
                        <?php } ?>
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