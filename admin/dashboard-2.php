<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashstyle.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="side-header">
            <img src="../image/admin.png" width="120" height="120">
            <h5 style="margin-top:10px;">Halo, Admin</h5>
        </div>
        <br>
        <a href="dashboard-1.php"><i class="fa-solid fa-house"></i>&nbsp Dashboard</a>
        <a href="dashboard-2.php" class="pressed"><i class="fa-solid fa-wheat-awn"></i>&nbsp&nbsp Program Tanam</a>
        <!-- <a href="dashboard-3.php"><i class="fa-brands fa-pagelines"></i> &nbsp&nbsp Pupuk Subsidi</a> -->
        <a href="dashboard-4.php"><i class="fa-solid fa-tractor"></i>&nbsp&nbspAlat</a>
        <a href="dashboard-5.php"><i class="fa-solid fa-users-gear"></i>&nbsp Users</a>
        <br><br><br><br><br><br><br>
        <a href="../menu.php"><i class="fa-solid fa-earth-americas"></i> Halaman Utama</a>
        <a href="../login.php" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar?')){ window.location.href = '../login.php'; }"><i class="fa-solid fa-power-off"></i> Keluar</a>
    </div>

    <!-- Page Content -->
    <div class="main">
        <!-- <div class="head-main">
            <h1>Program Tanam</h1>
        </div> -->
        <div class="main1">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Program Tanam</h2>
                    <a href="add-programtanam.php" class="btn btn-success">Tambah Program</a>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Waktu</th>
                            <th>Daerah</th>
                            <th>Hasil</th>
                            <th>Gambar</th>
                            <th>Jumlah</th>
                            <th>Deskripsi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM program_tanam";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['waktu']}</td>
                                <td>{$row['daerah']}</td>
                                <td>{$row['hasil']}</td>
                                <td><img src='../image/tanaman/{$row['gambar']}' alt='Gambar' width='100'></td>
                                <td>{$row['jumlah']}</td>
                                <td>{$row['deskripsi']}</td>
                                <td>{$row['latitude']}</td>
                                <td>{$row['longitude']}</td>
                                <td>
                                    <a href='edit-programtanam.php?id={$row['id']}' class='btn btn-primary btn-sm'>Ubah</a>
                                    <a href='delete-programtanam?id={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                              </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11' class='text-center'>No records found</td></tr>";
                        }

                        $con->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d31a45e58f.js" crossorigin="anonymous"></script>
</body>

</html>