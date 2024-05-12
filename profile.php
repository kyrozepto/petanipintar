<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <img src="image/logo_petanipintar.png" width="40" height="40" alt="Logo">
        </div>

        <div>

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Email = $result['Email'];
                $res_Uname = $result['Username'];
                $res_Fullname = $result['Fullname'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php?Id=$res_id' >Ubah Profil</a>";
            ?>

            <a href="menu.php" class="signup">Kembali</a>

        </div>
    </div>
    <main>
        
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Halo <b><?php echo $res_Uname ?></b>!</p>
            </div>
            <div class="box">
                <p>Email anda adalah <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>Umur: <b><?php echo $res_Age ?> years old</b>.</p> 
            </div>
          </div>
       </div>

    </main>
</body>
</html>