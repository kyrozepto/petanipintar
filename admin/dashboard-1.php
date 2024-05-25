<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}
// Array of table names
$tables = [
    'program_tanam' => 'Total Program Tanam',
    'rekening_pemilik' => 'Total Rekening Pemilik',
    'alat' => 'Total Alat',
    'sewa_alat' => 'Total Sewa Alat',
    'panen' => 'Total Panen',
    'user_program_tanam' => 'Total User Program Tanam',
    'users' => 'Total Users'
];

// Initialize an array to hold the row counts
$row_counts = [];

// Iterate over each table and get the row count
foreach ($tables as $table => $label) {
    $sql = "SELECT COUNT(*) as count FROM $table";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $row_counts[$table] = $row['count'];
    } else {
        $row_counts[$table] = 0;
    }
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
    <link rel="stylesheet" href="../css/login.css">
    <style>
        .icon-style {
            color: #08875D;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="side-header">
            <img src="../image/admin.png" width="120" height="120">
            <h5 style="margin-top:10px;">Halo, Admin</h5>
        </div>
        <br>
        <a href="dashboard-1.php" class="pressed"><i class="fa-solid fa-house"></i>&nbsp Dashboard</a>
        <a href="dashboard-2.php"><i class="fa-solid fa-wheat-awn"></i>&nbsp&nbsp Program Tanam</a>
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
            <h1>Dashboard</h1>
        </div> -->
        <div class="main1">
            <div class="container-fluid" style="margin-bottom: 100px">
                <div class="row d-flex justify-content-center" style="width:100%;">
                    <div class="col-lg-2 box">
                        <a href="dashboard-2.php">
                            <i class="fa-solid fa-wheat-awn fa-6x icon-style"></i>
                            <p>Total Jenis Program Tanam</p>
                            <p class="count"><?php echo $row_counts['program_tanam']; ?></p>
                        </a>
                    </div>
                    <div class="col-lg-2 box">
                        <a>
                            <i class="fa-brands fa-pagelines fa-6x icon-style"></i>
                            <p>Program Tanam yang Berjalan</p>
                            <p class="count"><?php echo $row_counts['user_program_tanam']; ?></p>
                        </a>
                    </div>
                    <div class="col-lg-2 box">
                        <a href="dashboard-4.php">
                            <i class="fa-solid fa-trowel fa-6x icon-style"></i>
                            <p>Total Jenis Alat</p>
                            <p class="count"><?php echo $row_counts['alat']; ?></p>
                        </a>
                    </div>
                    <div class="col-lg-2 box">
                        <a>
                            <i class="fa-solid fa-tractor fa-6x icon-style"></i>
                            <p>Total Alat yang Disewa</p>
                            <p class="count"><?php echo $row_counts['sewa_alat']; ?></p>
                        </a>
                    </div>
                    <div class="col-lg-2 box">
                        <a>
                            <i class="fa-solid fa-plate-wheat fa-6x icon-style"></i>
                            <p>Total Jumlah Panen</p>
                            <p class="count"><?php echo $row_counts['panen']; ?></p>
                        </a>
                    </div>
                    <div class="col-lg-2 box">
                        <a>
                            <i class="fa-solid fa-address-card fa-6x icon-style" fa-6x></i>
                            <p>Total Rekening Pemilik</p>
                            <p class="count"><?php echo $row_counts['rekening_pemilik']; ?></p>
                        </a>
                    </div>
                    <div class="col-lg-2 box">
                        <a href="dashboard-4.php">
                            <i class="fa-solid fa-users-gear fa-6x icon-style"></i>
                            <p>Total Akun</p>
                            <p class="count"><?php echo $row_counts['users']; ?></p>
                            <a href="dashboard-4.php">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/d31a45e58f.js" crossorigin="anonymous"></script>
</body>

</html>