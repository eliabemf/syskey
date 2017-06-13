-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Maio-2017 às 15:20
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
(19, 'das', 0, 'asd'),
(20, 'qwe', 0, 'qwe'),
(22, '33', 0, '12ffff'),
(23, '435', 0, '112fds'),
(24, '665', 0, '3erdft'),
(25, '109', 0, '3ed'),
(26, '190-b', 0, 'fse'),
(27, 'df', 0, 'sdf'),
(28, '111', 0, '1111');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--

CREATE TABLE `locacao` (
  `codLoc` int(11) NOT NULL,
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

INSERT INTO `locacao` (`codLoc`, `idChave`, `nomeLocador`, `horaPeg`, `horaDev`, `usuarioPeg`, `usuarioDev`) VALUES
(15, 18, 'asdas', '2017-05-02 14:06:44', '2017-05-02 14:06:47', 'Willame Soares', 'Willame Soares'),
(16, 17, 'asdas', '2017-05-02 14:07:17', '2017-05-02 14:09:59', 'Willame Soares', 'Willame Soares'),
(17, 18, 'asdas', '2017-05-02 14:07:17', '2017-05-02 14:10:05', 'Willame Soares', 'Willame Soares'),
(18, 17, 'ELIA', '2017-05-02 14:10:15', '2017-05-02 14:10:19', 'Willame Soares', 'Willame Soares'),
(19, 17, 'Div', '2017-05-02 14:10:30', '2017-05-02 14:10:35', 'Willame Soares', 'Willame Soares'),
(20, 21, 'sdfsd', '2017-05-02 14:12:33', '2017-05-02 14:12:37', 'Willame Soares', 'Willame Soares'),
(21, 15, 'asdfjk', '2017-05-02 14:15:37', '2017-05-02 14:15:42', 'Willame Soares', 'Willame Soares'),
(22, 19, 'sdf', '2017-05-02 14:16:18', '2017-05-02 14:16:22', 'Willame Soares', 'Willame Soares'),
(23, 17, 'sdf', '2017-05-02 14:25:49', '2017-05-02 14:25:52', 'Willame Soares', 'Willame Soares'),
(24, 16, 'werw', '2017-05-02 14:26:21', '2017-05-02 14:26:30', 'Willame Soares', 'Willame Soares'),
(25, 16, 'sdf', '2017-05-02 14:26:57', '2017-05-02 14:26:59', 'Willame Soares', 'Willame Soares'),
(26, 16, 'dfvfdv', '2017-05-02 14:48:20', '2017-05-02 14:48:53', 'Willame Soares', 'Willame Soares'),
(27, 19, 'Eliabe', '2017-05-02 14:49:24', '2017-05-02 14:49:32', 'Willame Soares', 'Willame Soares'),
(28, 17, 'qwe', '2017-05-02 14:50:48', '2017-05-02 14:51:00', 'Eliabe Felix', 'Eliabe Felix'),
(29, 19, 'Atila', '2017-05-02 15:12:20', '2017-05-02 15:12:33', 'Eliabe Felix', 'Eliabe Felix'),
(30, 21, 'Jana', '2017-05-02 15:12:50', '2017-05-02 15:13:00', 'Eliabe Felix', 'Eliabe Felix'),
(31, 19, 'Jana', '2017-05-02 15:12:51', '2017-05-02 15:13:01', 'Eliabe Felix', 'Eliabe Felix'),
(32, 20, 'Jana', '2017-05-02 15:12:51', '2017-05-02 15:13:08', 'Eliabe Felix', 'Eliabe Felix'),
(33, 17, 'adas', '2017-05-05 15:40:05', '2017-05-05 15:59:58', 'Eliabe Felix', 'Eliabe Felix'),
(34, 18, 'adas', '2017-05-05 15:40:06', '2017-05-05 15:59:58', 'Eliabe Felix', 'Eliabe Felix'),
(35, 23, 'Will', '2017-05-05 16:01:02', '2017-05-05 16:06:37', 'Eliabe Felix', 'Eliabe Felix'),
(36, 24, 'Will', '2017-05-05 16:01:02', '2017-05-05 16:06:38', 'Eliabe Felix', 'Eliabe Felix'),
(37, 19, 'Will', '2017-05-05 16:01:02', '2017-05-05 16:06:38', 'Eliabe Felix', 'Eliabe Felix'),
(38, 25, 'sdfsd', '2017-05-05 16:06:44', '2017-05-05 16:17:59', 'Eliabe Felix', 'Eliabe Felix'),
(39, 26, 'sdfsd', '2017-05-05 16:06:44', '2017-05-05 16:17:59', 'Eliabe Felix', 'Eliabe Felix'),
(40, 22, 'sdfsd', '2017-05-05 16:06:44', '2017-05-05 16:17:59', 'Eliabe Felix', 'Eliabe Felix'),
(41, 23, 'sdfsd', '2017-05-05 16:06:45', '2017-05-05 16:17:59', 'Eliabe Felix', 'Eliabe Felix'),
(42, 25, 'asd', '2017-05-05 16:18:06', '2017-05-05 16:19:31', 'Eliabe Felix', 'Eliabe Felix'),
(43, 26, 'asd', '2017-05-05 16:18:07', '2017-05-05 16:19:32', 'Eliabe Felix', 'Eliabe Felix'),
(44, 22, 'asd', '2017-05-05 16:18:07', '2017-05-05 16:19:32', 'Eliabe Felix', 'Eliabe Felix'),
(45, 24, 'asd', '2017-05-05 16:18:07', '2017-05-05 16:19:32', 'Eliabe Felix', 'Eliabe Felix'),
(46, 25, 'dfs', '2017-05-05 16:19:37', '2017-05-05 16:20:08', 'Eliabe Felix', 'Eliabe Felix'),
(47, 26, 'dfs', '2017-05-05 16:19:37', '2017-05-05 16:20:08', 'Eliabe Felix', 'Eliabe Felix'),
(48, 22, 'dfs', '2017-05-05 16:19:37', '2017-05-05 16:20:08', 'Eliabe Felix', 'Eliabe Felix'),
(49, 23, 'dfs', '2017-05-05 16:19:37', '2017-05-05 16:20:09', 'Eliabe Felix', 'Eliabe Felix'),
(50, 25, 'qwe', '2017-05-05 16:20:14', '2017-05-05 16:21:50', 'Eliabe Felix', 'Eliabe Felix'),
(51, 26, 'qwe', '2017-05-05 16:20:14', '2017-05-05 16:21:50', 'Eliabe Felix', 'Eliabe Felix'),
(52, 25, 'Fsdf', '2017-05-05 16:21:56', '2017-05-05 16:22:21', 'Eliabe Felix', 'Eliabe Felix'),
(53, 26, 'Fsdf', '2017-05-05 16:21:56', '2017-05-05 16:22:21', 'Eliabe Felix', 'Eliabe Felix'),
(54, 22, 'Fsdf', '2017-05-05 16:21:56', '2017-05-05 16:22:21', 'Eliabe Felix', 'Eliabe Felix'),
(55, 23, 'Fsdf', '2017-05-05 16:21:56', '2017-05-05 16:22:21', 'Eliabe Felix', 'Eliabe Felix'),
(56, 25, 'sfsd', '2017-05-05 16:22:28', '2017-05-05 16:31:40', 'Eliabe Felix', 'Eliabe Felix'),
(57, 26, 'sfsd', '2017-05-05 16:22:29', '2017-05-05 16:31:40', 'Eliabe Felix', 'Eliabe Felix'),
(58, 22, 'sfsd', '2017-05-05 16:22:29', '2017-05-05 16:31:40', 'Eliabe Felix', 'Eliabe Felix'),
(59, 23, 'sfsd', '2017-05-05 16:22:29', '2017-05-05 16:31:41', 'Eliabe Felix', 'Eliabe Felix'),
(60, 25, 'dffff', '2017-05-05 16:31:46', '2017-05-05 16:38:33', 'Eliabe Felix', 'Eliabe Felix'),
(61, 26, 'dffff', '2017-05-05 16:31:46', '2017-05-05 16:38:34', 'Eliabe Felix', 'Eliabe Felix'),
(62, 22, 'dffff', '2017-05-05 16:31:47', '2017-05-05 16:38:34', 'Eliabe Felix', 'Eliabe Felix'),
(63, 25, 'Roberto', '2017-05-05 16:42:06', '2017-05-05 16:42:11', 'Eliabe Felix', 'Eliabe Felix'),
(64, 26, 'Roberto', '2017-05-05 16:42:07', '2017-05-05 16:46:55', 'Eliabe Felix', 'Willame Soares'),
(65, 22, 'Roberto', '2017-05-05 16:42:07', '2017-05-05 16:42:11', 'Eliabe Felix', 'Eliabe Felix'),
(66, 23, 'Roberto', '2017-05-05 16:42:07', '2017-05-05 16:42:11', 'Eliabe Felix', 'Eliabe Felix'),
(67, 24, 'Roberto', '2017-05-05 16:42:07', '2017-05-05 16:46:55', 'Eliabe Felix', 'Willame Soares'),
(68, 19, 'Roberto', '2017-05-05 16:42:07', '2017-05-05 16:46:55', 'Eliabe Felix', 'Willame Soares'),
(69, 20, 'Roberto', '2017-05-05 16:42:07', '2017-05-05 16:46:55', 'Eliabe Felix', 'Willame Soares'),
(70, 25, 'ELibae', '2017-05-17 09:26:15', '2017-05-17 09:26:36', 'Willame Soares', 'Willame Soares'),
(71, 26, 'ELibae', '2017-05-17 09:26:15', '2017-05-17 09:26:37', 'Willame Soares', 'Willame Soares'),
(72, 25, 'ELibae', '2017-05-17 09:26:19', '2017-05-17 09:26:36', 'Willame Soares', 'Willame Soares'),
(73, 26, 'ELibae', '2017-05-17 09:26:19', '2017-05-17 09:26:37', 'Willame Soares', 'Willame Soares'),
(74, 25, 'oi', '2017-05-17 09:26:42', '2017-05-17 09:26:55', 'Willame Soares', 'Willame Soares'),
(75, 26, 'oi', '2017-05-17 09:26:42', '2017-05-17 09:26:55', 'Willame Soares', 'Willame Soares'),
(76, 25, 'asd', '2017-05-17 09:27:17', '2017-05-17 09:27:21', 'Eliabe Felix', 'Eliabe Felix'),
(77, 26, 'asd', '2017-05-17 09:27:18', '2017-05-17 09:27:21', 'Eliabe Felix', 'Eliabe Felix'),
(78, 22, 'Erk', '2017-05-17 09:28:14', '2017-05-17 09:28:22', 'Eliabe Felix', 'Eliabe Felix'),
(79, 25, 'ty', '2017-05-17 09:33:18', '2017-05-17 09:35:59', 'Eliabe Felix', 'Eliabe Felix'),
(80, 22, 'l', '2017-05-17 09:36:42', '2017-05-17 09:37:07', 'Eliabe Felix', 'Eliabe Felix');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loglocacao`
--

CREATE TABLE `loglocacao` (
  `idChave` int(11) NOT NULL,
  `nomeLoc` varchar(255) NOT NULL,
  `nomeUsuarioDev` varchar(255) DEFAULT NULL,
  `nomeUsuarioPeg` varchar(255) NOT NULL,
  `horaDev` datetime DEFAULT NULL,
  `horaPeg` datetime NOT NULL,
  `idLoglocacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loglocacao`
--

INSERT INTO `loglocacao` (`idChave`, `nomeLoc`, `nomeUsuarioDev`, `nomeUsuarioPeg`, `horaDev`, `horaPeg`, `idLoglocacao`) VALUES
(25, 'sfsd', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:38:33', '2017-05-05 16:22:28', 2018),
(25, 'sfsd', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:38:34', '2017-05-05 16:22:29', 2019),
(22, 'sfsd', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:38:34', '2017-05-05 16:22:29', 2020),
(25, 'sfsd', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:42:11', '2017-05-05 16:22:29', 2021),
(25, 'dffff', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:38:33', '2017-05-05 16:31:46', 2022),
(25, 'dffff', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:38:34', '2017-05-05 16:31:46', 2023),
(22, 'dffff', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:38:34', '2017-05-05 16:31:47', 2024),
(25, 'Roberto', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:42:11', '2017-05-05 16:42:06', 2025),
(25, 'Roberto', 'Willame Soares', 'Eliabe Felix', '2017-05-05 16:46:55', '2017-05-05 16:42:07', 2026),
(22, 'Roberto', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:42:11', '2017-05-05 16:42:07', 2027),
(25, 'Roberto', 'Eliabe Felix', 'Eliabe Felix', '2017-05-05 16:42:11', '2017-05-05 16:42:07', 2028),
(25, 'Roberto', 'Willame Soares', 'Eliabe Felix', '2017-05-05 16:46:55', '2017-05-05 16:42:07', 2029),
(19, 'Roberto', 'Willame Soares', 'Eliabe Felix', '2017-05-05 16:46:55', '2017-05-05 16:42:07', 2030),
(20, 'Roberto', 'Willame Soares', 'Eliabe Felix', '2017-05-05 16:46:55', '2017-05-05 16:42:07', 2031),
(25, 'ELibae', 'Willame Soares', 'Willame Soares', '2017-05-17 09:26:36', '2017-05-17 09:26:15', 2032),
(26, 'ELibae', 'Willame Soares', 'Willame Soares', '2017-05-17 09:26:37', '2017-05-17 09:26:15', 2033),
(25, 'ELibae', 'Willame Soares', 'Willame Soares', '2017-05-17 09:26:36', '2017-05-17 09:26:19', 2034),
(26, 'ELibae', 'Willame Soares', 'Willame Soares', '2017-05-17 09:26:37', '2017-05-17 09:26:19', 2035),
(25, 'oi', 'Willame Soares', 'Willame Soares', '2017-05-17 09:26:55', '2017-05-17 09:26:42', 2036),
(26, 'oi', 'Willame Soares', 'Willame Soares', '2017-05-17 09:26:55', '2017-05-17 09:26:42', 2037),
(25, 'asd', 'Eliabe Felix', 'Eliabe Felix', '2017-05-17 09:27:21', '2017-05-17 09:27:17', 2038),
(26, 'asd', 'Eliabe Felix', 'Eliabe Felix', '2017-05-17 09:27:21', '2017-05-17 09:27:18', 2039),
(22, 'Erk', 'Eliabe Felix', 'Eliabe Felix', '2017-05-17 09:28:22', '2017-05-17 09:28:14', 2040),
(25, 'ty', 'Eliabe Felix', 'Eliabe Felix', '2017-05-17 09:35:59', '2017-05-17 09:33:18', 2041),
(22, 'l', 'Eliabe Felix', 'Eliabe Felix', '2017-05-17 09:37:07', '2017-05-17 09:36:42', 2042);

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
-- Stand-in structure for view `usern`
--
CREATE TABLE `usern` (
`idChave` int(11)
,`nomeLoc` varchar(255)
,`nomeUsuarioDev` varchar(255)
,`nomeUsuarioPeg` varchar(255)
,`horaDev` datetime
,`horaPeg` datetime
,`idLoglocacao` int(11)
);

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

-- --------------------------------------------------------

--
-- Structure for view `usern`
--
DROP TABLE IF EXISTS `usern`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usern`  AS  select `loglocacao`.`idChave` AS `idChave`,`loglocacao`.`nomeLoc` AS `nomeLoc`,`loglocacao`.`nomeUsuarioDev` AS `nomeUsuarioDev`,`loglocacao`.`nomeUsuarioPeg` AS `nomeUsuarioPeg`,`loglocacao`.`horaDev` AS `horaDev`,`loglocacao`.`horaPeg` AS `horaPeg`,`loglocacao`.`idLoglocacao` AS `idLoglocacao` from `loglocacao` where (`loglocacao`.`idChave` = 25) limit 5 ;

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
  ADD PRIMARY KEY (`codLoc`);

--
-- Indexes for table `loglocacao`
--
ALTER TABLE `loglocacao`
  ADD PRIMARY KEY (`idLoglocacao`);

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
  MODIFY `idchave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `locacao`
--
ALTER TABLE `locacao`
  MODIFY `codLoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `loglocacao`
--
ALTER TABLE `loglocacao`
  MODIFY `idLoglocacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2043;
--
-- AUTO_INCREMENT for table `logusuario`
--
ALTER TABLE `logusuario`
  MODIFY `idLogUsuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
