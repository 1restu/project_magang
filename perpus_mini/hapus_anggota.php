<?php
include 'db.php';
$id = $_GET['id'];

$query = "DELETE FROM anggota WHERE id_anggota = $id";
mysqli_query($koneksi, $query);
header('Location: anggota.php');
exit;
?>
