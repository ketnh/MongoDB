-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 13, 2013 at 07:41 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.2.9-2
drop database qlsv;
create database qlsv;
use qlsv;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qlsv`
--

-- --------------------------------------------------------

--
-- Table structure for table `canbo`
--

CREATE TABLE IF NOT EXISTS `canbo` (
  `maCanBo` varchar(10) NOT NULL,
  `hoTen` varchar(30) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `gioiTinh` tinyint(1) DEFAULT NULL,
  `maChucVu` varchar(10) DEFAULT NULL,
  `phong` varchar(20) DEFAULT NULL,
  `maChuyenNganh` varchar(10) DEFAULT NULL,
  `maKhoa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`maCanBo`),
  KEY `canBo_maChucVu` (`maChucVu`),
  KEY `canBo_maChuyenNganh` (`maChuyenNganh`),
  KEY `canBo_maKhoa` (`maKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `canbo`
--

INSERT INTO `canbo` (`maCanBo`, `hoTen`, `ngaySinh`, `gioiTinh`, `maChucVu`, `phong`, `maChuyenNganh`, `maKhoa`) VALUES
('1', 'Nguyễn Cẩm Ngọc', '1985-02-03', 1, '4', '401', '1', '1'),
('2', 'Đào Quốc Trường', '2012-07-26', 2, '2', '203', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE IF NOT EXISTS `chucvu` (
  `maChucVu` varchar(10) NOT NULL,
  `ten` varchar(45) DEFAULT NULL,
  `moTa` text,
  PRIMARY KEY (`maChucVu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`maChucVu`, `ten`, `moTa`) VALUES
('1', 'Chủ nhiệm khoa', NULL),
('2', 'Phó chủ nhiệm khoa', NULL),
('3', 'Giảng viên', NULL),
('4', 'Nghiên cứu sinh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE IF NOT EXISTS `chuyennganh` (
  `maChuyenNganh` varchar(10) NOT NULL,
  `ten` varchar(30) DEFAULT NULL,
  `soCanBo` smallint(6) DEFAULT NULL,
  `maKhoa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`maChuyenNganh`),
  KEY `chuyenNganh_maKhoa` (`maKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`maChuyenNganh`, `ten`, `soCanBo`, `maKhoa`) VALUES
('1', 'Khoa học máy tính', 10, '1'),
('2', 'Công nghệ phần mềm', 10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `diemrenluyen`
--

CREATE TABLE IF NOT EXISTS `diemrenluyen` (
  `maSV` varchar(10) NOT NULL,
  `hocKy` varchar(4) NOT NULL,
  `nam` year(4) NOT NULL,
  `diem` smallint(6) DEFAULT NULL,
  `loai` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`maSV`,`hocKy`,`nam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ketquahoctap`
--

CREATE TABLE IF NOT EXISTS `ketquahoctap` (
  `maSV` varchar(10) NOT NULL,
  `maLMH` varchar(10) NOT NULL,
  `diemSo` float DEFAULT NULL,
  `diemChu` varchar(3) DEFAULT NULL,
  `ghiChu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`maSV`,`maLMH`),
  KEY `ketQuaHocTap_maLMH` (`maLMH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ketquahoctap`
--

INSERT INTO `ketquahoctap` (`maSV`, `maLMH`, `diemSo`, `diemChu`, `ghiChu`) VALUES
('100201', 'INT2201 1', 9.2, 'A', 'Exellent'),
('100201', 'MAT1095 1', 10, 'A', 'Exellent'),
('100201', 'MAT1099 3', 9.7, 'A', 'Exellent'),
('100202', 'MAT1095 1', 9.2, 'A', 'Exellent'),
('100202', 'MAT1099 3', 9.7, 'A', 'Exellent');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE IF NOT EXISTS `khoa` (
  `MaKhoa` varchar(10) NOT NULL,
  `Ten` varchar(30) DEFAULT NULL,
  `SoCanBo` int(11) DEFAULT NULL,
  `MoTa` text,
  PRIMARY KEY (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `Ten`, `SoCanBo`, `MoTa`) VALUES
('1', 'Công Nghệ Tông Tin', 10, 'Vô đối'),
('2', 'Điện tử viễn thông', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE IF NOT EXISTS `lop` (
  `maLop` varchar(15) NOT NULL,
  `ten` varchar(30) DEFAULT NULL,
  `soSV` smallint(6) DEFAULT NULL,
  `chuNhiem` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`maLop`),
  KEY `lop_chuNhiem` (`chuNhiem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`maLop`, `ten`, `soSV`, `chuNhiem`) VALUES
('k55cb', 'K55CB', 91, '1'),
('k55cd', 'K55CD', 91, '2');

-- --------------------------------------------------------

--
-- Table structure for table `lopmonhoc`
--

CREATE TABLE IF NOT EXISTS `lopmonhoc` (
  `maLMH` varchar(10) NOT NULL,
  `maMonHoc` varchar(10) DEFAULT NULL,
  `hocKy` varchar(3) NOT NULL,
  `nam` varchar(5) NOT NULL,
  `soSV` smallint(6) DEFAULT NULL,
  `giangVien` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`maLMH`,`hocKy`,`nam`),
  KEY `lopMonHoc_maMonHoc` (`maMonHoc`),
  KEY `lopMonHoc_giangVien` (`giangVien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lopmonhoc`
--

INSERT INTO `lopmonhoc` (`maLMH`, `maMonHoc`, `hocKy`, `nam`, `soSV`, `giangVien`) VALUES
('INT2201 1', 'INT2201', '2', '2012', 90, '2'),
('MAT1095 1', 'MAT1095', '1', '2012', 90, '1'),
('MAT1099 3', 'MAT1099', '1', '2012', 91, '2');

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE IF NOT EXISTS `monhoc` (
  `maMonHoc` varchar(10) NOT NULL,
  `ten` varchar(30) DEFAULT NULL,
  `soTinChi` int(11) DEFAULT NULL,
  `tienQuyet` varchar(10) DEFAULT NULL,
  `soTietHoc` int(11) DEFAULT NULL,
  PRIMARY KEY (`maMonHoc`),
  KEY `monHoc_tienQuyet` (`tienQuyet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`maMonHoc`, `ten`, `soTinChi`, `tienQuyet`, `soTietHoc`) VALUES
('INT2201', 'Tin học cơ sở 1', 3, NULL, 3),
('MAT1095', 'Giải tích 1', 5, NULL, 5),
('MAT1099', 'Toán rời rạc', 4, 'MAT1095', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE IF NOT EXISTS `sinhvien` (
  `maSinhVien` varchar(10) NOT NULL,
  `hoTen` varchar(30) DEFAULT NULL,
  `maLop` varchar(10) DEFAULT NULL,
  `coVanHocTap` varchar(10) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `gioiTinh` tinyint(1) DEFAULT NULL,
  `queQuan` varchar(50) DEFAULT NULL,
  `hoKhauTT` varchar(50) DEFAULT NULL,
  `khoas` varchar(4) DEFAULT NULL,
  `maChuyenNganh` varchar(10) DEFAULT NULL,
  `maKhoa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`maSinhVien`),
  KEY `sinhVien_coVanHocTap` (`coVanHocTap`),
  KEY `sinhVien_maLop` (`maLop`),
  KEY `sinhVien_maChuyenNganh` (`maChuyenNganh`),
  KEY `sinhVien_maKhoa` (`maKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`maSinhVien`, `hoTen`, `maLop`, `coVanHocTap`, `ngaySinh`, `gioiTinh`, `queQuan`, `hoKhauTT`, `khoas`, `maChuyenNganh`, `maKhoa`) VALUES
('100201', 'Cù Trọng Xoay', 'k55cb', '1', '2013-05-16', 1, 'Hà Nội', 'Hà Nội', '2010', '1', '2'),
('100202', 'Lưu Diệp Phi', 'k55cd', '2', '2012-07-26', 2, 'Hà Tây', 'Hà Nam', '2009', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '123456'),
('hero', 'hero');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `canBo_maChucVu` FOREIGN KEY (`maChucVu`) REFERENCES `chucvu` (`maChucVu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `canBo_maChuyenNganh` FOREIGN KEY (`maChuyenNganh`) REFERENCES `chuyennganh` (`maChuyenNganh`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `canBo_maKhoa` FOREIGN KEY (`maKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD CONSTRAINT `chuyenNganh_maKhoa` FOREIGN KEY (`maKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `diemrenluyen`
--
ALTER TABLE `diemrenluyen`
  ADD CONSTRAINT `diemRenLuyen_maSV` FOREIGN KEY (`maSV`) REFERENCES `sinhvien` (`maSinhVien`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ketquahoctap`
--
ALTER TABLE `ketquahoctap`
  ADD CONSTRAINT `ketQuaHocTap_maSV` FOREIGN KEY (`maSV`) REFERENCES `sinhvien` (`maSinhVien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ketQuaHocTap_maLMH` FOREIGN KEY (`maLMH`) REFERENCES `lopmonhoc` (`maLMH`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_chuNhiem` FOREIGN KEY (`chuNhiem`) REFERENCES `canbo` (`maCanBo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lopmonhoc`
--
ALTER TABLE `lopmonhoc`
  ADD CONSTRAINT `lopMonHoc_maMonHoc` FOREIGN KEY (`maMonHoc`) REFERENCES `monhoc` (`maMonHoc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lopMonHoc_giangVien` FOREIGN KEY (`giangVien`) REFERENCES `canbo` (`maCanBo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhVien_coVanHocTap` FOREIGN KEY (`coVanHocTap`) REFERENCES `canbo` (`maCanBo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sinhVien_maLop` FOREIGN KEY (`maLop`) REFERENCES `lop` (`maLop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sinhVien_maChuyenNganh` FOREIGN KEY (`maChuyenNganh`) REFERENCES `chuyennganh` (`maChuyenNganh`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sinhVien_maKhoa` FOREIGN KEY (`maKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
