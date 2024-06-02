<?php
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

echo json_encode(['apiKey' => API_KEY]);
?>
