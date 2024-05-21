<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Profil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
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
                                    <?php 
            
                                    $id = $_SESSION['id'];
                                    $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

                                    while($result = mysqli_fetch_assoc($query)){
                                        $res_email = $result['email'];
                                        $res_username = $result['username'];
                                        $res_fullname = $result['fullname'];
                                        $res_age = $result['age'];
                                        $res_id = $result['id'];
                                    }
                                    
                                    echo "<button onclick=\"window.location.href='edit-profile.php?Id=$res_id'\" class=\"signin\">Edit Profil</button>";
                                    ?>
                                    <button onclick="window.location.href='menu.php'" class="signup">Kembali</button>
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
                <section class="main-banner">
                    <div class="sec-wp">
                        <div class="container">
                            <div>
                                <div>
                                    <div>
                                        <p>Halo <b><?php echo $res_username ?></b>!</p>
                                    </div>
                                    <div>
                                        <p>Nama Lengkap: <b><?php echo $res_fullname ?></b></p>
                                        <p>Umur: <b><?php echo $res_age ?> tahun</b></p> 
                                        <p>Email anda adalah <b><?php echo $res_email ?></b></p>
                                        <p>Status Akun 
                                            <b>
                                            <?php
                                            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                                echo "Admin";
                                            } else {
                                                echo "Belum Diverifikasi";
                                            }
                                            ?>
                                            </b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
