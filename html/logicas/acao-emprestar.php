<?php

require_once(__DIR__ . '/log-logica.php');
require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Usuario.php');
require_once(__DIR__ . '/../modelos/Emprestimo.php');

session_start();

date_default_timezone_set('America/Sao_Paulo');

$usuarioId = $_POST['usuario'];
$livroId = $_POST['livro'];

if (!isset($usuarioId) || !isset($livroId)) {
    die("Usuário ou livro inválido");
}

$conexaoBD = new ConexaoBD();

$query = $conexaoBD->mysqli->query("
    INSERT INTO tb_emprestimo (id_livro, id_usuario, data_emprestimo)
    VALUES ($livroId, $usuarioId, NOW())
");

if (!$query) {
    die("Erro ao inserir dados na tb_emprestimo");
}

$emprestimo = new Emprestimo($livroId, $usuarioId, date('Y-m-d H:i:s'), NULL);

$logLogica = new LogLogica($_SESSION['usuarioLogado']);
$logLogica->registrarNovoEmprestimo($emprestimo);

header('Location: ../emprestimo-livros.php');
