<?php
include 'db.php';
include 'inc/header.php';

$query = "SELECT peminjaman.*, anggota.nama AS nama_anggota, buku.judul AS judul_buku 
        FROM peminjaman 
        JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota 
        JOIN buku ON peminjaman.id_buku = buku.id_buku";
$result = mysqli_query($koneksi, $query);
?>

<h2>Daftar Peminjaman</h2>
<a href="tambah_peminjaman.php" class="btn">Tambah Peminjaman</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($data['id_peminjaman']); ?></td>
                <td><?= htmlspecialchars($data['nama_anggota']); ?></td>
                <td><?= htmlspecialchars($data['judul_buku']); ?></td>
                <td><?= htmlspecialchars($data['tanggal_pinjam']); ?></td>
                <td><?= htmlspecialchars($data['tanggal_kembali']); ?></td>
                <td>
                    <a href="edit_peminjaman.php?id=<?= $data['id_peminjaman']; ?>" class="btn">Edit</a> |
                    <a href="hapus_peminjaman.php?id=<?= $data['id_peminjaman']; ?>" class="btn" onclick="return confirm('Apakah anda yakin untuk menghapus peminjaman ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include 'inc/footer.php'; ?>