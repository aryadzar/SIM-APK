<?php
include '../config/controller.php';
session_start();

if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}
$id_teknisi = (int) $_GET['id_teknisi'];

if(delete_teknisi($id_teknisi)> 0){
    echo "
        <script>
            alert('Data Teknisi Berhasil Dihapus');
            document.location.href = 'tambah-teknisi.php';
        </script>
    ";
}else{
    echo "
    <script>
        alert('Data Teknisi Gagal Dihapus');
        document.location.href = 'tambah-teknisi.php';
    </script>
";
}

?>