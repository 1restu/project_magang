<?php
include 'db.php';
$id = $_GET['id'];

$query = "DELETE FROM kategori WHERE id_kategori = $id";
mysqli_query($koneksi, $query);
header('Location: kategori.php');
exit;
?>
