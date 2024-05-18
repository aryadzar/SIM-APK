<?php

include "../layout/header-admin.php";
include "../config/controller.php";

$data_pesawat = select("SELECT * FROM pesawat");

if(isset($_POST["tambah_pesawat"])){
    if(tambah_pesawat($_POST, $_FILES)> 0){
        echo "<script>
        alert('Data pesawat Berhasil Ditambahkan');
        document.location.href = 'tambah-pesawat.php';
        </script>
        ";      
    }else{
        echo "<script>
        
        alert('Data Pesawat Gagal Ditambahkan');
        document.location.href = 'tambah-pesawat.php';
        
        </script>
        ";  
    }
}

if(isset($_POST["ubah_pesawat"])){
    if(update_pesawat($_POST, $_FILES)>0){
        echo "<script>
        alert('Data Pesawat Berhasil Diubah');
        document.location.href = 'tambah-pesawat.php';
        </script>
        ";
    }else{
        echo "<script>
        alert('Data Pesawat Gagal Diubah');
        document.location.href = 'tambah-pesawat.php';
        </script>
        ";
    }
}

?>

<div class="container mt-5">
    <h1>Data Pesawat</h1>
    <hr>
    <br> 
    <div class="d-flex flex-row-reverse">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambah_pesawat">
        <i class="fa-solid fa-plus"></i> Tambah Pesawat           
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
                <td width="18%">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_pesawat<?=$pesawat["id_pesawat"]?>">
                    <i class="fa-regular fa-pen-to-square"></i>  Ubah
                    </button>

                    <!-- Modal Edit Pesawat -->
                    <div class="modal fade" id="edit_pesawat<?=$pesawat["id_pesawat"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Teknisi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="container">
                                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="mt-3">
                                            <input type="hidden" class="form-control" name="id_pesawat" placeholder="id Pesawat" required value="<?=$pesawat["id_pesawat"]?>">
                                        </div>
                                        <div class="mt-3">      
                                            <label for="" class="form-label ">Nomor Registrasi <span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="nomor_registrasi" placeholder="Nomor registrasi" value="<?=$pesawat["no_registrasi"]?>" required>
                                        </div>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Nama Pesawat <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" name="nama_pesawat" placeholder="Nama Pesawat" required value="<?=$pesawat["nama_pesawat"]?>" >
                                        </div>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Boeing Pesawat <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" name="boeing_pesawat" placeholder="Boeing Pesawat" required value="<?=$pesawat["boieng_pesawat"]?>">
                                        </div>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Jenis Pesawat <span style="color:red;">*</span></label>
                                            <select class="form-select form-select-sm" aria-label="Large select example" name="jenis_pesawat" required placeholder="Jenis Pesawat"
                                            >
                                                <option value="" disabled <?= empty($pesawat["jenis_pesawat"]) ? 'selected' : '' ?>>Jenis Pesawat</option>
                                                <option value="Airbus" <?= $pesawat["jenis_pesawat"] == 'Airbus' ? 'selected' : '' ?>>Airbus</option>
                                                <option value="Jet" <?= $pesawat["jenis_pesawat"] == 'Jet' ? 'selected' : '' ?>>Jet</option>
                                                <option value="Boeing" <?= $pesawat["jenis_pesawat"] == 'Boeing' ? 'selected' : '' ?>>Boeing</option>
                                            </select>
                                        </div>

                                        <div class="mt-3">      
                                            <label for="" class="form-label ">Kapasitas Penumpang<span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="kapasitas_penumpang" placeholder="Nomor registrasi" required value="<?=$pesawat["kapasitas_penumpang"]?>">
                                        </div>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Gambar Pesawat Sebelumnya : </label>
                                            <img src="../gambar_pesawat/<?=$pesawat["gambar_pesawat"]?>" alt="logo" height="40%" width="40%">
                                        </div>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Gambar Pesawat <span style="color:red;">*</span></label>
                                            <input type="file" class="form-control" name="gambar_pesawat" placeholder="gambar Teknisi" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary" name="ubah_pesawat">Ubah</button>
                                        </div>

                                    </div>

                                    </form>
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>
                    <a href="hapus-pesawat.php?id_pesawat=<?=$pesawat["id_pesawat"]?>" class="btn btn-danger" onclick="return confirm('Yakin mau menghapus pesawat ? ')"><i class="fa-regular fa-trash-can"></i> Hapus</a>
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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Pesawat</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data" id="myForm">
                <div class="col">
                    <div class="mt-3">      
                        <label for="" class="form-label ">Nomor Registrasi <span style="color:red;">*</span></label>
                        <input type="number" class="form-control" name="nomor_registrasi" placeholder="Nomor registrasi" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Nama Pesawat <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="nama_pesawat" placeholder="Nama Pesawat" required >
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Boeing Pesawat <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="boeing_pesawat" placeholder="Boeing Pesawat" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Jenis Pesawat <span style="color:red;">*</span></label>
                        <select class="form-select form-select-sm" aria-label="Large select example" name="jenis_pesawat" required placeholder="Jenis Pesawat">
                            <option disabled selected></option>
                            <option value="Airbus">Airbus</option>
                            <option value="Jet">Jet</option>
                            <option value="Boeing">Boeing</option>
                        </select>
                    <div class="mt-3">      
                        <label for="" class="form-label ">Kapasitas Penumpang<span style="color:red;">*</span></label>
                        <input type="number" class="form-control" name="kapasitas_penumpang" placeholder="Kapasitas Penumpang" required>
                    </div>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Gambar Pesawat <span style="color:red;">*</span></label>
                        <input type="file" class="form-control" name="gambar_pesawat" placeholder="gambar Teknisi" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="tambah_pesawat">Tambah</button>
                    </div>

                </div>
                </div>
            </form>
        </div>

    </div>
  </div>
</div>




<?php

include "../layout/footer-admin.php";



?>