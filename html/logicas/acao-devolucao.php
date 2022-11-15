<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Usuario.php');

$idUsuario = $_GET['id_usuario'];
$idLivro = $_GET['id_livro'];

if (!isset($idUsuario) && !isset($idLivro)) {
    die("Parâmetros 'id_usuario' e 'id_livro' inválidos");
}

$conexaoBD = new ConexaoBD();

$query = $conexaoBD->mysqli->query("
    UPDATE tb_emprestimo SET data_devolucao = NOW()
    WHERE id_usuario = $idUsuario AND id_livro = $idLivro
");

if (!$query) {
    die("Erro ao atualizar tb_emprestimo");
}

header('Location: ../emprestimo-livros.php');
