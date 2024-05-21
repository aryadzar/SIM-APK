<?php

include '../config/controller.php';
session_start();

if(!isset($_SESSION["manajer"])){
    header("Location: ../index.php");
}


$id_jadwal = (int) $_GET['id_jadwal'];

if(delete_jadwal($id_jadwal)> 0){
    echo "
        <script>
            alert('Data Jadwal Pemeliharaan Berhasil Dihapus');
            document.location.href = 'jadwal-teknisi.php';
        </script>
    ";
}else{
    echo "
    <script>
        alert('Data Jadwal Pemeliharaan Gagal Dihapus');
        document.location.href = 'jadwal-teknisi.php';
    </script>
";
}

?>