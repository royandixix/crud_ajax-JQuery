<?php 


session_start();

if(!isset($_SESSION["login"]) )  {
    header("location: main.php");
    exit;
}





    

    require'function.php';
    
    $id = $_GET ["id"];


    if (delet($id) > 0) {
        echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = 'main.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus');
            document.location.href = 'main.php';
        <d/script>
        ";
    }
    
?>