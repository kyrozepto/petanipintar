<?php
session_start();
include('config.php');

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $aksi = $_POST['aksi'];

    if (!is_numeric($id) || empty($aksi)) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
        exit;
    }

    if ($aksi === 'update_status_pembayaran') {
        $statusPembayaran = $_POST['status_pembayaran'];

        if (!in_array($statusPembayaran, ['Belum Dibayar', 'Menunggu Konfirmasi', 'Pembayaran Ditolak', 'Lunas', 'Dibatalkan'])) {
            echo json_encode(['status' => 'error', 'message' => 'Status pembayaran tidak valid']);
            exit;
        }

        $sql = "UPDATE sewa_alat SET status_pembayaran = '$statusPembayaran' WHERE id = $id";
        if ($con->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Status pembayaran berhasil diubah']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengubah status pembayaran']);
        }
    } 

    if ($aksi === 'update_status_distribusi') {
        $statusDistribusi = $_POST['status_distribusi'];

        if (!in_array($statusDistribusi, ['Menunggu Pembayaran', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'])) {
            echo json_encode(['status' => 'error', 'message' => 'Status distribusi tidak valid']);
            exit;
        }

        $sql = "UPDATE sewa_alat SET status_distribusi = '$statusDistribusi' WHERE id = $id";
        if ($con->query($sql) === TRUE) {
            $sql_alat = "SELECT a.nama FROM sewa_alat sa JOIN alat a ON sa.id_alat = a.id WHERE sa.id = $id";
            $result_alat = $con->query($sql_alat);
            $row_alat = $result_alat->fetch_assoc();
            $nama_alat = $row_alat['nama'];

            // Simpan notifikasi ke session
            if (!isset($_SESSION['notifikasi'])) {
                $_SESSION['notifikasi'] = [];
            }
            $_SESSION['notifikasi'][] = [
                'type' => 'sewa_alat',
                'message' => "Peminjaman Alat: $nama_alat\nPesanan Anda $statusDistribusi!"
            ];

            echo json_encode(['status' => 'success', 'message' => 'Status diubah']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengubah status']);
        }
    }
    $con->close();
}

?>