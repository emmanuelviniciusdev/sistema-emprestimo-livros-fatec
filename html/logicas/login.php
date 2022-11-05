<?php

require_once(__DIR__ . '/../logicas/autenticacao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$credenciaisVazias = empty($email) || empty($senha);

if ($credenciaisVazias) {
    die("Por favor, especifique suas credenciais");
}

$autenticacao = new Autenticacao();

$usuarioEncontrado = $autenticacao->obterUsuarioPorEmailSenha($email, $senha);

if ($usuarioEncontrado == NULL) {
    die("Login ou senha incorretos");
}

session_start();

$_SESSION['usuarioLogado'] = $usuarioEncontrado;

header('Location: ../livros-emprestados.php');
