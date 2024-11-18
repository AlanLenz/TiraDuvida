-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql26-farm1.kinghost.net
-- Tempo de geração: 17/11/2024 às 23:49
-- Versão do servidor: 10.2.36-MariaDB-log
-- Versão do PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `tiraduvida`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `CD_ALUNO` int(11) NOT NULL,
  `RA_ALUNO` varchar(32) DEFAULT NULL,
  `NM_ALUNO` varchar(128) DEFAULT NULL,
  `NR_PERIODO` int(11) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `aluno`
--

INSERT INTO `aluno` (`CD_ALUNO`, `RA_ALUNO`, `NM_ALUNO`, `NR_PERIODO`, `CD_USUARIO`) VALUES
(1, 'RA000001', 'Barbara Nycolli', 4, 3),
(2, 'RA000002', 'Christian Luan', 4, 4),
(3, 'RA000003', 'Cleiton Aparecido', 4, 5),
(4, 'RA000004', 'Eduardo José', 4, 6),
(5, 'RA000005', 'Erika Sartorelli', 4, 7),
(6, 'RA000006', 'Gabriel Fávero Heller', 4, 8),
(7, 'RA000007', 'Gabriel Felipe', 4, 9),
(8, 'RA000008', 'Guilherme Maidana', 4, 10),
(9, 'RA000009', 'Gustavo Muller', 4, 11),
(10, 'RA000010', 'Hébernald Théopile', 4, 12),
(11, 'RA000011', 'Heitor Miguel', 4, 13),
(12, 'RA000012', 'Ian Marco', 4, 14),
(13, 'RA000013', 'Jean Luca', 4, 15),
(14, 'RA000014', 'Jefferson Teles', 4, 16),
(15, 'RA000015', 'João Otávio', 4, 17),
(16, 'RA000016', 'João Vitor', 4, 18),
(17, 'RA000017', 'Jorge Henrique', 4, 19),
(18, 'RA000018', 'Juan Gabriel', 4, 20),
(19, 'RA000019', 'Kauã Matheus', 4, 21),
(20, 'RA000020', 'Kiury Woyciechowski', 4, 22),
(21, 'RA000021', 'Leonaedo Liogi', 4, 23),
(22, 'RA000022', 'Leonardo Paes', 4, 24),
(23, 'RA000023', 'Luiza dos Santos', 4, 25),
(24, 'RA000024', 'Mateus Massucatto', 4, 26),
(25, 'RA000025', 'Matheus Eduardo', 4, 27),
(26, 'RA000026', 'Matheus Henrique', 4, 28),
(27, 'RA000027', 'Pedro Henrique', 4, 29),
(28, 'RA000028', 'Phelipe Cartaxo', 4, 30),
(29, 'RA000029', 'Rafael Kaito', 4, 31),
(30, 'RA000030', 'Raul Torres', 4, 32),
(31, 'RA000031', 'Tiago Mendonça', 4, 33),
(32, 'RA000032', 'Wallace Pereira', 4, 34),
(33, 'RA000033', 'Willyam Gabriel', 4, 35),
(34, 'RA000034', 'Wyllian Ribiski', 4, 36);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_disciplina`
--

CREATE TABLE IF NOT EXISTS `aluno_disciplina` (
  `CD_AL_DISCIPLINA` int(11) NOT NULL,
  `ST_AL_DISCIPLINA` varchar(1) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL,
  `CD_DISCIPLINA` varchar(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `aluno_disciplina`
--

INSERT INTO `aluno_disciplina` (`CD_AL_DISCIPLINA`, `ST_AL_DISCIPLINA`, `CD_USUARIO`, `CD_CURSO`, `CD_DISCIPLINA`) VALUES
(1, 'A', 3, 1, 'EGS19503'),
(2, 'A', 4, 1, 'EGS19503'),
(3, 'A', 5, 1, 'EGS19503'),
(4, 'A', 6, 1, 'EGS19503'),
(5, 'A', 7, 1, 'EGS19503'),
(6, 'A', 8, 1, 'EGS19503'),
(7, 'A', 9, 1, 'EGS19503'),
(8, 'A', 10, 1, 'EGS19503'),
(9, 'A', 11, 1, 'EGS19503'),
(10, 'A', 12, 1, 'EGS19503'),
(11, 'A', 13, 1, 'EGS19503'),
(12, 'A', 14, 1, 'EGS19503'),
(13, 'A', 15, 1, 'EGS19503'),
(14, 'A', 16, 1, 'EGS19503'),
(15, 'A', 17, 1, 'EGS19503'),
(16, 'A', 18, 1, 'EGS19503'),
(17, 'A', 19, 1, 'EGS19503'),
(18, 'A', 20, 1, 'EGS19503'),
(19, 'A', 21, 1, 'EGS19503'),
(20, 'A', 22, 1, 'EGS19503'),
(21, 'A', 23, 1, 'EGS19503'),
(22, 'A', 24, 1, 'EGS19503'),
(23, 'A', 25, 1, 'EGS19503'),
(24, 'A', 26, 1, 'EGS19503'),
(25, 'A', 27, 1, 'EGS19503'),
(26, 'A', 28, 1, 'EGS19503'),
(27, 'A', 29, 1, 'EGS19503'),
(28, 'A', 30, 1, 'EGS19503'),
(29, 'A', 31, 1, 'EGS19503'),
(30, 'A', 32, 1, 'EGS19503'),
(31, 'A', 33, 1, 'EGS19503'),
(32, 'A', 34, 1, 'EGS19503'),
(33, 'A', 35, 1, 'EGS19503'),
(34, 'A', 36, 1, 'EGS19503');

-- --------------------------------------------------------

--
-- Estrutura para tabela `coordenador`
--

CREATE TABLE IF NOT EXISTS `coordenador` (
  `CD_COORDENADOR` int(11) NOT NULL,
  `NR_CPF` varchar(11) DEFAULT NULL,
  `NM_COORDENADOR` varchar(128) DEFAULT NULL,
  `US_PROFESSOR` varchar(1) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `coordenador`
--

INSERT INTO `coordenador` (`CD_COORDENADOR`, `NR_CPF`, `NM_COORDENADOR`, `US_PROFESSOR`, `CD_CURSO`, `CD_USUARIO`) VALUES
(1, '12345678901', 'Fernando Incerti', 'N', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `CD_CURSO` int(11) NOT NULL,
  `DS_CURSO` varchar(128) DEFAULT NULL,
  `TOT_PERIODO` int(11) DEFAULT NULL,
  `ST_CURSO` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `curso`
--

INSERT INTO `curso` (`CD_CURSO`, `DS_CURSO`, `TOT_PERIODO`, `ST_CURSO`) VALUES
(1, 'Engenharia de Software', 8, 'A');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtida_duvida_aluno`
--

CREATE TABLE IF NOT EXISTS `curtida_duvida_aluno` (
  `CD_DUVIDA` int(11) NOT NULL,
  `CURTIDA` int(11) NOT NULL,
  `CD_ALUNO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `curtida_duvida_aluno`
--

INSERT INTO `curtida_duvida_aluno` (`CD_DUVIDA`, `CURTIDA`, `CD_ALUNO`) VALUES
(8, 1, 4),
(16, 0, 20),
(16, 0, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `CD_DISCIPLINA` varchar(11) NOT NULL,
  `CD_TURNO` varchar(1) NOT NULL,
  `NR_PERIODO` int(11) DEFAULT NULL,
  `DS_DISCIPLINA` varchar(128) DEFAULT NULL,
  `ST_DISCIPLINA` varchar(1) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `disciplina`
--

INSERT INTO `disciplina` (`CD_DISCIPLINA`, `CD_TURNO`, `NR_PERIODO`, `DS_DISCIPLINA`, `ST_DISCIPLINA`, `CD_CURSO`) VALUES
('EGS19101', 'N', 1, 'Comunicação', 'A', 1),
('EGS19102', 'N', 1, 'Introdução a Engenharia de Software', 'A', 1),
('EGS19103', 'N', 1, 'Algoritmos e Lógica de Programação', 'A', 1),
('EGS19104', 'N', 1, 'Lógica Matemática', 'A', 1),
('EGS19105', 'N', 1, 'Metodologias Ágeis', 'A', 1),
('EGS19201', 'N', 2, 'Metodologia', 'A', 1),
('EGS19202', 'N', 2, 'Cálculo Diferencial e Integral', 'A', 1),
('EGS19203', 'N', 2, 'Organização e Redes de Computa', 'A', 1),
('EGS19204', 'N', 2, 'Processos e Requisitos', 'A', 1),
('EGS19205', 'N', 2, 'Estrutura de Dados', 'A', 1),
('EGS19206', 'N', 2, 'Linguagem de Programação', 'A', 1),
('EGS19301', 'N', 3, 'Filosofia', 'A', 1),
('EGS19302', 'N', 3, 'Matemática Discreta', 'A', 1),
('EGS19303', 'N', 3, 'Modelagem de Software', 'A', 1),
('EGS19304', 'N', 3, 'Desenvolvimento Orientado a Objetos', 'A', 1),
('EGS19305', 'N', 3, 'Projeto Orientado a Objetos', 'A', 1),
('EGS19401', 'N', 4, 'Sociologia - EAD', 'A', 1),
('EGS19402', 'N', 4, 'Pesquisa Operacional', 'A', 1),
('EGS19403', 'N', 4, 'Interface Homem Computador', 'A', 1),
('EGS19404', 'N', 4, 'Engenharia Econômica', 'A', 1),
('EGS19405', 'N', 4, 'Métodos de Desenvolvimento', 'A', 1),
('EGS19406', 'N', 4, 'Projeto de Design de Software', 'A', 1),
('EGS19501', 'N', 5, 'Sustentabilidade - EAD', 'A', 1),
('EGS19502', 'N', 5, 'Projeto de Software', 'A', 1),
('EGS19503', 'N', 4, 'Banco de Dados', 'A', 1),
('EGS19504', 'N', 5, 'Probabilidade e Estatística', 'A', 1),
('EGS19505', 'N', 5, 'Proj. Programação BD', 'A', 1),
('EGS19506', 'N', 5, 'Estágio Supervisionado I', 'A', 1),
('EGS19601', 'N', 6, 'Empreendedorismo - EAD', 'A', 1),
('EGS19602', 'N', 6, 'Programação Web', 'A', 1),
('EGS19603', 'N', 6, 'Gestão de Projetos', 'A', 1),
('EGS19604', 'N', 6, 'Arq.Software', 'A', 1),
('EGS19605', 'N', 6, 'Proj. Programação Web', 'A', 1),
('EGS19606', 'N', 6, 'Estágio Supervisionado II', 'A', 1),
('EGS19701', 'N', 7, 'Desenv. P/ Jogos Digitais', 'A', 1),
('EGS19702', 'N', 7, 'Desenv. P/ Disp. Móveis', 'A', 1),
('EGS19703', 'N', 7, 'Qualid. Soft.(GCM)', 'A', 1),
('EGS19704', 'N', 7, 'Proj. Desenv. Profissional I', 'A', 1),
('EGS19705', 'N', 7, 'Proj. Integração de Software', 'A', 1),
('EGS19801', 'N', 8, 'Inteligência Artificial', 'A', 1),
('EGS19802', 'N', 8, 'Big Data', 'A', 1),
('EGS19803', 'N', 8, 'Inovações Tecnológicas', 'A', 1),
('EGS19804', 'N', 8, 'Internet das Coisas IoT', 'A', 1),
('EGS19805', 'N', 8, 'Projeto de Desenv. Prof. II', 'A', 1),
('EGS19806', 'N', 8, 'Projeto de Mineração de Dados', 'A', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `duvida`
--

CREATE TABLE IF NOT EXISTS `duvida` (
  `CD_DUVIDA` int(11) NOT NULL,
  `DS_TITULO` varchar(64) DEFAULT NULL,
  `CD_DESTAQUE` varchar(1) DEFAULT NULL,
  `NR_CURTIDAS` int(11) DEFAULT NULL,
  `TP_RESPOSTA` varchar(4) DEFAULT NULL,
  `DT_HR` timestamp NULL DEFAULT NULL,
  `ST_DUVIDA` varchar(2) NOT NULL,
  `CD_ALUNO` int(11) DEFAULT NULL,
  `CD_PROFESSOR` int(11) DEFAULT NULL,
  `CD_DISCIPLINA` varchar(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `duvida`
--

INSERT INTO `duvida` (`CD_DUVIDA`, `DS_TITULO`, `CD_DESTAQUE`, `NR_CURTIDAS`, `TP_RESPOSTA`, `DT_HR`, `ST_DUVIDA`, `CD_ALUNO`, `CD_PROFESSOR`, `CD_DISCIPLINA`) VALUES
(16, 'MER', 'S', 1, NULL, '2024-11-18 01:19:33', 'R', 18, 2, 'EGS19503');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pergunta`
--

CREATE TABLE IF NOT EXISTS `pergunta` (
  `CD_PERGUNTA` int(11) NOT NULL,
  `DS_PERGUNTA` varchar(3600) DEFAULT NULL,
  `IMAGEM` longtext DEFAULT NULL,
  `DT_HR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CD_DUVIDA` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `pergunta`
--

INSERT INTO `pergunta` (`CD_PERGUNTA`, `DS_PERGUNTA`, `IMAGEM`, `DT_HR`, `CD_DUVIDA`) VALUES
(17, 'Estou com dúvidas sobre o conceito do MER, pode me dar um resumo?', '', '2024-11-18 01:19:33', 16);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `CD_PROFESSOR` int(11) NOT NULL,
  `NR_CPF` varchar(11) DEFAULT NULL,
  `NM_PROFESSOR` varchar(128) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `professor`
--

INSERT INTO `professor` (`CD_PROFESSOR`, `NR_CPF`, `NM_PROFESSOR`, `CD_USUARIO`) VALUES
(1, '11122233344', 'André Helena', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_disciplina`
--

CREATE TABLE IF NOT EXISTS `professor_disciplina` (
  `CD_PF_DISCIPLINA` int(11) NOT NULL,
  `ST_PF_DISCIPLINA` varchar(1) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL,
  `CD_DISCIPLINA` varchar(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `professor_disciplina`
--

INSERT INTO `professor_disciplina` (`CD_PF_DISCIPLINA`, `ST_PF_DISCIPLINA`, `CD_USUARIO`, `CD_CURSO`, `CD_DISCIPLINA`) VALUES
(1, 'A', 2, 1, 'EGS19503');

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta`
--

CREATE TABLE IF NOT EXISTS `resposta` (
  `CD_RESPOSTA` int(11) NOT NULL,
  `DS_RESPOSTA` varchar(3600) DEFAULT NULL,
  `IMAGEM` longtext DEFAULT NULL,
  `DT_HR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CD_PERGUNTA` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `resposta`
--

INSERT INTO `resposta` (`CD_RESPOSTA`, `DS_RESPOSTA`, `IMAGEM`, `DT_HR`, `CD_PERGUNTA`) VALUES
(10, 'O Modelo Entidade-Relacionamento (MER) é uma técnica de modelagem de dados que representa graficamente a estrutura lógica de um banco de dados. Ele inclui entidades (objetos do mundo real), atributos (propriedades das entidades) e relacionamentos (associações entre entidades).', '', '2024-11-18 01:20:45', 17);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tamanho_imagens`
--

CREATE TABLE IF NOT EXISTS `tamanho_imagens` (
  `id_tamanho_imagens` int(11) NOT NULL,
  `tabela` varchar(100) DEFAULT NULL,
  `campo` varchar(100) DEFAULT NULL,
  `largura` varchar(45) DEFAULT NULL,
  `altura` varchar(45) DEFAULT NULL,
  `largura_thumb` varchar(45) DEFAULT NULL,
  `altura_thumb` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tamanho_imagens`
--

INSERT INTO `tamanho_imagens` (`id_tamanho_imagens`, `tabela`, `campo`, `largura`, `altura`, `largura_thumb`, `altura_thumb`) VALUES
(1, 'pergunta', 'iImagem', '500', '500', '200', '200'),
(1, 'resposta', 'iImagem', '500', '500', '200', '200');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `CD_USUARIO` int(11) NOT NULL,
  `TP_USUARIO` varchar(1) DEFAULT NULL,
  `NM_USUARIO` varchar(25) DEFAULT NULL,
  `SN_USUARIO` varchar(64) DEFAULT NULL,
  `ST_USUARIO` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`CD_USUARIO`, `TP_USUARIO`, `NM_USUARIO`, `SN_USUARIO`, `ST_USUARIO`) VALUES
(1, 'C', 'fernandoincerti', 'incertifernando', 'A'),
(2, 'P', 'andrehelena', 'helenaandre', 'A'),
(3, 'A', 'barbaranycolli', 'nycollibarbara', 'A'),
(4, 'A', 'christianluan', 'luanchristian', 'A'),
(5, 'A', 'cleitonaparecido', 'aparecidocleiton', 'A'),
(6, 'A', 'eduardojose', 'joseeduardo', 'A'),
(7, 'A', 'erikasartorelli', 'sartorellierika', 'A'),
(8, 'A', 'gabrielfavero', 'faverogabriel', 'A'),
(9, 'A', 'gabrielfelipe', 'felipegabriel', 'A'),
(10, 'A', 'guilhermemaidana', 'maidanaguilherme', 'A'),
(11, 'A', 'gustavomuller', 'mullergustavo', 'A'),
(12, 'A', 'hebernaldtheopile', 'theopilehebernald', 'A'),
(13, 'A', 'heitormiguel', 'miguelheitor', 'A'),
(14, 'A', 'ianmarco', 'marcoian', 'A'),
(15, 'A', 'jeanluca', 'lucajean', 'A'),
(16, 'A', 'jeffersontales', 'talesjefferson', 'A'),
(17, 'A', 'joaootavio', 'otaviojoao', 'A'),
(18, 'A', 'joaovitor', 'vitorjoao', 'A'),
(19, 'A', 'jorgehenrique', 'henriquejorge', 'A'),
(20, 'A', 'juangabriel', 'gabrieljuan', 'A'),
(21, 'A', 'kauamatheus', 'matheuskaua', 'A'),
(22, 'A', 'kiurywoyciechowski', 'woyciechowskikiury', 'A'),
(23, 'A', 'leonardoliogi', 'liogileonardo', 'A'),
(24, 'A', 'leonardopaes', 'paesleonardo', 'A'),
(25, 'A', 'luizadossantos', 'dossantosluiza', 'A'),
(26, 'A', 'mateusmassucatto', 'massucattomateus', 'A'),
(27, 'A', 'matheuseduardo', 'eduardomatheus', 'A'),
(28, 'A', 'matheushenrique', 'henriquematheus', 'A'),
(29, 'A', 'pedrohenrique', 'henriquepedro', 'A'),
(30, 'A', 'phelipecartaxo', 'cartaxophelipe', 'A'),
(31, 'A', 'rafaelkaito', 'kaitorafael', 'A'),
(32, 'A', 'raultorres', 'torresraul', 'A'),
(33, 'A', 'tiagomendonca', 'mendoncatiago', 'A'),
(34, 'A', 'walacepereira', 'pereirawalace', 'A'),
(35, 'A', 'willyamgabriel', 'gabrielwillyam', 'A'),
(36, 'A', 'wyllyanribiski', 'ribiskiwyllyan', 'A');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`CD_ALUNO`), ADD UNIQUE KEY `RA_ALUNO` (`RA_ALUNO`), ADD KEY `CD_USUARIO` (`CD_USUARIO`);

--
-- Índices de tabela `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  ADD PRIMARY KEY (`CD_AL_DISCIPLINA`), ADD KEY `CD_USUARIO` (`CD_USUARIO`), ADD KEY `CD_CURSO` (`CD_CURSO`), ADD KEY `CD_DISCIPLINA` (`CD_DISCIPLINA`);

--
-- Índices de tabela `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`CD_COORDENADOR`), ADD UNIQUE KEY `NR_CPF` (`NR_CPF`), ADD KEY `CD_CURSO` (`CD_CURSO`), ADD KEY `CD_USUARIO` (`CD_USUARIO`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`CD_CURSO`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`CD_DISCIPLINA`), ADD KEY `CD_CURSO` (`CD_CURSO`);

--
-- Índices de tabela `duvida`
--
ALTER TABLE `duvida`
  ADD PRIMARY KEY (`CD_DUVIDA`), ADD KEY `CD_ALUNO` (`CD_ALUNO`), ADD KEY `CD_PROFESSOR` (`CD_PROFESSOR`), ADD KEY `CD_DISCIPLINA` (`CD_DISCIPLINA`);

--
-- Índices de tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`CD_PERGUNTA`), ADD KEY `CD_DUVIDA` (`CD_DUVIDA`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`CD_PROFESSOR`), ADD UNIQUE KEY `NR_CPF` (`NR_CPF`), ADD KEY `CD_USUARIO` (`CD_USUARIO`);

--
-- Índices de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD PRIMARY KEY (`CD_PF_DISCIPLINA`), ADD KEY `CD_USUARIO` (`CD_USUARIO`), ADD KEY `CD_CURSO` (`CD_CURSO`), ADD KEY `CD_DISCIPLINA` (`CD_DISCIPLINA`);

--
-- Índices de tabela `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`CD_RESPOSTA`), ADD KEY `CD_PERGUNTA` (`CD_PERGUNTA`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CD_USUARIO`), ADD UNIQUE KEY `NM_USUARIO` (`NM_USUARIO`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `CD_ALUNO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de tabela `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  MODIFY `CD_AL_DISCIPLINA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de tabela `coordenador`
--
ALTER TABLE `coordenador`
  MODIFY `CD_COORDENADOR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `CD_CURSO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `duvida`
--
ALTER TABLE `duvida`
  MODIFY `CD_DUVIDA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `CD_PERGUNTA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `CD_PROFESSOR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  MODIFY `CD_PF_DISCIPLINA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de tabela `resposta`
--
ALTER TABLE `resposta`
  MODIFY `CD_RESPOSTA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `CD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`);

--
-- Restrições para tabelas `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
ADD CONSTRAINT `aluno_disciplina_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`),
ADD CONSTRAINT `aluno_disciplina_ibfk_2` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`),
ADD CONSTRAINT `aluno_disciplina_ibfk_3` FOREIGN KEY (`CD_DISCIPLINA`) REFERENCES `disciplina` (`CD_DISCIPLINA`);

--
-- Restrições para tabelas `coordenador`
--
ALTER TABLE `coordenador`
ADD CONSTRAINT `coordenador_ibfk_1` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`),
ADD CONSTRAINT `coordenador_ibfk_2` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`);

--
-- Restrições para tabelas `disciplina`
--
ALTER TABLE `disciplina`
ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`);

--
-- Restrições para tabelas `duvida`
--
ALTER TABLE `duvida`
ADD CONSTRAINT `duvida_ibfk_1` FOREIGN KEY (`CD_ALUNO`) REFERENCES `aluno_disciplina` (`CD_AL_DISCIPLINA`),
ADD CONSTRAINT `duvida_ibfk_2` FOREIGN KEY (`CD_PROFESSOR`) REFERENCES `professor_disciplina` (`CD_USUARIO`),
ADD CONSTRAINT `duvida_ibfk_3` FOREIGN KEY (`CD_DISCIPLINA`) REFERENCES `disciplina` (`CD_DISCIPLINA`);

--
-- Restrições para tabelas `pergunta`
--
ALTER TABLE `pergunta`
ADD CONSTRAINT `pergunta_ibfk_1` FOREIGN KEY (`CD_DUVIDA`) REFERENCES `duvida` (`CD_DUVIDA`);

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`);

--
-- Restrições para tabelas `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
ADD CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`),
ADD CONSTRAINT `professor_disciplina_ibfk_2` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`),
ADD CONSTRAINT `professor_disciplina_ibfk_3` FOREIGN KEY (`CD_DISCIPLINA`) REFERENCES `disciplina` (`CD_DISCIPLINA`);

--
-- Restrições para tabelas `resposta`
--
ALTER TABLE `resposta`
ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`CD_PERGUNTA`) REFERENCES `pergunta` (`CD_PERGUNTA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
