<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = htmlspecialchars($_POST['nama_kategori']);

    $cek_kategori = "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori'";
    $cek_ktg = mysqli_query($koneksi, $cek_kategori);

    if (empty($nama_kategori)) {
        echo '
        <script>alert("Mohon masukan nama kategori!"); 
        history.back();
        </script>
        ';
    } elseif (mysqli_num_rows($cek_ktg) > 0) {
        echo "
            <script>
                alert('Nama kategori sudah ada. Silahkan buat nama kategori yang berbeda.');
                location.href = 'tambah_kategori.php';
            </script>
        ";
    } else {
        $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "
                <script>
                    alert('Kategori baru berhasil ditambahkan!');
                    location.href = 'kategori.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal ditambahkan: " . mysqli_error($koneksi) . "');
                </script>
            ";
        }
    }
}
?>

<?php include 'inc/header.php'; ?>
<h2>Tambah Kategori</h2>
<form action="tambah_kategori.php" method="POST">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori">
    <button type="submit">Tambah</button>
</form>
<?php include 'inc/footer.php'; ?>
