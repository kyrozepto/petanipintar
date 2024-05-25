<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Akun Berhasil diDelete");
                    window.location.href = "dashboard-5.php";
                    </script>';
    } else {
        echo "Error deleting record: " . $con->error;
    }

    $con->close();
}

header("Location: dashboard-5.php");
exit;