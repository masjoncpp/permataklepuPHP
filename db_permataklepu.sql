-- phpMyAdmin SQL Dump
-- version 5.2.2deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2025 at 05:49 PM
-- Server version: 8.4.7-0ubuntu0.25.10.3
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_permataklepu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'klepu', '5b4dff0e746b50ed90b7a7c47982d87b', 'Admin Website Permata Klepu');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `link_drive` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `kategori`, `isi`, `gambar`, `link_drive`, `tanggal`, `created_at`) VALUES
(1, '5 Tips Memulai Usaha dengan Modal Kecil', 'Ibu Cakap Usaha', 'Pelajari cara memulai usaha...', 'cakap2.jpg', '#', '2025-07-15', '2025-11-23 12:38:54'),
(2, 'Panduan Lengkap Pertanian Organik', 'Ibu Rawat Bumi', 'Cara mudah berkebun...', 'eco2.jpg', '#', '2025-06-20', '2025-11-23 12:38:54'),
(3, 'Pentingnya Gizi Seimbang', 'Ibu Sejahtera', 'Mengenal kebutuhan gizi...', 'sejahtera3.jpg', '#', '2025-08-25', '2025-11-23 12:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`, `tanggal`, `created_at`) VALUES
(1, 'Kegiatan Ibu Cakap Usaha', 'cakap3.jpg', '2025-08-01', '2025-11-23 12:40:38'),
(3, 'Pelatihan Digital Marketing', 'cakap4.webp', '2025-08-05', '2025-11-23 12:40:38'),
(4, 'Tradisi Merti Desa', 'merti.webp', '2025-08-10', '2025-11-23 12:40:38'),
(5, 'Kumpul di Pendopo', 'pendopo2.webp', '2025-08-12', '2025-11-23 12:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `deskripsi`, `gambar`, `created_at`) VALUES
(1, 'Ibu Cakap Usaha', 'Program pelatihan kewirausahaan dan literasi keuangan untuk meningkatkan kemampuan perempuan dalam mengelola usaha.', '1710931317_cakap2.jpg', '2025-11-23 16:28:15'),
(2, 'Ibu Rawat Bumi', 'Program edukasi tentang pengelolaan lingkungan dan pertanian organik untuk keberlanjutan ekosistem desa.', '1164626601_eco.jpg', '2025-11-23 16:28:15'),
(3, 'Ibu Sejahtera', 'Program kesehatan dan kesejahteraan keluarga yang mencakup gizi, kesehatan mental, dan keharmonisan rumah tangga.', '206921134_sejahtera2.jpg', '2025-11-23 16:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kelas` enum('Ibu Cerdas','Ibu Mandiri','Ibu Tangguh') NOT NULL,
  `nilai_akhir` float NOT NULL,
  `status` enum('Lulus','Belum Lulus') NOT NULL,
  `link_ijazah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nama_peserta`, `username`, `password`, `kelas`, `nilai_akhir`, `status`, `link_ijazah`) VALUES
(87, 'Budi Arie', 'user1', '$2y$12$p7ao4xQRre.xRAZ3t5OM8OW8j1hAlL65jhjfw7ybCVpAH0JqImeaq', 'Ibu Mandiri', 84, 'Lulus', 'https://drive.google.com/drive/folders/dummy1'),
(88, 'Peserta 2', 'user2', '$2y$12$WUatpDYJA/ruORcbiDbyMelKjYY2xHF9xjHs7WhaP6YpBVqjRMnsy', 'Ibu Tangguh', 97, 'Lulus', 'https://drive.google.com/drive/folders/dummy2'),
(89, 'Peserta 3', 'user3', '$2y$12$Hw0R6KY1YwPH7Ej4/vlEJuRnK6flthwVuCylkVStfXLDAAaY61Kme', 'Ibu Cerdas', 85, 'Lulus', 'https://drive.google.com/drive/folders/dummy3'),
(90, 'Peserta 4', 'user4', '$2y$12$SMLifXGH7XjOlL.2Uqy0l.nMdcP2tt/SpUiq9ze7gU1BbaDdcfkre', 'Ibu Mandiri', 79, 'Lulus', 'https://drive.google.com/drive/folders/dummy4'),
(91, 'Peserta 5', 'user5', '$2y$12$K8PRAAZPnjGZRH9bXq/MbOknxcigquV8SCRnTgjYD2zxtwVxXIrQu', 'Ibu Tangguh', 94, 'Lulus', 'https://drive.google.com/drive/folders/dummy5'),
(92, 'Peserta 6', 'user6', '$2y$12$IVa4i8Zwypvl5k0L4fNEOOdG32IPs.oVx3s1UuBYjaFB41xi2Npfy', 'Ibu Cerdas', 93, 'Lulus', 'https://drive.google.com/drive/folders/dummy6'),
(93, 'Peserta 7', 'user7', '$2y$12$VdLZ69DOyOYbiGu1pEZLN.vPts6y5Jheh9NzwWOTFIga5hxV86WrS', 'Ibu Mandiri', 76, 'Lulus', 'https://drive.google.com/drive/folders/dummy7'),
(94, 'Peserta 8', 'user8', '$2y$12$tx0HIVwQILk2.YjVm3J8he/Bva31Z8tVNhWslu1n0R7JkdmCJdmv2', 'Ibu Tangguh', 92, 'Lulus', 'https://drive.google.com/drive/folders/dummy8'),
(95, 'Peserta 9', 'user9', '$2y$12$yRupFiVdmXm5KUfh/b70TeC.F3UlGTaABKr7X4pkwI786W8CBRJp.', 'Ibu Cerdas', 95, 'Lulus', 'https://drive.google.com/drive/folders/dummy9'),
(96, 'Peserta 10', 'user10', '$2y$12$Li0tTJLoVbSAGoRHMVtZkuU2ejRYjyz9vyGqlBqzXl61/nzQ1nH26', 'Ibu Mandiri', 94, 'Lulus', 'https://drive.google.com/drive/folders/dummy10'),
(98, 'Peserta 12', 'user12', '$2y$12$RQmh7OvoVswyZI7tCLlrcu3e6rCzl46INat9rjvABhHiP0rO9Hoqq', 'Ibu Cerdas', 99, 'Lulus', 'https://drive.google.com/drive/folders/dummy12'),
(99, 'Peserta 13', 'user13', '$2y$12$mv3HpwwaN60l2Et7rKN.F.VqpgYKY50GEtP1DmFuirTlHeKzdi32a', 'Ibu Mandiri', 73, 'Lulus', ''),
(100, 'Peserta 14', 'user14', '$2y$12$kLYAyu1Zt/Bri0X0OUAGhOiB51RcVewZ6HGNg7ER5qk0I83jQOcPm', 'Ibu Tangguh', 100, 'Lulus', 'https://drive.google.com/drive/folders/dummy14'),
(101, 'Peserta 15', 'user15', '$2y$12$UoQXY0cVuDVKpu5GtT/THuk6zJOqhu7opN4NwvEUeu0R5XqmVSZva', 'Ibu Cerdas', 81, 'Lulus', 'https://drive.google.com/drive/folders/dummy15'),
(102, 'Peserta 16', 'user16', '$2y$12$AhlxiWFkT.yhOgS6oT.6furth/JP6x.Fj2eJIC/iAprkybPQ3ZlTS', 'Ibu Mandiri', 84, 'Lulus', 'https://drive.google.com/drive/folders/dummy16'),
(103, 'Peserta 17', 'user17', '$2y$12$4dq8aH20Y89yq/YLLdYFqOBbpWs2RxzSk.roZyye0r5QW/5pg31Ve', 'Ibu Tangguh', 97, 'Lulus', 'https://drive.google.com/drive/folders/dummy17'),
(104, 'Peserta 18', 'user18', '$2y$12$k9BB2Ob5/uzLptIVnVItTO22sbyoyarVLlgiYqweKuibBkhZUVgeK', 'Ibu Cerdas', 87, 'Lulus', 'https://drive.google.com/drive/folders/dummy18'),
(105, 'Peserta 19', 'user19', '$2y$12$mCLqW7AjHIhiycIjgCnCj.eBeBDguBp0.HWNrV03ugfERID4Jcu/C', 'Ibu Mandiri', 77, 'Lulus', 'https://drive.google.com/drive/folders/dummy19'),
(106, 'Peserta 20', 'user20', '$2y$12$oBhDEWIfso.cfAQnhYv6Q.OhgGFUd4KVwfD9rXsfI0y1byMKAAFnC', 'Ibu Tangguh', 72, 'Belum Lulus', ''),
(107, 'Peserta 21', 'user21', '$2y$12$ZavbjU/Z2Wb1QXJAFpcr0ePW5neduqUq8wkaSnKw9llssWPUPnLPi', 'Ibu Cerdas', 90, 'Lulus', 'https://drive.google.com/drive/folders/dummy21'),
(108, 'Peserta 22', 'user22', '$2y$12$6/SJX3tC/HNcDs/z0j3BoeLIKR8vqNKYJfpEnKWtUipXeKH8wTUhW', 'Ibu Mandiri', 87, 'Lulus', 'https://drive.google.com/drive/folders/dummy22'),
(109, 'Peserta 23', 'user23', '$2y$12$UtTN24s228nw/fPGlCkLmOzQ/58SN0p1OuolhUhU2RSAsrTMS6QB.', 'Ibu Tangguh', 89, 'Lulus', 'https://drive.google.com/drive/folders/dummy23'),
(110, 'Peserta 24', 'user24', '$2y$12$ArIi8O69Ou4ksjXbvq0alOkRxzlMzg7zgLa9ArFIiKWDR9wg2HJTG', 'Ibu Cerdas', 73, 'Belum Lulus', ''),
(111, 'Peserta 25', 'user25', '$2y$12$w9efjZ8xQFqLB1orsj7LqudXVbc6jcXiICNK5fUE4WRcn.EjabwGm', 'Ibu Mandiri', 100, 'Lulus', 'https://drive.google.com/drive/folders/dummy25'),
(112, 'Peserta 26', 'user26', '$2y$12$5akyBOM50uCXrB9KHB/zu.VdHViXhM3l5M8SXGMb2/sAhQDd9gNBG', 'Ibu Tangguh', 86, 'Lulus', 'https://drive.google.com/drive/folders/dummy26'),
(113, 'Peserta 27', 'user27', '$2y$12$IykPqEBKpvNSsxrjhWGAa.XMAuq11Z106AYiAEBYIu4Fl8j6B7e9m', 'Ibu Cerdas', 88, 'Lulus', 'https://drive.google.com/drive/folders/dummy27'),
(114, 'Peserta 28', 'user28', '$2y$12$Br4a.hW0MyI46jgwzhXVkOU14bE1QNOZgsPt64zUwrxWPDvI.lyzK', 'Ibu Mandiri', 74, 'Belum Lulus', ''),
(115, 'Peserta 29', 'user29', '$2y$12$n9J7c3iXSbk/3STfYQjUte4NEZUr1O8CG99wLb4rNwj8J0ZwbKdru', 'Ibu Tangguh', 73, 'Belum Lulus', ''),
(116, 'Peserta 30', 'user30', '$2y$12$Jv6zF1IvkX/QJiYAFZMOCOMHQT0S3VVWGcUC.Gs.IesbzvPR3Gfqi', 'Ibu Cerdas', 93, 'Lulus', 'https://drive.google.com/drive/folders/dummy30'),
(117, 'Peserta 31', 'user31', '$2y$12$hZsxUN9We4Oq9WIj0q/52e7Nf1DUJ2Pjb5pVNQaUXWaYgL.hdwp/S', 'Ibu Mandiri', 86, 'Lulus', 'https://drive.google.com/drive/folders/dummy31'),
(118, 'Peserta 32', 'user32', '$2y$12$uhZ5gqdyCgkgXyzJlzhVEufOXaKDLHK.c/IOL1d.INV4/spYWXWeW', 'Ibu Tangguh', 100, 'Lulus', 'https://drive.google.com/drive/folders/dummy32'),
(119, 'Peserta 33', 'user33', '$2y$12$Gz4NF9o4BwcrcMlFeTwWv.pzATNBgg1jAQKwal3Vnio3KsX.bK9ZS', 'Ibu Cerdas', 78, 'Lulus', 'https://drive.google.com/drive/folders/dummy33'),
(120, 'Peserta 34', 'user34', '$2y$12$5ThMYIonni8eOBvpJZs9sO1xDmJwzOtF1pxCTNSzoMqkNtWrl4dQC', 'Ibu Mandiri', 92, 'Lulus', 'https://drive.google.com/drive/folders/dummy34'),
(121, 'Peserta 35', 'user35', '$2y$12$dBySDRU.HW4ZEMP27KwpXuR7Q1oKksDGFpGj/iNRhFuYQVzH9Ptty', 'Ibu Tangguh', 87, 'Lulus', 'https://drive.google.com/drive/folders/dummy35'),
(122, 'Peserta 36', 'user36', '$2y$12$cgDyZa8Kmg4AVs3IzTbZku/mtIcEGMIOWvP/YLg3snqFZJYEJO84y', 'Ibu Cerdas', 98, 'Lulus', 'https://drive.google.com/drive/folders/dummy36'),
(123, 'Peserta 37', 'user37', '$2y$12$UGDz.r27d0VZ6iKVIjVMQOCymCygYQn5cFPksdX/3/Gc/BXZineuq', 'Ibu Mandiri', 81, 'Lulus', 'https://drive.google.com/drive/folders/dummy37'),
(124, 'Peserta 38', 'user38', '$2y$12$Zmfv2KqPO9zydM..FizgR.6ILvAvUqnQ95PEuoZcPtsvLXNYa6rE6', 'Ibu Tangguh', 87, 'Lulus', 'https://drive.google.com/drive/folders/dummy38'),
(125, 'Peserta 39', 'user39', '$2y$12$1OPb/1O5AXVCd.u4qJdxsecVVC9M.aAmZCotfPO7DG6ZhJp3OgVsm', 'Ibu Cerdas', 92, 'Lulus', 'https://drive.google.com/drive/folders/dummy39'),
(126, 'Peserta 40', 'user40', '$2y$12$40JcdI8O43zB0TX9stl57.Xo5eVC4QQrPKcJurm1nSyFoqQAcSxui', 'Ibu Mandiri', 77, 'Lulus', 'https://drive.google.com/drive/folders/dummy40'),
(127, 'Peserta 41', 'user41', '$2y$12$e9Xx5c8mWWmMO57BUCjw6O0e/3i0DMaayFFfEChdtHBfDH0.Qud22', 'Ibu Tangguh', 85, 'Lulus', 'https://drive.google.com/drive/folders/dummy41'),
(128, 'Peserta 42', 'user42', '$2y$12$uAU5Gbh/2WxUjDL0rDGwn.ZX66DoUqXYyUfu4l3P05sdPtbUKRa/i', 'Ibu Cerdas', 88, 'Lulus', 'https://drive.google.com/drive/folders/dummy42'),
(129, 'Peserta 43', 'user43', '$2y$12$EV8T00SZVG30BIaFgG61D.sbcYCbXr6e57Gw7/KNBc.csCqp0Vo/S', 'Ibu Mandiri', 86, 'Lulus', 'https://drive.google.com/drive/folders/dummy43'),
(130, 'Peserta 44', 'user44', '$2y$12$CKjo3QdoiKKvh51dkZ06Iew7UkiDSiY4N5b2f3gWDoV2FmtvJBS/O', 'Ibu Tangguh', 86, 'Lulus', 'https://drive.google.com/drive/folders/dummy44'),
(131, 'Peserta 45', 'user45', '$2y$12$MURgE9louLSvm01xOw.Uu.3dtfPO0CrPPKK2XiklYs46DiXu7.7da', 'Ibu Cerdas', 78, 'Lulus', 'https://drive.google.com/drive/folders/dummy45'),
(132, 'Peserta 46', 'user46', '$2y$12$nWwfLTI18k7dgOfQhmiqo.wmhIbpoat7vbxVDq9GN9vRgtEmMBAYi', 'Ibu Mandiri', 86, 'Lulus', 'https://drive.google.com/drive/folders/dummy46'),
(133, 'Peserta 47', 'user47', '$2y$12$.E.vM.YX/xMh27lyobuWq.NKGg4xhCqUrTwyW8PL6UFMplsfH3VQi', 'Ibu Tangguh', 93, 'Lulus', 'https://drive.google.com/drive/folders/dummy47'),
(134, 'Peserta 48', 'user48', '$2y$12$cOAazntaE4TJg.e2oyllJ.D2O8cljgF6VIG3OHQmHG9FnpYW8CBuu', 'Ibu Cerdas', 99, 'Lulus', 'https://drive.google.com/drive/folders/dummy48'),
(135, 'Peserta 49', 'user49', '$2y$12$d0xf7wJbI42sOmrrY4cH1elZ5LXxQVL5k/MYLd24cpOtJIDTz4yjq', 'Ibu Mandiri', 82, 'Lulus', 'https://drive.google.com/drive/folders/dummy49'),
(136, 'Peserta 50', 'user50', '$2y$12$Z502c1DWbWtHum30.QGW1.yJU4hxP3PKvi5LvMTUKYztmvL4IUZfO', 'Ibu Tangguh', 80, 'Lulus', 'https://drive.google.com/drive/folders/dummy50'),
(137, 'Peserta 51', 'user51', '$2y$12$svkApTo28ZTfiedDlnYUb.tpgrmbkzcirTts.kNrh78tOVigqLQXm', 'Ibu Cerdas', 80, 'Lulus', 'https://drive.google.com/drive/folders/dummy51'),
(138, 'Peserta 52', 'user52', '$2y$12$L41JLVIKENz1CkyUp83dL.HXzOpCP/Fkg/XpAkqi4gWYaOKKfqOZi', 'Ibu Mandiri', 76, 'Lulus', 'https://drive.google.com/drive/folders/dummy52'),
(139, 'Peserta 53', 'user53', '$2y$12$GvdBi6oP493JP3h69tuetuY7f4XNp0nAhgkuB0O0pA4bjKI290jrm', 'Ibu Tangguh', 78, 'Lulus', 'https://drive.google.com/drive/folders/dummy53'),
(140, 'Peserta 54', 'user54', '$2y$12$mTakslnGyxm0uijqx0K9ku0gVnbOP6UIi5rWGK/1DiNK4BahALVPS', 'Ibu Cerdas', 81, 'Lulus', 'https://drive.google.com/drive/folders/dummy54'),
(141, 'Peserta 55', 'user55', '$2y$12$KTli/qe9vRqw4YZBHu5m2O0gf3e2nOE.VOTlRtVE6kLK.cUIbz8Cm', 'Ibu Mandiri', 93, 'Lulus', 'https://drive.google.com/drive/folders/dummy55'),
(142, 'Peserta 56', 'user56', '$2y$12$ua9oSiyJ9Pz2AC4kz4rgS.l4rmtyD05j/ejPI/mjMRi835kKTOOhu', 'Ibu Tangguh', 96, 'Lulus', 'https://drive.google.com/drive/folders/dummy56'),
(143, 'Peserta 57', 'user57', '$2y$12$wquJ8RVNCgKtNkHCzE8PQuEcCKiBGRq.I7rUa5hBMFVknp009ZD/K', 'Ibu Cerdas', 76, 'Lulus', 'https://drive.google.com/drive/folders/dummy57'),
(144, 'Peserta 58', 'user58', '$2y$12$9tOnGCeJKfHni1mQZGRyS.gCvubNvD6jYJxYVrtMEKFRjqvfrbJDO', 'Ibu Mandiri', 97, 'Lulus', 'https://drive.google.com/drive/folders/dummy58'),
(145, 'Peserta 59', 'user59', '$2y$12$yGOdc9U3TE.ExXlYKk.sWOyNvPSNa5Ll56YSvKdShIXqbg2rKm2xm', 'Ibu Tangguh', 83, 'Lulus', 'https://drive.google.com/drive/folders/dummy59'),
(146, 'Peserta 60', 'user60', '$2y$12$DsLY/Cx6hcTwQPzmItn8V.vfOW7gp2aVpYnPLi8yXpNp./8koER7a', 'Ibu Cerdas', 71, 'Belum Lulus', ''),
(147, 'Peserta 61', 'user61', '$2y$12$.oRnxPiW5y9oHiEmN/ViWeVNkohb6u3TnSB5A1lwAMAdZdlL5KD9u', 'Ibu Mandiri', 75, 'Lulus', 'https://drive.google.com/drive/folders/dummy61'),
(148, 'Peserta 62', 'user62', '$2y$12$q.ibAZ2V3arzMbfkX5fN3.aRfCihmb2q53F8muSTwMPKfIOCBHSY6', 'Ibu Tangguh', 97, 'Lulus', 'https://drive.google.com/drive/folders/dummy62'),
(149, 'Peserta 63', 'user63', '$2y$12$ZE4Wc1t68lLR4IWy9S6qw.n3JT3PwbTmmhPZGCbdisPS0rCffHdmq', 'Ibu Cerdas', 73, 'Belum Lulus', ''),
(150, 'Peserta 64', 'user64', '$2y$12$LosOd.LdrCJyPKSrrHeT1u4JgTi84/os/4pB305f0J.747q3/70FO', 'Ibu Mandiri', 96, 'Lulus', 'https://drive.google.com/drive/folders/dummy64'),
(151, 'Peserta 65', 'user65', '$2y$12$Al/DphnZ1OhrjLropvwD/ulafU4Iy31H0MxHhKAn8PlF4rQyP.PCe', 'Ibu Tangguh', 73, 'Belum Lulus', ''),
(152, 'Peserta 66', 'user66', '$2y$12$qTJRT.z92O2zFOt3f9E6Y.rHbrZRy8Z8skRdE7Up7R2Q6sI5iV3Di', 'Ibu Cerdas', 85, 'Lulus', 'https://drive.google.com/drive/folders/dummy66'),
(153, 'Peserta 67', 'user67', '$2y$12$N69H5U0IituPximwbZDqJOgbY7tn552VQ9qDtzhJhJ9hczjP1hK4S', 'Ibu Mandiri', 88, 'Lulus', 'https://drive.google.com/drive/folders/dummy67'),
(154, 'Peserta 68', 'user68', '$2y$12$qf8ebvSY.AVNAAVMQIGvFeluZ97RQspDrRVNpNg7Qhigdi5lwQ1IS', 'Ibu Tangguh', 70, 'Belum Lulus', ''),
(155, 'Peserta 69', 'user69', '$2y$12$UMHRCiHOPCzvIjlireHt4erWWeiwo2EcIEt7TgAqeupWL4X0CDXgS', 'Ibu Cerdas', 74, 'Belum Lulus', ''),
(156, 'Peserta 70', 'user70', '$2y$12$6tfpk4lv1S32GKIUJujS2ur3rudM62b42uGevNa3zrYd86m3N11EO', 'Ibu Mandiri', 99, 'Lulus', 'https://drive.google.com/drive/folders/dummy70'),
(157, 'Peserta 71', 'user71', '$2y$12$aT3TKg0Kq0zgC4ZK2Fuf/.F3/nv8ZsNb3.QqEpQlMQ3mpew7NlRzy', 'Ibu Tangguh', 95, 'Lulus', 'https://drive.google.com/drive/folders/dummy71'),
(158, 'Peserta 72', 'user72', '$2y$12$bDlCLVxdMYXaaRQVjpRsC.OOqLT1kXLiOnKr1qtc956d7nfF3vRUK', 'Ibu Cerdas', 93, 'Lulus', 'https://drive.google.com/drive/folders/dummy72'),
(159, 'Peserta 73', 'user73', '$2y$12$miK1.f0GIAStgmkrXorEfubqJ4irSlNdOqUih1kHUG5f9RZfNW.8i', 'Ibu Mandiri', 94, 'Lulus', 'https://drive.google.com/drive/folders/dummy73'),
(160, 'Peserta 74', 'user74', '$2y$12$r1aEaFWf5Y.pz4fjIWIzauMN7ERPaLEUA1B75LB4gzLTck4xud5pm', 'Ibu Tangguh', 99, 'Lulus', 'https://drive.google.com/drive/folders/dummy74'),
(161, 'Peserta 75', 'user75', '$2y$12$o20i.Ym7enjBZHegmXdAWeIRPkWG3in/HUPQeoWPqwdr9zH0bAAoq', 'Ibu Cerdas', 70, 'Belum Lulus', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int NOT NULL,
  `kunci` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `kunci`, `nilai`) VALUES
(1, 'presensi_status', 'buka');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `program` varchar(50) NOT NULL,
  `status_kehadiran` varchar(20) DEFAULT 'Hadir',
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kunci` (`kunci`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
