<?php 

include "../layout/header-manajer.php";

$query_teknisi = mysqli_query($conn, "SELECT * FROM teknisi");
$query_pesawat = mysqli_query($conn, "SELECT * FROM pesawat");
$query_jadwal = mysqli_query($conn, "SELECT pesawat.no_registrasi, pesawat.gambar_pesawat, pesawat.nama_pesawat, pesawat.boieng_pesawat, pesawat.jenis_pesawat, pesawat.kapasitas_penumpang,jadwal_pesawat.jadwal_pemeliharaan, jadwal_pesawat.deskripsi 
                            FROM pesawat, jadwal_pesawat 
                            WHERE pesawat.id_pesawat = jadwal_pesawat.id_pesawat");

$result_teknisi = mysqli_num_rows($query_teknisi);
$result_pesawat = mysqli_num_rows($query_pesawat);
$result_jadwal = mysqli_num_rows($query_jadwal);
?>

<div class="container mt-5">
    <h3><strong>Dasboard Manager</strong></h3>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-bg-primary mt-3" style="max-width: 18rem;">
              <div class="card-header"><strong>Active Technician</strong></div>
              <div class="card-body">
                <h1 class="card-title"><i class="fa-solid fa-users-gear"></i></h1>
                <h2 class="card-tittle"><?= $result_teknisi ?></h2>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-info mt-3" style="max-width: 18rem;">
              <div class="card-header"><strong>Active Plane</strong></div>
              <div class="card-body">
                <h1 class="card-title"><i class="fa-solid fa-plane"></i></h1>
                <h2 class="card-tittle"><?= $result_pesawat ?></h2>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger mt-3" style="max-width: 18rem;">
              <div class="card-header"><strong>Active Plane Schedule</strong></div>
              <div class="card-body">
                <h1 class="card-title"><i class="fa-solid fa-plane"></i></h1>
                <h2 class="card-tittle"><?= $result_jadwal ?></h2>
              </div>
            </div>
        </div>
    </div>
</div>


<?php 


include "../layout/footer-manajer.php";


?>