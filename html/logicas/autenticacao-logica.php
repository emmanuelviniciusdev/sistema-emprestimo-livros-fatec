<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Usuario.php');

class AutenticacaoLogica
{
    private $conexaoBD;

    public function __construct()
    {
        $this->conexaoBD = new ConexaoBD();
    }

    public function obterUsuarioPorEmailSenha(string $email, string $senha)
    {
        $query = $this->conexaoBD->mysqli->query("SELECT * FROM tb_usuario WHERE email = '$email' AND senha = '$senha'");

        $resultado = $query->fetch_assoc();

        if ($resultado == NULL) {
            return NULL;
        }

        $usuario = new Usuario(
            $resultado['id'],
            $resultado['email'],
            $resultado['nivel']
        );

        return $usuario;
    }

    public function cadastrarUsuario(string $email, string $senha, int $nivel, $usuarioLogado)
    {}
}
