<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Usuario.php');

class UsuarioLogica
{
    private $conexaoBD;

    public function __construct()
    {
        $this->conexaoBD = new ConexaoBD();
    }

    public function deletarUsuarioPorId(int $usuarioId)
    {
        $query = $this->conexaoBD->mysqli->query("SELECT * FROM tb_usuario WHERE id = $usuarioId");

        $resultado = $query->fetch_assoc();

        $usuario = new Usuario(
            $resultado['id'],
            $resultado['email'],
            $resultado['nivel'],
        );

        $query = $this->conexaoBD->mysqli->query("DELETE FROM tb_usuario WHERE id = $usuarioId");

        if (!$query) {
            return NULL;
        }

        return $usuario;
    }

    public function cadastrarUsuario(string $email, string $senha, int $nivel)
    {
        /**
         * Verifica se usuário já existe pelo email
         */
        $query = $this->conexaoBD->mysqli->query("
            SELECT * FROM tb_usuario WHERE email = '$email'
        ");

        if ($query->num_rows > 0) {
            return false;
        }

        /**
         * Insere usuário
         */
        $query = $this->conexaoBD->mysqli->query("
            INSERT INTO tb_usuario (email, senha, nivel)
            VALUES ('$email', '$senha', $nivel)
        ");

        if (!$query) {
            return false;
        }

        /**
         * Seleciona usuário para criar uma instância do modelo "Usuario"
         */
        $query = $this->conexaoBD->mysqli->query("
            SELECT * FROM tb_usuario WHERE email = '$email'
        ");

        $resultado = $query->fetch_assoc();

        $usuario = new Usuario(
            $resultado['id'],
            $resultado['email'],
            $resultado['nivel'],
        );

        return $usuario;
    }

    /**
     * Retorna usuários cadastrados, removendo da lista o usuário logado e os usuários com
     * permissão de administrador.
     */
    public function obterTodosUsuarios(int $idUsuarioLogado)
    {
        $query = $this->conexaoBD->mysqli->query("
            SELECT * FROM tb_usuario
            WHERE id <> $idUsuarioLogado AND nivel <> 3
        ");

        $resultados = $query->fetch_all(MYSQLI_ASSOC);

        $usuarios = [];

        foreach($resultados as $r) {
            $usuario = new Usuario(
                $r['id'],
                $r['email'],
                $r['nivel'],
            );

            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }
}
