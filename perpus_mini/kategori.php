<?php
include 'inc/header.php';
include 'db.php';

// Ambil data kategori dari database
$query = "SELECT * FROM kategori";
$result = mysqli_query($koneksi, $query);
?>

<h2>Daftar Kategori</h2>
<a href="tambah_kategori.php" class="btn">Tambah Kategori</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($data= mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($data['id_kategori']); ?></td>
                <td><?= htmlspecialchars($data['nama_kategori']); ?></td>
                <td>
                    <a href="edit_kategori.php?id=<?= $data['id_kategori']; ?>" class="btn">Edit</a> |
                    <a href="hapus_kategori.php?id=<?= $data['id_kategori']; ?>" class="btn" onclick="return confirm('Apakah anda yakin untuk menghapus kategori ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'inc/footer.php'; ?>
