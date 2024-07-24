<?php
include 'inc/header.php';
include 'db.php';

$query = "SELECT * FROM anggota";
$result = mysqli_query($koneksi, $query)
?>

<h2>Daftar Anggota</h2>
<a href="tambah_anggota.php" class="btn">Tambah Anggota</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($data['id_anggota']); ?></td>
                <td><?= htmlspecialchars($data['nama']); ?></td>
                <td><?= htmlspecialchars($data['alamat']); ?></td>
                <td><?= htmlspecialchars($data['nomor_telepon']); ?></td>
                <td>
                    <a href="edit_anggota.php?id=<?= $data['id_anggota']; ?>" class="btn">Edit</a> |
                    <a href="hapus_anggota.php?id=<?= $data['id_anggota']; ?>" class="btn" onclick="return confirm('Apakah anda yakin untuk menghapus anggota ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'inc/footer.php'; ?>
