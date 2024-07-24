<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    $tanggal_pengembalian = htmlspecialchars($_POST['tanggal_pengembalian']);
    $denda = htmlspecialchars($_POST['denda']);

    $query = "UPDATE pengembalian SET id_peminjaman = '$id_peminjaman', tanggal_pengembalian = '$tanggal_pengembalian', denda = '$denda' 
              WHERE id_pengembalian = $id";
    mysqli_query($koneksi, $query);
    header('Location: pengembalian.php');
    exit;
} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM pengembalian WHERE id_pengembalian = $id";
    $result = mysqli_query($koneksi, $query);
    $pengembalian = mysqli_fetch_assoc($result);

    // Ambil data peminjaman
    $peminjaman_sql = "SELECT peminjaman.*, anggota.nama AS nama_anggota, buku.judul AS judul_buku 
                       FROM peminjaman 
                       JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota 
                       JOIN buku ON peminjaman.id_buku = buku.id_buku";
    $peminjaman_result = mysqli_query($koneksi, $peminjaman_sql);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Edit Pengembalian</h2>
<form action="edit_pengembalian.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $pengembalian['id_pengembalian']; ?>">
    <label>Peminjaman</label>
    <select name="id_peminjaman" required>
        <?php while ($peminjaman = mysqli_fetch_assoc($peminjaman_result)) { ?>
            <option value="<?php echo $peminjaman['id_peminjaman']; ?>" <?php if ($peminjaman['id_peminjaman'] == $pengembalian['id_peminjaman']) echo 'selected'; ?>>
                <?php echo $peminjaman['nama_anggota'] . " - " . $peminjaman['judul_buku']; ?>
            </option>
        <?php } ?>
    </select>
    <label>Tanggal Pengembalian</label>
    <input type="date" name="tanggal_pengembalian" value="<?php echo $pengembalian['tanggal_pengembalian']; ?>" required>
    <label>Denda</label>
    <input type="number" name="denda" value="<?php echo $pengembalian['denda']; ?>" required>
    <button type="submit">Update</button>
</form>
<?php include 'inc/footer.php'; ?>
