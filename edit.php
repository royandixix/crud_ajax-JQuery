<?php

session_start();

if(!isset($_SESSION["login"]) )  {
    header("location: main.php");
    exit;
}




require "function.php";
$id = $_GET["id"];
// query data berdasarkan id nyah 
$data = query("SELECT * FROM  yes WHERE id = $id")[0];

if (!$db) {
    die("Koneksi ke database gagal: 
    " . mysqli_connect_error());
}



// cek apa kah tombol sumbit sud ada di tekan atau belum 
if (isset($_POST["submit"])) {

    // cek apakah data berhasil di ubah  atau tidak 
    if (edit($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil di ubah kan');
                document.location.href = 'main.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal di ubah ');
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



















<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data["id"]); ?>">
        <input type="hidden" name="gambarLama" value="<?php echo htmlspecialchars($data["gambar"]); ?>">
        <ul>
            <li>
                <label for="nik">Nik: </label>
                <input type="text" name="nik" id="nik" placeholder="Masukan NIK Anda" required value="<?php echo htmlspecialchars($data["nik"]); ?>">
            </li>
            <li>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama" placeholder="Masukan Nama Anda" required value="<?php echo htmlspecialchars($data["nama"]); ?>">
            </li>
            <li>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Masukan Email Anda" required value="<?php echo htmlspecialchars($data["email"]); ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan: </label>
                <input type="text" name="jurusan" id="jurusan" placeholder="Masukan Jurusan Anda" required value="<?php echo htmlspecialchars($data["jurusan"]); ?>">
            </li>
            <li>
                <label for="gambar">Gambar: </label>
                <img src="img/<?php echo htmlspecialchars($data['gambar']); ?>" alt="">
                <input type="file" name="gambar" id="gambar">
            </li>
            <button type="submit" name="submit">Ubah</button>
        </ul>
    </form>
</body>
</html>