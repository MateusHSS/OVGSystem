-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jul-2020 às 00:08
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ongceu28_ovgsystem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabatividade`
--

CREATE TABLE `tabatividade` (
  `idtabatividade` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabcliente`
--

CREATE TABLE `tabcliente` (
  `idcliente` int(11) NOT NULL,
  `nomecliente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idsetorcliente` int(11) NOT NULL,
  `telefonecliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `datacadastrocliente` date NOT NULL,
  `idusuariocliente` int(11) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT 1,
  `corredorcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabcorredor`
--

CREATE TABLE `tabcorredor` (
  `idcorredor` int(11) NOT NULL,
  `nomecorredor` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabestoque`
--

CREATE TABLE `tabestoque` (
  `idtabestoque` int(11) NOT NULL,
  `SAP_material` varchar(45) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `KG` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabfuncionario`
--

CREATE TABLE `tabfuncionario` (
  `idtabfuncionario` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `matricula` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `empresa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabhorariodiario`
--

CREATE TABLE `tabhorariodiario` (
  `idtabhorariodiario` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `fim` time NOT NULL,
  `intervalo` time DEFAULT NULL,
  `hora_intervalo` time NOT NULL,
  `horas` time NOT NULL,
  `data` date NOT NULL,
  `turno` int(11) NOT NULL,
  `funcionario_disponiveis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabmaquinas`
--

CREATE TABLE `tabmaquinas` (
  `idtabmaquinas` int(11) NOT NULL,
  `nome_maquina` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabmaquinasdisponiveis`
--

CREATE TABLE `tabmaquinasdisponiveis` (
  `idtabmaquinasdisponiveis` int(11) NOT NULL,
  `data` date NOT NULL,
  `idmaquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabmaterial`
--

CREATE TABLE `tabmaterial` (
  `idmaterial` int(11) NOT NULL,
  `nomematerial` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `codigo_SAP` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `peso_KG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabmaterialproduto`
--

CREATE TABLE `tabmaterialproduto` (
  `idtabmaterialproduto` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `idmaterial` int(11) NOT NULL,
  `quantidadematerial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabmovimentacaoestoque`
--

CREATE TABLE `tabmovimentacaoestoque` (
  `idmovimentacaoestoque` int(11) NOT NULL,
  `SAP_material` varchar(45) NOT NULL,
  `tipo_movimentacao` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `KG` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabpedido`
--

CREATE TABLE `tabpedido` (
  `idpedido` int(11) NOT NULL,
  `clientepedido` int(11) NOT NULL,
  `produtopedido` int(11) NOT NULL,
  `quantidadepedido` int(11) NOT NULL,
  `dimensaopedido` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formulariopedido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statuspedido` int(11) NOT NULL DEFAULT 1,
  `atividade` int(11) NOT NULL,
  `seguranca` int(11) NOT NULL,
  `datainclusao` date NOT NULL,
  `tempo` time DEFAULT NULL,
  `tempo_unt` time DEFAULT NULL,
  `emergencial` int(11) NOT NULL DEFAULT 0,
  `previsao` datetime DEFAULT NULL,
  `final_real` datetime DEFAULT NULL,
  `obs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabpedidos_dia`
--

CREATE TABLE `tabpedidos_dia` (
  `idtabpedidos_dia` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `data` date NOT NULL,
  `peso` int(11) NOT NULL,
  `tempo` time NOT NULL,
  `ordem` int(11) DEFAULT NULL,
  `data_inicial` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `emergencial` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabperfil`
--

CREATE TABLE `tabperfil` (
  `idperfil` int(11) NOT NULL,
  `nomeperfil` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabprocesso`
--

CREATE TABLE `tabprocesso` (
  `idtabprocesso` int(11) NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tempo` time NOT NULL,
  `maquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabprocessosproduto`
--

CREATE TABLE `tabprocessosproduto` (
  `idtabprocessosproduto` int(11) NOT NULL,
  `idproduto` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idprocesso` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_sub` int(11) NOT NULL DEFAULT 1,
  `vezes` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `funcionarios` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tempo` time DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `escalonado` int(11) NOT NULL DEFAULT 0,
  `idmaquina` int(11) DEFAULT NULL,
  `pros_inicial` datetime DEFAULT NULL,
  `pros_final` datetime DEFAULT NULL,
  `finalizado` int(11) NOT NULL DEFAULT 0,
  `final_real` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabproduto`
--

CREATE TABLE `tabproduto` (
  `idproduto` int(11) NOT NULL,
  `nomeproduto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datacadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabseguranca`
--

CREATE TABLE `tabseguranca` (
  `idtabseguranca` int(11) NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabsetor`
--

CREATE TABLE `tabsetor` (
  `idsetor` int(11) NOT NULL,
  `idcorredor` int(11) NOT NULL,
  `nomesetor` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabstatus`
--

CREATE TABLE `tabstatus` (
  `idtabstatus` int(11) NOT NULL,
  `nomestatus` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabtipo_movimentacao_estoque`
--

CREATE TABLE `tabtipo_movimentacao_estoque` (
  `idtabtipo_movimentacao_estoque` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabturno`
--

CREATE TABLE `tabturno` (
  `idtabturno` int(11) NOT NULL,
  `nometurno` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabusuario`
--

CREATE TABLE `tabusuario` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nomeusuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `idsetorusuario` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  `p_acesso` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tabatividade`
--
ALTER TABLE `tabatividade`
  ADD PRIMARY KEY (`idtabatividade`);

--
-- Índices para tabela `tabcliente`
--
ALTER TABLE `tabcliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Índices para tabela `tabcorredor`
--
ALTER TABLE `tabcorredor`
  ADD PRIMARY KEY (`idcorredor`);

--
-- Índices para tabela `tabestoque`
--
ALTER TABLE `tabestoque`
  ADD PRIMARY KEY (`idtabestoque`);

--
-- Índices para tabela `tabfuncionario`
--
ALTER TABLE `tabfuncionario`
  ADD PRIMARY KEY (`idtabfuncionario`),
  ADD UNIQUE KEY `matricula_UNIQUE` (`matricula`);

--
-- Índices para tabela `tabhorariodiario`
--
ALTER TABLE `tabhorariodiario`
  ADD PRIMARY KEY (`idtabhorariodiario`);

--
-- Índices para tabela `tabmaquinas`
--
ALTER TABLE `tabmaquinas`
  ADD PRIMARY KEY (`idtabmaquinas`);

--
-- Índices para tabela `tabmaquinasdisponiveis`
--
ALTER TABLE `tabmaquinasdisponiveis`
  ADD PRIMARY KEY (`idtabmaquinasdisponiveis`);

--
-- Índices para tabela `tabmaterial`
--
ALTER TABLE `tabmaterial`
  ADD PRIMARY KEY (`idmaterial`);

--
-- Índices para tabela `tabmaterialproduto`
--
ALTER TABLE `tabmaterialproduto`
  ADD PRIMARY KEY (`idtabmaterialproduto`);

--
-- Índices para tabela `tabmovimentacaoestoque`
--
ALTER TABLE `tabmovimentacaoestoque`
  ADD PRIMARY KEY (`idmovimentacaoestoque`);

--
-- Índices para tabela `tabpedido`
--
ALTER TABLE `tabpedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Índices para tabela `tabpedidos_dia`
--
ALTER TABLE `tabpedidos_dia`
  ADD PRIMARY KEY (`idtabpedidos_dia`);

--
-- Índices para tabela `tabperfil`
--
ALTER TABLE `tabperfil`
  ADD PRIMARY KEY (`idperfil`),
  ADD UNIQUE KEY `nomeperfil_UNIQUE` (`nomeperfil`);

--
-- Índices para tabela `tabprocesso`
--
ALTER TABLE `tabprocesso`
  ADD PRIMARY KEY (`idtabprocesso`);

--
-- Índices para tabela `tabprocessosproduto`
--
ALTER TABLE `tabprocessosproduto`
  ADD PRIMARY KEY (`idtabprocessosproduto`);

--
-- Índices para tabela `tabproduto`
--
ALTER TABLE `tabproduto`
  ADD PRIMARY KEY (`idproduto`),
  ADD UNIQUE KEY `nomeproduto_UNIQUE` (`nomeproduto`);

--
-- Índices para tabela `tabseguranca`
--
ALTER TABLE `tabseguranca`
  ADD PRIMARY KEY (`idtabseguranca`);

--
-- Índices para tabela `tabsetor`
--
ALTER TABLE `tabsetor`
  ADD PRIMARY KEY (`idsetor`);

--
-- Índices para tabela `tabstatus`
--
ALTER TABLE `tabstatus`
  ADD PRIMARY KEY (`idtabstatus`);

--
-- Índices para tabela `tabtipo_movimentacao_estoque`
--
ALTER TABLE `tabtipo_movimentacao_estoque`
  ADD PRIMARY KEY (`idtabtipo_movimentacao_estoque`);

--
-- Índices para tabela `tabturno`
--
ALTER TABLE `tabturno`
  ADD PRIMARY KEY (`idtabturno`);

--
-- Índices para tabela `tabusuario`
--
ALTER TABLE `tabusuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tabatividade`
--
ALTER TABLE `tabatividade`
  MODIFY `idtabatividade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabcliente`
--
ALTER TABLE `tabcliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabcorredor`
--
ALTER TABLE `tabcorredor`
  MODIFY `idcorredor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabestoque`
--
ALTER TABLE `tabestoque`
  MODIFY `idtabestoque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabfuncionario`
--
ALTER TABLE `tabfuncionario`
  MODIFY `idtabfuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabhorariodiario`
--
ALTER TABLE `tabhorariodiario`
  MODIFY `idtabhorariodiario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabmaquinas`
--
ALTER TABLE `tabmaquinas`
  MODIFY `idtabmaquinas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabmaquinasdisponiveis`
--
ALTER TABLE `tabmaquinasdisponiveis`
  MODIFY `idtabmaquinasdisponiveis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabmaterial`
--
ALTER TABLE `tabmaterial`
  MODIFY `idmaterial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabmaterialproduto`
--
ALTER TABLE `tabmaterialproduto`
  MODIFY `idtabmaterialproduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabmovimentacaoestoque`
--
ALTER TABLE `tabmovimentacaoestoque`
  MODIFY `idmovimentacaoestoque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabpedido`
--
ALTER TABLE `tabpedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabpedidos_dia`
--
ALTER TABLE `tabpedidos_dia`
  MODIFY `idtabpedidos_dia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabperfil`
--
ALTER TABLE `tabperfil`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabprocesso`
--
ALTER TABLE `tabprocesso`
  MODIFY `idtabprocesso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabprocessosproduto`
--
ALTER TABLE `tabprocessosproduto`
  MODIFY `idtabprocessosproduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabproduto`
--
ALTER TABLE `tabproduto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabseguranca`
--
ALTER TABLE `tabseguranca`
  MODIFY `idtabseguranca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabsetor`
--
ALTER TABLE `tabsetor`
  MODIFY `idsetor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabstatus`
--
ALTER TABLE `tabstatus`
  MODIFY `idtabstatus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabtipo_movimentacao_estoque`
--
ALTER TABLE `tabtipo_movimentacao_estoque`
  MODIFY `idtabtipo_movimentacao_estoque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabturno`
--
ALTER TABLE `tabturno`
  MODIFY `idtabturno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabusuario`
--
ALTER TABLE `tabusuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
