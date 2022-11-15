<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Usuario.php');

$usuarioId = $_POST['usuario'];
$livroId = $_POST['livro'];

if (!isset($usuarioId) || !isset($livroId)) {
    echo "Usuário ou livro inválido";
}

$conexaoBD = new ConexaoBD();

$query = $conexaoBD->mysqli->query("
    INSERT INTO tb_emprestimo (id_livro, id_usuario, data_emprestimo)
    VALUES ($livroId, $usuarioId, NOW())
");

if (!$query) {
    echo "Erro ao inserir dados na tb_emprestimo";
}

header('Location: ../emprestimo-livros.php');
