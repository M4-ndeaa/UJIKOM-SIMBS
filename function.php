<?php

// Koneksi ke Database
$conn = mysqli_connect("localhost", "root", "", "simbs");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 


// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ===================================================================
// FUNGSI QUERY
// ===================================================================
function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// ===================================================================
// FUNGSI TAMBAH BUKU
// ===================================================================
function tambah_data($data){
    global $conn;

    $nama              = $data["nama"];
    $stok_buku         = $data["stok_buku"];
    $harga             = $data["harga"];
    $tahun_terbit      = $data["tahun_terbit"];
    $penulis           = $data["penulis"];
    $tanggal_input     = $data["tanggal_input"];
    $gambar_cover      = $data["gambar_cover"];
    
    $query = "INSERT INTO buku 
                (nama,  stok_buku, harga, tahun_terbit, penulis, tanggal_input, gambar_cover)
              VALUES
                ('$nama','$stok_buku','$harga', '$tahun_terbit', '$penulis','$tanggal_input','$gambar_cover')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ===================================================================
// FUNGSI HAPUS BUKU
// ===================================================================
function hapus_data($id_buku){
    global $conn;

    mysqli_query($conn, "DELETE FROM buku WHERE id_buku = $id_buku");

    return mysqli_affected_rows($conn);
}

// ===================================================================
// FUNGSI UBAH BUKU 
// ===================================================================
function ubah_buku($id_buku){
    global $conn;

    $id_buku           = $data['id_buku'];
    $nama              = $data['nama'];
    $stok_buku         = $data['stok_buku'];
    $harga             = $data['harga'];
    $tahun_terbit      = $data['tahun_terbit'];
    $penulis           = $data['penulis'];
    $tanggal_input     = $data['tanggal_input'];
    $gambar_cover      = $data['gambar_cover']; 
    $id_kategori       =$data['id_kategori'];

   
    $query = "UPDATE buku SET
                nama='$nama',
                stok_buku='$stok_buku', 
                harga='$harga',
                tahun_terbit='$tahun_terbit'
                penulis='$penulis',
                tanggal_input='$tanggal_input'
                gambar_cover='$gambar_cover',
              WHERE id_buku=$id_buku";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ===================================================================
// FUNGSI SEARCH BUKU
// ===================================================================
function search_data($keyword){
    global $conn;

    $query = "SELECT * FROM buku
              WHERE 
              nama LIKE '%$keyword%' OR
              harga LIKE '%$keyword%' OR
              kategori LIKE '%$keyword%'";
    return query($query);
}


// ===================================================================
// FUNGSI UBAH KATEGORI (EDIT KATEGORI)
// ===================================================================
function edit_kategori($data){
    global $conn;

    $id_kategori         = $data['id_kategori'];
    $nama_kategori   = $data['nama_kategori'];

    $query = "UPDATE kategori SET
                nama_kategori='$nama_kategori'
              WHERE id_kategori=$id_kategori";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// ===================================================================
// FUNGSI HAPUS KATEGORI
// ===================================================================
function hapus_kategori($id) {
    global $conn;

    $id = (int)$id; 
    $query = "DELETE FROM katagori WHERE id_kategori = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ===================================================================
// FUNGSI TAMBAH KATEGORI 
// ===================================================================
function tambah_kategori($data) {
    global $conn;

    $nama_kategori = $data['nama_kategori'];
    $query = "INSERT INTO katagori (nama_kategori) 
              VALUES ('$nama_kategori')";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ===================================================================
// FUNGSI REGISTER
// ===================================================================
function register($data){
    global $conn;

    $username = strtolower($data["username"]);
    $email    = strtolower($data["email"]);
    $password = $data["password"];
    $confirm  = $data["confirm_password"];

    // VALIDARI PANJANGNYA PASSWORD
        $panjang = strlen($password);

        if ($panjang < 8 ) {
            return "Password harus mengandung minimal 8 karakter";
        } 
    
    // KONFIRMASI PASSWORD
    if ($password !== $confirm){
        return "Password tidak sama";
    }

    // MENYIMPAN PASSWORD PADA DATABASE
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query=  "INSERT INTO user(username,email,password)
    VALUES('$username','$email','$password_hash')";
    mysqli_query($conn, $query);
    
    return true;

}

    // LOGINN
    function login($data){
    global $conn;


    $username = $data['username'];
    $password = $data['password'];


    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);


    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);


        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            return true;
        } else { 
            return "Password salah!";
        }
    }else{
        return "Username tidak terdaftar!"; }
}


?>
