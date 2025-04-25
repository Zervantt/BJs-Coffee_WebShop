<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $menu = $_POST['menu'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $total = $_POST['total'];

        // Koneksi ke database
        $conn = new mysqli('localhost', 'root', '', 'nama_database');

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO transaksi (nama, total, detail) VALUES (?, ?, ?)");
        $detail = json_encode(array_combine($menu, $jumlah));
        $stmt->bind_param("sis", $nama, $total, $detail);

        if ($stmt->execute()) {
            echo "Pembayaran berhasil diproses.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>