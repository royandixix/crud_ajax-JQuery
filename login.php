<?php
session_start();

require 'function.php';


// cek cokie
if(isset($_COOKIE['id'])&& isset($_COOKIE['kry']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan name nya
    $result = mysqli_query($db,"SELECT * FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result); 

    // cek cokie dan username    
    
    if($key === hash('sha256', $row['username']) ){
        $_SESSION['login'] = true;
    }

    // if($_COOKIE['login'] == 'true') {
    //     $_SESSION['login'] == true; // login
    // }
}

if (isset($_SESSION["login"])) {
    header("location:main.php");
    exit;
}


if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

    

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password nyah v
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"]) ) {

            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if(isset($_POST['remember']) ) {
                // buat cokie
                // setcookie('login', 'true', time() + 60);
                setcookie('id', $row['id'], time()+ 60);
                setcookie('key', hash('sha256', $row['username']), time()+ 60);

            }

            header("location: main.php");
            exit;
        }
    }

    $erorr = true;
}

?>




















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>

<body>
    <h2>Selamat datang di website kami</h2>
    <h1>Halaman Login</h1>

    <?php if(isset($erorr) ) : ?>
        <p>username dan password anda salah </p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">
            </li>

            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </li>

            <li>
                <label for="remember">Remember me</label>
                <input type="checkbox" name="remember" id="remember">
            </li>

            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>

</body>

</html>