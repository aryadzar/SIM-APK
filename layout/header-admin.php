<?php
include "../connection/koneksi.php";

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

$id_admin = $_SESSION["id_admin"];

$query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'");
$result = mysqli_fetch_assoc($query);


?>


<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SIM-APK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d931a8b882.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../img/sim-apk-logo.png" type="image/x-icon">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css">
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        

        body{

            min-height: 100vh;
            background-image: url("../img/back-plane.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .logo-dashboard{
            height: 50px;
        }

        i{
            font-size: 55px;
        }

        .fa-user{
          font-size : 30px;
          color:black;
          margin-right: 5px ;
        }

        .fa-file-excel, .fa-file-pdf, .fa-user-plus, .fa-copy, .fa-pen-to-square, .fa-trash-can, .fa-plus{
          font-size: 15px;
          color:#fff;
          
        }

        .fa-eye, .fa-eye-slash{
            font-size: 17px;
            color: black;
            list-style: none;
            text-decoration: none;
        }

        #form-input{
            /* width: 420px; */
            background: transparent;
            border: 2px solid rgba(255, 255, 255,.2);
            backdrop-filter: blur(30px);
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            border-radius: 10px;
            color: white;
            padding: 30px 40px;        
        }
        #footer{
            color: #fff;
            text-align: center;
            margin-top: 495px;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="black">
  <div class="container">
    <a class="navbar-brand" href="admin.php"><img src="../img/sim-apk-logo.png" alt="logo" class="logo-dashboard">SIM-APK</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="tambah-teknisi.php">Teknisi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tambah-pesawat.php">Pesawat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tambah-manajer.php">Manager</a>
        </li>
    </ul>
    
    <span class="nav-item dropdown">
      <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-user"></i> <?=$result["nama"]?>
        </a>
      <ul class="dropdown-menu ">
        <li><img class="dropdown-item" src="../gambar_admin/gambar_admin.png" alt="gambar admin" width="50%" height="50%"></li>
        <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
      </ul>
    </span>
        
    </div>
  </div>
</nav>