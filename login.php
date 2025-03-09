<?php 
    include"service/database.php";
    session_start();
    
    $login_massage = "";

    if (isset($_SESSION["is_login"])) { // jika sudah login, maka jalankan :
        header("Location: dashboard.php"); 
        exit(); // Tambahkan exit untuk menghentikan eksekusi script
    }
   
    if (isset($_POST['login'])) {  // jika login dipencet, maka jalankan :
        $username = $_POST['username']; // buat variabel $username -> dari inputan username
        $password = $_POST['password']; // buat variabel $password -> dari inputan password
        // echo $username . ' ' . $password; // echo username dan password, lebih ringkas
        $hash_password = hash('sha256', $password); // buat variabel $hash_password -> biar password dienkripsi

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
        $result = $db->query($sql);

        if($result->num_rows > 0) { // jika datanya ada (validasi akun), maka jalankan :
            $data = $result->fetch_assoc(); // buat variabel $data untuk tampung data yg ada tadi
            $_SESSION ["username"] = $data["username"];
            $_SESSION ["is_login"] = true;
            header("location: dashboard.php"); // mindahin ke halaman dashboard
    } else {
        $login_massage = "akun tidak ditemukan❌";
    }
    $db->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3>SILAHKAN LOGIN AKUN</h3>
    <i><?= $login_massage; ?></i>
    <form action="login.php" method="POST">
        <input type="text" placeholder="username" name="username" required/>
        <input type="password" placeholder="password" name="password" required/>
        <button type="submit" name="login">Masuk sekarang !</button>
    </form>

    <?php include "layout/footer.html" ?>

</body>
</html>