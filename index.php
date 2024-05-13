<?php
   session_start();

   include("php/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petani Pintar</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

</head>
<body>
    <div class="nav">            
        <div class="logo">
            <a href="index.php">
                <img src="image/logo_petanipintar.png" width="40" height="40" alt="Logo">
            </a>
        </div>
        <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#program">Program</a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#">Pusat Bantuan</a></li>
        </ul>
        <div>
            <a href="login.php" class="signin">Sign In</a>
            <a href="register.php" class="signup">Sign Up</a>
        </div>
    </div>
    <section class="grid">
        <div class="content">
            <div class="content-left">
                <div class="info">
                    <h2>Tumbuh Bersama <span>PetaniPintar</span></h2>
                    <p>Jadilah penentu kemajuan pertanian masa depan melalui inovasi dan pemanfaatan teknologi digital.
                        Kamu bisa jadi wajah baru pertanian modern yang mandiri, produktif, dan berkelanjutan.</p>
                </div>
                <a href="#program" class="signup">Explore Program</a>
            </div>
            <div class="content-right">
                <img src="img1.png" alt="">
            </div>
        </div>
    </section>

    <!-- main-content2 -->
    <div class="grid" id="program">
        <div class="main3">
            <h2><center><span>Learn More</span><br>About our Program</center></h2>
        </div>
        <div class="content">
            <div class="content-left">
                <img src="image/Componen5.png" alt="">
            </div>
            <div class="content-right">
                <h1>What is <span>PetaniPintar</span> and<br>How Does it Work?</h1>
                <p>Petani Pintar is a concept that combines technology and artificial intelligence to enhance productivity and efficiency in agriculture. 
                    Through the implementation of various technological solutions such as sensors, data analytics, and smart software, 
                    Petani Pintar enables farmers to monitor crop conditions, manage resources more efficiently, and optimize farming processes as a whole. 
                    Thus, Petani Pintar <span>can help increase crop yields, reduce production costs, and maintain environmental sustainability in the agriculture industry</span></p>
                <h2>Ready to join the revolution?</h2>
                <a href="register.php" class="round_button">Daftarkan saya</a>
            </div>
        </div>
    </div>
    <!-- main-content3 -->
    <div class="main-content3">
        <div class="main3">
            <h1>Start <span>PetaniPintar</span> in 3 steps</h1>
        </div>
        <div class="cont2">
            <div class="main6">
                <h2>1</h2>
                <h2>Kunjungi Situs</h2>
                <p>Kunjungi Situs Website Petani Pintar pada link <span>kamipetanipintar.com</span> 
                Pada Browser kesayangan anda.</p>
                <h1>2 </h1>
                <h3>Buat Akun</h3>
                <p>Pilih login/resister pada menu pojok kanan atas. Kemudian lakukan registrasi akun baru anda. Setelah membuat akun tunggu hingga akun baru anda diverifikasi.</p>
                <h1>3 </h1>
                <h3>Pilih Program</h3>
                <p>Setelah berhasil login anda dapat menikmati berbagai program dan fitur yang petani pintar sediakan. </p>
            </div>
            <div class="main7">
                <img src="image/Component6.png" alt="">
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
