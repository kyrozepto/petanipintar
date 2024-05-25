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
            <img src="../image/logo-admin.png" width="120" height="120"> 
            <h5 style="margin-top:10px;">Hello, Admin</h5>
        </div>
        <br>
        <a href="dashboard-1.php" ><i class="fa-solid fa-house"></i>&nbsp Dashboard</a>
        <a href="dashboard-2.php" ><i class="fa-solid fa-wheat-awn"></i>&nbsp&nbsp Program Tanam</a>
        <!-- <a href="dashboard-3.php" ><i class="fa-brands fa-pagelines"></i> &nbsp&nbsp Pupuk Subsidi</a> -->
        <a href="dashboard-4.php" ><i class="fa-solid fa-tractor"></i>&nbsp&nbspAlat</a>
        <a href="dashboard-5.php" class="pressed"><i class="fa-solid fa-users-gear"></i>&nbsp Users</a>
        <br><br><br><br><br><br><br>
        <a href="../menu.php"><i class="fa-solid fa-earth-americas"></i> Page Menu</a>
        <a href="../login.php" onclick="if(confirm('Apakah Anda yakin ingin keluar?')){window.location.href='login.php';}"><i class="fa-solid fa-power-off"></i> Log Out</a>
      </div>
  
  <!-- Page Content -->
  <div class="main">
    <div class="head-main">
        <h1>Manage Users</h1>
    </div>
    <div class="main1">
        <div class="container">
            <h1 class="mt-5">Akun</h1>
            <a href="add-akun.php" class="btn btn-success mb-3">Tambah Akun Baru</a>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Age</th>
                        <th>Alamat</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mendapatkan data dari tabel users
                    $sql = "SELECT * FROM users";
                    $result = $con->query($sql);

                    // Cek jika ada data di tabel
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $password = (strlen($row['password']) > 16) ? substr($row['password'], 0, 16) . '...' : $row['password'];
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$password}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['fullname']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['alamat']}</td>
                                    <td>{$row['latitude']}</td>
                                    <td>{$row['longitude']}</td>
                                    <td>{$row['role']}</td>
                                    <td>
                                        <a href='edit-akun.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                        <a href='delete-akun.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='text-center'>No records found</td></tr>";
                    }

                    // Tutup koneksi
                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </div>
    </div>
  <script src="https://kit.fontawesome.com/d31a45e58f.js" crossorigin="anonymous"></script>
</body>
</html>