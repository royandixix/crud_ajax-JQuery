<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("location: main.php");
    exit;
}

require 'function.php';
//pagination
// konfigurasi 

$jumlahDataPerhalaman = 3;
// jumlah halaman  = total data / data perhalaman
// $result = mysqli_query($db,"SELECT * FROM yes");
// $jml = mysqli_num_rows($result);
// var_dump($jml);
$jumlahData = count(query("SELECT * FROM yes"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
// if(isset($_GET["halaman"]) ) {
//     $halamanAktif = $_GET["halaman"];
// }else{
//     $halamanAktif = 1;
// }






$yes = query("SELECT * FROM yes LIMIT $awalData, $jumlahDataPerhalaman");



// tombol cari detekan
if (isset($_POST["cari"])) {
    $yes = cari($_POST["keyword"]);
}










?>