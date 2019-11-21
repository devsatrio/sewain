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
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `deskripsi_status` text DEFAULT NULL,
  `jaminan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.barang: ~0 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table db_sewa.detail_barang
DROP TABLE IF EXISTS `detail_barang`;
CREATE TABLE IF NOT EXISTS `detail_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `durasi` text DEFAULT NULL,
  `harga` int(11) DEFAULT 0,
  `diskon` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.detail_barang: ~0 rows (approximately)
DELETE FROM `detail_barang`;
/*!40000 ALTER TABLE `detail_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_barang` ENABLE KEYS */;

-- Dumping structure for table db_sewa.fotobarang
DROP TABLE IF EXISTS `fotobarang`;
CREATE TABLE IF NOT EXISTS `fotobarang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `default` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.fotobarang: ~0 rows (approximately)
DELETE FROM `fotobarang`;
/*!40000 ALTER TABLE `fotobarang` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotobarang` ENABLE KEYS */;

-- Dumping structure for table db_sewa.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(70) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.kategori: ~2 rows (approximately)
DELETE FROM `kategori`;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `nama`, `status`, `gambar`) VALUES
	(9, 'elektronik', 'Aktif', '1573777132.jpg'),
	(10, 'sepatu', 'Aktif', '1573778967.png');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

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
  `keterangan_status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sewa.pengguna: ~1 rows (approximately)
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id`, `name`, `username`, `email`, `alamat`, `telp`, `tgl_lahir`, `gender`, `foto`, `foto_ktp`, `password`, `status`, `verivikasi`, `keterangan_status`) VALUES
	(4, 'jina sukarti', 'jinasukarti', 'satriosuklun@gmail.com', 'bandung', '14045', '1998-12-12', 'Wanita', '17563715581573996970.jpg', '596509124.1573910977.jpg', '$2y$10$.13N3Hob/jHiHGYx.y7xWeav2Y.CrbsSBL03Ye.COu7H4rL6n/lHK', 'Aktif', 'belum', NULL),
	(6, 'heru adi satrio', 'heruadi', 'snackymart@gmail.com', 'gurah', '209348920', '1998-09-09', 'Wanita', '4816952641574216244.jpg', '20009885841574216247.jpg', '$2y$10$R6JqwAbd8k.q/2rFYswZ.Oek4X92aT7wtDhsnuWM69ICpqJ1T5l9W', 'Aktif', 'belum', NULL);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.subkategori: ~4 rows (approximately)
DELETE FROM `subkategori`;
/*!40000 ALTER TABLE `subkategori` DISABLE KEYS */;
INSERT INTO `subkategori` (`id`, `id_kategori`, `nama`, `status`) VALUES
	(4, 9, 'handphone', 'Aktif'),
	(5, 9, 'HT', 'Aktif'),
	(6, 9, 'camera', 'Aktif'),
	(7, 10, 'sepatu boot', 'Aktif'),
	(8, 10, 'sepatu manten', 'Aktif');
/*!40000 ALTER TABLE `subkategori` ENABLE KEYS */;

-- Dumping structure for table db_sewa.toko
DROP TABLE IF EXISTS `toko`;
CREATE TABLE IF NOT EXISTS `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `verivikasi_status` enum('Ya','Tidak') DEFAULT 'Ya',
  `deskripsi_status` text DEFAULT NULL,
  `hari_buka` varchar(150) DEFAULT NULL,
  `jam_buka` varchar(20) DEFAULT NULL,
  `jam_tutup` varchar(20) DEFAULT NULL,
  `provinsi` varchar(60) DEFAULT NULL,
  `kota` varchar(60) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sewa.toko: ~2 rows (approximately)
DELETE FROM `toko`;
/*!40000 ALTER TABLE `toko` DISABLE KEYS */;
INSERT INTO `toko` (`id`, `id_pengguna`, `nama`, `deskripsi`, `alamat`, `status`, `verivikasi_status`, `deskripsi_status`, `hari_buka`, `jam_buka`, `jam_tutup`, `provinsi`, `kota`, `logo`) VALUES
	(3, 6, 'maju jaya sejahtera', 'persewaan kamera dan tukang foto juga dekor', 'jln penuh liku no 212 rt 01 rw 01', 'Aktif', 'Ya', NULL, 'senin,selasa,rabu,kamis,jumat,', '9:15 AM', '8:15 PM', '1', '3', '1574232921.jpg');
/*!40000 ALTER TABLE `toko` ENABLE KEYS */;

-- Dumping structure for table db_sewa.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Admin','Super Admin','Programmer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sewa.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `alamat`, `telp`, `level`, `email`, `foto`, `password`, `remember_token`) VALUES
	(1, 'deva', 'deva', 'asdf', '9273894', 'Programmer', 'satriosuklun@gmail.com', '1573878422.jpg', '$2y$10$3WctH0m2YvIAG/iq48coke8Fdc7q8bZNwQLjP4W4JOAF3I2ScSVj2', NULL),
	(5, 'heru adi', 'heruadi', 'gurah, kediri', '209348920', 'Admin', 'satriosuklun1@gmail.com', '1573878044.jpg', '$2y$10$lFKc6dPH97anoZYGUZTReOIVmgNeF3yvlsDZRlyM7Uk3YwpwOKZzy', NULL),
	(6, 'heri sumartio', 'hersumar', 'gurah', '2039489', 'Super Admin', 'satriosuklun1@gmail.com', '1573878759.jpg', '$2y$10$O41tDu5PYs5l7SF4LfHUnOEEhJlW49PZVAPpMJhnmSFNgycyOMq/y', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
