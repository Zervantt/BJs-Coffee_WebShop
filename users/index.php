<?php
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
    require "db.php";

    // Memanggil Isi Produk
    $queryProduk = mysqli_query($con, "SELECT id_menu, nama_menu, harga, foto, deskripsi FROM menu LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>BJ's Coffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/convo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><!-- font awesome cdn link -->
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png"><!-- Favicon / Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->
</head>
<body>
    <!-- HEADER SECTION -->
    <header class="header">
        <a href="index.php" class="logo">
            <img src="../assets/images/logo.png" class="img-logo" alt="">
        </a>

        <!-- MAIN MENU FOR SMALLER DEVICES -->
        <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="index.php" class="text-decoration-none">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="text-decoration-none">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#menu" class="text-decoration-none">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#gallery"class="text-decoration-none">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="transaksi.php"class="text-decoration-none">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="text-decoration-none">Logout</a>
                    </li>
                </ul>
            </div>
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

    <!-- HERO SECTION -->
    <section class="home" id="home">
        <div class="content">
            <h3>Welcome to BJ's Coffee, <?php echo htmlspecialchars($_SESSION['nama_user']); ?>!</h3>
            <p>
                <strong>We are open 4:00 PM to 11:00 PM.</strong>
            </p>
            <a href="#menu" class="btn btn-dark text-decoration-none">Order Now!</a>
        </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section class="about" id="about">
        <h1 class="heading"> <span>About</span> Us</h1>
        <div class="row g-0">
            <div class="image">
                <img src="../assets/images/about-img.png" alt="" class="img-fluid">
            </div>
            <div class="content">
                <h3>Welcome to BJ's Coffee!</h3>
                <p>
                    Di BJ's Coffee, kami percaya bahwa setiap cangkir kopi punya cerita yang bisa dibagikan.
                    Kedai kecil kami di tengah kota adalah tempat di mana aroma kopi hangat bertemu dengan senyuman ramah.
                    Kecintaan kami pada kopi bukan sekadar rasa, tapi juga tentang perjalanan menemukan kehangatan dan kebahagiaan dalam setiap tegukan.
                    Mari berbagi cerita bersama kami.
                </p>
                <p>
                    Kopi bukan sekadar minuman, tapi sebuah pengalaman. Di BJ's Coffee,
                    kami menciptakan suasana hangat dan penuh keakraban, tempat di mana para pecinta kopi bisa bersantai,
                    berbagi cerita, dan memulai perjalanan rasa mereka sendiri. Kami ingin setiap kunjungan menjadi momen yang berarti untuk Anda.
                </p>
                <a href="#" class="btn btn-dark text-decoration-none">Learn More</a>
            </div>
        </div>
    </section>

    <!-- MENU SECTION -->
    <section class="menu" id="menu">
        <h1 class="heading">Our <span>Menu</span></h1>
        <div class="box-container">
            <div class="container">
                <div class="row mb-3">
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
                <center>
                    <button id="showHideBtn" class="btn btn-dark">SHOW MORE</button>
                </center>
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section class="gallery" id="gallery">
        <h1 class="heading">The <span>Gallery</span></h1>
        <div class="box-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../assets/images/gallery1.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <h3 class="gallery-title">Picture 1</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../assets/images/gallery2.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <h3 class="gallery-title">Picture 2</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../assets/images/gallery3.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <h3 class="gallery-title">Picture 3</h3>
                            </div>
                        </div>
                    </div>
                </div><br />
                <div class="row pic-to-hide">
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../assets/images/gallery4.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <h3 class="gallery-title">Picture 4</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../assets/images/gallery5.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <h3 class="gallery-title">Picture 5</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../assets/images/gallery6.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <h3 class="gallery-title">Picture 6</h3>
                            </div>
                        </div>
                    </div>
                </div><br />
                <center>
                    <button id="showBtn" class="btn btn-dark">SHOW MORE</button>
                </center> 
            </div> 
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="review" id="review">
        <h1 class="heading"><span>Testimo</span>nials</h1>
        <div class="box-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../assets/images/quote-img.png" alt="" class="quote">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <img src="../assets/images/pic-1.png" alt="" class="user">
                            <h3>Jane Doe</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../assets/images/quote-img.png" alt="" class="quote">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <img src="../assets/images/pic-2.png" alt="" class="user">
                            <h3>John Doe</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../assets/images/quote-img.png" alt="" class="quote">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <img src="../assets/images/pic-3.png" alt="" class="user">
                            <h3>Jane Doe</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </section>

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

    <!-- JS File Link -->
    <script src="../assets/js/script.js"></script>
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

    <script>
        // CODE FOR THE FORMSPREE
        window.onbeforeunload = () => {
            for(const form of document.getElementsByTagName('form')) {
                form.reset();
            }
        }

        // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN MENU
        $(document).ready(function() {
            // Set the initial text of the "Show More" button
            $("#showHideBtn").text("SHOW MORE");

            // When the "Show More" button is clicked
            $("#showHideBtn").click(function() {
                // Redirect to menu.php with a query parameter indicating to show more items
                window.location.href = "menu.php";
            });
        });

        // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN GALLERY
        $(document).ready(function() {
            $(".pic-to-hide").hide();
            $("#showBtn").text("SHOW MORE");
            $("#showBtn").click(function() {
                $(".pic-to-hide").toggle();
                if ($(".pic-to-hide").is(":visible")) {
                    $(this).text("SHOW LESS");
                } else {
                    $(this).text("SHOW MORE");
                }
            });
        });
    </script> 
</body>
</html>