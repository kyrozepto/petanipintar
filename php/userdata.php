<?php
session_start();

include("config.php");
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
$adaProgramDekat = false;

if (!empty($userAlamat)) {
    $sql = "SELECT *, 
            (6371 * 2 * ASIN(SQRT(POWER(SIN((latitude * PI() / 180) - ($userLatitude * PI() / 180)) / 2, 2) + COS($userLatitude * PI() / 180) * 
            COS(latitude * PI() / 180) * POWER(SIN((longitude * PI() / 180) - ($userLongitude * PI() / 180)) / 2, 2)))) AS distance
            FROM program_tanam
            HAVING distance < 50
            ORDER BY distance ASC
            LIMIT 5";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $adaProgramDekat = true;
    }
} else {
}

if ($result->num_rows > 0) {
        echo '  <hr><p>Berikut adalah rekomendasi program tanam yang ada di sekitar anda:</p>';
        while ($row = $result->fetch_assoc()) {
        $jarak = $row['distance'];
        $jarakBulat = number_format($jarak, 1, '.', '');

        echo '  <div class="col-lg-3 swiper-slide">
                <div class="katalog-box mb-4">
                <p class="p-katalog mb-1" style="text-align: right;">' . $jarakBulat . ' km</p>
                <div style="background-image: url(image/tanaman/' . $row["gambar"] . ');" class="katalog-tanam-img back-img"></div>
                <div class="row">
                <div class="col-lg-12">
                        <h3 onclick="window.location.href=\'detail-program-tanam.php?id=' . $row["id"] . '\'" class="h3-title">' . $row["nama"] . '</h3>
                </div>
                </div>
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

        echo   '</li>
                </ul>
                </div>
        </div>
        </div>';
        }
} else {
        echo "Tidak ada program tanam yang tersedia saat ini.";
}


?>