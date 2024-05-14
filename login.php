<?php 
session_start();
include("php/config.php");

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
    $row = mysqli_fetch_assoc($result);

    if(is_array($row) && !empty($row)){
        $_SESSION['valid'] = $row['Email'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['fullname'] = $row['Fullname'];
        $_SESSION['age'] = $row['Age'];
        $_SESSION['id'] = $row['Id'];
        header("Location: menu.php");
        exit();
    } else {
        $error_message = "Wrong Username or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetaniPintar - Login</title>
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
                                    <button onclick="window.location.href='register.php'" class="signin">Sign Up</button>
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
                        <div class="box-container">
                            <div class="box form-box">
                                <header>Login</header>
                                <form action="" method="post">
                                    <div class="field input">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" autocomplete="off" required>
                                    </div>

                                    <div class="field input">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" autocomplete="off" required>
                                    </div>

                                    <div class="field">
                                        <input type="submit" class="btn" name="submit" value="Login" required>
                                    </div>
                                    <div class="links">
                                        Belum memiliki akun? <a href="register.php">Daftar Sekarang</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
