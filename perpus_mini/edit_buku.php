<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $judul = htmlspecialchars($_POST['judul']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $tahun_terbit = htmlspecialchars($_POST['tahun_terbit']);
    $id_kategori = htmlspecialchars($_POST['id_kategori']);
    
    $query = "UPDATE buku SET judul = '$judul', penulis = '$penulis', tahun_terbit = '$tahun_terbit', id_kategori = '$id_kategori' 
              WHERE id_buku = $id";
    mysqli_query($koneksi, $query);
    header('Location: buku.php');
    exit;
} else {
    $id = htmlspecialchars($_GET['id']);
    $query = "SELECT * FROM buku WHERE id_buku = $id";
    $result = mysqli_query($koneksi, $query);
    $buku = mysqli_fetch_assoc($result);

    // Ambil data kategori
    $kategori_sql = "SELECT * FROM kategori";
    $kategori_result = mysqli_query($koneksi, $kategori_sql);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Edit Buku</h2>
<form action="edit_buku.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($buku['id_buku']); ?>">
    <label>Judul</label>
    <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>
    <label>Penulis</label>
    <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required>
    <label>Tahun Terbit</label>
    <input type="text" name="tahun_terbit" value="<?= htmlspecialchars($buku['tahun_terbit']); ?>" required>
    <label>Kategori</label>
    <select name="id_kategori" required>
        <?php while ($kategori = mysqli_fetch_assoc($kategori_result)) { ?>
            <option value="<?= $kategori['id_kategori']; ?>" <?php if ($kategori['id_kategori'] == $buku['id_kategori']) echo 'selected'; ?>>
                <?= $kategori['nama_kategori']; ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit">Update</button>
</form>
<?php include 'inc/footer.php'; ?>
