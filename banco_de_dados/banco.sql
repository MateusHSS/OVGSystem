-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10/07/2020 às 08:43
-- Versão do servidor: 5.7.23-23
-- Versão do PHP: 7.3.6

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
-- Estrutura para tabela `tabatividade`
--

CREATE TABLE `tabatividade` (
  `idtabatividade` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabatividade`
--

INSERT INTO `tabatividade` (`idtabatividade`, `descricao`, `peso`) VALUES
(1, 'ATIVO', 9),
(2, 'ATENDIMENTO PROJETO ', 3),
(3, 'KAIZENS/CCQ', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabcliente`
--

CREATE TABLE `tabcliente` (
  `idcliente` int(11) NOT NULL,
  `nomecliente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idsetorcliente` int(11) NOT NULL,
  `telefonecliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `datacadastrocliente` date NOT NULL,
  `idusuariocliente` int(11) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `corredorcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabcorredor`
--

CREATE TABLE `tabcorredor` (
  `idcorredor` int(11) NOT NULL,
  `nomecorredor` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tabcorredor`
--

INSERT INTO `tabcorredor` (`idcorredor`, `nomecorredor`) VALUES
(1, 'CENTRO LESTE'),
(3, 'CENTRO NORTE'),
(4, 'CENTRO SUDESTE '),
(6, 'MINAS BAHIA'),
(7, 'MINAS RIO'),
(8, 'SERVIÇOS OPERACIONAIS');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabestoque`
--

CREATE TABLE `tabestoque` (
  `idtabestoque` int(11) NOT NULL,
  `SAP_material` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `KG` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tabestoque`
--

INSERT INTO `tabestoque` (`idtabestoque`, `SAP_material`, `quantidade`, `KG`) VALUES
(1, '30030142', '2', '139.68'),
(2, '30072931', '0', '0'),
(3, '30022025', '0', '0'),
(4, '30030145', '0', '0'),
(5, '30030147', '0', '0'),
(6, '30030239', '0', '0'),
(7, '30030240', '0', '0'),
(8, '30030143', '0', '0'),
(9, '30030157', '0', '0'),
(10, '30030144', '0', '0'),
(11, '30030233', '0', '0'),
(12, '30030232', '0', '0'),
(13, '30030235', '0', '0'),
(14, '30030234', '0', '0'),
(15, '30030230', '0', '0'),
(16, '30030146', '0', '0'),
(17, '30030231', '0', '0'),
(18, '30030238', '0', '0'),
(19, '30030148', '0', '0'),
(20, '30030237', '0', '0'),
(21, '30030149', '0', '0'),
(22, '30030241', '0', '0'),
(23, '30030219', '0', '0'),
(24, '30030137', '0', '0'),
(25, '30030151', '0', '0'),
(26, '30030139', '0', '0'),
(27, '30030140', '0', '0'),
(28, '30042303', '0', '0'),
(29, '30030138', '0', '0'),
(30, '30030141', '0', '0'),
(31, '30030150', '0', '0'),
(32, '30030218', '0', '0'),
(33, '30030129', '0', '0'),
(34, '30030130', '0', '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabfuncionario`
--

CREATE TABLE `tabfuncionario` (
  `idtabfuncionario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `matricula` varchar(45) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabhorariodiario`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabmaquinas`
--

CREATE TABLE `tabmaquinas` (
  `idtabmaquinas` int(11) NOT NULL,
  `nome_maquina` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tabmaquinas`
--

INSERT INTO `tabmaquinas` (`idtabmaquinas`, `nome_maquina`) VALUES
(1, 'GUILHOTINA'),
(3, 'TARTARUGA'),
(2, 'POLICORTE'),
(4, 'DOBRADEIRA'),
(6, 'FURADEIRA'),
(7, 'LIXADEIRA'),
(5, 'SOLDA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabmaquinasdisponiveis`
--

CREATE TABLE `tabmaquinasdisponiveis` (
  `idtabmaquinasdisponiveis` int(11) NOT NULL,
  `data` date NOT NULL,
  `idmaquina` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabmaterial`
--

CREATE TABLE `tabmaterial` (
  `idmaterial` int(11) NOT NULL,
  `nomematerial` varchar(50) NOT NULL,
  `codigo_SAP` varchar(45) NOT NULL,
  `peso_KG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabmaterial`
--

INSERT INTO `tabmaterial` (`idmaterial`, `nomematerial`, `codigo_SAP`, `peso_KG`) VALUES
(2, 'CHAPA ACO 1008/1010; ESPESSURA: 1/4\" (6,35 MM)', '30030142', 69.84),
(3, 'CHAPA ACO 1010; ESPESSURA: 1/8\" (3,18 MM)', '30072931', 0),
(4, 'CHAPA ACO 1020; ESPESSURA: 1.1/4\" (31,75MM)', '30022025', 0),
(5, 'CHAPA ACO 1020; ESPESSURA: 3/8\" (9,53 MM)', '30030145', 268.9),
(6, 'CHAPA ACO 1020; ESPESSURA: 3/8\" (9,53 MM)', '30030147', 672.25),
(7, 'CHAPA ACO 1045; ESPESSURA: 3/4\" (19,05 MM)', '30030239', 0),
(8, 'CHAPA ACO 1045; ESPESSURA: 5/8\" (15,88 MM)', '30030240', 0),
(9, 'CHAPA ACO CARBONO; SAE1020; ESP.: 12,70 MM', '30030143', 358.53),
(10, 'CHAPA DE ACO  ASTM A588 GR A DE 1\"', '30030157', 0),
(11, 'CHAPA DE AÇO 1020  3/16\"', '30030144', 136.8),
(12, 'CHAPA DE AÇO 1020  DE 3/8\"', '30030233', 179.27),
(13, 'CHAPA DE AÇO 1020  DE 5/8\"', '30030232', 450),
(14, 'CHAPA DE AÇO 1020 1/4\"', '30030235', 179.27),
(15, 'CHAPA DE AÇO 1020 DE 1\"', '30030234', 717.07),
(16, 'CHAPA DE AÇO 1020 DE 1/16\"', '30030230', 43.2),
(17, 'CHAPA DE AÇO 1020 DE 3/4\"', '30030146', 537.8),
(18, 'CHAPA DE AÇO 1020; ESPESSURA 1/2\" (12,7MM) ', '30030231', 358.53),
(19, 'CHAPA DE AÇO 1045  1/8\"', '30030238', 0),
(20, 'CHAPA DE AÇO 1045  3/16\" ', '30030148', 0),
(21, 'CHAPA DE AÇO 1045  3/8\" ', '30030237', 179.27),
(22, 'CHAPA DE AÇO 1045 1/4\" ', '30030149', 179.27),
(23, 'CHAPA DE AÇO 1045 DE 1\"', '30030241', 0),
(24, 'CHAPA DE ACO 1045; ESPESSURA 1/2 \" (12,7MM)', '30030219', 0),
(25, 'CHAPA DE ACO A36; ESPESSURA 1/2\" (12,70 MM)', '30030137', 352.8),
(26, 'CHAPA DE AÇO USI-SAC-50 DE    12,7 MM  (1/2\")', '30030151', 358.52),
(27, 'CHAPA DE AÇO USI-SAC-50 DE    2,0 MM  (1/16\")', '30030139', 0),
(28, 'CHAPA DE AÇO USI-SAC-50 DE    6,35 MM  (1/4\")', '30030140', 179.42),
(29, 'CHAPA DE AÇO USI-SAC-50 DE   8,0 MM DE ESPESSURA (', '30042303', 0),
(30, 'CHAPA DE AÇO USI-SAC-50 DE  3,0 MM  (1/8\")', '30030138', 75),
(31, 'CHAPA DE AÇO USI-SAC-50 DE  4,7 MM  (3/16\")', '30030141', 135.58),
(32, 'CHAPA DE AÇO USI-SAC-50 DE  9,5 MM  (3/8\")', '30030150', 225),
(33, 'CHAPA DE AÇO XADREZ   1/4\"  ANT.DERRAPANTE', '30030218', 179.42),
(34, 'CHAPA DE AÇO XADREZ   1/8\"  ANT.DERRAPANTE', '30030129', 90),
(35, 'CHAPA DE AÇO XADREZ   3/16\" ANT.DERRAPANTE', '30030130', 136.8),
(36, 'MESA DE VAGÃO TANQUE', '', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabmaterialproduto`
--

CREATE TABLE `tabmaterialproduto` (
  `idtabmaterialproduto` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `idmaterial` int(11) NOT NULL,
  `quantidadematerial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabmovimentacaoestoque`
--

CREATE TABLE `tabmovimentacaoestoque` (
  `idmovimentacaoestoque` int(11) NOT NULL,
  `SAP_material` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_movimentacao` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `KG` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabpedido`
--

CREATE TABLE `tabpedido` (
  `idpedido` int(11) NOT NULL,
  `clientepedido` int(11) NOT NULL,
  `produtopedido` int(11) NOT NULL,
  `quantidadepedido` int(11) NOT NULL,
  `dimensaopedido` varchar(45) DEFAULT NULL,
  `formulariopedido` varchar(100) DEFAULT NULL,
  `statuspedido` int(11) NOT NULL DEFAULT '1',
  `atividade` int(11) NOT NULL,
  `seguranca` int(11) NOT NULL,
  `datainclusao` date NOT NULL,
  `tempo` time DEFAULT NULL,
  `tempo_unt` time DEFAULT NULL,
  `emergencial` int(11) NOT NULL DEFAULT '0',
  `previsao` datetime DEFAULT NULL,
  `final_real` datetime DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabpedidos_dia`
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
  `emergencial` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabperfil`
--

CREATE TABLE `tabperfil` (
  `idperfil` int(11) NOT NULL,
  `nomeperfil` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabperfil`
--

INSERT INTO `tabperfil` (`idperfil`, `nomeperfil`) VALUES
(1, 'ADMINISTRADOR'),
(3, 'SOLICITANTE'),
(2, 'SUPERVISOR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabprocesso`
--

CREATE TABLE `tabprocesso` (
  `idtabprocesso` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `tempo` time NOT NULL,
  `maquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabprocesso`
--

INSERT INTO `tabprocesso` (`idtabprocesso`, `descricao`, `tempo`, `maquina`) VALUES
(1, 'CORTE (GUILHOTINA)', '00:00:47', 1),
(2, 'CORTE (POLICORTE)', '00:11:40', 2),
(3, 'TARTARUGA', '00:12:00', 3),
(4, 'DOBRA', '00:05:51', 4),
(5, 'SOLDA MIG', '00:07:07', 0),
(6, 'FURAÇÃO (FURADEIRA DE BANCADA)', '00:00:38', 6),
(7, 'ACABAMENTO (LIXADEIRA)', '00:01:53', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabprocessosproduto`
--

CREATE TABLE `tabprocessosproduto` (
  `idtabprocessosproduto` int(11) NOT NULL,
  `idproduto` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idprocesso` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_sub` int(11) NOT NULL DEFAULT '1',
  `vezes` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `funcionarios` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tempo` time DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `escalonado` int(11) NOT NULL DEFAULT '0',
  `idmaquina` int(11) DEFAULT NULL,
  `pros_inicial` datetime DEFAULT NULL,
  `pros_final` datetime DEFAULT NULL,
  `finalizado` int(11) NOT NULL DEFAULT '0',
  `final_real` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabproduto`
--

CREATE TABLE `tabproduto` (
  `idproduto` int(11) NOT NULL,
  `nomeproduto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datacadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabseguranca`
--

CREATE TABLE `tabseguranca` (
  `idtabseguranca` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabseguranca`
--

INSERT INTO `tabseguranca` (`idtabseguranca`, `descricao`, `peso`) VALUES
(1, 'RISCO SEGURANÇA', 9),
(2, 'RISCO OPERACIONAL', 3),
(3, 'SEM RISCO IMINENTE', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabsetor`
--

CREATE TABLE `tabsetor` (
  `idsetor` int(11) NOT NULL,
  `idcorredor` int(11) NOT NULL,
  `nomesetor` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tabsetor`
--

INSERT INTO `tabsetor` (`idsetor`, `idcorredor`, `nomesetor`) VALUES
(1, 1, 'LOGÍSTICA'),
(2, 1, 'VAGÕES DIVINÓPOLIS'),
(3, 1, 'REPARO PESADO LOCOMOTIVAS'),
(4, 8, 'MÁQUINAS DE VIA '),
(5, 1, 'REPARO LEVE LOCOMOTIVAS'),
(6, 8, 'COMPONENTES'),
(7, 4, 'VAGÕES CS'),
(8, 1, 'VAGÕES ARAXÁ'),
(9, 1, 'WILSON LOBATO'),
(10, 1, 'PCM VAGÕES');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabstatus`
--

CREATE TABLE `tabstatus` (
  `idtabstatus` int(11) NOT NULL,
  `nomestatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabstatus`
--

INSERT INTO `tabstatus` (`idtabstatus`, `nomestatus`) VALUES
(1, 'PENDENTE'),
(2, 'EM PRODUÇÃO'),
(3, 'EMERGENCIAL'),
(4, 'REALIZADO'),
(5, 'AGUARDANDO RETIRADA'),
(6, 'PROGRAMADO'),
(7, 'CONCLUÍDO'),
(8, 'ATRASADO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabturno`
--

CREATE TABLE `tabturno` (
  `idtabturno` int(11) NOT NULL,
  `nometurno` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tabturno`
--

INSERT INTO `tabturno` (`idtabturno`, `nometurno`) VALUES
(1, 'TURNO A'),
(2, 'TURNO B');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabusuario`
--

CREATE TABLE `tabusuario` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nomeusuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `idsetorusuario` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  `p_acesso` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tabusuario`
--

INSERT INTO `tabusuario` (`idusuario`, `usuario`, `nomeusuario`, `senha`, `ativo`, `idsetorusuario`, `idperfil`, `p_acesso`) VALUES
(1, 'ADM', 'ADMINISTRADOR', 'c1972825977a04d826aa8f04b033314b', 1, 1, 1, 0),
(2, 'MAYNARA.COSTA', 'MAYNARA LUIZA SANTOS COSTA', '77ebab65d24298ef19f1ed18e19d130d', 1, 1, 1, 0),
(3, 'SUELEN.GUARDA', 'SUELEN SOARES DA GUARDA', 'e8b3579525a81b39cb7d03be9e175588', 1, 2, 3, 0),
(5, 'RONALDO.SILVA', 'RONALDO DA SILVA', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 1),
(7, 'RODOLFO.TERCETTI', 'RODOLFO TERCETTI', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 1),
(8, 'DIEGO.NUNES', 'DIEGO NUNES', '91aeb8efd3ea8e9ed598ac3da674573c', 0, 2, 2, 0),
(9, 'TULIO.MAIA', 'TULIO MAIA', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 0),
(10, 'PEDRO.SANTOS', 'PEDRO SANTOS', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 0),
(11, 'EXPEDITO.GONCALVES', 'EXPEDITO GONÇALVES', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 1),
(12, 'DENIS.COUTO', 'DENIS COUTO', 'f7516b8e7191d45b75e8f22ac2296f7d', 0, 2, 2, 0),
(13, 'FERNANDO.RODRIGUES', 'FERNANDO RODRIGUES', '41c1d1d6321219fb4b6c847f4f48715f', 0, 2, 2, 0),
(14, 'CLEITON.ROCHA', 'CLEITON ROCHA', '3c8945fb2e8d08f838241bbfb4304185', 0, 2, 2, 0),
(15, 'RAMON.RUAS', 'RAMON.RUAS', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 1),
(16, 'GABRIEL.GOMES', 'GABRIEL.GOMES', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 2, 1),
(17, 'JHENIFER.OLIVEIRA', 'JHENIFER CRISTINA OLIVEIRA', 'c16f14c0c2237c962376553810d88fea', 0, 2, 2, 0),
(18, 'LORENA.OLIVEIRA', 'LORENA RIBEIRO OLIVEIRA', '659720c20ba8068e3574c2e39206b043', 0, 2, 3, 0),
(19, 'USUARIO.TESTE', 'USUARIO TESTE', '827ccb0eea8a706c4c34a16891f84e7b', 0, 2, 3, 0),
(20, 'CASSIO.GOMES', 'CASSIO ALBERTO PIRES GOMES', '958910ffe64384f9b03751ac589a7a88', 0, 2, 3, 0),
(21, 'ANTONIO.ALVES', 'ANTONIO ALVES ARAUJO JUNIOR', 'e9f909b73e2e27c0189e1637f5f4576a', 0, 2, 2, 0),
(22, 'LEONARDO.VIEIRA', 'LEONARDO TRISTAO VIEIRA', 'c3341d18723943f81230c18781a93ea8', 0, 7, 3, 0),
(23, 'ADRIANO.SILVA', 'ADRIANO DOS SANTOS SILVA', '827ccb0eea8a706c4c34a16891f84e7b', 0, 7, 3, 0),
(24, 'PEDRO.REZENDE', 'PEDRO NOGUEIRA REZENDE', 'bb6bfdcdc7029eb1031de3dd439d3a7f', 0, 1, 3, 0),
(25, 'GESTAO.APOIO', 'GESTÃO INTEGRADA', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 3, 1),
(26, 'NICOLLE.DIAS', 'NICOLLE TRINDADE DIAS', '02a78e3d1d931bb6d51b01d4be736e25', 0, 2, 3, 0),
(27, 'DOUGLAS.SIQUEIRA', 'DOUGLAS SIQUEIRA', '827ccb0eea8a706c4c34a16891f84e7b', 0, 9, 3, 1),
(28, 'DENIS.CARVALHO', 'DENIS CARVALHO', '3d3e6a285df1453def97c371340ac7e2', 0, 9, 3, 0),
(29, 'ALEX.ALEXANDRE', 'ALEX JUNIO DE SOUZA ALEXANDRE', 'e9e8bf91160b666f9e61ee5e864d9562', 0, 10, 3, 0),
(30, 'MATHEUS.QUEIROZ', 'MATHEUS QUEIROZ', '827ccb0eea8a706c4c34a16891f84e7b', 0, 10, 3, 1),
(31, 'IGOR.JUSTO', 'IGOR JUSTO', '5d3bc298e8bf3667eddd2799727bf2df', 0, 4, 3, 0),
(32, 'GERALDO.MAGELA', 'GERALDO MAGELA AMARO ALVES', 'e9fb2eda3d9c55a0d89c98d6c54b5b3e', 0, 1, 2, 0),
(33, 'LEO.LUIZ', 'LEONARDO LUIZ ', 'dada6a2c154f7b6dcec923b49496682d', 0, 1, 2, 0),
(34, 'FABIO.PAVINATO', 'FABIO PAVINATO', '9cef0968cfed97f1792484f98e08ee7a', 0, 1, 1, 0),
(35, 'GILBERTO.MARQUES', 'GILBERTO MARQUES', '827ccb0eea8a706c4c34a16891f84e7b', 0, 6, 3, 1),
(36, 'VINICIUS.BATISTA', 'VINICIUS BATISTA', '827ccb0eea8a706c4c34a16891f84e7b', 0, 6, 3, 1),
(37, 'ANDRE.COSTA', 'ANDRE COSTA', '769675d7c11f336ae6573e7e533570ec', 0, 6, 3, 0),
(38, 'VINICIUS.BATISTA', 'VINICIUS BATISTA', '7d930b75a030ac22fcdfa88796596736', 0, 6, 3, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_movimentacao_estoque`
--

CREATE TABLE `tipo_movimentacao_estoque` (
  `idtipo_movimentacao_estoque` int(11) NOT NULL,
  `descricao` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tabatividade`
--
ALTER TABLE `tabatividade`
  ADD PRIMARY KEY (`idtabatividade`);

--
-- Índices de tabela `tabcliente`
--
ALTER TABLE `tabcliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Índices de tabela `tabcorredor`
--
ALTER TABLE `tabcorredor`
  ADD PRIMARY KEY (`idcorredor`);

--
-- Índices de tabela `tabestoque`
--
ALTER TABLE `tabestoque`
  ADD PRIMARY KEY (`idtabestoque`);

--
-- Índices de tabela `tabfuncionario`
--
ALTER TABLE `tabfuncionario`
  ADD PRIMARY KEY (`idtabfuncionario`),
  ADD UNIQUE KEY `matricula_UNIQUE` (`matricula`);

--
-- Índices de tabela `tabhorariodiario`
--
ALTER TABLE `tabhorariodiario`
  ADD PRIMARY KEY (`idtabhorariodiario`);

--
-- Índices de tabela `tabmaquinas`
--
ALTER TABLE `tabmaquinas`
  ADD PRIMARY KEY (`idtabmaquinas`);

--
-- Índices de tabela `tabmaquinasdisponiveis`
--
ALTER TABLE `tabmaquinasdisponiveis`
  ADD PRIMARY KEY (`idtabmaquinasdisponiveis`);

--
-- Índices de tabela `tabmaterial`
--
ALTER TABLE `tabmaterial`
  ADD PRIMARY KEY (`idmaterial`);

--
-- Índices de tabela `tabmaterialproduto`
--
ALTER TABLE `tabmaterialproduto`
  ADD PRIMARY KEY (`idtabmaterialproduto`);

--
-- Índices de tabela `tabmovimentacaoestoque`
--
ALTER TABLE `tabmovimentacaoestoque`
  ADD PRIMARY KEY (`idmovimentacaoestoque`);

--
-- Índices de tabela `tabpedido`
--
ALTER TABLE `tabpedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Índices de tabela `tabpedidos_dia`
--
ALTER TABLE `tabpedidos_dia`
  ADD PRIMARY KEY (`idtabpedidos_dia`);

--
-- Índices de tabela `tabperfil`
--
ALTER TABLE `tabperfil`
  ADD PRIMARY KEY (`idperfil`),
  ADD UNIQUE KEY `nomeperfil_UNIQUE` (`nomeperfil`);

--
-- Índices de tabela `tabprocesso`
--
ALTER TABLE `tabprocesso`
  ADD PRIMARY KEY (`idtabprocesso`);

--
-- Índices de tabela `tabprocessosproduto`
--
ALTER TABLE `tabprocessosproduto`
  ADD PRIMARY KEY (`idtabprocessosproduto`);

--
-- Índices de tabela `tabproduto`
--
ALTER TABLE `tabproduto`
  ADD PRIMARY KEY (`idproduto`),
  ADD UNIQUE KEY `nomeproduto_UNIQUE` (`nomeproduto`);

--
-- Índices de tabela `tabseguranca`
--
ALTER TABLE `tabseguranca`
  ADD PRIMARY KEY (`idtabseguranca`);

--
-- Índices de tabela `tabsetor`
--
ALTER TABLE `tabsetor`
  ADD PRIMARY KEY (`idsetor`);

--
-- Índices de tabela `tabstatus`
--
ALTER TABLE `tabstatus`
  ADD PRIMARY KEY (`idtabstatus`);

--
-- Índices de tabela `tabturno`
--
ALTER TABLE `tabturno`
  ADD PRIMARY KEY (`idtabturno`);

--
-- Índices de tabela `tabusuario`
--
ALTER TABLE `tabusuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Índices de tabela `tipo_movimentacao_estoque`
--
ALTER TABLE `tipo_movimentacao_estoque`
  ADD PRIMARY KEY (`idtipo_movimentacao_estoque`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tabatividade`
--
ALTER TABLE `tabatividade`
  MODIFY `idtabatividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tabcliente`
--
ALTER TABLE `tabcliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabcorredor`
--
ALTER TABLE `tabcorredor`
  MODIFY `idcorredor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tabestoque`
--
ALTER TABLE `tabestoque`
  MODIFY `idtabestoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `idtabmaquinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `tabmaquinasdisponiveis`
--
ALTER TABLE `tabmaquinasdisponiveis`
  MODIFY `idtabmaquinasdisponiveis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabmaterial`
--
ALTER TABLE `tabmaterial`
  MODIFY `idmaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tabprocesso`
--
ALTER TABLE `tabprocesso`
  MODIFY `idtabprocesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `idtabseguranca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tabsetor`
--
ALTER TABLE `tabsetor`
  MODIFY `idsetor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tabstatus`
--
ALTER TABLE `tabstatus`
  MODIFY `idtabstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tabturno`
--
ALTER TABLE `tabturno`
  MODIFY `idtabturno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tabusuario`
--
ALTER TABLE `tabusuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tipo_movimentacao_estoque`
--
ALTER TABLE `tipo_movimentacao_estoque`
  MODIFY `idtipo_movimentacao_estoque` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
