<?php
include 'db.php';
$id = $_GET['id'];

$query = "DELETE FROM buku WHERE id_buku = $id";
mysqli_query($koneksi, $query);
echo "<script>
        alert('Buku berhasil di hapus!');
        location.href = 'buku.php';
      </script>";
exit;
?>