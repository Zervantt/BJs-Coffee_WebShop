<?php
    include("auth_session.php");
    require "db.php";

    // Mengambil data produk dari database
    $queryPesanan = mysqli_query($con, "SELECT * FROM transaksi WHERE id_user=".$_SESSION['id_user']." ORDER BY tanggal_transaksi DESC");
    $jumlahTransaksi = mysqli_num_rows($queryPesanan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>BJ's Coffee | Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/convo.css">

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

    <!-- Riwayat Transaksi -->
    <!-- <div class="container py-5">
        <h1><br></h1>
        <h1>TEST</h1>
        <div class="row"> -->
    <div class="container-fluid">
        <div class="container py-5">
            <h1><br><br></h1>
            <h1 class="heading"><b>RIWAYAT TRANSAKSI ANDA</b></h1>

            <!-- Table Riwayat Pesanan -->
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama</th>
                        <th>Total Harga</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahTransaksi==0){
                        ?>
                                <tr>
                                    <td colspan=6 class="text-center">Anda Belum Memiliki Riwayat Pesanan</td>
                                </tr>
                        <?php
                            }
                            else{
                                $number = 1;
                                while($data=mysqli_fetch_array($queryPesanan)){
                        ?>
                                <tr>
                                    <td><?php echo $number ?></td>
                                    <td><?php echo $data['tgl_transaksi']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>Rp. <?php echo number_format($data['total'], 0, ',', '.'); ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td>
                                        <a href="transaksi-detail.php?id=<?php echo $data['id_transaksi']; ?>" class="btn btn-info">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                                $number++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
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
</body>
</html>