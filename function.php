<?php

// koneksikan ke database
$db =  mysqli_connect(
    "localhost",
    "root",
    "",
    "ok"
);







$result = mysqli_query(
    $db,
    // OERDER BY id
    // ASC
    // DESC
    // WHERE nik = ''
    "SELECT * FROM yes"
);














function query($query)
{

    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}










function add($data)
{
    global $db;
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // $gambar = htmlspecialchars($data["gambar"]);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    $query = "INSERT INTO yes 
    VALUES 
    ('',  
          '$nik',
          '$nama',
          '$email',     
          '$jurusan',     
          '$gambar' 
    )
    ";
    mysqli_query($db, $query);
    return  mysqli_affected_rows($db);
}








function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apaka tidak ada gambar yang di upload 
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu.');
              </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $namaFile);
    // $ekstensiGambar = $ekstensiGambar[1];
    // $ekstensiGambar = end($ekstensiGambar);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {


        echo "<script>
            alert('yang anda upload bukan gambar. ');
          </script>";
        return false;
    }
    // cek ukuranya jika terlalu besar 
    if ($ukuranFile > 5000000) {

        echo "<script>
                alert('ukuran gambar terlalu besar!.');
            </script>";
        return false;
    }
    // Lolos pengecekan, gambar siap di Upload
    // generate nama gambar baru 
    $namaFile = uniqid();
    $namaFile .= '.';
    $namaFile .= $ekstensiGambar;
    




    move_uploaded_file($tmpName, 'img/' . $namaFile);
    return $namaFile;
}















function delet($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM yes WHERE id = $id");
    return mysqli_affected_rows($db);
}














function edit($data)
{
    global $db;

    $id = $data["id"];
    $nik = mysqli_real_escape_string($db, htmlspecialchars($data["nik"]));
    $nama = mysqli_real_escape_string($db, htmlspecialchars($data["nama"]));
    $email = mysqli_real_escape_string($db, htmlspecialchars($data["email"]));
    $jurusan = mysqli_real_escape_string($db, htmlspecialchars($data["jurusan"]));
    $gambarLama = mysqli_real_escape_string($db, htmlspecialchars($data["gambarLama"]));
    // $gambar = mysqli_real_escape_string($db, htmlspecialchars($data["gambar"]));















    // cek apaka user pilig gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE yes SET 
        nik = '$nik',
        nama = '$nama',
        email = '$email',
        jurusan = '$jurusan',
        gambar = '$gambar'
        WHERE id = $id";

    $result = mysqli_query($db, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($db);
        return false;
    }

    return mysqli_affected_rows($db);
}















function cari($keyword)
{
    $query = "SELECT * FROM yes
                WHERE
    nama LIKE '%$keyword%' OR
    nik LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR 
    jurusan LIKE '%$keyword%' 
    ";

    return query($query);
}























function registrasi($data)
{
    global $db;

    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    // cek username suda ada atau belum
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('user name anda sudah terdaftar!')
             </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('user baru berhasil di tambahkan ')
              </script>";

        return false;
    }

    // enskripsi password
    $password = password_hash(
        $password,
        PASSWORD_DEFAULT

        
        
    );

    // tambah kan  user bary je database
    mysqli_query($db, "INSERT INTO user VALUES('', '$username','$password')");

    return mysqli_affected_rows($db);
}

// fucntion login()