<?php


session_start();

if(!isset($_SESSION["login"]) )  {
    header("location: main.php");
    exit;
}









require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST)) {
        echo "<script>
                alert('User berhasil ditambahkan!');
              </script>";
    } else {
        echo mysqli_error($db);
    }
}















?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    label {
        display: block;

    }
</style>

<body>
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username: </label>
                <input type="text" name="username" id="username">

            </li>
            <li>    
                <label for="passsword">passsword : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Konfirmasi Password: </label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="register">register</button>
            </li>
        </ul>
    </form>
</body>

</html>