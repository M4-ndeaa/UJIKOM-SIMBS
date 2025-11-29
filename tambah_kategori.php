<?php
    require("function.php");


    // kita akan cek dulu ketika tombol submit ditekan
    if(isset($_POST['tombol_submit'])){
        //  var_dump($_POST);

        // ==============
        // CARA KEDUA
        // ==============
        if(tambah_kategori($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil ditambahkan ke database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan ke database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }


?>
<form action="" method="post">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" required>
    <button type="submit" name="tombol_submit">Tambah</button>
</form>