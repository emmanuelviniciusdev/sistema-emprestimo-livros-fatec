-- Cria o banco de dados
CREATE DATABASE db_biblioteca;
USE db_biblioteca;

-- Cria o usuário de acesso ao banco de dados
CREATE USER 'usuario_banco_programa'@'localhost' IDENTIFIED BY 'ubp';

-- Cede permissão de acesso do banco 'db_biblioteca' ao usuário 'ubp'
GRANT ALL ON db_biblioteca.* TO 'usuario_banco_programa'@'localhost';

-- Cria 'tb_usuario'
CREATE TABLE `tb_usuario` (
  `id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

-- Cria 'tb_livro'
CREATE TABLE `tb_livro` (
  `id` int NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `area` varchar(40) DEFAULT NULL,
  `ano` smallint DEFAULT NULL,
  `tombo` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `tb_livro`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_livro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

-- Cria 'tb_emprestimo'
CREATE TABLE `tb_emprestimo` (
  `id_livro` int NOT NULL,
  `id_usuario` int NOT NULL,
  `data_emprestimo` datetime NOT NULL,
  `data_devolucao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `tb_emprestimo`
  ADD PRIMARY KEY (`id_livro`,`id_usuario`),
  ADD KEY `tb_emprestimo_ibfk_2` (`id_usuario`);

ALTER TABLE `tb_emprestimo`
  ADD CONSTRAINT `tb_emprestimo_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `tb_livro` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_emprestimo_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
