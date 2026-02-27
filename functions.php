<?php

// file berfungsi sebagai koneksi ke database mysql dan menyediakan fungsi query biasanya disebut config atau helper file
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "onlineshopp");

// untuk mengecek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


// Fungsi query untuk menjalankan select, Agar tidak menulis mys berulang x
function query($query) {
    global $conn; // untuk mengambil koneksi dari luar fungsi

    $result = mysqli_query($conn, $query);

    // menampilkan eror
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    // Mengubah hasil query menjadi array
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows; // untuk mengembalikan data
}
