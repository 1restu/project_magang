<?php
include 'db.php';
$id = $_GET['id'];

$query = "DELETE FROM pengembalian WHERE id_pengembalian = $id";
mysqli_query($koneksi, $query);
header('Location: pengembalian.php');
exit;
?>
