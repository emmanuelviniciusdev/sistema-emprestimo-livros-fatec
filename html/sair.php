<?php

require_once(__DIR__ . '/logicas/log-logica.php');

session_start();

$logLogica = new LogLogica($_SESSION['usuarioLogado']);
$logLogica->registrarLogout();

$_SESSION['usuarioLogado'] = NULL;

header('Location: index.php');
