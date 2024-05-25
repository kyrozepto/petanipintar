<?php
session_start();

include("../php/config.php");
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $alamat = $_POST['alamat'];
    $latitude = !empty($_POST['latitude']) ? $_POST['latitude'] : "NULL";
    $longitude = !empty($_POST['longitude']) ? $_POST['longitude'] : "NULL";
    $role = $_POST['role'];

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $query = "UPDATE users SET email='$email', password='$passwordHash', username='$username', fullname='$fullname', age=$age, alamat='$alamat', latitude=$latitude, longitude=$longitude, role='$role' WHERE id=$id";
    if (mysqli_query($con, $query)) {
        echo '<script>alert("Akun Berhasil di Update");
        window.location.href = "dashboard-5.php";
        </script>';
    } else {
        $error = 'Database update failed';
    }

    if ($error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ubah Akun</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Ubah Akun</h2>
        <form action="edit-akun.php?id=<?php echo $user['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password </label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $user['alamat']; ?>">
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude" value="<?php echo $user['latitude']; ?>">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude" value="<?php echo $user['longitude']; ?>">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
