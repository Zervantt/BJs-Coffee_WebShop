<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $quantity = $_POST['quantity'];

    // Validasi jumlah
    if ($quantity < 1) {
        echo json_encode(['status' => 'error', 'message' => 'Jumlah tidak valid']);
        exit;
    }

    // Cari dan perbarui jumlah produk
    $found = false;
    foreach ($_SESSION['keranjang'] as &$item) {
        if ($item['id_produk'] == $id_produk) {
            $item['jumlah'] = $quantity;
            $found = true;
            break;
        }
    }

    if ($found) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>