<?php

session_start();

$_SESSION['usuarioLogado'] = NULL;

header('Location: index.php');
