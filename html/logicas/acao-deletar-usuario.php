<?php

require_once(__DIR__ . '/usuario-logica.php');
require_once(__DIR__ . '/log-logica.php');

session_start();

$usuarioId = $_GET['id_usuario'];

if (!isset($usuarioId)) {
    die("Deve-se especificar id_usuario");
}

$usuarioLogica = new UsuarioLogica();

$usuarioDeletado = $usuarioLogica->deletarUsuarioPorId($usuarioId);

if (!$usuarioDeletado) {
    die("Erro ao deletar usuário");
}

$logLogica = new LogLogica($_SESSION['usuarioLogado']);
$logLogica->registrarExclusaoUsuario($usuarioDeletado);

header('Location: ../usuarios.php');
