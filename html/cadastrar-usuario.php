<?php
    require_once(__DIR__ . '/modelos/Emprestimo.php');
    require_once(__DIR__ . '/modelos/Livro.php');
    require_once(__DIR__ . '/modelos/Usuario.php');
    require_once(__DIR__ . '/logicas/log.php');

    session_start();

    /**
     * Redireciona para a tela de login se o usuário não está logado
     */
    if (!isset($_SESSION['usuarioLogado'])) {
        header('Location: index.php');
    }

    $usuarioLogado = $_SESSION['usuarioLogado'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>

    <!-- Bootstrap (copiar/colar) -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Bootstrap (copiar/colar) -->
</head>
<body>
    <div class="container mt-5" style="max-width: 1000px;">
        <div class="row bg-light border rounded-3 p-2">
            <div class="col">
                <h1 class="display-6">Cadastrar Usuário</h1>
                <p style="margin: 0;">Autenticado como <b><?php echo $usuarioLogado->getEmail() ?></b></p>
                <p style="margin: 0;">Você é: <b><?php echo $usuarioLogado->getPermissao() ?></b></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2">
                <a href="livros-emprestados.php" class="btn btn-secondary w-100 mb-1">Livros Emprestados</a>
                <a href="emprestimo-livros.php" class="btn btn-secondary w-100 mb-1">Empréstimo de Livros</a>
                <a href="usuarios.php" class="btn btn-secondary w-100 mb-1">Usuários</a>
                <hr>
                <a href="sair.php" class="btn btn-danger w-100 mb-1">Sair</a>
            </div>
            <div class="col">
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="senha" class="form-control" id="senha" name="senha" placeholder="Senha">
                    </div>
                    <div class="mb-3">
                        <!-- USUÁRIOS COM PERMISSÃO "ADMINISTRADOR" SÓ PODEM SER CADASTRADOS VIA SQL -->
                        <label for="permissao" class="form-label">Permissão</label>
                        <select name="permissao" id="permissao" class="form-select">
                            <option>Selecione a permissão</option>
                            <option value="1">ALUNO</option>
                            <option value="2">BIBLIOTECÁRIO</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap (copiar/colar) -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap (copiar/colar) -->
</body>
</html>