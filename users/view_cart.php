<?php
    session_start();
    require "db.php";

    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        echo "Keranjang Anda kosong.";
        exit;
    }

    $cart = $_SESSION['cart'];
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $stmt = $con->prepare("SELECT * FROM menu WHERE id_menu IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($cart)), ...$cart);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo $row['nama_menu'] . " - Rp. " . number_format($row['harga'], 0, ',', '.') . "<br>";
    }
?>