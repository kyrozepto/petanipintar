<?php
session_start();

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_program_tanam = $_POST['id_program_tanam'];
    $id_user = $_SESSION['id'];

    if (isset($_POST['setuju_syarat'])) {
        $sql = "INSERT INTO user_program_tanam (id_user, id_program_tanam, tanggal_mulai, status) VALUES ($id_user, $id_program_tanam, CURDATE(), 'Berlangsung')";

        if ($con->query($sql) === TRUE) {
            header("Location: ../detail-program-tanam.php?id=$id_program_tanam");
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        header("Location: program-tanam.php");
    }
}
?>