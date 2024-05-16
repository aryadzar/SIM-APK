<?php 

include "../connection/koneksi.php";

function select($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
      }
    
      return $rows;
}

function tambah_pesawat($post, $files){
      global $conn;

      $no_registrasi = $post["nomor_registrasi"];
      $nama_pesawat = $post["nama_pesawat"];
      $boeing_pesawat = $post["boeing_pesawat"];
      $jenis_pesawat = $post["jenis_pesawat"];
      $kapasitas_penumpang = $post["kapasitas_penumpang"];

      $result_no_regis = mysqli_query($conn, "SELECT no_registrasi from pesawat where no_registrasi = '$no_registrasi'");
      
      if(mysqli_fetch_assoc($result_no_regis)){
        echo "
        <script>
        alert('Nomor registrasi sudah terdaftar');
        </script>
        ";
        
        return false;
      }
      
      $result_boeing = mysqli_query($conn, "SELECT boieng_pesawat from pesawat where boieng_pesawat = '$boeing_pesawat'");

      if(mysqli_fetch_assoc($result_boeing)){
        echo "
        <script>
            alert('Boeing pesawat sudah terdaftar');
        </script>
        ";

        return false;
      }

      if($files["gambar_pesawat"]["error"] === 4){
            echo"
            <script>
              alert('Gambar Pesawat Belum Di Upload');
            </script>

          ";
          return false;
      }
      $fileName = $files["gambar_pesawat"]["name"];
      $fileSize = $files["gambar_pesawat"]["size"];
      $tmpName =  $files["gambar_pesawat"]["tmp_name"];
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  
      if(!in_array($imageExtension, $validImageExtension)){
        echo "
          <script>
          alert('Gambar harus jpg, jpeg, png');
        </script>
        ";
  
        return false;
      }
  
      if($fileSize > 5000000){
        echo "
        <script>
          alert('Gambar tidak boleh lebih dari 5MB');
        </script>
      ";
  
      return false;
      }
      $newImageName = uniqid();
      $newImageName .= ".".$imageExtension;
  
      move_uploaded_file($tmpName, "../gambar_pesawat/".$newImageName );
      $query = "INSERT INTO pesawat VALUES (NULL, '$no_registrasi', '$newImageName', '$nama_pesawat','$boeing_pesawat', '$jenis_pesawat', '$kapasitas_penumpang')";
  
      mysqli_query($conn, $query);
  
      return mysqli_affected_rows($conn);
}

function update_pesawat($post, $files){
  global $conn;

  $id_pesawat = $post["id_pesawat"];
  $no_registrasi = $post["nomor_registrasi"];
  $nama_pesawat = $post["nama_pesawat"];
  $boeing_pesawat = $post["boeing_pesawat"];
  $jenis_pesawat = $post["jenis_pesawat"];
  $kapasitas_penumpang = $post["kapasitas_penumpang"];


  if($files["gambar_pesawat"]["error"] === 4){
        echo"
        <script>
          alert('Gambar Pesawat Belum Di Upload');
        </script>

      ";
      return false;
  }
  $fileName = $files["gambar_pesawat"]["name"];
  $fileSize = $files["gambar_pesawat"]["size"];
  $tmpName =  $files["gambar_pesawat"]["tmp_name"];
  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

  if(!in_array($imageExtension, $validImageExtension)){
    echo "
      <script>
      alert('Gambar harus jpg, jpeg, png');
    </script>
    ";

    return false;
  }

  if($fileSize > 5000000){
    echo "
    <script>
      alert('Gambar tidak boleh lebih dari 5MB');
    </script>
  ";

  return false;
  }

  $queryOldImage = "SELECT gambar_pesawat FROM pesawat WHERE id_pesawat = '$id_pesawat'";
  $resultOldImage = mysqli_query($conn, $queryOldImage);
  $rowOldImage = mysqli_fetch_assoc($resultOldImage);
  $oldImageName = $rowOldImage['gambar_pesawat'];

  unlink("../gambar_pesawat/$oldImageName");


  $newImageName = uniqid();
  $newImageName .= ".".$imageExtension;


  move_uploaded_file($tmpName, "../gambar_pesawat/".$newImageName );
  $query = "UPDATE pesawat SET no_registrasi = '$no_registrasi', gambar_pesawat = '$newImageName', nama_pesawat = '$nama_pesawat', boieng_pesawat='$boeing_pesawat' 
  , jenis_pesawat='$jenis_pesawat', kapasitas_penumpang = '$kapasitas_penumpang' WHERE id_pesawat = '$id_pesawat'";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function tambah_teknisi($post, $files){
    global $conn;

    $username_teknisi = $post['username_teknisi'];
    $password_teknisi = $post['password_teknisi'];
    $nama_teknisi = $post['nama_teknisi'];
    $nip_teknisi = $post['nip_teknisi'];

    $result_username =  mysqli_query($conn, "SELECT username_teknisi FROM teknisi WHERE username_teknisi='$username_teknisi'");

    if(mysqli_fetch_assoc($result_username)){
        echo "
            <script>
                alert('username sudah terdaftar');
            </script>
        ";

        return false;
    }

    $result_nip =  mysqli_query($conn, "SELECT nip_teknisi FROM teknisi WHERE nip_teknisi='$nip_teknisi'");

    if(mysqli_fetch_assoc($result_nip)){
        echo "
            <script>
                alert('NIP Pegawai sudah terdaftar');
            </script>
        ";

        return false;
    }

    if($files["gambar_teknisi"]["error"] === 4){
      echo"
          <script>
            alert('Gambar Teknisi Belum Di Upload');
          </script>

        ";
        return false;
    }

    $fileName = $files["gambar_teknisi"]["name"];
    $fileSize = $files["gambar_teknisi"]["size"];
    $tmpName =  $files["gambar_teknisi"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if(!in_array($imageExtension, $validImageExtension)){
      echo "
        <script>
        alert('Gambar harus jpg, jpeg, png');
      </script>
      ";

      return false;
    }

    if($fileSize > 5000000){
      echo "
      <script>
        alert('Gambar tidak boleh lebih dari 5MB');
      </script>
    ";

    return false;
    }

    $newImageName = uniqid();
    $newImageName .= ".".$imageExtension;

    move_uploaded_file($tmpName, "../gambar_teknisi/".$newImageName );
    $query = "INSERT INTO teknisi VALUES (NULL, '$nip_teknisi', '$newImageName', '$username_teknisi','$password_teknisi', '$nama_teknisi')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function update_teknisi($post, $files){
    global $conn;

    $id_teknisi = $post['id_teknisi'];
    $username_teknisi = $post['username_teknisi'];
    $password_teknisi = $post['password_teknisi'];
    $nama_teknisi = $post['nama_teknisi'];
    $nip_teknisi = $post['nip_teknisi'];




    if($files["gambar_teknisi"]["error"] === 4){
        echo"
            <script>
              alert('Gambar Teknisi Belum Di Upload');
            </script>

          ";
          return false;
    }

    $fileName = $files["gambar_teknisi"]["name"];
    $fileSize = $files["gambar_teknisi"]["size"];
    $tmpName =  $files["gambar_teknisi"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if(!in_array($imageExtension, $validImageExtension)){
        echo "
          <script>
          alert('Gambar harus jpg, jpeg, png');
        </script>
        ";

        return false;
    }

    if($fileSize > 5000000){
        echo "
        <script>
          alert('Gambar tidak boleh lebih dari 5MB');
        </script>
        ";

        return false;
    }
    $queryOldImage = "SELECT gambar_teknisi FROM teknisi WHERE id_teknisi = '$id_teknisi'";
    $resultOldImage = mysqli_query($conn, $queryOldImage);
    $rowOldImage = mysqli_fetch_assoc($resultOldImage);
    $oldImageName = $rowOldImage['gambar_teknisi'];
  
    unlink("../gambar_teknisi/$oldImageName");


    $newImageName = uniqid();
    $newImageName .= ".".$imageExtension;

    move_uploaded_file($tmpName, "../gambar_teknisi/".$newImageName );
    $query = "UPDATE teknisi SET nip_teknisi = '$nip_teknisi', gambar_teknisi = '$newImageName', username_teknisi = '$username_teknisi', password_teknisi='$password_teknisi' 
    , nama_teknisi='$nama_teknisi' WHERE id_teknisi = '$id_teknisi'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete_teknisi($id_teknisi){
  global $conn;

  $query = "DELETE FROM teknisi WHERE id_teknisi = '$id_teknisi'";
  
  $queryOldImage = "SELECT gambar_teknisi FROM teknisi WHERE id_teknisi = '$id_teknisi'";
  $resultOldImage = mysqli_query($conn, $queryOldImage);
  $rowOldImage = mysqli_fetch_assoc($resultOldImage);
  $oldImageName = $rowOldImage['gambar_teknisi'];

  unlink("../gambar_teknisi/$oldImageName");
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);

}

function delete_pesawat($id_pesawat){
  global $conn;

  $query = "DELETE FROM pesawat WHERE id_pesawat = '$id_pesawat'";

  $queryOldImage = "SELECT gambar_pesawat FROM pesawat WHERE id_pesawat = '$id_pesawat'";
  $resultOldImage = mysqli_query($conn, $queryOldImage);
  $rowOldImage = mysqli_fetch_assoc($resultOldImage);
  $oldImageName = $rowOldImage['gambar_pesawat'];

  unlink("../gambar_pesawat/$oldImageName");

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

?>