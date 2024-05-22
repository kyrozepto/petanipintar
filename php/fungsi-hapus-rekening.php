<?php
session_start();
include("config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_rekening'])) {
    $id_rekening = $_POST['id_rekening'];

    $id_user = $_SESSION['id']; 
    $delete_query = "DELETE FROM rekening_pemilik WHERE id = '$id_rekening' AND id_user = '$id_user'";

    if ($con->query($delete_query) === TRUE) {
        echo "<script>
                alert('Rekening berhasil dihapus!');
                window.location.href = '../profile.php';
              </script>";
    } else {
        echo "Error: " . $delete_query . "<br>" . $con->error;
    }
} else {
    header("Location: ../profile.php");
    exit;
}
?>