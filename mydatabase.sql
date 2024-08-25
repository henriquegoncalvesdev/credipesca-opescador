-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2024 at 09:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `data_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`id`, `cliente_id`, `nome_arquivo`, `caminho_arquivo`, `data_upload`) VALUES
(1, 1, 'logo.png', 'uploads/logo.png', '2024-08-23 19:03:20'),
(2, 1, 'brunomars.png', 'uploads/brunomars.png', '2024-08-23 19:21:54'),
(3, 1, 'brunomars.jpg', 'uploads/brunomars.jpg', '2024-08-23 19:28:18'),
(4, 1, 'brunomars.png', 'uploads/brunomars.png', '2024-08-23 19:28:18'),
(5, 3, 'WhatsApp Image 2024-08-23 at 3.14.04 PM.jpeg', 'uploads/WhatsApp Image 2024-08-23 at 3.14.04 PM.jpeg', '2024-08-23 19:34:45'),
(6, 3, 'Week 4 - Source Comparison Activity.docx', 'uploads/Week 4 - Source Comparison Activity.docx', '2024-08-23 19:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `phpdata`
--

CREATE TABLE `phpdata` (
  `id` int(11) NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telNumber` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cpf` varchar(200) DEFAULT NULL,
  `rg` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `certificado` varchar(255) DEFAULT NULL,
  `estadoCivil` varchar(100) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `modalidade` varchar(255) DEFAULT NULL,
  `produtos` varchar(255) DEFAULT NULL,
  `embarcacoes` varchar(255) DEFAULT NULL,
  `despachante` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phpdata`
--

INSERT INTO `phpdata` (`id`, `fName`, `lName`, `email`, `telNumber`, `address`, `cpf`, `rg`, `dob`, `certificado`, `estadoCivil`, `empresa`, `modalidade`, `produtos`, `embarcacoes`, `despachante`, `created_at`) VALUES
(1, 't', 't', 't@test.com', '123', 't', '123', '123', '2024-08-19', 'as', 'as', 'as', 'as', 'as', 'as', 'as', '2024-08-19 22:31:11'),
(2, 'Jose', 'silva', 'silva@test.com', '1233', 'teste', '123', '123', '1980-01-10', '123', 'Casado', 'Pescadosd', 'Arrasto Duplo', 'Camarao', 'Jose 1', 'Test', '2024-08-19 22:37:42'),
(3, 'Gustavo', 'Mentanis', 'test@tes.com', '123', 'rua 1', '123', '123', '1999-01-28', 'sim', 'casado', 'pescados', 'pesca', 'camarao', 'grego', 'test', '2024-08-23 19:33:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `phpdata`
--
ALTER TABLE `phpdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phpdata`
--
ALTER TABLE `phpdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `phpdata` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
