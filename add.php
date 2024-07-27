<?php

session_start();

if(!isset($_SESSION["login"]) )  {
    header("location: main.php");
    exit;
}









require "function.php";

if (!$db) {
    die("Koneksi ke database gagal: 
    " . mysqli_connect_error());
}




if (isset($_POST["submit"])) {
    
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;

    if (add($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil di tambah kan');
                document.location.href = 'main.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal di tambahkan');
                document.location.href = 'main.php';
            </script>
        ";
    }












    // if(mysqli_affected_rows($db) > 0) {
    //     echo "berhasil";
    // }else {
    //     echo "gagal!";
    //     echo "<br>";
    //     echo mysqli_error($db);
    // }

}




?>



















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css/add.css">

</head>
<style>

</style>
<body>
    <!-- <h1>Tambah Data</h1> -->
    <form action="" method="post" enctype="multipart/form-data" >
        <ul>
            <li>
                <label for="nik">Nik : </label>
                <input type="text" name="nik" id="nik" placeholder="masukan nik anda" required >
            </li>

            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" placeholder="masukan nama anda" required >
            </li>

            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" placeholder="masukan email anda " required >
            </li>

            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" placeholder="masukan jurusan anda " required >
            </li>

            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar" placeholder="Masukan gambar Anda " required >
            </li>

            <button type="submit" name="submit">Kirim</button>
        </ul>
    </form>
</body>

</html>