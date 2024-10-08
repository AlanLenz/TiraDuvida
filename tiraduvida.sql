-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 03:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiraduvida`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `CD_ALUNO` int(11) NOT NULL,
  `RA_ALUNO` varchar(32) DEFAULT NULL,
  `NM_ALUNO` varchar(128) DEFAULT NULL,
  `NR_PERIODO` int(11) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`CD_ALUNO`, `RA_ALUNO`, `NM_ALUNO`, `NR_PERIODO`, `CD_USUARIO`) VALUES
(1, 'RA123456', 'Lucas Almeida', 1, 5),
(2, 'RA123457', 'Isabela Rocha', 2, 6),
(3, 'RA123458', 'Rafael Pereira', 3, 7),
(4, 'RA0001', 'Ana Silva', 1, 15),
(5, 'RA0002', 'Bruno Oliveira', 1, 16),
(6, 'RA0003', 'Carla Santos', 1, 17),
(7, 'RA0004', 'Daniel Costa', 1, 18),
(8, 'RA0005', 'Eduarda Lima', 1, 19),
(9, 'RA0006', 'Felipe Almeida', 1, 20),
(10, 'RA0007', 'Gabriela Pereira', 1, 21),
(11, 'RA0008', 'Henrique Martins', 1, 22),
(12, 'RA0009', 'Isabella Lima', 1, 23),
(13, 'RA0010', 'João Ferreira', 1, 24),
(14, 'RA0011', 'Karla Oliveira', 2, 25),
(15, 'RA0012', 'Lucas Fernandes', 2, 26),
(16, 'RA0013', 'Mariana Souza', 2, 27),
(17, 'RA0014', 'Nathalia Costa', 2, 28),
(18, 'RA0015', 'Otavio Lima', 2, 29),
(19, 'RA0016', 'Paula Almeida', 2, 30),
(20, 'RA0017', 'Quinn Santos', 2, 31),
(21, 'RA0018', 'Roberta Martins', 2, 32),
(22, 'RA0019', 'Samuel Ferreira', 2, 33),
(23, 'RA0020', 'Tatiane Silva', 2, 34);

-- --------------------------------------------------------

--
-- Table structure for table `aluno_disciplina`
--

CREATE TABLE `aluno_disciplina` (
  `CD_AL_DISCIPLINA` int(11) NOT NULL,
  `ST_AL_DISCIPLINA` varchar(1) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL,
  `CD_DISCIPLINA` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aluno_disciplina`
--

INSERT INTO `aluno_disciplina` (`CD_AL_DISCIPLINA`, `ST_AL_DISCIPLINA`, `CD_USUARIO`, `CD_CURSO`, `CD_DISCIPLINA`) VALUES
(1, 'A', 5, 1, 'EGS19101'),
(2, 'A', 5, 1, 'EGS19102'),
(3, 'A', 5, 1, 'EGS19103'),
(4, 'A', 5, 1, 'EGS19104'),
(5, 'A', 5, 1, 'EGS19105'),
(6, 'A', 6, 1, 'EGS19201'),
(7, 'A', 6, 1, 'EGS19202'),
(8, 'A', 6, 1, 'EGS19203'),
(9, 'A', 6, 1, 'EGS19204'),
(10, 'A', 6, 1, 'EGS19205'),
(11, 'A', 7, 1, 'EGS19301'),
(12, 'A', 7, 1, 'EGS19302'),
(13, 'A', 7, 1, 'EGS19303'),
(14, 'A', 7, 1, 'EGS19304'),
(15, 'A', 7, 1, 'EGS19305'),
(16, 'A', 15, 1, 'EGS19101'),
(17, 'A', 16, 1, 'EGS19102'),
(18, 'A', 17, 1, 'EGS19103'),
(19, 'A', 18, 1, 'EGS19104'),
(20, 'A', 19, 1, 'EGS19105'),
(21, 'A', 20, 1, 'EGS19201'),
(22, 'A', 21, 1, 'EGS19202'),
(23, 'A', 22, 1, 'EGS19203'),
(24, 'A', 23, 1, 'EGS19204'),
(25, 'A', 24, 1, 'EGS19205'),
(26, 'A', 25, 1, 'EGS19301'),
(27, 'A', 26, 1, 'EGS19302'),
(28, 'A', 27, 1, 'EGS19303'),
(29, 'A', 28, 1, 'EGS19304'),
(30, 'A', 29, 1, 'EGS19305'),
(31, 'A', 30, 1, 'EGS19401'),
(32, 'A', 31, 1, 'EGS19402'),
(33, 'A', 32, 1, 'EGS19403'),
(34, 'A', 33, 1, 'EGS19404'),
(35, 'A', 34, 1, 'EGS19405');

-- --------------------------------------------------------

--
-- Table structure for table `coordenador`
--

CREATE TABLE `coordenador` (
  `CD_COORDENADOR` int(11) NOT NULL,
  `NR_CPF` varchar(11) DEFAULT NULL,
  `NM_COORDENADOR` varchar(128) DEFAULT NULL,
  `US_PROFESSOR` varchar(1) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coordenador`
--

INSERT INTO `coordenador` (`CD_COORDENADOR`, `NR_CPF`, `NM_COORDENADOR`, `US_PROFESSOR`, `CD_CURSO`, `CD_USUARIO`) VALUES
(1, '12345678901', 'Carlos Silva', 'N', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `CD_CURSO` int(11) NOT NULL,
  `DS_CURSO` varchar(128) DEFAULT NULL,
  `TOT_PERIODO` int(11) DEFAULT NULL,
  `ST_CURSO` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`CD_CURSO`, `DS_CURSO`, `TOT_PERIODO`, `ST_CURSO`) VALUES
(1, 'Engenharia de Software', 8, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `disciplina`
--

CREATE TABLE `disciplina` (
  `CD_DISCIPLINA` varchar(11) NOT NULL,
  `CD_TURNO` varchar(1) NOT NULL,
  `NR_PERIODO` int(11) DEFAULT NULL,
  `DS_DISCIPLINA` varchar(128) DEFAULT NULL,
  `ST_DISCIPLINA` varchar(1) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `disciplina`
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
('EGS19503', 'N', 5, 'Banco de Dados', 'A', 1),
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
-- Table structure for table `duvida`
--

CREATE TABLE `duvida` (
  `CD_DUVIDA` int(11) NOT NULL,
  `DS_TITULO` varchar(64) DEFAULT NULL,
  `CD_DESTAQUE` varchar(1) DEFAULT NULL,
  `NR_CURTIDAS` int(11) DEFAULT NULL,
  `TP_RESPOSTA` varchar(4) DEFAULT NULL,
  `DT_HR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ST_DUVIDA` varchar(2) NOT NULL,
  `CD_ALUNO` int(11) DEFAULT NULL,
  `CD_PROFESSOR` int(11) DEFAULT NULL,
  `CD_DISCIPLINA` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `duvida`
--

INSERT INTO `duvida` (`CD_DUVIDA`, `DS_TITULO`, `CD_DESTAQUE`, `NR_CURTIDAS`, `TP_RESPOSTA`, `DT_HR`, `ST_DUVIDA`, `CD_ALUNO`, `CD_PROFESSOR`, `CD_DISCIPLINA`) VALUES
(1, 'Blandit libero volutpat sed cras ornare arcu?', 'S', 2, 'A', '2024-10-08 00:41:20', 'OC', 30, 1, 'EGS19101');

-- --------------------------------------------------------

--
-- Table structure for table `pergunta`
--

CREATE TABLE `pergunta` (
  `CD_PERGUNTA` int(11) NOT NULL,
  `DS_PERGUNTA` varchar(3600) DEFAULT NULL,
  `DT_HR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CD_DUVIDA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pergunta`
--

INSERT INTO `pergunta` (`CD_PERGUNTA`, `DS_PERGUNTA`, `DT_HR`, `CD_DUVIDA`) VALUES
(1, 'Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Vitae ultricies leo integer malesuada nunc vel. Nibh cras pulvinar mattis nunc sed. Convallis a cras semper auctor neque vitae tempus. Mattis molestie a iaculis at erat pellentesque adipiscing.\r\n\r\n', '2024-10-06 19:57:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `CD_PROFESSOR` int(11) NOT NULL,
  `NR_CPF` varchar(11) DEFAULT NULL,
  `NM_PROFESSOR` varchar(128) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`CD_PROFESSOR`, `NR_CPF`, `NM_PROFESSOR`, `CD_USUARIO`) VALUES
(1, '11122233344', 'Ana Costa', 2),
(2, '55566677788', 'Pedro Oliveira', 3),
(3, '99900011122', 'Mariana Santos', 4),
(4, '22233344455', 'Gabriel Martins', 8),
(5, '33344455566', 'Fernanda Lima', 9),
(6, '44455566677', 'Roberto Souza', 10),
(7, '12345678901', 'Lucas Pereira', 11),
(8, '23456789012', 'Juliana Costa', 12),
(9, '34567890123', 'Mateus Lima', 13),
(10, '45678901234', 'Beatriz Almeida', 14);

-- --------------------------------------------------------

--
-- Table structure for table `professor_disciplina`
--

CREATE TABLE `professor_disciplina` (
  `CD_PF_DISCIPLINA` int(11) NOT NULL,
  `ST_PF_DISCIPLINA` varchar(1) DEFAULT NULL,
  `CD_USUARIO` int(11) DEFAULT NULL,
  `CD_CURSO` int(11) DEFAULT NULL,
  `CD_DISCIPLINA` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `professor_disciplina`
--

INSERT INTO `professor_disciplina` (`CD_PF_DISCIPLINA`, `ST_PF_DISCIPLINA`, `CD_USUARIO`, `CD_CURSO`, `CD_DISCIPLINA`) VALUES
(1, 'A', 2, 1, 'EGS19101'),
(2, 'A', 2, 1, 'EGS19102'),
(3, 'A', 2, 1, 'EGS19201'),
(4, 'A', 2, 1, 'EGS19202'),
(5, 'A', 2, 1, 'EGS19301'),
(6, 'A', 3, 1, 'EGS19103'),
(7, 'A', 3, 1, 'EGS19104'),
(8, 'A', 3, 1, 'EGS19203'),
(9, 'A', 3, 1, 'EGS19204'),
(10, 'A', 3, 1, 'EGS19302'),
(11, 'A', 4, 1, 'EGS19105'),
(12, 'A', 4, 1, 'EGS19205'),
(13, 'A', 4, 1, 'EGS19206'),
(14, 'A', 4, 1, 'EGS19303'),
(15, 'A', 4, 1, 'EGS19304'),
(21, 'A', 8, 1, 'EGS19305'),
(22, 'A', 8, 1, 'EGS19401'),
(23, 'A', 8, 1, 'EGS19502'),
(24, 'A', 8, 1, 'EGS19601'),
(25, 'A', 8, 1, 'EGS19701'),
(26, 'A', 9, 1, 'EGS19402'),
(27, 'A', 9, 1, 'EGS19503'),
(28, 'A', 9, 1, 'EGS19602'),
(29, 'A', 9, 1, 'EGS19702'),
(30, 'A', 9, 1, 'EGS19801'),
(31, 'A', 10, 1, 'EGS19403'),
(32, 'A', 10, 1, 'EGS19504'),
(33, 'A', 10, 1, 'EGS19603'),
(34, 'A', 10, 1, 'EGS19703'),
(35, 'A', 10, 1, 'EGS19705'),
(36, 'A', 11, 1, 'EGS19404'),
(37, 'A', 11, 1, 'EGS19501'),
(38, 'A', 11, 1, 'EGS19604'),
(39, 'A', 11, 1, 'EGS19802'),
(40, 'A', 11, 1, 'EGS19803'),
(41, 'A', 12, 1, 'EGS19405'),
(42, 'A', 12, 1, 'EGS19505'),
(43, 'A', 12, 1, 'EGS19605'),
(44, 'A', 12, 1, 'EGS19704'),
(45, 'A', 12, 1, 'EGS19804'),
(46, 'A', 13, 1, 'EGS19406'),
(47, 'A', 13, 1, 'EGS19506'),
(48, 'A', 13, 1, 'EGS19606'),
(49, 'A', 13, 1, 'EGS19805'),
(50, 'A', 13, 1, 'EGS19806'),
(51, 'A', 14, 1, 'EGS19402'),
(52, 'A', 14, 1, 'EGS19503'),
(53, 'A', 14, 1, 'EGS19504'),
(54, 'A', 14, 1, 'EGS19603'),
(55, 'A', 14, 1, 'EGS19702');

-- --------------------------------------------------------

--
-- Table structure for table `resposta`
--

CREATE TABLE `resposta` (
  `CD_RESPOSTA` int(11) NOT NULL,
  `DS_RESPOSTA` varchar(3600) DEFAULT NULL,
  `DT_HR` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CD_PERGUNTA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `CD_USUARIO` int(11) NOT NULL,
  `TP_USUARIO` varchar(1) DEFAULT NULL,
  `NM_USUARIO` varchar(25) DEFAULT NULL,
  `SN_USUARIO` varchar(64) DEFAULT NULL,
  `ST_USUARIO` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`CD_USUARIO`, `TP_USUARIO`, `NM_USUARIO`, `SN_USUARIO`, `ST_USUARIO`) VALUES
(1, 'C', 'carlossilva', 'coordenador123', 'A'),
(2, 'P', 'anacosta', 'professor123', 'A'),
(3, 'P', 'pedrooliveira', 'professor456', 'A'),
(4, 'P', 'marianasantos', 'professor789', 'A'),
(5, 'A', 'lucasalmeida', 'aluno123', 'A'),
(6, 'A', 'isabelarocha', 'aluno456', 'A'),
(7, 'A', 'rafaelpereira', 'aluno789', 'A'),
(8, 'P', 'gabrielmartins', 'professor987', 'A'),
(9, 'P', 'fernandalima', 'professor654', 'A'),
(10, 'P', 'robertosouza', 'professor321', 'A'),
(11, 'P', 'lucaspereira', 'senha_lucas', 'A'),
(12, 'P', 'julianacosta', 'senha_juliana', 'A'),
(13, 'P', 'mateuslima', 'senha_mateus', 'A'),
(14, 'P', 'beatrizalmeida', 'senha_beatriz', 'A'),
(15, 'A', 'ana_silva', 'senha_ana', 'A'),
(16, 'A', 'bruno_oliveira', 'senha_bruno', 'A'),
(17, 'A', 'carla_santos', 'senha_carla', 'A'),
(18, 'A', 'daniel_costa', 'senha_daniel', 'A'),
(19, 'A', 'eduarda_lima', 'senha_eduarda', 'A'),
(20, 'A', 'felipe_almeida', 'senha_felipe', 'A'),
(21, 'A', 'gabriela_pereira', 'senha_gabriela', 'A'),
(22, 'A', 'henrique_martins', 'senha_henrique', 'A'),
(23, 'A', 'isabella_lima', 'senha_isabella', 'A'),
(24, 'A', 'joao_ferreira', 'senha_joao', 'A'),
(25, 'A', 'karla_oliveira', 'senha_karla', 'A'),
(26, 'A', 'lucas_fernandes', 'senha_lucas', 'A'),
(27, 'A', 'mariana_souza', 'senha_mariana', 'A'),
(28, 'A', 'nathalia_costa', 'senha_nathalia', 'A'),
(29, 'A', 'otavio_lima', 'senha_otavio', 'A'),
(30, 'A', 'paula_almeida', 'senha_paula', 'A'),
(31, 'A', 'quinn_santos', 'senha_quinn', 'A'),
(32, 'A', 'roberta_martins', 'senha_roberta', 'A'),
(33, 'A', 'samuel_ferreira', 'senha_samuel', 'A'),
(34, 'A', 'tatiane_silva', 'senha_tatiane', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`CD_ALUNO`),
  ADD UNIQUE KEY `RA_ALUNO` (`RA_ALUNO`),
  ADD KEY `CD_USUARIO` (`CD_USUARIO`);

--
-- Indexes for table `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  ADD PRIMARY KEY (`CD_AL_DISCIPLINA`),
  ADD KEY `CD_USUARIO` (`CD_USUARIO`),
  ADD KEY `CD_CURSO` (`CD_CURSO`),
  ADD KEY `CD_DISCIPLINA` (`CD_DISCIPLINA`);

--
-- Indexes for table `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`CD_COORDENADOR`),
  ADD UNIQUE KEY `NR_CPF` (`NR_CPF`),
  ADD KEY `CD_CURSO` (`CD_CURSO`),
  ADD KEY `CD_USUARIO` (`CD_USUARIO`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`CD_CURSO`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`CD_DISCIPLINA`),
  ADD KEY `CD_CURSO` (`CD_CURSO`);

--
-- Indexes for table `duvida`
--
ALTER TABLE `duvida`
  ADD PRIMARY KEY (`CD_DUVIDA`),
  ADD KEY `CD_ALUNO` (`CD_ALUNO`),
  ADD KEY `CD_PROFESSOR` (`CD_PROFESSOR`),
  ADD KEY `CD_DISCIPLINA` (`CD_DISCIPLINA`);

--
-- Indexes for table `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`CD_PERGUNTA`),
  ADD KEY `CD_DUVIDA` (`CD_DUVIDA`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`CD_PROFESSOR`),
  ADD UNIQUE KEY `NR_CPF` (`NR_CPF`),
  ADD KEY `CD_USUARIO` (`CD_USUARIO`);

--
-- Indexes for table `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD PRIMARY KEY (`CD_PF_DISCIPLINA`),
  ADD KEY `CD_USUARIO` (`CD_USUARIO`),
  ADD KEY `CD_CURSO` (`CD_CURSO`),
  ADD KEY `CD_DISCIPLINA` (`CD_DISCIPLINA`);

--
-- Indexes for table `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`CD_RESPOSTA`),
  ADD KEY `CD_PERGUNTA` (`CD_PERGUNTA`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CD_USUARIO`),
  ADD UNIQUE KEY `NM_USUARIO` (`NM_USUARIO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `CD_ALUNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  MODIFY `CD_AL_DISCIPLINA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `coordenador`
--
ALTER TABLE `coordenador`
  MODIFY `CD_COORDENADOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `CD_CURSO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `duvida`
--
ALTER TABLE `duvida`
  MODIFY `CD_DUVIDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `CD_PERGUNTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `CD_PROFESSOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  MODIFY `CD_PF_DISCIPLINA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `resposta`
--
ALTER TABLE `resposta`
  MODIFY `CD_RESPOSTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `CD_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`);

--
-- Constraints for table `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  ADD CONSTRAINT `aluno_disciplina_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`),
  ADD CONSTRAINT `aluno_disciplina_ibfk_2` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`),
  ADD CONSTRAINT `aluno_disciplina_ibfk_3` FOREIGN KEY (`CD_DISCIPLINA`) REFERENCES `disciplina` (`CD_DISCIPLINA`);

--
-- Constraints for table `coordenador`
--
ALTER TABLE `coordenador`
  ADD CONSTRAINT `coordenador_ibfk_1` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`),
  ADD CONSTRAINT `coordenador_ibfk_2` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`);

--
-- Constraints for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`);

--
-- Constraints for table `duvida`
--
ALTER TABLE `duvida`
  ADD CONSTRAINT `duvida_ibfk_1` FOREIGN KEY (`CD_ALUNO`) REFERENCES `aluno_disciplina` (`CD_AL_DISCIPLINA`),
  ADD CONSTRAINT `duvida_ibfk_2` FOREIGN KEY (`CD_PROFESSOR`) REFERENCES `professor_disciplina` (`CD_PF_DISCIPLINA`),
  ADD CONSTRAINT `duvida_ibfk_3` FOREIGN KEY (`CD_DISCIPLINA`) REFERENCES `disciplina` (`CD_DISCIPLINA`);

--
-- Constraints for table `pergunta`
--
ALTER TABLE `pergunta`
  ADD CONSTRAINT `pergunta_ibfk_1` FOREIGN KEY (`CD_DUVIDA`) REFERENCES `duvida` (`CD_DUVIDA`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`);

--
-- Constraints for table `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`),
  ADD CONSTRAINT `professor_disciplina_ibfk_2` FOREIGN KEY (`CD_CURSO`) REFERENCES `curso` (`CD_CURSO`),
  ADD CONSTRAINT `professor_disciplina_ibfk_3` FOREIGN KEY (`CD_DISCIPLINA`) REFERENCES `disciplina` (`CD_DISCIPLINA`);

--
-- Constraints for table `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`CD_PERGUNTA`) REFERENCES `pergunta` (`CD_PERGUNTA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
