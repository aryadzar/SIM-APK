<?php 

include "../layout/header-manajer.php";

$query_teknisi = mysqli_query($conn, "SELECT * FROM teknisi");
$query_pesawat = mysqli_query($conn, "SELECT * FROM pesawat");

$result_teknisi = mysqli_num_rows($query_teknisi);
$result_pesawat = mysqli_num_rows($query_pesawat);
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
    </div>
</div>


<?php 


include "../layout/footer-manajer.php";


?>