<!-- mau connect ke database yang mana -->
<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "users"; // nama database nya (bukan tabel !)

$db = mysqli_connect($hostname, $username, $password, $database_name); // buat koneksi ke database

if($db->connect_error){ // jika koneksi ke database error, maka jalankan :
    echo "koneksi ke database rusak";
    die("error!"); // untuk mematikan koneksi ke database
}

?>