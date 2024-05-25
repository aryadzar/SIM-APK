<?php

include "../layout/header-teknisi.php";
include "../config/controller.php";

$data_jadwal = select("SELECT jadwal_pesawat.id_jadwal_pemeliharaan,jadwal_pesawat.id_pesawat ,pesawat.no_registrasi, pesawat.gambar_pesawat, pesawat.nama_pesawat, pesawat.boieng_pesawat, pesawat.jenis_pesawat, pesawat.kapasitas_penumpang,jadwal_pesawat.jadwal_pemeliharaan, jadwal_pesawat.deskripsi, jadwal_pesawat.status FROM pesawat, jadwal_pesawat WHERE pesawat.id_pesawat = jadwal_pesawat.id_pesawat");

if(isset($_POST["upload_dokumentasi"])){
    if(upload_dokumentasi($_POST, $_FILES) > 0 ){
        echo "
        <script>
            alert('Dokumentasi Perbaikan Berhasil Diupload');
            document.location.href = 'upload-dokumentasi.php';
        </script>
    ";
    }else{
        echo "
        <script>
            alert('Dokumentasi Perbaikan Gagal Diupload');
            document.location.href = 'upload-dokumentasi.php';
        </script>
    ";
    }
}


?>

<div class="container mt-5">
    <h2>Pesawat Perlu Perbaikan</h2>
    <hr>
    <div class="d-flex flex-row-reverse">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#upload_dokumentasi">
        <i class="fa-solid fa-upload"></i> Upload Dokumentasi           
        </button>
    </div>
    <table class="table table-hover table-info" id="table_main">
        <thead>
            <tr>
                <th>No</th>
                <th>No Registrasi</th>
                <th>Gambar Maskapai</th>
                <th>Nama Maskapai</th>
                <th>Tipe Pesawat</th>
                <th>Jenis Pesawat</th>
                <th>Kapasitas Pesawat</th>
                <th>Jadwal Pemeliharaan</th>
                <th width="14%">Deskripsi</th>  
                <th>Status</th>          
            </tr>
        </thead>

        <tbody>
            <?php $no_table = 1;?>
            <?php foreach($data_jadwal as $jadwal): ?>
            <?php if($jadwal["status"] === "Sudah Diperbaiki") continue;?>
            <tr>
                <td><?= $no_table++?></td>
                <td><?= $jadwal["no_registrasi"]?></td>
                <td class="text-center"><img src="../gambar_pesawat/<?= $jadwal["gambar_pesawat"]?>" alt="logo pesawat" width="50%" height="50%"></td>
                <td><?= $jadwal["nama_pesawat"]?></td>
                <td><?= $jadwal["boieng_pesawat"]?></td>
                <td><?= $jadwal["jenis_pesawat"]?></td>
                <td><?= $jadwal["kapasitas_penumpang"]?></td>
                <td><?= date('d/m/Y H:i:s', strtotime($jadwal['jadwal_pemeliharaan']))?></td>
                <td>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#deskripsi<?=$jadwal["id_jadwal_pemeliharaan"]?>">
                    <i class="fa-solid fa-note-sticky"></i> Deskripsi           
                    </button>
                    <div class="modal fade" id="deskripsi<?=$jadwal["id_jadwal_pemeliharaan"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Deskripsi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                                <div class="container" id="">
                                    <p><?= nl2br(htmlspecialchars($jadwal["deskripsi"])) ?></p>
                                </div>
                            </div>
                    
                        </div>
                      </div>
                    </div>
                </td>  
                <td> 
                
                <?php if ($jadwal["status"] === "Belum Diperbaiki"){?>
                <span class="badge text-bg-danger"> <?=$jadwal["status"]?> </span> 
            
                <?php }else if ($jadwal["status"] === "Sedang Diperbaiki") {?>
                    <span class="badge text-bg-warning"> <?=$jadwal["status"]?> </span> 
                <?php }?>
                </td>      
            </tr>
            <?php endforeach;?>
        </tbody>
        
    </table>
</div>

<!-- Modal Tambah Teknisi -->
<div class="modal fade" id="upload_dokumentasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Dokumentasi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data" id="myForm">
                <div class="col">
                    <div class="mt-3">
                        <label for="" class="form-label">No Registrasi Pesawat <span style="color:red;">*</span></label>
                        <select class="form-select form-select-sm" aria-label="Large select example" name="id_jadwal_pemeliharaan" required >
                            <option selected disabled></option>
                            <?php foreach($data_jadwal as $jadwal) :  ?>
                                <?php if($jadwal["status"] === "Sudah Diperbaiki") continue;?>
                                <option value="<?=$jadwal["id_jadwal_pemeliharaan"]?>"> <?=$jadwal["no_registrasi"]?> - <?=$jadwal["nama_pesawat"]?> - <?=$jadwal["boieng_pesawat"]?> </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Upload Dokumentasi <span style="color:red;">*</span></label>
                        <input type="file" class="form-control" name="dokumentasi[]" placeholder="Dokumentasi Pesawat" accept=".jpg, .jpeg, .png" required multiple>
                    </div>
                    <div class="mt-3">
                    <label for="" class="form-label">Status Perbaikan <span style="color:red;">*</span></label>
                        <select class="form-select form-select-sm" aria-label="Large select example" name="status" required >
                                <option disabled selected></option>
                                <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                                <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Laporan <span style="color:red;">*</span> </label>
                        <textarea class="form-control"  rows="5" name="laporan" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="upload_dokumentasi">Upload</button>
                    </div>

                </div>
                </div>
            </form>
                

                
            </div>
        </div>
    </div>

    </div>
  </div>
</div>
<?php 


include "../layout/footer-teknisi.php";

?>