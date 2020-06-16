-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jun-2020 às 23:25
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplicativoquiz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao`
--

CREATE TABLE `classificacao` (
  `id` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `nome_tab` varchar(255) NOT NULL,
  `pontos` int(11) NOT NULL,
  `responsavel_pergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classificacao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_acesso`
--

CREATE TABLE `perfil_acesso` (
  `id` int(11) NOT NULL,
  `perfil` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil_acesso`
--

INSERT INTO `perfil_acesso` (`id`, `perfil`) VALUES
(1, 'admin'),
(2, 'normal'),
(3, 'restrito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `pergunta_titulo` blob NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perguntas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas_opc`
--

CREATE TABLE `respostas_opc` (
  `id` int(11) NOT NULL,
  `respostas_opc` varchar(255) NOT NULL,
  `id_perguntas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `respostas_opc`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta_verdadeira`
--

CREATE TABLE `resposta_verdadeira` (
  `id` int(11) NOT NULL,
  `id_resposta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `resposta_verdadeira`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_acesso` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_resposta`
--

CREATE TABLE `usuario_resposta` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `resposta` int(11) NOT NULL,
  `evento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_resposta`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `classificacao`
--
ALTER TABLE `classificacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `perfil_acesso`
--
ALTER TABLE `perfil_acesso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_id_usuario_idx` (`user_ID`);

--
-- Indexes for table `respostas_opc`
--
ALTER TABLE `respostas_opc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_perguntas_id_idx` (`id_perguntas`);

--
-- Indexes for table `resposta_verdadeira`
--
ALTER TABLE `resposta_verdadeira`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_id_resposta_opc_idx` (`id_resposta`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_perfil_acesso_id_idx` (`id_acesso`);

--
-- Indexes for table `usuario_resposta`
--
ALTER TABLE `usuario_resposta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classificacao`
--
ALTER TABLE `classificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `perfil_acesso`
--
ALTER TABLE `perfil_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `respostas_opc`
--
ALTER TABLE `respostas_opc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `resposta_verdadeira`
--
ALTER TABLE `resposta_verdadeira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `usuario_resposta`
--
ALTER TABLE `usuario_resposta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`user_ID`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `respostas_opc`
--
ALTER TABLE `respostas_opc`
  ADD CONSTRAINT `fk_perguntas_id` FOREIGN KEY (`id_perguntas`) REFERENCES `perguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `resposta_verdadeira`
--
ALTER TABLE `resposta_verdadeira`
  ADD CONSTRAINT `fk_id_resposta_opc` FOREIGN KEY (`id_resposta`) REFERENCES `respostas_opc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_perfil_acesso_id` FOREIGN KEY (`id_acesso`) REFERENCES `perfil_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
