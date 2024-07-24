<?php
include 'db.php';
$query = "SELECT buku.id_buku, buku.judul, buku.penulis, buku.tahun_terbit, buku.status, kategori.nama_kategori
        FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori";
$result = mysqli_query($koneksi, $query);
?>

<?php include 'inc/header.php'; ?>
    <h2>Daftar Buku</h2>
<a href="tambah_buku.php" class="btn">Tambah Buku?</a>
<table>
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tahun Terbit</th>
        <th>Kategori</th> 
        <th>Status</th>
        <th>Aksi</th>
    
    </tr>
    <?php while ($buku = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($buku['id_buku']); ?></td>
            <td><?= htmlspecialchars($buku['judul']) ?></td>
            <td><?= htmlspecialchars($buku['penulis']); ?></td>
            <td><?= htmlspecialchars($buku['tahun_terbit']); ?></td>
            <td><?= htmlspecialchars($buku['nama_kategori']);?></td>
            <td><?= htmlspecialchars($buku['status']);?></td>
            <td>
                <a href="edit_buku.php?id=<?= htmlspecialchars($buku['id_buku']); ?>" class="btn hidden-link" >Edit</a> |
                <a href="hapus_buku.php?id=<?= htmlspecialchars($buku['id_buku']); ?>" class="btn hidden-link" onclick="return confirm('Apakah anda yakin untuk menghapus Buku ini? 🥹')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include 'inc/footer.php'; ?>