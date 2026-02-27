<?php
require 'functions.php';

if (isset($_POST["submit"])) {

    $nama_produk = htmlspecialchars($_POST["nama_produk"]);
    $harga = intval($_POST["harga"]);
    $stok = intval($_POST["stok"]);

    $gambar = $_FILES["gambar"]["name"];
    $tmp = $_FILES["gambar"]["tmp_name"];

    move_uploaded_file($tmp, "img/" . $gambar);

    mysqli_query($conn, "INSERT INTO onlineshopp 
        (nama_produk, harga, stok, gambar)
        VALUES
        ('$nama_produk', $harga, $stok, '$gambar')");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <div class="form-card">
        <h1>Tambah Produk</h1>

        <form method="post" enctype="multipart/form-data">

            <label>Nama Produk</label>
            <input type="text" name="nama_produk" required>

            <label>Harga</label>
            <input type="number" name="harga" required>

            <label>Stok</label>
            <input type="number" name="stok" required>

            <label>Gambar Produk</label>
            <input type="file" name="gambar" required>

            <!-- BUTTON SUDAH DIBENERIN -->
            <button type="submit" name="submit" class="btn-tambah">
                Tambah Produk
            </button>
        </form>

        <a href="index.php" class="back-btn">
            ← Kembali
        </a>
    </div>
</div>

</body>
</html>