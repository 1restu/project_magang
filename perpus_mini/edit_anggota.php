<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);

    $query = "UPDATE anggota SET nama = '$nama', alamat = '$alamat', nomor_telepon = '$nomor_telepon' WHERE id_anggota = $id";
    mysqli_query($koneksi, $query);
    header('Location: anggota.php');
    exit;
} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM anggota WHERE id_anggota = $id";
    $result = mysqli_query($koneksi, $query);
    $anggota = mysqli_fetch_assoc($result);
}
?>

<?php include 'inc/header.php'; ?>
<h2>Edit Anggota</h2>
<form action="edit_anggota.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($anggota['id_anggota']); ?>">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($anggota['nama']); ?>">
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($anggota['alamat']); ?>">
    <label>Nomor Telepon</label>
    <input type="text" name="nomor_telepon" value="<?= htmlspecialchars($anggota['nomor_telepon']); ?>">
    <button type="submit">Update</button>
</form>
<?php include 'inc/footer.php'; ?>
