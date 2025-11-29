<?php
    require("function.php");

        $id_kategori = $_GET['id_kategori']; 

    
    $data_kategori = query("SELECT * FROM katagori WHERE id_kategori = $id_kategori")[0];

      if(isset($_POST['tombol_update'])){
        
                if(edit_kategori($_POST) > 0){ 
            echo "
                <script>
                    alert('Kategori berhasil diubah!');
                    document.location.href = 'kategori.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Kategori gagal diubah atau tidak ada perubahan data!');
                    document.location.href = 'kategori.php';
                </script>
            ";
        }
    }
?>

<form action="" method="post">
    <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">

    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>" required>

    <button type="submit" name="tombol_update">Update</button>
</form>