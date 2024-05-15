<?php

include "../layout/header-admin.php";
include "../config/controller.php";

$data_pesawat = select("SELECT * FROM pesawat");


?>

<div class="container mt-5">
    <h1>Data Pesawat</h1>
    <hr>
    <br> 
    <div class="d-flex flex-row-reverse">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambah_pesawat">
        Tambah Pesawat           
        </button>
    </div>
    <table class="table table-hover table-info" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Registrasi</th>
                <th class="text-center">Gambar Pesawat</th>
                <th>Nama Pesawat</th>
                <th>Boeing Pesawat</th>
                <th>Jenis Pesawat</th>
                <th>Kapasitas Penumpang</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach($data_pesawat as $pesawat) : ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$pesawat["no_registrasi"]?></td>
                <td class="text-center"><img src="../gambar_pesawat/<?=$pesawat["gambar_pesawat"]?>" alt="logo" height="20%" width="30%"></td>
                <td><?=$pesawat["nama_pesawat"]?></td>
                <td><?=$pesawat["boieng_pesawat"]?></td>
                <td><?=$pesawat["jenis_pesawat"]?></td>
                <td class="text-center"><?=$pesawat["kapasitas_penumpang"]?></td>
                <td width="15%">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_pesawat<?=$pesawat["id_pesawat"]?>">
                            Ubah
                    </button>

                    <a href="hapus-pesawat.php" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>











<!-- Modal Tambah Teknisi -->
<div class="modal fade" id="tambah_pesawat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Teknisi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="col">
                    <div class="mt-3">      
                        <label for="" class="form-label ">Username Teknisi <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="username_teknisi" placeholder="Username Teknisi" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Password Teknisi <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="password_teknisi" placeholder="Password Teknisi" required >
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">NIP Teknisi <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="nip_teknisi" placeholder="NIP Teknisi" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Nama Teknisi <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="nama_teknisi" placeholder="Nama Teknisi" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Gambar Teknisi <span style="color:red;">*</span></label>
                        <input type="file" class="form-control" name="gambar_teknisi" placeholder="gambar Teknisi" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="tambah_teknisi">Tambah</button>
                    </div>

                </div>
                </div>
            </form>
        </div>

    </div>
  </div>
</div>

<script src="../DataTables/datatables.js"></script>



<?php

include "../layout/footer-admin.php";



?>