-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_sewa
DROP DATABASE IF EXISTS `db_sewa`;
CREATE DATABASE IF NOT EXISTS `db_sewa` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_sewa`;

-- Dumping structure for table db_sewa.akses
DROP TABLE IF EXISTS `akses`;
CREATE TABLE IF NOT EXISTS `akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_roles` int(11) DEFAULT NULL,
  `id_permission` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.akses: ~59 rows (approximately)
DELETE FROM `akses`;
/*!40000 ALTER TABLE `akses` DISABLE KEYS */;
INSERT INTO `akses` (`id`, `id_roles`, `id_permission`) VALUES
	(4, 1, 1),
	(5, 1, 2),
	(6, 1, 3),
	(7, 1, 4),
	(9, 1, 6),
	(10, 1, 7),
	(11, 1, 8),
	(12, 1, 9),
	(14, 2, 10),
	(15, 2, 11),
	(16, 1, 10),
	(18, 1, 11),
	(19, 1, 12),
	(20, 1, 13),
	(21, 1, 15),
	(22, 1, 14),
	(23, 1, 16),
	(24, 1, 17),
	(25, 1, 18),
	(26, 1, 19),
	(27, 1, 20),
	(28, 1, 21),
	(29, 1, 22),
	(30, 1, 23),
	(31, 1, 24),
	(32, 1, 25),
	(33, 1, 26),
	(34, 1, 27),
	(35, 1, 28),
	(36, 1, 29),
	(37, 2, 14),
	(38, 2, 18),
	(39, 2, 26),
	(40, 1, 32),
	(41, 1, 33),
	(42, 1, 34),
	(43, 1, 37),
	(44, 2, 39),
	(45, 1, 39),
	(46, 1, 40),
	(47, 1, 41),
	(48, 1, 42),
	(49, 1, 43),
	(50, 1, 44),
	(51, 1, 45),
	(52, 1, 46),
	(53, 1, 47),
	(54, 1, 38),
	(56, 1, 48),
	(57, 1, 49),
	(58, 1, 50),
	(59, 1, 51),
	(60, 1, 52),
	(61, 2, 48),
	(62, 2, 49),
	(63, 2, 51),
	(64, 2, 6),
	(65, 7, 44),
	(66, 7, 48);
/*!40000 ALTER TABLE `akses` ENABLE KEYS */;

-- Dumping structure for table db_sewa.artikel
DROP TABLE IF EXISTS `artikel`;
CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(300) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `penulis` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.artikel: ~1 rows (approximately)
DELETE FROM `artikel`;
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
INSERT INTO `artikel` (`id`, `id_kategori`, `judul`, `link`, `isi`, `penulis`, `tgl`, `gambar`) VALUES
	(1, 1, 'artikel pertama', 'artikel-pertama', '<p>isi artikel pertama baru</p>', 1, '2019-11-27', '1574857675.jpg');
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;

-- Dumping structure for table db_sewa.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_toko` int(11) DEFAULT NULL,
  `kode` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL,
  `sub_kategori` int(11) DEFAULT NULL,
  `tgl_post` date DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jaminan` text DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `deskripsi_status` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.barang: ~0 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `id_toko`, `kode`, `nama`, `kategori`, `sub_kategori`, `tgl_post`, `deskripsi`, `jaminan`, `status`, `deskripsi_status`) VALUES
	(1, 1, 'BRG111219-002-0001', 'revo at 2015', 11, 10, '2019-12-11', 'produk masih ok, mesin tahan lama, plus irit pula', 'KTP, Kartu Pelajar', 'Aktif', NULL),
	(2, 2, 'BRG121219-004-0001', 'traktor sawah', 11, 11, '2019-12-12', 'traktor quirk terbaru keluaran 2019, membajak sawah jadi cepat tanpa perlu tenaga banyak orang ditambah lagi hemat solar', 'ktp / sim / bpkb & dp 50%', 'Aktif', NULL);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table db_sewa.detail_barang
DROP TABLE IF EXISTS `detail_barang`;
CREATE TABLE IF NOT EXISTS `detail_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `satuan` enum('Jam','Hari','Bulan','Tahun') DEFAULT 'Jam',
  `harga` int(11) DEFAULT 0,
  `diskon` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.detail_barang: ~4 rows (approximately)
DELETE FROM `detail_barang`;
/*!40000 ALTER TABLE `detail_barang` DISABLE KEYS */;
INSERT INTO `detail_barang` (`id`, `kode_barang`, `nama`, `durasi`, `satuan`, `harga`, `diskon`) VALUES
	(2, 'BRG111219-002-0001', 'paket harian', 1, 'Hari', 25000, 0),
	(3, 'BRG111219-002-0001', 'paket bulanan', 1, 'Bulan', 250000, 20),
	(5, 'BRG121219-004-0001', 'paket harian', 1, 'Hari', 25000, 0),
	(6, 'BRG121219-004-0001', 'paket mingguan', 7, 'Hari', 300000, 10),
	(7, 'BRG121219-004-0001', 'bulanan', 1, 'Bulan', 1200000, 25);
/*!40000 ALTER TABLE `detail_barang` ENABLE KEYS */;

-- Dumping structure for table db_sewa.fotobarang
DROP TABLE IF EXISTS `fotobarang`;
CREATE TABLE IF NOT EXISTS `fotobarang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `default` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.fotobarang: ~4 rows (approximately)
DELETE FROM `fotobarang`;
/*!40000 ALTER TABLE `fotobarang` DISABLE KEYS */;
INSERT INTO `fotobarang` (`id`, `kode_barang`, `nama`, `default`) VALUES
	(1, 'BRG111219-002-0001', '1576120331.png', 'Y'),
	(2, 'BRG111219-002-0001', '1576120397.png', 'N'),
	(5, 'BRG121219-004-0001', '1576121068.jpg', 'Y'),
	(6, 'BRG121219-004-0001', '1576121069.jpg', 'N'),
	(7, 'BRG121219-004-0001', '1576121265.jpg', 'N');
/*!40000 ALTER TABLE `fotobarang` ENABLE KEYS */;

-- Dumping structure for table db_sewa.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(70) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.kategori: ~2 rows (approximately)
DELETE FROM `kategori`;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `nama`, `status`, `gambar`) VALUES
	(9, 'elektronik', 'Aktif', '1573777132.jpg'),
	(11, 'transportasi', 'Aktif', '1576040771.jpg');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- Dumping structure for table db_sewa.kategori_artikel
DROP TABLE IF EXISTS `kategori_artikel`;
CREATE TABLE IF NOT EXISTS `kategori_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.kategori_artikel: ~2 rows (approximately)
DELETE FROM `kategori_artikel`;
/*!40000 ALTER TABLE `kategori_artikel` DISABLE KEYS */;
INSERT INTO `kategori_artikel` (`id`, `nama`, `status`) VALUES
	(1, 'berita', 'Aktif'),
	(2, 'kabara baru ljjklj', 'Aktif');
/*!40000 ALTER TABLE `kategori_artikel` ENABLE KEYS */;

-- Dumping structure for table db_sewa.kota
DROP TABLE IF EXISTS `kota`;
CREATE TABLE IF NOT EXISTS `kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `nama` varchar(60) DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.kota: ~2 rows (approximately)
DELETE FROM `kota`;
/*!40000 ALTER TABLE `kota` DISABLE KEYS */;
INSERT INTO `kota` (`id`, `id_provinsi`, `nama`, `aktif`) VALUES
	(1, 1, 'Kediri', 'Y'),
	(3, 3, 'nganjuk', 'Y');
/*!40000 ALTER TABLE `kota` ENABLE KEYS */;

-- Dumping structure for table db_sewa.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sewa.migrations: ~2 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_11_12_083520_create_admins_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_sewa.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sewa.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table db_sewa.pengguna
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `gender` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci DEFAULT 'Pria',
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_ktp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci DEFAULT 'Aktif',
  `verivikasi` enum('ya','belum') COLLATE utf8mb4_unicode_ci DEFAULT 'belum',
  `premium` enum('ya','belum') COLLATE utf8mb4_unicode_ci DEFAULT 'belum',
  `keterangan_status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sewa.pengguna: ~2 rows (approximately)
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id`, `name`, `username`, `email`, `alamat`, `telp`, `tgl_lahir`, `gender`, `foto`, `foto_ktp`, `password`, `status`, `verivikasi`, `premium`, `keterangan_status`) VALUES
	(1, 'jian fitri', 'jianfitri', 'jian@gmail.com', NULL, NULL, NULL, 'Pria', NULL, NULL, '$2y$10$1TLm5JEhlziKhcs7joU9CeOFAhhLddI0PAD3eXT39znnRo8SBc7OC', 'Aktif', 'belum', 'belum', NULL),
	(2, 'satrio damara', 'satrio', 'sa@gmail.com', 'gurah kediri', '092384982', '1998-09-21', 'Pria', '2160322761576039125.jpg', '18166187171576039126.jpg', '$2y$10$u5obyLaU51yyN2g/ZJaB1OtpCQQwQypds5H1V.Rhf5N.FbFbYi3T.', 'Aktif', 'belum', 'belum', NULL),
	(3, 'hari', 'hariono', 'hari@gmail.com', NULL, NULL, NULL, 'Pria', NULL, NULL, '$2y$10$9pbbMaJfiz.c9aqvzV0ELOUKm3kKQnJd.GK164xeMixdnKuIXxH4y', 'Aktif', 'belum', 'belum', NULL),
	(4, 'heru adi sasmito', 'heruadi', 'heru@gmail.com', 'bringin gurah', '1404545', '2007-12-21', 'Pria', '21398993911576120807.jpg', '2360002721576120807.jpg', '$2y$10$F1Zazqbqnoa7hZWMZLLiMORUFFDxhrzY.570UMB8hEVVuOam9k0qi', 'Aktif', 'belum', 'belum', NULL),
	(5, 'bela aulia', 'belabela', 'bela@gmail.com', NULL, NULL, NULL, 'Pria', NULL, NULL, '$2y$10$KjNyh.VHqNNVoUXkZGZ4POCWlhwjCEX6kryAyx26VVqQfNmIAEudW', 'Aktif', 'belum', 'belum', NULL);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

-- Dumping structure for table db_sewa.permission
DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(50) DEFAULT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.permission: ~44 rows (approximately)
DELETE FROM `permission`;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` (`id`, `modul`, `aksi`) VALUES
	(1, 'Artikel', 'Tambah Data'),
	(2, 'Artikel', 'View Data'),
	(3, 'Artikel', 'Edit Data'),
	(4, 'Artikel', 'Hapus Data'),
	(6, 'Kategori Artikel', 'View Data'),
	(7, 'Kategori Artikel', 'Tambah Data'),
	(8, 'Kategori Artikel', 'Edit Data'),
	(9, 'Kategori Artikel', 'Hapus Data'),
	(10, 'Kategori', 'View Data'),
	(11, 'Kategori', 'Tambah Data'),
	(12, 'Kategori', 'Edit Data'),
	(13, 'Kategori', 'Hapus Data'),
	(14, 'Sub Kategori', 'View Data'),
	(15, 'Sub Kategori', 'Tambah Data'),
	(16, 'Sub Kategori', 'Edit Data'),
	(17, 'Sub Kategori', 'Hapus Data'),
	(18, 'Provinsi', 'View Data'),
	(19, 'Provinsi', 'Tambah Data'),
	(20, 'Provinsi', 'Edit Data'),
	(21, 'Provinsi', 'Hapus Data'),
	(22, 'Kota', 'View Data'),
	(23, 'Kota', 'Tambah Data'),
	(24, 'Kota', 'Edit Data'),
	(25, 'Kota', 'Hapus Data'),
	(26, 'Toko', 'View Data'),
	(27, 'Toko', 'Tambah Data'),
	(28, 'Toko', 'Edit Data'),
	(29, 'Toko', 'Hapus Data'),
	(32, 'Slider', 'View Data'),
	(33, 'Slider', 'Tambah Data'),
	(34, 'Slider', 'Edit Data'),
	(37, 'Slider', 'Hapus Data'),
	(38, 'Setting', 'Edit Data'),
	(39, 'Barang', 'View Data'),
	(40, 'Barang', 'Tambah Data'),
	(41, 'Barang', 'Edit Data'),
	(42, 'Barang', 'Hapus Data'),
	(43, 'Barang', 'Update Status'),
	(44, 'Admin', 'View Data'),
	(45, 'Admin', 'Tambah Data'),
	(46, 'Admin', 'Edit Data'),
	(47, 'Admin', 'Hapus Data'),
	(48, 'Pengguna', 'View Data'),
	(49, 'Pengguna', 'Tambah Data'),
	(50, 'Pengguna', 'Edit Data'),
	(51, 'Pengguna', 'Hapus Data'),
	(52, 'Pengguna', 'Update Status');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- Dumping structure for table db_sewa.provinsi
DROP TABLE IF EXISTS `provinsi`;
CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.provinsi: ~1 rows (approximately)
DELETE FROM `provinsi`;
/*!40000 ALTER TABLE `provinsi` DISABLE KEYS */;
INSERT INTO `provinsi` (`id`, `nama`, `aktif`) VALUES
	(1, 'jawa timur', 'Y'),
	(3, 'jawa barat', 'Y');
/*!40000 ALTER TABLE `provinsi` ENABLE KEYS */;

-- Dumping structure for table db_sewa.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.roles: ~3 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `nama`) VALUES
	(1, 'Programmer'),
	(2, 'Super Admin'),
	(7, 'admin');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table db_sewa.setting
DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `singkatan` varchar(100) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.setting: ~0 rows (approximately)
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `nama`, `singkatan`, `logo`, `icon`, `deskripsi`) VALUES
	(1, 'SewainAja', 'SA', '11589253081574049787.png', '9813304121574050075.png', '<p>deskripsi sewain apps</p>');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table db_sewa.slider
DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text DEFAULT NULL,
  `header` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.slider: ~0 rows (approximately)
DELETE FROM `slider`;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` (`id`, `nama`, `header`, `deskripsi`, `status`) VALUES
	(2, '1575339589.jpg', 'Aplikasi Persewaan No.1', 'sekaresidenan kediri dan sekitarnya, sewakan barang-barang mu and make some money', 'Aktif');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;

-- Dumping structure for table db_sewa.subkategori
DROP TABLE IF EXISTS `subkategori`;
CREATE TABLE IF NOT EXISTS `subkategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `nama` varchar(80) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `FK_subkategori_kategori` (`id_kategori`),
  CONSTRAINT `FK_subkategori_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.subkategori: ~5 rows (approximately)
DELETE FROM `subkategori`;
/*!40000 ALTER TABLE `subkategori` DISABLE KEYS */;
INSERT INTO `subkategori` (`id`, `id_kategori`, `nama`, `status`) VALUES
	(4, 9, 'handphone', 'Tidak Aktif'),
	(5, 9, 'HT', 'Aktif'),
	(6, 9, 'camera', 'Aktif'),
	(10, 11, 'motor', 'Aktif'),
	(11, 11, 'mobil', 'Aktif');
/*!40000 ALTER TABLE `subkategori` ENABLE KEYS */;

-- Dumping structure for table db_sewa.toko
DROP TABLE IF EXISTS `toko`;
CREATE TABLE IF NOT EXISTS `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `verivikasi_status` enum('Ya','Tidak') DEFAULT 'Tidak',
  `deskripsi_status` text DEFAULT NULL,
  `hari_buka` varchar(150) DEFAULT NULL,
  `jam_buka` varchar(20) DEFAULT NULL,
  `jam_tutup` varchar(20) DEFAULT NULL,
  `provinsi` varchar(60) DEFAULT NULL,
  `kota` varchar(60) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.toko: ~2 rows (approximately)
DELETE FROM `toko`;
/*!40000 ALTER TABLE `toko` DISABLE KEYS */;
INSERT INTO `toko` (`id`, `id_pengguna`, `nama`, `link`, `deskripsi`, `alamat`, `telp`, `status`, `verivikasi_status`, `deskripsi_status`, `hari_buka`, `jam_buka`, `jam_tutup`, `provinsi`, `kota`, `logo`) VALUES
	(1, 2, 'sumber urep', 'sumber-urep', 'klasdjfklasd', 'asdfsdf', '29034892389', 'Aktif', 'Ya', NULL, 'senin,selasa,rabu,kamis,jumat,', '08:00', '21:00', '3', '3', '1576040209.png'),
	(2, 4, 'tani maju jaya', 'tani-maju-jaya', 'berjuang di bidang peesewaan alat alat pertanian modern', 'gurah kediri magersari', '085235559491', 'Aktif', 'Tidak', NULL, 'senin,selasa,rabu,kamis,jumat,sabtu,', '07:30', '23:30', '1', '1', '1576120916.jpg');
/*!40000 ALTER TABLE `toko` ENABLE KEYS */;

-- Dumping structure for table db_sewa.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sewa.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `alamat`, `telp`, `level`, `email`, `foto`, `password`, `remember_token`) VALUES
	(1, 'deva satrio damara', 'deva', 'asdf', '9273894', 1, 'satriosuklun@gmail.com', '1573878422.jpg', '$2y$10$3WctH0m2YvIAG/iq48coke8Fdc7q8bZNwQLjP4W4JOAF3I2ScSVj2', NULL),
	(5, 'jian fitri aprilia', 'jianfitri', 'gurah, kediri magersari', '209348920', 2, 'satriosuklun1@gmail.com', '1574947664.png', '$2y$10$lFKc6dPH97anoZYGUZTReOIVmgNeF3yvlsDZRlyM7Uk3YwpwOKZzy', NULL),
	(6, 'satrio damara', 'satriodamara', 'gurah', '2039489', 7, 'satriosuklun1@gmail.com', '1573878759.jpg', '$2y$10$DrrFwZJM27ydob2CkDdKeeJGhKn8f3ngyJq13BDTM91DnrDlja0DK', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
