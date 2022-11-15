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

    public function obterTodosUsuarios()
    {
        $query = $this->conexaoBD->mysqli->query("SELECT * FROM tb_usuario");

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
