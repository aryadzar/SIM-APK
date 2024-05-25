<?php 


include "../layout/header-admin.php";
include "../config/controller.php";

$data_manajer = select("SELECT * FROM manajer "); 

if(isset($_POST["tambah_manajer"])){
    if(tambah_manajer($_POST, $_FILES) > 0){
        echo "<script>
        alert('Data Manajer Berhasil Ditambahkan');
        document.location.href = 'tambah-manajer.php';
        </script>
        ";  
    }else{
        echo "<script>
        alert('Data Manajer Gagal Ditambahkan');
        document.location.href = 'tambah-manajer.php';
        </script>
        ";  
    }
}

if (isset($_POST["ubah_manajer"])){
    if(update_manajer($_POST, $_FILES) > 0){
        echo "<script>
        alert('Data Manajer Berhasil Diubah');
        document.location.href = 'tambah-manajer.php';
        </script>
        ";  
    }else{
        echo "<script>
        alert('Data Manajer Gagal Diubah');
        document.location.href = 'tambah-manajer.php';
        </script>
        ";  
    }
}



?>

<div class="container mt-5">
    <h1>Data Manajer</h1>
    <hr>
    <br> 
    <div class="d-flex flex-row-reverse">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambah_manajer">
        <i class="fa-solid fa-user-plus"></i>  Tambah Manajer           
        </button>
    </div>
    <table class="table table-hover table-info" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP Manajer</th>
                <th class="text-center">Gambar Manajer</th>
                <th>Nama Manajer</th>
                <th>Username Manajer</th>
                <th class="text-center">Password Manajer</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;?>
            <?php foreach($data_manajer as $manajer): ?>
            <tr>
                <td><?= $no++?></td>
                <td><?=$manajer["nip_manajer"]?></td>
                <td class="text-center"><img src="../gambar_manajer/<?=$manajer["gambar_manajer"]?>" alt="" width="50%" height="50%"></td>
                <td><?=$manajer["nama_manajer"]?></td>
                <td><?=$manajer["username_manajer"]?></td>
                <td class="text-center">
                <span id="password<?= $manajer["id_manajer"] ?>"><code><?=str_repeat("*", strlen($manajer["password_manajer"]))?></code></span>
                        <span id="password_plain<?= $manajer["id_manajer"] ?>" style="display:none"><code><?= $manajer["password_manajer"] ?></code></span>
                        <a  onclick="togglePassword(<?= $manajer['id_manajer'] ?>)">
                            <i class="fas fa-eye"></i>
                </a>
                </td>
                <td width="18%">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_manajer<?=$manajer["id_manajer"]?>">
                            <i class="fa-regular fa-pen-to-square"></i>    Ubah
                    </button>
                        <!-- Modal Edit Teknisi -->
                        <div class="modal fade" id="edit_manajer<?=$manajer["id_manajer"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Manajer</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="container">
                                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="col">
                                            <div class="mt-3"> 
                                                <input type="hidden" class="form-control" name="id_manajer" placeholder="ID manajer" value="<?=$manajer["id_manajer"]?>"  required>
                                            </div>
                                            <div class="mt-3">      
                                                <label for="" class="form-label ">Username Manajer <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="username_manajer" placeholder="Username Manajer" value="<?=$manajer["username_manajer"]?>" required>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Password Manajer <span style="color:red;">*</span></label>
                                                <input type="password" class="form-control" name="password_manajer" placeholder="Password Manajer" value="<?=$manajer["password_manajer"]?>" required >
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">NIP Manajer <span style="color:red;">*</span></label>
                                                <input type="number" class="form-control" name="nip_manajer" placeholder="NIP Manajer" value="<?=$manajer["nip_manajer"]?>" required>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Nama Manajer <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="nama_manajer" placeholder="Nama manajer" value="<?=$manajer["nama_manajer"]?>" required>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Gambar sebelumnya : </label>
                                                <br>
                                                <img src="../gambar_manajer/<?= $manajer["gambar_manajer"]?>" alt="gambar manajer" height="20%" width="20%">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Gambar Manajer <span style="color:red;">*</span></label>
                                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="gambar_manajer" placeholder="Gambar manajer" required>
                                            </div>
                                            
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="Ubah" class="btn btn-primary" name="ubah_manajer">Ubah</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>            
                    <a href="hapus-manajer.php?id_manajer=<?=$manajer["id_manajer"]?>" class="btn btn-danger" onclick="return confirm('Yakin mau menghapus Manajer ? ')"><i class="fa-regular fa-trash-can"></i> Hapus</a>    
                </td>
            </tr>

            <?php endforeach;?>
        </tbody>
    </table>
</div>


<!-- Modal Tambah Teknisi -->
<div class="modal fade" id="tambah_manajer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Manager</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data" id="myForm">
                <div class="col">
                    <div class="mt-3">      
                        <label for="" class="form-label ">Username Manajer <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="username_manajer" placeholder="Username Manajer" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Password Manajer <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="password_manajer" placeholder="Password Manajer" required >
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">NIP manajer <span style="color:red;">*</span></label>
                        <input type="number" class="form-control" name="nip_manajer" placeholder="NIP Manajer" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Nama manajer <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="nama_manajer" placeholder="Nama Manajer" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Gambar Manajer <span style="color:red;">*</span></label>
                        <input type="file" class="form-control" name="gambar_manajer" accept=".jpg, .jpeg, .png" placeholder="Gambar manajer" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="tambah_manajer">Tambah</button>
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


