<?php

include '../config/controller.php';
session_start();

if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}


$id_manajer = (int) $_GET['id_manajer'];

if(delete_manajer($id_manajer)> 0){
    echo "
        <script>
            alert('Data Manajer Berhasil Dihapus');
            document.location.href = 'tambah-manajer.php';
        </script>
    ";
}else{
    echo "
    <script>
        alert('Data Manajer Gagal Dihapus');
        document.location.href = 'tambah-manajer.php';
    </script>
";
}



?>