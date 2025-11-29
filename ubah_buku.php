<?php
session_start();
require("function.php");

    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $id_buku = $_GET['id_buku'];


    $query = query("SELECT * FROM buku WHERE id_buku = $id_buku")[0];
    // echo "<pre>";
    // var_dump($query);
    // echo "</pre>";
    $buku = $query;


    // ketika tombol submit nya di klik
    if(isset($_POST['tombol_submit'])){
       
        if(ubah_buku($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
}


?>