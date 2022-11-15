<?php
    require_once(__DIR__ . '/modelos/Emprestimo.php');
    require_once(__DIR__ . '/modelos/Livro.php');
    require_once(__DIR__ . '/modelos/Usuario.php');
    require_once(__DIR__ . '/logicas/log-logica.php');
    require_once(__DIR__ . '/logicas/usuario-logica.php');
    require_once(__DIR__ . '/logicas/livro-logica.php');

    session_start();

    /**
     * Redireciona para a tela de login se o usuário não está logado
     */
    if (!isset($_SESSION['usuarioLogado'])) {
        header('Location: index.php');
    }

    $usuarioLogado = $_SESSION['usuarioLogado'];

    $usuarioLogica = new UsuarioLogica();
    $livroLogica = new LivroLogica();

    $todosUsuarios = $usuarioLogica->obterTodosUsuarios();
    $todosLivros = $livroLogica->obterTodosLivros();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar um Livro</title>

    <!-- Bootstrap (copiar/colar) -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Bootstrap (copiar/colar) -->
</head>
<body>
    <div class="container mt-5" style="max-width: 1000px;">
        <div class="row bg-light border rounded-3 p-2">
            <div class="col">
                <h1 class="display-6">Emprestar um Livro</h1>
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
                <form method="post" action="logicas/acao-emprestar.php">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <select name="usuario" id="usuario" class="form-select">
                            <option>Selecione o usuário</option>
                            <?php
                                foreach ($todosUsuarios as $usuario) {
                                    $usuarioId = $usuario->getId();
                                    $usuarioEmail = $usuario->getEmail();

                                    echo "<option value='$usuarioId'>$usuarioEmail</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="livro" class="form-label">Livro</label>
                        <select name="livro" id="livro" class="form-select">
                            <option>Selecione o livro</option>
                            <?php
                                foreach ($todosLivros as $livro) {
                                    $livroId = $livro->getId();
                                    $livroTitulo = $livro->getTitulo();
                                    $livroAutor = $livro->getAutor();
                                    $livroAno = $livro->getAno();

                                    echo "<option value='$livroId'>$livroTitulo, $livroAutor ($livroAno)</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary">Emprestar</button>
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