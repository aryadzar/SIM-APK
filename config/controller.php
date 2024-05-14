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

function tambah_teknisi($post, $files){
    global $conn;

    $username_teknisi = $post['username_teknisi'];
    $password_teknisi = $post['password_teknisi'];
    $nama_teknisi = $post['nama_teknisi'];
    $nip_teknisi = $post['nip_teknisi'];

    $result =  mysqli_query($conn, "SELECT username_teknisi FROM teknisi WHERE username_teknisi='$username_teknisi'");

    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('username sudah terdaftar');
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
  
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);

}

?>