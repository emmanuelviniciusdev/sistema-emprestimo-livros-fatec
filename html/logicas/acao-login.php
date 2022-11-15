<?php

require_once(__DIR__ . '/../logicas/autenticacao-logica.php');
require_once(__DIR__ . '/../logicas/log-logica.php');

session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$credenciaisVazias = empty($email) || empty($senha);

if ($credenciaisVazias) {
    die("Por favor, especifique suas credenciais");
}

$autenticacaoLogica = new AutenticacaoLogica();

$usuarioEncontrado = $autenticacaoLogica->obterUsuarioPorEmailSenha($email, $senha);

if ($usuarioEncontrado == NULL) {
    die("Login ou senha incorretos");
}

$_SESSION['usuarioLogado'] = $usuarioEncontrado;

$logLogica = new LogLogica($usuarioEncontrado);
$logLogica->registrarLogin();

header('Location: ../livros-emprestados.php');
