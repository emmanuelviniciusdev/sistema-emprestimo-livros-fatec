<?php

require_once(__DIR__ . '/usuario-logica.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$nivel = $_POST['permissao'];

if (!isset($email) || !isset($senha) || !isset($nivel)) {
    die("Email ou senha ou permissão inválido");
}

$usuarioLogica = new UsuarioLogica();

$sucessoCadastroUsuario = $usuarioLogica->cadastrarUsuario($email, $senha, $nivel);

if (!$sucessoCadastroUsuario) {
    die("Erro ao cadastrar usuário");
}

header('Location: ../usuarios.php');
