<?php

// sleep(0.5);
usleep(500000);
require '../function.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM yes
        WHERE
            nama LIKE '%$keyword%' OR
            nik LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR 
            jurusan LIKE '%$keyword%' 
";;



$yes = query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="pertemuan10/CSS/main.css">
</head>

<body>
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
                    <td><?= $i; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $mg["id"]; ?>">Edit</a> |
                        <a href="delete.php?id=<?= $mg["id"]; ?>" onclick="return confirm('Yakin?');">Delete</a>
                    </td>
                    <td><img src="img/<?= $mg["gambar"]; ?>" alt=""></td>
                    <td><?= $mg["nik"]; ?></td>
                    <td><?= $mg["nama"]; ?></td>
                    <td><?= $mg["email"]; ?></td>
                    <td><?= $mg["jurusan"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>