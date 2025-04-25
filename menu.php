<?php
    require "users/db.php";

    // Memanggil Kategori
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    // Memanggil Produk by Kategori
    if (isset($_GET['kategori'])) {
        $queryGetKategoriId = mysqli_query($con, "SELECT id_kategori FROM kategori WHERE nama_kategori='" . $_GET['kategori'] . "'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);

        $queryProduk = mysqli_query($con, "SELECT * FROM menu WHERE id_kategori='" . $kategoriId['id_kategori'] . "'");
    }

    // Memanggil Produk Default
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/convo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><!-- font awesome cdn link -->
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png"><!-- Favicon / Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->
</head>
<body>
    <!-- HEADER SECTION -->
    <header class="header">
        <a href="index.php" class="logo">
            <img src="assets/images/logo.png" class="img-logo" alt="">
        </a>

        <!-- MAIN MENU FOR SMALLER DEVICES -->
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
                        <a href="index.php#gallery"class="text-decoration-none">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="users/login.php" class="text-decoration-none">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="icons">
            <div class="fas fa-shopping-cart" id="cart-btn" onclick="redirectCart()"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <!-- CART SECTION -->
        <div class="cart">
            <h2 class="cart-title">Your Cart:</h2>
            <div class="cart-content">
                
            </div>
            <div class="total">
                <div class="total-title">Total: </div>
                <div class="total-price">Rp. 0</div>
            </div>
            <!-- BUY BUTTON -->
            <button type="button" class="btn-buy">Checkout Now</button>
        </div>
    </header>
    <h1><br></h1>
    <h1><br></h1>
    
    <!-- KATEGORI AND MENU -->
    <div class="container py-5">
        <h1><br></h1>
        <div class="row">
            <div class="kategori col-lg-3 mb-3">
                <h1 class="heading"><br></h1>
                <ul class="list-group">
                    <a class="no-decoration" href="menu.php">
                        <li class="list-group-item">Semua Produk</li>
                    </a>
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <a class="no-decoration" href="menu.php?kategori=<?php echo $kategori['nama_kategori']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama_kategori']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-lg-9 mb-3">
                <h1 class="heading">Our <span>Menu</span></h1>
                <div class="row">
                    <?php if ($countData < 1) { ?>
                        <h4 class="text-center my-5">Produk yang Anda cari tidak tersedia!</h4>
                    <?php } ?>

                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <!-- Corrected: use $produk['foto'] to access the image -->
                            <img src="assets/foto_menu/<?php echo $produk['foto']; ?>" alt="" class="card-img-top product-img">
                            <div class="card-body">
                                <!-- Corrected: use $produk['nama_menu'] and $produk['harga'] to access the data -->
                                <h5 class="card-title product-title"><?php echo $produk['nama_menu']; ?></h5>
                                <p class="card-text price">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="javascript:void(0)" class="btn btn-dark add-cart" onclick="redirectCart()">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <section class="footer">
        <div class="footer-container">
            <div class="logo">
                <img src="assets/images/logo.png" class="img"><br />
                <i class="fas fa-envelope"></i>
                <p>bjscoffee@gmail.com</p><br />
                <i class="fas fa-phone"></i>
                <p>+62 877-7413-0116</p><br />
                <i class="fab fa-instagram"></i>
                <p>@bjscoffee_</p><br />
            </div>
            <div class="support">
                <h2>Support</h2>
                <br />
                <a href="mailto:bjscoffee@gmail.com?subject=Halo&body=Halo">Contact Us</a>
                <a href="https://wa.me/6287774130116?text=Halo">Customer Service</a>
            </div>
            <div class="company">
                <h2>Company</h2>
                <br />
                <a href="#">About Us</a>
                <a href="#">Affiliates</a>
                <a href="#">Resources</a>
                <a href="#">Partnership</a>
                <a href="#">Suppliers</a>
            </div>
            <div class="map">
                <h2>Find Us</h2>
                <br />
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7563767423367!2d106.5946328!3d-6.163372799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ff1897da52a5%3A0xc2a2c62bde4f74!2zQkrigJlzQ29mZmVl!5e0!3m2!1sid!2sid!4v1734591403114!5m2!1sid!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="credit">
                <hr /><br />
                <h2>BJ's Coffee © 2024 | All Rights Reserved.</h2>
                <h2>Designed by <span>Kelompok 4</span></h2>
            </div>
        </div>
    </section>

    <script>
        // CODE FOR THE FORMSPREE
        window.onbeforeunload = () => {
            for(const form of document.getElementsByTagName('form')) {
                form.reset();
            }
        }

        // CODE FOR THE REDIRECT CART
        function redirectCart() {
            // Check if the user is logged in
            if(!"<?php echo isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : '' ?>") {
                // Redirect the user to the login page
                alert("You are not logged in. Please log into your account and try again.");
                window.location.href = "users/login.php";
            }
        }
    </script>
</body>
</html>