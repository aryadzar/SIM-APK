<?php 

include "../layout/header-manajer.php";
include "../config/controller.php";

$data_jadwal = select("SELECT pesawat.no_registrasi, pesawat.gambar_pesawat, pesawat.nama_pesawat, pesawat.boieng_pesawat, pesawat.jenis_pesawat, pesawat.kapasitas_penumpang,jadwal_pesawat.jadwal_pemeliharaan, jadwal_pesawat.deskripsi FROM pesawat, jadwal_pesawat WHERE pesawat.id_pesawat = jadwal_pesawat.id_pesawat");
$data_pesawat = select("SELECT * FROM pesawat");


?>

<div class="container mt-5">

    <h2>Data Jadwal Teknisi</h2>
    <hr>
    <div class="d-flex flex-row-reverse">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambah_jadwal">
        <i class="fa-regular fa-calendar-plus"></i> Tambah Jadwal           
        </button>
    </div>
    <table class="table table-hover table-info mt-2" id="table_main">
        <thead>
            <tr>
                <th>No</th>
                <th>No Registrasi</th>
                <th>Gambar Pesawat</th>
                <th>Nama Pesawat</th>
                <th>Boeing Pesawat</th>
                <th>Jenis Pesawat</th>
                <th>Kapasitas Pesawat</th>
                <th>Jadwal Pemeliharaan</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;?>
            <?php foreach($data_jadwal as $jadwal): ?>
            <tr>
                <td><?= $no++?></td>
                <td><?= $jadwal["no_registrasi"]?></td>
                <td class="text-center"><img src="../gambar_pesawat/<?= $jadwal["gambar_pesawat"]?>" alt="logo pesawat" width="50%" height="50%"></td>
                <td><?= $jadwal["nama_pesawat"]?></td>
                <td><?= $jadwal["boieng_pesawat"]?></td>
                <td><?= $jadwal["jenis_pesawat"]?></td>
                <td><?= $jadwal["kapasitas_penumpang"]?></td>
                <td><?= date('d/m/Y H:i:s', strtotime($jadwal['jadwal_pemeliharaan']))?></td>
                <td><?= $jadwal["deskripsi"]?></td>
                <td width="16%">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_teknisi<?=$teknisi["id_teknisi"]?>">
                            <i class="fa-regular fa-pen-to-square"></i>    Ubah
                            </button>
                    <a href="hapus-teknisi.php?id_teknisi=<?= $teknisi["id_teknisi"]?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Menghapus Teknisi ?')">
                    <i class="fa-regular fa-trash-can"></i> Hapus</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

</div>


<!-- Modal Tambah Teknisi -->
<div class="modal fade" id="tambah_jadwal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data jadwal Pemeliharaan Pesawat</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="">
                <div class="row">
                <div class="d-flex justify-content-center">
                    <table class="table table-hover table-info table-modal" id="table_modal" border="1">
                        <thead>
                            <tr>
                                <th>ID Pesawat </th>
                                <th>No Registrasi</th>
                                <th>Gambar Pesawat</th>
                                <th>Nama Pesawat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_pesawat as $pesawat): ?>
                            <tr>
                                <td><?=$pesawat["id_pesawat"]?></td>
                                <td><?=$pesawat["no_registrasi"]?></td>
                                <td ><img src="../gambar_pesawat/<?=$pesawat["gambar_pesawat"]?>" alt="" height="60%" width="60%"></td>
                                <td><?=$pesawat["nama_pesawat"]?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                     
                    <div class="col p-5">
                        <form action="" method="post">
                        <div class="mt-3">      
                            <label for="" class="form-label ">ID Pesawat <span style="color:red;">*</span> (Silahkan pilih berdasarkan ID Pesawat di samping) </label>
                            <select class="form-select form-select-sm" aria-label="Large select example" name="jenis_pesawat" required placeholder="Jenis Pesawat">
                            <option disabled selected></option>
                            <?php foreach($data_pesawat as $pesawat): ?>
                                <option value="<?=$pesawat["id_pesawat"]?>"><?=$pesawat["id_pesawat"]?></option>
                            <?php endforeach; ?>    
                            </select>                        
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Jadwal Pemeliharaan Pesawat <span style="color:red;">*</span></label>
                            <input type="datetime-local" class="form-control" name="jadwal_pemeliharaan" placeholder="Password Teknisi" required >
                        </div>  
                        <div class="mt-3">
                            <label for="" class="form-label">Deskripsi <span style="color:red;">*</span></label>
                            <textarea class="form-control"  rows="5"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="Ubah" class="btn btn-primary" name="ubah_teknisi">Ubah</button>
                        </div>  
                        </form>
                    </div>
                </div>


                </div>
                </div>
        </div>

    </div>
  </div>
</div>



<?php 

include "../layout/footer-manajer.php"

?>