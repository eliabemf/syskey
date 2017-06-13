-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Maio-2017 às 16:56
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controlechaves`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chaves`
--

CREATE TABLE `chaves` (
  `idchave` int(11) NOT NULL,
  `chave` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chaves`
--

INSERT INTO `chaves` (`idchave`, `chave`, `status`, `descricao`) VALUES
(15, '123', 0, '123'),
(16, '123', 0, '123'),
(17, '123', 0, '123'),
(18, '123', 0, '123'),
(19, 'das', 1, 'asd'),
(20, 'qwe', 0, 'qwe'),
(21, '202', 0, 'Shafit');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--

CREATE TABLE `locacao` (
  `idLoc` int(11) NOT NULL,
  `idChave` int(11) NOT NULL,
  `nomeLocador` varchar(255) NOT NULL,
  `horaPeg` datetime NOT NULL,
  `horaDev` datetime DEFAULT NULL,
  `usuarioPeg` varchar(255) DEFAULT NULL,
  `usuarioDev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `locacao`
--

INSERT INTO `locacao` (`idLoc`, `idChave`, `nomeLocador`, `horaPeg`, `horaDev`, `usuarioPeg`, `usuarioDev`) VALUES
(1, 19, 'sdf', '2017-05-02 07:45:42', NULL, 'Willame Soares', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `loglocacao`
--

CREATE TABLE `loglocacao` (
  `idLog` int(11) NOT NULL,
  `idChave` int(11) NOT NULL,
  `nomeLoc` varchar(255) NOT NULL,
  `hora` datetime NOT NULL,
  `acao` varchar(255) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logusuario`
--

CREATE TABLE `logusuario` (
  `idLogUsuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `hora` datetime NOT NULL,
  `acao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuarios` varchar(255) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `permissao` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuarios`, `senha`, `permissao`, `nome`) VALUES
('lab', '123', 1, 'Eliabe Felix'),
('will', '123', 2, 'Willame Soares');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chaves`
--
ALTER TABLE `chaves`
  ADD PRIMARY KEY (`idchave`);

--
-- Indexes for table `locacao`
--
ALTER TABLE `locacao`
  ADD PRIMARY KEY (`idLoc`);

--
-- Indexes for table `logusuario`
--
ALTER TABLE `logusuario`
  ADD PRIMARY KEY (`idLogUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarios`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chaves`
--
ALTER TABLE `chaves`
  MODIFY `idchave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `locacao`
--
ALTER TABLE `locacao`
  MODIFY `idLoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logusuario`
--
ALTER TABLE `logusuario`
  MODIFY `idLogUsuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
