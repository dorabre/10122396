-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Feb 2025 pada 09.50
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbguru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `nomor_induk` int(11) DEFAULT NULL,
  `gaji_pokok` decimal(10,2) NOT NULL,
  `tunjangan` decimal(10,2) NOT NULL,
  `total_gaji` decimal(10,2) GENERATED ALWAYS AS (`gaji_pokok` + `tunjangan`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`nomor_induk`, `gaji_pokok`, `tunjangan`) VALUES
(10111, '2116900.00', '3000000.00'),
(10112, '1938500.00', '2000000.00'),
(10113, '1938500.00', '2000000.00'),
(10114, '3336600.00', '3000000.00'),
(10115, '2116900.00', '3000000.00'),
(10116, '1938500.00', '3000000.00'),
(10117, '3201200.00', '3000000.00');

--
-- Trigger `gaji`
--
DELIMITER $$
CREATE TRIGGER `set_gaji_pokok` BEFORE INSERT ON `gaji` FOR EACH ROW BEGIN
    IF (SELECT golongan FROM guru WHERE nomor_induk = NEW.nomor_induk) = '1' THEN
        SET NEW.gaji_pokok = 1938500;
    ELSEIF (SELECT golongan FROM guru WHERE nomor_induk = NEW.nomor_induk) = '2' THEN
        SET NEW.gaji_pokok = 2116900;
    ELSEIF (SELECT golongan FROM guru WHERE nomor_induk = NEW.nomor_induk) = '3' THEN
        SET NEW.gaji_pokok = 3201200;
    ELSEIF (SELECT golongan FROM guru WHERE nomor_induk = NEW.nomor_induk) = '4' THEN
        SET NEW.gaji_pokok = 3336600;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_total_gaji` BEFORE INSERT ON `gaji` FOR EACH ROW BEGIN
    SET NEW.total_gaji = NEW.gaji_pokok + NEW.tunjangan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_tunjangan` BEFORE INSERT ON `gaji` FOR EACH ROW BEGIN
    IF (SELECT status FROM guru WHERE nomor_induk = NEW.nomor_induk) = 'honorer' THEN
        SET NEW.tunjangan = 2000000;
    ELSEIF (SELECT status FROM guru WHERE nomor_induk = NEW.nomor_induk) = 'tetap' THEN
        SET NEW.tunjangan = 3000000;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `nomor_induk` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ttl` date DEFAULT NULL,
  `jenis_kelamin` enum('perempuan','laki-laki') DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('tetap','honorer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`nomor_induk`, `nama`, `ttl`, `jenis_kelamin`, `golongan`, `mapel`, `alamat`, `status`) VALUES
(10111, 'herman maulana', '2004-01-15', 'perempuan', '2', 'inggris', 'baleendah', 'tetap'),
(10112, 'tetep', '2025-02-09', 'perempuan', '1', 'sejarah', 'dago', 'honorer'),
(10113, 'triceratops', '2016-03-12', 'perempuan', '1', 'indonesia', 'banjaran', 'honorer'),
(10114, 'stegosaurus', '2004-07-15', 'perempuan', '4', 'pkn', 'soreang', 'tetap'),
(10115, 'jonathan', '2000-02-15', 'perempuan', '2', 'mesin', 'pengalengan', 'tetap'),
(10116, 'bryan', '2009-06-16', 'perempuan', '1', 'agama', 'leuwi panjang', 'tetap'),
(10117, 'tyron', '2016-06-22', 'laki-laki', '3', 'matematika', 'dipatiukur', 'tetap');

--
-- Trigger `guru`
--
DELIMITER $$
CREATE TRIGGER `after_insert_guru` AFTER INSERT ON `guru` FOR EACH ROW BEGIN
    DECLARE gaji_pokok DECIMAL(10, 2);
    DECLARE tunjangan DECIMAL(10, 2);
    
    -- Menentukan gaji pokok berdasarkan golongan
    IF NEW.golongan = '1' THEN
        SET gaji_pokok = 1938500;
    ELSEIF NEW.golongan = '2' THEN
        SET gaji_pokok = 2116900;
    ELSEIF NEW.golongan = '3' THEN
        SET gaji_pokok = 3201200;
    ELSEIF NEW.golongan = '4' THEN
        SET gaji_pokok = 3336600;
    END IF;
    
    -- Menentukan tunjangan berdasarkan status
    IF NEW.status = 'honorer' THEN
        SET tunjangan = 2000000;
    ELSEIF NEW.status = 'tetap' THEN
        SET tunjangan = 3000000;
    END IF;
    
    -- Menambahkan data gaji ke tabel gaji
    INSERT INTO gaji (nomor_induk, gaji_pokok, tunjangan, total_gaji)
    VALUES (NEW.nomor_induk, gaji_pokok, tunjangan, gaji_pokok + tunjangan);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD KEY `nomor_induk` (`nomor_induk`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`nomor_induk`) REFERENCES `guru` (`nomor_induk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
