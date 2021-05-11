<?php 

session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUIZ 2 PEMROGRAMAN WEBSITE</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <style>
    .contain{
        margin top: 30px;
        background-color: yellow;
        padding: 10px;
        border-radius: 15px;
    }
    .button a{
        text-decoration: none;
        margin top: 30px;
        background-color: yellow;
        padding: 10px;
        border-radius: 15px;
    }
    .button a:hover{
        background-color: salmon;
    }
  </style>
</head>

<body>
<br>
  <center>
  <div class="contain">
    <h2>Ahmad Ichwan Zaky - 192410101055 <br>Pemrograman Berbasis Website Kelas C</h2>
    </div>
    <br>
  <h1> SELAMAT DATANG <br> Anda Telah Berhasil Login ke dalam Sistem</h1><br>
  <h4>Anda juga bisa menggunakan akun berikut ini untuk login</h5>
    <p>Username : ahmad <br> Password : ichwan</p>
    <p>Username : ahmad <br> Password : zaky</p>
    <br>
  <div class="button">
      <a href="logout.php" class="text-dark">Log Out</a>
      </div>
      <br>
      <br>
  </center>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

<?php

print_r($_SESSION);
print_r($_COOKIE);

?>