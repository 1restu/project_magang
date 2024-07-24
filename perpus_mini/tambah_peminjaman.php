<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anggota = htmlspecialchars($_POST['id_anggota']);
    $id_buku = htmlspecialchars($_POST['id_buku']);
    $tanggal_pinjam = htmlspecialchars($_POST['tanggal_pinjam']);
    $tanggal_kembali = htmlspecialchars($_POST['tanggal_kembali']);

    if (empty($id_anggota) || empty($id_buku) || empty($tanggal_pinjam) || empty($tanggal_kembali)) {
        echo "
            <script>
                alert('Mohon lengkapi semua data!');
                history.back();
            </script>
        ";
    } else {
        $query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam) VALUES ('$id_anggota', '$id_buku', '$tanggal_pinjam')";
        if (mysqli_query($koneksi, $query)) {
            echo "
                <script>
                    alert('Peminjaman baru berhasil ditambahkan!');
                    location.href = 'peminjaman.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Terjadi kesalahan saat menambahkan peminjaman.');
                    history.back();
                </script>
            ";
        }
    }
    
} else {
    // Ambil data anggota
    $anggota_sql = "SELECT * FROM anggota";
    $anggota_result = mysqli_query($koneksi, $anggota_sql);

    // Ambil data buku
    $buku_sql = "SELECT * FROM buku";
    $buku_result = mysqli_query($koneksi, $buku_sql);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Tambah Peminjaman</h2>
<form action="tambah_peminjaman.php" method="POST">
    <label>Anggota</label>
    <select name="id_anggota">
        <?php while ($anggota = mysqli_fetch_assoc($anggota_result)) { ?>
            <option value="<?= $anggota['id_anggota']; ?>"><?= $anggota['nama']; ?></option>
        <?php } ?>
    </select>
    <label>Buku</label>
    <select name="id_buku">
        <?php while ($buku = mysqli_fetch_assoc($buku_result)) { ?>
            <option value="<?= $buku['id_buku']; ?>"><?= $buku['judul']; ?></option>
        <?php } ?>
    </select>
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam">
    <label>Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali">
    <button type="submit">Tambah</button>
</form>
<?php include 'inc/footer.php'; ?>
