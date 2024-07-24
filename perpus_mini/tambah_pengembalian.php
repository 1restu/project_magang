<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    $tanggal_pengembalian = htmlspecialchars($_POST['tanggal_pengembalian']);
    $denda = htmlspecialchars($_POST['denda']);

    if (empty($tanggal_pengembalian)) {
        echo "
            <script>
                alert('Masukan tanggal pengembalian!');
                history.back();
            </script>
        ";
    } else {$query = "INSERT INTO pengembalian (id_peminjaman, tanggal_pengembalian, denda) 
              VALUES ('$id_peminjaman', '$tanggal_pengembalian', '$denda')";
              if (mysqli_query($koneksi, $query)) {
                echo "
                <script>
                    alert('Pengembalian buku berhasil ditambahkan!');
                    location.href = 'pengembalian.php';
                </script>
            ";
            }
        }
} else {
    // Ambil data peminjaman
    $peminjaman_sql = "SELECT peminjaman.*, anggota.nama AS nama_anggota, buku.judul AS judul_buku 
                       FROM peminjaman 
                       JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota 
                       JOIN buku ON peminjaman.id_buku = buku.id_buku";
    $peminjaman_result = mysqli_query($koneksi, $peminjaman_sql);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Tambah Pengembalian</h2>
<form action="tambah_pengembalian.php" method="POST">
    <label>Peminjaman</label>
    <select name="id_peminjaman">
        <?php while ($peminjaman = mysqli_fetch_assoc($peminjaman_result)) { ?>
            <option value="<?= $peminjaman['id_peminjaman']; ?>">
                <?php echo $peminjaman['nama_anggota'] . " - " . $peminjaman['judul_buku']; ?>
            </option>
        <?php } ?>
    </select>
    <label>Tanggal Pengembalian</label>
    <input type="date" name="tanggal_pengembalian">
    <label>Denda</label>
    <input type="number" name="denda">
    <button type="submit">Tambah</button>
</form>
<?php include 'inc/footer.php'; ?>
