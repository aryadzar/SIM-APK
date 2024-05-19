<?php

session_start();
include "connection/koneksi.php";



if(isset($_SESSION["admin"])){
    header("Location: admin/admin.php");
}else if(isset($_SESSION["manajer"])){
    header("Location: manajer/manajer.php");
}else if(isset($_SESSION["teknisi"])){
    header("Location: teknisi/teknisi.php");
}



if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"]; // Menyimpan nilai password dari form

    $result_teknisi = mysqli_query($conn, "SELECT * FROM teknisi WHERE username_teknisi='$username'" );
    $result_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'" );
    $result_manajer = mysqli_query($conn,"SELECT * FROM manajer WHERE username_manajer='$username'" );

    if(mysqli_num_rows($result_teknisi) == 1){
        $row = mysqli_fetch_assoc($result_teknisi);
        if($row["password_teknisi"] == $password){
            $_SESSION["teknisi"] = true;
            $id_teknisi = $row["id_teknisi"];
            header("Location: teknisi.php"); // Perbaikan di sini
            exit; // Sisipkan exit setelah header
        }
    }else if(mysqli_num_rows($result_manajer) == 1){
        $row = mysqli_fetch_assoc($result_manajer);
        if($row["password_manajer"] == $password){
            $_SESSION["manajer"] = true;
            $_SESSION["id_manajer"] = $row["id_manajer"];
            header("Location: manajer/manajer.php"); // Perbaikan di sini
            exit; // Sisipkan exit setelah header
        }
    }else if(mysqli_num_rows($result_admin)== 1){
        $row = mysqli_fetch_assoc($result_admin);
        if($row["password"] == $password){
            $_SESSION["admin"] = true;
            $_SESSION["id_admin"] = $row["id_admin"];
            header("Location: admin/admin.php"); // Perbaikan di sini
            exit; // Sisipkan exit setelah header
        }
    }
    $error = true;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d931a8b882.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/sim-apk-logo.png" type="image/x-icon">
    <style>
        *{
            /* margin: 0;
            padding: 0; */
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("img/back-plane.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .wrapper{
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            border-radius: 10px;
            color: white;
            padding: 30px 40px;
        }

        .wrapper h1{
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box{
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }
        .failed-login{
            padding: 3px 50px 0 0;
            padding-left: 10px;

        }

        .failed-login p{
            color: red;
            font-weight: 700;
        }
        .input-box input::placeholder{
            color:black
        }

        .input-box i{
            position: absolute;
            right: 20px;
            top:50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .btn{
            width: 100%;
            height: 45px;
            background-color: blue;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, -1);
            cursor: pointer;
            font-size: 16px;
            color:black;
            font-weight: 600;
        }

        .logo{
            display: flex;
            margin-left: 80px;
            width: 50%;
            height: 50%;
        }


        #username{
            transition: .2s;
            color:black;
        }
        #username:hover{
            background-color: white ;
            color: black;
        }
        #password{
            transition: .2s;
            color:black;
        }
        #password:hover{
            background-color: white ;
            color: black;
        }
    </style>
</head>
<body>


    <div class="wrapper">
        <form action="" method="post">
            <img src="img/sim-apk-logo.png" alt="logo" class="logo">
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <?php if (isset($error)): ?>
                    <div class="failed-login">
                        <p>Username atau Password Salah !</p>
                    </div>
                <?php endif?>  
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>  
            </div>
            <button type="submit" class="btn" name="login">Login</button>        
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>