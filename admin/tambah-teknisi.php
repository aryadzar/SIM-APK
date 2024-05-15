<?php 
include "../layout/header-admin.php";
include "../connection/koneksi.php";
include "../config/controller.php";

$query = "SELECT * FROM teknisi";

$data_teknisi = select($query);

if(isset($_POST["tambah_teknisi"])){
    if(tambah_teknisi($_POST, $_FILES) > 0){
        echo "<script>
        alert('Teknisi Berhasil Ditambahkan');
        document.location.href = 'tambah-teknisi.php';
        </script>
        ";
    }else{
        echo "<script>
        
        alert('Teknisi Gagal Ditambahkan');
        document.location.href = 'tambah-teknisi.php';
        
        </script>
        ";
    }
}

if(isset($_POST["ubah_teknisi"])){
    if(update_teknisi($_POST, $_FILES)>0){
        echo "<script>
        alert('Teknisi Berhasil Diubah');
        document.location.href = 'tambah-teknisi.php';
        </script>
        ";
    }else{
        echo "<script>
        alert('Teknisi Gagal Diubah');
        document.location.href = 'tambah-teknisi.php';
        </script>
        ";
    }
}
?>

<div class="container mt-5 ">
    <h1>Data Teknisi</h1>
    <hr>
    <br> 
    <div class="d-flex flex-row-reverse">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambah_teknisi">
        Tambah Teknisi           
        </button>
    </div>
    <table class="table table-hover table-info mt-2 " id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP Teknisi</th>
                <th class="text-center">Foto Profile</th>
                <th>Nama Teknisi</th>
                <th>Username Teknisi</th>
                <th>Password Teknisi</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <?php $no = 1; ?>
                <?php foreach( $data_teknisi as $teknisi ): ?>
                    <td><?= $no++?></td>
                    <td><?=$teknisi["nip_teknisi"]?></td>
                    <td class="text-center"><img src="../gambar_teknisi/<?= $teknisi["gambar_teknisi"]?>" alt="gambar teknisi" width="20%" height="20%"></td>
                    <td><?=$teknisi["nama_teknisi"]?></td>
                    <td><?=$teknisi["username_teknisi"]?></td>
                    <td>
                        <span id="password<?= $teknisi["id_teknisi"] ?>"><code><?=str_repeat("*", strlen($teknisi["password_teknisi"]))?></code></span>
                        <span id="password_plain<?= $teknisi["id_teknisi"] ?>" style="display:none"><code><?= $teknisi["password_teknisi"] ?></code></span>
                        <a  onclick="togglePassword(<?= $teknisi['id_teknisi'] ?>)">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td width="15%">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_teknisi<?=$teknisi["id_teknisi"]?>">
                            Ubah
                        </button>
                        
                        <!-- Modal Edit Teknisi -->
                        <div class="modal fade" id="edit_teknisi<?=$teknisi["id_teknisi"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Teknisi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="container">
                                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="col">
                                            <div class="mt-3">      
                                                <input type="hidden" class="form-control" name="id_teknisi" placeholder="ID Teknisi" value="<?=$teknisi["id_teknisi"]?>"  required>
                                            </div>
                                            <div class="mt-3">      
                                                <label for="" class="form-label ">Username Teknisi <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="username_teknisi" placeholder="Username Teknisi" value="<?=$teknisi["username_teknisi"]?>" required>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Password Teknisi <span style="color:red;">*</span></label>
                                                <input type="password" class="form-control" name="password_teknisi" placeholder="Password Teknisi" value="<?=$teknisi["password_teknisi"]?>" required >
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">NIP Teknisi <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="nip_teknisi" placeholder="NIP Teknisi" value="<?=$teknisi["nip_teknisi"]?>" required>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Nama Teknisi <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="nama_teknisi" placeholder="Nama Teknisi" value="<?=$teknisi["nama_teknisi"]?>" required>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Gambar sebelumnya : </label>
                                                <br>
                                                <img src="../gambar_teknisi/<?= $teknisi["gambar_teknisi"]?>" alt="gambar teknisi" height="20%" width="20%">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Gambar Teknisi <span style="color:red;">*</span></label>
                                                <input type="file" class="form-control" name="gambar_teknisi" placeholder="gambar Teknisi" required>
                                            </div>
                                            
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="Ubah" class="btn btn-primary" name="ubah_teknisi">Ubah</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>

                        <a href="hapus-teknisi.php?id_teknisi=<?= $teknisi["id_teknisi"]?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Menghapus Teknisi ?')">Hapus</a>
                    
                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>

</div>

<!-- Modal Tambah Teknisi -->
<div class="modal fade" id="tambah_teknisi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

<script>
    function togglePassword(id) {
        var password = document.getElementById("password" + id);
        var passwordPlain = document.getElementById("password_plain" + id);
        var button = event.target;

        if (password.style.display === "none") {
            password.style.display = "inline";
            passwordPlain.style.display = "none";
            button.classList.remove("fa-eye-slash");
            button.classList.add("fa-eye");
        } else {
            password.style.display = "none";
            passwordPlain.style.display = "inline";
            button.classList.remove("fa-eye");
            button.classList.add("fa-eye-slash");
        }
    }
</script>

<?php 

include "../layout/footer-admin.php"

?>