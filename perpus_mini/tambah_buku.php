<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = htmlspecialchars($_POST['judul']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $tahun_terbit = htmlspecialchars($_POST['tahun_terbit']);
    $id_kategori = htmlspecialchars($_POST['id_kategori']);   
    
    // Cek apakah judul buku sudah ada di database
    $cek_judul_sql = "SELECT * FROM buku WHERE judul='$judul'";
    $cek_judul_result = mysqli_query($koneksi, $cek_judul_sql);
    
    if (empty($judul) || empty($penulis) || empty($tahun_terbit)) {
        echo "
            <script>
                alert('Mohon lengkapi semua data!');
                history.back();
            </script>
        ";
    } elseif (mysqli_num_rows($cek_judul_result) > 0) {
        echo "
            <script>
                alert('Judul buku sudah ada. Silahkan masukan judul yang berbeda.');
                history.back();
            </script>
        ";
    } else {
        $query = "INSERT INTO buku (judul, penulis, tahun_terbit, id_kategori) 
                  VALUES ('$judul','$penulis', '$tahun_terbit', '$id_kategori')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "
                <script>
                    alert('Buku baru berhasil ditambahkan!');
                    location.href = 'buku.php';
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
} else {
    // Ambil data kategori
    $kategori_sql = "SELECT * FROM kategori";
    $kategori_result = mysqli_query($koneksi, $kategori_sql);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Tambah Buku</h2>
<form id="tambahBukuForm" action="tambah_buku.php" method="POST">
    <label>Judul</label>
    <input type="text" name="judul">
    <label>Penulis</label>
    <input type="text" name="penulis">
    <label>Tahun Terbit</label>
    <input type="text" name="tahun_terbit">
    <label>Kategori</label>
    <select name="id_kategori" required>
        <?php while ($kategori = mysqli_fetch_assoc($kategori_result)) { ?>
            <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
        <?php } ?>
    </select>
    <button type="submit">Tambah</button>
</form>
<?php include 'inc/footer.php'; ?>
