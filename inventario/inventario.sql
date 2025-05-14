-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Maio-2025 às 15:54
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inventario`
--
CREATE DATABASE IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventario`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `ID` int(11) NOT NULL,
  `nome_item` varchar(50) NOT NULL,
  `qtd_item` int(11) NOT NULL,
  `descricao_item` text NOT NULL,
  `img_item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`ID`, `nome_item`, `qtd_item`, `descricao_item`, `img_item`) VALUES
(1, 'Master Sword', 5, 'A espada lendária que sela a escuridão.', 'https://th.bing.com/th/id/R.cf4959853f5806c1fa5c3abb71e59eca?rik=BiudKI1CSYynAA&riu=http%3a%2f%2fvignette2.wikia.nocookie.net%2fzelda%2fimages%2f4%2f4e%2fMaster-Schwert01_(The_Wind_Waker).png%2frevision%2flatest%3fcb%3d20121203143127%26path-prefix%3dde&ehk=IAj%2bGvWHLFPfcnRA%2fkFO7C59SSvWImyrRAPYr0iF69Y%3d&risl=&pid=ImgRaw&r=0'),
(2, 'Hylian Shield', 1, 'Um escudo passado pela família real Hyruleana, junto com a lenda do herói que o empunhava.', 'https://th.bing.com/th/id/OIP.JTusguybJEvPOayP8mBwPgHaJJ?rs=1&pid=ImgDetMain'),
(3, 'Ember Headdress', 1, 'Usado em rituais antigos, este item é feito de tecido absorvente de calor e produz chamas.', 'https://th.bing.com/th/id/OIP.uDxEhw2cg74EybiSgVpHNwAAAA?rs=1&pid=ImgDetMain'),
(4, 'Bow', 1, 'O Arco é geralmente a arma de longa distância principal de Link, e tem o dobro do poder de ataque das primeiras Espadas.', 'https://vignette.wikia.nocookie.net/zelda/images/a/ad/Bow_(Skyward_Sword).png/revision/latest?cb=20150831083952&path-prefix=pt-br'),
(5, 'Diamond', 43, 'O mineral mais valioso que pode ser encontrado em Hyrule.', 'https://vignette.wikia.nocookie.net/zelda/images/f/f1/Diamante_BotW.png/revision/latest?cb=20180225160640&path-prefix=es'),
(6, 'VoltFruit', 75, 'Os cactos encontrados no deserto de Gerudo produzem esta fruta doce.', 'https://img.game8.co/3274462/9d76c505d5920e9735f672d76b51e818.png/show');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
