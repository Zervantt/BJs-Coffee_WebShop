-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2025 pada 17.51
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bjs_coffee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `username_admin` varchar(25) DEFAULT NULL,
  `nama_admin` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Coffee'),
(2, 'Non Coffee'),
(3, 'Main Course'),
(4, 'Pasta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(3) NOT NULL,
  `id_kategori` int(3) DEFAULT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `foto` varchar(80) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `harga`, `foto`, `deskripsi`) VALUES
(1, 4, 'Aglio e Olio', 35000, 'aglio e olio.jpg', '                                                Hidangan pasta klasik dari Italia, khususnya berasal dari wilayah Napoli. Berbahan dasar bawang putih dan minyak                                        '),
(3, 1, 'Americano', 15000, 'americano.jpg', 'Minuman kopi yang terdiri dari espresso yang dicampur dengan air panas, menciptakan rasa kopi yang lebih ringan dibandingkan espresso murni, namun tetap memiliki aroma dan karakter yang khas'),
(4, 2, 'Apple Tea', 15000, 'apple tea.jpg', 'Apple tea adalah minuman hangat yang memadukan rasa segar dari apel dengan aroma teh yang khas. Terbuat dari seduhan teh berkualitas, potongan apel segar, dan sentuhan rempah seperti kayu manis untuk cita rasa yang lebih kaya'),
(5, 2, 'Avocado Juice', 22000, 'avocado juice.jpg', 'Avocado juice adalah minuman creamy yang terbuat dari alpukat segar yang dihaluskan, dicampur dengan susu atau gula untuk memberikan rasa manis yang lembut. Teksturnya yang kaya dan lembut menjadikannya pilihan sempurna untuk dinikmati sebagai minuman sehat atau pencuci mulut'),
(6, 3, 'Beef Yakiniku', 27000, 'beef yakiniku.jpg', 'Beef Yakiniku adalah hidangan khas Jepang yang terdiri dari irisan daging sapi tipis yang dimasak dengan teknik memanggang atau tumis cepat. Daging sapi dimarinasi dalam saus yakiniku yang gurih-manis, terbuat dari campuran kecap asin, bawang putih, jahe, dan gula, sehingga menghasilkan cita rasa yang kaya'),
(7, 1, 'Bjs Coffee', 22000, 'bjs coffee.jpg', 'BJs Coffee adalah minuman kopi khas yang menggabungkan rasa kopi premium dengan bahan-bahan pilihan untuk menciptakan pengalaman minum kopi yang istimewa. Terbuat dari biji kopi berkualitas yang diseduh sempurna, BJS Coffee bisa dinikmati dalam berbagai varian seperti espresso, latte, cappuccino, atau cold brew'),
(8, 4, 'Spagetti Bolognese', 23000, 'bolognese.jpg', 'Bolognese adalah saus pasta khas Italia yang kaya rasa, terbuat dari campuran daging cincang (biasanya sapi atau babi), tomat, bawang, wortel, seledri, dan rempah-rempah. Saus ini dimasak perlahan untuk menghasilkan tekstur yang lembut dan cita rasa yang mendalam'),
(9, 1, 'Cappuccino', 22000, 'cappucino.jpg', 'Cappuccino adalah minuman kopi klasik Italia yang terdiri dari espresso yang kaya dan kuat, dilapisi dengan susu panas yang dikukus, dan diakhiri dengan busa susu lembut di atasnya. Terkadang ditaburi dengan bubuk cokelat atau kayu manis untuk menambah aroma dan cita rasa'),
(10, 1, 'Caramel Macchiato', 25000, 'caramel machiato.jpg', 'Caramel Macchiato adalah minuman kopi manis yang terbuat dari espresso yang disajikan dengan susu panas yang dikukus, lalu diberi sirup karamel di atasnya. Minuman ini biasanya disajikan dengan lapisan busa susu di atasnya, memberikan tekstur lembut dan rasa yang creamy'),
(11, 4, 'Spagetti Carbonara', 23000, 'carbonara.jpg', 'Spaghetti Carbonara adalah hidangan pasta klasik Italia yang terbuat dari spaghetti yang dimasak al dente, lalu dicampur dengan saus yang terbuat dari telur, keju pecorino romano atau parmesan, daging sapi, dan lada hitam'),
(12, 3, 'Chicken Honey', 25000, 'chicken honey.jpg', 'Chicken Honey adalah hidangan ayam yang disajikan dengan saus manis dan sedikit gurih yang terbuat dari campuran madu, kecap, dan rempah-rempah. Ayam biasanya dipanggang, digoreng, atau ditumis, kemudian dilapisi dengan saus madu yang memberi rasa manis alami dan karamelisasi yang menggoda'),
(13, 3, 'Chicken Teriyaki', 25000, 'chiken teriyaki.jpg', 'Chicken Teriyaki adalah hidangan ayam khas Jepang yang dimarinasi dalam saus teriyaki, yang terbuat dari campuran kecap asin, mirin (anggur manis Jepang), gula, dan kadang-kadang jahe atau bawang putih.'),
(14, 2, 'Choco Banana', 25000, 'choco banana.jpg', 'Choco Banana adalah kombinasi manis antara cokelat dan pisang yang menciptakan rasa lezat dan menyegarkan. Hidangan ini bisa berupa pisang yang dilapisi dengan cokelat leleh dan kemudian didinginkan hingga cokelat mengeras, menciptakan camilan yang crunchy di luar dan lembut di dalam'),
(15, 2, 'Chocolate', 22000, 'chocolate.jpg', 'Minuman cokelat adalah hidangan manis yang terbuat dari cokelat cair, susu, dan kadang-kadang gula atau krim, yang dipanaskan untuk menghasilkan minuman hangat dan creamy'),
(16, 1, 'Coffee Latte', 18000, 'coffee latte.jpg', 'Coffee Latte adalah minuman kopi yang terdiri dari espresso yang disajikan dengan susu panas yang dikukus dalam proporsi yang lebih banyak, menciptakan rasa kopi yang lembut dan creamy'),
(17, 2, 'Cookies and Cream', 22000, 'cookies and cream.jpg', 'Cookies and Cream adalah hidangan penutup yang populer, biasanya berupa es krim yang terbuat dari campuran es krim vanila atau krim dengan potongan biskuit cokelat, seperti Oreo. Rasa manis dan creamy dari es krim berpadu dengan tekstur renyah dan sedikit pahit dari biskuit, menciptakan kombinasi yang lezat dan memuaskan'),
(18, 2, 'Lemon Tea', 15000, 'lemon tea.jpg', 'Lemon tea adalah minuman teh yang disajikan dengan tambahan perasan lemon segar, menciptakan perpaduan rasa segar, asam, dan sedikit pahit dari teh. Minuman ini biasanya terbuat dari teh hitam atau teh hijau yang diseduh hangat, lalu ditambahkan dengan irisan lemon atau perasan lemon untuk memberi rasa asam yang menyegarkan'),
(19, 2, 'Lychee Tea', 20000, 'lychee tea.jpg', 'Lychee tea adalah minuman teh yang dipadukan dengan rasa manis dan segar dari buah leci. Biasanya, teh hitam atau teh hijau digunakan sebagai dasar, lalu ditambahkan dengan sirup atau potongan buah leci untuk memberikan rasa tropis yang khas'),
(20, 2, 'Matcha', 22000, 'matcha.jpg', 'Matcha adalah jenis teh hijau bubuk khas Jepang yang dibuat dari daun teh yang digiling halus. Teh ini memiliki rasa yang kaya dan sedikit pahit, dengan aroma yang khas. Matcha sering digunakan dalam berbagai minuman, seperti matcha latte, atau sebagai bahan dalam kue, es krim, dan pencuci mulut lainnya'),
(21, 1, 'Mochacino', 22000, 'mochacino.jpg', '                                                Mochacino adalah minuman kopi yang menggabungkan rasa espresso, cokelat, dan susu panas, mirip dengan cappuccino namun dengan tambahan cokelat untuk rasa manis dan kaya. Biasanya, mochacino terdiri dari espresso yang dicampur dengan sirup cokelat, diikuti oleh susu panas yang dikukus dan busa susu di atasnya                                        '),
(22, 2, 'Red Velvet', 22000, 'red velvet.jpg', 'Minuman Red Velvet adalah varian minuman yang terinspirasi dari rasa dan warna khas kue red velvet. Minuman ini biasanya terbuat dari campuran susu, sirup red velvet, dan kadang-kadang krim keju untuk meniru rasa lembut dan manis dari kue red velvet'),
(23, 1, 'Spanish Latte', 20000, 'spanish latte.jpg', 'Spanish Latte adalah varian latte yang menggabungkan espresso, susu panas, dan sirup kental manis, memberikan rasa yang lebih manis dan creamy dibandingkan dengan latte biasa. Sirup kental manis yang digunakan memberi tekstur yang lembut dan rasa karamel yang khas, sementara rasa kopi tetap hadir melalui espresso'),
(24, 1, 'Sweet Palm', 20000, 'sweet palm.jpg', 'Sweet Palm adalah minuman yang terbuat dari air kelapa atau santan yang dicampur dengan gula merah, sering kali disajikan dengan potongan buah kelapa muda atau palm sugar (gula aren). Minuman ini memiliki rasa manis alami yang menyegarkan, dengan sedikit rasa gurih dari kelapa'),
(25, 2, 'Taro', 22000, 'taro.jpg', 'Minuman taro adalah minuman yang terbuat dari bubuk taro atau akar taro yang dihaluskan, yang memberikan rasa manis dan sedikit kacang-kacangan. Taro sering dipadukan dengan susu atau susu almond, dan bisa disajikan dalam bentuk milkshake, smoothie, atau bubble tea (boba)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(3) NOT NULL,
  `id_user` int(3) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bukti` varchar(80) DEFAULT NULL,
  `status` enum('Diproses','Selesai') DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(3) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `telepon` int(13) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
