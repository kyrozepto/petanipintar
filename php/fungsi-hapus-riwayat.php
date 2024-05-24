<?php
session_start();
include("config.php");

if(isset($_SESSION['valid']) && isset($_GET['id'])) {
    $id_user = $_SESSION['id'];
    $id_sewa = $_GET['id'];

    if(!is_numeric($id_sewa)) {
        die("Invalid request");
    }

    $sql = "DELETE FROM sewa_alat WHERE id = ? AND id_user = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $id_sewa, $id_user); 

    if ($stmt->execute()) {
        header("Location: ../riwayat-pembayaran.php");
    } else {
        echo "Error deleting record: " . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: ../riwayat-pembayaran.php");
}
?>