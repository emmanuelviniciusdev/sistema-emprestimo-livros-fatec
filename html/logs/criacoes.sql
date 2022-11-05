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