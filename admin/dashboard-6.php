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
    <div id="sidebar" class="sidebar">
        <div class="side-header">
            <img src="../image/admin.png" class="admin-img" width="120" height="120">
            <h5 style="margin-top:10px;">Halo, Admin</h5>
        </div>
        <br>
        <a href="dashboard-1.php"><i class="fa fa-house"></i>&nbsp Dashboard</a>
        <a href="dashboard-2.php"><i class="fa fa-wheat-awn"></i>&nbsp&nbsp Program Tanam</a>
        <a href="dashboard-3.php"><i class="fa fa-pagelines"></i> &nbsp&nbsp Pupuk Subsidi</a>
        <a href="dashboard-4.php"><i class="fa fa-tractor"></i>&nbsp&nbspAlat</a>
        <a href="dashboard-6.php" class="pressed"><i class="fa fa-clipboard-list"></i>&nbsp&nbsp&nbsp Peminjaman Alat</a>
        <a href="dashboard-5.php"><i class="fa fa-users-gear"></i>&nbsp Users</a>
        <br><br><br>
        <a href="../menu.php"><i class="fa fa-earth-americas"></i> Halaman Utama</a>
        <a href="../login.php" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar?')){ window.location.href = '../login.php'; }"><i class="fa fa-power-off"></i> Keluar</a>
    </div>

    <button id="sidebarToggle" class="sidebar-toggle-btn">
        <i class="fa fa-bars"></i>
    </button>

    <div id="content" class="main">
        <div class="main1">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Kelola Sewa Alat</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Alat</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal Sewa</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Status Distribusi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT sa.*, a.nama AS nama_alat, u.fullname AS nama_penyewa 
                                    FROM sewa_alat sa
                                    JOIN alat a ON sa.id_alat = a.id
                                    JOIN users u ON sa.id_user = u.id";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $disabled = ($row['status_pembayaran'] == 'Dibatalkan' || $row['status_distribusi'] == 'Dibatalkan') ? 'disabled' : '';

                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['nama_alat']}</td>
                                            <td>{$row['nama_penyewa']}</td>
                                            <td>{$row['tanggal_sewa']}</td>
                                            <td>{$row['metode_pembayaran']}</td>
                                            <td>
                                                <select class='form-control' id='status_pembayaran_{$row['id']}' onchange='updateStatusPembayaran({$row['id']}, this.value)' $disabled>
                                                    <option value='Belum Dibayar' ".($row['status_pembayaran'] == 'Belum Dibayar' ? 'selected' : '').">Belum Dibayar</option>
                                                    <option value='Menunggu Konfirmasi' ".($row['status_pembayaran'] == 'Menunggu Konfirmasi' ? 'selected' : '').">Menunggu Konfirmasi</option>
                                                    <option value='Pembayaran Ditolak' ".($row['status_pembayaran'] == 'Pembayaran Ditolak' ? 'selected' : '').">Pembayaran Ditolak</option>
                                                    <option value='Lunas' ".($row['status_pembayaran'] == 'Lunas' ? 'selected' : '').">Lunas</option>
                                                    <option value='Dibatalkan' ".($row['status_pembayaran'] == 'Dibatalkan' ? 'selected' : '').">Dibatalkan</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class='form-control' id='status_distribusi_{$row['id']}' onchange='updateStatusDistribusi({$row['id']}, this.value)' $disabled>
                                                    <option value='Menunggu Pembayaran' ".($row['status_distribusi'] == 'Menunggu Pembayaran' ? 'selected' : '').">Menunggu Pembayaran</option>
                                                    <option value='Diproses' ".($row['status_distribusi'] == 'Diproses' ? 'selected' : '').">Diproses</option>
                                                    <option value='Dikirim' ".($row['status_distribusi'] == 'Dikirim' ? 'selected' : '').">Dikirim</option>
                                                    <option value='Selesai' ".($row['status_distribusi'] == 'Selesai' ? 'selected' : '').">Selesai</option>
                                                    <option value='Dibatalkan' ".($row['status_distribusi'] == 'Dibatalkan' ? 'selected' : '').">Dibatalkan</option>
                                                </select>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
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

        function updateStatusPembayaran(idSewa, statusPembayaran) {
            $.ajax({
                url: '../php/update-sewa-alat.php',
                type: 'POST',
                data: {
                    id: idSewa,
                    status_pembayaran: statusPembayaran,
                    aksi: 'update_status_pembayaran'
                },
                success: function(response) {
                    location.reload();
                }
            });
        }

        function updateStatusDistribusi(idSewa, statusDistribusi) {
            $.ajax({
                url: '../php/update-sewa-alat.php',
                type: 'POST',
                data: {
                    id: idSewa,
                    status_distribusi: statusDistribusi,
                    aksi: 'update_status_distribusi'
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>