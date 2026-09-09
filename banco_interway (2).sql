-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Set-2026 às 17:26
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
-- Banco de dados: `banco_interway`
--
CREATE DATABASE IF NOT EXISTS `banco_interway` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banco_interway`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliação`
--

CREATE TABLE `avaliação` (
  `id_avaliacao` int(11) NOT NULL,
  `num_estrelas` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bolsa_estudo`
--

CREATE TABLE `bolsa_estudo` (
  `id_bolsa` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `percentual_desconto` decimal(5,2) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bolsa_estudo`
--

INSERT INTO `bolsa_estudo` (`id_bolsa`, `nome`, `descricao`, `percentual_desconto`, `data_inicio`, `data_fim`, `id_curso`) VALUES
(1, 'Bolsa InterWay Canadá', 'Bolsa destinada a estudantes interessados em estudar no Canadá.', '999.99', '2026-01-01', '2026-06-30', NULL),
(2, 'Bolsa Europa Acadêmica', 'Auxílio financeiro para estudantes que desejam realizar intercâmbio na Europa.', '999.99', '2026-02-01', '2026-07-31', NULL),
(3, 'Bolsa Global de Tecnologia', 'Bolsa para estudantes da área de tecnologia e computação.', '999.99', '2026-03-01', '2026-08-31', NULL),
(4, 'Bolsa Novos Horizontes', 'Programa de apoio para estudantes que realizarão intercâmbio internacional.', '999.99', '2026-04-01', '2026-09-30', NULL),
(5, 'Bolsa Excelência Acadêmica', 'Bolsa destinada a estudantes com excelente desempenho acadêmico.', '999.99', '2026-05-01', '2026-10-31', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `assunto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `chat`
--

INSERT INTO `chat` (`id_chat`, `assunto`) VALUES
(1, 'Dúvidas sobre intercâmbio'),
(2, 'Bolsas de estudo'),
(3, 'Documentação necessária'),
(4, 'Escolha de país'),
(5, 'Informações sobre cursos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentário`
--

CREATE TABLE `comentário` (
  `id_chat` int(11) NOT NULL,
  `assunto` varchar(255) DEFAULT NULL,
  `id_postagem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `instituicao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `titulo`, `instituicao`) VALUES
(1, 'Engenharia de Software', 'Universidade de Toronto'),
(2, 'Administração', 'Universidade de Lisboa'),
(3, 'Ciência da Computação', 'Universidade de Melbourne'),
(4, 'Relações Internacionais', 'Universidade de Barcelona'),
(5, 'Arquitetura', 'Universidade de Roma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolhe`
--

CREATE TABLE `escolhe` (
  `id_pais` int(11) DEFAULT NULL,
  `id_inscricao` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escreve`
--

CREATE TABLE `escreve` (
  `id_chat` int(11) DEFAULT NULL,
  `senha` varchar(10) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `faz`
--

CREATE TABLE `faz` (
  `id_inscricao` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `senha` varchar(10) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscrição`
--

CREATE TABLE `inscrição` (
  `id_inscricao` int(11) NOT NULL,
  `data_inscricao` date DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `inscrição`
--

INSERT INTO `inscrição` (`id_inscricao`, `data_inscricao`, `id_tipo`, `nome`) VALUES
(1, '2026-01-15', 1, 'Intercâmbio acadêmico'),
(2, '2026-02-10', 2, 'Graduação no exterior'),
(3, '2026-03-05', 1, 'Intercâmbio acadêmico'),
(4, '2026-04-20', 3, 'Curso de idiomas'),
(5, '2026-05-12', 2, 'Graduação no exterior');

-- --------------------------------------------------------

--
-- Estrutura da tabela `país`
--

CREATE TABLE `país` (
  `id_pais` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `continente` varchar(255) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem_blog`
--

CREATE TABLE `postagem_blog` (
  `id_postagem` int(11) NOT NULL,
  `tipo_postagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recebe`
--

CREATE TABLE `recebe` (
  `id_inscricao` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_bolsa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuário`
--

CREATE TABLE `usuário` (
  `senha` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `id_avaliacao` int(11) DEFAULT NULL,
  `id_chat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliação`
--
ALTER TABLE `avaliação`
  ADD PRIMARY KEY (`id_avaliacao`);

--
-- Índices para tabela `bolsa_estudo`
--
ALTER TABLE `bolsa_estudo`
  ADD PRIMARY KEY (`id_bolsa`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Índices para tabela `comentário`
--
ALTER TABLE `comentário`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_postagem` (`id_postagem`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `escolhe`
--
ALTER TABLE `escolhe`
  ADD KEY `id_pais` (`id_pais`),
  ADD KEY `id_inscricao` (`id_inscricao`,`id_tipo`);

--
-- Índices para tabela `escreve`
--
ALTER TABLE `escreve`
  ADD KEY `id_chat` (`id_chat`),
  ADD KEY `senha` (`senha`,`id_usuario`);

--
-- Índices para tabela `faz`
--
ALTER TABLE `faz`
  ADD KEY `id_inscricao` (`id_inscricao`,`id_tipo`),
  ADD KEY `senha` (`senha`,`id_usuario`);

--
-- Índices para tabela `inscrição`
--
ALTER TABLE `inscrição`
  ADD PRIMARY KEY (`id_inscricao`,`id_tipo`);

--
-- Índices para tabela `país`
--
ALTER TABLE `país`
  ADD PRIMARY KEY (`id_pais`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `postagem_blog`
--
ALTER TABLE `postagem_blog`
  ADD PRIMARY KEY (`id_postagem`);

--
-- Índices para tabela `recebe`
--
ALTER TABLE `recebe`
  ADD PRIMARY KEY (`id_inscricao`,`id_tipo`,`id_bolsa`),
  ADD KEY `id_bolsa` (`id_bolsa`);

--
-- Índices para tabela `usuário`
--
ALTER TABLE `usuário`
  ADD PRIMARY KEY (`senha`,`id_usuario`),
  ADD KEY `id_avaliacao` (`id_avaliacao`),
  ADD KEY `id_chat` (`id_chat`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bolsa_estudo`
--
ALTER TABLE `bolsa_estudo`
  ADD CONSTRAINT `bolsa_estudo_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Limitadores para a tabela `comentário`
--
ALTER TABLE `comentário`
  ADD CONSTRAINT `comentário_ibfk_1` FOREIGN KEY (`id_postagem`) REFERENCES `postagem_blog` (`id_postagem`);

--
-- Limitadores para a tabela `escolhe`
--
ALTER TABLE `escolhe`
  ADD CONSTRAINT `escolhe_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `país` (`id_pais`),
  ADD CONSTRAINT `escolhe_ibfk_2` FOREIGN KEY (`id_inscricao`,`id_tipo`) REFERENCES `inscrição` (`id_inscricao`, `id_tipo`);

--
-- Limitadores para a tabela `escreve`
--
ALTER TABLE `escreve`
  ADD CONSTRAINT `escreve_ibfk_1` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`),
  ADD CONSTRAINT `escreve_ibfk_2` FOREIGN KEY (`senha`,`id_usuario`) REFERENCES `usuário` (`senha`, `id_usuario`);

--
-- Limitadores para a tabela `faz`
--
ALTER TABLE `faz`
  ADD CONSTRAINT `faz_ibfk_1` FOREIGN KEY (`id_inscricao`,`id_tipo`) REFERENCES `inscrição` (`id_inscricao`, `id_tipo`),
  ADD CONSTRAINT `faz_ibfk_2` FOREIGN KEY (`senha`,`id_usuario`) REFERENCES `usuário` (`senha`, `id_usuario`);

--
-- Limitadores para a tabela `país`
--
ALTER TABLE `país`
  ADD CONSTRAINT `país_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Limitadores para a tabela `recebe`
--
ALTER TABLE `recebe`
  ADD CONSTRAINT `recebe_ibfk_1` FOREIGN KEY (`id_inscricao`,`id_tipo`) REFERENCES `inscrição` (`id_inscricao`, `id_tipo`),
  ADD CONSTRAINT `recebe_ibfk_2` FOREIGN KEY (`id_bolsa`) REFERENCES `bolsa_estudo` (`id_bolsa`);

--
-- Limitadores para a tabela `usuário`
--
ALTER TABLE `usuário`
  ADD CONSTRAINT `usuário_ibfk_1` FOREIGN KEY (`id_avaliacao`) REFERENCES `avaliação` (`id_avaliacao`),
  ADD CONSTRAINT `usuário_ibfk_2` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
