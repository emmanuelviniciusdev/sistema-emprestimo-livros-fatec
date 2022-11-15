<?php

require_once(__DIR__ . '/usuario-logica.php');
require_once(__DIR__ . '/log-logica.php');

session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];
$nivel = $_POST['permissao'];

if (!isset($email) || !isset($senha) || !isset($nivel)) {
    die("Email ou senha ou permissão inválido");
}

$usuarioLogica = new UsuarioLogica();

$usuarioCadastrado = $usuarioLogica->cadastrarUsuario($email, $senha, $nivel);

if (!$usuarioCadastrado) {
    die("Erro ao cadastrar usuário");
}

$logLogica = new LogLogica($_SESSION['usuarioLogado']);
$logLogica->registrarInsercaoUsuario($usuarioCadastrado);

header('Location: ../usuarios.php');
