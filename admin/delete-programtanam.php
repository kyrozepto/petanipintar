<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM program_tanam WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Berhasil Hapus");
                    window.location.href = "dashboard-2.php";
                    </script>';
    } else {
        echo "Error deleting record: " . $con->error;
    }

    $con->close();
}

header("Location: dashboard-2.php");
exit;