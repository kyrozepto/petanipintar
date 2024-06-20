<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

$userId = $_SESSION['id'];
$userSql = "SELECT latitude, longitude, alamat FROM users WHERE id = '$userId'";
$userResult = $con->query($userSql);
$userData = $userResult->fetch_assoc();

$userLatitude = $userData['latitude'];
$userLongitude = $userData['longitude'];
$userAlamat = $userData['alamat'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petani Pintar - Bertani</title>
    <link rel="icon" href="image/icon64.png" type="image/png">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
        #map {
            height: 300px;
            border-radius: 15px;
        }

        .katalog-box-popup {
            height: 300px;
        }

        .katalog-box-popup .katalog-tanam-img {
            max-height: 150px;
        }

        .leaflet-popup-close-button {
            display: none !important;
        }

        .p-map {
            line-height: 21px;
            font-size: 16px;
        }

        .h3-map {
            font-size: 18px;
            font-weight: 600;
            font-family: 'Poppins';
        }

        .signin {
            font-family: 'Poppins';
        }

        .question-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #weather-info {
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #weather-info .col-lg-4 {
            display: flex;
            flex-direction: column;
        }
        #weather-info img {
            width: 80px;
            height: auto;
        }

        #weather-info p {
            margin-bottom: 5px;
        }

        @media (max-width: 575px) {
            #map {
                height: 360px;
            }
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
            <section class="main-banner" id="about">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h2 class="h2-title">Mulai Petualangan Bertani dengan <span>PetaniPintar</span></h2>
                                    <p>
                                        Temukan panduan, tips, dan peluang bertani terbaik di sekitar Anda. </p>
                                    <div class="banner-btn mt-4">
                                        <a href="#program" class="sec-btn">Mulai Bertani</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <img class="img-rounded" src="image/illustration/program3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="repeat-img" style="background-image: url(image/pattern1_background.png);">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center">
                            <h2 class="h2-title mb-0">Dashboard</h2>
                            <h2 class="h2-title"><span>Bertani</span></h2>
                            <div class="text-center question-container">
                                <p class="mt-4">
                                    Punya pertanyaan seputar pertanian?
                                </p>
                                <a href="bot.php" class="add">
                                    Tanya Gemini
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="mb-4" id="program">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="sec-title">
                                <h5 class="mb-4">Program Tanam Anda</h5>
                            </div>
                            <div class="row katalog-slider">
                                <div class="swiper-wrapper">
                                    <?php
                                    $sqlProgramTanam = "SELECT * FROM program_tanam WHERE id IN (SELECT id_program_tanam FROM user_program_tanam WHERE id_user = $userId)";
                                    $resultProgramTanam = $con->query($sqlProgramTanam);
                                    if ($resultProgramTanam->num_rows > 0) {
                                        while ($row = $resultProgramTanam->fetch_assoc()) {
                                            echo '<div class="col-lg-6 swiper-slide">
                                                    <div class="katalog-box">
                                                        <div style="background-image: url(image/tanaman/' . $row["gambar"] . ');" class="katalog-tanam-img back-img"></div>
                                                        <h3 onclick="window.location.href=\'detail-program-tanam.php?id=' . $row["id"] . '\'" class="h3-title">' . $row["nama"] . '</h3>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <p class="p-katalog">Perkiraan<br>' . $row["waktu"] . ' bulan</p> 
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <p class="p-katalog">' . $row["daerah"] . '</p>
                                                            </div>
                                                            <p class="p-katalog">Rp. ' . number_format($row["hasil"], 0, ',', '.') . ' / ton</p>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li>
                                                                    <button onclick="window.location.href=\'detail-program-tanam.php?id=' . $row["id"] . '\'" class="signin">Lihat Detail</button>';

                                            $sql_user_program = "SELECT * FROM user_program_tanam WHERE id_user = " . $_SESSION['id'] . " AND id_program_tanam = " . $row["id"];
                                            $result_user_program = $con->query($sql_user_program);
                                            if ($result_user_program->num_rows > 0) {
                                                echo '<button onclick="window.location.href=\'kirim-hasil-panen.php?id=' . $row["id"] . '\'" class="signup">Kirim</button>';
                                            } else {
                                                echo '<button onclick="window.location.href=\'mulai-program-tanam.php?id=' . $row["id"] . '\'" class="signup">Mulai</button>';
                                            }
                                            
                                            echo '</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>';
                                        }
                                    } else {
                                        echo '<div class="col-lg-12 swiper-slide">
                                            <div class="katalog-box">
                                                <p class="p-katalog">Anda belum memulai program tanam. Temukan program tanam menarik di halaman Program Tanam.</p>
                                                <div>
                                                    <ul>
                                                        <li>
                                                            <button onclick="window.location.href=\'program-tanam.php\'" class="signup">Cari Program Tanam</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                                <div class="swiper-button-wp">
                                    <div class="swiper-button-prev swiper-button">
                                        <i class="uil uil-angle-left"></i>
                                    </div>
                                    <div class="swiper-button-next swiper-button">
                                        <i class="uil uil-angle-right"></i>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="default-banner" id="peta">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <div class="sec-title mb-4 text-center">
                                        <h3 class="h3-title mb-1"><span>Informasi Cuaca</span></h3>
                                        <h3 class="h3-title">di Wilayah Anda</h3>
                                    </div>
                                    <div id="map" class="mb-4"></div>
                                    <div id="weather-info"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="banner-text mt-5">
                                            <p style="text-align: justify;">
                                                Dapatkan informasi tentang cuaca dan kondisi wilayah di daerah Anda untuk meningkatkan hasil panen dan
                                                memilih tanaman yang paling cocok untuk Anda.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
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
                                                <li><a href="#program">Program Tanam</a></li>
                                                <li><a href="#peta">Peta Rekomendasi</a></li>
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
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
    var map = L.map('map');
    var userLatitude = parseFloat(<?php echo $userLatitude; ?>);
    var userLongitude = parseFloat(<?php echo $userLongitude; ?>);

    if (!isNaN(userLatitude) && !isNaN(userLongitude) && (userLatitude !== 0 || userLongitude !== 0)) {
        map.setView([userLatitude, userLongitude], 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var userMarker = L.marker([userLatitude, userLongitude]).addTo(map);
        userMarker.bindPopup('<p class="p-map m-0"><b>Lokasi Anda</b><br><?php echo $userAlamat; ?></p>').openPopup();
        userMarker.setZIndexOffset(1000);

        // Fungsi untuk mengambil dan menampilkan data cuaca
        function getWeather(latitude, longitude) {
            const apiUrl = `php/get-weather.php?lat=${latitude}&lon=${longitude}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const weatherInfo = document.getElementById('weather-info');
                    weatherInfo.innerHTML = `
                        <div class="row text-center" style="margin: 0 10vh">
                                <div class="col-lg-3">
                                    <img src="https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="Cuaca saat ini">
                                    <p class="p-map">${data.weather[0].description}</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Suhu:</p>
                                    <p class="p-map">${Math.round(data.main.temp)}°C</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Kelembaban:</p>
                                    <p class="p-map">${data.main.humidity}%</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Kecepatan Angin:</p>
                                    <p class="p-map">${data.wind.speed} m/s ke ${getWindDirection(data.wind.deg)}</p>
                                </div>
                            </div>
                            <div class="row text-center" style="margin: 0 10vh">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Tekanan Udara:</p>
                                    <p class="p-map">${data.main.pressure} hPa</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Visibilitas:</p>
                                    <p class="p-map">${data.visibility / 1000} km</p>
                                </div>
                                <div class="col-lg-3">
                                </div>
                            </div>
                            <div class="row text-center mt-4" style="margin: 0 10vh">
                                <div class="col-lg-3">
                                    <p class="p-map"><b>Tanggal dan Waktu</b></p>
                                    <p class="p-map">${new Date(data.dt * 1000).toLocaleDateString('id-ID')} ${new Date(data.dt * 1000).toLocaleTimeString('id-ID')}</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Matahari Terbit:</p>
                                    <p class="p-map">${new Date(data.sys.sunrise * 1000).toLocaleTimeString('id-ID')}</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="p-map">Matahari Terbenam:</p>
                                    <p class="p-map">${new Date(data.sys.sunset * 1000).toLocaleTimeString('id-ID')}</p>
                                </div>
                                <div class="col-lg-3">
                                </div>
                            </div>
                        `;

                    // Menambahkan marker dengan ikon cuaca ke peta
                    var weatherIcon = L.icon({
                        iconUrl: `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`,
                        iconSize: [50, 50],
                    });

                    L.marker([latitude, longitude], { icon: weatherIcon })
                        .addTo(map)
                        .bindPopup(`
                            <p class="p-map m-0"><b>${data.name}, ${data.sys.country}</b><br>
                            Suhu: ${data.main.temp}°C<br>
                            ${data.weather[0].description}
                        `)
                        .openPopup();
                })
                .catch(error => {
                    console.error('Error fetching weather data:', error);
                });
        }

        function getWindDirection(degrees) {
            const directions = ['Utara', 'Timur Laut', 'Timur', 'Tenggara', 'Selatan', 'Barat Daya', 'Barat', 'Barat Laut'];
            const index = Math.round(((degrees %= 360) < 0 ? degrees + 360 : degrees) / 45) % 8;
            return directions[index];
        }

        getWeather(userLatitude, userLongitude); 

    } else {
        map.setView([-7.0, 110.0], 7); // Tampilan peta default 
        console.error('Lokasi pengguna tidak valid.');
    }
</script>
</body>

</html>