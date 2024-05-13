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
    <title>Petani Pintar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">            
        <div class="logo">
            <a href="menu.php">
                <img src="image/logo_petanipintar.png" width="40" height="40" alt="Logo">
            </a>
        </div>
        <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Program</a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#">Pusat Bantuan</a></li>
        </ul>
        <div>
                <a href="profile.php" class="signin">Profil Akun</a>
                <a href="index.php" class="signup">Sign Out</a>
        </div>
    </div>
    <section class="grid">
        <div class="content">
                <div class="content-left">
                <?php 
                
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

                while($result = mysqli_fetch_assoc($query)){
                        $res_Email = $result['Email'];
                        $res_Uname = $result['Username'];
                        $res_Fullname = $result['Fullname'];
                        $res_Age = $result['Age'];
                        $res_id = $result['Id'];
                }
                ?>
                <div class="info">
                    <h2>Halo <?php echo $res_Uname ?></b>!<br>Selamat datang di<br><span>PetaniPintar</span></h2>
                    <p>Jadilah penentu kemajuan pertanian masa depan melalui inovasi dan pemanfaatan teknologi digital.
                        Kamu bisa jadi wajah baru pertanian modern yang mandiri, produktif, dan berkelanjutan.</p>
                </div>
                <button>Explore Program</button>
            </div>
            <div class="content-right">
                <img src="img1.png" alt="">
            </div>
        </div>
    </section>

</body>

</html>
