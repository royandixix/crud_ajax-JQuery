<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("location: main.php");
    exit;
}

require 'function.php';

// Ambil semua data dari tabel 'yes'
$yes = query("SELECT * FROM yes");

// Tombol cari terdeteksi
if (isset($_POST["cari"])) {
    $yes = cari($_POST["keyword"]);
}



















?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/loading.css">
    <title>Halaman Admin</title>

<body>
    <div class="container">
        <div class="header">
            <h1>Daftar Anak Mahasiswa Magang</h1>
            <a href="logout.php">Logout</a>
        </div>

        <form action="" method="post" class="form-container">
            <a href="add.php" class="btn-blue">Tambah Data</a>
            <input type="text" name="keyword" id="keyword" placeholder="Cari data" autofocus autocomplete="off">
            <button type="submit" name="cari" id="tombol-cari" class="btn-green">Cari</button>
            

            <img src="animation/Spinner@1x-1.0s-200px-200px.gif" class="load">
        </form>
        <!-- pagination -->





















        <div id="container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aksi</th>
                        <th>Gambar</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($yes as $mg) : ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $mg["id"] ?>">Edit</a> |
                                <a href="delete.php?id=<?php echo $mg["id"]; ?>" onclick="return confirm('Yakin?');">Delete</a>
                            </td>
                            <td><img src="img/<?php echo $mg["gambar"]; ?>" alt=""></td>
                            <td><?php echo $mg["nik"]; ?></td>
                            <td><?php echo $mg["nama"]; ?></td>
                            <td><?php echo $mg["email"]; ?></td>
                            <td><?php echo $mg["jurusan"]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.js"></script>
</body>

</html>