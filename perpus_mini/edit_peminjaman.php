<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $id_anggota = htmlspecialchars($_POST['id_anggota']);
    $id_buku = htmlspecialchars($_POST['id_buku']);
    $tanggal_pinjam = htmlspecialchars($_POST['tanggal_pinjam']);
    $tanggal_kembali = htmlspecialchars($_POST['tanggal_kembali']);

    // Cek apakah ada field yang kosong
    if (empty($id_anggota) || empty($id_buku) || empty($tanggal_pinjam) || empty($tanggal_kembali)) {
        echo '<script>alert("Mohon lengkapi semua data!"); location.href = "edit_peminjaman.php?id='.$id.'";</script>';
        exit;
    }

    $query = "UPDATE peminjaman SET id_anggota = '$id_anggota', id_buku = '$id_buku', tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali' 
              WHERE id_peminjaman = $id";
    mysqli_query($koneksi, $query);
    header('Location: peminjaman.php');
    exit;
} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM peminjaman WHERE id_peminjaman = $id";
    $result = mysqli_query($koneksi, $query);
    $peminjaman = mysqli_fetch_assoc($result);

    // Ambil data anggota
    $anggota_sql = "SELECT * FROM anggota";
    $anggota_result = mysqli_query($koneksi, $anggota_sql);

    // Ambil data buku
    $buku_sql = "SELECT * FROM buku";
    $buku_result = mysqli_query($koneksi, $buku_sql);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Edit Peminjaman</h2>
<form action="edit_peminjaman.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($peminjaman['id_peminjaman']); ?>">
    <label>Anggota</label>
    <select name="id_anggota" required>
        <?php while ($anggota = mysqli_fetch_assoc($anggota_result)) { ?>
            <option value="<?= $anggota['id_anggota']; ?>" <?php if ($anggota['id_anggota'] == $peminjaman['id_anggota']) echo 'selected'; ?>>
                <?= $anggota['nama']; ?>
            </option>
        <?php } ?>
    </select>
    <label>Buku</label>
    <select name="id_buku" required>
        <?php while ($buku = mysqli_fetch_assoc($buku_result)) { ?>
            <option value="<?php echo $buku['id_buku']; ?>" <?php if ($buku['id_buku'] == $peminjaman['id_buku']) echo 'selected'; ?>>
                <?= htmlspecialchars($buku['judul']); ?>
            </option>
        <?php } ?>
    </select>
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" value="<?= htmlspecialchars($peminjaman['tanggal_pinjam']); ?>">
    <label>Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali" value="<?= htmlspecialchars($peminjaman['tanggal_kembali']); ?>">
    <button type="submit">Update</button>
</form>
<?php include 'inc/footer.php'; ?>
