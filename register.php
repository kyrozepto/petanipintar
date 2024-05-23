<?php 
   session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="body-fixed">
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.php">
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
                                    <button onclick="window.location.href='login.php'" class="signin">Sign In</button>
                                    <button onclick="window.location.href='index.php'" class="signup">Home</button>
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
                                
                                include("php/config.php");
                                if(isset($_POST['submit'])){
                                    $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                                    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
                                    $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'));
                                    $fullname = mysqli_real_escape_string($con, htmlspecialchars($_POST['fullname'], ENT_QUOTES, 'UTF-8'));
                                    $age = mysqli_real_escape_string($con, htmlspecialchars($_POST['age'], ENT_QUOTES, 'UTF-8'));

                                    // Validasi format email
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        echo "<div class='message'>
                                                <p>Format email tidak valid!</p>
                                            </div> <br>";
                                        echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button>";
                                    } else {
                                        // Verifikasi email unik
                                        $verify_query = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                                        if(mysqli_num_rows($verify_query) != 0){
                                            echo "<div class='message'>
                                                    <p>Email ini sudah digunakan, coba yang lain!</p>
                                                </div> <br>";
                                            echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button>";
                                        } else {
                                            // Hash password sebelum menyimpan
                                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                                            $stmt = $con->prepare("INSERT INTO users (email, password, username, fullname, age) VALUES (?, ?, ?, ?, ?)");
                                            $stmt->bind_param("ssssi", $email, $hashed_password, $username, $fullname, $age);

                                            if ($stmt->execute()) {
                                                echo "<div class='message'>
                                                        <p>Registrasi berhasil!</p>
                                                    </div> <br>";
                                                echo "<a href='login.php'><button class='btn'>Login Sekarang</button>";
                                            } else {
                                                echo "<div class='message'>
                                                        <p>Error terjadi, coba lagi!</p>
                                                    </div> <br>";
                                                echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button>";
                                            }
                                        }
                                    }
                                } else {
                                ?>

                                    <header>Sign Up</header>
                                    <form action="" method="post">
                                        <div class="field input">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" autocomplete="off" required>
                                        </div>
                                        
                                        <div class="field input">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" autocomplete="off" required>
                                        </div>
                                        
                                        <div class="field input">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="fullname">Nama Lengkap</label>
                                            <input type="text" name="fullname" id="fullname" autocomplete="off" required>
                                        </div>

                                        <div class="field input">
                                            <label for="age">Umur</label>
                                            <input type="number" name="age" id="age" autocomplete="off" required>
                                        </div>
                                        

                                        <div class="field">
                                            <input type="submit" class="btn" name="submit" value="Register" required>
                                        </div>
                                        <div class="links">
                                            Sudah memiliki akun? <a href="login.php">Sign In</a>
                                        </div>
                                    </form>
                                </div>
                                <?php } ?>
                            </div>
                        </body>
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
