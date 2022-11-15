<?php

require_once(__DIR__ . '/usuario-logica.php');

$usuarioId = $_GET['id_usuario'];

if (!isset($usuarioId)) {
    die("Deve-se especificar id_usuario");
}

$usuarioLogica = new UsuarioLogica();

$sucessoDeletarUsuario = $usuarioLogica->deletarUsuarioPorId($usuarioId);

if (!$sucessoDeletarUsuario) {
    die("Erro ao deletar usuário");
}

header('Location: ../usuarios.php');
