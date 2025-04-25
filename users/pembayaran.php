<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $keranjang = json_decode($_POST['keranjang'], true);
        $total = $_POST['total'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>BJ's Coffee | Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/convo.css">

    <!-- Tambahkan script berikut untuk auto-refresh setelah add-to-cart -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- HEADER SECTION -->
    <header class="header">
        <a href="index.php" class="logo">
            <img src="../assets/images/logo.png" class="img-logo" alt="">
        </a>
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="index.php" class="text-decoration-none">Home</a>
                </li>
                <li class="nav-item">
                    <a href="index.php#about" class="text-decoration-none">About</a>
                </li>
                <li class="nav-item">
                    <a href="menu.php" class="text-decoration-none">Menu</a>
                </li>
                <li class="nav-item">
                    <a href="index.php#gallery" class="text-decoration-none">Gallery</a>
                </li>
                <li class="nav-item">
                    <a href="transaksi.php"class="text-decoration-none">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="text-decoration-none">Logout</a>
                </li>
            </ul>
        </nav>
        <div class="icons">
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>
        <!-- CART SECTION -->
        <div class="cart">
            <h2 class="cart-title">Your Cart:</h2>
            <div class="cart-content">
                <?php if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0): ?>
                    <?php foreach ($_SESSION['keranjang'] as $item): ?>
                        <div class="cart-item">
                            <img src="../assets/foto_menu/<?php echo $item['foto_produk']; ?>" alt="" />
                            <div class="details">
                                <p><?php echo $item['nama_produk']; ?></p>
                                <p>Rp. <?php echo number_format($item['harga_produk'], 0, ',', '.'); ?></p>
                                <p>Jumlah: <?php echo $item['jumlah']; ?></p>
                                <button onclick="removeItemFromCart('<?php echo $item['id_produk']; ?>')">Hapus</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Keranjang kosong.</p>
                <?php endif; ?>
            </div>
            <div class="total">
                <div class="total-title">Total: </div>
                <div class="total-price">
                    <?php
                    $total = 0;
                    if (isset($_SESSION['keranjang'])) {
                        foreach ($_SESSION['keranjang'] as $item) {
                            $total += $item['harga_produk'] * $item['jumlah'];
                        }
                    }
                    echo "Rp. " . number_format($total, 0, ',', '.');
                    ?>
                </div>
            </div>
            <button type="button" class="btn-buy">Checkout Now</button>
        </div>
    </header>

    <div>
        <h1 class="heading"><br></h1>
        <h1 class="heading">Form <span>Pembayaran</span></h1>
    </div>
    
    <form action="proses_pembayaran.php" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <h3>Detail Pesanan:</h3>
        <ul>
            <?php foreach ($keranjang as $item): ?>
                <li>
                    <?php echo $item['nama_produk']; ?> (<?php echo $item['jumlah']; ?>) - Rp. <?php echo number_format($item['harga_produk'], 0, ',', '.'); ?>
                </li>
                <input type="hidden" name="menu[]" value="<?php echo $item['nama_produk']; ?>">
                <input type="hidden" name="jumlah[]" value="<?php echo $item['jumlah']; ?>">
                <input type="hidden" name="harga[]" value="<?php echo $item['harga_produk']; ?>">
            <?php endforeach; ?>
        </ul>

        <p>Total Pembayaran: Rp. <?php echo number_format($total, 0, ',', '.'); ?></p>
        <input type="hidden" name="total" value="<?php echo $total; ?>">

        <button type="submit">Proses Pembayaran</button>
    </form>
</body>
</html>