<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/Usuario.php');
require_once(__DIR__ . '/Livro.php');

class Emprestimo
{
    private int $idLivro;
    private int $idUsuario;
    private string $dataEmprestimo;
    private ?string $dataDevolucao;
    private Usuario $usuario;
    private Livro $livro;

    private $conexaoBD;

    public function __construct(int $idLivro, int $idUsuario, string $dataEmprestimo, ?string $dataDevolucao)
    {
        $this->conexaoBD = new ConexaoBD();

        $this->idLivro = $idLivro;
        $this->idUsuario = $idUsuario;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;

        $this->setUsuario($idUsuario);
        $this->setLivro($idLivro);
    }

    public function getIdLivro()
    {
        return $this->idLivro;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getDataEmprestimo()
    {
        return $this->dataEmprestimo;
    }

    public function getDataDevolucao()
    {
        return $this->dataDevolucao;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getLivro()
    {
        return $this->livro;
    }

    private function setUsuario(int $idUsuario)
    {
        $query = $this->conexaoBD->mysqli->query("SELECT * FROM tb_usuario WHERE id = $idUsuario");

        $resultado = $query->fetch_assoc();

        $usuario = new Usuario(
            $resultado['id'],
            $resultado['email'],
            $resultado['nivel'],
        );

        $this->usuario = $usuario;
    }

    private function setLivro(int $idLivro)
    {
        $query = $this->conexaoBD->mysqli->query("SELECT * FROM tb_livro WHERE id = $idLivro");

        $resultado = $query->fetch_assoc();

        $livro = new Livro(
            $resultado['id'],
            $resultado['autor'],
            $resultado['titulo'],
            $resultado['area'],
            $resultado['ano'],
            $resultado['tombo'],
        );

        $this->livro = $livro;
    }
}
