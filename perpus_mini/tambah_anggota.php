<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);


    //cek apakah ada nama yang sama di dalam database
    $cek_nama = "SELECT * FROM anggota WHERE nama='$nama'";
    $cek_nama_rlt = mysqli_query($koneksi, $cek_nama);

    if (empty($nama) || empty($alamat) || empty($nomor_telepon)) {
        echo "
            <script>
                alert('Ada data yang masih kosong!');
                history.back();
            </script>
        ";
    } elseif (mysqli_num_rows($cek_nama_rlt) > 0) {
        echo "
            <script>
                alert('Nama anggota ini sudah terdaftar. Silahkan gunakan nama yang berbeda.');
                history.back();
            </script>
        ";
    } else{
    $query = "INSERT INTO anggota (nama, alamat, nomor_telepon) VALUES ('$nama', '$alamat', '$nomor_telepon')";
    if (mysqli_query($koneksi, $query)) {
        echo "
            <script>
                alert('Anggota baru berhasil ditambahkan!');
                location.href = 'anggota.php';
            </script>
        ";
        }
    }
}
?>

<?php include 'inc/header.php'; ?>
<h2>Tambah Anggota</h2>
<form id="tambahAnggotaForm" action="tambah_anggota.php" method="POST" onsubmit="return validateForm()">
    <label>Nama</label>
    <input type="text" name="nama">
    <label>Alamat</label>
    <input type="text" name="alamat">
    <label>Nomor Telepon</label>
    <input type="text" name="nomor_telepon">
    <button type="submit">Tambah</button>
</form>
<script>
    function validateForm() {
    var nama = document.forms["tambahAnggotaForm"]["nama"].value;
    var alamat = document.forms["tambahAnggotaForm"]["alamat"].value;
    var no_tlp = document.forms["tambahAnggotaForm"]["nomor_telepon"].value;

    if (nama == "" || alamat == "" || np_tlp == "") {
        alert("Ada data yang kosong nich, silahkan isi kembali!");
        return false;
    }
    return true;
}
</script>
<?php include 'inc/footer.php'; ?>
