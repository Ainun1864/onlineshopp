<?php
require 'functions.php';

if (!isset($_GET['no'])) {
    echo "Produk tidak ditemukan";
    exit;
}

$no = intval($_GET['no']);
$produk = query("SELECT * FROM onlineshopp WHERE no = $no")[0];

if (isset($_POST['submit'])) {

    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $gambarLama = $_POST['gambarLama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "img/" . $gambar);
    }

    mysqli_query($conn, "
        UPDATE onlineshopp SET
        nama_produk = '$nama_produk',
        harga = $harga,
        stok = $stok,
        gambar = '$gambar'
        WHERE no = $no
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <div class="form-card">
        <h1>Ubah Produk</h1>

        <form method="post" enctype="multipart/form-data">

            <input type="hidden"
                   name="gambarLama"
                   value="<?= $produk['gambar']; ?>">

            <label>Nama Produk</label>
            <input type="text"
                   name="nama_produk"
                   value="<?= $produk['nama_produk']; ?>"
                   required>

            <label>Harga</label>
            <input type="number"
                   name="harga"
                   value="<?= $produk['harga']; ?>"
                   required>

            <label>Stok</label>
            <input type="number"
                   name="stok"
                   value="<?= $produk['stok']; ?>"
                   required>

            <label>Gambar Saat Ini</label>
            <img src="img/<?= $produk['gambar']; ?>"
                 width="120"
                 style="margin-bottom:10px; border-radius:8px;">

            <label>Ganti Gambar</label>
            <input type="file" name="gambar">

            <button type="submit" name="submit">
                Simpan Perubahan
            </button>
        </form>

        <a href="index.php" class="back-btn">
            ← Kembali
        </a>
    </div>
</div>

</body>
</html>