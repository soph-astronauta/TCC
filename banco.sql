-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Ago-2026 às 15:05
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
CREATE DATABASE IF NOT EXISTS `banco` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banco`;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id` int(11) NOT NULL,
  `postagem_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_curtida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens_chat`
--

CREATE TABLE `mensagens_chat` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `resposta` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagens`
--

CREATE TABLE `postagens` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(500) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reacoes`
--

CREATE TABLE `reacoes` (
  `id` int(11) NOT NULL,
  `postagem_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `data_reacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bolsas`
--
ALTER TABLE `bolsas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `postagem_id` (`postagem_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `mensagens_chat`
--
ALTER TABLE `mensagens_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `postagens`
--
ALTER TABLE `postagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `reacoes`
--
ALTER TABLE `reacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `postagem_id` (`postagem_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bolsas`
--
ALTER TABLE `bolsas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens_chat`
--
ALTER TABLE `mensagens_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagens`
--
ALTER TABLE `postagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reacoes`
--
ALTER TABLE `reacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`postagem_id`) REFERENCES `postagens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `mensagens_chat`
--
ALTER TABLE `mensagens_chat`
  ADD CONSTRAINT `mensagens_chat_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `postagens`
--
ALTER TABLE `postagens`
  ADD CONSTRAINT `postagens_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `reacoes`
--
ALTER TABLE `reacoes`
  ADD CONSTRAINT `reacoes_ibfk_1` FOREIGN KEY (`postagem_id`) REFERENCES `postagens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reacoes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
