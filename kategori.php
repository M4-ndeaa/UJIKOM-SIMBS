<?php
session_start();
require "function.php";

// MENAMBAHKAN KATEGORI
if (isset($_POST['tambah_kategori'])) {
    if (tambah_kategori($_POST) > 0) {
        echo "<script>
                alert('Kategori berhasil ditambahkan!');
                document.location.href = 'kategori.php';
              </script>";
    } else {
        echo "<script>
                alert('Kategori gagal ditambahkan!');
                document.location.href = 'kategori.php';
              </script>";
    }
}

// EDIT KATEGORI 
if (isset($_POST["edit_kategori"])) {
    if (update_kategori($_POST) > 0) {
        echo "<script>
                alert('Kategori berhasil diubah!');
                document.location.href = 'kategori.php';
              </script>";
    } else {
        echo "<script>
                alert('Kategori gagal diubah atau tidak ada perubahan!');
                document.location.href = 'kategori.php';
              </script>";
    }
}

// MENGHAPUS KATEGORI 
if (isset($_GET["hapus"])) {
    
    if (hapus_kategori($_GET["hapus"]) > 0) { 
        echo "<script>
                alert('Kategori berhasil dihapus!');
                document.location.href = 'kategori.php';
              </script>";
    } else {
        echo "<script>
                alert('Kategori gagal dihapus!');
                document.location.href = 'kategori.php';
              </script>";
    }

}


if (isset($_POST["cari"]) && !empty($_POST["keyword"])) {
    $kategori = search_kategori($_POST["keyword"]); 
} else {
    $kategori = query ("SELECT * FROM katagori ORDER BY id_kategori DESC");
}
?>
</table>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Manajemen Kategori - SIMBS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light white bg-info">
        <div class="container">
            <a class="navbar-brand text-white" href="#">SIMBS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="index.php">Data Buku</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= isset($_SESSION ['username']) ? $_SESSION ['username'] : 'Pilihan'?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                            <a class="dropdown-item" href="kategori.php">Kategori</a>
                            <a class="dropdown-item" href="index.php">Beranda</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
    </nav>

<div class="container p-4">
  <h1>Kategori Buku</h1>

  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" class="row g-2">
        <div class="col-md-8">
          <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori" required>
        </div>
        <div class="col-md-4">
          <button name="tambah_kategori" class="btn btn-info text-white w-100">Tambah Kategori</button>
        </div>
      </form>
    </div>
  </div>

  <form method="POST" class="mb-3 d-flex gap-2">
    <input type="text" name="keyword" class="form-control" placeholder="Cari kategori...">
    <button name="cari" class="btn btn-info text-white">Cari</button>
  </form>

  <table class="table table-bordered text-center">
    <thead class="table-info">
      <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no =  1; foreach($kategori as $row): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
        <td>
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_kategori'] ?>">Edit</button>
          <a href="kategori.php?hapus=<?= $row['id_kategori'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
      </tr>

      <!-- Edit Modal -->
      <div class="modal fade" id="editModal<?= $row['id_kategori'] ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_kategori" value="<?= $row['id_kategori'] ?>">
                <input type="text" name="nama_kategori" class="form-control" value="<?= htmlspecialchars($row['nama_kategori']) ?>" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="edit_kategori" class="btn btn-info btn-sm">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php endforeach; ?>
    </tbody>
  </table>


  <a href="index.php" class="btn btn-dark mt-3">Kembali</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
