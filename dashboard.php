<?php 
session_start();

if (isset($_POST["logout"])) { // jika logout dipencet, maka jalankan : 
    session_unset();
    session_destroy();
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php include "layout/header.html" ?>

    <h1>Selamat Datang,  <?=$_SESSION ["username"];  ?></h1>
    <form action="dashboard.php" method='POST'>
        <button type='submit' name='logout'>logout</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>