<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'functions.php';

if (isset($_GET['hapus'])) {
    $no = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM onlineshopp WHERE no = $no");
    header("Location: index.php");
    exit;
}

$produk = query("SELECT * FROM onlineshopp");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="hero">
    <div class="hero-text">
        <h1>ONLINE SHOP</h1>
        <p>Kualitas terbaik untuk kamu setiap hari</p>
        <a href="#produk">
            <button>Shop Now</button>
        </a>
    </div>
</div>

<div class="container" id="produk">
    <h2>Produk Kami</h2>

    <!-- TOMBOL TAMBAH PRODUK -->
    <div style="margin-bottom:20px;">
        <a href="tambah.php"
           style="background:#198754; color:white; padding:10px 18px;
                  text-decoration:none; border-radius:8px;">
           + Tambah Produk
        </a>
    </div>

    <form action="keranjang.php" method="post">
        <div class="produk-grid">

        <?php foreach ($produk as $row): ?>
            <div class="card">
                <img src="img/<?= $row['gambar']; ?>">

                <h3><?= $row['nama_produk']; ?></h3>
                <p class="harga">Rp <?= number_format($row['harga']); ?></p>
                <p>Stok: <?= $row['stok']; ?></p>

                <input type="number"
                       name="jumlah[<?= $row['no']; ?>]"
                       value="1"
                       min="1"
                       max="<?= $row['stok']; ?>">

                <div class="card-bottom">
                    <label>
                        <input type="checkbox"
                               name="produk[]"
                               value="<?= $row['no']; ?>">
                        Pilih
                    </label>
                </div>

                <div class="card-aksi">
                    <a href="ubah.php?no=<?= $row['no']; ?>"
                       class="btn-ubah">Ubah</a>

                    <a href="index.php?hapus=<?= $row['no']; ?>"
                       onclick="return confirm('Yakin hapus produk ini?')"
                       class="btn-hapus">
                       Hapus
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

        </div>

        <div class="checkout">
            <button type="submit">Masukkan ke Keranjang</button>
        </div>
    </form>
</div>

</body>
</html>