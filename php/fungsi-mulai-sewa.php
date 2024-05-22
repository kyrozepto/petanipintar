<?php
session_start();

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_alat = $_POST['id_alat'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // validasi data
    if (!filter_var($id_alat, FILTER_VALIDATE_INT)) {
        echo "ID alat tidak valid.";
        exit; 
    }
    $metode_valid = ['transfer_bank', 'e_wallet'];
    if (!in_array($metode_pembayaran, $metode_valid)) {
        echo "Metode pembayaran tidak valid.";
        exit;
    }

    $id_user = $_SESSION['id']; 
    $sql = "INSERT INTO sewa_alat (id_user, id_alat, metode_pembayaran) VALUES ('$id_user', '$id_alat', '$metode_pembayaran')";

    if ($con->query($sql) === TRUE) {
        header("Location: ../menunggu-pembayaran.php?id_alat=" . $id_alat); 
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>