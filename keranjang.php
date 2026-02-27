<?php
require 'functions.php';

if (!isset($_POST['produk'])) {
    echo "Tidak ada produk yang dipilih";
    exit;
}

$produkDipilih = $_POST['produk'];
$idProduk = implode(",", array_map('intval', $produkDipilih));

$produk = query("SELECT * FROM onlineshopp WHERE no IN ($idProduk)");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Keranjang Belanja</h1>

<?php foreach ($produk as $row): ?>
    <div style="background:white; padding:15px; margin-bottom:10px; border-radius:8px">
        <img src="img/<?= $row['gambar']; ?>" width="70"><br>
        <b><?= $row['nama_produk']; ?></b><br>
        Rp <?= number_format($row['harga']); ?><br>
        Stok: <?= $row['stok']; ?>
    </div>
<?php endforeach; ?>

<br>

<br><br>
<a href="index.php">← Kembali</a>

</body>
</html>
