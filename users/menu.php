<?php
session_start();  // Pastikan session sudah dimulai
require "db.php"; // Koneksi ke database

// Memanggil Kategori
$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

// Memanggil Produk berdasarkan Kategori
if (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($con, "SELECT id_kategori FROM kategori WHERE nama_kategori='" . $_GET['kategori'] . "'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($con, "SELECT * FROM menu WHERE id_kategori='" . $kategoriId['id_kategori'] . "'");
}
// Memanggil Semua Produk jika kategori tidak dipilih
else {
    $queryProduk = mysqli_query($con, "SELECT * FROM menu");
}

// Menghitung Jumlah Produk
$countData = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>BJ's Coffee | Menu</title>

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
        
        <!-- Updated cart section with checkout button redirect -->
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
            <form action="pembayaran.php" method="POST">
                <input type="hidden" name="keranjang" value="<?php echo htmlspecialchars(json_encode($_SESSION['keranjang'])); ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <button type="submit" class="btn-buy">Checkout Now</button>
            </form>
        </div>
    </header>

    <!-- KATEGORI AND MENU -->
    <div class="container py-5">
        <h1><br></h1>
        <div class="row">
            <div class="kategori col-lg-3 mb-3">
                <h1 class="heading"><br></h1>
                <ul class="list-group">
                    <a class="no-decoration" href="menu.php"><li class="list-group-item">Semua Produk</li></a>
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)): ?>
                        <a class="no-decoration" href="menu.php?kategori=<?php echo $kategori['nama_kategori']; ?>">
                            <li class="list-group-item"><?php echo $kategori['nama_kategori']; ?></li>
                        </a>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="col-lg-9 mb-3">
                <h1 class="heading">Our <span>Menu</span></h1>
                <div class="row">
                    <?php if ($countData < 1): ?>
                        <h4 class="text-center my-5">Produk yang Anda cari tidak tersedia!</h4>
                    <?php endif; ?>
                    <?php while ($produk = mysqli_fetch_array($queryProduk)): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="../assets/foto_menu/<?php echo $produk['foto']; ?>" alt="" class="card-img-top product-img">
                                <div class="card-body">
                                    <h5 class="card-title product-title"><?php echo $produk['nama_menu']; ?></h5>
                                    <p class="card-text price">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                    <a href="javascript:void(0)" 
                                       class="btn btn-dark add-cart" 
                                       onclick="addToCart('<?php echo $produk['id_menu']; ?>', 
                                                          '<?php echo $produk['nama_menu']; ?>', 
                                                          '<?php echo $produk['harga']; ?>', 
                                                          '<?php echo $produk['foto']; ?>')">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <section class="footer">
        <div class="footer-container">
            <div class="logo">
                <img src="../assets/images/logo.png" class="img"><br />
                <i class="fas fa-envelope"></i>
                <p>bjscoffee@gmail.com</p><br />
                <i class="fas fa-phone"></i>
                <p>+62 877-7413-0116</p><br />
                <i class="fab fa-instagram"></i>
                <p>@bjscoffee_</p><br />
            </div>
            <div class="support">
                <h2>Support</h2><br />
                <a href="#">Contact Us</a>
                <a href="#">Customer Service</a>
            </div>
            <div class="company">
                <h2>Company</h2><br />
                <a href="#">About Us</a>
                <a href="#">Affiliates</a>
                <a href="#">Resources</a>
                <a href="#">Partnership</a>
                <a href="#">Suppliers</a>
            </div>
            <div class="map">
                <h2>Find Us</h2><br />
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7563767423367!2d106.5946328!3d-6.163372799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ff1897da52a5%3A0xc2a2c62bde4f74!2zQkrigJlzQ29mZmVl!5e0!3m2!1sid!2sid!4v1734591403114!5m2!1sid!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="credit">
                <hr /><br />
                <h2>BJ's Coffee © 2024 | All Rights Reserved.</h2>
                <h2>Designed by <span>Kelompok 4</span></h2>
            </div>
        </div>
    </section>

    <!-- JS File Link -->
    <script src="../assets/js/googleSignIn.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/convo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Add to Cart JavaScript -->
    <script>
        // Fungsi untuk menambah produk ke keranjang
        function addToCart(id_produk, nama_produk, harga_produk, foto_produk) {
            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: {
                    id_produk: id_produk,
                    nama_produk: nama_produk,
                    harga_produk: harga_produk,
                    foto_produk: foto_produk
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        updateCartUI();
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }

        // Fungsi untuk memperbarui tampilan keranjang
        function updateCartUI() {
            $.ajax({
                url: 'get_cart.php', // Script ini harus mengambil data keranjang
                type: 'GET',
                success: function(response) {
                    $('.cart-content').html(response);
                    updateCartTotal();
                }
            });
        }

        // Fungsi untuk memperbarui total harga keranjang
        function updateCartTotal() {
            $.ajax({
                url: 'get_cart_total.php',
                type: 'GET',
                success: function(response) {
                    $('.total-price').html(response);
                }
            });
        }

        // Fungsi untuk mengatur jumlah produk
        function updateQuantity(id_produk, quantity) {
            $.ajax({
                url: 'update_cart_quantity.php',
                type: 'POST',
                data: {
                    id_produk: id_produk,
                    quantity: quantity
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        updateCartUI(); // Update tampilan keranjang setelah jumlah diubah
                    } else {
                        alert(result.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }

        // Fungsi untuk menghapus produk dari keranjang
        function removeItemFromCart(id_produk) {
            $.ajax({
                url: 'remove_cart.php',
                type: 'POST',
                data: { id_produk: id_produk },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        updateCartUI(); // Update tampilan keranjang setelah produk dihapus
                    } else {
                        alert(result.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    </script>
</body>
</html>