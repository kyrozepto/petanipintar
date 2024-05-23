<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
        header("Location: index.php");
       }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Edit Profil</title>
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
                            if(isset($_POST['submit'])){
                                $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                                $username = $_POST['username'];
                                $fullname = $_POST['fullname'];
                                $age = $_POST['age'];

                                $id = $_SESSION['id'];
                                
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    echo "<div class='message'>
                                            <p>Format email tidak valid!</p>
                                        </div> <br>";
                                    echo "<a href='javascript:self.history.back()'><button class='btn'>Ulangi</button>";
                                } else {
                                    $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Fullname='$fullname', Age='$age' WHERE Id=$id ") or die("error occurred");

                                    if($edit_query){
                                        echo "<div class='message'>
                                            <h5><b>Profil Diperbarui!</b></h5>
                                        </div> <br>";
                                        echo "<a href='profile.php'><center><button class='signin'>Kembali ke Profil</button></center>";
                                        
                                    }
                                }
                            }else{

                                $id = $_SESSION['id'];
                                $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id ");

                                while($result = mysqli_fetch_assoc($query)){
                                    $res_email = $result['email'];
                                    $res_username = $result['username'];
                                    $res_fullname = $result['fullname'];
                                    $res_age = $result['age'];
                                }

                            ?>
                            <header>Change Profile</header>
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
