<?php
session_start();
ob_start();

include("config.php");
if(!isset($_SESSION['valid'])){
     header("Location: ../index.php");
     exit;
}

if (isset($_GET['id'])) {
    $id_sewa = $_GET['id'];

    $sql = "UPDATE sewa_alat SET status_pembayaran = 'Dibatalkan', status_distribusi = 'Dibatalkan' WHERE id = $id_sewa";
    if ($con->query($sql) === TRUE) {
        $_SESSION['flash_message'] = "Pemesanan berhasil dibatalkan.";
    } else {
        $_SESSION['flash_message'] = "Error: " . $sql . "<br>" . $con->error; 
    }

} else {
    $_SESSION['flash_message'] = "ID pemesanan tidak ditemukan.";
}
header("Location: ../riwayat-pembayaran.php");
exit;
?>