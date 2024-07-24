<?php
include 'db.php';
$id = $_GET['id'];

$query = "DELETE FROM peminjaman WHERE id_peminjaman = $id";
mysqli_query($koneksi, $query);
header('Location: peminjaman.php');
exit;
?>
