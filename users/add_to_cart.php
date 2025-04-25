<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $foto_produk = $_POST['foto_produk'];

    // Cek apakah semua data yang diperlukan ada
    if (empty($id_produk) || empty($nama_produk) || empty($harga_produk) || empty($foto_produk)) {
        echo json_encode(['status' => 'error', 'message' => 'Data produk tidak lengkap']);
        exit;
    }

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['keranjang'] as &$item) {
        if ($item['id_produk'] == $id_produk) {
            $item['jumlah'] += 1; // Tambah jumlah
            $found = true;
            break;
        }
    }

    // Jika belum ada, tambahkan produk baru
    if (!$found) {
        $_SESSION['keranjang'][] = [
            'id_produk' => $id_produk,
            'nama_produk' => $nama_produk,
            'harga_produk' => $harga_produk,
            'foto_produk' => $foto_produk,
            'jumlah' => 1
        ];
    }

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>