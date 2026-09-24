-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_inventaris
DROP DATABASE IF EXISTS `db_inventaris`;
CREATE DATABASE IF NOT EXISTS `db_inventaris` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_inventaris`;

-- Dumping structure for table db_inventaris.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_inventaris.barang: ~7 rows (approximately)
INSERT INTO `barang` (`id`, `nama_barang`, `kategori`, `harga`, `stok`, `gambar`) VALUES
	(4, 'Bengbeng', 'snack', 2500, 100, 'bengbeng.jfif'),
	(5, 'siip', 'snack', 4000, 100, 'siip.jfif'),
	(6, 'Chitato Lite', 'snack', 10500, 100, 'chitato.jfif'),
	(7, 'Tictac', 'snack', 2000, 150, 'tictac.jfif'),
	(8, 'Djarum super kretek 12 filter', 'rokok', 25000, 150, 'bjarumsuper.png'),
	(9, 'Aroma bold 12 kretek filter', 'rokok', 19000, 150, 'aromabold.png'),
	(10, 'Aroma bold 16 kretek filter', 'rokok', 25000, 150, 'aromabold16.avif');

-- Dumping structure for table db_inventaris.detail_penjualan
DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penjualan` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_inventaris.detail_penjualan: ~4 rows (approximately)
INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_barang`, `jumlah`, `subtotal`) VALUES
	(1, 1, 1, 1, 1231231),
	(2, 2, 2, 1, 4000),
	(3, 3, 2, 1, 4000),
	(4, 4, 2, 1, 4000),
	(5, 5, 2, 1, 4000);

-- Dumping structure for table db_inventaris.pelanggan
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_inventaris.pelanggan: ~0 rows (approximately)
INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `telepon`, `alamat`) VALUES
	(1, 'Umum / Guest', '-', '-'),
	(2, 'budi', '2412412412414', 'bantul');

-- Dumping structure for table db_inventaris.pengaturan
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(100) NOT NULL,
  `alamat_toko` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_inventaris.pengaturan: ~0 rows (approximately)
INSERT INTO `pengaturan` (`id`, `nama_toko`, `alamat_toko`) VALUES
	(1, 'KASIRMU POS', 'Jl. Malioboro No. 123, Yogyakarta');

-- Dumping structure for table db_inventaris.penjualan
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int DEFAULT '1',
  `tanggal` datetime NOT NULL,
  `total_harga` int NOT NULL,
  `diskon` int DEFAULT '0',
  `bayar` int DEFAULT NULL,
  `kembalian` int DEFAULT NULL,
  `jenis_pesanan` varchar(50) DEFAULT 'Offline',
  `metode_pembayaran` varchar(50) DEFAULT 'Tunai',
  `catatan` text,
  `diskon_persen` int DEFAULT '0',
  `pajak` int DEFAULT '0',
  `service_charge` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_inventaris.penjualan: ~5 rows (approximately)
INSERT INTO `penjualan` (`id`, `id_pelanggan`, `tanggal`, `total_harga`, `diskon`, `bayar`, `kembalian`, `jenis_pesanan`, `metode_pembayaran`, `catatan`, `diskon_persen`, `pajak`, `service_charge`) VALUES
	(1, 1, '2026-09-21 15:57:53', 1231231, 0, 20000000, 18768769, 'Offline', 'Tunai', NULL, 0, 0, 0),
	(2, 1, '2026-09-21 16:47:50', 4000, 0, 5000, 1000, 'Offline / Toko', 'Tunai', NULL, 0, 0, 0),
	(3, 1, '2026-09-21 17:08:22', 4000, 0, 5000, 1000, 'Offline / Toko', 'Tunai', NULL, 0, 0, 0),
	(4, 1, '2026-09-21 17:26:57', 4440, 0, 5000, 560, 'Offline / Toko', 'Tunai', '', 0, 440, 0),
	(5, 1, '2026-09-21 19:56:00', 4440, 0, 5000, 560, 'Offline / Toko', 'Tunai', '', 0, 440, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
