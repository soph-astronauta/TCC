-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Ago-2026 às 15:03
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bolsas`
--

CREATE TABLE `bolsas` (
  `id` int(11) NOT NULL,
  `universidade` varchar(200) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(500) DEFAULT NULL,
  `site_oficial` varchar(500) NOT NULL,
  `nome_bolsa` varchar(200) DEFAULT NULL,
  `nivel` varchar(100) DEFAULT NULL,
  `area` varchar(150) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bolsas`
--

INSERT INTO `bolsas` (`id`, `universidade`, `pais`, `descricao`, `imagem`, `site_oficial`, `nome_bolsa`, `nivel`, `area`, `data_criacao`) VALUES
(1, 'Harvard University', 'EUA', 'Bolsas integrais para graduação e pós-graduação.', 'https://images.unsplash.com/photo-1562774053-701939374585?w=1200', 'https://www.harvard.edu', 'Bolsas de estudo internacionais', 'Graduação e Pós-graduação', 'Diversas áreas', '2026-08-31 12:30:11'),
(2, 'University of Oxford', 'Reino Unido', 'Bolsa Rhodes e programas internacionais.', 'https://images.unsplash.com/photo-1564981797816-1043664bf78d?w=1200', 'https://www.ox.ac.uk', 'Rhodes Scholarship', 'Pós-graduação', 'Diversas áreas', '2026-08-31 12:30:11'),
(3, 'University of Toronto', 'Canadá', 'Bolsa Lester B. Pearson para estudantes internacionais.', 'img/unive_toronto.jpg', 'https://www.utoronto.ca', 'Lester B. Pearson', 'Graduação', 'Diversas áreas', '2026-08-31 12:30:11'),
(4, 'University of Melbourne', 'Austrália', 'Bolsas para graduação e pesquisa internacional.', 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?w=1200', 'https://www.unimelb.edu.au', 'Bolsas Internacionais', 'Graduação e Pós-graduação', 'Diversas áreas', '2026-08-31 12:30:11');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bolsas`
--
ALTER TABLE `bolsas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bolsas`
--
ALTER TABLE `bolsas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
