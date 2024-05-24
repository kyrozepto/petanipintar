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
    <title>PetaniPintar - Mulai Program</title>
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
                                    <button onclick="history.back()" class="signup">Kembali</button>
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
                                if (isset($_GET['id'])) {
                                    $id_program_tanam = $_GET['id'];

                                    $sql_program = "SELECT * FROM program_tanam WHERE id = $id_program_tanam";
                                    $result_program = $con->query($sql_program);
                                    $row_program = $result_program->fetch_assoc();

                                    $sql_user_program = "SELECT * FROM user_program_tanam WHERE id_user = " . $_SESSION['id'] . " AND id_program_tanam = " . $id_program_tanam;
                                    $result_user_program = $con->query($sql_user_program);

                                    if ($result_user_program->num_rows > 0) {
                                        header("Location: detail-program-tanam.php?id=$id_program_tanam");
                                    } else {
                                ?>

                                        <section class="konfirmasi-program">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 mt-2">
                                                        <h3>
                                                            <center><b>Konfirmasi Persetujuan</center></b>
                                                        </h3>
                                                        <p>
                                                            <center>Program Tanam: <?php echo $row_program['nama']; ?></center>
                                                        </p>
                                                        <p>Dengan memulai program tanam ini, Anda menyetujui syarat dan ketentuan yang berlaku.</p>
                                                        <form action="php/fungsi-mulai-program.php" method="post">
                                                            <input type="hidden" name="id_program_tanam" value="<?php echo $id_program_tanam; ?>">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="setuju_syarat" id="setuju_syarat" required>
                                                                <label class="form-check-label" for="setuju_syarat">
                                                                    Saya menyetujui seluruh <b>Syarat dan Ketentuan</b> yang berlaku.
                                                                </label>
                                                            </div>
                                                            <div class="field mt-3">
                                                                <button type="submit" class="btn">Mulai Program</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                <?php
                                    }
                                }
                                ?>
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