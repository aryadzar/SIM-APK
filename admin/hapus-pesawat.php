<?php
include '../config/controller.php';
session_start();

if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}
$id_pesawat = (int) $_GET['id_pesawat'];

if(delete_pesawat($id_pesawat)> 0){
    echo "
        <script>
            alert('Data Pesawat Berhasil Dihapus');
            document.location.href = 'tambah-pesawat.php';
        </script>
    ";
}else{
    echo "
    <script>
        alert('Data Pesawat Gagal Dihapus');
        document.location.href = 'tambah-pesawat.php';
    </script>
";
}

?>