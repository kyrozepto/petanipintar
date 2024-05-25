<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM alat WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Berhasil Delete");
                    window.location.href = "dashboard-4.php";
                    </script>';
    } else {
        echo "Error deleting record: " . $con->error;
    }

    $con->close();
}

header("Location: dashboard-4.php");
exit;