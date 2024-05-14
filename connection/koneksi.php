<?php 

$server = "localhost";
$user = "root";
$password = "";
$db = "sim-apk-db";

$conn = mysqli_connect($server, $user, $password, $db);

if(!$conn){
    echo "Error SQL : ". mysqli_connect_error();
    return;
}





?>