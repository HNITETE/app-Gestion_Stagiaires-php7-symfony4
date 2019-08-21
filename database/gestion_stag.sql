-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 21, 2019 at 11:30 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_stag`
--

-- --------------------------------------------------------

--
-- Table structure for table `assister`
--

DROP TABLE IF EXISTS `assister`;
CREATE TABLE IF NOT EXISTS `assister` (
  `CODESE` int(11) NOT NULL,
  `CODEST` int(11) NOT NULL,
  PRIMARY KEY (`CODESE`,`CODEST`),
  KEY `IDX_31849FA517AA2D30` (`CODESE`),
  KEY `IDX_31849FA57D1A0DC2` (`CODEST`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `controler`
--

DROP TABLE IF EXISTS `controler`;
CREATE TABLE IF NOT EXISTS `controler` (
  `CODEST` int(11) NOT NULL,
  `CODEEX` int(11) NOT NULL,
  PRIMARY KEY (`CODEST`,`CODEEX`),
  KEY `IDX_C60D8AFB7D1A0DC2` (`CODEST`),
  KEY `IDX_C60D8AFB6834F43E` (`CODEEX`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `CODEEX` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_SE` int(11) DEFAULT NULL,
  `DATEEX` date DEFAULT NULL,
  `TYPEEX` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CODEEX`),
  UNIQUE KEY `EXAMEN_PK` (`CODEEX`),
  KEY `PASSER_FK` (`CODE_SE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`CODEEX`, `CODE_SE`, `DATEEX`, `TYPEEX`) VALUES
(1, 56, '2019-05-07', 'efm');

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `CODEGR` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLEGR` varchar(255) DEFAULT NULL,
  `NIVEAUXGR` varchar(255) DEFAULT NULL,
  `ANNEESCOGR` varchar(250) DEFAULT NULL,
  `FILLIEREGR` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODEGR`),
  UNIQUE KEY `GROUPE_PK` (`CODEGR`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`CODEGR`, `LIBELLEGR`, `NIVEAUXGR`, `ANNEESCOGR`, `FILLIEREGR`) VALUES
(127, 'tdm', '202', '2017/2018', 'fgdfhdgh'),
(128, 'tdm201', '2eme anne', '2019/2012', 'multimedia'),
(129, 'tmsir', '2eme anne', '2019/2012', 'temsir'),
(130, 'tdi', '2eme anne', '2019/2020', 'informatique'),
(135, NULL, NULL, NULL, NULL),
(136, 'tmsir', '2eme anne', '2019/2012', 'multimedia'),
(137, 'tdm101', '1ere anne', '2019/2012', 'multimedia'),
(138, 'tmsir', '1ere anne', '2019/2020', 'temsir'),
(139, 'reseau', '2eme anne', '2019/2012', 'reseau');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190308104205', '2019-03-08 10:42:51'),
('20190308104612', '2019-03-08 10:46:21'),
('20190308110917', '2019-03-08 11:09:24'),
('20190530113354', '2019-05-30 11:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `CODEMO` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLEMO` varchar(255) DEFAULT NULL,
  `DATEMO` varchar(100) NOT NULL,
  `MASSEHMO` int(11) DEFAULT NULL,
  `DESCMO` varchar(255) DEFAULT NULL,
  `CODEGR` int(11) DEFAULT NULL,
  PRIMARY KEY (`CODEMO`),
  UNIQUE KEY `MODULE_PK` (`CODEMO`),
  KEY `IDX_C242628BAD77FA2` (`CODEGR`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`CODEMO`, `LIBELLEMO`, `DATEMO`, `MASSEHMO`, `DESCMO`, `CODEGR`) VALUES
(27, 'php', 'September 18, 2017', 10, 'jhjkhkjhk', 127),
(28, 'js', 'September 18, 2017', 5, '.knlk', 127),
(29, 'php', '2019-05-03', NULL, 'php', 137),
(30, 'php', '2019-05-02', NULL, 'php', 137),
(31, 'php', '2019-05-01', NULL, 'hhh', 127);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `CODESE` int(11) NOT NULL AUTO_INCREMENT,
  `CODEMO` int(11) DEFAULT NULL,
  `DATESE` varchar(100) DEFAULT NULL,
  `HEUREDBSE` time DEFAULT NULL,
  `HEUREFNSE` time DEFAULT NULL,
  `RESMMESE` mediumtext,
  PRIMARY KEY (`CODESE`),
  UNIQUE KEY `SEANCE_PK` (`CODESE`),
  KEY `IDX_DF7DFD0E233EFBF1` (`CODEMO`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seance`
--

INSERT INTO `seance` (`CODESE`, `CODEMO`, `DATESE`, `HEUREDBSE`, `HEUREFNSE`, `RESMMESE`) VALUES
(56, 27, 'September 18, 2017', '08:30:00', '13:00:00', 'hfgjhgk'),
(57, NULL, NULL, NULL, NULL, 'authentification users'),
(58, NULL, NULL, NULL, NULL, 'php'),
(59, NULL, NULL, NULL, NULL, 'aaaa'),
(60, 31, NULL, NULL, NULL, 'inscription'),
(65, 28, '2019-05-31', NULL, NULL, 'declare var'),
(66, NULL, '2019-05-03', NULL, NULL, 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `CODEST` int(11) NOT NULL AUTO_INCREMENT,
  `CODEGR` int(11) DEFAULT NULL,
  `NOMST` varchar(255) DEFAULT NULL,
  `PRENOMST` varchar(255) DEFAULT NULL,
  `DATENSST` date DEFAULT NULL,
  `SEXEST` varchar(30) DEFAULT NULL,
  `Email` varchar(250) NOT NULL,
  `Phone` int(11) NOT NULL,
  `CIN` varchar(20) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`CODEST`),
  UNIQUE KEY `STAGIAIRE_PK` (`CODEST`),
  KEY `APPARTENIR_FK` (`CODEGR`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`CODEST`, `CODEGR`, `NOMST`, `PRENOMST`, `DATENSST`, `SEXEST`, `Email`, `Phone`, `CIN`, `pic`) VALUES
(1, 127, 'wazani', 'imane', '2020-07-12', 'Femme', 'wazani@dsfsd.cv', 222222, 'cd0000', 'C:\\wamp64\\tmp\\phpF255.tmp'),
(10, 128, 'tenah', 'omar', '2014-01-01', 'homme', 'tennah@gmail.colm', 356985471, 'cd1285', 'C:\\wamp64\\tmp\\phpABC9.tmp'),
(13, 136, 'hnitete', 'mohammed', NULL, 'homme', 'mohammed.hnitete@gmail.com', 312547895, 'cdfdff', 'eff_tdm_2018_v21_p15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `full_name`, `description`, `img`) VALUES
(22, 'hnitete', 'hnitete@gmail.com', '$2y$13$zivw2TZFPB77v/cihEE3D.6FzggNimwH4bnTy728wCgJBVibz7KVW', 'hnitete med', 'stagiaire', 'hnitete.png'),
(23, 'toto', 'toto@gmail.com', '$2y$13$ZnRcU44XqEm.6gBgilHvrOtL9WP45zfAI1v9oa8I1q/B9mLLZDk7C', 'toto', 'stagiaire', 'toto.png'),
(24, 'toto', 'tototo@gmail.com', '$2y$13$MGNVMkQ7mgnqQvpZtN7dIuDBJlo/Yp8mvlt8OzRjg2G0F4Zm7xH8S', 'toto', 'stagiaire', 'C:\\wamp64\\tmp\\php8D60.tmp'),
(25, 'hnitete', 'hnitete.2@gmail.com', '$2y$13$jdc7S5Gsu5i.Tq9Mk5oMle6KeU.mpApTjVm2VqCH2KvXgUBuEo0Cy', 'hnitete med', 'stagiaire', 'C:\\wamp64\\tmp\\phpBAC7.tmp'),
(26, 'achraf', 'hnitete123@gmail.com', '$2y$13$GJCuGXgqxucWKusIJcJZpuewkDrRlMgfIpMwzo3EV18Vnlhi2A55q', 'achraf ali', 'stagiaire', 'C:\\wamp64\\tmp\\phpD4F.tmp');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assister`
--
ALTER TABLE `assister`
  ADD CONSTRAINT `FK_31849FA517AA2D30` FOREIGN KEY (`CODESE`) REFERENCES `seance` (`CODESE`),
  ADD CONSTRAINT `FK_31849FA57D1A0DC2` FOREIGN KEY (`CODEST`) REFERENCES `stagiaire` (`CODEST`);

--
-- Constraints for table `controler`
--
ALTER TABLE `controler`
  ADD CONSTRAINT `FK_C60D8AFB6834F43E` FOREIGN KEY (`CODEEX`) REFERENCES `examen` (`CODEEX`),
  ADD CONSTRAINT `FK_C60D8AFB7D1A0DC2` FOREIGN KEY (`CODEST`) REFERENCES `stagiaire` (`CODEST`);

--
-- Constraints for table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `FK_514C8FECE7F88CA0` FOREIGN KEY (`CODE_SE`) REFERENCES `seance` (`CODESE`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_C242628BAD77FA2` FOREIGN KEY (`CODEGR`) REFERENCES `groupe` (`CODEGR`);

--
-- Constraints for table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `FK_DF7DFD0E233EFBF1` FOREIGN KEY (`CODEMO`) REFERENCES `module` (`CODEMO`);

--
-- Constraints for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `FK_4F62F731BAD77FA2` FOREIGN KEY (`CODEGR`) REFERENCES `groupe` (`CODEGR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
