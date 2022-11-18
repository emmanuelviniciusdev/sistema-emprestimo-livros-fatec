<?php
    require_once(__DIR__ . '/modelos/Emprestimo.php');
    require_once(__DIR__ . '/modelos/Livro.php');
    require_once(__DIR__ . '/modelos/Usuario.php');
    require_once(__DIR__ . '/logicas/log-logica.php');
    require_once(__DIR__ . '/logicas/emprestimo-logica.php');

    session_start();

    /**
     * Redireciona para a tela de login se o usuário não está logado
     */
    if (!isset($_SESSION['usuarioLogado'])) {
        header('Location: index.php');
    }

    $usuarioLogado = $_SESSION['usuarioLogado'];

    $emprestimoLogica = new EmprestimoLogica();

    $emprestimosVigentesUsuarioLogado = $emprestimoLogica->obterEmprestimosVigentesUsuario($usuarioLogado->getId());
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Emprestados</title>

    <!-- Bootstrap (copiar/colar) -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Bootstrap (copiar/colar) -->
</head>
<body>
    <div class="container mt-5" style="max-width: 1000px;">
        <div class="row bg-light border rounded-3 p-2">
            <div class="col">
                <h1 class="display-6">Livros Emprestados</h1>
                <p style="margin: 0;">Autenticado como <b><?php echo $usuarioLogado->getEmail() ?></b></p>
                <p style="margin: 0;">Você é: <b><?php echo $usuarioLogado->getPermissao() ?></b></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2">
            <a href="livros-emprestados.php" class="btn btn-secondary w-100 mb-1">Livros Emprestados</a>

            <?php if ($usuarioLogado->getPermissao() == "BIBLIOTECÁRIO" || $usuarioLogado->getPermissao() == "ADMINISTRADOR") { ?>
                <a href="emprestimo-livros.php" class="btn btn-secondary w-100 mb-1">Empréstimo de Livros</a>
            <?php } ?>

            <?php if ($usuarioLogado->getPermissao() == "ADMINISTRADOR") { ?>
                <a href="usuarios.php" class="btn btn-secondary w-100 mb-1">Usuários</a>
            <?php } ?>
                            
            <hr>
                <a href="sair.php" class="btn btn-danger w-100 mb-1">Sair</a>
            </div>
            <div class="col">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Área</th>
                            <th>Ano</th>
                            <th>Tombo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($emprestimosVigentesUsuarioLogado as $emprestimo) {
                                $livro = $emprestimo->getLivro();

                                echo "<tr>";
                                echo "<td>" . $livro->getTitulo() . "</td>";
                                echo "<td>" . $livro->getAutor() . "</td>";
                                echo "<td>" . $livro->getArea() . "</td>";
                                echo "<td>" . $livro->getAno() . "</td>";
                                echo "<td>" . $livro->getTombo() . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap (copiar/colar) -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap (copiar/colar) -->
</body>
</html>