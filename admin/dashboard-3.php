<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Admin</title>
    <link rel="icon" href="../image/icon64.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashstyle.css">
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="side-header">
            <img src="../image/admin.png" class="admin-img" width="120" height="120">
            <h5 style="margin-top:10px;">Halo, Admin</h5>
        </div>
        <br>
        <a href="dashboard-1.php"><i class="fa fa-house"></i>&nbsp Dashboard</a>
        <a href="dashboard-2.php" class="pressed"><i class="fa fa-wheat-awn"></i>&nbsp&nbsp Program Tanam</a>
        <a href="dashboard-3.php"><i class="fa fa-pagelines"></i> &nbsp&nbsp Pupuk Subsidi</a>
        <a href="dashboard-4.php"><i class="fa fa-tractor"></i>&nbsp&nbspAlat</a>
        <a href="dashboard-5.php"><i class="fa fa-users-gear"></i>&nbsp Users</a>
        <br><br><br>
        <a href="../menu.php"><i class="fa fa-earth-americas"></i> Halaman Utama</a>
        <a href="../login.php" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar?')){ window.location.href = '../login.php'; }"><i class="fa fa-power-off"></i> Keluar</a>
    </div>

    <!-- Toggle Button -->
    <button id="sidebarToggle" class="sidebar-toggle-btn">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Page Content -->
    <div id="content" class="main">
        <div class="main1">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Daftar Permohonan Pupuk</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Pemohon</th>
                                <th>Tanggal Permohonan</th>
                                <th>Alamat</th>
                                <th>NIK</th>
                                <th>Foto KTP</th>
                                <th>Foto KK</th>
                                <th>Luas Lahan</th>
                                <th>Koordinat</th>
                                <th>Jenis Pupuk</th>
                                <th>Jumlah Pupuk</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT p.*, u.fullname FROM permohonan_pupuk p JOIN users u ON p.id_user = u.id";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['fullname']}</td>
                                        <td>{$row['tanggal_permohonan']}</td>
                                        <td>{$row['alamat']}</td>
                                        <td>{$row['nik']}</td>
                                        <td><img src='../{$row['foto_ktp']}' alt='Foto KTP' width='80'></td>
                                        <td><img src='../{$row['foto_kk']}' alt='Foto KK' width='80'></td>
                                        <td>{$row['luas_lahan']} Ha</td>
                                        <td>{$row['koordinat']}</td>
                                        <td>{$row['jenis_pupuk']}</td>
                                        <td>{$row['jumlah_pupuk']} Kg</td>
                                        <td>{$row['status']}</td>
                                        <td>
                                            <a href='edit-permohonan-pupuk.php?id={$row['id']}' class='btn btn-primary btn-sm'>Ubah Status</a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='13' class='text-center'>No records found</td></tr>";
                            }

                            $con->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d31a45e58f.js" crossorigin="anonymous"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const sidebarToggle = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('sidebar-hidden');
            content.classList.toggle('content-expanded');
        }
        sidebarToggle.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>