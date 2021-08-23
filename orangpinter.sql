-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 05:58 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orangpinter`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73', 1, 0, 0, '%', 1);

-- --------------------------------------------------------

--
-- Table structure for table `s_absen_hari`
--

CREATE TABLE `s_absen_hari` (
  `kd_absen_hari` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nis` int(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_absen_matpel`
--

CREATE TABLE `s_absen_matpel` (
  `kd_absen_mapel` int(11) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `nis` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `waktu` int(11) NOT NULL,
  `keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_guru`
--

CREATE TABLE `s_guru` (
  `nip` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_depan` int(11) NOT NULL,
  `nama_belakang` int(11) NOT NULL,
  `jk` int(11) NOT NULL,
  `gelar` int(11) NOT NULL,
  `lulusan` int(11) NOT NULL,
  `alamat` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `no_hp` int(11) NOT NULL,
  `foto` int(11) NOT NULL,
  `kd_jabatan` int(10) NOT NULL,
  `status_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_jabatan`
--

CREATE TABLE `s_jabatan` (
  `kd_jabatan` int(10) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_jadwal`
--

CREATE TABLE `s_jadwal` (
  `kd_jadwal` int(11) NOT NULL,
  `kd_mapel` varchar(11) NOT NULL,
  `nip` int(30) NOT NULL,
  `kd_kelas` varchar(11) NOT NULL,
  `hari` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_jurusan`
--

CREATE TABLE `s_jurusan` (
  `kd_jurusan` int(10) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `grup_jurusan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_kelas`
--

CREATE TABLE `s_kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `jam_mulai` varchar(15) NOT NULL,
  `jam_akhir` varchar(15) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_keuangan`
--

CREATE TABLE `s_keuangan` (
  `kd_keuangan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `kd_spp` int(11) NOT NULL,
  `dsp` int(20) NOT NULL,
  `pkl` int(20) NOT NULL,
  `wisuda` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_kurikulum`
--

CREATE TABLE `s_kurikulum` (
  `kd_kurikulum` int(20) NOT NULL,
  `jam_pelajaran` time NOT NULL,
  `nama_kurikulum` varchar(50) NOT NULL,
  `kd_ajaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_mapel`
--

CREATE TABLE `s_mapel` (
  `kd_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL,
  `jam_mapel` int(1) NOT NULL,
  `jam_target` varchar(20) NOT NULL,
  `semester` int(1) NOT NULL,
  `kd_kurikulum` int(20) NOT NULL,
  `kd_jurusan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_nilai`
--

CREATE TABLE `s_nilai` (
  `kd_nilai` int(11) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `kd_jurusan` int(15) NOT NULL,
  `nis` int(20) NOT NULL,
  `nip` int(20) NOT NULL,
  `tugas` int(11) NOT NULL,
  `uas` int(11) NOT NULL,
  `absen` int(11) NOT NULL,
  `norma` int(11) NOT NULL,
  `hasil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_pengumuman`
--

CREATE TABLE `s_pengumuman` (
  `kd_pengumuman` int(10) NOT NULL,
  `Jenis` varchar(50) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `nip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_p_siswa`
--

CREATE TABLE `s_p_siswa` (
  `skhun` int(11) NOT NULL,
  `penerima_kps` varchar(15) NOT NULL,
  `no_kps` varchar(25) NOT NULL,
  `nis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_siswa`
--

CREATE TABLE `s_siswa` (
  `nisn` int(20) NOT NULL,
  `nis` int(20) NOT NULL,
  `nama_depan` int(20) NOT NULL,
  `nama_belakang` int(30) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `rw` varchar(10) NOT NULL,
  `dusun` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `jenis_tinggal` varchar(50) NOT NULL,
  `alat_transportasi` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `photo` varchar(26) NOT NULL,
  `nip` int(11) NOT NULL,
  `kd_jurusan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_spp`
--

CREATE TABLE `s_spp` (
  `kd_spp` int(10) NOT NULL,
  `januari` date NOT NULL,
  `febuari` date NOT NULL,
  `maret` date NOT NULL,
  `april` date NOT NULL,
  `mei` date NOT NULL,
  `juni` date NOT NULL,
  `juli` date NOT NULL,
  `agustus` date NOT NULL,
  `september` date NOT NULL,
  `oktober` date NOT NULL,
  `november` date NOT NULL,
  `desember` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_tahun_ajaran`
--

CREATE TABLE `s_tahun_ajaran` (
  `kd_ajaran` int(10) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_wali`
--

CREATE TABLE `s_wali` (
  `nik` int(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `status` varchar(25) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `e-mail` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `nis` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `up_klas`
--

CREATE TABLE `up_klas` (
  `kd_up_klas` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `dari_klas` int(11) NOT NULL,
  `ke_klas` int(11) NOT NULL,
  `confirmasi` int(1) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_absen_hari`
--
ALTER TABLE `s_absen_hari`
  ADD PRIMARY KEY (`kd_absen_hari`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `s_absen_matpel`
--
ALTER TABLE `s_absen_matpel`
  ADD PRIMARY KEY (`kd_absen_mapel`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `nis` (`nis`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `s_guru`
--
ALTER TABLE `s_guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kd_jabatan` (`kd_jabatan`);

--
-- Indexes for table `s_jabatan`
--
ALTER TABLE `s_jabatan`
  ADD PRIMARY KEY (`kd_jabatan`);

--
-- Indexes for table `s_jadwal`
--
ALTER TABLE `s_jadwal`
  ADD PRIMARY KEY (`kd_jadwal`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `s_jurusan`
--
ALTER TABLE `s_jurusan`
  ADD PRIMARY KEY (`kd_jurusan`);

--
-- Indexes for table `s_kelas`
--
ALTER TABLE `s_kelas`
  ADD PRIMARY KEY (`kd_kelas`),
  ADD KEY `kd_mapel` (`kd_mapel`);

--
-- Indexes for table `s_keuangan`
--
ALTER TABLE `s_keuangan`
  ADD PRIMARY KEY (`kd_keuangan`),
  ADD KEY `kd_spp` (`kd_spp`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `s_kurikulum`
--
ALTER TABLE `s_kurikulum`
  ADD PRIMARY KEY (`kd_kurikulum`),
  ADD KEY `kd_ajaran` (`kd_ajaran`);

--
-- Indexes for table `s_mapel`
--
ALTER TABLE `s_mapel`
  ADD PRIMARY KEY (`kd_mapel`),
  ADD KEY `kd_kurikulum` (`kd_kurikulum`),
  ADD KEY `kd_jurusan` (`kd_jurusan`);

--
-- Indexes for table `s_nilai`
--
ALTER TABLE `s_nilai`
  ADD PRIMARY KEY (`kd_nilai`),
  ADD KEY `kd_jurusan` (`kd_jurusan`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nis` (`nis`),
  ADD KEY `kd_mapel` (`kd_mapel`);

--
-- Indexes for table `s_pengumuman`
--
ALTER TABLE `s_pengumuman`
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `s_p_siswa`
--
ALTER TABLE `s_p_siswa`
  ADD PRIMARY KEY (`skhun`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `s_siswa`
--
ALTER TABLE `s_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kd_jurusan` (`kd_jurusan`);

--
-- Indexes for table `s_spp`
--
ALTER TABLE `s_spp`
  ADD PRIMARY KEY (`kd_spp`);

--
-- Indexes for table `s_tahun_ajaran`
--
ALTER TABLE `s_tahun_ajaran`
  ADD PRIMARY KEY (`kd_ajaran`);

--
-- Indexes for table `s_wali`
--
ALTER TABLE `s_wali`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `up_klas`
--
ALTER TABLE `up_klas`
  ADD PRIMARY KEY (`kd_up_klas`),
  ADD KEY `nis` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `s_absen_hari`
--
ALTER TABLE `s_absen_hari`
  ADD CONSTRAINT `s_absen_hari_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`);

--
-- Constraints for table `s_absen_matpel`
--
ALTER TABLE `s_absen_matpel`
  ADD CONSTRAINT `s_absen_matpel_ibfk_1` FOREIGN KEY (`kd_mapel`) REFERENCES `s_mapel` (`kd_mapel`),
  ADD CONSTRAINT `s_absen_matpel_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `s_guru` (`nip`),
  ADD CONSTRAINT `s_absen_matpel_ibfk_3` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`);

--
-- Constraints for table `s_guru`
--
ALTER TABLE `s_guru`
  ADD CONSTRAINT `s_guru_ibfk_1` FOREIGN KEY (`kd_jabatan`) REFERENCES `s_jabatan` (`kd_jabatan`);

--
-- Constraints for table `s_jadwal`
--
ALTER TABLE `s_jadwal`
  ADD CONSTRAINT `s_jadwal_ibfk_1` FOREIGN KEY (`kd_kelas`) REFERENCES `s_kelas` (`kd_kelas`),
  ADD CONSTRAINT `s_jadwal_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `s_mapel` (`kd_mapel`),
  ADD CONSTRAINT `s_jadwal_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `s_guru` (`nip`);

--
-- Constraints for table `s_kelas`
--
ALTER TABLE `s_kelas`
  ADD CONSTRAINT `s_kelas_ibfk_1` FOREIGN KEY (`kd_mapel`) REFERENCES `s_mapel` (`kd_mapel`);

--
-- Constraints for table `s_keuangan`
--
ALTER TABLE `s_keuangan`
  ADD CONSTRAINT `s_keuangan_ibfk_1` FOREIGN KEY (`kd_spp`) REFERENCES `s_spp` (`kd_spp`),
  ADD CONSTRAINT `s_keuangan_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `s_guru` (`nip`),
  ADD CONSTRAINT `s_keuangan_ibfk_3` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`);

--
-- Constraints for table `s_kurikulum`
--
ALTER TABLE `s_kurikulum`
  ADD CONSTRAINT `s_kurikulum_ibfk_1` FOREIGN KEY (`kd_ajaran`) REFERENCES `s_tahun_ajaran` (`kd_ajaran`);

--
-- Constraints for table `s_mapel`
--
ALTER TABLE `s_mapel`
  ADD CONSTRAINT `s_mapel_ibfk_1` FOREIGN KEY (`kd_kurikulum`) REFERENCES `s_kurikulum` (`kd_kurikulum`),
  ADD CONSTRAINT `s_mapel_ibfk_2` FOREIGN KEY (`kd_jurusan`) REFERENCES `s_jurusan` (`kd_jurusan`);

--
-- Constraints for table `s_nilai`
--
ALTER TABLE `s_nilai`
  ADD CONSTRAINT `s_nilai_ibfk_1` FOREIGN KEY (`kd_jurusan`) REFERENCES `s_jurusan` (`kd_jurusan`),
  ADD CONSTRAINT `s_nilai_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `s_guru` (`nip`),
  ADD CONSTRAINT `s_nilai_ibfk_3` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`),
  ADD CONSTRAINT `s_nilai_ibfk_4` FOREIGN KEY (`kd_mapel`) REFERENCES `s_mapel` (`kd_mapel`);

--
-- Constraints for table `s_pengumuman`
--
ALTER TABLE `s_pengumuman`
  ADD CONSTRAINT `s_pengumuman_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `s_guru` (`nip`);

--
-- Constraints for table `s_p_siswa`
--
ALTER TABLE `s_p_siswa`
  ADD CONSTRAINT `s_p_siswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`);

--
-- Constraints for table `s_siswa`
--
ALTER TABLE `s_siswa`
  ADD CONSTRAINT `s_siswa_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `s_guru` (`nip`),
  ADD CONSTRAINT `s_siswa_ibfk_2` FOREIGN KEY (`kd_jurusan`) REFERENCES `s_jurusan` (`kd_jurusan`);

--
-- Constraints for table `s_wali`
--
ALTER TABLE `s_wali`
  ADD CONSTRAINT `s_wali_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`);

--
-- Constraints for table `up_klas`
--
ALTER TABLE `up_klas`
  ADD CONSTRAINT `up_klas_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `s_siswa` (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
