-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 05/01/2020 às 17:37
-- Versão do servidor: 10.3.17-MariaDB-0+deb10u1
-- Versão do PHP: 7.3.11-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_aluno` (`matricula_aluno` INTEGER)  BEGIN

	SET @matricula_valida = (SELECT COUNT(*) FROM alunos WHERE matricula = matricula_aluno);
	
	IF(@matricula_valida > 0)THEN
	
		DELETE FROM alunos WHERE matricula = matricula_aluno;
		
		SELECT "Aluno deletado com sucesso!" AS MSG;
		
	ELSE
	
		SELECT "Erro, matrícula não encontrada!" AS MSG;
		
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_aluno_disciplina` (`chave` INTEGER)  BEGIN

	SET @id_existe = (SELECT COUNT(*) FROM alunos_disciplinas WHERE id = chave);
	
	IF(@id_existe > 0)THEN

		DELETE FROM alunos_disciplinas WHERE id = chave;
		
		SELECT "Boletim deletado com sucesso!" AS MSG;
		
	ELSE
	
		SELECT "Erro, boletim não encontrado!" AS MSG;
		
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_disciplina` (`codigo_disciplina` INTEGER)  BEGIN

	SET @codigo_valido = (SELECT COUNT(*) FROM disciplinas WHERE codigo = codigo_disciplina);
	
	IF(@codigo_valido > 0)THEN
	
		DELETE FROM disciplinas WHERE codigo = codigo_disciplina;
		
		SELECT "Disciplina deletada com sucesso!" AS MSG;
		
	ELSE
	
		SELECT "Erro, código não encontrado!" AS MSG;
		
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_aluno` (IN `nome_aluno` VARCHAR(60))  BEGIN

	SET @nome_existe = (SELECT COUNT(*) FROM alunos WHERE nome = nome_aluno);

	IF(@nome_existe > 0)THEN
	
		SELECT "Erro, esse aluno já está registrado!" AS MSG;
	
	ELSE
	
		INSERT INTO alunos(nome)
			VALUES(nome_aluno);
			
		SELECT "Aluno inserido com sucesso!" AS MSG;
		
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_aluno_disciplina` (`matricula_aluno` INTEGER, `codigo_disciplina` INTEGER, `nota1` DOUBLE, `nota2` DOUBLE, `nota3` DOUBLE, `nota4` DOUBLE)  BEGIN

	SET @aluno_existe = (SELECT COUNT(*) FROM alunos WHERE matricula = matricula_aluno);

	IF(@aluno_existe = 0)THEN
	
		SELECT "Erro, aluno não encontrado!" AS MSG;
		
	END IF;
	
	SET @disciplina_existe = (SELECT COUNT(*) FROM disciplinas WHERE codigo = codigo_disciplina);
	
	IF(@disciplina_existe = 0)THEN
	
		SELECT "Erro, disciplina não encontrada!" AS MSG;
		
	END IF;
	
	SET @nota1_valida = valida_nota(nota1);
	
	IF(@nota1_valida = 0)THEN
	
		SELECT "Erro, nota 1 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	SET @nota2_valida = valida_nota(nota2);
	
	IF(@nota2_valida = 0)THEN
	
		SELECT "Erro, nota 2 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	SET @nota3_valida = valida_nota(nota3);
	
	IF(@nota3_valida = 0)THEN
	
		SELECT "Erro, nota 3 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	SET @nota4_valida = valida_nota(nota4);
	
	IF(@nota4_valida = 0)THEN
	
		SELECT "Erro, nota 4 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	IF(@aluno_existe > 0 AND @disciplina_existe > 0 AND @nota1_valida = 1 AND @nota2_valida = 1 AND @nota3_valida = 1 AND @nota4_valida = 1)THEN
	
		INSERT INTO alunos_disciplinas(matr_aluno, cod_disciplina, n1, n2, n3, n4)
			VALUES(matricula_aluno, codigo_disciplina, nota1, nota2, nota3, nota4);
			
		SELECT "Boletim inserido com sucesso!" AS MSG;
		
	ELSE
	
		SELECT "Erro, boletim não inserido!" AS MSG;
		
	END IF; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_disciplina` (`nome_disciplina` VARCHAR(60))  BEGIN

	SET @nome_existe = (SELECT COUNT(*) FROM disciplinas WHERE nome = nome_disciplina);

	IF(@nome_existe > 0)THEN
	
		SELECT "Erro, essa disciplina já está registrada!" AS MSG;
		
	ELSE
	
		INSERT INTO disciplinas(nome)
			VALUES(nome_disciplina);
			
		SELECT "Disciplina inserida com sucesso!" AS MSG;
		
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_aluno` (`matricula_aluno` INTEGER, `nome_aluno` VARCHAR(60))  BEGIN

	SET @matricula_existe = (SELECT COUNT(*) FROM alunos WHERE matricula = matricula_aluno);
	
	IF(@matricula_existe > 0)THEN
	
		SET @nome_existe = (SELECT COUNT(*) FROM alunos WHERE nome = nome_aluno AND matricula != matricula_aluno);
	
		IF(@nome_existe > 0)THEN
		
			SELECT "Erro, esse nome já está sendo usado por outro aluno!" AS MSG;
		
		ELSE
		
			UPDATE alunos SET nome = nome_aluno WHERE matricula = matricula_aluno;
			
			SELECT "Aluno atualizado com sucesso!" AS MSG;
		
		END IF;
	
	ELSE
	
		SELECT "Erro, matricula não encontrada!" AS MSG;
	
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_aluno_disciplina` (`chave` INTEGER, `nota1` DOUBLE, `nota2` DOUBLE, `nota3` DOUBLE, `nota4` DOUBLE)  BEGIN

	SET @id_existe = (SELECT COUNT(*) FROM alunos_disciplinas WHERE id = chave);
	
	IF(@id_existe = 0)THEN
    
    	SELECT "Erro, boletim inválido!" AS MSG;
	
	END IF;
	
	SET @nota1_valida = valida_nota(nota1);
	
	IF(@nota1_valida = 0)THEN
	
		SELECT "Erro, nota 1 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	SET @nota2_valida = valida_nota(nota2);
	
	IF(@nota2_valida = 0)THEN
	
		SELECT "Erro, nota 2 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	SET @nota3_valida = valida_nota(nota3);
	
	IF(@nota3_valida = 0)THEN
	
		SELECT "Erro, nota 3 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	SET @nota4_valida = valida_nota(nota4);
	
	IF(@nota4_valida = 0)THEN
	
		SELECT "Erro, nota 4 inválida digite um valor entre 0 e 10!" AS MSG;
		
	END IF;
	
	IF(@id_existe > 0 AND @nota1_valida = 1 AND @nota2_valida = 1 AND @nota3_valida = 1 AND @nota4_valida = 1)THEN

		UPDATE alunos_disciplinas SET n1 = nota1, n2 = nota2, n3 = nota3, n4 = nota4 WHERE id = chave;

		SELECT "Boletim atualizado com sucesso!" AS MSG;
		
	ELSE
	
		SELECT "Erro, dados inválidos!" AS MSG;
	
	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_disciplina` (`codigo_disciplina` INTEGER, `nome_disciplina` VARCHAR(60))  BEGIN

	SET @codigo_existe = (SELECT COUNT(*) FROM disciplinas WHERE codigo = codigo_disciplina);

	IF(@codigo_existe > 0)THEN
	
		SET @nome_existe = (SELECT COUNT(*) FROM disciplinas WHERE nome = nome_disciplina AND codigo != codigo_disciplina);
	
		IF(@nome_existe > 0)THEN
	
			SELECT "Erro, esse nome de disciplina já está registrado!" AS MSG;
			
		ELSE

			UPDATE disciplinas SET nome = nome_disciplina WHERE codigo = codigo_disciplina;
		
			SELECT "Disciplina atualizada com sucesso!" AS MSG;
			
		END IF;
	
	ELSE
	
		SELECT "Erro, código inválido!" AS MSG;
	
	END IF;

END$$

--
-- Funções
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cont_alunos` (`codigo_disciplina` INTEGER) RETURNS INT(11) BEGIN
	
	SET @alunos = (SELECT COUNT(*) FROM alunos_disciplinas WHERE cod_disciplina = codigo_disciplina);
	
	RETURN @alunos;
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `cont_disciplinas` (`matricula_aluno` INTEGER) RETURNS INT(11) BEGIN

		SET @disciplinas = (SELECT COUNT(*) FROM alunos_disciplinas WHERE matr_aluno = matricula_aluno);

	RETURN @disciplinas;
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `cont_situacao_aluno` (`matricula_aluno` INTEGER, `situacao` VARCHAR(12)) RETURNS INT(11) BEGIN

		SET @quantidade = (SELECT COUNT(*) FROM alunos_disciplinas WHERE matr_aluno = matricula_aluno AND situacao(n1, n2, n3, n4) = situacao);

	RETURN @quantidade;
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `cont_situacao_disciplina` (`codigo_disciplina` INTEGER, `situacao` VARCHAR(12)) RETURNS INT(11) BEGIN
	
		SET @quantidade = (SELECT COUNT(*) FROM alunos_disciplinas WHERE cod_disciplina = codigo_disciplina AND situacao(n1, n2, n3, n4) = situacao);
	
	RETURN @quantidade;
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `faz_disciplina` (`codigo_disciplina` INTEGER, `matricula_aluno` INTEGER) RETURNS TINYINT(1) BEGIN
    
        SET @faz_disciplina = (SELECT COUNT(*) FROM alunos_disciplinas WHERE matr_aluno = matricula_aluno AND cod_disciplina = codigo_disciplina);
        
        IF(@faz_disciplina > 0)THEN
            SET @retorno = 1;
        ELSE
            SET @retorno = 0;
        END IF;
        
        RETURN @retorno;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `media` (`nota1` DOUBLE, `nota2` DOUBLE, `nota3` DOUBLE, `nota4` DOUBLE) RETURNS DOUBLE BEGIN
	
		SET @media = (nota1 + nota2 + nota3 + nota4) / 4;
		
		RETURN @media;
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `situacao` (`nota1` DOUBLE, `nota2` DOUBLE, `nota3` DOUBLE, `nota4` DOUBLE) RETURNS VARCHAR(12) CHARSET utf8 BEGIN
		
		SET @media = media(nota1, nota2, nota3, nota4);
			
		IF(@media >= 7)THEN
				
			SET @situacao = "Aprovado";
			
		END IF;
		IF(@media >= 6 AND @media < 7)THEN

			SET @situacao = "Recuperação";

		END IF;
		IF(@media < 6)THEN

			SET @situacao = "Reprovado";
			
		END IF;
	
	RETURN @situacao;
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `valida_nota` (`nota` DOUBLE) RETURNS TINYINT(1) BEGIN
	
		IF(nota >= 0 AND nota <= 10)THEN
		
			SET @retorno = 1;
			
		ELSE
		
			SET @retorno = 0;
			
		END IF;
		
	RETURN @retorno;
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `alunos`
--

INSERT INTO `alunos` (`matricula`, `nome`) VALUES
(1, 'Renato Rodrigues'),
(3, 'Evelin dos Santos da Silva'),
(4, 'José Raimundo'),
(5, 'Carlos Nascimento'),
(6, 'Vanessa Cristina de Souza'),
(11, 'Nayara Silva'),
(13, 'Mariana dos Santos'),
(14, 'Valentina da Silva'),
(15, 'Leidiane da Silva'),
(16, 'Ricardo Sousa'),
(17, 'Marília da Silva'),
(21, 'Marília de Sousa'),
(22, 'Laricy Cardoso'),
(23, 'Viviane Araújo'),
(24, 'Thaiane Silva'),
(25, 'Jéssica Alves'),
(26, 'Regina de Souza'),
(27, 'Sabrina Santos'),
(28, 'Fabiana Silva'),
(30, 'Sérgio Nascimento'),
(31, 'Maria do Socorro'),
(32, 'Renato Dionízio'),
(33, 'Frederico Amorim Silva'),
(34, 'Thainara Guterres'),
(35, 'Hiago de Castro'),
(36, 'Maria dos Remédios'),
(37, 'Lucas Delgado'),
(38, 'Paulo de Castro'),
(41, 'Caroline Ferreira da Silva');

--
-- Gatilhos `alunos`
--
DELIMITER $$
CREATE TRIGGER `tgr_delete_aluno` BEFORE DELETE ON `alunos` FOR EACH ROW BEGIN
	DELETE FROM alunos_disciplinas WHERE matr_aluno = OLD.matricula;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos_disciplinas`
--

CREATE TABLE `alunos_disciplinas` (
  `id` int(11) NOT NULL,
  `matr_aluno` int(11) DEFAULT NULL,
  `cod_disciplina` int(11) DEFAULT NULL,
  `n1` double DEFAULT NULL,
  `n2` double DEFAULT NULL,
  `n3` double DEFAULT NULL,
  `n4` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `alunos_disciplinas`
--

INSERT INTO `alunos_disciplinas` (`id`, `matr_aluno`, `cod_disciplina`, `n1`, `n2`, `n3`, `n4`) VALUES
(1, 1, 1, 10, 8, 7, 9.5),
(4, 3, 2, 6, 5, 7, 4),
(5, 1, 2, 8, 7.5, 6, 7),
(6, 1, 3, 7, 6, 6.5, 7),
(8, 6, 4, 7, 5, 6, 6.5),
(12, 1, 7, 7, 10, 9, 8),
(18, 1, 9, 7, 8, 7.8, 9),
(19, 11, 3, 7, 5, 10, 8),
(28, 3, 5, 8, 7, 9, 5),
(29, 1, 12, 7, 9.5, 7, 8),
(31, 1, 10, 7, 5.8, 10, 0),
(32, 1, 5, 7, 8, 7, 9),
(35, 32, 12, 6, 5.5, 7, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `disciplinas`
--

INSERT INTO `disciplinas` (`codigo`, `nome`) VALUES
(1, 'Matemática Instrumental'),
(2, 'Algoritmo e Estrutura de Dados II'),
(3, 'Geometria Analítica II'),
(4, 'Cálculo I'),
(5, 'Engenharia de Software I'),
(7, 'Arquitetura de Computadores'),
(9, 'Cálculo II'),
(10, 'Cálculo III'),
(12, 'Sistemas de Informação'),
(17, 'Redes de Computadores I');

--
-- Gatilhos `disciplinas`
--
DELIMITER $$
CREATE TRIGGER `tgr_delete_disciplina` BEFORE DELETE ON `disciplinas` FOR EACH ROW BEGIN
	
		DELETE FROM alunos_disciplinas WHERE cod_disciplina = OLD.codigo;
	
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_alunos`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_alunos` (
`matricula` int(11)
,`aluno` varchar(60)
,`disciplinas` int(11)
,`aprovacoes` int(11)
,`reprovacoes` int(11)
,`recuperacoes` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_boletins`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_boletins` (
`id` int(11)
,`matricula` int(11)
,`aluno` varchar(60)
,`codigo` int(11)
,`disciplina` varchar(60)
,`nota1` double
,`nota2` double
,`nota3` double
,`nota4` double
,`media` double
,`situacao` varchar(12)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_disciplinas`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_disciplinas` (
`codigo` int(11)
,`disciplina` varchar(60)
,`alunos` int(11)
,`aprovados` int(11)
,`reprovados` int(11)
,`recuperacao` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_alunos`
--
DROP TABLE IF EXISTS `vw_alunos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_alunos`  AS  select `alunos`.`matricula` AS `matricula`,`alunos`.`nome` AS `aluno`,`cont_disciplinas`(`alunos`.`matricula`) AS `disciplinas`,`cont_situacao_aluno`(`alunos`.`matricula`,'Aprovado') AS `aprovacoes`,`cont_situacao_aluno`(`alunos`.`matricula`,'Reprovado') AS `reprovacoes`,`cont_situacao_aluno`(`alunos`.`matricula`,'Recuperação') AS `recuperacoes` from `alunos` ;

-- --------------------------------------------------------

--
-- Estrutura para view `vw_boletins`
--
DROP TABLE IF EXISTS `vw_boletins`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_boletins`  AS  select `alunos_disciplinas`.`id` AS `id`,`alunos_disciplinas`.`matr_aluno` AS `matricula`,`alunos`.`nome` AS `aluno`,`alunos_disciplinas`.`cod_disciplina` AS `codigo`,`disciplinas`.`nome` AS `disciplina`,`alunos_disciplinas`.`n1` AS `nota1`,`alunos_disciplinas`.`n2` AS `nota2`,`alunos_disciplinas`.`n3` AS `nota3`,`alunos_disciplinas`.`n4` AS `nota4`,`media`(`alunos_disciplinas`.`n1`,`alunos_disciplinas`.`n2`,`alunos_disciplinas`.`n3`,`alunos_disciplinas`.`n4`) AS `media`,`situacao`(`alunos_disciplinas`.`n1`,`alunos_disciplinas`.`n2`,`alunos_disciplinas`.`n3`,`alunos_disciplinas`.`n4`) AS `situacao` from ((`alunos_disciplinas` join `alunos` on(`alunos_disciplinas`.`matr_aluno` = `alunos`.`matricula`)) join `disciplinas` on(`alunos_disciplinas`.`cod_disciplina` = `disciplinas`.`codigo`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `vw_disciplinas`
--
DROP TABLE IF EXISTS `vw_disciplinas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_disciplinas`  AS  select `disciplinas`.`codigo` AS `codigo`,`disciplinas`.`nome` AS `disciplina`,`cont_alunos`(`disciplinas`.`codigo`) AS `alunos`,`cont_situacao_disciplina`(`disciplinas`.`codigo`,'Aprovado') AS `aprovados`,`cont_situacao_disciplina`(`disciplinas`.`codigo`,'Reprovado') AS `reprovados`,`cont_situacao_disciplina`(`disciplinas`.`codigo`,'Recuperação') AS `recuperacao` from `disciplinas` ;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices de tabela `alunos_disciplinas`
--
ALTER TABLE `alunos_disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matr_aluno` (`matr_aluno`),
  ADD KEY `cod_disciplina` (`cod_disciplina`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de tabela `alunos_disciplinas`
--
ALTER TABLE `alunos_disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `alunos_disciplinas`
--
ALTER TABLE `alunos_disciplinas`
  ADD CONSTRAINT `alunos_disciplinas_ibfk_1` FOREIGN KEY (`matr_aluno`) REFERENCES `alunos` (`matricula`),
  ADD CONSTRAINT `alunos_disciplinas_ibfk_2` FOREIGN KEY (`cod_disciplina`) REFERENCES `disciplinas` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
