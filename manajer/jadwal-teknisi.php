<?php 

include "../layout/header-manajer.php";
include "../config/controller.php";

$data_jadwal = select("SELECT jadwal_pesawat.id_jadwal_pemeliharaan,jadwal_pesawat.id_pesawat ,pesawat.no_registrasi, pesawat.gambar_pesawat, pesawat.nama_pesawat, pesawat.boieng_pesawat, pesawat.jenis_pesawat, pesawat.kapasitas_penumpang,jadwal_pesawat.jadwal_pemeliharaan, jadwal_pesawat.deskripsi, jadwal_pesawat.status FROM pesawat, jadwal_pesawat WHERE pesawat.id_pesawat = jadwal_pesawat.id_pesawat ORDER BY id_jadwal_pemeliharaan DESC;");
$data_pesawat = select("SELECT * FROM pesawat");

if(isset($_POST["tambah_jadwal"])){
    if(tambah_jadwal($_POST) > 0){
        echo "
        <script>
            alert('Data Jadwal Pemeliharaan Berhasil Ditambah');
            document.location.href = 'jadwal-teknisi.php';
        </script>
    ";
    }else{
        echo "
        <script>
            alert('Data Jadwal Pemeliharaan Gagal Ditambah');
            document.location.href = 'jadwal-teknisi.php';
        </script>
    ";
    }
}


if(isset($_POST["edit_jadwal"])){
    if(edit_jadwal($_POST) > 0){
        echo "
        <script>
            alert('Data Jadwal Pemeliharaan Berhasil Diedit');
            document.location.href = 'jadwal-teknisi.php';
        </script>";
    }else{
        echo "
        <script>
            alert('Data Jadwal Pemeliharaan Gagal Diedit');
            document.location.href = 'jadwal-teknisi.php';
        </script>
    ";
    }
}

?>

<div class="container mt-5">

    <h2>Data Jadwal Pemeliharaan</h2>
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
                <th>Gambar Maskapai</th>
                <th>Nama Maskapai</th>
                <th>Tipe Pesawat</th>
                <th>Jenis Pesawat</th>
                <th>Kapasitas Pesawat</th>
                <th>Jadwal Pemeliharaan</th>
                <th width="14%">Deskripsi</th>
                <th>Status</th>
                <th width="15%">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no_table = 1;?>
            <?php foreach($data_jadwal as $jadwal): ?>
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
                <?php }else { ?>
                    <span class="badge text-bg-info"> <?=$jadwal["status"]?> </span> 
                <?php } ?>                
                </td>
                <td width="15%">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_jadwal<?=$jadwal["id_jadwal_pemeliharaan"]?>">
                        <i class="fa-regular fa-pen-to-square"></i>Ubah
                    </button>
                        <div class="modal fade" id="edit_jadwal<?=$jadwal["id_jadwal_pemeliharaan"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <table class="table table-hover table-info table-modal" id="table_modal_edit<?=$jadwal["id_jadwal_pemeliharaan"]?>" border="1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No Registrasi</th>
                                                        <th>Gambar Maskapai</th>
                                                        <th>Nama Maskapai</th>
                                                        <th>Tipe Pesawat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;?>
                                                    <?php foreach($data_pesawat as $pesawat): ?>
                                                    <tr>
                                                        <td><?=$no++?></td>
                                                        <td><?=$pesawat["no_registrasi"]?></td>
                                                        <td ><img src="../gambar_pesawat/<?=$pesawat["gambar_pesawat"]?>" alt="" height="70%" width="70%"></td>
                                                        <td><?=$pesawat["nama_pesawat"]?></td>
                                                        <td> <?=$pesawat["boieng_pesawat"]?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <div class="col p-5">
                                                <form action="" method="post">
                                                <div class="mt-3">
                                                    <input type="hidden" class="form-control" name="id_jadwal_pemeliharaan" value="<?=$jadwal["id_jadwal_pemeliharaan"]?>"  required >
                                                </div>  
                                                <div class="mt-3">      
                                                    <label for="" class="form-label ">No Registrasi Pesawat <span style="color:red;">*</span> (Silahkan pilih berdasarkan ID Pesawat di samping) </label>
                                                    <select class="form-select form-select-sm" aria-label="Large select example" name="id_pesawat" required >
                                                    <option disabled selected></option>
                                                    <?php foreach($data_pesawat as $pesawat): ?>
                                                        <option value="<?=$pesawat["id_pesawat"]?>" <?= ($pesawat["id_pesawat"] == $jadwal["id_pesawat"]) ? 'selected' : '' ?>><?=$pesawat["no_registrasi"]?> - <?=$pesawat["nama_pesawat"]?> - <?=$pesawat["boieng_pesawat"]?></option>
                                                    <?php endforeach; ?>   
                                                    </select>                        
                                                </div>
                                                <div class="mt-3">
                                                    <label for="" class="form-label">Jadwal Pemeliharaan Pesawat <span style="color:red;">*</span></label>
                                                    <input type="datetime-local" class="form-control" name="jadwal_pemeliharaan" value="<?=$jadwal["jadwal_pemeliharaan"]?>"  required >
                                                </div>  
                                                <div class="mt-3">
                                                    <label for="" class="form-label">Deskripsi (opsional)</label>
                                                    <textarea class="form-control"  rows="5" name="deskripsi"><?= htmlspecialchars($jadwal["deskripsi"]) ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="Ubah" class="btn btn-primary" name="edit_jadwal">Edit</button>
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
                    <a href="hapus-jadwal.php?id_jadwal=<?= $jadwal["id_jadwal_pemeliharaan"]?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Menghapus Jadwal Pemeliharaan ?')">
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
                                <th>No</th>
                                <th>No Registrasi</th>
                                <th>Gambar Maskapai</th>
                                <th>Nama Maskapai</th>
                                <th>Tipe Pesawat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php foreach($data_pesawat as $pesawat): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$pesawat["no_registrasi"]?></td>
                                <td ><img src="../gambar_pesawat/<?=$pesawat["gambar_pesawat"]?>" alt="" height="70%" width="70%"></td>
                                <td><?=$pesawat["nama_pesawat"]?></td>
                                <td> <?=$pesawat["boieng_pesawat"]?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                     
                    <div class="col p-5">
                        <form action="" method="post">
                        <div class="mt-3">      
                            <label for="" class="form-label ">No Registrasi Pesawat <span style="color:red;">*</span> (Silahkan pilih berdasarkan ID Pesawat di samping) </label>
                            <select class="form-select form-select-sm" aria-label="Large select example" name="id_pesawat" required >
                            <option disabled selected></option>
                            <?php foreach($data_pesawat as $pesawat): ?>
                                <option value="<?=$pesawat["id_pesawat"]?>"><?=$pesawat["no_registrasi"]?> - <?=$pesawat["nama_pesawat"]?> -  <?=$pesawat["boieng_pesawat"]?> </option>
                            <?php endforeach; ?>    
                            </select>                        
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Jadwal Pemeliharaan Pesawat <span style="color:red;">*</span></label>
                            <input type="datetime-local" class="form-control" name="jadwal_pemeliharaan"  required >
                        </div>  
                        <div class="mt-3">
                            <label for="" class="form-label">Deskripsi (opsional)</label>
                            <textarea class="form-control"  rows="5" name="deskripsi"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="Ubah" class="btn btn-primary" name="tambah_jadwal">Tambah</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script>

<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/sc-2.4.2/datatables.min.js"></script>
<script>
$(document).ready(function() {
    <?php foreach($data_jadwal as $jadwal): ?>
        $('#table_modal_edit<?= $jadwal["id_jadwal_pemeliharaan"] ?>').DataTable({
            lengthMenu: [5, 10, 15, 20, 25, 100],
            pageLength: 5,
            language: {
                "infoFiltered": ""
            }
        });
    <?php endforeach; ?>
});
</script>
<?php 

include "../layout/footer-manajer.php"

?>