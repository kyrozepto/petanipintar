<?php

include("config.php");

if (isset($_GET['lat']) && isset($_GET['lon'])) {
    $latitude = $_GET['lat'];
    $longitude = $_GET['lon'];
    $apiKey = "";

    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude&appid=$apiKey&lang=id&units=metric";

    $weatherData = file_get_contents($apiUrl);
    echo $weatherData;
} else {
    echo json_encode(["error" => "Invalid parameters."]);
}
?>
