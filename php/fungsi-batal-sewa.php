<?php
session_start();

include("config.php");
if(!isset($_SESSION['valid'])){
     header("Location: index.php");
}

if (isset($_GET['id'])) {
    $id_sewa = $_GET['id'];

    // validasi

    $sql = "UPDATE sewa_alat SET status_pembayaran = 'Dibatalkan', status_distribusi = 'Dibatalkan' WHERE id = $id_sewa";
    if ($con->query($sql) === TRUE) {
        echo "Pemesanan berhasil dibatalkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    header("Location: ../riwayat-pembayaran.php");
} else {
    echo "ID pemesanan tidak ditemukan.";
}
?>