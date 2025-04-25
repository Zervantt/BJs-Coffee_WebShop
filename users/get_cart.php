<?php
session_start();

if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) {
    foreach ($_SESSION['keranjang'] as $item) {
        echo '
            <div class="cart-item">
                <img src="../assets/foto_menu/' . $item['foto_produk'] . '" alt="" />
                <div class="details">
                    <p>' . $item['nama_produk'] . '</p>
                    <p>Rp. ' . number_format($item['harga_produk'], 0, ',', '.') . '</p>
                    <p>
                        Jumlah: 
                        <input type="number" value="' . $item['jumlah'] . '" min="1" 
                            onchange="updateQuantity(\'' . $item['id_produk'] . '\', this.value)" />
                    </p>
                    <button onclick="removeItemFromCart(\'' . $item['id_produk'] . '\')">Hapus</button>
                </div>
            </div>
        ';
    }
} else {
    echo '<p>Keranjang kosong.</p>';
}
?>