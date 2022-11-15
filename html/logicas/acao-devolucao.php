<?php

require_once(__DIR__ . '/log-logica.php');
require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Usuario.php');

session_start();

date_default_timezone_set('America/Sao_Paulo');

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

/**
 * Não preenche a data de empréstimo porque esta informação não será necessária neste ponto do código.
 */
$emprestimo = new Emprestimo($idLivro, $idUsuario, "", date('Y-m-d H:i:s'));

$logLogica = new LogLogica($_SESSION['usuarioLogado']);
$logLogica->registrarDevolucaoEmprestimo($emprestimo);

header('Location: ../emprestimo-livros.php');
