<?php 
    include"service/database.php";
    session_start();
    $register_massage = "";

    if (isset($_SESSION["is_login"])) {
        header("Location: dashboard.php");
        exit(); // Tambahkan exit untuk menghentikan eksekusi script
    }

    if(isset($_POST['register'])) { // jika register di pencet, maka jalankan :
        $username = $_POST["username"]; // buat variabel $username -> dari inputan username
        $password = $_POST["password"]; // buat variabel $password -> dari inputan password
        $hash_password = hash('sha256', $password); // buat variabel $hash_password -> biar password dienkripsi

        try {
            $sql = "INSERT INTO users (username, password) VALUES ('$username','$hash_password')"; // masukkan ke tabel users -> username, password dengan variabel $username dan $hash_password
            if($db->query($sql)) {  // jika koneksi ke database pake $sql
                $register_massage ="daftar akun BERHASIL ✅, silahkan Login !";
            } else {
                $register_massage = "daftar akun GAGAL❌, silahkan coba lagi !";
            }
        } catch (mysqli_sql_exception) {
            $register_massage = "username sudah digunakan, silahkan ganti yang lain";
        }
        $db->close();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3>DAFTAR AKUN</h3>
    <i><?= $register_massage ?> </i> <!-- buat munculkan pesan dari variabel $register_massage -->
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username" required/>
        <input type="password" placeholder="password" name="password" required/>
        <button type="submit" name="register">Daftar sekarang !</button>
    </form>

    <?php include "layout/footer.html" ?>

</body>
</html>