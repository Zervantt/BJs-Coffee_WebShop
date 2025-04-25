<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];

    // Cari produk dan hapus dari keranjang
    $found = false;
    foreach ($_SESSION['keranjang'] as $key => $item) {
        if ($item['id_produk'] == $id_produk) {
            unset($_SESSION['keranjang'][$key]);
            $_SESSION['keranjang'] = array_values($_SESSION['keranjang']); // Reindex array
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